<?php

namespace App\Exports;

use App\Models\Material;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MaterialExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Material::with(['primarySupplier', 'branch', 'creator', 'updater'])->get();
    }

    public function headings(): array
    {
        return [
            // Basic Information
            'Material Code',
            'Material Name',
            'Material Type',
            'Material Grade',
            'Category',
            'Color',

            // Stock Information
            'Opening Balance',
            'Quantity',
            'UOM',
            'Minimum Stock Level',
            'Maximum Stock Level',
            'Reorder Point',
            'Safety Stock',

            // Pricing
            'Unit Price',
            'Last Purchase Price',
            'Currency',
            'Tax Rate',
            'HSN Code',

            // Physical Properties
            'Density',
            'Melt Flow Index',
            'Technical Properties',
            'Standard Weight',
            'Standard Length',
            'Standard Width',

            // Storage
            'Warehouse Location',
            'Bin Location',
            'Storage Conditions',
            'Shelf Life (Days)',

            // Quality
            'Quality Grade',
            'Quality Parameters',
            'Manufacture Date',
            'Expiry Date',
            'Requires Inspection',
            'Inspection Interval (Days)',

            // Supplier Info
            'Primary Supplier',
            'Alternative Suppliers',
            'Manufacturer Name',
            'Brand Name',
            'Lead Time (Days)',
            'Minimum Order Quantity',

            // Documentation
            'Material Image',
            'MSDS Document',
            'Technical Datasheet',
            'Quality Certificate',
            'Notes',
            'Certificates',

            // Status and Control
            'Status',
            'Is Active',
            'Is Returnable',
            'Is Batch Tracked',
            'Requires COA',

            // Branch and Tracking
            'Branch',
            'Created By',
            'Updated By',
            'Last Stock Update',
            'Last Price Update',
            'Created At',
            'Updated At'
        ];
    }

    public function map($material): array
    {
        return [
            // Basic Information
            $material->material_code,
            $material->material_name,
            $material->material_type,
            $material->material_grade,
            $material->material_category,
            $material->material_color,

            // Stock Information
            $material->opening_balance,
            $material->quantity,
            $material->uom,
            $material->minimum_stock_level,
            $material->maximum_stock_level,
            $material->reorder_point,
            $material->safety_stock,

            // Pricing
            $material->unit_price,
            $material->last_purchase_price,
            $material->currency,
            $material->tax_rate,
            $material->hsn_code,

            // Physical Properties
            $material->density,
            $material->melt_flow_index,
            json_encode($material->technical_properties),
            $material->standard_weight,
            $material->standard_length,
            $material->standard_width,

            // Storage
            $material->warehouse_location,
            $material->bin_location,
            json_encode($material->storage_conditions),
            $material->shelf_life_days,

            // Quality
            $material->quality_grade,
            json_encode($material->quality_parameters),
            $material->manufacture_date,
            $material->expiry_date,
            $material->requires_inspection ? 'Yes' : 'No',
            $material->inspection_interval_days,

            // Supplier Info
            optional($material->primarySupplier)->name,
            json_encode($material->alternative_suppliers),
            $material->manufacturer_name,
            $material->brand_name,
            $material->lead_time_days,
            $material->minimum_order_quantity,

            // Documentation
            $material->material_image,
            $material->msds_document,
            $material->technical_datasheet,
            $material->quality_certificate,
            $material->notes,
            json_encode($material->certificates),

            // Status and Control
            $material->status,
            $material->is_active ? 'Yes' : 'No',
            $material->is_returnable ? 'Yes' : 'No',
            $material->is_batch_tracked ? 'Yes' : 'No',
            $material->requires_coa ? 'Yes' : 'No',

            // Branch and Tracking
            optional($material->branch)->name,
            optional($material->creator)->name,
            optional($material->updater)->name,
            $material->last_stock_update,
            $material->last_price_update,
            $material->created_at,
            $material->updated_at
        ];
    }
}
