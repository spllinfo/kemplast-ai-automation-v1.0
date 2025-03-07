<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Staff;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile settings page.
     */
    public function settings(Request $request, $id = null): View
    {
        $user = $request->user();
        
        if ($id) {
            // If ID is provided, fetch that specific staff member
            $staff = Staff::findOrFail($id);
            $user = $staff->user;
        } else {
            // Otherwise, fetch the authenticated user's staff record
            $staff = Staff::where('user_id', $user->id)->first();
        }
        
        return view('profile-settings', [
            'user' => $user,
            'staff' => $staff,
        ]);
    }

    /**
     * Update the user's profile settings.
     */
    public function settingsUpdate(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->user()->id,
            'mobile' => 'required|string|max:20',
            'alt_mobile' => 'nullable|string|max:20',
            'designation' => 'required|string|max:255',
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

        $user = $request->user();
        $staff = Staff::where('user_id', $user->id)->first();

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
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'],
            'alt_mobile' => $validated['alt_mobile'],
            'designation' => $validated['designation'],
            'address' => $validated['address'],
            'profile_picture' => $validated['profile_picture'] ?? $user->profile_picture
        ]);

        // Update or create staff record
        if ($staff) {
            $staff->update([
                'first_name' => explode(' ', $validated['name'])[0],
                'last_name' => implode(' ', array_slice(explode(' ', $validated['name']), 1)),
                'email' => $validated['email'],
                'phone' => $validated['mobile'],
                'alt_phone' => $validated['alt_mobile'],
                'designation' => $validated['designation'],
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
        }

        return redirect()->route('profile.settings')->with('status', 'profile-updated');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
