<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminStaffController extends Controller
{
    public function index(): View
    {
        $staffs = Staff::with('user')->get();
        return view('admin.staffs.index', compact('staffs'));
    }

    public function create(): View
    {
        return view('admin.staffs.create');
    }

    public function edit(Staff $staff): View
    {
        return view('admin.staffs.edit', compact('staff'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'mobile' => 'required|string|max:20',
            'alt_mobile' => 'nullable|string|max:20',
            'designation' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_no' => 'nullable|string|max:255',
            'ifsc_code' => 'nullable|string|max:255',
            'pan_number' => 'nullable|string|max:255',
            'aadhar_number' => 'nullable|string|max:255',
            'basic_salary' => 'nullable|numeric',
            'documents' => 'nullable|mimes:pdf,doc,docx|max:5120'
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'mobile' => $validated['mobile'],
            'alt_mobile' => $validated['alt_mobile'],
            'designation' => $validated['designation']
        ]);

        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $filename = time() . '.' . $profilePicture->getClientOriginalExtension();
            $profilePicture->storeAs('public/profile-pictures', $filename);
            $profilePicturePath = $filename;
        }

        $documentPath = null;
        if ($request->hasFile('documents')) {
            $document = $request->file('documents');
            $filename = time() . '.' . $document->getClientOriginalExtension();
            $document->storeAs('public/documents', $filename);
            $documentPath = $filename;
        }

        // Create staff record
        Staff::create([
            'user_id' => $user->id,
            'first_name' => explode(' ', $validated['name'])[0],
            'last_name' => implode(' ', array_slice(explode(' ', $validated['name']), 1)),
            'email' => $validated['email'],
            'phone' => $validated['mobile'],
            'alt_phone' => $validated['alt_mobile'],
            'designation' => $validated['designation'],
            'department' => $validated['department'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'pincode' => $validated['pincode'],
            'profile_picture' => $profilePicturePath,
            'bank_name' => $validated['bank_name'],
            'bank_account_no' => $validated['bank_account_no'],
            'ifsc_code' => $validated['ifsc_code'],
            'pan_number' => $validated['pan_number'],
            'aadhar_number' => $validated['aadhar_number'],
            'basic_salary' => $validated['basic_salary'],
            'documents' => $documentPath
        ]);

        return redirect()->route('admin.staffs.index')->with('status', 'staff-created');
    }

    public function update(Request $request, Staff $staff): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $staff->user_id,
            'mobile' => 'required|string|max:20',
            'alt_mobile' => 'nullable|string|max:20',
            'designation' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:10',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bank_name' => 'nullable|string|max:255',
            'bank_account_no' => 'nullable|string|max:255',
            'ifsc_code' => 'nullable|string|max:255',
            'pan_number' => 'nullable|string|max:255',
            'aadhar_number' => 'nullable|string|max:255',
            'basic_salary' => 'nullable|numeric',
            'documents' => 'nullable|mimes:pdf,doc,docx|max:5120'
        ]);

        if ($request->hasFile('profile_picture')) {
            $profilePicture = $request->file('profile_picture');
            $filename = time() . '.' . $profilePicture->getClientOriginalExtension();
            $profilePicture->storeAs('public/profile-pictures', $filename);
            $validated['profile_picture'] = $filename;
        }

        if ($request->hasFile('documents')) {
            $document = $request->file('documents');
            $filename = time() . '.' . $document->getClientOriginalExtension();
            $document->storeAs('public/documents', $filename);
            $validated['documents'] = $filename;
        }

        // Update user data
        $staff->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'alt_mobile' => $validated['alt_mobile'],
            'designation' => $validated['designation']
        ]);

        // Update staff data
        $staff->update([
            'first_name' => explode(' ', $validated['name'])[0],
            'last_name' => implode(' ', array_slice(explode(' ', $validated['name']), 1)),
            'email' => $validated['email'],
            'phone' => $validated['mobile'],
            'alt_phone' => $validated['alt_mobile'],
            'designation' => $validated['designation'],
            'department' => $validated['department'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'pincode' => $validated['pincode'],
            'profile_picture' => $validated['profile_picture'] ?? $staff->profile_picture,
            'bank_name' => $validated['bank_name'],
            'bank_account_no' => $validated['bank_account_no'],
            'ifsc_code' => $validated['ifsc_code'],
            'pan_number' => $validated['pan_number'],
            'aadhar_number' => $validated['aadhar_number'],
            'basic_salary' => $validated['basic_salary'],
            'documents' => $validated['documents'] ?? $staff->documents
        ]);

        return redirect()->route('admin.staffs.index')->with('status', 'staff-updated');
    }

    public function destroy(Staff $staff): RedirectResponse
    {
        // Delete associated files
        if ($staff->profile_picture) {
            Storage::delete('public/profile-pictures/' . $staff->profile_picture);
        }
        if ($staff->documents) {
            Storage::delete('public/documents/' . $staff->documents);
        }

        // Delete user and staff records
        $staff->user->delete();
        $staff->delete();

        return redirect()->route('admin.staffs.index')->with('status', 'staff-deleted');
    }
}
