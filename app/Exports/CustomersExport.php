<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Customer::all(); // Fetch all suppliers data
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Define the column headings for the Excel file
        return [
            'ID',
            'Customer Unique Code',
            'Company Name',
            'Contact Person',
            'Email',
            'Phone',
            'Alt Phone',
            'Address',
            'City',
            'State',
            'Country',
            'Pincode',
            'GST Number',
            'PAN Number',
            'TIN Number',
            'CST Number',
            'Website',
            'Credit Limit',
            'Payment Terms',
            'Tax Registration Number',
            'Tax Exemption Number',
            'Business Type',
            'Industry Type',
            'Customer Group',
            'Company Size',
            'Status',
            'Notes',
            'Bank Details',
            'Preferences',
            'Metadata',
            'Sales Person ID',
            'Branch ID',
            'Company Profile Picture',
            'Created At',
            'Updated At',
            'Deleted At'
        ];
    }
}
