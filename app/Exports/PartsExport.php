<?php

namespace App\Exports;

use App\Models\Part;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PartsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Part::with(['branch', 'customer'])->get();
    }

    public function headings(): array
    {
        return [
            'Part Code',
            'Part Name',
            'Part Model',
            'Customer',
            'Branch',
            'HSN No',
            'Length',
            'Width',
            'Height',
            'Thickness',
            'LD Ratio',
            'LLD Ratio',
            'HD Ratio',
            'RD Ratio',
            'No of Ups',
            'Weight',
            'Sealing Type',
            'Printing Status',
            'Printing Colour',
            'Bundle Qty',
            'Category',
            'Price',
            'Quantity',
            'Status',
            'Created At'
        ];
    }

    public function map($part): array
    {
        return [
            $part->part_unique_code,
            $part->part_name,
            $part->part_model,
            $part->customer->name ?? 'N/A',
            $part->branch->branch_name ?? 'N/A',
            $part->hsn_no,
            $part->part_length,
            $part->part_width,
            $part->part_height,
            $part->part_thickness,
            $part->part_ld_ratio,
            $part->part_lld_ratio,
            $part->part_hd_ratio,
            $part->part_rd_ratio,
            $part->part_no_ups,
            $part->part_weight,
            $part->part_no_sealing_type,
            $part->printing_status ? 'Yes' : 'No',
            $part->printing_colour,
            $part->bundle_qty,
            $part->part_category,
            $part->part_price,
            $part->part_quantity,
            $part->status ? 'Active' : 'Inactive',
            $part->created_at->format('Y-m-d H:i:s')
        ];
    }
}
