<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StaffController extends Controller
{
    /**
     * Display a listing of staff members.
     */
    public function staffs()
    {
        $staffs = Staff::with(['user', 'reportingManager'])->get();
        
        // Add computed properties for the view
        foreach ($staffs as $staff) {
            $staff->full_name = $staff->first_name . ' ' . $staff->last_name;
            $staff->profile_picture_url = $staff->profile_picture
                ? asset('storage/staff/profile_pictures/' . $staff->profile_picture)
                : asset('assets/images/faces/3.jpg');
        }
        
        return view('staffs', compact('staffs'));
    }

    /**
     * Display the profile settings page for a staff member.
     */
    public function profileSettings($id)
    {
        $staff = Staff::with(['user', 'reportingManager'])->findOrFail($id);
        
        // Add computed properties for the view
        $staff->full_name = $staff->first_name . ' ' . $staff->last_name;
        $staff->profile_picture_url = $staff->profile_picture
            ? asset('storage/staff/profile_pictures/' . $staff->profile_picture)
            : asset('assets/images/faces/3.jpg');
            
        return view('profile-settings', compact('staff'));
    }

    /**
     * Fetch all staff members as JSON for AJAX requests.
     */
    public function stafffetchall()
    {
        $staffs = Staff::with('reportingManager')->get();
        
        // Add computed properties for the response
        foreach ($staffs as $staff) {
            $staff->full_name = $staff->first_name . ' ' . $staff->last_name;
            $staff->profile_picture_url = $staff->profile_picture
                ? asset('storage/staff/profile_pictures/' . $staff->profile_picture)
                : asset('assets/images/faces/3.jpg');
        }
        
        return response()->json(['status' => true, 'staffs' => $staffs]);
    }

    /**
     * Show the form for creating a new staff member.
     */
    public function create(): View
    {
        $managers = Staff::where('designation', 'like', '%manager%')->orWhere('designation', 'like', '%supervisor%')->get();
        return view('admin.staffs.create', compact('managers'));
    }

    /**
     * Store a newly created staff member in storage.
     */
    public function staffstore(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:staff',
            'phone' => 'required|string|max:20',
            'designation' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'joining_date' => 'required|date',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'pincode' => 'required|string',
            'basic_salary' => 'required|numeric',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'documents' => 'nullable|mimes:pdf,doc,docx|max:5120'
        ]);

        try {
            DB::beginTransaction();

            // Create user account
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'mobile' => $request->phone,
                'alt_mobile' => $request->alt_phone,
                'designation' => $request->designation,
                'role' => 'staff'
            ]);

            // Generate unique staff code
            $unique_code_config = [
                'table' => 'staff',
                'field' => 'staff_code',
                'length' => 8,
                'prefix' => 'STF'
            ];
            $staff_code = IdGenerator::generate($unique_code_config);

            $staff = new Staff();
            $staff->staff_code = $staff_code;
            $staff->first_name = $request->first_name;
            $staff->last_name = $request->last_name;
            $staff->email = $request->email;
            $staff->phone = $request->phone;
            $staff->alt_phone = $request->alt_phone;
            $staff->designation = $request->designation;
            $staff->department = $request->department;
            $staff->date_of_birth = $request->date_of_birth;
            $staff->joining_date = $request->joining_date;
            $staff->experience_years = $request->experience_years;
            $staff->address = $request->address;
            $staff->city = $request->city;
            $staff->state = $request->state;
            $staff->country = $request->country;
            $staff->pincode = $request->pincode;
            $staff->emergency_contact_name = $request->emergency_contact_name;
            $staff->emergency_contact_phone = $request->emergency_contact_phone;
            $staff->emergency_contact_relation = $request->emergency_contact_relation;
            $staff->emergency_contact_address = $request->emergency_contact_address;
            $staff->blood_group = $request->blood_group;
            $staff->skills = $request->skills;
            $staff->certifications = $request->certifications;
            $staff->basic_salary = $request->basic_salary;
            $staff->bank_name = $request->bank_name;
            $staff->bank_account_no = $request->bank_account_no;
            $staff->ifsc_code = $request->ifsc_code;
            $staff->pan_number = $request->pan_number;
            $staff->aadhar_number = $request->aadhar_number;
            $staff->reporting_to = $request->reporting_to;

            if ($request->hasFile('profile_picture')) {
                $file = $request->file('profile_picture');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/staff/profile_pictures', $filename);
                $staff->profile_picture = $filename;
            }

            if ($request->hasFile('documents')) {
                $file = $request->file('documents');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/staff/documents', $filename);
                $staff->documents = $filename;
            }

            $staff->user_id = $user->id;
            $staff->save();

            DB::commit();
            
            // Check if request is AJAX
            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'Staff member added successfully']);
            }
            
            return redirect()->route('staffs')->with('status', 'staff-created');

        } catch (\Exception $e) {
            DB::rollback();
            
            // Check if request is AJAX
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => 'Error adding staff member: ' . $e->getMessage()]);
            }
            
            return redirect()->back()->withInput()->withErrors(['error' => 'Error adding staff member: ' . $e->getMessage()]);
        }
    }

    /**
     * Get staff member data for editing.
     */
    public function staffedit(Request $request)
    {
        $id = $request->query('id');

        if (!$id) {
            return response()->json(['status' => false, 'message' => 'Staff ID is required']);
        }

        try {
            $staff = Staff::with(['user', 'reportingManager'])->findOrFail($id);

            // Add profile picture URL if available
            if ($staff->profile_picture) {
                $staff->profile_picture_url = asset('storage/staff/profile_pictures/' . $staff->profile_picture);
            } else {
                // Use default image if no profile picture is available
                $staff->profile_picture_url = asset('assets/images/faces/3.jpg');
            }

            // Add full name for convenience
            $staff->full_name = $staff->first_name . ' ' . $staff->last_name;

            return response()->json(['status' => true, 'staff' => $staff]);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Error fetching staff data: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified staff member.
     */
    public function edit(Staff $staff): View
    {
        $managers = Staff::where('id', '!=', $staff->id)
            ->where(function($query) {
                $query->where('designation', 'like', '%manager%')
                      ->orWhere('designation', 'like', '%supervisor%');
            })
            ->get();
            
        return view('admin.staffs.edit', compact('staff', 'managers'));
    }

    /**
     * Update the specified staff member in storage.
     */
    public function staffupdate(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:staff,email,' . $request->id,
            'phone' => 'required|string|max:20',
            'designation' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'documents' => 'nullable|mimes:pdf,doc,docx|max:5120'
        ]);

        try {
            DB::beginTransaction();

            $staff = Staff::find($request->id);
            if (!$staff) {
                throw new \Exception('Staff not found');
            }
            
            $staff->first_name = $request->first_name;
            $staff->last_name = $request->last_name;
            $staff->email = $request->email;
            $staff->phone = $request->phone;
            $staff->alt_phone = $request->alt_phone;
            $staff->designation = $request->designation;
            $staff->department = $request->department;
            $staff->date_of_birth = $request->date_of_birth;
            $staff->experience_years = $request->experience_years;
            $staff->address = $request->address;
            $staff->city = $request->city;
            $staff->state = $request->state;
            $staff->country = $request->country ?? 'India';
            $staff->pincode = $request->pincode;
            $staff->emergency_contact_name = $request->emergency_contact_name;
            $staff->emergency_contact_phone = $request->emergency_contact_phone;
            $staff->emergency_contact_relation = $request->emergency_contact_relation;
            $staff->emergency_contact_address = $request->emergency_contact_address;
            $staff->blood_group = $request->blood_group;
            $staff->skills = $request->skills;
            $staff->certifications = $request->certifications;
            $staff->basic_salary = $request->basic_salary;
            $staff->bank_name = $request->bank_name;
            $staff->bank_account_no = $request->bank_account_no;
            $staff->ifsc_code = $request->ifsc_code;
            $staff->pan_number = $request->pan_number;
            $staff->aadhar_number = $request->aadhar_number;
            $staff->reporting_to = $request->reporting_to;

            if ($request->hasFile('profile_picture')) {
                // Delete old profile picture
                if ($staff->profile_picture) {
                    Storage::delete('public/staff/profile_pictures/' . $staff->profile_picture);
                }
                
                $file = $request->file('profile_picture');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/staff/profile_pictures', $filename);
                $staff->profile_picture = $filename;
            }

            if ($request->hasFile('documents')) {
                // Delete old documents
                if ($staff->documents) {
                    Storage::delete('public/staff/documents/' . $staff->documents);
                }
                
                $file = $request->file('documents');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/staff/documents', $filename);
                $staff->documents = $filename;
            }

            $staff->save();
            
            // Update user record if it exists
            if ($staff->user_id) {
                $user = User::find($staff->user_id);
                if ($user) {
                    $user->name = $request->first_name . ' ' . $request->last_name;
                    $user->email = $request->email;
                    $user->mobile = $request->phone;
                    $user->alt_mobile = $request->alt_phone;
                    $user->designation = $request->designation;
                    $user->save();
                }
            }

            DB::commit();
            
            // Check if request is AJAX
            if ($request->ajax()) {
                return response()->json(['status' => true, 'message' => 'Staff member updated successfully']);
            }
            
            return redirect()->route('staffs')->with('status', 'staff-updated');

        } catch (\Exception $e) {
            DB::rollback();
            
            // Check if request is AJAX
            if ($request->ajax()) {
                return response()->json(['status' => false, 'message' => 'Error updating staff member: ' . $e->getMessage()]);
            }
            
            return redirect()->back()->withInput()->withErrors(['error' => 'Error updating staff member: ' . $e->getMessage()]);
        }
    }

    public function staffdelete(Request $request)
    {
        try {
            $staff = Staff::find($request->id);

            // Delete associated files
            if ($staff->profile_picture) {
                Storage::delete('public/staff/profile_pictures/' . $staff->profile_picture);
            }
            if ($staff->documents) {
                Storage::delete('public/staff/documents/' . $staff->documents);
            }

            // Delete the associated user if needed
            if ($staff->user) {
                $staff->user->delete();
            }

            $staff->delete();
            return response()->json(['status' => true, 'message' => 'Staff member deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Error deleting staff member: ' . $e->getMessage()]);
        }
    }
}
