<?php

namespace App\Http\Controllers;

use App\Models\JobPart;
use App\Models\Branch;
use App\Models\Customer;
use App\Models\Machine;
use App\Models\Part;
use App\Models\ProductionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Spatie\Image\Enums\Fit;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\JobPartsExport;

class JobPartController extends Controller
{
    /**
     * Display a listing of the Job Parts.
     */
    public function jobparts()
    {
        $branches = Branch::all();
        $customers = Customer::all();
        $machines = Machine::all();
        $productionPlans = ProductionPlan::all();
        $parts = Part::all();
        return view('jobparts', [
            'branches' => $branches,
            'customers' => $customers,
            'machines' => $machines,
            'productionPlans' => $productionPlans,
            'parts' =>$parts,
        ]);
    }

    public function jobpartfetchall(Request $request)
    {
        $query = JobPart::with(['branch', 'customer', 'machine', 'plan', 'part'])->orderBy('id', 'desc');
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

        $jobParts = $query->get();

        $output = '';

        if ($jobParts->count() > 0) {
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
                    <th scope="col">Part Name</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
             </thead>
             <tbody>';
            foreach ($jobParts as $jobPart) {
                $output .= '  <tr class="crm-contact companies-list">
                       <td class="companies-checkbox">
                            <input class="form-check-input" type="checkbox" id="checkbox_' . $jobPart->id . '" value="' . $jobPart->id . '" aria-label="...">
                       </td>
                       <td>
                            <div class="d-flex align-items-center gap-2">
                                <div>
                                    <a data-bs-toggle="offcanvas"
                                        href="#viewDataModal"
                                       role="button"
                                       aria-controls="viewDataModal"
                                       class=" ViewDataIcon"
                                       data-id="' . $jobPart->id . '">' . $jobPart->job_part_name . '</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ' . ($jobPart->customer ? $jobPart->customer->customer_name : 'N/A') . '
                        </td>
                        <td>
                            ' . $jobPart->job_status . '
                        </td>

                        <td>
            <div class="btn-list">
            <a data-bs-toggle="offcanvas"
           href="#viewDataModal"
           role="button"
           aria-controls="viewDataModal"
           class="btn btn-sm btn-primary-light btn-icon ViewDataIcon"
           data-id="' . $jobPart->id . '">
            <i class="ri-eye-line"></i>
        </a>

                <a href="#" id="' . $jobPart->id . '" class="btn btn-sm btn-info-light btn-icon EditDataIcon" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-pencil-line"></i>
                </a>
                <button class="btn btn-sm btn-primary2-light btn-icon DeleteDataIcon"
                            id="'.$jobPart->id.'">
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
                            <th scope="col">Part Name</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                </tr>
                        </tfoot>
                     </table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No job parts present in the database!</h1>';
        }
    }

    public function jobpartstore(Request $request)
    {
        $user_id = Auth::id();

        // Validation Rules - customize as needed
        $request->validate([
            'job_part_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'job_part_name' => 'required|string|max:255',
            'job_part_model' => 'nullable|string|max:255',
            'job_part_customer_name' => 'nullable|string|max:255',
            'hsn_no' => 'nullable|string|max:50',
            'job_part_length' => 'nullable|numeric',
            'job_part_width' => 'nullable|numeric',
            'job_part_height' => 'nullable|numeric',
            'job_part_thickness' => 'nullable|numeric',
            'job_part_ld_ratio' => 'nullable|numeric',
            'job_part_lld_ratio' => 'nullable|numeric',
            'job_part_hd_ratio' => 'nullable|numeric',
            'job_part_rd_ratio' => 'nullable|numeric',
            'job_part_no_ups' => 'nullable|integer',
            'job_part_weight' => 'nullable|numeric',
            'job_part_no_sealing_type' => 'nullable|string|max:255',
            'job_printing_status' => 'nullable|boolean',
            'job_printing_colour' => 'nullable|string|max:255',
            'job_bundle_qty' => 'nullable|integer',
            'job_part_category' => 'nullable|string|max:255',
            'job_part_description' => 'nullable|string',
            'job_part_price' => 'nullable|numeric',
            'job_part_quantity' => 'nullable|integer',
            'job_bst' => 'nullable|boolean',
            'job_lain' => 'nullable|boolean',
            'job_flat' => 'nullable|boolean',
            'job_gazzate' => 'nullable|boolean',
            'job_bio' => 'nullable|boolean',
            'job_normal' => 'nullable|boolean',
            'job_milky' => 'nullable|boolean',
            'job_roto_printing' => 'nullable|boolean',
            'job_flexo_printing' => 'nullable|boolean',
            'job_sideseal' => 'nullable|boolean',
            'job_recycle_logo' => 'nullable|boolean',
            'job_part_status' => 'nullable|in:active,inactive,pending,completed', // Example statuses
            'job_part_documents' => 'nullable|string', // Consider different handling for documents
            'job_part_tags' => 'nullable|string',
            'branch_id' => 'nullable|exists:branches,id',
            'customer_id' => 'nullable|exists:customers,id',
            'machine_id' => 'nullable|exists:machines,id',
            'plan_id' => 'nullable|exists:production_plans,id',
            'job_status' => 'nullable|in:pending,in_progress,completed,on_hold,cancelled', // Example statuses
            'machine_type' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255', // Assuming you might want to set this directly
        ]);

        $job_unique_code_config = [
            'table' => 'job_parts',
            'field' => 'job_unique_code',
            'length' => 8,
            'prefix' => 'JOB'
        ];
        $job_unique_code = IdGenerator::generate($job_unique_code_config);

        $job_part_unique_code_config = [
            'table' => 'job_parts',
            'field' => 'job_part_unique_code',
            'length' => 8,
            'prefix' => 'PART'
        ];
        $job_part_unique_code = IdGenerator::generate($job_part_unique_code_config);


        $jobPartProfilePicture = null;

        if ($request->hasFile('job_part_profile_picture')) {
            $image = $request->file('job_part_profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/job-part-logos', $imageName);

            $fullImagePath = Storage::path($imagePath);


            if (Storage::exists($imagePath)) {
                Image::load($fullImagePath)
                    ->fit(Fit::Crop, 300, 300)
                    ->save();
                $jobPartProfilePicture = 'storage/job-part-logos/' . $imageName;
            }
        }

        $jobPartData = $request->except('job_part_profile_picture');
        $jobPartData['job_unique_code'] = $job_unique_code;
        $jobPartData['job_part_unique_code'] = $job_part_unique_code;
        $jobPartData['job_part_profile_picture'] = $jobPartProfilePicture;
        $jobPartData['user_id'] = $user_id;

        JobPart::create($jobPartData);

        return response()->json(['status' => 200, 'message' => 'Job Part added successfully']);
    }

    public function jobpartedit(Request $request)
    {
        $jobPart = JobPart::find($request->id);
        if (!$jobPart) {
            return response()->json(['status' => 404, 'message' => 'Job Part not found']);
        }
        return response()->json($jobPart);
    }

    public function jobpartview(Request $request)
    {
        $jobPart = JobPart::with(['branch', 'customer', 'machine', 'plan', 'user'])->find($request->id);

        if (!$jobPart) {
            return response()->json(['status' => 404, 'message' => 'Job Part not found']);
        }

        return response()->json($jobPart);
    }

    public function jobpartupdate(Request $request)
    {
        $jobPart = JobPart::find($request->production_plan_id);
        if (!$jobPart) {
            return response()->json(['status' => 404, 'message' => 'Job Part not found']);
        }

        // Validation Rules - customize as needed (similar to store validation)
        $request->validate([
            'job_part_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'job_part_name' => 'required|string|max:255',
            'job_part_model' => 'nullable|string|max:255',
            'job_part_customer_name' => 'nullable|string|max:255',
            'hsn_no' => 'nullable|string|max:50',
            'job_part_length' => 'nullable|numeric',
            'job_part_width' => 'nullable|numeric',
            'job_part_height' => 'nullable|numeric',
            'job_part_thickness' => 'nullable|numeric',
             'job_part_ld_ratio' => 'nullable|numeric',
            'job_part_lld_ratio' => 'nullable|numeric',
            'job_part_hd_ratio' => 'nullable|numeric',
            'job_part_rd_ratio' => 'nullable|numeric',
            'job_part_no_ups' => 'nullable|integer',
            'job_part_weight' => 'nullable|numeric',
            'job_part_no_sealing_type' => 'nullable|string|max:255',
            'job_printing_status' => 'nullable|boolean',
            'job_printing_colour' => 'nullable|string|max:255',
            'job_bundle_qty' => 'nullable|integer',
            'job_part_category' => 'nullable|string|max:255',
            'job_part_description' => 'nullable|string',
            'job_part_price' => 'nullable|numeric',
            'job_part_quantity' => 'nullable|integer',
            'job_bst' => 'nullable|boolean',
            'job_lain' => 'nullable|boolean',
            'job_flat' => 'nullable|boolean',
            'job_gazzate' => 'nullable|boolean',
            'job_bio' => 'nullable|boolean',
            'job_normal' => 'nullable|boolean',
            'job_milky' => 'nullable|boolean',
            'job_roto_printing' => 'nullable|boolean',
            'job_flexo_printing' => 'nullable|boolean',
            'job_sideseal' => 'nullable|boolean',
            'job_recycle_logo' => 'nullable|boolean',
            'job_part_status' => 'nullable|in:active,inactive,pending,completed', // Example statuses
            'job_part_documents' => 'nullable|string', // Consider different handling for documents
            'job_part_tags' => 'nullable|string',
            'branch_id' => 'nullable|exists:branches,id',
            'customer_id' => 'nullable|exists:customers,id',
            'machine_id' => 'nullable|exists:machines,id',
            'plan_id' => 'nullable|exists:production_plans,id',
            'job_status' => 'nullable|in:pending,in_progress,completed,on_hold,cancelled', // Example statuses
            'machine_type' => 'nullable|string|max:255',
            'branch_name' => 'nullable|string|max:255', // Assuming you might want to set this directly
        ]);


        $jobPartProfilePicture = $jobPart->job_part_profile_picture;

        if ($request->hasFile('job_part_profile_picture')) {
            $image = $request->file('job_part_profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/job-part-logos', $imageName);

            $fullImagePath = Storage::path($imagePath);

            if (Storage::exists($imagePath)) {
                Image::load($fullImagePath)
                    ->fit(Fit::Crop, 300, 300)
                    ->save();
                $jobPartProfilePicture = 'storage/job-part-logos/' . $imageName;

                if ($jobPart->job_part_profile_picture && Storage::exists(str_replace('storage/', 'public/', $jobPart->job_part_profile_picture))) {
                    Storage::delete(str_replace('storage/', 'public/',  $jobPart->job_part_profile_picture));
                }
            }
        }

        $jobPartData = $request->except('job_part_profile_picture');
        $jobPartData['job_part_profile_picture'] = $jobPartProfilePicture;

        $jobPart->update($jobPartData);

        return response()->json(['status' => 200, 'message' => 'Job Part updated successfully']);
    }

    public function jobpartdestroy(Request $request)
    {
        $jobPart = JobPart::find($request->id);
        if (!$jobPart) {
            return response()->json(['status' => 404, 'message' => 'Job Part not found']);
        }

        if ($jobPart->job_part_profile_picture && Storage::exists(str_replace('storage/', 'public/', $jobPart->job_part_profile_picture))) {
            Storage::delete(str_replace('storage/', 'public/', $jobPart->job_part_profile_picture));
        }

        $jobPart->delete();
        return response()->json(['status' => 200, 'message' => 'Job Part deleted successfully']);
    }


    public function jobpartexport()
    {
        return Excel::download(new JobPartsExport, 'job_parts_export_' . date('Y-m-d') . '.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}