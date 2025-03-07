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
                                        <h4 class="fw-medium mb-0">45,478</h4>
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
                                        <h4 class="fw-medium mb-0">2,345</h4>
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
                                        <h4 class="fw-medium mb-0">1,245</h4>
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
                                               
                                                <th scope="col">Assigned Date</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Due Date</th>
                                                <th scope="col">Priority</th>
                                                <th scope="col">Assigned To</th>
                                                <th scope="col">Action</th>
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
                                                            <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Ferrari Auto Part Bags</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90101 - #P34008 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/8.png')}}" alt="">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Bently Motors Pvt Ltd</a>
                                                    </div>
                                                </td>
                                             
                                               
                                                <td>
                                                    02-02-2025
                                                </td>
                                                <td>
                                                    <span class="fw-medium text-primary">New</span>
                                                </td>
                                                <td>
                                                    10-02-2025
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary-transparent">Medium</span>
                                                </td>
                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/2.jpg')}}" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/8.jpg')}}" alt="img">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/2.jpg')}}" alt="img">
                                                        </span>
                                                        <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                                            +2
                                                        </a>
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
                                                    <div>
                                                        <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-primary" style="width: 65%"></div>
                                                        </div>
                                                        <div class="mt-1"><span class="text-primary fw-medium">65%</span> Completed</div>
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
                                                            <img src="{{ asset('assets/images/media/urgent.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Ferrari Auto Part Bags - Production</a></p>
                                                            <p class="fs-12 text-primary mb-0">BAG2024-01</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/8.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Bently Unit-1</a>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    01-12-2025
                                                </td>
                                                <td>
                                                    <span class="fw-medium text-primary">New</span>
                                                </td>
                                                <td>
                                                    15-12-2025
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning-transparent">High</span>
                                                </td>
                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/1.jpg')}}" alt="User 1">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/3.jpg')}}" alt="User 2">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/4.jpg')}}" alt="User 3">
                                                        </span>
                                                        <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                                            +2
                                                        </a>
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
                                                    <div>
                                                        <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-warning" style="width: 40%"></div>
                                                        </div>
                                                        <div class="mt-1"><span class="text-warning fw-medium">40%</span> Completed</div>
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
                                                            <img src="{{ asset('assets/images/media/pending.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Heavy Duty Bags - Production</a></p>
                                                            <p class="fs-12 text-primary mb-0">BAG2024-02</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/9.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Bently Unit-2</a>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    05-12-2025
                                                </td>
                                                <td>
                                                    <span class="fw-medium text-primary">In Progress</span>
                                                </td>
                                                <td>
                                                    20-12-2025
                                                </td>
                                                <td>
                                                    <span class="badge bg-danger-transparent">Urgent</span>
                                                </td>
                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/2.jpg')}}" alt="User 1">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/6.jpg')}}" alt="User 2">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/7.jpg')}}" alt="User 3">
                                                        </span>
                                                        <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                                            +4
                                                        </a>
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
                                                    <div>
                                                        <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-danger" style="width: 70%"></div>
                                                        </div>
                                                        <div class="mt-1"><span class="text-danger fw-medium">70%</span> Completed</div>
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
                                                            <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Luxury Bags - Production</a></p>
                                                            <p class="fs-12 text-primary mb-0">BAG2024-03</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/6.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Bently Motors Pvt Ltd</a>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    10-12-2025
                                                </td>
                                                <td>
                                                    <span class="fw-medium text-primary">Pending</span>
                                                </td>
                                                <td>
                                                    30-12-2025
                                                </td>
                                                <td>
                                                    <span class="badge bg-success-transparent">Low</span>
                                                </td>
                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/3.jpg')}}" alt="User 1">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/5.jpg')}}" alt="User 2">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/8.jpg')}}" alt="User 3">
                                                        </span>
                                                        <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                                            +1
                                                        </a>
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
                                                    <div>
                                                        <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-success" style="width: 10%"></div>
                                                        </div>
                                                        <div class="mt-1"><span class="text-success fw-medium">10%</span> Completed</div>
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
                                                            <img src="{{ asset('assets/images/media/urgent.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Eco-Friendly Bags - Production</a></p>
                                                            <p class="fs-12 text-primary mb-0">BAG2024-04</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/2.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Eco Bags Ltd</a>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    12-12-2025
                                                </td>
                                                <td>
                                                    <span class="fw-medium text-primary">In Progress</span>
                                                </td>
                                                <td>
                                                    25-12-2025
                                                </td>
                                                <td>
                                                    <span class="badge bg-success-transparent">Low</span>
                                                </td>
                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/9.jpg')}}" alt="User 1">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/2.jpg')}}" alt="User 2">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/4.jpg')}}" alt="User 3">
                                                        </span>
                                                        <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                                            +1
                                                        </a>
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
                                                    <div>
                                                        <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-success" style="width: 50%"></div>
                                                        </div>
                                                        <div class="mt-1"><span class="text-success fw-medium">50%</span> Completed</div>
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
                                                            <img src="{{ asset('assets/images/media/pending.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Sports Bags - Production</a></p>
                                                            <p class="fs-12 text-primary mb-0">BAG2024-05</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/1.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Sporty Bags Inc.</a>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    15-12-2025
                                                </td>
                                                <td>
                                                    <span class="fw-medium text-primary">Pending</span>
                                                </td>
                                                <td>
                                                    31-12-2025
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning-transparent">Medium</span>
                                                </td>
                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/10.jpg')}}" alt="User 1">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/11.jpg')}}" alt="User 2">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/12.jpg')}}" alt="User 3">
                                                        </span>
                                                        <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                                            +2
                                                        </a>
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
                                                    <div>
                                                        <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-warning" style="width: 10%"></div>
                                                        </div>
                                                        <div class="mt-1"><span class="text-warning fw-medium">10%</span> Completed</div>
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
                                                            <img src="{{ asset('assets/images/media/urgent.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Fashion Bags - Production</a></p>
                                                            <p class="fs-12 text-primary mb-0">BAG2024-06</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/3.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Fashion Bags Co.</a>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    18-12-2025
                                                </td>
                                                <td>
                                                    <span class="fw-medium text-primary">In Progress</span>
                                                </td>
                                                <td>
                                                    10-01-2025
                                                </td>
                                                <td>
                                                    <span class="badge bg-danger-transparent">High</span>
                                                </td>
                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/13.jpg')}}" alt="User 1">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/14.jpg')}}" alt="User 2">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/15.jpg')}}" alt="User 3">
                                                        </span>
                                                        <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                                            +3
                                                        </a>
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
                                                    <div>
                                                        <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-danger" style="width: 75%"></div>
                                                        </div>
                                                        <div class="mt-1"><span class="text-danger fw-medium">75%</span> Completed</div>
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