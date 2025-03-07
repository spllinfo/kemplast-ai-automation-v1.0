<?php

namespace App\Exports;

use App\Models\JobPart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobPartsExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return JobPart::with(['branch:id,branch_name', 'customer:id,company_name', 'machine:id,machine_name', 'plan:id,plan_name', 'user:id,name', 'part:id,part_name'])->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Job Unique Code',
            'Job Part Unique Code',
            'Job Part Profile Picture',
            'Job Part Name',
            'Job Part Model',
            'Job Part Customer Name',
            'HSN No',
            'Job Part Length',
            'Job Part Width',
            'Job Part Height',
            'Job Part Thickness',
            'Job Part LD Ratio',
            'Job Part LLD Ratio',
            'Job Part HD Ratio',
            'Job Part RD Ratio',
            'Job Part No Ups',
            'Job Part Weight',
            'Job Part No Sealing Type',
            'Job Printing Status',
            'Job Printing Colour',
            'Job Bundle Qty',
            'Job Part Category',
            'Job Part Description',
            'Job Part Price',
            'Job Part Quantity',
            'Job BST',
            'Job LAIN',
            'Job FLAT',
            'Job GAZZATE',
            'Job BIO',
            'Job NORMAL',
            'Job MILKY',
            'Job ROTO Printing',
            'Job FLEXO Printing',
            'Job Side Seal',
            'Job Recycle Logo',
            'Job Part Status',
            'Job Part Documents',
            'Job Part Tags',
            'Branch Name',
            'Machine Type',
            'Job Status',
            'User Name', // User Relationship
            'Customer Name', // Customer Relationship
            'Machine Name', // Machine Relationship
            'Plan Name', // Production Plan Relationship
            'User ID',
            'Customer ID',
            'Machine ID',
            'Branch ID',
            'Plan ID',
            'Part ID',
            'Created At',
            'Updated At',
        ];
    }
}
