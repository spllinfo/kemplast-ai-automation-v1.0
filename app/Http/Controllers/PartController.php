<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\PartDocument;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class PartController extends Controller
{
    public function index()
    {
        $branches = Branch::select('id', 'name')->get();
        $customers = Customer::select('id', 'company_name')->get();
        $categories = Part::distinct()->pluck('part_category');

        return view('parts.index', compact('branches', 'customers', 'categories'));
    }

    public function getData(Request $request)
    {
        $query = Part::with(['branch', 'customer'])
            ->select('parts.*');

        if ($request->filled('date_filter')) {
            $query->filterByDate($request->date_filter);
        }

        return DataTables::of($query)
            ->addColumn('actions', function ($part) {
                return view('parts.partials.actions', compact('part'));
            })
            ->addColumn('customer_name', function ($part) {
                return $part->customer ? $part->customer->company_name : '-';
            })
            ->addColumn('branch_name', function ($part) {
                return $part->branch ? $part->branch_name : '-';
            })
            ->addColumn('dimensions', function ($part) {
                return "{$part->part_length}x{$part->part_width}x{$part->part_height}mm";
            })
            ->addColumn('material_ratio', function ($part) {
                return "LD:{$part->part_ld_ratio}% LLD:{$part->part_lld_ratio}% HD:{$part->part_hd_ratio}% RD:{$part->part_rd_ratio}%";
            })
            ->addColumn('status_badge', function ($part) {
                $class = match($part->status) {
                    'active' => 'success',
                    'inactive' => 'warning',
                    'archived' => 'danger',
                    default => 'secondary'
                };
                return "<span class='badge bg-{$class}'>{$part->status}</span>";
            })
            ->rawColumns(['actions', 'status_badge'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'part_name' => 'required|string|max:100',
            'part_category' => 'nullable|string|max:50',
            'part_model' => 'nullable|string|max:50',
            'hsn_no' => 'nullable|string|max:20',
            'reel_size' => 'nullable|string|max:20',
            'part_length' => 'nullable|numeric|min:0',
            'part_width' => 'nullable|numeric|min:0',
            'part_height' => 'nullable|numeric|min:0',
            'part_thickness' => 'nullable|numeric|min:0',
            'part_ld_ratio' => 'nullable|numeric|min:0|max:100',
            'part_lld_ratio' => 'nullable|numeric|min:0|max:100',
            'part_hd_ratio' => 'nullable|numeric|min:0|max:100',
            'part_rd_ratio' => 'nullable|numeric|min:0|max:100',
            'part_weight' => 'nullable|numeric|min:0',
            'part_price' => 'nullable|numeric|min:0',
            'no_ups' => 'nullable|integer|min:1',
            'sealing_type' => 'nullable|string|max:50',
            'printing_status' => 'boolean',
            'printing_colour' => 'nullable|string|max:50',
            'bundle_qty' => 'nullable|integer|min:0',
            'part_quantity' => 'nullable|integer|min:0',
            'bst' => 'boolean',
            'plain' => 'boolean',
            'flat' => 'boolean',
            'gazzate' => 'boolean',
            'bio' => 'boolean',
            'normal' => 'boolean',
            'milky' => 'boolean',
            'roto_printing' => 'boolean',
            'flexo_printing' => 'boolean',
            'recycle_logo' => 'boolean',
            'part_description' => 'nullable|string',
            'part_profile_picture' => 'nullable|image|max:2048',
            'part_tags' => 'nullable|array',
            'status' => 'required|in:active,inactive,archived',
            'branch_id' => 'nullable|exists:branches,id',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        // Generate unique code
        $validated['part_unique_code'] = 'PRT' . str_pad(Part::max('id') + 1, 6, '0', STR_PAD_LEFT);

        DB::beginTransaction();
        try {
            if ($request->hasFile('part_profile_picture')) {
                $path = $request->file('part_profile_picture')->store('parts/profiles', 'public');
                $validated['part_profile_picture'] = $path;
            }

            $validated['user_id'] = auth()->id();
            $part = Part::create($validated);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Part created successfully',
                'data' => $part
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create part: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Part $part)
    {
        $validated = $request->validate([
            'part_name' => 'required|string|max:100',
            'part_category' => 'nullable|string|max:50',
            'part_model' => 'nullable|string|max:50',
            'hsn_no' => 'nullable|string|max:20',
            'reel_size' => 'nullable|string|max:20',
            'part_length' => 'nullable|numeric|min:0',
            'part_width' => 'nullable|numeric|min:0',
            'part_height' => 'nullable|numeric|min:0',
            'part_thickness' => 'nullable|numeric|min:0',
            'part_ld_ratio' => 'nullable|numeric|min:0|max:100',
            'part_lld_ratio' => 'nullable|numeric|min:0|max:100',
            'part_hd_ratio' => 'nullable|numeric|min:0|max:100',
            'part_rd_ratio' => 'nullable|numeric|min:0|max:100',
            'part_weight' => 'nullable|numeric|min:0',
            'part_price' => 'nullable|numeric|min:0',
            'no_ups' => 'nullable|integer|min:1',
            'sealing_type' => 'nullable|string|max:50',
            'printing_status' => 'boolean',
            'printing_colour' => 'nullable|string|max:50',
            'bundle_qty' => 'nullable|integer|min:0',
            'part_quantity' => 'nullable|integer|min:0',
            'bst' => 'boolean',
            'plain' => 'boolean',
            'flat' => 'boolean',
            'gazzate' => 'boolean',
            'bio' => 'boolean',
            'normal' => 'boolean',
            'milky' => 'boolean',
            'roto_printing' => 'boolean',
            'flexo_printing' => 'boolean',
            'recycle_logo' => 'boolean',
            'part_description' => 'nullable|string',
            'part_profile_picture' => 'nullable|image|max:2048',
            'part_tags' => 'nullable|array',
            'status' => 'required|in:active,inactive,archived',
            'branch_id' => 'nullable|exists:branches,id',
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        DB::beginTransaction();
        try {
            if ($request->hasFile('part_profile_picture')) {
                if ($part->part_profile_picture) {
                    Storage::disk('public')->delete($part->part_profile_picture);
                }
                $path = $request->file('part_profile_picture')->store('parts/profiles', 'public');
                $validated['part_profile_picture'] = $path;
            }

            $part->update($validated);

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Part updated successfully',
                'data' => $part
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to update part: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Part $part)
    {
        DB::beginTransaction();
        try {
            // Delete profile picture
            if ($part->part_profile_picture) {
                Storage::disk('public')->delete($part->part_profile_picture);
            }

            // Delete associated documents
            foreach ($part->documents as $document) {
                Storage::disk('public')->delete($document->file_path);
                $document->delete();
            }

            $part->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Part deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete part'], 500);
        }
    }

    public function getDocuments(Part $part)
    {
        $documents = $part->documents()->with('uploader')->get();
        return response()->json($documents);
    }

    public function deleteDocument(PartDocument $document)
    {
        DB::beginTransaction();
        try {
            Storage::disk('public')->delete($document->file_path);
            $document->delete();
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Document deleted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to delete document'], 500);
        }
    }

    public function export(Request $request)
    {
        $query = Part::with(['branch', 'customer', 'documents']);

        // Apply filters similar to getData method
        if ($request->filled('date_filter')) {
            $query->filterByDate($request->date_filter);
        }
        // Add other filters...

        $parts = $query->get();

        // Generate Excel/CSV file
        // Implementation depends on your preferred export library
        // (e.g., Laravel Excel, spout, etc.)
    }
}
