<?php

namespace App\Exports;

use App\Models\ProductionPlan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductionPlansExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProductionPlan::with(['branch:id,branch_name', 'user:id,name'])->get(); // Eager load relations
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Unique Code',
            'Profile Picture',
            'Plan Name',
            'Production Start Date',
            'Production End Date',
            'Production Status',
            'Production Notes',
            'Production Cost',
            'Production Time',
            'Production Quantity',
            'Production Location',
            'Production Budget',
            'Production Priority',
            'Production Type',
            'Production Description',
            'User Name', // From relationship
            'Branch Name', // From Relationship
            'User ID',
            'Branch ID',
            'Created At',
            'Updated At',
        ];
    }
}