<?php

namespace App\Http\Controllers;

use Spatie\Image\Enums\Fit;

use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Telescope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Image\Image;
use Spatie\Image\Manipulations;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomersExport;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Exports\SuppliersExport;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Construct the controller with middleware
     */
    // public function __construct()
    // {
    //     // Apply rate limiting to form submissions - 10 requests per minute
    //     $this->middleware('throttle:10,1')->only([
    //         'customerstore', 'customerupdate', 'destroy', 'customerexport', 'autosave'
    //     ]);

    //     // Log all actions for analytics and debugging
    //     $this->middleware('request-logger')->only([
    //         'customerfetchall', 'customerstore', 'customeredit', 'customerview',
    //         'customerupdate', 'destroy', 'customerexport', 'autosave'
    //     ]);
    // }

    /**
     * Display the customer management page
     */
    public function customers()
    {
        return view('customers');
    }

    /**
     * Fetch all customers with filtering
     *
     * @param Request $request
     * @return string HTML content for DataTable
     */
    public function customerfetchall(Request $request)
    {
        // Cache key based on date filter
        $dateFilter = $request->input('date_filter', 'last_90_days');
        $cacheKey = 'customers_' . $dateFilter . '_' . Auth::id();

        // Check if we have cached data
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $query = Customer::orderBy('id', 'desc');
        $filterText = 'All Records';

        // Apply date filtering based on selected range
        switch ($dateFilter) {
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

        // Fetch the results
        $customers = $query->get();

        $output = '';

        if ($customers->count() > 0) {
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
                        <th scope="col">Customer ID</th>
                        <th scope="col">Company Name</th>
                        <th scope="col">Contact Person</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Location</th>
                        <th scope="col">GST Number</th>
                        <th scope="col">Industry</th>
                        <th scope="col">Business Type</th>
                        <th scope="col">Customer Group</th>
                        <th scope="col">Company Size</th>
                        <th scope="col">Credit Limit</th>
                        <th scope="col">Payment Terms</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                 </thead>
                 <tbody>';
              foreach ($customers as $customer) {
                $output .= '  <tr class="crm-contact companies-list">
                    <td class="companies-checkbox">
                        <input class="form-check-input" type="checkbox" id="checkbox_'.$customer->id.'" value="'.$customer->id.'" aria-label="...">&nbsp;'.$customer->id.'
                    </td>
                    <td>'.$customer->customer_unique_code.'</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar avatar-sm">
                                <img src="'.$customer->company_profile_picture.'" alt="Company Logo" class="rounded-circle" onerror="this.src=\''.asset('assets/images/company-logos/default.png').'\'">
                            </div>
                            <div>
                                <a data-bs-toggle="offcanvas" href="#viewDataModal" role="button" aria-controls="viewDataModal" class="ViewDataIcon" data-id="' . $customer->id . '">'.$customer->company_name.'</a>
                            </div>
                        </div>
                    </td>
                    <td>'.$customer->contact_person.'</td>
                    <td>
                        <span class="d-block mb-0"><i class="ri-mail-line fs-14 text-muted d-inline-block me-2 align-middle"></i>'.$customer->email.'</span>
                    </td>
                    <td>
                        <span class="d-block"><i class="ri-phone-line fs-14 text-muted d-inline-block me-2 align-middle"></i>'.$customer->phone.'</span>
                    </td>
                    <td>
                        <span class="d-block">'.($customer->city ? $customer->city . ', ' : '') . ($customer->state ?: 'N/A').'</span>
                    </td>
                    <td>'.$customer->gst_number.'</td>
                    <td>'.$customer->industry_type.'</td>
                    <td>'.ucfirst($customer->business_type ?: 'N/A').'</td>
                    <td>'.ucfirst($customer->customer_group ?: 'N/A').'</td>
                    <td>
                        <div class="d-flex align-items-center flex-wrap gap-1">
                            <span class="badge bg-primary1-transparent">'.$customer->company_size.'</span>
                        </div>
                    </td>
                    <td>₹'.number_format($customer->credit_limit, 2).'</td>
                    <td>'.str_replace('_', ' ', ucfirst($customer->payment_terms ?: 'N/A')).'</td>
                    <td>
                        <span class="badge bg-'.($customer->status == 'active' ? 'success' : ($customer->status == 'inactive' ? 'warning' : 'danger')).'-transparent">'.ucfirst($customer->status ?: 'Active').'</span>
                    </td>
                    <td>
                        <div class="btn-list">
                            <a data-bs-toggle="offcanvas"
                               href="#viewDataModal"
                               role="button"
                               aria-controls="viewDataModal"
                               class="btn btn-sm btn-primary-light btn-icon ViewDataIcon"
                               data-id="' . $customer->id . '">
                                <i class="ri-eye-line"></i>
                            </a>
                            <a href="#"
                               id="'.$customer->id.'"
                               class="btn btn-sm btn-info-light btn-icon EditDataIcon"
                               data-bs-toggle="modal"
                               data-bs-target="#editDataModal">
                                <i class="ri-pencil-line"></i>
                            </a>
                            <button class="btn btn-sm btn-primary2-light btn-icon DeleteDataIcon"
                                    id="'.$customer->id.'">
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
                                    <th scope="col">Customer ID</th>
                                    <th scope="col">Company Name</th>
                                    <th scope="col">Contact Person</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">GST Number</th>
                                    <th scope="col">Industry</th>
                                    <th scope="col">Business Type</th>
                                    <th scope="col">Customer Group</th>
                                    <th scope="col">Company Size</th>
                                    <th scope="col">Credit Limit</th>
                                    <th scope="col">Payment Terms</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                               </tr>
                            </tfoot>
                         </table>';
        } else {
            $output = '<h1 class="text-center text-secondary my-5">No customers present in the database!</h1>';
        }

        // Cache the result for 15 minutes
        Cache::put($cacheKey, $output, now()->addMinutes(15));

        return $output;
    }

    /**
     * Store a new customer
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function customerstore(Request $request)
    {
        $user_id = Auth::id();

        try {
            // Enhanced validation with better rules
            $validator = Validator::make($request->all(), [
                'customer_unique_code' => 'required|string|unique:customers,customer_unique_code,' . ($request->customer_id ?? ''),
                'company_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'company_name' => 'required|string|max:255',
                'contact_person' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email:rfc,dns',
                    'max:255',
                    Rule::unique('customers', 'email')->ignore($request->customer_id ?? null)
                ],
                'phone' => 'required|string|min:10|max:20',
                'alt_phone' => 'nullable|string|min:10|max:20',
                'address' => 'nullable|string|max:500',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'country' => 'nullable|string|max:100',
                'pincode' => 'nullable|string|max:10',
                'gst_number' => [
                    'nullable',
                    'string',
                    'max:15',
                    'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/'
                ],
                'pan_number' => 'nullable|string|max:10|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
                'tin_number' => 'nullable|string|max:20',
                'cst_number' => 'nullable|string|max:20',
                'website' => 'nullable|url|max:255',
                'credit_limit' => 'nullable|numeric|min:0|max:999999999999.99',
                'payment_terms' => 'nullable|string|in:advance,15_days,30_days,45_days,60_days',
                'tax_registration_number' => 'nullable|string|max:20',
                'tax_exemption_number' => 'nullable|string|max:20',
                'business_type' => 'nullable|string|in:manufacturer,distributor,retailer,wholesaler,importer,exporter',
                'industry_type' => 'nullable|string|max:255',
                'customer_group' => 'nullable|string|in:retail,wholesale,corporate,government',
                'company_size' => 'nullable|string|in:Startup,Micro Business,Small Business,Medium Size,Corporate,Large Enterprise',
                'status' => 'nullable|string|in:active,inactive,blacklisted',
                'notes' => 'nullable|string|max:1000',
                'documents' => 'nullable|json',
                'bank_details' => 'nullable|json',
                'preferences' => 'nullable|json',
                'metadata' => 'nullable|json',
                'sales_person_id' => 'nullable|exists:users,id',
                'branch_id' => 'nullable|exists:branches,id'
            ], [
                'customer_unique_code.required' => 'A unique customer code is required.',
                'customer_unique_code.unique' => 'This customer code is already in use.',
                'company_name.required' => 'The company name is required.',
                'contact_person.required' => 'The contact person is required.',
                'email.required' => 'The email is required.',
                'email.email' => 'Please provide a valid email address.',
                'email.unique' => 'This email is already registered in our system.',
                'phone.required' => 'The phone number is required.',
                'phone.min' => 'The phone number must be at least 10 characters.',
                'gst_number.regex' => 'The GST number must be a valid 15-digit GST Identification Number.',
                'pan_number.regex' => 'The PAN number must be a valid 10-digit PAN Identification Number.',
                'website.url' => 'Please enter a valid website URL.',
                'credit_limit.numeric' => 'Credit limit must be a numeric value.',
                'credit_limit.max' => 'Credit limit cannot exceed 999,999,999,999.99',
                'payment_terms.in' => 'Payment terms must be one of the following: advance, 15_days, 30_days, 45_days, 60_days.',
                'tax_registration_number.max' => 'Tax registration number must be up to 20 characters.',
                'tax_exemption_number.max' => 'Tax exemption number must be up to 20 characters.',
                'business_type.in' => 'Business type must be one of the following: manufacturer, distributor, retailer, wholesaler, importer, exporter.',
                'industry_type.max' => 'Industry type must be up to 255 characters.',
                'customer_group.in' => 'Customer group must be one of the following: retail, wholesale, corporate, government.',
                'company_size.in' => 'Company size must be one of the following: Startup, Micro Business, Small Business, Medium Size, Corporate, Large Enterprise',
                'status.in' => 'Status must be one of the following: active, inactive, blacklisted.',
                'notes.max' => 'Notes must be up to 1000 characters.',
                'documents.json' => 'Documents must be in valid JSON format.',
                'bank_details.json' => 'Bank details must be in valid JSON format.',
                'preferences.json' => 'Preferences must be in valid JSON format.',
                'metadata.json' => 'Metadata must be in valid JSON format.',
                'sales_person_id.exists' => 'The selected sales person does not exist.',
                'branch_id.exists' => 'The selected branch does not exist.'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Start transaction for data integrity
            DB::beginTransaction();

            // Generate unique customer code
            $customer_unique_code = IdGenerator::generate([
                'table' => 'customers',
                'field' => 'customer_unique_code',
                'length' => 8,
                'prefix' => 'CUS'
            ]);

            $companyProfilePicture = null;

            // Handle image upload
            if ($request->hasFile('company_profile_picture')) {
                $image = $request->file('company_profile_picture');
                $imageName = time() . '_' . Str::slug($request->company_name) . '.' . $image->getClientOriginalExtension();

                // Store the image in 'public/company-logos'
                $imagePath = $image->storeAs('company-logos', $imageName);
                $fullImagePath = Storage::path($imagePath);

                if (Storage::exists($imagePath)) {
                    // Process image using Spatie with error handling
                    try {
                        Image::load($fullImagePath)
                            ->fit(Fit::Crop, 300, 300)
                            ->optimize()
                            ->save();

                        // Store the relative path for database storage
                        $companyProfilePicture = 'storage/company-logos/' . $imageName;
                    } catch (Exception $e) {
                        Log::error('Image processing failed: ' . $e->getMessage());
                        // Still save the original image
                        $companyProfilePicture = 'storage/company-logos/' . $imageName;
                    }
                } else {
                    Log::error("File not found at path: " . $fullImagePath);
                    return response()->json([
                        'status' => 500,
                        'message' => 'Error uploading image. Please try again.'
                    ], 500);
                }
            }

            // Create the customer with all validated data
            $customer = Customer::create([
                'customer_unique_code' => $customer_unique_code,
                'company_name' => $request->company_name,
                'contact_person' => $request->contact_person,
                'email' => $request->email,
                'phone' => $request->phone,
                'alt_phone' => $request->alt_phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode,
                'gst_number' => $request->gst_number,
                'pan_number' => $request->pan_number,
                'tin_number' => $request->tin_number,
                'cst_number' => $request->cst_number,
                'website' => $request->website,
                'credit_limit' => $request->credit_limit,
                'payment_terms' => $request->payment_terms,
                'tax_registration_number' => $request->tax_registration_number,
                'tax_exemption_number' => $request->tax_exemption_number,
                'business_type' => $request->business_type,
                'industry_type' => $request->industry_type,
                'customer_group' => $request->customer_group,
                'company_size' => $request->company_size,
                'status' => $request->status ?? 'active',
                'notes' => $request->notes,
                'company_profile_picture' => $companyProfilePicture,
                'bank_details' => $request->bank_details,
                'preferences' => $request->preferences,
                'metadata' => $request->metadata,
                'sales_person_id' => $request->sales_person_id,
                'branch_id' => $request->branch_id,
                'user_id' => $user_id,
            ]);

            // Commit the transaction
            DB::commit();

            // Clear cached data
            $this->clearCustomerCache();

            // Log the action
            Log::info('Customer created successfully', ['id' => $customer->id, 'user_id' => $user_id]);

            return response()->json([
                'status' => 200,
                'message' => 'Customer added successfully',
                'customer' => $customer
            ]);
        } catch (Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            Log::error('Error creating customer: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while adding the customer. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Edit customer - fetch data via AJAX.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function customeredit(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer|exists:customers,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Use cache to improve performance
            $cacheKey = 'customer_edit_' . $request->id;

            $customer = Cache::remember($cacheKey, now()->addMinutes(5), function() use ($request) {
                return Customer::find($request->id);
            });

            if (!$customer) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Customer not found'
                ], 404);
            }

            return response()->json($customer);
        } catch (Exception $e) {
            Log::error('Error fetching customer for edit: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while fetching customer data.'
            ], 500);
        }
    }

    /**
     * View customer details.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function customerview(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|integer|exists:customers,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Use cache to improve performance
            $cacheKey = 'customer_view_' . $request->id;

            $customer = Cache::remember($cacheKey, now()->addMinutes(10), function() use ($request) {
                return Customer::find($request->id);
            });

            if (!$customer) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Customer not found'
                ], 404);
            }

            return response()->json($customer);
        } catch (Exception $e) {
            Log::error('Error fetching customer for view: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while fetching customer details.'
            ], 500);
        }
    }

    /**
     * Update existing customer.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function customerupdate(Request $request)
    {
        $user_id = Auth::id();

        try {
            $customer = Customer::find($request->customer_id);

            if (!$customer) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Customer not found'
                ], 404);
            }

            // Enhanced validation with better rules
            $validator = Validator::make($request->all(), [
                'customer_id' => 'required|integer|exists:customers,id',
                'company_profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'company_name' => 'required|string|max:255',
                'contact_person' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email:rfc,dns',
                    'max:255',
                    Rule::unique('customers', 'email')->ignore($customer->id)
                ],
                'phone' => 'required|string|min:10|max:20',
                'alt_phone' => 'nullable|string|min:10|max:20',
                'address' => 'nullable|string|max:500',
                'city' => 'nullable|string|max:100',
                'state' => 'nullable|string|max:100',
                'country' => 'nullable|string|max:100',
                'pincode' => 'nullable|string|max:10',
                'gst_number' => [
                    'nullable',
                    'string',
                    'max:15',
                    'regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/'
                ],
                'pan_number' => 'nullable|string|max:10|regex:/^[A-Z]{5}[0-9]{4}[A-Z]{1}$/',
                'tin_number' => 'nullable|string|max:20',
                'cst_number' => 'nullable|string|max:20',
                'website' => 'nullable|url|max:255',
                'credit_limit' => 'nullable|numeric|min:0|max:999999999999.99',
                'payment_terms' => 'nullable|string|in:advance,15_days,30_days,45_days,60_days',
                'tax_registration_number' => 'nullable|string|max:20',
                'tax_exemption_number' => 'nullable|string|max:20',
                'business_type' => 'nullable|string|in:manufacturer,distributor,retailer,wholesaler,importer,exporter',
                'industry_type' => 'nullable|string|max:255',
                'customer_group' => 'nullable|string|in:retail,wholesale,corporate,government',
                'status' => 'nullable|string|in:active,inactive,blacklisted',
                'notes' => 'nullable|string|max:1000',
                'documents' => 'nullable|json',
                'bank_details' => 'nullable|json',
                'preferences' => 'nullable|json',
                'metadata' => 'nullable|json',
                'sales_person_id' => 'nullable|exists:users,id',
                'branch_id' => 'nullable|exists:branches,id',
            ], [
                'company_name.required' => 'The company name is required.',
                'contact_person.required' => 'The contact person is required.',
                'email.required' => 'The email is required.',
                'email.email' => 'Please provide a valid email address.',
                'email.unique' => 'This email is already registered for another company.',
                'phone.required' => 'The phone number is required.',
                'phone.min' => 'The phone number must be at least 10 characters.',
                'gst_number.regex' => 'The GST number must be a valid 15-digit GST Identification Number.',
                'pan_number.regex' => 'The PAN number must be a valid 10-digit PAN Identification Number.',
                'website.url' => 'Please enter a valid website URL.',
                'credit_limit.numeric' => 'Credit limit must be a numeric value.',
                'credit_limit.max' => 'Credit limit cannot exceed 999,999,999,999.99',
                'payment_terms.in' => 'Payment terms must be one of the following: advance, 15_days, 30_days, 45_days, 60_days.',
                'tax_registration_number.max' => 'Tax registration number must be up to 20 characters.',
                'tax_exemption_number.max' => 'Tax exemption number must be up to 20 characters.',
                'business_type.in' => 'Business type must be one of the following: manufacturer, distributor, retailer, wholesaler, importer, exporter.',
                'industry_type.max' => 'Industry type must be up to 255 characters.',
                'customer_group.in' => 'Customer group must be one of the following: retail, wholesale, corporate, government.',
                'status.in' => 'Status must be one of the following: active, inactive, blacklisted.',
                'notes.max' => 'Notes must be up to 1000 characters.',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Start transaction for data integrity
            DB::beginTransaction();

            // Keep the old image by default
            $companyProfilePicture = $customer->company_profile_picture;

            // Handle image upload if a new file is provided
            if ($request->hasFile('company_profile_picture')) {
                $image = $request->file('company_profile_picture');
                $imageName = time() . '_' . Str::slug($request->company_name) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('company-logos', $imageName);
                $fullImagePath = Storage::path($imagePath);

                // Process the image using Spatie
                try {
                    Image::load($fullImagePath)
                        ->fit(Fit::Crop, 300, 300)
                        ->optimize()
                        ->save();

                    // Convert to accessible storage path
                    $companyProfilePicture = 'storage/company-logos/' . $imageName;

                    // Delete the old image file if it exists and is different
                    if ($customer->company_profile_picture && Storage::exists(str_replace('storage/', 'public/', $customer->company_profile_picture))) {
                        Storage::delete(str_replace('storage/', 'public/', $customer->company_profile_picture));
                    }
                } catch (Exception $e) {
                    Log::error('Image processing failed: ' . $e->getMessage());
                    // Still save the original image
                    $companyProfilePicture = 'storage/company-logos/' . $imageName;
                }
            }

            // Update customer record
            $customer->update([
                'company_profile_picture' => $companyProfilePicture,
                'company_name' => $request->company_name,
                'contact_person' => $request->contact_person,
                'email' => $request->email,
                'phone' => $request->phone,
                'alt_phone' => $request->alt_phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'pincode' => $request->pincode,
                'gst_number' => $request->gst_number,
                'pan_number' => $request->pan_number,
                'tin_number' => $request->tin_number,
                'cst_number' => $request->cst_number,
                'website' => $request->website,
                'credit_limit' => $request->credit_limit,
                'payment_terms' => $request->payment_terms,
                'tax_registration_number' => $request->tax_registration_number,
                'tax_exemption_number' => $request->tax_exemption_number,
                'business_type' => $request->business_type,
                'industry_type' => $request->industry_type,
                'customer_group' => $request->customer_group,
                'status' => $request->status,
                'notes' => $request->notes,
                'documents' => $request->documents,
                'bank_details' => $request->bank_details,
                'preferences' => $request->preferences,
                'metadata' => $request->metadata,
                'sales_person_id' => $request->sales_person_id,
                'branch_id' => $request->branch_id,
                'user_id' => $user_id,
            ]);

            // Commit the transaction
            DB::commit();

            // Clear cached data
            $this->clearCustomerCache();
            Cache::forget('customer_edit_' . $customer->id);
            Cache::forget('customer_view_' . $customer->id);

            // Log the action
            Log::info('Customer updated successfully', ['id' => $customer->id, 'user_id' => $user_id]);

            return response()->json([
                'status' => 200,
                'message' => 'Customer updated successfully',
                'customer' => $customer
            ]);
        } catch (Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            Log::error('Error updating customer: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while updating the customer. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Auto-save form data during editing
     * This supports the real-time auto-save feature in the UI
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function autosave(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'field' => 'required|string',
                'value' => 'nullable',
                'customerId' => 'nullable|integer|exists:customers,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->errors()
                ], 422);
            }

            $field = $request->field;
            $value = $request->value;
            $customerId = $request->customerId;

            // If customerId is provided, we're editing an existing customer
            if ($customerId) {
                // Only update the specific field for the specified customer
                $customer = Customer::find($customerId);

                if (!$customer) {
                    return response()->json([
                        'status' => 404,
                        'message' => 'Customer not found'
                    ], 404);
                }

                // Check if the field is valid for the model
                if (!in_array($field, $customer->getFillable())) {
                    return response()->json([
                        'status' => 422,
                        'message' => 'Invalid field for auto-save'
                    ], 422);
                }

                // Update only the specified field
                $customer->update([$field => $value]);

                // Clear specific caches
                Cache::forget('customer_edit_' . $customerId);
                Cache::forget('customer_view_' . $customerId);

                Log::info('Auto-save updated for customer', [
                    'customer_id' => $customerId,
                    'field' => $field,
                    'user_id' => Auth::id()
                ]);
            } else {
                // For new customer, we store in session to recover
                // in case the user refreshes before submitting
                $formData = Session::get('customer_form_data', []);
                $formData[$field] = $value;
                Session::put('customer_form_data', $formData);

                Log::info('Auto-save in session for new customer', [
                    'field' => $field,
                    'user_id' => Auth::id()
                ]);
            }

            return response()->json([
                'status' => 200,
                'message' => 'Field auto-saved successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Error in auto-save: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while saving the field.'
            ], 500);
        }
    }

    /**
     * Get form state for recovery
     * This supports form state preservation on browser refresh
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getFormState(Request $request)
    {
        try {
            $customerId = $request->input('customerId');

            if ($customerId) {
                // Get existing customer data
                $customer = Customer::find($customerId);

                if (!$customer) {
                    return response()->json([
                        'status' => 404,
                        'message' => 'Customer not found'
                    ], 404);
                }

                return response()->json([
                    'status' => 200,
                    'data' => $customer
                ]);
            } else {
                // Return data from session for new customer form
                $formData = Session::get('customer_form_data', []);

                return response()->json([
                    'status' => 200,
                    'data' => $formData
                ]);
            }
        } catch (Exception $e) {
            Log::error('Error getting form state: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while retrieving form state.'
            ], 500);
        }
    }

    /**
     * Delete a customer record.
     *
     * @param Customer $customer
     * @return JsonResponse
     */
    public function destroy(Customer $customer)
    {
        try {
            // Start transaction
            DB::beginTransaction();

            // Delete the company logo file
            if ($customer->company_profile_picture &&
                Storage::exists(str_replace('storage/', 'public/', $customer->company_profile_picture))) {
                Storage::delete(str_replace('storage/', 'public/', $customer->company_profile_picture));
            }

            // Delete the database record
            $customer->delete();

            // Commit the transaction
            DB::commit();

            // Clear cached data
            $this->clearCustomerCache();
            Cache::forget('customer_edit_' . $customer->id);
            Cache::forget('customer_view_' . $customer->id);

            // Log the action
            Log::info('Customer deleted successfully', ['id' => $customer->id, 'user_id' => Auth::id()]);

            return response()->json([
                'status' => 200,
                'message' => 'Customer deleted successfully'
            ]);
        } catch (Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            Log::error('Error deleting customer: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while deleting the customer. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export customer data to Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function customerexport()
    {
        try {
            // Log the export action
            Log::info('Customer data export initiated', ['user_id' => Auth::id()]);

            return Excel::download(
                new CustomersExport,
                'customers_export_' . date('Y-m-d') . '.xlsx',
                \Maatwebsite\Excel\Excel::XLSX,
                [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                ]
            );
        } catch (Exception $e) {
            Log::error('Error exporting customer data: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while exporting customer data. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clear customer-related cache.
     */
    private function clearCustomerCache()
    {
        // Clear all customer list caches
        Cache::forget('customers_all_' . Auth::id());
        Cache::forget('customers_today_' . Auth::id());
        Cache::forget('customers_this_week_' . Auth::id());
        Cache::forget('customers_last_30_days_' . Auth::id());
        Cache::forget('customers_last_90_days_' . Auth::id());
        Cache::forget('customers_six_months_' . Auth::id());
        Cache::forget('customers_this_year_' . Auth::id());
    }
}
