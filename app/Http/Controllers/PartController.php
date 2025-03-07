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
        $query = Part::with(['branch', 'customer', 'documents'])
            ->select('parts.*');

        // Apply filters
        if ($request->filled('date_filter')) {
            $query->filterByDate($request->date_filter);
        }

        if ($request->filled('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->filled('category')) {
            $query->where('part_category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return DataTables::of($query)
            ->addColumn('actions', function ($part) {
                return view('parts.partials.actions', compact('part'));
            })
            ->addColumn('documents_count', function ($part) {
                return $part->documents->count();
            })
            ->addColumn('customer_name', function ($part) {
                return $part->customer ? $part->customer->customer_name : '-';
            })
            ->addColumn('branch_name', function ($part) {
                return $part->branch ? $part->branch->name : '-';
            })
            ->addColumn('created_date', function ($part) {
                return $part->created_at->format('Y-m-d H:i:s');
            })
            ->filterColumn('customer_name', function ($query, $keyword) {
                $query->whereHas('customer', function ($q) use ($keyword) {
                    $q->where('customer_name', 'like', "%{$keyword}%");
                });
            })
            ->filterColumn('branch_name', function ($query, $keyword) {
                $query->whereHas('branch', function ($q) use ($keyword) {
                    $q->where('branch_name', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'part_unique_code' => 'required|unique:parts,part_unique_code|max:50',
            'part_name' => 'required|max:100',
            'part_category' => 'nullable|max:50',
            'part_model' => 'nullable|max:50',
            'hsn_no' => 'nullable|max:20',
            'part_profile_picture' => 'nullable|image|max:2048',
            // Add other validation rules
        ]);

        DB::beginTransaction();
        try {
            // Handle profile picture upload
            if ($request->hasFile('part_profile_picture')) {
                $path = $request->file('part_profile_picture')->store('parts/profiles', 'public');
                $validated['part_profile_picture'] = $path;
            }

            // Create part
            $part = Part::create($validated);

            // Handle documents
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $document) {
                    $path = $document->store('parts/documents', 'public');

                    PartDocument::create([
                        'part_id' => $part->id,
                        'document_name' => $document->getClientOriginalName(),
                        'file_path' => $path,
                        'file_type' => $document->getClientMimeType(),
                        'file_size' => $document->getSize(),
                        'uploaded_by' => auth()->id()
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Part created successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to create part'], 500);
        }
    }

    public function update(Request $request, Part $part)
    {
        $validated = $request->validate([
            'part_unique_code' => 'required|max:50|unique:parts,part_unique_code,' . $part->id,
            'part_name' => 'required|max:100',
            'part_category' => 'nullable|max:50',
            'part_model' => 'nullable|max:50',
            'hsn_no' => 'nullable|max:20',
            'part_profile_picture' => 'nullable|image|max:2048',
            // Add other validation rules
        ]);

        DB::beginTransaction();
        try {
            // Handle profile picture update
            if ($request->hasFile('part_profile_picture')) {
                // Delete old profile picture
                if ($part->part_profile_picture) {
                    Storage::disk('public')->delete($part->part_profile_picture);
                }
                $path = $request->file('part_profile_picture')->store('parts/profiles', 'public');
                $validated['part_profile_picture'] = $path;
            }

            // Update part
            $part->update($validated);

            // Handle new documents
            if ($request->hasFile('documents')) {
                foreach ($request->file('documents') as $document) {
                    $path = $document->store('parts/documents', 'public');

                    PartDocument::create([
                        'part_id' => $part->id,
                        'document_name' => $document->getClientOriginalName(),
                        'file_path' => $path,
                        'file_type' => $document->getClientMimeType(),
                        'file_size' => $document->getSize(),
                        'uploaded_by' => auth()->id()
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Part updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update part'], 500);
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
