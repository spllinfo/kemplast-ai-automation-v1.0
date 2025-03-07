<?php

namespace App\Exports;

use App\Models\Machine;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MachinesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Machine::with('branch:id,branch_name')->get(); // Eager load branch name
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
            'Machine Name',
            'Branch Name', // Display branch name instead of ID
            'Machine Type',
            'Machine Capacity',
            'User ID',
            'Branch ID',
            'Created At',
            'Updated At',
        ];
    }
}
