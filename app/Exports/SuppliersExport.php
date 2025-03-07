<?php

namespace App\Exports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SuppliersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Supplier::all(); // Fetch all suppliers data
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define the column headings for the Excel file
        return [
            'ID',
            'Unique Code',
            'Profile Picture',
            'Supplier Name',
            'Email',
            'Phone',
            'GST',
            'Key Contact',
            'Business Type',
            'Delivery Terms',
            'Payment Terms',
            'Address',
            'Website',
            'Social Media Links',
            'Additional Notes',
            'User ID',
            'Created At',
            'Updated At',
        ];
    }
}
