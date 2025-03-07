<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Branch; // Assuming you will need branches for machine assignment
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Spatie\Image\Enums\Fit;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MachinesExport;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function machines()
    {
        $branches = Branch::all(); // Fetch branches to populate dropdowns in the view if needed
        return view('machines', ['branches' => $branches]);
    }

    public function machinefetchall(Request $request)
    {
        $query = Machine::orderBy('id','desc');
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

        $machines = $query->get();

        $output = '';

        if ($machines->count() > 0) {
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
                    <th scope="col">Machine Name</th>
                    <th scope="col">Branch</th>
                    <th scope="col">Type</th>
                    <th scope="col">Capacity</th>
                    <th scope="col">Actions</th>
                </tr>
             </thead>
             <tbody>';
            foreach ($machines as $machine) {
                $output .= '  <tr class="crm-contact companies-list">
                       <td class="companies-checkbox">
                            <input class="form-check-input" type="checkbox" id="checkbox_' . $machine->id . '" value="' . $machine->id . '" aria-label="...">
                       </td>
                       <td>
                            <div class="d-flex align-items-center gap-2">

                                <div>
                                    <a data-bs-toggle="offcanvas"
                                        href="#viewDataModal"
                                       role="button"
                                       aria-controls="viewDataModal"
                                       class=" ViewDataIcon"
                                       data-id="' . $machine->id . '">' . $machine->machine_name . '</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ' . ($machine->branch ? $machine->branch->branch_name : 'N/A') . '
                        </td>
                        <td>
                            ' . $machine->machine_type . '
                        </td>
                        <td>
                            ' . $machine->machine_capacity . '
                        </td>

                        <td>
            <div class="btn-list">
            <a data-bs-toggle="offcanvas"
           href="#viewDataModal"
           role="button"
           aria-controls="viewDataModal"
           class="btn btn-sm btn-primary-light btn-icon ViewDataIcon"
           data-id="' . $machine->id . '">
            <i class="ri-eye-line"></i>
        </a>

                <a href="#" id="' . $machine->id . '" class="btn btn-sm btn-info-light btn-icon EditDataIcon" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-pencil-line"></i>
                </a>
                <button class="btn btn-sm btn-primary2-light btn-icon DeleteDataIcon"
                            id="'.$machine->id.'">
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
                            <th scope="col">Machine Name</th>
                            <th scope="col">Branch</th>
                            <th scope="col">Type</th>
                            <th scope="col">Capacity</th>
                            <th scope="col">Actions</th>
                </tr>
                        </tfoot>
                     </table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No machines present in the database!</h1>';
        }
    }

    public function machinestore(Request $request)
    {
        $user_id = Auth::id();

        // Validation Rules
        $request->validate([
            'machine_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'machine_name' => 'required|string|max:255',
            'machine_type' => 'nullable|string|max:255',
            'machine_capacity' => 'nullable|integer',
            'branch_id' => 'nullable|exists:branches,id', // Ensure branch_id exists in branches table
        ]);


        $unique_code = [
            'table' => 'machines',
            'field' => 'machine_unique_code',
            'length' => 8,
            'prefix' => 'MAC'
        ];
        $machine_unique_code = IdGenerator::generate($unique_code);

        $machineProfilePicture = null;  // Initialize

        // Handle image upload using Spatie Image
        if ($request->hasFile('machine_profile_picture')) {
            $image = $request->file('machine_profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/machine-logos', $imageName); // Store in public/storage

            // Use Storage facade to get the full path for Spatie Image
            $fullImagePath = Storage::path($imagePath);


            if (Storage::exists($imagePath)) {
                // Process image using Spatie
                Image::load($fullImagePath)
                    ->fit(Fit::Crop, 300, 300)
                    ->save();

                $machineProfilePicture = 'storage/machine-logos/' . $imageName;
            }
        }

        $machineData = [
            'machine_unique_code' => $machine_unique_code,
            'machine_profile_picture' => $machineProfilePicture,
            'machine_name' => $request->machine_name,
            'machine_type' => $request->machine_type,
            'machine_capacity' => $request->machine_capacity,
            'branch_id' => $request->branch_id,
            'user_id' => $user_id,
        ];

        Machine::create($machineData);

        return response()->json(['status' => 200, 'message' => 'Machine added successfully']);
    }

    public function machineedit(Request $request)
    {
        $machine = Machine::find($request->id);
        if (!$machine) {
            return response()->json(['status' => 404, 'message' => 'Machine not found']);
        }
        return response()->json($machine);
    }


    public function machineview(Request $request)
    {
        $machine = Machine::find($request->id);

        if (!$machine) {
            return response()->json(['status' => 404, 'message' => 'Machine not found']);
        }

        return response()->json($machine);
    }


    public function machineupdate(Request $request)
    {
        $machine = Machine::find($request->machine_id);
        if (!$machine) {
            return response()->json(['status' => 404, 'message' => 'Machine not found']);
        }

        // Validation Rules
        $request->validate([
            'machine_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'machine_name' => 'required|string|max:255',
            'machine_type' => 'nullable|string|max:255',
            'machine_capacity' => 'nullable|integer',
            'branch_id' => 'nullable|exists:branches,id', // Ensure branch_id exists in branches table
        ]);

        // Handle image upload if file exists, using Spatie Image
        $machineProfilePicture = $machine->machine_profile_picture; // Default to existing

          if ($request->hasFile('machine_profile_picture')) {
                $image = $request->file('machine_profile_picture');
             $imageName = time() . '_' . $image->getClientOriginalName();
               $imagePath = $image->storeAs('public/machine-logos', $imageName); // Store in public/storage

             // Get the full filesystem path
             $fullImagePath = Storage::path($imagePath);

            // Process the image using Spatie
             Image::load($fullImagePath)
                 ->fit(Fit::Crop, 300, 300)
                ->save();

          $machineProfilePicture = 'storage/machine-logos/' . $imageName;

    // Delete the old image (optional - if you want to replace it)
       if ($machine->machine_profile_picture && Storage::exists(str_replace('storage/', 'public/', $machine->machine_profile_picture))) {
          Storage::delete(str_replace('storage/', 'public/',  $machine->machine_profile_picture));
          }
  }

       // Prepare data for update
           $machineData = [
                   'machine_profile_picture' => $machineProfilePicture,
                   'machine_name' => $request->machine_name,
                   'machine_type' => $request->machine_type,
                   'machine_capacity' => $request->machine_capacity,
                   'branch_id' => $request->branch_id,
                   ];

           $machine->update($machineData);

        return response()->json(['status' => 200, 'message' => 'Machine updated successfully']);
    }

    public function machinedestroy(Request $request)
    {
        $machine = Machine::find($request->id);
        if (!$machine) {
            return response()->json(['status' => 404, 'message' => 'Machine not found']);
        }

        // Delete the company logo file
        if ($machine->machine_profile_picture && Storage::exists(str_replace('storage/', 'public/', $machine->machine_profile_picture))) {
            Storage::delete(str_replace('storage/', 'public/', $machine->machine_profile_picture));
        }

        $machine->delete();
        return response()->json(['status' => 200, 'message' => 'Machine deleted successfully']);
    }

    public function machineexport()
    {
        return Excel::download(new MachinesExport, 'machines_export_'.date('Y-m-d').'.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
