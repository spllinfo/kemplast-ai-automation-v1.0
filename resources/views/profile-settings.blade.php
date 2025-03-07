@extends('layouts.app')

@section('styles')
<style>
    .profile-settings-tab .nav-link.active {
        background-color: var(--primary-color);
        color: #fff;
    }
    .profile-settings-tab .nav-link {
        border-radius: 4px;
    }
    /* Custom form elements */
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
        border-color: var(--primary-color);
    }
    .is-valid-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #198754;
        display: none;
    }
    .is-invalid-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #dc3545;
        display: none;
    }
    .form-field-wrapper {
        position: relative;
        margin-bottom: 1rem;
    }
    .form-field-wrapper.is-valid .is-valid-icon {
        display: block;
    }
    .form-field-wrapper.is-invalid .is-invalid-icon {
        display: block;
    }
    .form-field-wrapper label .required {
        color: #dc3545;
        margin-left: 2px;
    }

    /* Dropzone styling */
    .dropzone {
        border: 2px dashed var(--primary-color);
        border-radius: 5px;
        background: #f8f9fa;
        transition: all 0.3s ease;
        position: relative;
        min-height: 150px;
        padding: 20px;
        cursor: pointer;
    }
    .dropzone:hover {
        border-color: var(--primary-color);
        background: rgba(var(--primary-rgb), 0.05);
    }
    .dropzone .dz-message {
        text-align: center;
        margin: 2em 0;
    }
    .dropzone .dz-preview {
        margin: 10px;
    }
    .dropzone-previews {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }
    .dz-preview-item {
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 5px;
        position: relative;
        width: 120px;
    }
    .dz-preview-item img {
        width: 100%;
        height: auto;
        border-radius: 2px;
    }
    .dz-preview-item .dz-remove {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #dc3545;
        color: white;
        text-align: center;
        line-height: 20px;
        cursor: pointer;
        font-size: 10px;
    }
    .dz-preview-item .dz-filename {
        font-size: 12px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        margin-top: 5px;
    }

    /* Card selection styles */
    .card-selection {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 1rem;
    }
    .card-option {
        border: 2px solid #dee2e6;
        border-radius: 5px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        flex: 1 0 calc(25% - 10px);
        min-width: 100px;
        text-align: center;
    }
    .card-option:hover {
        border-color: var(--primary-color);
        background: rgba(var(--primary-rgb), 0.05);
    }
    .card-option.selected {
        border-color: var(--primary-color);
        background: rgba(var(--primary-rgb), 0.1);
        box-shadow: 0 0 0 0.2rem rgba(var(--primary-rgb), 0.25);
    }
    .card-option i {
        display: block;
        font-size: 24px;
        margin-bottom: 10px;
    }

    /* Loading animation */
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.5; }
        100% { opacity: 1; }
    }
    .skeleton-loader {
        animation: pulse 1.5s infinite;
        background: #f0f0f0;
        border-radius: 4px;
        height: 38px;
        width: 100%;
    }
    .skeleton-loader.avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 0 auto;
    }
    .skeleton-loader.title {
        height: 22px;
        margin-bottom: 10px;
        width: 70%;
    }
    .skeleton-loader.text {
        height: 16px;
        margin-bottom: 10px;
        width: 90%;
    }

    /* Success animation */
    @keyframes checkmark {
        0% { transform: scale(0); opacity: 0; }
        50% { transform: scale(1.2); opacity: 1; }
        100% { transform: scale(1); opacity: 1; }
    }
    .success-checkmark {
        color: #28a745;
        font-size: 20px;
        animation: checkmark 0.5s ease-in-out;
    }

    /* Form section animations */
    .form-section {
        transition: all 0.3s ease;
    }
    .form-section.loading {
        opacity: 0.7;
        pointer-events: none;
    }

    /* Toast notifications */
    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 350px;
    }
    .toast {
        position: relative;
        background: white;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        border-radius: 0.25rem;
        overflow: hidden;
        margin-bottom: 10px;
    }
    .toast-header {
        padding: 0.5rem 0.75rem;
        background-color: rgba(255, 255, 255, 0.85);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }
    .toast-body {
        padding: 0.75rem;
    }
    .toast-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        background: var(--primary-color);
        width: 0;
        transition: width linear;
    }

    /* Help tooltip */
    .help-tooltip {
        display: inline-block;
        position: relative;
        margin-left: 5px;
        color: #6c757d;
        cursor: pointer;
    }
    .help-tooltip:hover {
        color: var(--primary-color);
    }
    .tooltip-content {
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: #333;
        color: white;
        padding: 5px 10px;
        border-radius: 3px;
        font-size: 12px;
        width: 200px;
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s;
        z-index: 100;
    }
    .help-tooltip:hover .tooltip-content {
        visibility: visible;
        opacity: 1;
    }

    /* Autosave indicator */
    .autosave-indicator {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 10px 15px;
        border-radius: 20px;
        font-size: 12px;
        z-index: 9999;
        display: none;
    }
    .autosave-indicator.show {
        display: block;
        animation: fadeInOut 2s;
    }
    @keyframes fadeInOut {
        0% { opacity: 0; }
        15% { opacity: 1; }
        85% { opacity: 1; }
        100% { opacity: 0; }
    }

    /* Field highlighting for keyboard navigation */
    .keyboard-focus {
        outline: 2px solid var(--primary-color) !important;
        box-shadow: 0 0 0 0.2rem rgba(var(--primary-rgb), 0.25) !important;
    }

    /* Ribbon for new fields */
    .new-feature {
        position: absolute;
        top: -10px;
        right: -10px;
        background: var(--primary-color);
        color: white;
        font-size: 10px;
        padding: 3px 8px;
        border-radius: 10px;
        z-index: 1;
    }

    /* Select2 customization */
    .select2-container--default .select2-selection--single {
        height: 38px;
        border-color: #ced4da;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
    .select2-container--default .select2-selection--multiple {
        border-color: #ced4da;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(var(--primary-rgb), 0.25);
    }

    /* Inline edit styles */
    .inline-edit-trigger {
        display: none;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--primary-color);
        cursor: pointer;
    }
    .editable-field:hover .inline-edit-trigger {
        display: block;
    }
    .editable-field.editing input {
        border: 1px solid var(--primary-color);
        padding-right: 60px;
    }
    .editable-field.editing .inline-edit-actions {
        display: flex;
    }
    .inline-edit-actions {
        display: none;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }
    .inline-edit-actions button {
        margin-left: 5px;
        padding: 0;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
<link rel="stylesheet" href="{{ asset('assets/css/biometric.css') }}">
<!-- Modern Form Elements CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
@endsection

@section('content')
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
        <div>
            <nav>
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="{{ route('staffs') }}">Staff</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                </ol>
            </nav>
            <h1 class="page-title fw-medium fs-18 mb-0">Profile Settings</h1>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row justify-content-center">
        <!-- Toast notification container -->
        <div class="toast-container" id="toast-container"></div>

        <!-- Autosave indicator -->
        <div class="autosave-indicator" id="autosave-indicator">
            <i class="ri-save-line me-1"></i> Saving changes...
        </div>

        <div class="col-xl-3">
            <div class="card custom-card overflow-hidden border">
                <div class="card-body border-bottom border-block-end-dashed">
                    <div class="text-center">
                        <span class="avatar avatar-xxl avatar-rounded online mb-3">
                            <img id="profile-sidebar-image" src="{{ $staff->profile_picture_url ?? asset('assets/images/faces/11.jpg')}}" alt="">
                        </span>
                        <h5 class="fw-semibold mb-1" id="sidebar-name">{{ $staff->full_name ?? auth()->user()->name }}</h5>
                        <span class="d-block fw-medium text-muted mb-2" id="sidebar-designation">{{ $staff->designation ?? 'Not Set' }}</span>
                    </div>
                </div>
                <div class="p-3 pb-1">
                    <div class="fw-medium fs-15 text-primary1">Basic Info:</div>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item pt-2 border-0">
                            <div><span class="fw-medium me-2">Staff ID:</span><span class="text-muted" id="sidebar-staffid">{{ $staff->staff_code ?? 'Not Set' }}</span></div>
                        </li>
                        <li class="list-group-item pt-2 border-0">
                            <div><span class="fw-medium me-2">Department:</span><span class="text-muted" id="sidebar-department">{{ $staff->department ?? 'Not Set' }}</span></div>
                        </li>
                        <li class="list-group-item pt-2 border-0">
                            <div><span class="fw-medium me-2">Email:</span><span class="text-muted" id="sidebar-email">{{ $staff->email ?? $user->email ?? 'Not Set' }}</span></div>
                        </li>
                        <li class="list-group-item pt-2 border-0">
                            <div><span class="fw-medium me-2">Phone:</span><span class="text-muted" id="sidebar-phone">{{ $staff->phone ?? $user->mobile ?? 'Not Set' }}</span></div>
                        </li>
                    </ul>
                </div>

                <!-- Form activity log -->
                <div class="p-3 pb-1 mt-2 border-top">
                    <div class="fw-medium fs-15 text-primary1">Activity:</div>
                    <div id="form-activity-log" class="mt-2">
                        <div class="d-flex align-items-center mb-2">
                            <i class="ri-time-line me-2 text-muted"></i>
                            <small class="text-muted">Last updated: <span id="last-update-time">-</span></small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="ri-save-line me-2 text-muted"></i>
                            <small class="text-muted">Autosaved: <span id="autosave-count">0</span> times</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="ri-edit-line me-2 text-muted"></i>
                            <small class="text-muted">Changes: <span id="change-count">0</span></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div class="card custom-card">
                <form id="profile-settings-form" action="{{ route('staffupdate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="staff_id" value="{{ $staff->id ?? '' }}">

                    <!-- Loading overlay -->
                    {{-- <div id="loading-overlay" style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.85); z-index: 1000; display: flex; justify-content: center; align-items: center;">
                        <div class="d-flex flex-column align-items-center">
                            <div class="spinner-border text-primary mb-3" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div id="loading-text">Loading staff data...</div>
                        </div>
                    </div> --}}

                    <!-- Skeleton loading screen -->
                    <div id="skeleton-loading" style="display: none;">
                        <div class="p-3">
                            <div class="skeleton-loader title mb-4"></div>
                            <div class="row mb-4">
                                <div class="col-md-4 mb-3">
                                    <div class="skeleton-loader avatar mb-2"></div>
                                    <div class="skeleton-loader text"></div>
                                </div>
                                <div class="col-md-8">
                                    <div class="skeleton-loader mb-3"></div>
                                    <div class="skeleton-loader mb-3"></div>
                                    <div class="skeleton-loader mb-3"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="skeleton-loader text"></div>
                                    <div class="skeleton-loader"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="skeleton-loader text"></div>
                                    <div class="skeleton-loader"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="skeleton-loader text"></div>
                                    <div class="skeleton-loader"></div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="skeleton-loader text"></div>
                                    <div class="skeleton-loader"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="form-messages" class="m-3"></div>

                    <ul class="nav nav-tabs tab-style-8 scaleX rounded m-3 profile-settings-tab gap-2" id="myTab4" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 bg-primary-transparent active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal-pane" type="button" role="tab" aria-controls="personal-pane" aria-selected="true">
                                <i class="ri-user-3-line me-1"></i> Personal Info
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 bg-primary-transparent" id="professional-tab" data-bs-toggle="tab" data-bs-target="#professional-pane" type="button" role="tab" aria-controls="professional-pane" aria-selected="false">
                                <i class="ri-briefcase-4-line me-1"></i> Professional
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 bg-primary-transparent" id="financial-tab" data-bs-toggle="tab" data-bs-target="#financial-pane" type="button" role="tab" aria-controls="financial-pane" aria-selected="false">
                                <i class="ri-bank-line me-1"></i> Financial
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 bg-primary-transparent" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents-pane" type="button" role="tab" aria-controls="documents-pane" aria-selected="false">
                                <i class="ri-file-list-3-line me-1"></i> Documents
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 bg-primary-transparent" id="emergency-tab" data-bs-toggle="tab" data-bs-target="#emergency-pane" type="button" role="tab" aria-controls="emergency-pane" aria-selected="false">
                                <i class="ri-alarm-warning-line me-1"></i> Emergency
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link px-4 bg-primary-transparent" id="biometric-tab" data-bs-toggle="tab" data-bs-target="#biometric-pane" type="button" role="tab" aria-controls="biometric-pane" aria-selected="false">
                                <i class="ri-fingerprint-line me-1"></i> Biometric
                            </button>
                        </li>
                    </ul>

                    <div class="p-3 border-bottom border-top tab-content">
                        <!-- Personal Information Tab -->
                        <div class="tab-pane show active overflow-hidden p-0 border-0" id="personal-pane" role="tabpanel" aria-labelledby="personal-tab" tabindex="0">
                            <div class="row gy-3 form-section" id="personal-section">
                                <div class="col-xl-12 mb-4">
                                    <div class="card">
                                        <div class="card-header py-2">
                                            <h6 class="card-title mb-0">Profile Picture</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="dropzone" id="profile-picture-dropzone">
                                                <div class="dz-message needsclick">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <div class="avatar avatar-xxl avatar-rounded mb-3">
                                                            <img id="profile-picture-preview" src="{{ $staff->profile_picture_url ?? asset('assets/images/faces/9.jpg') }}" alt="Profile Picture">
                                                        </div>
                                                        <h5 class="mb-2">Drop image here or click to upload</h5>
                                                        <p class="text-muted mb-0">Accepts: JPEG, PNG, GIF. Max size: 2MB</p>
                                                    </div>
                                                </div>
                                                <input type="file" id="profile_picture" name="profile_picture" class="d-none" accept="image/jpeg,image/png,image/gif">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="first_name" class="form-label">First Name <span class="required">*</span></label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ $staff->first_name ?? old('first_name') }}" required>
                                        <i class="ri-check-line is-valid-icon"></i>
                                        <i class="ri-close-line is-invalid-icon"></i>
                                        <div class="invalid-feedback">Please enter a valid first name</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="last_name" class="form-label">Last Name <span class="required">*</span></label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ $staff->last_name ?? old('last_name') }}" required>
                                        <i class="ri-check-line is-valid-icon"></i>
                                        <i class="ri-close-line is-invalid-icon"></i>
                                        <div class="invalid-feedback">Please enter a valid last name</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="email" class="form-label">Email <span class="required">*</span>
                                            <span class="help-tooltip">
                                                <i class="ri-question-line"></i>
                                                <span class="tooltip-content">This email will be used for login and notifications</span>
                                            </span>
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $staff->email ?? old('email') }}" required>

                                        <div class="invalid-feedback">Please enter a valid email address</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="phone" class="form-label">Phone Number <span class="required">*</span></label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $staff->phone ?? old('phone') }}" required placeholder="+91 XXXXXXXXXX">

                                        <div class="invalid-feedback">Please enter a valid phone number</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="alt_phone" class="form-label">Alternative Phone</label>
                                        <input type="tel" class="form-control @error('alt_phone') is-invalid @enderror" id="alt_phone" name="alt_phone" value="{{ $staff->alt_phone ?? old('alt_phone') }}" placeholder="+91 XXXXXXXXXX">

                                        <div class="invalid-feedback">Please enter a valid phone number</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                                        <input type="text" class="form-control datepicker @error('date_of_birth') is-invalid @enderror" id="date_of_birth" name="date_of_birth" value="{{ $staff->date_of_birth ?? old('date_of_birth') }}" placeholder="Select date...">

                                        <div class="invalid-feedback">Please select a valid date</div>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="card mb-3">
                                        <div class="card-header py-2">
                                            <h6 class="card-title mb-0">Address Information</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">


                                                <div class="col-xl-12 mb-3">
                                                    <div class="form-field-wrapper">
                                                        <label for="address" class="form-label">Address <span class="required">*</span></label>
                                                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="2" required>{{ $staff->address ?? old('address') }}</textarea>
                                                        <div class="invalid-feedback">Please enter your address</div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4">
                                                    <div class="form-field-wrapper">
                                                        <label for="city" class="form-label">City <span class="required">*</span></label>
                                                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ $staff->city ?? old('city') }}" required>

                                                        <div class="invalid-feedback">Please enter your city</div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4">
                                                    <div class="form-field-wrapper">
                                                        <label for="state" class="form-label">State <span class="required">*</span></label>
                                                        <select class="form-select select2 @error('state') is-invalid @enderror" id="state" name="state" required>
                                                            <option value="">Select State</option>
                                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                                            <option value="Assam">Assam</option>
                                                            <option value="Bihar">Bihar</option>
                                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                                            <option value="Goa">Goa</option>
                                                            <option value="Gujarat">Gujarat</option>
                                                            <option value="Haryana">Haryana</option>
                                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                                            <option value="Jharkhand">Jharkhand</option>
                                                            <option value="Karnataka">Karnataka</option>
                                                            <option value="Kerala">Kerala</option>
                                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                                            <option value="Maharashtra">Maharashtra</option>
                                                            <option value="Manipur">Manipur</option>
                                                            <option value="Meghalaya">Meghalaya</option>
                                                            <option value="Mizoram">Mizoram</option>
                                                            <option value="Nagaland">Nagaland</option>
                                                            <option value="Odisha">Odisha</option>
                                                            <option value="Punjab">Punjab</option>
                                                            <option value="Rajasthan">Rajasthan</option>
                                                            <option value="Sikkim">Sikkim</option>
                                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                                            <option value="Telangana">Telangana</option>
                                                            <option value="Tripura">Tripura</option>
                                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                                            <option value="Uttarakhand">Uttarakhand</option>
                                                            <option value="West Bengal">West Bengal</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select your state</div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-4">
                                                    <div class="form-field-wrapper">
                                                        <label for="pincode" class="form-label">Pincode <span class="required">*</span></label>
                                                        <input type="text" class="form-control @error('pincode') is-invalid @enderror" id="pincode" name="pincode" value="{{ $staff->pincode ?? old('pincode') }}" required maxlength="6">

                                                        <div class="invalid-feedback">Please enter a valid 6-digit pincode</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Professional Details Tab -->
                        <div class="tab-pane overflow-hidden p-0 border-0" id="professional-pane" role="tabpanel" aria-labelledby="professional-tab" tabindex="0">
                            <div class="row gy-3 form-section" id="professional-section">
                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="designation" class="form-label">Designation <span class="required">*</span></label>
                                        <select class="form-select select2 @error('designation') is-invalid @enderror" id="designation" name="designation" required>
                                            <option value="">Select Designation</option>
                                            <option value="CEO">CEO</option>
                                            <option value="CTO">CTO</option>
                                            <option value="Manager">Manager</option>
                                            <option value="Team Lead">Team Lead</option>
                                            <option value="Senior Developer">Senior Developer</option>
                                            <option value="Developer">Developer</option>
                                            <option value="Designer">Designer</option>
                                            <option value="HR Manager">HR Manager</option>
                                            <option value="HR Executive">HR Executive</option>
                                            <option value="Accountant">Accountant</option>
                                            <option value="Office Assistant">Office Assistant</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a designation</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="department" class="form-label">Department <span class="required">*</span></label>
                                        <select class="form-select select2 @error('department') is-invalid @enderror" id="department" name="department" required>
                                            <option value="">Select Department</option>
                                            <option value="Executive">Executive</option>
                                            <option value="Management">Management</option>
                                            <option value="Engineering">Engineering</option>
                                            <option value="Design">Design</option>
                                            <option value="Marketing">Marketing</option>
                                            <option value="Sales">Sales</option>
                                            <option value="Human Resources">Human Resources</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Information Technology">Information Technology</option>
                                            <option value="Customer Support">Customer Support</option>
                                            <option value="Administration">Administration</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a department</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="staff_code" class="form-label">Staff ID</label>
                                        <input type="text" class="form-control @error('staff_code') is-invalid @enderror" id="staff_code" name="staff_code" value="{{ $staff->staff_code ?? old('staff_code') }}" readonly>
                                        <div class="invalid-feedback">Please enter a valid staff ID</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="reporting_to" class="form-label">Reporting Manager</label>
                                        <select class="form-select select2 @error('reporting_to') is-invalid @enderror" id="reporting_to" name="reporting_to">
                                            <option value="">Select Manager</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a reporting manager</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="joining_date" class="form-label">Joining Date</label>
                                        <input type="text" class="form-control datepicker @error('joining_date') is-invalid @enderror" id="joining_date" name="joining_date" value="{{ $staff->joining_date ?? old('joining_date') }}" placeholder="Select date...">
                                        <div class="invalid-feedback">Please select a valid date</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="experience_years" class="form-label">Experience (Years)</label>
                                        <input type="number" class="form-control @error('experience_years') is-invalid @enderror" id="experience_years" name="experience_years" value="{{ $staff->experience_years ?? old('experience_years') }}">
                                        <div class="invalid-feedback">Please enter a valid number</div>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="form-field-wrapper">
                                        <label for="skills" class="form-label">Skills</label>
                                        <select class="form-select select2-tags @error('skills') is-invalid @enderror" id="skills" name="skills[]" multiple>
                                            <option value="Communication">Communication</option>
                                            <option value="Leadership">Leadership</option>
                                            <option value="Management">Management</option>
                                            <option value="Problem Solving">Problem Solving</option>
                                            <option value="Teamwork">Teamwork</option>
                                            <option value="Time Management">Time Management</option>
                                            <option value="Microsoft Office">Microsoft Office</option>
                                            <option value="Programming">Programming</option>
                                            <option value="Project Management">Project Management</option>
                                        </select>
                                        <div class="invalid-feedback">Please enter valid skills</div>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <div class="form-field-wrapper">
                                        <label for="certifications" class="form-label">Certifications</label>
                                        <select class="form-select select2-tags @error('certifications') is-invalid @enderror" id="certifications" name="certifications[]" multiple>
                                        </select>
                                        <div class="invalid-feedback">Please enter valid certifications</div>
                                    </div>
                                </div>

                                <div class="col-xl-12 mt-3">
                                    <div class="card">
                                        <div class="card-header py-2">
                                            <h6 class="card-title mb-0">Blood Group</h6>
                                        </div>
                                        <div class="card-body">
                                            <input type="hidden" name="blood_group" id="blood_group_input" value="{{ $staff->blood_group ?? old('blood_group') }}">
                                            <div class="card-selection">
                                                <div class="card-option" data-value="A+">
                                                    <i class="ri-drop-line text-danger"></i>
                                                    <span>A+</span>
                                                </div>
                                                <div class="card-option" data-value="A-">
                                                    <i class="ri-drop-line text-danger"></i>
                                                    <span>A-</span>
                                                </div>
                                                <div class="card-option" data-value="B+">
                                                    <i class="ri-drop-line text-danger"></i>
                                                    <span>B+</span>
                                                </div>
                                                <div class="card-option" data-value="B-">
                                                    <i class="ri-drop-line text-danger"></i>
                                                    <span>B-</span>
                                                </div>
                                                <div class="card-option" data-value="AB+">
                                                    <i class="ri-drop-line text-danger"></i>
                                                    <span>AB+</span>
                                                </div>
                                                <div class="card-option" data-value="AB-">
                                                    <i class="ri-drop-line text-danger"></i>
                                                    <span>AB-</span>
                                                </div>
                                                <div class="card-option" data-value="O+">
                                                    <i class="ri-drop-line text-danger"></i>
                                                    <span>O+</span>
                                                </div>
                                                <div class="card-option" data-value="O-">
                                                    <i class="ri-drop-line text-danger"></i>
                                                    <span>O-</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Financial Information Tab -->
                        <div class="tab-pane overflow-hidden p-0 border-0" id="financial-pane" role="tabpanel" aria-labelledby="financial-tab" tabindex="0">
                            <div class="row gy-3 form-section" id="financial-section">
                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="basic_salary" class="form-label">Basic Salary</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₹</span>
                                            <input type="number" class="form-control @error('basic_salary') is-invalid @enderror" id="basic_salary" name="basic_salary" value="{{ $staff->basic_salary ?? old('basic_salary') }}">
                                        </div>
                                        <div class="invalid-feedback">Please enter a valid amount</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="bank_name" class="form-label">Bank Name</label>
                                        <select class="form-select select2 @error('bank_name') is-invalid @enderror" id="bank_name" name="bank_name">
                                            <option value="">Select Bank</option>
                                            <option value="State Bank of India">State Bank of India</option>
                                            <option value="HDFC Bank">HDFC Bank</option>
                                            <option value="ICICI Bank">ICICI Bank</option>
                                            <option value="Axis Bank">Axis Bank</option>
                                            <option value="Kotak Mahindra Bank">Kotak Mahindra Bank</option>
                                            <option value="Bank of Baroda">Bank of Baroda</option>
                                            <option value="Punjab National Bank">Punjab National Bank</option>
                                            <option value="Canara Bank">Canara Bank</option>
                                            <option value="Union Bank of India">Union Bank of India</option>
                                            <option value="IDBI Bank">IDBI Bank</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a bank</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="bank_account_no" class="form-label">Bank Account No</label>
                                        <input type="text" class="form-control @error('bank_account_no') is-invalid @enderror" id="bank_account_no" name="bank_account_no" value="{{ $staff->bank_account_no ?? old('bank_account_no') }}">
                                        <div class="invalid-feedback">Please enter a valid bank account number</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="ifsc_code" class="form-label">IFSC Code</label>
                                        <input type="text" class="form-control @error('ifsc_code') is-invalid @enderror" id="ifsc_code" name="ifsc_code" value="{{ $staff->ifsc_code ?? old('ifsc_code') }}">
                                        <div class="invalid-feedback">Please enter a valid IFSC code</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="pan_number" class="form-label">PAN Number</label>
                                        <input type="text" class="form-control @error('pan_number') is-invalid @enderror" id="pan_number" name="pan_number" value="{{ $staff->pan_number ?? old('pan_number') }}">
                                        <div class="invalid-feedback">Please enter a valid PAN number</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="aadhar_number" class="form-label">Aadhar Number</label>
                                        <input type="text" class="form-control @error('aadhar_number') is-invalid @enderror" id="aadhar_number" name="aadhar_number" value="{{ $staff->aadhar_number ?? old('aadhar_number') }}">
                                        <div class="invalid-feedback">Please enter a valid 12-digit Aadhar number</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documents Tab -->
                        <div class="tab-pane overflow-hidden p-0 border-0" id="documents-pane" role="tabpanel" aria-labelledby="documents-tab" tabindex="0">
                            <div class="row gy-3">
                                <div class="col-xl-12">
                                    <div class="document-upload-section">
                                        <div class="card">
                                            <div class="card-header py-2">
                                                <h6 class="card-title mb-0">Document Upload</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="dropzone" id="document-dropzone">
                                                    <div class="dz-message">
                                                        <div class="text-center">
                                                            <i class="ri-upload-cloud-2-line display-4 text-muted mb-2"></i>
                                                            <h5>Drop files here or click to upload</h5>
                                                            <p class="text-muted">Upload relevant documents (PDF, DOC, DOCX)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="dropzone-previews mt-3" id="document-previews"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if(isset($staff->documents) && $staff->documents)
                                <div class="col-xl-12 mt-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h6 class="mb-0">Existing Documents</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row" id="existing-documents">
                                                <div class="col-md-4">
                                                    <div class="card mb-2">
                                                        <div class="card-body p-2">
                                                            <div class="d-flex align-items-center">
                                                                <i class="ri-file-text-line me-2 fs-24"></i>
                                                                <div class="flex-grow-1">
                                                                    <h6 class="mb-0 text-truncate">{{ $staff->documents }}</h6>
                                                                    <small class="text-muted">Document</small>
                                                                </div>
                                                                <div class="dropdown">
                                                                    <button class="btn btn-sm p-0" type="button" data-bs-toggle="dropdown">
                                                                        <i class="ri-more-2-fill"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item" href="#"><i class="ri-download-line me-2"></i>Download</a></li>
                                                                        <li><a class="dropdown-item text-danger" href="#"><i class="ri-delete-bin-line me-2"></i>Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Emergency Tab -->
                        <div class="tab-pane overflow-hidden p-0 border-0" id="emergency-pane" role="tabpanel" aria-labelledby="emergency-tab" tabindex="0">
                            <div class="row gy-3 form-section" id="emergency-section">
                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="emergency_contact_name" class="form-label">Emergency Contact Name</label>
                                        <input type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror" id="emergency_contact_name" name="emergency_contact_name" value="{{ $staff->emergency_contact_name ?? old('emergency_contact_name') }}">
                                        <div class="invalid-feedback">Please enter a valid name</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="emergency_contact_phone" class="form-label">Emergency Contact Phone</label>
                                        <input type="tel" class="form-control @error('emergency_contact_phone') is-invalid @enderror" id="emergency_contact_phone" name="emergency_contact_phone" value="{{ $staff->emergency_contact_phone ?? old('emergency_contact_phone') }}">
                                        <div class="invalid-feedback">Please enter a valid phone number</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="emergency_contact_relation" class="form-label">Relationship</label>
                                        <select class="form-select select2 @error('emergency_contact_relation') is-invalid @enderror" id="emergency_contact_relation" name="emergency_contact_relation">
                                            <option value="">Select Relationship</option>
                                            <option value="Spouse">Spouse</option>
                                            <option value="Parent">Parent</option>
                                            <option value="Child">Child</option>
                                            <option value="Sibling">Sibling</option>
                                            <option value="Friend">Friend</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <div class="invalid-feedback">Please select a relationship</div>
                                    </div>
                                </div>

                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="emergency_contact_address" class="form-label">Emergency Contact Address</label>
                                        <textarea class="form-control @error('emergency_contact_address') is-invalid @enderror" id="emergency_contact_address" name="emergency_contact_address" rows="2">{{ $staff->emergency_contact_address ?? old('emergency_contact_address') }}</textarea>
                                        <div class="invalid-feedback">Please enter a valid address</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Biometric Tab -->
                        <div class="tab-pane overflow-hidden p-0 border-0" id="biometric-pane" role="tabpanel" aria-labelledby="biometric-tab" tabindex="0">
                            <div class="row gy-3">
                                <div class="col-xl-12">
                                    <div class="biometric-section">
                                        <h5><i class="ri-fingerprint-line"></i> Fingerprint Authentication</h5>
                                        <p class="biometric-info">Enroll up to three fingerprints for secure authentication. Registered fingerprints can be used to log in to your account.</p>

                                        <div class="fingerprint-container">
                                            @php
                                                $fingerprints = json_decode($user->fingerprints ?? '{}', true) ?? [];
                                            @endphp

                                            @for ($i = 1; $i <= 3; $i++)
                                                <div class="fingerprint-indicator {{ isset($fingerprints[$i]) ? 'enrolled' : 'not-enrolled' }}" data-key-index="{{ $i }}">
                                                    <i class="ri-fingerprint-2-line"></i>
                                                    <div class="fingerprint-label">Finger {{ $i }}</div>
                                                    @if(isset($fingerprints[$i]))
                                                        <div class="fingerprint-actions">
                                                            <button type="button" class="btn btn-danger btn-sm rounded-circle biometric-remove-btn" data-key-index="{{ $i }}" title="Remove fingerprint">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endfor
                                        </div>

                                        <div class="text-center mt-3">
                                            <button type="button" class="btn btn-primary biometric-enroll-btn" data-key-index="1">
                                                <i class="ri-fingerprint-line me-1"></i> Enroll New Fingerprint
                                            </button>
                                        </div>

                                        <div class="alert alert-info mt-4">
                                            <i class="ri-information-line me-2"></i>
                                            <strong>Note:</strong> Fingerprint authentication requires a compatible device with a fingerprint sensor.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <div id="form-messages" class="mb-3"></div>
                            <button type="submit" class="btn btn-primary" id="submitBtn">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- Required external scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="{{ asset('assets/js/biometric.js') }}"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 for all select elements with proper configuration
    $('.select2').select2({
        placeholder: "Select an option",
        allowClear: true,
        width: '100%',
        dropdownParent: $('body')
    });

    // Set initial values for select elements
    @if(isset($staff) && $staff->department)
        $('#department').val('{{ $staff->department }}').trigger('change');
    @endif

    @if(isset($staff) && $staff->designation)
        $('#designation').val('{{ $staff->designation }}').trigger('change');
    @endif

    @if(isset($staff) && $staff->state)
        $('#state').val('{{ $staff->state }}').trigger('change');
    @endif

    @if(isset($staff) && $staff->emergency_contact_relation)
        $('#emergency_contact_relation').val('{{ $staff->emergency_contact_relation }}').trigger('change');
    @endif

    @if(isset($staff) && $staff->bank_name)
        $('#bank_name').val('{{ $staff->bank_name }}').trigger('change');
    @endif

    // Initialize Select2 with tags for tag inputs
    $('.select2-tags').select2({
        placeholder: "Type and press Enter to add",
        tags: true,
        tokenSeparators: [',', ' '],
        width: '100%'
    });

    // Initialize Flatpickr date pickers
    $('.datepicker').flatpickr({
        dateFormat: "Y-m-d",
        allowInput: true,
        altInput: true,
        altFormat: "F j, Y"
    });

    // Profile picture preview
    $('#profile_picture').on('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profile-picture-preview').attr('src', e.target.result);
                $('#profile-sidebar-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Trigger file input when dropzone is clicked
    $('#profile-picture-dropzone').on('click', function() {
        $('#profile_picture').click();
    });

    // Handle blood group selection
    $('.card-option').on('click', function() {
        $('.card-option').removeClass('selected');
        $(this).addClass('selected');
        $('#blood_group_input').val($(this).data('value'));
    });

    // Set initial blood group selection if available
    @if(isset($staff) && $staff->blood_group)
        $('.card-option[data-value="{{ $staff->blood_group }}"]').addClass('selected');
    @endif

    // Form validation and submission
    $('#profile-settings-form').on('submit', function(e) {
        e.preventDefault();
        var isValid = true;
        var firstInvalid = null;

        // Check required fields
        $(this).find('input[required], textarea[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
                if (!firstInvalid) firstInvalid = $(this);
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        // Check required select2 fields
        $(this).find('select[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).next('.select2-container').addClass('is-invalid');
                if (!firstInvalid) firstInvalid = $(this);
            } else {
                $(this).next('.select2-container').removeClass('is-invalid');
            }
        });

        if (!isValid) {
            // Focus on the first invalid element
            if (firstInvalid) {
                firstInvalid.focus();
                // For select2, open the dropdown
                if ($(firstInvalid).hasClass('select2-hidden-accessible')) {
                    $(firstInvalid).select2('open');
                }
            }
            showToast("Please correct the errors in the form", "error");
            return false;
        }

        // Show loading state
        $('#submitBtn').attr('disabled', true);
        $('#submitBtn').html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...');

        // Submit the form using AJAX
        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status) {
                    // Show success message
                    showToast(response.message || "Staff information updated successfully", "success");

                    // Redirect after a delay
                    setTimeout(function() {
                        window.location.href = "{{ route('staffs') }}";
                    }, 2000);
                } else {
                    // Show error message
                    showToast(response.message || "Failed to update staff information", "error");

                    // Reset button
                    $('#submitBtn').attr('disabled', false);
                    $('#submitBtn').html('Save Changes');
                }
            },
            error: function(xhr) {
                // Handle validation errors
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    for (var field in errors) {
                        $('#' + field).addClass('is-invalid');
                        $('#' + field).next('.invalid-feedback').text(errors[field][0]);
                    }
                }

                // Show error message
                showToast("An error occurred while saving. Please try again.", "error");

                // Reset button
                $('#submitBtn').attr('disabled', false);
                $('#submitBtn').html('Save Changes');
            }
        });
    });

    // Function to show toast notifications
    function showToast(message, type = 'info') {
        const toastContainer = document.getElementById('toast-container');
        if (!toastContainer) return;

        const toastId = 'toast-' + Date.now();
        const iconClass = type === 'success' ? 'ri-check-line' :
                         type === 'error' ? 'ri-error-warning-line' :
                         type === 'warning' ? 'ri-alert-line' : 'ri-information-line';

        const toastHtml = `
            <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header ${type === 'success' ? 'bg-success text-white' :
                                        type === 'error' ? 'bg-danger text-white' :
                                        type === 'warning' ? 'bg-warning' : 'bg-info text-white'}">
                    <i class="${iconClass} me-2"></i>
                    <strong class="me-auto">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
                <div class="toast-progress"></div>
            </div>
        `;

        toastContainer.insertAdjacentHTML('beforeend', toastHtml);

        const toastElement = document.getElementById(toastId);
        const toast = new bootstrap.Toast(toastElement, { autohide: true, delay: 5000 });
        toast.show();

        // Animate progress bar
        const progressBar = toastElement.querySelector('.toast-progress');
        let width = 0;
        const interval = setInterval(() => {
            width += 2;
            progressBar.style.width = width + '%';
            if (width >= 100) {
                clearInterval(interval);
                setTimeout(() => {
                    toastElement.remove();
                }, 300);
            }
        }, 100);

        // Remove toast when hidden
        toastElement.addEventListener('hidden.bs.toast', function () {
            clearInterval(interval);
            toastElement.remove();
        });
    }

    // Make sure the personal section is properly displayed
    $('#personal-tab').on('shown.bs.tab', function() {
        $('#personal-section').show();
    });

    // Ensure all tabs are clickable
    $('.nav-tabs .nav-link').show();

    // Make sure the state dropdown works correctly
    $('#state').on('change', function() {
        $(this).removeClass('is-invalid');
    });
});
</script>
</script>

<script>
$(document).ready(function() {
    // Initialize Select2 elements with proper initialization
    $('.select2').each(function() {
        $(this).select2({
            width: '100%',
            placeholder: 'Select an option',
            allowClear: true,
            dropdownParent: $('body')
        });
    });

    // Set initial values for department and designation if they exist
    @if(isset($staff) && $staff->department)
        $('#department').val('{{ $staff->department }}').trigger('change');
    @endif

    @if(isset($staff) && $staff->designation)
        $('#designation').val('{{ $staff->designation }}').trigger('change');
    @endif

    @if(isset($staff) && $staff->state)
        $('#state').val('{{ $staff->state }}').trigger('change');
    @endif

    @if(isset($staff) && $staff->emergency_contact_relation)
        $('#emergency_contact_relation').val('{{ $staff->emergency_contact_relation }}').trigger('change');
    @endif

    @if(isset($staff) && $staff->bank_name)
        $('#bank_name').val('{{ $staff->bank_name }}').trigger('change');
    @endif

    // Initialize datepicker
    $('.datepicker').flatpickr({
        dateFormat: 'Y-m-d',
        allowInput: true
    });

    // Form validation
    $('#profile-settings-form').on('submit', function(e) {
        var isValid = true;
        var firstInvalid = null;

        // Remove required attribute temporarily for select2 elements to prevent browser validation
        // which can cause the 'not focusable' error
        $(this).find('select.select2[required]').each(function() {
            $(this).removeAttr('required');
            // Check validation
            var value = $(this).val();
            if (!value) {
                isValid = false;
                $(this).parent().addClass('is-invalid');
                if (!firstInvalid) firstInvalid = $(this);
            } else {
                $(this).parent().removeClass('is-invalid');
            }
        });

        // Check other required fields
        $(this).find('input[required], textarea[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid');
                if (!firstInvalid) firstInvalid = $(this);
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            // Focus on the first invalid element
            if (firstInvalid) {
                firstInvalid.focus();
                // For select2, open the dropdown
                if (firstInvalid.hasClass('select2')) {
                    firstInvalid.select2('open');
                }
            }
            return false;
        }
    });

    // Handle field validation on change
    $('select.select2').on('change', function() {
        if ($(this).val()) {
            $(this).parent().removeClass('is-invalid');
        } else {
            $(this).parent().addClass('is-invalid');
        }
    });

    $('input[required], textarea[required]').on('change keyup', function() {
        if ($(this).val()) {
            $(this).removeClass('is-invalid');
        } else {
            $(this).addClass('is-invalid');
        }
    });

    // Handle blood group selection
    $('.card-option').on('click', function() {
        $('.card-option').removeClass('selected');
        $(this).addClass('selected');
        $('#blood_group_input').val($(this).data('value'));
    });

    // Set initial blood group selection if available
    @if(isset($staff) && $staff->blood_group)
        $('.card-option[data-value="{{ $staff->blood_group }}"]').addClass('selected');
    @endif

    // Profile picture preview
    $('#profile_picture').on('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#profile-picture-preview').attr('src', e.target.result);
                $('#profile-sidebar-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    // Trigger file input when dropzone is clicked
    $('#profile-picture-dropzone').on('click', function() {
        $('#profile_picture').click();
    });
});


    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('profile-settings-form');
        const formMessages = document.getElementById('form-messages');
        const submitBtn = document.getElementById('submitBtn');
        const loadingOverlay = document.getElementById('loading-overlay');
        const skeletonLoading = document.getElementById('skeleton-loading');
        const autosaveIndicator = document.getElementById('autosave-indicator');
        const lastUpdateTime = document.getElementById('last-update-time');
        const autosaveCount = document.getElementById('autosave-count');
        const changeCount = document.getElementById('change-count');

        let autosaveTimer;
        let autosaveCounter = 0;
        let changeCounter = 0;
        let formState = {};
        let formInitialState = {};

        // Initialize Select2 for all select elements
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true,
            width: '100%',
            theme: 'bootstrap',
            dropdownParent: $('body')
        });

        // Initialize Select2 with tags for tag inputs
        $('.select2-tags').select2({
            placeholder: "Type and press Enter to add",
            tags: true,
            tokenSeparators: [',', ' '],
            width: '100%',
            theme: 'bootstrap'
        });

        // Initialize Flatpickr date pickers
        const datePickers = document.querySelectorAll('.datepicker');
        datePickers.forEach(picker => {
            flatpickr(picker, {
                dateFormat: "Y-m-d",
                allowInput: true,
                altInput: true,
                altFormat: "F j, Y",
                animate: true,
                onChange: function(selectedDates, dateStr) {
                    // Handle change event
                    updateField(picker.id, dateStr);
                    validateField(picker);
                }
            });
        });

        // Set up Dropzone for profile picture
        Dropzone.autoDiscover = false;
        const profileDropzone = new Dropzone("#profile-picture-dropzone", {
            url: "{{ route('staffupdate') }}",
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFilesize: 2,
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            maxFiles: 1,
            previewsContainer: false,
            clickable: true,
            createImageThumbnails: true,
            init: function() {
                this.on("addedfile", function(file) {
                    // Show preview
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('profile-picture-preview').src = e.target.result;
                        // Update sidebar image too
                        document.getElementById('profile-sidebar-image').src = e.target.result;
                    };
                    reader.readAsDataURL(file);

                    // Show success notification
                    showToast("Image selected. Save to update profile picture.", "success");
                });

                this.on("error", function(file, errorMessage) {
                    showToast("Error uploading image: " + errorMessage, "error");
                });
            }
        });

        // Set up Dropzone for documents
        const documentDropzone = new Dropzone("#document-dropzone", {
            url: "{{ route('staffupdate') }}",
            autoProcessQueue: false,
            uploadMultiple: true,
            maxFilesize: 5,
            acceptedFiles: '.pdf,.doc,.docx',
            paramName: "documents",
            addRemoveLinks: true,
            previewsContainer: "#document-previews",
            init: function() {
                this.on("addedfile", function(file) {
                    // Show success notification
                    showToast("Document added: " + file.name, "success");
                });

                this.on("removedfile", function(file) {
                    showToast("Document removed: " + file.name, "info");
                });
            }
        });

        // Initialize card-based selection for blood group
        const cardOptions = document.querySelectorAll('.card-option');
        const bloodGroupInput = document.getElementById('blood_group_input');

        if (cardOptions.length && bloodGroupInput) {
            // Set initial selection based on hidden input value
            if (bloodGroupInput.value) {
                cardOptions.forEach(card => {
                    if (card.dataset.value === bloodGroupInput.value) {
                        card.classList.add('selected');
                    }
                });
            }

            cardOptions.forEach(card => {
                card.addEventListener('click', function() {
                    // Remove selection from all cards
                    cardOptions.forEach(c => c.classList.remove('selected'));

                    // Add selection to clicked card
                    this.classList.add('selected');

                    // Update hidden input
                    bloodGroupInput.value = this.dataset.value;

                    // Trigger autosave
                    updateField('blood_group', this.dataset.value);

                    // Show visual feedback
                    showToast("Blood group updated to " + this.dataset.value, "success");
                });
            });
        }

        // Debounce function for handling rapid input
        function debounce(func, wait) {
            let timeout;
            return function() {
                const context = this;
                const args = arguments;
                clearTimeout(timeout);
                timeout = setTimeout(() => {
                    func.apply(context, args);
                }, wait);
            };
        }

        // Toast notification system
        function showToast(message, type = 'info', duration = 3000) {
            const toastContainer = document.getElementById('toast-container');

            // Create toast element
            const toast = document.createElement('div');
            toast.className = 'toast';

            // Set icon based on type
            let icon = 'ri-information-line';
            if (type === 'success') icon = 'ri-checkbox-circle-line';
            if (type === 'error') icon = 'ri-error-warning-line';
            if (type === 'warning') icon = 'ri-alert-line';

            // Set color based on type
            let color = 'primary';
            if (type === 'success') color = 'success';
            if (type === 'error') color = 'danger';
            if (type === 'warning') color = 'warning';

            // Create toast content
            toast.innerHTML = `
                <div class="p-3 bg-white rounded shadow">
                    <div class="d-flex align-items-center mb-1">
                        <i class="${icon} me-2 text-${color}"></i>
                        <strong class="me-auto">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                        <button type="button" class="btn-close" onclick="this.parentElement.parentElement.parentElement.remove()"></button>
                    </div>
                    <div class="text-dark">${message}</div>
                    <div class="toast-progress" style="background-color: var(--bs-${color})"></div>
                </div>
            `;

            // Add to container
            toastContainer.appendChild(toast);

            // Show container if hidden
            toastContainer.style.display = 'block';

            // Animate progress bar
            const progressBar = toast.querySelector('.toast-progress');
            progressBar.style.width = '0%';

            // Use requestAnimationFrame for smooth animation
            requestAnimationFrame(() => {
                progressBar.style.transition = `width ${duration}ms linear`;
                progressBar.style.width = '100%';
            });

            // Remove after duration
            setTimeout(() => {
                toast.classList.add('fade-out');
                setTimeout(() => {
                    toast.remove();
                    if (toastContainer.children.length === 0) {
                        toastContainer.style.display = 'none';
                    }
                }, 300);
            }, duration);
        }

        // Show autosave indicator
        function showAutosaveIndicator() {
            autosaveIndicator.classList.add('show');
            setTimeout(() => {
                autosaveIndicator.classList.remove('show');
            }, 2000);
        }

        // Update a form field with value
        function updateField(fieldId, value) {
            formState[fieldId] = value;
            formInitialState[fieldId] = formInitialState[fieldId] || value;

            // Track changes
            changeCounter++;
            changeCount.textContent = changeCounter;

            // Update timestamp
            lastUpdateTime.textContent = new Date().toLocaleTimeString();

            // Schedule autosave
            clearTimeout(autosaveTimer);
            autosaveTimer = setTimeout(() => {
                autosave();
            }, 2000);
        }

        // Perform autosave
        function autosave() {
            // Only autosave if there are changes
            if (Object.keys(formState).length > 0) {
                // Increment counter
                autosaveCounter++;
                autosaveCount.textContent = autosaveCounter;

                // Show indicator
                showAutosaveIndicator();

                // In a real implementation, you would send the changes to the server here
                console.log('Autosaving form data:', formState);

                // Clear the state after saving
                formState = {};
            }
        }

        // Add real-time validation and tracking for all form fields
        function setupFormFieldTracking() {
            const allFields = form.querySelectorAll('input, select, textarea');

            allFields.forEach(field => {
                // Skip hidden fields
                if (field.type === 'hidden') return;

                // Store initial value
                formInitialState[field.id] = field.value;

                // Handle input or change event for different field types
                const eventType = (field.tagName === 'SELECT' || field.type === 'checkbox' || field.type === 'radio') ? 'change' : 'input';

                field.addEventListener(eventType, debounce(function() {
                    // Remove error styling during typing
                    if (this.classList.contains('is-invalid')) {
                        this.classList.remove('is-invalid');
                        const wrapper = this.closest('.form-field-wrapper');
                        if (wrapper) {
                            wrapper.classList.remove('is-invalid');
                        }
                    }

                    // Update field in the form state
                    updateField(this.id, this.value);

                    // Update sidebar info if applicable
                    updateSidebarInfo(this.id, this.value);
                }, 300));

                // Validate on blur
                field.addEventListener('blur', function() {
                    validateField(this);
                });

                // Add keyboard navigation
                field.addEventListener('keydown', function(e) {
                    // Tab key is handled by the browser
                    // Enter key in the last field submits the form
                    if (e.key === 'Enter' && !this.classList.contains('select2-search__field') &&
                        this.tagName !== 'TEXTAREA' && this.type !== 'submit') {
                        e.preventDefault();

                        // Find the next field
                        const fields = Array.from(form.querySelectorAll('input:not([type="hidden"]), select, textarea, button[type="submit"]'));
                        const currentIndex = fields.indexOf(this);
                        if (currentIndex < fields.length - 1) {
                            const nextField = fields[currentIndex + 1];
                            nextField.focus();
                        }
                    }
                });
            });
        }

        // Update sidebar information when certain fields change
        function updateSidebarInfo(fieldId, value) {
            // Map fields to sidebar elements
            const sidebarMap = {
                'first_name': updateName,
                'last_name': updateName,
                'email': updateField.bind(null, 'sidebar-email'),
                'phone': updateField.bind(null, 'sidebar-phone'),
                'designation': updateField.bind(null, 'sidebar-designation'),
                'department': updateField.bind(null, 'sidebar-department'),
                'staff_code': updateField.bind(null, 'sidebar-staffid')
            };

            // If there's a mapping for this field, update the sidebar
            if (sidebarMap[fieldId]) {
                sidebarMap[fieldId](value);
            }

            // Special handler for name (combines first and last name)
            function updateName() {
                const firstName = document.getElementById('first_name')?.value || '';
                const lastName = document.getElementById('last_name')?.value || '';
                const fullName = (firstName + ' ' + lastName).trim();

                if (fullName) {
                    const nameElement = document.getElementById('sidebar-name');
                    if (nameElement) nameElement.textContent = fullName;
                }
            }

            // General field updater
            function updateField(elementId, value) {
                const element = document.getElementById(elementId);
                if (element && value) element.textContent = value;
            }
        }

        // Field validation function
        function validateField(field) {
            // Skip validation for non-required empty fields
            if (!field.required && !field.value.trim()) {
                return true;
            }

            // Required field validation
            if (field.required && !field.value.trim()) {
                addInvalidFeedback(field, 'This field is required');
                return false;
            }

            // Type-specific validation
            if (field.type === 'email' && field.value.trim()) {
                if (!isValidEmail(field.value.trim())) {
                    addInvalidFeedback(field, 'Please enter a valid email address');
                    return false;
                }
            } else if (field.id === 'phone' && field.value.trim()) {
                if (!isValidPhone(field.value.trim())) {
                    addInvalidFeedback(field, 'Please enter a valid phone number');
                    return false;
                }
            } else if (field.id === 'pincode' && field.value.trim()) {
                if (!isValidPincode(field.value.trim())) {
                    addInvalidFeedback(field, 'Please enter a valid 6-digit pincode');
                    return false;
                }
            } else if (field.id === 'ifsc_code' && field.value.trim()) {
                if (!isValidIFSC(field.value.trim())) {
                    addInvalidFeedback(field, 'Please enter a valid IFSC code');
                    return false;
                }
            } else if (field.id === 'pan_number' && field.value.trim()) {
                if (!isValidPAN(field.value.trim())) {
                    addInvalidFeedback(field, 'Please enter a valid PAN number');
                    return false;
                }
            } else if (field.id === 'aadhar_number' && field.value.trim()) {
                if (!isValidAadhar(field.value.trim())) {
                    addInvalidFeedback(field, 'Please enter a valid 12-digit Aadhar number');
                    return false;
                }
            }

            // If we made it here, the field is valid
            addValidFeedback(field);
            return true;
        }

        // Add invalid feedback to a field
        function addInvalidFeedback(field, message) {
            field.classList.add('is-invalid');
            field.classList.remove('is-valid');

            const wrapper = field.closest('.form-field-wrapper');
            if (wrapper) {
                wrapper.classList.add('is-invalid');
                wrapper.classList.remove('is-valid');
            }

            // Find or create feedback element
            let feedback = field.nextElementSibling;
            if (!feedback || !feedback.classList.contains('invalid-feedback')) {
                // Remove any existing feedback
                const existingFeedback = wrapper ? wrapper.querySelector('.invalid-feedback') : null;
                if (existingFeedback) existingFeedback.remove();

                // Create new feedback
                feedback = document.createElement('div');
                feedback.classList.add('invalid-feedback');
                if (wrapper) {
                    wrapper.appendChild(feedback);
                } else {
                    field.parentNode.insertBefore(feedback, field.nextSibling);
                }
            }

            feedback.textContent = message;
        }

        // Add valid feedback to a field
        function addValidFeedback(field) {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');

            const wrapper = field.closest('.form-field-wrapper');
            if (wrapper) {
                wrapper.classList.remove('is-invalid');
                wrapper.classList.add('is-valid');
            }

            // Remove any invalid feedback
            const invalidFeedback = wrapper ? wrapper.querySelector('.invalid-feedback') : null;
            if (invalidFeedback) invalidFeedback.remove();
        }

        // Enhanced AJAX form submission
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            // Validate all required fields
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');

            requiredFields.forEach(field => {
                if (!validateField(field)) {
                    isValid = false;
                }
            });

            if (!isValid) {
                // Scroll to first error
                const firstError = form.querySelector('.is-invalid');
                if (firstError) {
                    firstError.focus();
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }

                showToast("Please correct the errors in the form", "error");
                return;
            }

            // Show loading state
            loadingOverlay.style.display = 'flex';
            document.getElementById('loading-text').textContent = 'Saving changes...';
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Saving...';

            // Prepare data
            const formData = new FormData(form);

            // Add profile picture if selected in dropzone
            if (profileDropzone.files && profileDropzone.files.length > 0) {
                formData.append('profile_picture', profileDropzone.files[0]);
            }

            // Add documents if selected in dropzone
            if (documentDropzone.files && documentDropzone.files.length > 0) {
                documentDropzone.files.forEach((file, index) => {
                    formData.append(`documents[${index}]`, file);
                });
            }

            // Use fetch with timeout and retry mechanism
            fetchWithRetry(`{{ route('staffupdate') }}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Server returned ${response.status}: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                // Hide loading overlay
                loadingOverlay.style.display = 'none';

                if (data.status) {
                    // Show success animation
                    Swal.fire({
                        title: 'Success!',
                        text: data.message || 'Staff information updated successfully',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    }).then(() => {
                        // Redirect to staff list
                        window.location.href = "{{ route('staffs') }}";
                    });
                } else {
                    // Handle server validation errors
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const field = form.querySelector(`[name="${key}"]`);
                            if (field) {
                                addInvalidFeedback(field, data.errors[key][0]);
                            }
                        });

                        // Scroll to first error
                        const firstError = form.querySelector('.is-invalid');
                        if (firstError) {
                            firstError.focus();
                            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }

                    // Show error message
                    showToast(data.message || 'Failed to update staff information', 'error');

                    // Reset button
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Save Changes';
                }
            })
            .catch(error => {
                // Hide loading overlay
                loadingOverlay.style.display = 'none';

                // Show error message
                console.error('Error:', error);
                showToast('An error occurred: ' + error.message, 'error');

                // Reset button
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Save Changes';
            });
        });

        // Enhanced fetch with timeout and retry
        function fetchWithRetry(url, options, retries = 2, timeout = 30000) {
            return new Promise((resolve, reject) => {
                // Create abort controller for timeout
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), timeout);

                // Add signal to options
                const enhancedOptions = {
                    ...options,
                    signal: controller.signal
                };

                // Attempt fetch
                fetch(url, enhancedOptions)
                    .then(response => {
                        clearTimeout(timeoutId);
                        resolve(response);
                    })
                    .catch(error => {
                        clearTimeout(timeoutId);

                        // Handle timeout
                        if (error.name === 'AbortError') {
                            if (retries > 0) {
                                // Retry with exponential backoff
                                setTimeout(() => {
                                    fetchWithRetry(url, options, retries - 1, timeout)
                                        .then(resolve)
                                        .catch(reject);
                                }, 1000 * Math.pow(2, 2 - retries));
                            } else {
                                reject(new Error('Request timed out'));
                            }
                        } else {
                            reject(error);
                        }
                    });
            });
        }

        // Load staff data based on URL segment
        function loadStaffData() {
            // Get staff ID from URL path segment
            const pathSegments = window.location.pathname.split('/');
            const staffIdFromPath = pathSegments[pathSegments.length - 1];

            // If last segment is numeric, it's likely a staff ID
            if (staffIdFromPath && /^\d+$/.test(staffIdFromPath)) {
                const staffId = staffIdFromPath;

                // Set the hidden input value
                document.getElementById('staff_id').value = staffId;

                // Show skeleton loading screen
                if (skeletonLoading) {
                    skeletonLoading.style.display = 'block';
                }

                // Show loading overlay
                loadingOverlay.style.display = 'flex';
                document.getElementById('loading-text').textContent = 'Loading staff data...';

                // Clear any previous errors
                const errorContainer = document.getElementById('form-messages');
                if (errorContainer) {
                    errorContainer.innerHTML = '';
                }

                // Set up AbortController for timeout
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 30000); // Increase timeout to 30 seconds

                // Fetch staff data with retry logic
                fetch(`{{ url('/') }}/staffedit?id=${staffId}`, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    signal: controller.signal
                })
                    .then(response => {
                        clearTimeout(timeoutId);

                        if (!response.ok) {
                            throw new Error(`Failed to fetch staff data: ${response.status}`);
                        }

                        const contentType = response.headers.get('content-type');
                        if (!contentType || !contentType.includes('application/json')) {
                            throw new Error('Received non-JSON response from server');
                        }

                        return response.json();
                    })
                    .then(data => {
                        // Hide loading elements
                        loadingOverlay.style.display = 'none';
                        if (skeletonLoading) {
                            skeletonLoading.style.display = 'none';
                        }

                        console.log("Fetched staff data:", data);

                        if (data.staff) {
                            // Set the staff ID
                            document.getElementById('staff_id').value = data.staff.id;

                            // Show success toast
                            showToast("Staff data loaded successfully", "success");

                            // Update profile picture if available
                            if (data.staff.profile_picture_url) {
                                const profilePreview = document.getElementById('profile-picture-preview');
                                if (profilePreview) {
                                    profilePreview.src = data.staff.profile_picture_url;
                                }

                                const sidebarImage = document.getElementById('profile-sidebar-image');
                                if (sidebarImage) {
                                    sidebarImage.src = data.staff.profile_picture_url;
                                }
                            }

                            // Update sidebar information
                            updateSidebarElement('sidebar-name', data.staff.full_name || `${data.staff.first_name || ''} ${data.staff.last_name || ''}`);
                            updateSidebarElement('sidebar-designation', data.staff.designation);
                            updateSidebarElement('sidebar-department', data.staff.department);
                            updateSidebarElement('sidebar-email', data.staff.email);
                            updateSidebarElement('sidebar-phone', data.staff.phone);
                            updateSidebarElement('sidebar-staffid', data.staff.staff_code);

                            // Helper function for updating sidebar elements safely
                            function updateSidebarElement(id, value) {
                                const element = document.getElementById(id);
                                if (element) {
                                    element.textContent = value || 'Not Set';
                                }
                            }

                            // Define all field mappings with handling for different field types
                            const fieldMappings = [
                                {id: 'first_name', type: 'text'},
                                {id: 'last_name', type: 'text'},
                                {id: 'email', type: 'email'},
                                {id: 'phone', type: 'tel'},
                                {id: 'alt_phone', type: 'tel'},
                                {id: 'address', type: 'textarea'},
                                {id: 'city', type: 'text'},
                                {id: 'state', type: 'select'},
                                {id: 'pincode', type: 'text'},
                                {id: 'country', type: 'text'},
                                {id: 'staff_code', type: 'text'},
                                {id: 'designation', type: 'select'},
                                {id: 'department', type: 'select'},
                                {id: 'reporting_to', type: 'select'},
                                {id: 'joining_date', type: 'date'},
                                {id: 'date_of_birth', type: 'date'},
                                {id: 'experience_years', type: 'number'},
                                {id: 'skills', type: 'select-multiple'},
                                {id: 'certifications', type: 'select-multiple'},
                                {id: 'blood_group', type: 'card-selection'},
                                {id: 'basic_salary', type: 'number'},
                                {id: 'bank_name', type: 'select'},
                                {id: 'bank_account_no', type: 'text'},
                                {id: 'ifsc_code', type: 'text'},
                                {id: 'pan_number', type: 'text'},
                                {id: 'aadhar_number', type: 'text'},
                                {id: 'emergency_contact_name', type: 'text'},
                                {id: 'emergency_contact_phone', type: 'tel'},
                                {id: 'emergency_contact_relation', type: 'select'},
                                {id: 'emergency_contact_address', type: 'textarea'}
                            ];

                            // Populate form fields based on mapping
                            fieldMappings.forEach(mapping => {
                                const field = document.getElementById(mapping.id);
                                const value = data.staff[mapping.id];

                                if (field && value !== undefined) {
                                    try {
                                        switch (mapping.type) {
                                            case 'select':
                                                // For Select2 fields
                                                if ($(field).hasClass('select2-hidden-accessible')) {
                                                    // First check if the option exists
                                                    let optionExists = false;
                                                    $(field).find('option').each(function() {
                                                        if ($(this).val() === value) {
                                                            optionExists = true;
                                                            return false; // break the loop
                                                        }
                                                    });

                                                    // If option doesn't exist, create it
                                                    if (!optionExists && value) {
                                                        $(field).append(new Option(value, value, true, true));
                                                    }

                                                    // Set the value and trigger change
                                                    $(field).val(value).trigger('change');
                                                } else {
                                                    field.value = value;
                                                }
                                                break;

                                            case 'select-multiple':
                                                // For multi-select fields
                                                if ($(field).hasClass('select2-hidden-accessible')) {
                                                    // Handle comma-separated string or array
                                                    let values = value;
                                                    if (typeof value === 'string') {
                                                        values = value.split(',').map(v => v.trim());
                                                    }

                                                    // Create options if they don't exist
                                                    if (Array.isArray(values)) {
                                                        values.forEach(val => {
                                                            if (val && !$(field).find(`option[value="${val}"]`).length) {
                                                                $(field).append(new Option(val, val, false, false));
                                                            }
                                                        });
                                                        $(field).val(values).trigger('change');
                                                    }
                                                }
                                                break;

                                            case 'date':
                                                // For datepicker fields
                                                if (field.classList.contains('datepicker') && field._flatpickr) {
                                                    // Format date if needed
                                                    let dateValue = value;
                                                    if (value && typeof value === 'string' && !value.match(/^\d{4}-\d{2}-\d{2}$/)) {
                                                        // Try to parse and format the date if it's not in YYYY-MM-DD format
                                                        const date = new Date(value);
                                                        if (!isNaN(date.getTime())) {
                                                            dateValue = date.toISOString().split('T')[0];
                                                        }
                                                    }

                                                    if (dateValue) {
                                                        field._flatpickr.setDate(dateValue);
                                                    }
                                                } else {
                                                    field.value = value;
                                                }
                                                break;

                                            case 'card-selection':
                                                // For card-based selection (like blood group)
                                                if (field.id === 'blood_group_input') {
                                                    field.value = value;
                                                    // Select the correct card
                                                    document.querySelectorAll('.card-option').forEach(card => {
                                                        card.classList.remove('selected');
                                                        if (card.dataset.value === value) {
                                                            card.classList.add('selected');
                                                        }
                                                    });
                                                }
                                                break;

                                            default:
                                                // Default handling for text, number, etc.
                                                field.value = value;
                                        }

                                        // Validate the field
                                        validateField(field);
                                    } catch (err) {
                                        console.error(`Error setting value for field ${mapping.id}:`, err);
                                    }
                                }
                            });

                            // Start tracking form changes
                            setupFormFieldTracking();
                        } else {
                            // Show error if staff data not found
                            formMessages.innerHTML = `
                                <div class="alert alert-warning">
                                    <strong>Warning:</strong> Staff data not found for ID ${staffId}.
                                    <p class="mb-0">Please verify you are editing a valid staff record.</p>
                                </div>
                            `;
                            showToast("Staff data not found", "error");
                        }
                    })
                    .catch(error => {
                        // Hide loading elements
                        loadingOverlay.style.display = 'none';
                        if (skeletonLoading) {
                            skeletonLoading.style.display = 'none';
                        }

                        // Show error message
                        console.error('Error loading staff data:', error);
                        showToast(`Error loading staff data: ${error.message}`, "error");

                        // Show error in form messages
                        formMessages.innerHTML = `
                            <div class="alert alert-danger">
                                <strong>Error!</strong> Failed to load staff data: ${error.message}
                                <p class="mt-2 mb-0">Please try again or contact support.</p>
                            </div>
                        `;

                        // If this is likely a redirect issue, provide more helpful information
                        if (error.message.includes('Received non-JSON response')) {
                            showToast('The server might be redirecting instead of returning JSON data. Please check the staffedit route configuration.', 'warning', 8000);
                        }
                    });
            } else if (window.location.search.includes('id=')) {
                // Also check for query parameter format (backward compatibility)
                const urlParams = new URLSearchParams(window.location.search);
                const staffId = urlParams.get('id');

                if (staffId) {
                    document.getElementById('staff_id').value = staffId;
                    // Show loading and initiate the fetch
                    loadingOverlay.style.display = 'flex';
                    document.getElementById('loading-text').textContent = 'Loading staff data...';

                    // Redirect to the new URL format but maintain the staff ID
                    window.location.href = "{{ url('/') }}/profile-settings/" + staffId;
                }
            } else {
                // No staff ID found in either path or query params
                formMessages.innerHTML = `
                    <div class="alert alert-info">
                        <strong>Note:</strong> No staff ID found in URL. You are creating a new staff record.
                    </div>
                `;
            }
        }

        // Validation functions
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        function isValidPhone(phone) {
            // Allow formats like +91 1234567890, 1234567890, 123-456-7890
            const phoneRegex = /^(\+\d{1,3}\s?)?\d{10,15}$/;
            return phoneRegex.test(phone.replace(/\D/g, ''));
        }

        function isValidPincode(pincode) {
            // 6-digit number for Indian pincode
            const pincodeRegex = /^\d{6}$/;
            return pincodeRegex.test(pincode);
        }

        function isValidIFSC(ifsc) {
            // Indian Financial System Code: 11 characters
            const ifscRegex = /^[A-Z]{4}0[A-Z0-9]{6}$/;
            return !ifsc || ifscRegex.test(ifsc);
        }

        function isValidPAN(pan) {
            // PAN: 10 characters (5 alphabets + 4 digits + 1 alphabet)
            const panRegex = /^[A-Z]{5}[0-9]{4}[A-Z]{1}$/;
            return !pan || panRegex.test(pan);
        }

        function isValidAadhar(aadhar) {
            // Aadhar: 12 digits
            const aadharRegex = /^\d{12}$/;
            return !aadhar || aadharRegex.test(aadhar.replace(/\s/g, ''));
        }

        // Address autocomplete functionality removed

        // Initialize keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Save form with Ctrl+S
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                form.dispatchEvent(new Event('submit'));
            }

            // Navigate tabs with Ctrl+number
            if (e.ctrlKey && e.key >= '1' && e.key <= '6') {
                e.preventDefault();
                const tabIndex = parseInt(e.key) - 1;
                const tabs = document.querySelectorAll('.nav-link');
                if (tabs[tabIndex]) {
                    tabs[tabIndex].click();
                }
            }
        });

        // Initialize form field tracking
        setupFormFieldTracking();

        // Load staff data if ID is present in URL
        loadStaffData();
    });
</script>
@endsection
