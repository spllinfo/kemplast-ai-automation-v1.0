<?php

namespace App\Exports;

use App\Models\MaterialStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MaterialStocksExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return MaterialStock::with(['supplier:id,supplier_name', 'branch:id,branch_name'])->get(); // Eager load relations
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
            'Material Name',
            'Grade',
            'Category',
            'Quantity',
            'UOM',
            'Price',
            'Description',
            'Warehouse Location',
            'Supplier Name', // From relationship
            'Branch Name',     // From relationship
            'Supplier ID',
            'User ID',
            'Branch ID',
            'Created At',
            'Updated At',
        ];
    }
}
