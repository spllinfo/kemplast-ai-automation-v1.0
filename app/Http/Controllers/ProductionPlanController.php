<?php

namespace App\Http\Controllers;

use App\Models\ProductionPlan;
use App\Models\Branch; // Assuming you want to link production plans to branches
use App\Models\User; // Assuming you want to link production plans to users
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Spatie\Image\Enums\Fit;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductionPlansExport;

class ProductionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function productionplans()
    {
        $branches = Branch::all(); // Fetch branches for dropdown if needed
        $users = User::all(); // Fetch users for dropdown
        return view('productionplans', ['branches' => $branches, 'users' => $users]);
    }

    public function productionplanfetchall(Request $request)
    {
        $query = ProductionPlan::orderBy('id','desc');
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

        $productionPlans = $query->get();

        $output = '';

        if ($productionPlans->count() > 0) {
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
                    <th scope="col">Plan Name</th>
                    <th scope="col">Start Date</th>
                    <th scope="col">End Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
             </thead>
             <tbody>';
            foreach ($productionPlans as $productionPlan) {
                $output .= '  <tr class="crm-contact companies-list">
                       <td class="companies-checkbox">
                            <input class="form-check-input" type="checkbox" id="checkbox_' . $productionPlan->id . '" value="' . $productionPlan->id . '" aria-label="...">
                       </td>
                       <td>
                            <div class="d-flex align-items-center gap-2">

                                <div>
                                    <a data-bs-toggle="offcanvas"
                                        href="#viewDataModal"
                                       role="button"
                                       aria-controls="viewDataModal"
                                       class=" ViewDataIcon"
                                       data-id="' . $productionPlan->id . '">' . $productionPlan->plan_name . '</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ' . $productionPlan->production_start_date . '
                        </td>
                        <td>
                            ' . $productionPlan->production_end_date . '
                        </td>
                        <td>
                            ' . $productionPlan->production_status . '
                        </td>

                        <td>
            <div class="btn-list">
            <a data-bs-toggle="offcanvas"
           href="#viewDataModal"
           role="button"
           aria-controls="viewDataModal"
           class="btn btn-sm btn-primary-light btn-icon ViewDataIcon"
           data-id="' . $productionPlan->id . '">
            <i class="ri-eye-line"></i>
        </a>

                <a href="#" id="' . $productionPlan->id . '" class="btn btn-sm btn-info-light btn-icon EditDataIcon" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-pencil-line"></i>
                </a>
                <button class="btn btn-sm btn-primary2-light btn-icon DeleteDataIcon"
                            id="'.$productionPlan->id.'">
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
                            <th scope="col">Plan Name</th>
                            <th scope="col">Start Date</th>
                            <th scope="col">End Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                </tr>
                        </tfoot>
                     </table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No production plans present in the database!</h1>';
        }
    }

    public function productionplanstore(Request $request)
    {
        $user_id = Auth::id();

        // Validation Rules
        $request->validate([
            'plan_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'plan_name' => 'required|string|max:255',
            'production_start_date' => 'required|date',
            'production_end_date' => 'nullable|date|after_or_equal:production_start_date',
            'production_status' => 'nullable|in:pending,in_progress,completed,on_hold,cancelled',
            'production_notes' => 'nullable|string',
            'production_cost' => 'nullable|numeric',
            'production_time' => 'nullable|integer',
            'production_quantity' => 'nullable|integer',
            'production_location' => 'nullable|string|max:255',
            'production_budget' => 'nullable|numeric',
            'production_priority' => 'nullable|integer|min:1|max:3',
            'production_type' => 'nullable|string|max:255',
            'production_description' => 'nullable|string',
            'branch_id' => 'nullable|exists:branches,id',
        ]);


        $unique_code = [
            'table' => 'production_plans',
            'field' => 'plan_unique_code',
            'length' => 8,
            'prefix' => 'PLAN'
        ];
        $plan_unique_code = IdGenerator::generate($unique_code);

        $planProfilePicture = null;  // Initialize

        // Handle image upload using Spatie Image
        if ($request->hasFile('plan_profile_picture')) {
            $image = $request->file('plan_profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/plan-logos', $imageName); // Store in public/storage

            // Use Storage facade to get the full path for Spatie Image
            $fullImagePath = Storage::path($imagePath);


            if (Storage::exists($imagePath)) {
                // Process image using Spatie
                Image::load($fullImagePath)
                    ->fit(Fit::Crop, 300, 300)
                    ->save();

                $planProfilePicture = 'storage/plan-logos/' . $imageName;
            }
        }

        $productionPlanData = $request->except('plan_profile_picture');
        $productionPlanData['plan_unique_code'] = $plan_unique_code;
        $productionPlanData['plan_profile_picture'] = $planProfilePicture;
        $productionPlanData['user_id'] = $user_id;
        $productionPlanData['branch_id'] = $request->branch_id ?? auth()->user()->branch_id; // Assign branch from request or logged in user's branch

        ProductionPlan::create($productionPlanData);

        return response()->json(['status' => 200, 'message' => 'Production plan added successfully']);
    }

    public function productionplanedit(Request $request)
    {
        $productionPlan = ProductionPlan::find($request->id);
        if (!$productionPlan) {
            return response()->json(['status' => 404, 'message' => 'Production plan not found']);
        }
        return response()->json($productionPlan);
    }


    public function productionplanview(Request $request)
    {
        $productionPlan = ProductionPlan::with(['branch:id,branch_name', 'user:id,name'])->find($request->id);

        if (!$productionPlan) {
            return response()->json(['status' => 404, 'message' => 'Production plan not found']);
        }

        return response()->json($productionPlan);
    }


    public function productionplanupdate(Request $request)
    {
        $productionPlan = ProductionPlan::find($request->production_plan_id);
        if (!$productionPlan) {
            return response()->json(['status' => 404, 'message' => 'Production plan not found']);
        }

        // Validation Rules
        $request->validate([
            'plan_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'plan_name' => 'required|string|max:255',
            'production_start_date' => 'required|date',
            'production_end_date' => 'nullable|date|after_or_equal:production_start_date',
            'production_status' => 'nullable|in:pending,in_progress,completed,on_hold,cancelled',
            'production_notes' => 'nullable|string',
            'production_cost' => 'nullable|numeric',
            'production_time' => 'nullable|integer',
            'production_quantity' => 'nullable|integer',
            'production_location' => 'nullable|string|max:255',
            'production_budget' => 'nullable|numeric',
            'production_priority' => 'nullable|integer|min:1|max:3',
            'production_type' => 'nullable|string|max:255',
            'production_description' => 'nullable|string',
            'branch_id' => 'nullable|exists:branches,id',
        ]);

        // Handle image upload if file exists, using Spatie Image
        $planProfilePicture = $productionPlan->plan_profile_picture; // Default to existing

          if ($request->hasFile('plan_profile_picture')) {
                $image = $request->file('plan_profile_picture');
             $imageName = time() . '_' . $image->getClientOriginalName();
               $imagePath = $image->storeAs('public/plan-logos', $imageName); // Store in public/storage

             // Get the full filesystem path
             $fullImagePath = Storage::path($imagePath);

            // Process the image using Spatie
             Image::load($fullImagePath)
                 ->fit(Fit::Crop, 300, 300)
                ->save();

          $planProfilePicture = 'storage/plan-logos/' . $imageName;

    // Delete the old image (optional - if you want to replace it)
       if ($productionPlan->plan_profile_picture && Storage::exists(str_replace('storage/', 'public/', $productionPlan->plan_profile_picture))) {
          Storage::delete(str_replace('storage/', 'public/',  $productionPlan->plan_profile_picture));
          }
  }

       // Prepare data for update
           $productionPlanData = $request->except('plan_profile_picture');
           $productionPlanData['plan_profile_picture'] = $planProfilePicture;

           $productionPlan->update($productionPlanData);

        return response()->json(['status' => 200, 'message' => 'Production plan updated successfully']);
    }

    public function productionplandestroy(Request $request)
    {
        $productionPlan = ProductionPlan::find($request->id);
        if (!$productionPlan) {
            return response()->json(['status' => 404, 'message' => 'Production plan not found']);
        }

        // Delete the production plan logo file
        if ($productionPlan->plan_profile_picture && Storage::exists(str_replace('storage/', 'public/', $productionPlan->plan_profile_picture))) {
            Storage::delete(str_replace('storage/', 'public/', $productionPlan->plan_profile_picture));
        }

        $productionPlan->delete();
        return response()->json(['status' => 200, 'message' => 'Production plan deleted successfully']);
    }

    public function productionplanexport()
    {
        return Excel::download(new ProductionPlansExport, 'production_plans_export_'.date('Y-m-d').'.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
]);
}
}
