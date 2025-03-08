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
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
        try {
            $validator = Validator::make($request->all(), [
                'machine_code' => 'required|string|max:20|unique:machines,machine_code',
                'name' => 'required|string|max:255',
                'model_number' => 'nullable|string|max:191',
                'serial_number' => 'nullable|string|max:191',
                'manufacturer' => 'nullable|string|max:191',
                'manufacturing_date' => 'nullable|date',
                'purchase_date' => 'nullable|date',
                'warranty_start_date' => 'nullable|date',
                'warranty_end_date' => 'nullable|date|after_or_equal:warranty_start_date',
                'purchase_price' => 'nullable|numeric|min:0|max:999999999999.99',
                'current_value' => 'nullable|numeric|min:0|max:999999999999.99',
                'branch_id' => 'required|exists:branches,id',
                'location' => 'nullable|string|max:191',
                'status' => 'required|in:active,maintenance,inactive,repair,scrapped',
                'capacity' => 'nullable|numeric|min:0|max:9999999999.99',
                'capacity_unit' => 'nullable|string|max:191',
                'power_consumption' => 'nullable|numeric|min:0|max:9999999999.99',
                'power_unit' => 'nullable|string|max:191',
                'operating_pressure' => 'nullable|numeric|min:0|max:9999999999.99',
                'pressure_unit' => 'nullable|string|max:191',
                'operating_temperature' => 'nullable|numeric|min:0|max:9999999999.99',
                'temperature_unit' => 'nullable|string|max:191',
                'specifications' => 'nullable|json',
                'maintenance_schedule' => 'nullable|json',
                'spare_parts' => 'nullable|json',
                'documents' => 'nullable|json',
                'notes' => 'nullable|string',
                'metadata' => 'nullable|json',
                'machine_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            // Handle file upload
            $machineProfilePicture = null;
            if ($request->hasFile('machine_profile_picture')) {
                $file = $request->file('machine_profile_picture');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/machines'), $fileName);
                $machineProfilePicture = 'uploads/machines/' . $fileName;
            }

            // Create machine
            $machine = Machine::create([
                'machine_code' => $request->machine_code,
                'name' => $request->name,
                'model_number' => $request->model_number,
                'serial_number' => $request->serial_number,
                'manufacturer' => $request->manufacturer,
                'manufacturing_date' => $request->manufacturing_date,
                'purchase_date' => $request->purchase_date,
                'warranty_start_date' => $request->warranty_start_date,
                'warranty_end_date' => $request->warranty_end_date,
                'purchase_price' => $request->purchase_price,
                'current_value' => $request->current_value,
                'branch_id' => $request->branch_id,
                'location' => $request->location,
                'status' => $request->status,
                'capacity' => $request->capacity,
                'capacity_unit' => $request->capacity_unit,
                'power_consumption' => $request->power_consumption,
                'power_unit' => $request->power_unit,
                'operating_pressure' => $request->operating_pressure,
                'pressure_unit' => $request->pressure_unit,
                'operating_temperature' => $request->operating_temperature,
                'temperature_unit' => $request->temperature_unit,
                'specifications' => $request->specifications,
                'maintenance_schedule' => $request->maintenance_schedule,
                'spare_parts' => $request->spare_parts,
                'documents' => $request->documents,
                'notes' => $request->notes,
                'metadata' => $request->metadata,
                'machine_profile_picture' => $machineProfilePicture
            ]);

            DB::commit();

            return response()->json([
                'status' => 200,
                'message' => 'Machine added successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error in MachineController@machinestore: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while adding the machine'
            ], 500);
        }
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

    public function getData(Request $request)
    {
        try {
            $query = Machine::with(['branch'])
                ->select('machines.*');

            if ($request->filled('date_filter')) {
                $query->filterByDate($request->date_filter);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('machine_details', function ($row) {
                    $logo = $row->machine_profile_picture ? $row->machine_profile_picture : asset('assets/images/company-logos/8.png');
                    return '
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-sm me-2">
                                <img src="' . $logo . '" alt="Machine Logo">
                            </span>
                            <div>
                                <h6 class="mb-0">' . $row->name . '</h6>
                                <small class="text-muted">' . $row->machine_code . '</small>
                            </div>
                        </div>';
                })
                ->addColumn('technical_details', function ($row) {
                    return '
                        <div>
                            <div><small class="text-muted">Model:</small> ' . ($row->model_number ?? 'N/A') . '</div>
                            <div><small class="text-muted">Capacity:</small> ' .
                                ($row->capacity ? $row->capacity . ' ' . $row->capacity_unit : 'N/A') . '</div>
                        </div>';
                })
                ->addColumn('location_details', function ($row) {
                    return '
                        <div>
                            <div><small class="text-muted">Branch:</small> ' . ($row->branch ? $row->branch->branch_name : 'N/A') . '</div>
                            <div><small class="text-muted">Location:</small> ' . ($row->location ?? 'N/A') . '</div>
                        </div>';
                })
                ->addColumn('status', function ($row) {
                    $colors = [
                        'active' => 'success',
                        'maintenance' => 'warning',
                        'inactive' => 'danger',
                        'repair' => 'info',
                        'scrapped' => 'secondary'
                    ];
                    $color = $colors[$row->status] ?? 'primary';
                    return '<span class="badge bg-' . $color . '">' . ucfirst($row->status) . '</span>';
                })
                ->addColumn('warranty', function ($row) {
                    if (!$row->warranty_end_date) {
                        return '<span class="badge bg-secondary">No Warranty</span>';
                    }
                    $endDate = \Carbon\Carbon::parse($row->warranty_end_date);
                    $color = $endDate->isFuture() ? 'success' : 'danger';
                    $status = $endDate->isFuture() ? 'Active' : 'Expired';
                    return '<span class="badge bg-' . $color . '">' . $status . '</span>';
                })
                ->addColumn('action', function ($row) {
                    return '<div class="btn-list">
                            <a data-bs-toggle="offcanvas"
                               href="#viewMachineDataModal"
                               role="button"
                               aria-controls="viewMachineDataModal"
                               class="btn btn-sm btn-primary-light btn-icon ViewDataIcon"
                               id="' . $row->id . '"
                               data-tippy-content="View Details">
                                <i class="ri-eye-line"></i>
                            </a>
                            <a href="#"
                               id="' . $row->id . '"
                               class="btn btn-sm btn-info-light btn-icon EditDataIcon"
                               data-bs-toggle="modal"
                               data-bs-target="#editMachineDataModal"
                               data-tippy-content="Edit Machine">
                                <i class="ri-pencil-line"></i>
                            </a>
                            <button class="btn btn-sm btn-danger-light btn-icon DeleteDataIcon"
                                    id="' . $row->id . '"
                                    data-tippy-content="Delete Machine">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>';
                })
                ->rawColumns(['machine_details', 'technical_details', 'location_details', 'status', 'warranty', 'action'])
                ->make(true);
        } catch (\Exception $e) {
            \Log::error('Error in MachineController@getData: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch machines data'], 500);
        }
    }
}
