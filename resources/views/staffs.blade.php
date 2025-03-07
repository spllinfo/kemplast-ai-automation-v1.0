@extends('layouts.app')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('styles')
<style>
    .modal-step {
        display: none;
    }
    .modal-step.active {
        display: block;
    }
    .step-indicator {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2rem;
    }
    .step-item {
        flex: 1;
        text-align: center;
        position: relative;
    }
    .step-item:not(:last-child):after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #e9ecef;
        z-index: 1;
    }
    .step-number {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: #e9ecef;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        position: relative;
        z-index: 2;
    }
    .step-item.active .step-number {
        background: var(--primary-color);
        color: white;
    }
    .step-item.completed .step-number {
        background: #28a745;
        color: white;
    }
    .form-field-wrapper {
        position: relative;
        margin-bottom: 1rem;
    }
    .form-field-wrapper label .required {
        color: #dc3545;
        margin-left: 2px;
    }
</style>
@endsection

@section('scripts')
<script>
    let currentStep = 1;
    const totalSteps = 3;

    function updateStepIndicators() {
        document.querySelectorAll('.step-item').forEach(item => {
            const stepNum = parseInt(item.dataset.step);
            item.classList.remove('active', 'completed');
            if (stepNum === currentStep) {
                item.classList.add('active');
            } else if (stepNum < currentStep) {
                item.classList.add('completed');
            }
        });
    }

    function showStep(step) {
        document.querySelectorAll('.modal-step').forEach(s => s.classList.remove('active'));
        document.querySelector(`.modal-step[data-step="${step}"]`).classList.add('active');

        const prevBtn = document.querySelector('.prev-step');
        const nextBtn = document.querySelector('.next-step');
        const submitBtn = document.querySelector('button[type="submit"]');

        prevBtn.style.display = step > 1 ? 'inline-block' : 'none';
        nextBtn.style.display = step < totalSteps ? 'inline-block' : 'none';
        submitBtn.style.display = step === totalSteps ? 'inline-block' : 'none';

        updateStepIndicators();
    }

    document.querySelector('.next-step').addEventListener('click', () => {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    });

    document.querySelector('.prev-step').addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    function resetStaffForm() {
        document.getElementById('staffForm').reset();
        document.getElementById('staff_id').value = '';
        currentStep = 1;
        showStep(1);
    }

    function editStaff(staffId) {
        fetch(`/api/staff/${staffId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('staff_id').value = data.id;
                document.getElementById('first_name').value = data.first_name;
                document.getElementById('last_name').value = data.last_name;
                document.getElementById('email').value = data.email;
                document.getElementById('phone').value = data.phone;
                document.getElementById('department').value = data.department;
                document.getElementById('designation').value = data.designation;
                document.getElementById('emergency_contact_name').value = data.emergency_contact_name || '';
                document.getElementById('emergency_contact_phone').value = data.emergency_contact_phone || '';

                if (data.profile_picture) {
                    document.getElementById('profile-preview').innerHTML =
                        `<img src="${data.profile_picture}" class="img-thumbnail" style="max-width: 200px">`;
                }

                new bootstrap.Modal(document.getElementById('staffModal')).show();
            });
    }

    document.getElementById('staffForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const staffId = document.getElementById('staff_id').value;
        const url = staffId ? `/api/staff/${staffId}` : '/api/staff';
        const method = staffId ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error saving staff data');
            }
        });
    });

    // Update edit button click handlers
    document.querySelectorAll('[onclick^="window.location.href"]').forEach(btn => {
        const href = btn.getAttribute('onclick');
        const staffId = href.match(/id=([^']+)/)[1];
        btn.setAttribute('onclick', `editStaff('${staffId}')`);
    });
</script>
@endsection

@section('content')

    <!-- Page Header -->
     <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
        <div>
            <nav>
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Team</li>
                </ol>
            </nav>
            <h1 class="page-title fw-medium fs-18 mb-0">Team Members</h1>
        </div>
        <div class="btn-list">
            <button type="button" class="modal-effect btn btn-white btn-wave" data-bs-effect="effect-slide-in-right" data-bs-toggle="modal"
            data-bs-target="#staffModal" onclick="resetStaffForm()">
        <i class="ri-file-add-line align-middle me-1 lh-1"></i> New
    </button>
            <button class="btn btn-primary3 btn-wave me-0">
                <i class="ri-download-2-line me-1"></i> Import
            </button>
            <button class="btn btn-primary btn-wave me-0">
                <i class="ri-share-forward-line me-1"></i> Export
            </button>
        </div>
    </div>
    <!-- Page Header Close -->


<!-- Start:: row-1 -->
<div class="row" id="staff-cards">
    @foreach($staffs as $staff)
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card custom-card team-member text-center">
            <div class="team-bg-shape primary"></div>
            <div class="card-body">
                <div class="mb-3 lh-1 d-flex gap-2 justify-content-center">
                    <span class="avatar avatar-xl avatar-rounded bg-primary">
                        <img src="{{ $staff->profile_picture }}" class="card-img" alt="{{ $staff->full_name }}">
                    </span>
                </div>
                <div class="">
                    <p class="mb-2 fs-11 badge bg-primary fw-medium">{{ $staff->designation }}</p>
                    <h6 class="mb-3 fw-semibold">{{ $staff->full_name }}</h6>
                    <p class="text-muted fs-12">{{ $staff->department }}</p>
                    <div class="d-flex justify-content-center">
                        <a aria-label="edit" href="javascript:void(0);" onclick="window.location.href='{{ route('profile.settings', ['id' => $staff->id]) }}'" class="btn btn-icon btn-primary-light btn-wave btn-sm"><i class="ri-edit-line"></i></a>
                        <a aria-label="phone" href="tel:{{ $staff->phone }}" class="btn btn-icon btn-primary1-light btn-wave btn-sm ms-2"><i class="ri-phone-line"></i></a>
                        <a aria-label="email" href="mailto:{{ $staff->email }}" class="btn btn-icon btn-primary2-light btn-wave btn-sm ms-2"><i class="ri-mail-send-line"></i></a>
                        <a aria-label="profile" href="{{ route('profile.settings', ['id' => $staff->id]) }}" class="btn btn-icon btn-primary3-light btn-wave btn-sm ms-2"><i class="ri-profile-line"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach
</div>


    <!-- Staff Modal -->
<div class="modal fade" id="staffModal" tabindex="-1" aria-labelledby="staffModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staffModalLabel">Staff Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="staffForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="staff_id" id="staff_id">

                    <ul class="nav nav-tabs nav-justified mb-4" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal-pane" type="button" role="tab" aria-controls="personal-pane" aria-selected="true">
                                <i class="ri-user-line me-2"></i> Personal Info
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="professional-tab" data-bs-toggle="tab" data-bs-target="#professional-pane" type="button" role="tab" aria-controls="professional-pane" aria-selected="false">
                                <i class="ri-briefcase-line me-2"></i> Professional
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="financial-tab" data-bs-toggle="tab" data-bs-target="#financial-pane" type="button" role="tab" aria-controls="financial-pane" aria-selected="false">
                                <i class="ri-money-dollar-circle-line me-2"></i> Financial
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents-pane" type="button" role="tab" aria-controls="documents-pane" aria-selected="false">
                                <i class="ri-file-list-line me-2"></i> Documents
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="emergency-tab" data-bs-toggle="tab" data-bs-target="#emergency-pane" type="button" role="tab" aria-controls="emergency-pane" aria-selected="false">
                                <i class="ri-alert-line me-2"></i> Emergency
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="biometric-tab" data-bs-toggle="tab" data-bs-target="#biometric-pane" type="button" role="tab" aria-controls="biometric-pane" aria-selected="false">
                                <i class="ri-fingerprint-line me-2"></i> Biometric
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Personal Info Tab -->
                        <div class="tab-pane fade show active" id="personal-pane" role="tabpanel" aria-labelledby="personal-tab">
                            <div class="row gy-3">
                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="first_name" class="form-label">First Name <span class="required">*</span></label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" required>
                                        <div class="invalid-feedback">Please enter your first name</div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="last_name" class="form-label">Last Name <span class="required">*</span></label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" required>
                                        <div class="invalid-feedback">Please enter your last name</div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="email" class="form-label">Email <span class="required">*</span></label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                                        <div class="invalid-feedback">Please enter a valid email address</div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="phone" class="form-label">Phone <span class="required">*</span></label>
                                        <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" required>
                                        <div class="invalid-feedback">Please enter a valid phone number</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Professional Tab -->
                        <div class="tab-pane fade" id="professional-pane" role="tabpanel" aria-labelledby="professional-tab">
                            <div class="row gy-3">
                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="department" class="form-label">Department <span class="required">*</span></label>
                                        <select class="form-select @error('department') is-invalid @enderror" id="department" name="department" required>
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
                                        <label for="designation" class="form-label">Designation <span class="required">*</span></label>
                                        <select class="form-select @error('designation') is-invalid @enderror" id="designation" name="designation" required>
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
                            </div>
                        </div>

                        <!-- Financial Tab -->
                        <div class="tab-pane fade" id="financial-pane" role="tabpanel" aria-labelledby="financial-tab">
                            <div class="row gy-3">
                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="basic_salary" class="form-label">Basic Salary</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₹</span>
                                            <input type="number" class="form-control @error('basic_salary') is-invalid @enderror" id="basic_salary" name="basic_salary">
                                        </div>
                                        <div class="invalid-feedback">Please enter a valid amount</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documents Tab -->
                        <div class="tab-pane fade" id="documents-pane" role="tabpanel" aria-labelledby="documents-tab">
                            <div class="row gy-3">
                                <div class="col-xl-12">
                                    <div class="form-field-wrapper">
                                        <label for="profile_picture" class="form-label">Profile Picture</label>
                                        <input type="file" class="form-control @error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture" accept="image/*">
                                        <div id="profile-preview" class="mt-2"></div>
                                        <div class="invalid-feedback">Please select a valid image file</div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="form-field-wrapper">
                                        <label for="documents" class="form-label">Additional Documents</label>
                                        <input type="file" class="form-control @error('documents') is-invalid @enderror" id="documents" name="documents[]" multiple>
                                        <div id="documents-preview" class="mt-2"></div>
                                        <div class="invalid-feedback">Please select valid document files</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Emergency Tab -->
                        <div class="tab-pane fade" id="emergency-pane" role="tabpanel" aria-labelledby="emergency-tab">
                            <div class="row gy-3">
                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="emergency_contact_name" class="form-label">Emergency Contact Name</label>
                                        <input type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror" id="emergency_contact_name" name="emergency_contact_name">
                                        <div class="invalid-feedback">Please enter emergency contact name</div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-field-wrapper">
                                        <label for="emergency_contact_phone" class="form-label">Emergency Contact Phone</label>
                                        <input type="tel" class="form-control @error('emergency_contact_phone') is-invalid @enderror" id="emergency_contact_phone" name="emergency_contact_phone">
                                        <div class="invalid-feedback">Please enter a valid emergency contact number</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Biometric Tab -->
                        <div class="tab-pane fade" id="biometric-pane" role="tabpanel" aria-labelledby="biometric-tab">
                            <div class="row gy-3">
                                <div class="col-xl-12">
                                    <div class="fingerprint-section">
                                        <h6 class="mb-3">Fingerprint Authentication</h6>
                                        <p class="text-muted">Enroll up to three fingerprints for secure authentication. Registered fingerprints can be used to log in to your account.</p>
                                        <div class="fingerprint-slots">
                                            <div class="mb-3">
                                                <label class="form-label">Finger 1</label>
                                                <button type="button" class="btn btn-outline-primary w-100">Enroll Fingerprint</button>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Finger 2</label>
                                                <button type="button" class="btn btn-outline-primary w-100">Enroll Fingerprint</button>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Finger 3</label>
                                                <button type="button" class="btn btn-outline-primary w-100">Enroll Fingerprint</button>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- End:: row-1 -->


    @endsection

@section('scripts')
<script>
    let currentStep = 1;
    const totalSteps = 3;

    function updateStepIndicators() {
        document.querySelectorAll('.step-item').forEach(item => {
            const stepNum = parseInt(item.dataset.step);
            item.classList.remove('active', 'completed');
            if (stepNum === currentStep) {
                item.classList.add('active');
            } else if (stepNum < currentStep) {
                item.classList.add('completed');
            }
        });
    }

    function showStep(step) {
        document.querySelectorAll('.modal-step').forEach(s => s.classList.remove('active'));
        document.querySelector(`.modal-step[data-step="${step}"]`).classList.add('active');

        const prevBtn = document.querySelector('.prev-step');
        const nextBtn = document.querySelector('.next-step');
        const submitBtn = document.querySelector('button[type="submit"]');

        prevBtn.style.display = step > 1 ? 'inline-block' : 'none';
        nextBtn.style.display = step < totalSteps ? 'inline-block' : 'none';
        submitBtn.style.display = step === totalSteps ? 'inline-block' : 'none';

        updateStepIndicators();
    }

    document.querySelector('.next-step').addEventListener('click', () => {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    });

    document.querySelector('.prev-step').addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
        }
    });

    function resetStaffForm() {
        document.getElementById('staffForm').reset();
        document.getElementById('staff_id').value = '';
        currentStep = 1;
        showStep(1);
    }

    function editStaff(staffId) {
        fetch(`/api/staff/${staffId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('staff_id').value = data.id;
                document.getElementById('first_name').value = data.first_name;
                document.getElementById('last_name').value = data.last_name;
                document.getElementById('email').value = data.email;
                document.getElementById('phone').value = data.phone;
                document.getElementById('department').value = data.department;
                document.getElementById('designation').value = data.designation;
                document.getElementById('emergency_contact_name').value = data.emergency_contact_name || '';
                document.getElementById('emergency_contact_phone').value = data.emergency_contact_phone || '';

                if (data.profile_picture) {
                    document.getElementById('profile-preview').innerHTML =
                        `<img src="${data.profile_picture}" class="img-thumbnail" style="max-width: 200px">`;
                }

                new bootstrap.Modal(document.getElementById('staffModal')).show();
            });
    }

    document.getElementById('staffForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const staffId = document.getElementById('staff_id').value;
        const url = staffId ? `/api/staff/${staffId}` : '/api/staff';
        const method = staffId ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error saving staff data');
            }
        });
    });

    // Update edit button click handlers
    document.querySelectorAll('[onclick^="window.location.href"]').forEach(btn => {
        const href = btn.getAttribute('onclick');
        const staffId = href.match(/id=([^']+)/)[1];
        btn.setAttribute('onclick', `editStaff('${staffId}')`);
    });
</script>
@endsection
