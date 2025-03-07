<?php

namespace App\Exports;

use App\Models\Branch;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BranchesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Branch::all();
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
            'Branch Name',
            'Branch Type',
            'Email',
            'Phone',
            'Revenue',
            'Address',
            'City',
            'Opening Time',
            'Closing Time',
            'Contact Number',
            'Social Media Links',
            'Additional Notes',
            'Status',
            'Description',
            'Map',
            'User ID',
            'Created At',
            'Updated At',
        ];
    }
}
