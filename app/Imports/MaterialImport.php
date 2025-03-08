<?php

namespace App\Imports;

use App\Models\Material;
use App\Models\Branch;
use App\Models\Supplier;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Auth;

class MaterialImport implements ToCollection, WithHeadingRow, WithValidation
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $supplier = null;
            if (!empty($row['primary_supplier'])) {
                $supplier = Supplier::where('name', $row['primary_supplier'])->first();
            }

            $branch = null;
            if (!empty($row['branch'])) {
                $branch = Branch::where('name', $row['branch'])->first();
            }

            Material::create([
                // Basic Information
                'material_code' => $row['material_code'],
                'material_name' => $row['material_name'],
                'material_type' => $row['material_type'],
                'material_grade' => $row['material_grade'],
                'material_category' => $row['category'],
                'material_color' => $row['color'],

                // Stock Information
                'opening_balance' => $row['opening_balance'],
                'quantity' => $row['quantity'],
                'uom' => $row['uom'],
                'minimum_stock_level' => $row['minimum_stock_level'],
                'maximum_stock_level' => $row['maximum_stock_level'],
                'reorder_point' => $row['reorder_point'],
                'safety_stock' => $row['safety_stock'],

                // Pricing
                'unit_price' => $row['unit_price'],
                'last_purchase_price' => $row['last_purchase_price'],
                'currency' => $row['currency'] ?? 'INR',
                'tax_rate' => $row['tax_rate'],
                'hsn_code' => $row['hsn_code'],

                // Physical Properties
                'density' => $row['density'],
                'melt_flow_index' => $row['melt_flow_index'],
                'technical_properties' => json_decode($row['technical_properties'] ?? '{}', true),
                'standard_weight' => $row['standard_weight'],
                'standard_length' => $row['standard_length'],
                'standard_width' => $row['standard_width'],

                // Storage
                'warehouse_location' => $row['warehouse_location'],
                'bin_location' => $row['bin_location'],
                'storage_conditions' => json_decode($row['storage_conditions'] ?? '{}', true),
                'shelf_life_days' => $row['shelf_life_days'],

                // Quality
                'quality_grade' => $row['quality_grade'],
                'quality_parameters' => json_decode($row['quality_parameters'] ?? '{}', true),
                'manufacture_date' => $row['manufacture_date'],
                'expiry_date' => $row['expiry_date'],
                'requires_inspection' => strtolower($row['requires_inspection']) === 'yes',
                'inspection_interval_days' => $row['inspection_interval_days'],

                // Supplier Info
                'primary_supplier_id' => $supplier ? $supplier->id : null,
                'alternative_suppliers' => json_decode($row['alternative_suppliers'] ?? '[]', true),
                'manufacturer_name' => $row['manufacturer_name'],
                'brand_name' => $row['brand_name'],
                'lead_time_days' => $row['lead_time_days'],
                'minimum_order_quantity' => $row['minimum_order_quantity'],

                // Documentation
                'material_image' => $row['material_image'],
                'msds_document' => $row['msds_document'],
                'technical_datasheet' => $row['technical_datasheet'],
                'quality_certificate' => $row['quality_certificate'],
                'notes' => $row['notes'],
                'certificates' => json_decode($row['certificates'] ?? '{}', true),

                // Status and Control
                'status' => $row['status'],
                'is_active' => strtolower($row['is_active']) === 'yes',
                'is_returnable' => strtolower($row['is_returnable']) === 'yes',
                'is_batch_tracked' => strtolower($row['is_batch_tracked']) === 'yes',
                'requires_coa' => strtolower($row['requires_coa']) === 'yes',

                // Branch and Tracking
                'branch_id' => $branch ? $branch->id : null,
                'created_by' => Auth::id(),
                'updated_by' => Auth::id(),
                'last_stock_update' => now(),
                'last_price_update' => now(),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            // Basic Information
            'material_code' => 'required|string|max:20|unique:materials',
            'material_name' => 'required|string|max:100',
            'material_type' => 'required|in:LD,LLD,HD,RD,MB,OTHER',
            'material_grade' => 'nullable|string|max:50',
            'category' => 'required|in:Raw Material,Finished Good,Semi-Finished,Packaging',
            'color' => 'nullable|string|max:50',

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
            'technical_properties' => 'nullable',
            'standard_weight' => 'nullable|numeric|min:0',
            'standard_length' => 'nullable|numeric|min:0',
            'standard_width' => 'nullable|numeric|min:0',

            // Storage
            'warehouse_location' => 'nullable|string|max:50',
            'bin_location' => 'nullable|string|max:50',
            'storage_conditions' => 'nullable',
            'shelf_life_days' => 'nullable|integer|min:0',

            // Quality
            'quality_grade' => 'nullable|string|max:20',
            'quality_parameters' => 'nullable',
            'manufacture_date' => 'nullable|date',
            'expiry_date' => 'nullable|date|after:manufacture_date',
            'requires_inspection' => 'nullable|in:Yes,No',
            'inspection_interval_days' => 'nullable|integer|min:0',

            // Supplier Info
            'primary_supplier' => 'nullable|exists:suppliers,name',
            'alternative_suppliers' => 'nullable',
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
            'certificates' => 'nullable',

            // Status and Control
            'status' => 'required|in:active,inactive,pending_approval,discontinued,out_of_stock,expired',
            'is_active' => 'required|in:Yes,No',
            'is_returnable' => 'required|in:Yes,No',
            'is_batch_tracked' => 'required|in:Yes,No',
            'requires_coa' => 'required|in:Yes,No',

            // Branch
            'branch' => 'required|exists:branches,name',
        ];
    }
}
