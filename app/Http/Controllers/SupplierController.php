<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Spatie\Image\Enums\Fit;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuppliersExport;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function suppliers()
    {
        return view('suppliers');
    }

    public function supplierfetchall(Request $request)
    {
        $query = Supplier::orderBy('id','desc');
        $filterText = 'All Records';

        switch ($request->date_filter) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                $filterText = 'Today';
                break;
            case 'this_week':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                $filterText = 'This Week';
                break;
            case 'last_30_days':
                $query->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()]);
                $filterText = 'Last 30 Days';
                break;
            case 'last_90_days':
                $query->whereBetween('created_at', [Carbon::now()->subDays(90), Carbon::now()]);
                $filterText = 'Last 90 Days';
                break;
            case 'six_months':
                $query->whereBetween('created_at', [Carbon::now()->subMonths(6), Carbon::now()]);
                $filterText = 'Last 6 Months';
                break;
            case 'this_year':
                $query->whereYear('created_at', Carbon::now()->year);
                $filterText = 'This Year';
                break;
        }

        $suppliers = $query->get();

        $output = '';

        if ($suppliers->count() > 0) {
            $output .= '<table id="data_fetch_table" class="table table-hover ">
             <thead>
               <tr>
                    <th scope="col">
                        <input class="form-check-input check-all"
                               type="checkbox"
                               id="checkboxNoLabel"
                               value=""
                               aria-label="...">
                    </th>
               <th scope="col">Supplier Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Business Type</th>
                            <th scope="col">Delivery Terms</th>
                            <th scope="col">Key Contact</th>
                            <th scope="col">Payment Terms</th>
                            <th scope="col">Actions</th>
                </tr>
             </thead>
             <tbody>';
            foreach ($suppliers as $supplier) {
                $output .= '  <tr class="crm-contact companies-list">
                       <td class="companies-checkbox">
                            <input class="form-check-input" type="checkbox" id="checkbox_' . $supplier->id . '" value="' . $supplier->id . '" aria-label="...">
                       </td>
                       <td>
                            <div class="d-flex align-items-center gap-2">

                                <div>
                                    <a data-bs-toggle="offcanvas"
                                        href="#viewDataModal"
                                       role="button"
                                       aria-controls="viewDataModal"
                                       class=" ViewDataIcon"
                                       data-id="' . $supplier->id . '">' . $supplier->supplier_name . '</a>
                                </div>
                            </div>
                        </td>

                        <td>

                                                <span class="d-block mb-0"><i class="ri-mail-line fs-14 text-muted d-inline-block me-2 align-middle"></i>'.$supplier->supplier_mail.'</span>

                                        </td>
                                        <td>

                                                <span class="d-block"><i class="ri-phone-line fs-14 text-muted d-inline-block me-2 align-middle"></i>'.$supplier->supplier_phone.'</span>

                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center flex-wrap gap-1">
                                                <span class="badge bg-primary1-transparent">'.$supplier->supplier_business_type.'</span>
                                            </div>
                                        </td>
                        <td>
                            ' . $supplier->supplier_delivery_terms . '
                        </td>
                        <td>
                        <div class="d-flex align-items-center gap-2">
                                <div class="lh-1">
                                    <span class="avatar avatar-rounded avatar-sm">
                                        <img src="'.$supplier->supplier_profile_picture.'" alt="Supplier Logo" onerror="this.src=\''.asset('assets/images/faces/5.jpg').'\'">
                                                </span>
                                                </div>
                                                <div>
                                                <span class="d-block fw-medium">' . $supplier->key_contact . '</span>

                                                </div>
                                                </div>
                                        </td>
                                        <td>   ' . $supplier->supplier_payment_terms . '
                                        </td>
                                        <td>
            <div class="btn-list">
            <a data-bs-toggle="offcanvas"
           href="#viewDataModal"
           role="button"
           aria-controls="viewDataModal"
           class="btn btn-sm btn-primary-light btn-icon ViewDataIcon"
           data-id="' . $supplier->id . '">
            <i class="ri-eye-line"></i>
        </a>

                <a href="#" id="' . $supplier->id . '" class="btn btn-sm btn-info-light btn-icon EditDataIcon" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-pencil-line"></i>
                </a>
                <button class="btn btn-sm btn-primary2-light btn-icon DeleteDataIcon"
                            id="'.$supplier->id.'">
                        <i class="ri-delete-bin-line"></i>
                    </button>

            </div>
        </td>
                        </tr>';
            }
            $output .= '</tbody>
                     <tfoot>
                        <tr>
                            <th scope="col">
                                <input class="form-check-input check-all"
                                       type="checkbox"
                                       id="checkboxNoLabel"
                                       value=""
                                       aria-label="...">
                            </th>
                            <th scope="col">Supplier Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Business Type</th>
                            <th scope="col">Delivery Terms</th>
                            <th scope="col">Key Contact</th>
                            <th scope="col">Payment Terms</th>
                            <th scope="col">Actions</th>
                </tr>
                        </tfoot>
                     </table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No suppliers present in the database!</h1>';
        }
    }

    public function supplierstore(Request $request)
    {
        $user_id = Auth::id();

        // Validation Rules
        $request->validate([
            'company_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_name' => 'required|string|max:255',
            'company_mail' => 'required|email|max:255|unique:suppliers,supplier_mail',
            'company_phone' => 'required|string|max:20',
            'company_gst' => 'nullable|string|max:255',
            'key_contact' => 'required|string|max:255',

            'supplier_payment_terms' => 'nullable|string|max:255',
            'supplier_business_type' => 'nullable|string|max:255',
            'supplier_delivery_terms' => 'nullable|string|max:255',
            'company_revenue' => 'nullable|string|max:255',
            'company_year_established' => 'nullable|string|max:4', // Assuming year is 4 digits
            'social_media_links' => 'nullable|string|max:255',
            'additional_notes' => 'nullable|string',
            'company_address' => 'nullable|string|max:255',
            'company_website' => 'nullable|string|max:255',
        ]);


        $unique_code = [
            'table' => 'suppliers',
            'field' => 'supplier_unique_code',
            'length' => 8,
            'prefix' => 'SUP'
        ];
        
        $supplier_unique_code = IdGenerator::generate($unique_code);

        $supplierProfilePicture = null;  // Initialize

        // Handle image upload using Spatie Image
        if ($request->hasFile('company_profile_picture')) {
            $image = $request->file('company_profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/supplier-logos', $imageName);

            // Use Storage facade to get the full path for Spatie Image
            $fullImagePath = Storage::path($imagePath);

            if (Storage::exists($imagePath)) {
                // Process image using Spatie
                Image::load($fullImagePath)
                    ->fit(Fit::Crop, 300, 300)
                    ->save();

                $supplierProfilePicture = Storage::url('supplier-logos/' . $imageName);
            }
        }

        $supplierData = [
            'supplier_unique_code' => $supplier_unique_code,
            'supplier_profile_picture' => $supplierProfilePicture,
            'supplier_name' => $request->company_name,
            'supplier_mail' => $request->company_mail,
            'supplier_phone' => $request->company_phone,
            'supplier_gst' => $request->company_gst,
            'key_contact' => $request->key_contact,

            'company_revenue' => $request->company_revenue,
            'company_year_established' => $request->company_year_established,
            'social_media_links' => $request->social_media_links,
            'additional_notes' => $request->additional_notes,
            'supplier_address' => $request->company_address,
            'supplier_website' => $request->company_website,
            'supplier_payment_terms' => $request->supplier_payment_terms,
            'supplier_business_type' => $request->supplier_business_type,
            'supplier_delivery_terms' => $request->supplier_delivery_terms,
            'user_id' => $user_id,
        ];

        Supplier::create($supplierData);

        return response()->json(['status' => 200, 'message' => 'Supplier added successfully']);
    }

    public function supplieredit(Request $request)
    {
        $supplier = Supplier::find($request->id);
        if (!$supplier) {
            return response()->json(['status' => 404, 'message' => 'Supplier not found']);
        }
        return response()->json($supplier);
    }


    public function supplierview(Request $request)
    {
        $supplier = Supplier::find($request->id);

        if (!$supplier) {
            return response()->json(['status' => 404, 'message' => 'Supplier not found']);
        }

        return response()->json($supplier);
    }


    public function supplierupdate(Request $request)
    {
        $supplier = Supplier::find($request->supplier_id);
        if (!$supplier) {
            return response()->json(['status' => 404, 'message' => 'Supplier not found']);
        }

        // Validation Rules
        $request->validate([
            'company_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_name' => 'required|string|max:255',
            'company_mail' => 'required|email|max:255|unique:suppliers,supplier_mail,'.$supplier->id, // Unique except for current supplier
            'company_phone' => 'required|string|max:20',
            'company_gst' => 'nullable|string|max:255',
            'key_contact' => 'required|string|max:255',

            'supplier_payment_terms' => 'nullable|string|max:255',
            'supplier_business_type' => 'nullable|string|max:255',
            'supplier_delivery_terms' => 'nullable|string|max:255',
            'company_revenue' => 'nullable|string|max:255',
            'company_year_established' => 'nullable|string|max:4', // Assuming year is 4 digits
            'social_media_links' => 'nullable|string|max:255',
            'additional_notes' => 'nullable|string',
            'company_address' => 'nullable|string|max:255',
            'company_website' => 'nullable|string|max:255',
        ]);

        // Handle image upload if file exists, using Spatie Image
        $supplierProfilePicture = $supplier->supplier_profile_picture; // Default to existing

          if ($request->hasFile('company_profile_picture')) {
                $image = $request->file('company_profile_picture');
             $imageName = time() . '_' . $image->getClientOriginalName();
               $imagePath = $image->storeAs('public/supplier-logos', $imageName);

             // Get the full filesystem path
             $fullImagePath = Storage::path($imagePath);

            // Process the image using Spatie
             Image::load($fullImagePath)
                 ->fit(Fit::Crop, 300, 300)
                ->save();

          $supplierProfilePicture = Storage::url('supplier-logos/' . $imageName);

    // Delete the old image (optional - if you want to replace it)
       if ($supplier->supplier_profile_picture && Storage::exists(str_replace('storage/', 'public/', $supplier->supplier_profile_picture))) {
          Storage::delete(str_replace('storage/', 'public/',  $supplier->supplier_profile_picture));
          }
  }

       // Prepare data for update
           $supplierData = [
                   'supplier_profile_picture' => $supplierProfilePicture,
                   'supplier_name' => $request->company_name,
                 'supplier_mail' => $request->company_mail,
                       'supplier_phone' => $request->company_phone,
                          'supplier_gst' => $request->company_gst,
              'key_contact' => $request->key_contact,

       'company_revenue' => $request->company_revenue,
   'company_year_established' => $request->company_year_established,
                                               'social_media_links' => $request->social_media_links,
                    'additional_notes' => $request->additional_notes,
                    'supplier_address' => $request->company_address,
      'supplier_website' => $request->company_website,
            'supplier_payment_terms' => $request->supplier_payment_terms,
            'supplier_business_type' => $request->supplier_business_type,
            'supplier_delivery_terms' => $request->supplier_delivery_terms,

                   ];

           $supplier->update($supplierData);


        return response()->json(['status' => 200, 'message' => 'Supplier updated successfully']);
    }

    public function supplierdestroy(Request $request)
    {
        $supplier = Supplier::find($request->id);
        if (!$supplier) {
            return response()->json(['status' => 404, 'message' => 'Supplier not found']);
        }

        // Delete the company logo file
        if ($supplier->supplier_profile_picture && Storage::exists(str_replace('storage/', 'public/', $supplier->supplier_profile_picture))) {
            Storage::delete(str_replace('storage/', 'public/', $supplier->supplier_profile_picture));
        }

        $supplier->delete();
        return response()->json(['status' => 200, 'message' => 'Supplier deleted successfully']);
    }


    public function supplierexport()
    {
        return Excel::download(new SuppliersExport, 'suppliers_export_'.date('Y-m-d').'.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
