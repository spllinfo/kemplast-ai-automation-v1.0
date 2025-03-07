<?php

namespace App\Http\Controllers;

use App\Models\Branch; // Assuming your Branch model is in App\Models\Branch
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Spatie\Image\Enums\Fit;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BranchesExport; // Create BranchesExport later

class BranchController extends Controller
{
    /**
     * Display a listing of the resource (branches view).
     */
    public function branches()
    {
        return view('branches'); // Assuming you have a branches.blade.php view
    }

    public function branchfetchall(Request $request)
    {
        $query = Branch::orderBy('id','desc');
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

        $branches = $query->get();

        $output = '';

        if ($branches->count() > 0) {
            $output .= '<table id="data_fetch_table" class="table table-hover table-striped">
             <thead>
               <tr>
                    <th scope="col">
                        <input class="form-check-input check-all"
                               type="checkbox"
                               id="checkboxNoLabel"
                               value=""
                               aria-label="...">
                    </th>
                    <th scope="col">Branch Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
             </thead>
             <tbody>';
            foreach ($branches as $branch) {
                $output .= '  <tr class="crm-contact companies-list">
                       <td class="companies-checkbox">
                            <input class="form-check-input" type="checkbox" id="checkbox_' . $branch->id . '" value="' . $branch->id . '" aria-label="...">
                       </td>
                       <td>
                            <div class="d-flex align-items-center gap-2">

                                <div>
                                    <a data-bs-toggle="offcanvas"
                                        href="#viewDataModal"
                                       role="button"
                                       aria-controls="viewDataModal"
                                       class=" ViewDataIcon"
                                       data-id="' . $branch->id . '">' . $branch->branch_name . '</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center flex-wrap gap-1">
                                <span class="badge bg-primary1-transparent">'.$branch->branch_type.'</span>
                            </div>
                        </td>
                        <td>
                            <span class="d-block mb-0"><i class="ri-mail-line fs-14 text-muted d-inline-block me-2 align-middle"></i>'.$branch->branch_email.'</span>
                        </td>
                        <td>
                            <span class="d-block"><i class="ri-phone-line fs-14 text-muted d-inline-block me-2 align-middle"></i>'.$branch->branch_phone.'</span>
                        </td>
                      

                          <td>
                        <div class="d-flex align-items-center gap-2">
                                <div class="lh-1">
                                    <span class="avatar avatar-rounded avatar-sm">
                                        <img src="'.$branch->branch_profile_picture.'" alt="Branch Logo" onerror="this.src=\''.asset('assets/images/faces/5.jpg').'\'">
                                                </span>
                                                </div>
                                                <div>
                                                <span class="d-block fw-medium">' . $branch->branch_contact_number . '</span>

                                                </div>
                                                </div>
                                        </td>

                        <td>
                           '. ($branch->branch_status ? '<span class="badge bg-success-transparent">Active</span>' : '<span class="badge bg-danger-transparent">Inactive</span>') .'
                        </td>
                        <td>
            <div class="btn-list">
            <a data-bs-toggle="offcanvas"
           href="#viewDataModal"
           role="button"
           aria-controls="viewDataModal"
           class="btn btn-sm btn-primary-light btn-icon ViewDataIcon"
           data-id="' . $branch->id . '">
            <i class="ri-eye-line"></i>
        </a>

                <a href="#" id="' . $branch->id . '" class="btn btn-sm btn-info-light btn-icon EditDataIcon" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-pencil-line"></i>
                </a>
                <button class="btn btn-sm btn-primary2-light btn-icon DeleteDataIcon"
                            id="'.$branch->id.'">
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
                    <th scope="col">Branch Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                        </tfoot>
                     </table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No branches present in the database!</h1>';
        }
    }

    public function branchstore(Request $request)
    {
        $user_id = Auth::id();

        // Validation Rules
        $request->validate([
            'branch_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'branch_name' => 'required|string|max:255',
            'branch_email' => 'nullable|email|max:255|unique:branches,branch_email',
            'branch_phone' => 'nullable|string|max:20',
            'branch_revenue' => 'nullable|numeric',
            'branch_address' => 'nullable|string|max:255',
            'branch_city' => 'nullable|string|max:255',
            'branch_opening_time' => 'nullable|date_format:H:i', // Assuming time format HH:MM
            'branch_closing_time' => 'nullable|date_format:H:i',
            'branch_contact_number' => 'nullable|string|max:20',
            'social_media_links' => 'nullable|string|max:255',
            'additional_notes' => 'nullable|string',
            'branch_type' => 'nullable|string|max:255',
            'branch_description' => 'nullable|string',
            'branch_map' => 'nullable|string', // Or consider validating as URL if it's a URL
            'branch_status' => 'nullable|boolean', // Validate branch_status as boolean
        ]);


        $unique_code = [
            'table' => 'branches',
            'field' => 'branch_unique_code',
            'length' => 8,
            'prefix' => 'BR'
        ];
        $branch_unique_code = IdGenerator::generate($unique_code);

        $branchProfilePicture = null;  // Initialize

        // Handle image upload using Spatie Image
        if ($request->hasFile('branch_profile_picture')) {
            $image = $request->file('branch_profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/branch-logos', $imageName); // Store in public/storage

            // Use Storage facade to get the full path for Spatie Image
            $fullImagePath = Storage::path($imagePath);


            if (Storage::exists($imagePath)) {
                // Process image using Spatie
                Image::load($fullImagePath)
                    ->fit(Fit::Crop, 300, 300)
                    ->save();

                $branchProfilePicture = 'storage/branch-logos/' . $imageName;
            }
        }

        $branchData = [
            'branch_unique_code' => $branch_unique_code,
            'branch_profile_picture' => $branchProfilePicture,
            'branch_name' => $request->branch_name,
            'branch_type' => $request->branch_type,
            'branch_email' => $request->branch_email,
            'branch_phone' => $request->branch_phone,
            'branch_revenue' => $request->branch_revenue,
            'branch_address' => $request->branch_address,
            'branch_city' => $request->branch_city,
            'branch_opening_time' => $request->branch_opening_time,
            'branch_closing_time' => $request->branch_closing_time,
            'branch_contact_number' => $request->branch_contact_number,
            'social_media_links' => $request->social_media_links,
            'additional_notes' => $request->additional_notes,
            'branch_description' => $request->branch_description,
            'branch_map' => $request->branch_map,
            'branch_status' => $request->branch_status ? 1 : 0, // Convert boolean to integer for database
            'user_id' => $user_id,
        ];

        Branch::create($branchData);

        return response()->json(['status' => 200, 'message' => 'Branch added successfully']);
    }

    public function branchedit(Request $request)
    {
        $branch = Branch::find($request->id);
        if (!$branch) {
            return response()->json(['status' => 404, 'message' => 'Branch not found']);
        }
        return response()->json($branch);
    }


    public function branchview(Request $request)
    {
        $branch = Branch::find($request->id);

        if (!$branch) {
            return response()->json(['status' => 404, 'message' => 'Branch not found']);
        }

        return response()->json($branch);
    }


    public function branchupdate(Request $request)
    {
        $branch = Branch::find($request->branch_id);
        if (!$branch) {
            return response()->json(['status' => 404, 'message' => 'Branch not found']);
        }

        // Validation Rules
        $request->validate([
            'branch_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'branch_name' => 'required|string|max:255',
            'branch_email' => 'nullable|email|max:255|unique:branches,branch_email,'.$branch->id, // Unique except current branch
            'branch_phone' => 'nullable|string|max:20',
            'branch_revenue' => 'nullable|numeric',
            'branch_address' => 'nullable|string|max:255',
            'branch_city' => 'nullable|string|max:255',
            'branch_opening_time' => 'nullable|date_format:H:i', // Assuming time format HH:MM
            'branch_closing_time' => 'nullable|date_format:H:i',
            'branch_contact_number' => 'nullable|string|max:20',
            'social_media_links' => 'nullable|string|max:255',
            'additional_notes' => 'nullable|string',
            'branch_type' => 'nullable|string|max:255',
            'branch_description' => 'nullable|string',
            'branch_map' => 'nullable|string', // Or consider validating as URL if it's a URL
            'branch_status' => 'nullable|boolean', // Validate branch_status as boolean
        ]);

        // Handle image upload if file exists, using Spatie Image
        $branchProfilePicture = $branch->branch_profile_picture; // Default to existing

          if ($request->hasFile('branch_profile_picture')) {
                $image = $request->file('branch_profile_picture');
             $imageName = time() . '_' . $image->getClientOriginalName();
               $imagePath = $image->storeAs('public/branch-logos', $imageName); // Store in public/storage

             // Get the full filesystem path
             $fullImagePath = Storage::path($imagePath);

            // Process the image using Spatie
             Image::load($fullImagePath)
                 ->fit(Fit::Crop, 300, 300)
                ->save();

          $branchProfilePicture = 'storage/branch-logos/' . $imageName;

    // Delete the old image (optional - if you want to replace it)
       if ($branch->branch_profile_picture && Storage::exists(str_replace('storage/', 'public/', $branch->branch_profile_picture))) {
          Storage::delete(str_replace('storage/', 'public/',  $branch->branch_profile_picture));
          }
  }

       // Prepare data for update
           $branchData = [
                   'branch_profile_picture' => $branchProfilePicture,
                   'branch_name' => $request->branch_name,
                   'branch_type' => $request->branch_type,
                   'branch_email' => $request->branch_email,
                   'branch_phone' => $request->branch_phone,
                   'branch_revenue' => $request->branch_revenue,
                   'branch_address' => $request->branch_address,
                   'branch_city' => $request->branch_city,
                   'branch_opening_time' => $request->branch_opening_time,
                   'branch_closing_time' => $request->branch_closing_time,
                   'branch_contact_number' => $request->branch_contact_number,
                   'social_media_links' => $request->social_media_links,
                   'additional_notes' => $request->additional_notes,
                   'branch_description' => $request->branch_description,
                   'branch_map' => $request->branch_map,
                   'branch_status' => $request->branch_status ? 1 : 0,
               ];

           $branch->update($branchData);

        return response()->json(['status' => 200, 'message' => 'Branch updated successfully']);
    }


    public function branchdestroy(Request $request)
    {
        $branch = Branch::find($request->id);
        if (!$branch) {
            return response()->json(['status' => 404, 'message' => 'Branch not found']);
        }

        // Delete the company logo file
        if ($branch->branch_profile_picture && Storage::exists(str_replace('storage/', 'public/', $branch->branch_profile_picture))) {
            Storage::delete(str_replace('storage/', 'public/', $branch->branch_profile_picture));
        }

        $branch->delete();
        return response()->json(['status' => 200, 'message' => 'Branch deleted successfully']);
    }


    public function branchexport()
    {
        return Excel::download(new BranchesExport, 'branches_export_'.date('Y-m-d').'.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
