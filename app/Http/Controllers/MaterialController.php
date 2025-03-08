<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Branch;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MaterialController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        $suppliers = Supplier::all();
        return view('materials', compact('branches', 'suppliers'));
    }

    public function list()
    {
        $materials = Material::with(['primarySupplier', 'branch'])
            ->select('materials.*');

        return DataTables::of($materials)
            ->addColumn('action', function ($material) {
                return view('components.action-buttons', compact('material'));
            })
            ->editColumn('status', function ($material) {
                return view('components.status-badge', ['status' => $material->status]);
            })
            ->editColumn('created_at', function ($material) {
                return $material->created_at->format('Y-m-d H:i:s');
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Basic Information
            'material_code' => 'required|string|max:20|unique:materials',
            'material_name' => 'required|string|max:100',
            'material_type' => 'required|in:LD,LLD,HD,RD,MB,OTHER',
            'material_grade' => 'nullable|string|max:50',
            'material_category' => 'required|in:Raw Material,Finished Good,Semi-Finished,Packaging',
            'material_color' => 'nullable|string|max:50',

            // Stock Information
            'opening_balance' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'uom' => 'required|string|max:10',
            'minimum_stock_level' => 'required|numeric|min:0',
            'maximum_stock_level' => 'nullable|numeric|min:0',
            'reorder_point' => 'required|numeric|min:0',
            'safety_stock' => 'required|numeric|min:0',

            // Pricing
            'unit_price' => 'required|numeric|min:0',
            'last_purchase_price' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:3',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'hsn_code' => 'nullable|string|max:20',

            // Physical Properties
            'density' => 'nullable|numeric|min:0',
            'melt_flow_index' => 'nullable|numeric|min:0',
            'technical_properties' => 'nullable|json',
            'standard_weight' => 'nullable|numeric|min:0',
            'standard_length' => 'nullable|numeric|min:0',
            'standard_width' => 'nullable|numeric|min:0',

            // Storage
            'warehouse_location' => 'nullable|string|max:50',
            'bin_location' => 'nullable|string|max:50',
            'storage_conditions' => 'nullable|json',
            'shelf_life_days' => 'nullable|integer|min:0',

            // Quality
            'quality_grade' => 'nullable|string|max:20',
            'quality_parameters' => 'nullable|json',
            'manufacture_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after:manufacture_date',
            'requires_inspection' => 'boolean',
            'inspection_interval_days' => 'nullable|integer|min:0',

            // Supplier Info
            'primary_supplier_id' => 'nullable|exists:suppliers,id',
            'alternative_suppliers' => 'nullable|json',
            'manufacturer_name' => 'nullable|string|max:100',
            'brand_name' => 'nullable|string|max:100',
            'lead_time_days' => 'nullable|integer|min:0',
            'minimum_order_quantity' => 'nullable|numeric|min:0',

            // Documentation
            'material_image' => 'nullable|string',
            'msds_document' => 'nullable|string',
            'technical_datasheet' => 'nullable|string',
            'quality_certificate' => 'nullable|string',
            'notes' => 'nullable|string',
            'certificates' => 'nullable|json',

            // Status and Control
            'status' => 'required|in:active,inactive,pending_approval,discontinued,out_of_stock,expired',
            'is_active' => 'boolean',
            'is_returnable' => 'boolean',
            'is_batch_tracked' => 'boolean',
            'requires_coa' => 'boolean',

            // Branch
            'branch_id' => 'required|exists:branches,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $data['created_by'] = Auth::id();
        $data['updated_by'] = Auth::id();
        $data['last_stock_update'] = now();
        $data['last_price_update'] = now();

        $material = Material::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Material created successfully',
            'data' => $material
        ]);
    }

    public function show($id)
    {
        $material = Material::with(['primarySupplier', 'branch', 'creator', 'updater'])->findOrFail($id);
        return response()->json($material);
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);

        $validator = Validator::make($request->all(), [
            // Basic Information
            'material_code' => 'required|string|max:20|unique:materials,material_code,' . $id,
            'material_name' => 'required|string|max:100',
            'material_type' => 'required|in:LD,LLD,HD,RD,MB,OTHER',
            'material_grade' => 'nullable|string|max:50',
            'material_category' => 'required|in:Raw Material,Finished Good,Semi-Finished,Packaging',
            'material_color' => 'nullable|string|max:50',

            // Stock Information
            'opening_balance' => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0',
            'uom' => 'required|string|max:10',
            'minimum_stock_level' => 'required|numeric|min:0',
            'maximum_stock_level' => 'nullable|numeric|min:0',
            'reorder_point' => 'required|numeric|min:0',
            'safety_stock' => 'required|numeric|min:0',

            // Pricing
            'unit_price' => 'required|numeric|min:0',
            'last_purchase_price' => 'nullable|numeric|min:0',
            'currency' => 'required|string|max:3',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'hsn_code' => 'nullable|string|max:20',

            // Physical Properties
            'density' => 'nullable|numeric|min:0',
            'melt_flow_index' => 'nullable|numeric|min:0',
            'technical_properties' => 'nullable|json',
            'standard_weight' => 'nullable|numeric|min:0',
            'standard_length' => 'nullable|numeric|min:0',
            'standard_width' => 'nullable|numeric|min:0',

            // Storage
            'warehouse_location' => 'nullable|string|max:50',
            'bin_location' => 'nullable|string|max:50',
            'storage_conditions' => 'nullable|json',
            'shelf_life_days' => 'nullable|integer|min:0',

            // Quality
            'quality_grade' => 'nullable|string|max:20',
            'quality_parameters' => 'nullable|json',
            'manufacture_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after:manufacture_date',
            'requires_inspection' => 'boolean',
            'inspection_interval_days' => 'nullable|integer|min:0',

            // Supplier Info
            'primary_supplier_id' => 'nullable|exists:suppliers,id',
            'alternative_suppliers' => 'nullable|json',
            'manufacturer_name' => 'nullable|string|max:100',
            'brand_name' => 'nullable|string|max:100',
            'lead_time_days' => 'nullable|integer|min:0',
            'minimum_order_quantity' => 'nullable|numeric|min:0',

            // Documentation
            'material_image' => 'nullable|string',
            'msds_document' => 'nullable|string',
            'technical_datasheet' => 'nullable|string',
            'quality_certificate' => 'nullable|string',
            'notes' => 'nullable|string',
            'certificates' => 'nullable|json',

            // Status and Control
            'status' => 'required|in:active,inactive,pending_approval,discontinued,out_of_stock,expired',
            'is_active' => 'boolean',
            'is_returnable' => 'boolean',
            'is_batch_tracked' => 'boolean',
            'requires_coa' => 'boolean',

            // Branch
            'branch_id' => 'required|exists:branches,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $data['updated_by'] = Auth::id();

        if ($material->quantity != $data['quantity']) {
            $data['last_stock_update'] = now();
        }
        if ($material->unit_price != $data['unit_price']) {
            $data['last_price_update'] = now();
        }

        $material->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Material updated successfully',
            'data' => $material
        ]);
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return response()->json([
            'success' => true,
            'message' => 'Material deleted successfully'
        ]);
    }
}
