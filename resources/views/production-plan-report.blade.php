@extends('layouts.app')

@section('content')
                <!-- Page Header -->
                <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-1">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Apps</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Jobs</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Production Jobs</li>
                            </ol>
                        </nav>
                        <h1 class="page-title fw-medium fs-18 mb-0">Production</h1>
                    </div>
                    <div class="btn-list">
                        <button class="btn btn-white btn-wave">
                            <i class="ri-filter-3-line align-middle me-1 lh-1"></i> Filter
                        </button>
                        <button class="btn btn-primary btn-wave me-0">
                            <i class="ri-share-forward-line me-1"></i> Share
                        </button>
                    </div>
                </div>
                <!-- Page Header Close -->

                <!-- Start::row-1 -->
                <div class="row">
                    <!-- New Tasks Card -->
                    <div class="col-xxl-3">
                        <div class="card custom-card overflow-hidden main-content-card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div>
                                        <span class="text-muted d-block mb-1">New Jobs</span>
                                        <h4 class="fw-medium mb-0">9,854</h4>
                                    </div>
                                    <div class="lh-1">
                                        <span class="avatar avatar-md avatar-rounded bg-primary">
                                            <i class="ri-task-line fs-5"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="text-muted fs-13">Increased By <span class="text-success">2.56%<i class="ti ti-arrow-narrow-up fs-16"></i></span></div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Completed Tasks Card -->
                    <div class="col-xxl-3">
                        <div class="card custom-card overflow-hidden main-content-card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div>
                                        <span class="text-muted d-block mb-1">Completed Jobs</span>
                                        <h4 class="fw-medium mb-0">6,111</h4>
                                    </div>
                                    <div class="lh-1">
                                        <span class="avatar avatar-md avatar-rounded bg-primary1">
                                            <i class="ri-check-line fs-5"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="text-muted fs-13">Decreased By <span class="text-danger">3.05%<i class="ti ti-arrow-narrow-down fs-16"></i></span></div>
                            </div>
                        </div>
                    </div>
                
                    <!-- Pending Tasks Card -->
                    <div class="col-xxl-3">
                        <div class="card custom-card overflow-hidden main-content-card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div>
                                        <span class="text-muted d-block mb-1">Pending Jobs</span>
                                        <h4 class="fw-medium mb-0">1,857</h4>
                                    </div>
                                    <div class="lh-1">
                                        <span class="avatar avatar-md avatar-rounded bg-primary2">
                                            <i class="ri-time-line fs-5"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="text-muted fs-13">Increased By <span class="text-success">2.16%<i class="ti ti-arrow-narrow-up fs-16"></i></span></div>
                            </div>
                        </div>
                    </div>
                
                    <!-- In-progress Tasks Card -->
                    <div class="col-xxl-3">
                        <div class="card custom-card overflow-hidden main-content-card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between mb-2">
                                    <div>
                                        <span class="text-muted d-block mb-1">In-progress Jobs</span>
                                        <h4 class="fw-medium mb-0">658</h4>
                                    </div>
                                    <div class="lh-1">
                                        <span class="avatar avatar-md avatar-rounded bg-primary3">
                                            <i class="ri-loader-line fs-5"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="text-muted fs-13">Increased By <span class="text-success">2.1%<i class="ti ti-arrow-narrow-up fs-16"></i></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--End::row-1 -->

                 <!-- Start::row-2 -->
                <div class="row">
                    <div class="col-xxl-12 col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Total Jobs
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-sm btn-primary btn-wave waves-light" data-bs-toggle="modal" data-bs-target="#create-job"><i class="ri-add-line fw-medium align-middle me-1"></i> Create Job</button>
                                    <!-- Start::add job modal -->
                                    <div class="modal fade" id="create-job" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">Add Job</h6>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row gy-2">
                                                        <div class="col-xl-6">
                                                            <label for="part-id" class="form-label">Part ID</label>
                                                            <input type="text" class="form-control" id="part-id" placeholder="Enter Part ID">
                                                        </div> <div class="col-xl-6">
                                                            <label for="product-name-add" class="form-label">Part Name</label>
                                                            <input type="text" class="form-control" id="product-name-add" placeholder="Name">                                                    
                                                        </div>
                                                        <div class="col-xl-6">
                                                            
                                                            <label for="product-brand-add" class="form-label">Customer Code</label>
                                                    <select class="form-control" data-trigger name="product-brand-add" id="product-brand-add">
                                                        <option value="">Select</option>
                                                        <option value="C021224 - TVS Motors">C021224 - TVS Motors</option>
                                                        <option value="C032645 - Yamaha Engines">C032645 - Yamaha Engines</option>
                                                        <option value="C045678 - Puma">C045678 - Puma</option>
                                                        <option value="C054321 - Spykar">C054321 - Spykar</option>
                                                        <option value="C067890 - Mufti">C067890 - Mufti</option>
                                                        <option value="C078902 - Home Town">C078902 - Home Town</option>
                                                        <option value="C089123 - Arrabi">C089123 - Arrabi</option>
                                                    </select>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label for="qty" class="form-label">Quantity</label>
                                                            <input type="number" class="form-control" id="qty" placeholder="Enter Quantity">
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label for="instock-qty" class="form-label">In-stock Quantity</label>
                                                            <input type="number" class="form-control" id="instock-qty" placeholder="Enter In-stock Quantity">
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label class="form-label">Start Date</label>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-text text-muted"><i class="ri-calendar-line"></i></div>
                                                                    <input type="date" class="form-control" id="start-date" placeholder="Choose start date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label class="form-label">Due Date</label>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-text text-muted"><i class="ri-calendar-line"></i></div>
                                                                    <input type="date" class="form-control" id="due-date" placeholder="Choose due date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label class="form-label">Material Ratio</label>
                                                            <input type="text" class="form-control" id="material-ratio" placeholder="Enter Material Ratio">
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-control" data-trigger name="choices-single-default" id="status">
                                                                <option value="New">New</option>
                                                                <option value="Completed">Completed</option>
                                                                <option value="Inprogress">In-progress</option>
                                                                <option value="Pending">Pending</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label class="form-label">Priority</label>
                                                            <select class="form-control" data-trigger name="choices-single-default" id="priority">
                                                                <option value="High">High</option>
                                                                <option value="Medium">Medium</option>
                                                                <option value="Low">Low</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <label class="form-label">Assigned To</label>
                                                            <select class="form-control" name="choices-multiple-remove-button" id="assigned-to" multiple>
                                                                <option value="Angelina May">Branch Goa</option>
                                                                <option value="Branch Honda">Branch Honda</option>
                                                              
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary">Add Job</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End::add job modal -->
                                    <div class="dropdown ms-2">
                                        <button class="btn btn-icon btn-secondary-light btn-sm btn-wave waves-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="javascript:void(0);">New Jobs</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Pending Jobs</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">Completed Jobs</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);">In-progress Jobs</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            


                            <div class="card-body p-0">
                                <div class="table-responsive">
                                <table class="table text-nowrap">
    <thead>
        <tr>
            <th>
                <input class="form-check-input check-all" type="checkbox" id="all-tasks" value="" aria-label="...">
            </th>
            <th scope="col">Part Job</th>
            <th scope="col">Customer</th>
            <th scope="col">Target</th>
            <th scope="col">Rolls</th>
            <th scope="col">Bags</th>
            <th scope="col">Assigned Date</th>
            <th scope="col">Status</th>
            <th scope="col">Due Date</th>
            <th scope="col">Priority</th>
            <th scope="col">Assigned To</th>
            <th scope="col">Action</th>
            <th scope="col">Move to Prd</th>
            <th scope="col">Status Update</th>
        </tr>
    </thead>
    <tbody>
    <tr class="task-list">
    <td class="task-checkbox">
        <input class="form-check-input" type="checkbox" value="" aria-label="...">
    </td>
    <td>
        <div class="d-flex">
            <span class="avatar avatar-md border p-1 bg-light">
                <img src="{{ asset('assets/images/media/ongoing.png') }}" alt="Job Image">
            </span>
            <div class="ms-2">
                <p class="fw-medium mb-0"><a href="job-details.html">Global Packaging Solution - Type A</a></p>
                <p class="fs-12 text-primary mb-0">#G2025 - #P40123 - Extrusion</p>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                <img src="{{ asset('assets/images/company-logos/1.png') }}" alt="Company Logo">
            </span>
            <a href="javascript:void(0);" class="fw-medium mb-0">Unilever International</a>
        </div>
    </td>
    <td>25,000 Kg</td>
    <td>1,200 Rolls</td>
    <td>5,000 Bags</td>
    <td>03-01-2025</td>
    <td>
        <span class="badge bg-info text-white">In Progress</span>
    </td>
    <td>10-01-2025</td>
    <td>
        <span class="badge bg-primary-transparent">Medium</span>
    </td>
    <td>
        <div class="avatar-list-stacked">
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Manager">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Team Member">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="Team Member">
            </span>
            <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">+3</a>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <button class="btn btn-primary-light btn-icon btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                <i class="ri-edit-line"></i>
            </button>
            <button class="btn btn-danger-light btn-icon ms-1 btn-sm task-delete-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                <i class="ri-delete-bin-5-line"></i>
            </button>
        </div>
    </td>
    <td>
        <button class="btn btn-success btn-sm move-to-production" data-bs-toggle="tooltip" data-bs-placement="top" title="Move Prd">
            <i class="ri-arrow-right-line me-1"></i>Move Prd
        </button>
    </td>
    <td>
        <div>
            <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-info" style="width: 60%"></div>
            </div>
            <div class="mt-1"><span class="text-info fw-medium">60%</span> Completed</div>
        </div>
    </td>
</tr>

<tr class="task-list">
    <td class="task-checkbox">
        <input class="form-check-input" type="checkbox" value="" aria-label="...">
    </td>
    <td>
        <div class="d-flex">
            <span class="avatar avatar-md border p-1 bg-light">
                <img src="{{ asset('assets/images/media/urgent.png') }}" alt="Job Image">
            </span>
            <div class="ms-2">
                <p class="fw-medium mb-0"><a href="job-details.html">Advanced Bag Solutions - Type B</a></p>
                <p class="fs-12 text-primary mb-0">#A2031 - #P50987 - Lamination</p>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                <img src="{{ asset('assets/images/company-logos/2.png') }}" alt="Company Logo">
            </span>
            <a href="javascript:void(0);" class="fw-medium mb-0">Procter & Gamble</a>
        </div>
    </td>
    <td>35,000 Kg</td>
    <td>1,500 Rolls</td>
    <td>6,000 Bags</td>
    <td>12-01-2025</td>
    <td>
        <span class="badge bg-danger text-white">Delayed</span>
    </td>
    <td>20-01-2025</td>
    <td>
        <span class="badge bg-danger-transparent">High</span>
    </td>
    <td>
        <div class="avatar-list-stacked">
        <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Manager">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Team Member">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="Team Member">
            </span>
            <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">+5</a>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <button class="btn btn-primary-light btn-icon btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                <i class="ri-edit-line"></i>
            </button>
            <button class="btn btn-danger-light btn-icon ms-1 btn-sm task-delete-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                <i class="ri-delete-bin-5-line"></i>
            </button>
        </div>
    </td>
    <td>
        <button class="btn btn-success btn-sm move-to-production" data-bs-toggle="tooltip" data-bs-placement="top" title="Move Prd">
            <i class="ri-arrow-right-line me-1"></i>Move Prd
        </button>
    </td>
    <td>
        <div>
            <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-danger" style="width: 15%"></div>
            </div>
            <div class="mt-1"><span class="text-danger fw-medium">15%</span> Completed</div>
        </div>
    </td>
</tr>
<tr class="task-list">
    <td class="task-checkbox">
        <input class="form-check-input" type="checkbox" value="" aria-label="...">
    </td>
    <td>
        <div class="d-flex">
            <span class="avatar avatar-md border p-1 bg-light">
                <img src="{{ asset('assets/images/media/completed.png') }}" alt="Job Image">
            </span>
            <div class="ms-2">
                <p class="fw-medium mb-0"><a href="job-details.html">Sustainable Bag Solutions - Type C</a></p>
                <p class="fs-12 text-primary mb-0">#S3025 - #P61234 - Printing</p>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                <img src="{{ asset('assets/images/company-logos/3.png') }}" alt="Company Logo">
            </span>
            <a href="javascript:void(0);" class="fw-medium mb-0">Nestlé Corporation</a>
        </div>
    </td>
    <td>45,000 Kg</td>
    <td>1,800 Rolls</td>
    <td>7,200 Bags</td>
    <td>15-01-2025</td>
    <td>
        <span class="badge bg-success text-white">Completed</span>
    </td>
    <td>20-01-2025</td>
    <td>
        <span class="badge bg-success-transparent">Low</span>
    </td>
    <td>
        <div class="avatar-list-stacked">
        <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Manager">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Team Member">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="Team Member">
            </span>
            <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">+5</a>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <button class="btn btn-primary-light btn-icon btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                <i class="ri-edit-line"></i>
            </button>
            <button class="btn btn-danger-light btn-icon ms-1 btn-sm task-delete-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                <i class="ri-delete-bin-5-line"></i>
            </button>
        </div>
    </td>
    <td>
        <button class="btn btn-success btn-sm move-to-production" data-bs-toggle="tooltip" data-bs-placement="top" title="Move Prd">
            <i class="ri-arrow-right-line me-1"></i>Move Prd
        </button>
    </td>
    <td>
        <div>
            <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-success" style="width: 100%"></div>
            </div>
            <div class="mt-1"><span class="text-success fw-medium">100%</span> Completed</div>
        </div>
    </td>
</tr>

<tr class="task-list">
    <td class="task-checkbox">
        <input class="form-check-input" type="checkbox" value="" aria-label="...">
    </td>
    <td>
        <div class="d-flex">
            <span class="avatar avatar-md border p-1 bg-light">
                <img src="{{ asset('assets/images/media/delayed.png') }}" alt="Job Image">
            </span>
            <div class="ms-2">
                <p class="fw-medium mb-0"><a href="job-details.html">Innovative Packaging - Type D</a></p>
                <p class="fs-12 text-primary mb-0">#I4056 - #P72345 - Coating</p>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                <img src="{{ asset('assets/images/company-logos/4.png') }}" alt="Company Logo">
            </span>
            <a href="javascript:void(0);" class="fw-medium mb-0">PepsiCo Global</a>
        </div>
    </td>
    <td>50,000 Kg</td>
    <td>2,000 Rolls</td>
    <td>8,000 Bags</td>
    <td>18-01-2025</td>
    <td>
        <span class="badge bg-warning text-white">Delayed</span>
    </td>
    <td>25-01-2025</td>
    <td>
        <span class="badge bg-danger-transparent">Critical</span>
    </td>
    <td>
        <div class="avatar-list-stacked">
        <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Manager">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Team Member">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="Team Member">
            </span>
            <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">+5</a>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <button class="btn btn-primary-light btn-icon btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                <i class="ri-edit-line"></i>
            </button>
            <button class="btn btn-danger-light btn-icon ms-1 btn-sm task-delete-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                <i class="ri-delete-bin-5-line"></i>
            </button>
        </div>
    </td>
    <td>
        <button class="btn btn-success btn-sm move-to-production" data-bs-toggle="tooltip" data-bs-placement="top" title="Move Prd">
            <i class="ri-arrow-right-line me-1"></i>Move Prd
        </button>
    </td>
    <td>
        <div>
            <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-warning" style="width: 25%"></div>
            </div>
            <div class="mt-1"><span class="text-warning fw-medium">25%</span> Completed</div>
        </div>
    </td>
</tr>
    <tr class="task-list">
    <td class="task-checkbox">
        <input class="form-check-input" type="checkbox" value="" aria-label="...">
    </td>
    <td>
        <div class="d-flex">
            <span class="avatar avatar-md border p-1 bg-light">
                <img src="{{ asset('assets/images/media/ongoing.png') }}" alt="Job Image">
            </span>
            <div class="ms-2">
                <p class="fw-medium mb-0"><a href="job-details.html">Global Packaging Solution - Type A</a></p>
                <p class="fs-12 text-primary mb-0">#G2025 - #P40123 - Extrusion</p>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                <img src="{{ asset('assets/images/company-logos/1.png') }}" alt="Company Logo">
            </span>
            <a href="javascript:void(0);" class="fw-medium mb-0">Unilever International</a>
        </div>
    </td>
    <td>25,000 Kg</td>
    <td>1,200 Rolls</td>
    <td>5,000 Bags</td>
    <td>03-01-2025</td>
    <td>
        <span class="badge bg-info text-white">In Progress</span>
    </td>
    <td>10-01-2025</td>
    <td>
        <span class="badge bg-primary-transparent">Medium</span>
    </td>
    <td>
        <div class="avatar-list-stacked">
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Manager">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Team Member">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="Team Member">
            </span>
            <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">+3</a>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <button class="btn btn-primary-light btn-icon btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                <i class="ri-edit-line"></i>
            </button>
            <button class="btn btn-danger-light btn-icon ms-1 btn-sm task-delete-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                <i class="ri-delete-bin-5-line"></i>
            </button>
        </div>
    </td>
    <td>
        <button class="btn btn-success btn-sm move-to-production" data-bs-toggle="tooltip" data-bs-placement="top" title="Move Prd">
            <i class="ri-arrow-right-line me-1"></i>Move Prd
        </button>
    </td>
    <td>
        <div>
            <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-info" style="width: 60%"></div>
            </div>
            <div class="mt-1"><span class="text-info fw-medium">60%</span> Completed</div>
        </div>
    </td>
</tr>

<tr class="task-list">
    <td class="task-checkbox">
        <input class="form-check-input" type="checkbox" value="" aria-label="...">
    </td>
    <td>
        <div class="d-flex">
            <span class="avatar avatar-md border p-1 bg-light">
                <img src="{{ asset('assets/images/media/urgent.png') }}" alt="Job Image">
            </span>
            <div class="ms-2">
                <p class="fw-medium mb-0"><a href="job-details.html">Advanced Bag Solutions - Type B</a></p>
                <p class="fs-12 text-primary mb-0">#A2031 - #P50987 - Lamination</p>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                <img src="{{ asset('assets/images/company-logos/2.png') }}" alt="Company Logo">
            </span>
            <a href="javascript:void(0);" class="fw-medium mb-0">Procter & Gamble</a>
        </div>
    </td>
    <td>35,000 Kg</td>
    <td>1,500 Rolls</td>
    <td>6,000 Bags</td>
    <td>12-01-2025</td>
    <td>
        <span class="badge bg-danger text-white">Delayed</span>
    </td>
    <td>20-01-2025</td>
    <td>
        <span class="badge bg-danger-transparent">High</span>
    </td>
    <td>
        <div class="avatar-list-stacked">
        <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Manager">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Team Member">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="Team Member">
            </span>
            <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">+5</a>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <button class="btn btn-primary-light btn-icon btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                <i class="ri-edit-line"></i>
            </button>
            <button class="btn btn-danger-light btn-icon ms-1 btn-sm task-delete-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                <i class="ri-delete-bin-5-line"></i>
            </button>
        </div>
    </td>
    <td>
        <button class="btn btn-success btn-sm move-to-production" data-bs-toggle="tooltip" data-bs-placement="top" title="Move Prd">
            <i class="ri-arrow-right-line me-1"></i>Move Prd
        </button>
    </td>
    <td>
        <div>
            <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-danger" style="width: 15%"></div>
            </div>
            <div class="mt-1"><span class="text-danger fw-medium">15%</span> Completed</div>
        </div>
    </td>
</tr>
<tr class="task-list">
    <td class="task-checkbox">
        <input class="form-check-input" type="checkbox" value="" aria-label="...">
    </td>
    <td>
        <div class="d-flex">
            <span class="avatar avatar-md border p-1 bg-light">
                <img src="{{ asset('assets/images/media/completed.png') }}" alt="Job Image">
            </span>
            <div class="ms-2">
                <p class="fw-medium mb-0"><a href="job-details.html">Sustainable Bag Solutions - Type C</a></p>
                <p class="fs-12 text-primary mb-0">#S3025 - #P61234 - Printing</p>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                <img src="{{ asset('assets/images/company-logos/3.png') }}" alt="Company Logo">
            </span>
            <a href="javascript:void(0);" class="fw-medium mb-0">Nestlé Corporation</a>
        </div>
    </td>
    <td>45,000 Kg</td>
    <td>1,800 Rolls</td>
    <td>7,200 Bags</td>
    <td>15-01-2025</td>
    <td>
        <span class="badge bg-success text-white">Completed</span>
    </td>
    <td>20-01-2025</td>
    <td>
        <span class="badge bg-success-transparent">Low</span>
    </td>
    <td>
        <div class="avatar-list-stacked">
        <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Manager">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Team Member">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="Team Member">
            </span>
            <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">+5</a>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <button class="btn btn-primary-light btn-icon btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                <i class="ri-edit-line"></i>
            </button>
            <button class="btn btn-danger-light btn-icon ms-1 btn-sm task-delete-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                <i class="ri-delete-bin-5-line"></i>
            </button>
        </div>
    </td>
    <td>
        <button class="btn btn-success btn-sm move-to-production" data-bs-toggle="tooltip" data-bs-placement="top" title="Move Prd">
            <i class="ri-arrow-right-line me-1"></i>Move Prd
        </button>
    </td>
    <td>
        <div>
            <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-success" style="width: 100%"></div>
            </div>
            <div class="mt-1"><span class="text-success fw-medium">100%</span> Completed</div>
        </div>
    </td>
</tr>

<tr class="task-list">
    <td class="task-checkbox">
        <input class="form-check-input" type="checkbox" value="" aria-label="...">
    </td>
    <td>
        <div class="d-flex">
            <span class="avatar avatar-md border p-1 bg-light">
                <img src="{{ asset('assets/images/media/delayed.png') }}" alt="Job Image">
            </span>
            <div class="ms-2">
                <p class="fw-medium mb-0"><a href="job-details.html">Innovative Packaging - Type D</a></p>
                <p class="fs-12 text-primary mb-0">#I4056 - #P72345 - Coating</p>
            </div>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                <img src="{{ asset('assets/images/company-logos/4.png') }}" alt="Company Logo">
            </span>
            <a href="javascript:void(0);" class="fw-medium mb-0">PepsiCo Global</a>
        </div>
    </td>
    <td>50,000 Kg</td>
    <td>2,000 Rolls</td>
    <td>8,000 Bags</td>
    <td>18-01-2025</td>
    <td>
        <span class="badge bg-warning text-white">Delayed</span>
    </td>
    <td>25-01-2025</td>
    <td>
        <span class="badge bg-danger-transparent">Critical</span>
    </td>
    <td>
        <div class="avatar-list-stacked">
        <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="Manager">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="Team Member">
            </span>
            <span class="avatar avatar-sm avatar-rounded">
                <img src="{{ asset('assets/images/faces/3.jpg') }}" alt="Team Member">
            </span>
            <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">+5</a>
        </div>
    </td>
    <td>
        <div class="d-flex align-items-center">
            <button class="btn btn-primary-light btn-icon btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                <i class="ri-edit-line"></i>
            </button>
            <button class="btn btn-danger-light btn-icon ms-1 btn-sm task-delete-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                <i class="ri-delete-bin-5-line"></i>
            </button>
        </div>
    </td>
    <td>
        <button class="btn btn-success btn-sm move-to-production" data-bs-toggle="tooltip" data-bs-placement="top" title="Move Prd">
            <i class="ri-arrow-right-line me-1"></i>Move Prd
        </button>
    </td>
    <td>
        <div>
            <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-warning" style="width: 25%"></div>
            </div>
            <div class="mt-1"><span class="text-warning fw-medium">25%</span> Completed</div>
        </div>
    </td>
</tr>

                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer border-top-0">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination mb-0 float-end">
                                        <li class="page-item disabled">
                                            <a class="page-link">Previous</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);">1</a></li>
                                        <li class="page-item active" aria-current="page">
                                            <a class="page-link" href="javascript:void(0);">2</a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">Next</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End::row-2 --> 
                @endsection