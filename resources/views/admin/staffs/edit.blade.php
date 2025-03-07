@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Staff Profile</h5>
                    <a href="{{ route('admin.staffs.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to List
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.staffs.update', $staff) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="text-center mb-3">
                                    @if($staff->profile_picture)
                                        <img src="{{ Storage::url('profile-pictures/' . $staff->profile_picture) }}" 
                                             alt="Profile Picture"
                                             class="rounded-circle"
                                             style="width: 150px; height: 150px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="profile_picture" class="form-label">Profile Picture</label>
                                    <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                                </div>
                                <div class="mb-3">
                                    <label for="documents" class="form-label">Documents</label>
                                    <input type="file" class="form-control" id="documents" name="documents">
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $staff->first_name . ' ' . $staff->last_name) }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $staff->email) }}" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="mobile" class="form-label">Mobile</label>
                                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile', $staff->phone) }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="alt_mobile" class="form-label">Alternative Mobile</label>
                                        <input type="text" class="form-control" id="alt_mobile" name="alt_mobile" value="{{ old('alt_mobile', $staff->alt_phone) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="designation" class="form-label">Designation</label>
                                        <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation', $staff->designation) }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="department" class="form-label">Department</label>
                                        <input type="text" class="form-control" id="department" name="department" value="{{ old('department', $staff->department) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="3" required>{{ old('address', $staff->address) }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $staff->city) }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" class="form-control" id="state" name="state" value="{{ old('state', $staff->state) }}" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="pincode" class="form-label">Pincode</label>
                                        <input type="text" class="form-control" id="pincode" name="pincode" value="{{ old('pincode', $staff->pincode) }}" required>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h6 class="mb-3">Bank Details</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="bank_name" class="form-label">Bank Name</label>
                                        <input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ old('bank_name', $staff->bank_name) }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="bank_account_no" class="form-label">Account Number</label>
                                        <input type="text" class="form-control" id="bank_account_no" name="bank_account_no" value="{{ old('bank_account_no', $staff->bank_account_no) }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="ifsc_code" class="form-label">IFSC Code</label>
                                        <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" value="{{ old('ifsc_code', $staff->ifsc_code) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="pan_number" class="form-label">PAN Number</label>
                                        <input type="text" class="form-control" id="pan_number" name="pan_number" value="{{ old('pan_number', $staff->pan_number) }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="aadhar_number" class="form-label">Aadhar Number</label>
                                        <input type="text" class="form-control" id="aadhar_number" name="aadhar_number" value="{{ old('aadhar_number', $staff->aadhar_number) }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="basic_salary" class="form-label">Basic Salary</label>
                                    <input type="number" class="form-control" id="basic_salary" name="basic_salary" value="{{ old('basic_salary', $staff->basic_salary) }}">
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection