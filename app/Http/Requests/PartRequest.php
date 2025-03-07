<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'part_name' => 'required|string|max:255',
            'part_model' => 'nullable|string|max:255',
            'hsn_no' => 'required|string|max:50',
            'customer_id' => 'required|exists:customers,id',
            'branch_id' => 'required|exists:branches,id',
            'part_length' => 'nullable|numeric|min:0',
            'part_width' => 'nullable|numeric|min:0',
            'part_height' => 'nullable|numeric|min:0',
            'part_thickness' => 'nullable|numeric|min:0',
            'part_weight' => 'nullable|numeric|min:0',
            'part_price' => 'nullable|numeric|min:0',
            'part_quantity' => 'nullable|integer|min:0',
            'part_status' => 'required|in:active,inactive',
            'notes' => 'nullable|string',
            'part_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'part_documents.*' => 'nullable|mimes:pdf,doc,docx,xls,xlsx|max:5120'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'part_name.required' => 'Part name is required',
            'hsn_no.required' => 'HSN number is required',
            'customer_id.required' => 'Please select a customer',
            'branch_id.required' => 'Please select a branch',
            'part_profile_picture.image' => 'The profile picture must be an image',
            'part_profile_picture.max' => 'Profile picture size should not exceed 2MB',
            'part_documents.*.mimes' => 'Documents must be in PDF, DOC, DOCX, XLS, or XLSX format',
            'part_documents.*.max' => 'Document size should not exceed 5MB'
        ];
    }
}
