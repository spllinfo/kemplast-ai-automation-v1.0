<?php

namespace App\Http\Controllers;

use App\Models\MaterialStock;
use App\Models\Branch; // Assuming you want to link material stocks to branches
use App\Models\Supplier; // Assuming you want to link material stocks to suppliers
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Spatie\Image\Enums\Fit;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MaterialStocksExport;

class MaterialStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function materialstocks()
    {
        $branches = Branch::all(); // Fetch branches for dropdown if needed
        $suppliers = Supplier::all(); // Fetch suppliers for dropdown
        return view('materialstocks', ['branches' => $branches, 'suppliers' => $suppliers]);
    }

    public function materialstockfetchall(Request $request)
    {
        $query = MaterialStock::orderBy('id','desc');
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

        $materialStocks = $query->get();

        $output = '';

        if ($materialStocks->count() > 0) {
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
                    <th scope="col">Material Name</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Category</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
             </thead>
             <tbody>';
            foreach ($materialStocks as $materialStock) {
                $output .= '  <tr class="crm-contact companies-list">
                       <td class="companies-checkbox">
                            <input class="form-check-input" type="checkbox" id="checkbox_' . $materialStock->id . '" value="' . $materialStock->id . '" aria-label="...">
                       </td>
                       <td>
                            <div class="d-flex align-items-center gap-2">

                                <div>
                                    <a data-bs-toggle="offcanvas"
                                        href="#viewDataModal"
                                       role="button"
                                       aria-controls="viewDataModal"
                                       class=" ViewDataIcon"
                                       data-id="' . $materialStock->id . '">' . $materialStock->material_name . '</a>
                                </div>
                            </div>
                        </td>
                        <td>
                            ' . $materialStock->material_grade . '
                        </td>
                        <td>
                            ' . $materialStock->material_category . '
                        </td>
                        <td>
                            ' . $materialStock->material_quantity . ' ' . $materialStock->material_UOM . '
                        </td>
                        <td>
                            ' . $materialStock->material_price . '
                        </td>

                        <td>
            <div class="btn-list">
            <a data-bs-toggle="offcanvas"
           href="#viewDataModal"
           role="button"
           aria-controls="viewDataModal"
           class="btn btn-sm btn-primary-light btn-icon ViewDataIcon"
           data-id="' . $materialStock->id . '">
            <i class="ri-eye-line"></i>
        </a>

                <a href="#" id="' . $materialStock->id . '" class="btn btn-sm btn-info-light btn-icon EditDataIcon" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-pencil-line"></i>
                </a>
                <button class="btn btn-sm btn-primary2-light btn-icon DeleteDataIcon"
                            id="'.$materialStock->id.'">
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
                            <th scope="col">Material Name</th>
                            <th scope="col">Grade</th>
                            <th scope="col">Category</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Actions</th>
                </tr>
                        </tfoot>
                     </table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No material stocks present in the database!</h1>';
        }
    }

    public function materialstockstore(Request $request)
    {
        $user_id = Auth::id();

        // Validation Rules
        $request->validate([
            'material_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'material_name' => 'required|string|max:255',
            'material_grade' => 'nullable|string|max:255',
            'material_category' => 'nullable|string|max:255',
            'material_quantity' => 'nullable|numeric',
            'material_UOM' => 'nullable|string|max:255',
            'material_price' => 'nullable|numeric',
            'material_description' => 'nullable|string',
            'material_warehouse_location' => 'nullable|string|max:255',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'branch_id' => 'nullable|exists:branches,id',
        ]);


        $unique_code = [
            'table' => 'material_stocks',
            'field' => 'material_unique_code',
            'length' => 8,
            'prefix' => 'MAT'
        ];
        $material_unique_code = IdGenerator::generate($unique_code);

        $materialProfilePicture = null;  // Initialize

        // Handle image upload using Spatie Image
        if ($request->hasFile('material_profile_picture')) {
            $image = $request->file('material_profile_picture');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('material-logos', $imageName); // Store in public/storage

            // Use Storage facade to get the full path for Spatie Image
            $fullImagePath = Storage::path($imagePath);


            if (Storage::exists($imagePath)) {
                // Process image using Spatie
                Image::load($fullImagePath)
                    ->fit(Fit::Crop, 300, 300)
                    ->save();

                $materialProfilePicture = 'storage/material-logos/' . $imageName;
            }
        }

        $materialStockData = $request->except('material_profile_picture');
        $materialStockData['material_unique_code'] = $material_unique_code;
        $materialStockData['material_profile_picture'] = $materialProfilePicture;
        $materialStockData['user_id'] = $user_id;

        MaterialStock::create($materialStockData);

        return response()->json(['status' => 200, 'message' => 'Material stock added successfully']);
    }

    public function materialstockedit(Request $request)
    {
        $materialStock = MaterialStock::find($request->id);
        if (!$materialStock) {
            return response()->json(['status' => 404, 'message' => 'Material stock not found']);
        }
        return response()->json($materialStock);
    }


    public function materialstockview(Request $request)
    {
        $materialStock = MaterialStock::find($request->id);

        if (!$materialStock) {
            return response()->json(['status' => 404, 'message' => 'Material stock not found']);
        }

        return response()->json($materialStock);
    }


    public function materialstockupdate(Request $request)
    {
        $materialStock = MaterialStock::find($request->material_stock_id);
        if (!$materialStock) {
            return response()->json(['status' => 404, 'message' => 'Material stock not found']);
        }

        // Validation Rules
       $request->validate([
            'material_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'material_name' => 'required|string|max:255',
            'material_grade' => 'nullable|string|max:255',
            'material_category' => 'nullable|string|max:255',
            'material_quantity' => 'nullable|numeric',
            'material_UOM' => 'nullable|string|max:255',
            'material_price' => 'nullable|numeric',
            'material_description' => 'nullable|string',
            'material_warehouse_location' => 'nullable|string|max:255',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'branch_id' => 'nullable|exists:branches,id',
        ]);

        // Handle image upload if file exists, using Spatie Image
        $materialProfilePicture = $materialStock->material_profile_picture; // Default to existing

          if ($request->hasFile('material_profile_picture')) {
                $image = $request->file('material_profile_picture');
             $imageName = time() . '_' . $image->getClientOriginalName();
               $imagePath = $image->storeAs('material-logos', $imageName); // Store in public/storage

             // Get the full filesystem path
             $fullImagePath = Storage::path($imagePath);

            // Process the image using Spatie
             Image::load($fullImagePath)
                 ->fit(Fit::Crop, 300, 300)
                ->save();

          $materialProfilePicture = 'storage/material-logos/' . $imageName;

    // Delete the old image (optional - if you want to replace it)
       if ($materialStock->material_profile_picture && Storage::exists(str_replace('storage/', 'public/', $materialStock->material_profile_picture))) {
          Storage::delete(str_replace('storage/', 'public/',  $materialStock->material_profile_picture));
          }
  }

       // Prepare data for update
           $materialStockData = $request->except('material_profile_picture');
           $materialStockData['material_profile_picture'] = $materialProfilePicture;


           $materialStock->update($materialStockData);

        return response()->json(['status' => 200, 'message' => 'Material stock updated successfully']);
    }

    public function materialstockdestroy(Request $request)
    {
        $materialStock = MaterialStock::find($request->id);
        if (!$materialStock) {
            return response()->json(['status' => 404, 'message' => 'Material stock not found']);
        }

        // Delete the material stock logo file
        if ($materialStock->material_profile_picture && Storage::exists(str_replace('storage/', 'public/', $materialStock->material_profile_picture))) {
            Storage::delete(str_replace('storage/', 'public/', $materialStock->material_profile_picture));
        }

        $materialStock->delete();
        return response()->json(['status' => 200, 'message' => 'Material stock deleted successfully']);
    }

    public function materialstockexport()
    {
        return Excel::download(new MaterialStocksExport, 'material_stocks_export_'.date('Y-m-d').'.xlsx', \Maatwebsite\Excel\Excel::XLSX, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
