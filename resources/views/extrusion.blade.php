@extends('layouts.app')

@section('content')
                <!-- Page Header -->
                <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
                    <div>
                        <nav>
                            <ol class="breadcrumb mb-1">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Apps</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Jobs</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Extrution Jobs</li>
                            </ol>
                        </nav>
                        <h1 class="page-title fw-medium fs-18 mb-0">Extrution</h1>
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
                                    Total Extrution Jobs
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
                                                            <label class="form-label">Part ID</label>
                                                            <select class="form-control" data-trigger name="choices-single-default" id="priority">
                                                                <option value="High">P02131</option>
                                                                <option value="Medium">P02541</option>
                                                                <option value="Low">P02131</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xl-6">
                                                            <label for="product-name-add" class="form-label">Part Name</label>
                                                            <input type="text" class="form-control" id="product-name-add" placeholder="Name" value="Poly Bag 7X89">
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

                                                <th scope="col">Assigned</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Due</th>
                                                <th scope="col">Priority</th>
                                                <th scope="col">Extrusion</th>
                                                <th scope="col">Rolls</th>

                                                <th scope="col">Assigned To</th>
                                                <th scope="col">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="task-list">
                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-md border p-1 bg-light">
                                                            <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"> <a href="javascript:void(0);"   data-bs-toggle="modal" data-bs-target="#move-extrution">Plastic Wraps 249X53 CM</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90102 - #P86574 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/5.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Microsoft PC/Lap Division</a>
                                                    </div>
                                                </td>
                                                <td>09-03-2025</td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary2"  data-bs-toggle="modal" data-bs-target="#move-extrution">Add Roll</a>
                                                    </div></td>
                                                <td>02-03-2025</td>
                                                <td><span class="badge bg-warning-transparent">High</span></td>
                                                <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>Qty: 500KG/20</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>

                                                 <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#view-roll">20 Rolls / 500KG</a>
                                                    </div></td>
                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/3.jpg')}}" alt="User">
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

                                            </tr>

                                            <tr class="task-list">
                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>

                                                <td>
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-md border p-1 bg-light">
                                                            <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"> <a href="javascript:void(0);"   data-bs-toggle="modal" data-bs-target="#move-extrution">Ferrari Auto Part Bags</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90101 - #P34008 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/8.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Bently Motors Pvt Ltd</a>
                                                    </div>
                                                </td>
                                                <td>02-02-2025</td>


                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary2"  data-bs-toggle="modal" data-bs-target="#move-extrution">Add Roll</a>
                                                    </div></td>
                                                <td>10-02-2025</td>
                                                <td><span class="badge bg-secondary-transparent">Medium</span></td>
                                                <!-- Processing Stages -->
                                                <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>Qty: 500KG/20</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>

                                                 <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#view-roll">20 Rolls / 500KG</a>
                                                    </div></td>

                                                <!-- Assigned To -->
                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/2.jpg')}}" alt="User">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/8.jpg')}}" alt="User">
                                                        </span>
                                                        <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                                            +2
                                                        </a>
                                                    </div>
                                                </td>
                                                <!-- Actions -->
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
                                                <!-- Status Update -->

                                            </tr>
                                            <tr class="task-list">
                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-md border p-1 bg-light">
                                                            <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"> <a href="javascript:void(0);"   data-bs-toggle="modal" data-bs-target="#move-extrution">
Plastic Wraps 387X231 CM</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90103 - #P99579 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/3.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Tesla Motors Pvt Ltd</a>
                                                    </div>
                                                </td>
                                                <td>05-02-2025</td>
                                                <td><span class="badge bg-secondary-transparent">In Progress</span></td>

                                                <td>15-02-2025</td>
                                                <td><span class="badge bg-danger-transparent">Critical</span></td>
                                                <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>Qty: 500KG/20</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>

                                                 <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#view-roll">20 Rolls / 500KG</a>
                                                    </div></td>

                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/5.jpg')}}" alt="User">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/6.jpg')}}" alt="User">
                                                        </span>
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

                                            </tr>


                                              <tr class="task-list">
                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-md border p-1 bg-light">
                                                            <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"> <a href="javascript:void(0);"   data-bs-toggle="modal" data-bs-target="#move-extrution">Plastic Wraps 249X53 CM</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90102 - #P86574 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/5.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Microsoft PC/Lap Division</a>
                                                    </div>
                                                </td>
                                                <td>09-03-2025</td>
                                                <td><span class="badge bg-secondary-transparent">Completed</span></td>

                                                <td>02-03-2025</td>
                                                <td><span class="badge bg-warning-transparent">High</span></td>
                                                <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>Qty: 500KG/20</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>

                                                 <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#view-roll">20 Rolls / 500KG</a>
                                                    </div></td>

                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/3.jpg')}}" alt="User">
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

                                            </tr>




                                              <tr class="task-list">
                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-md border p-1 bg-light">
                                                            <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"> <a href="javascript:void(0);"   data-bs-toggle="modal" data-bs-target="#move-extrution">Ferrari Auto Part Bags</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90101 - #P34008 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/8.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Bently Motors Pvt Ltd</a>
                                                    </div>
                                                </td>
                                                <td>02-02-2025</td>
                                                <td><span class="badge bg-secondary-transparent">Completed</span></td>

                                                <td>10-02-2025</td>
                                                <td><span class="badge bg-secondary-transparent">Medium</span></td>
                                                <!-- Processing Stages -->
                                                <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>Qty: 500KG/20</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>

                                                 <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#view-roll">20 Rolls / 500KG</a>
                                                    </div></td>

                                                <!-- Assigned To -->
                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/2.jpg')}}" alt="User">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/8.jpg')}}" alt="User">
                                                        </span>
                                                        <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                                            +2
                                                        </a>
                                                    </div>
                                                </td>
                                                <!-- Actions -->
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
                                                <!-- Status Update -->

                                            </tr>





                                              <tr class="task-list">
                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-md border p-1 bg-light">
                                                            <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"> <a href="javascript:void(0);"   data-bs-toggle="modal" data-bs-target="#move-extrution">
Plastic Wraps 387X231 CM</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90103 - #P99579 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/3.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Tesla Motors Pvt Ltd</a>
                                                    </div>
                                                </td>
                                                <td>05-02-2025</td>
                                                <td><span class="badge bg-secondary-transparent">Completed</span></td>
                                                <td>15-02-2025</td>
                                                <td><span class="badge bg-danger-transparent">Critical</span></td>
                                                <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>Qty: 500KG/20</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>

                                                 <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#view-roll">20 Rolls / 500KG</a>
                                                    </div></td>

                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/5.jpg')}}" alt="User">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/6.jpg')}}" alt="User">
                                                        </span>
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

                                            </tr>
                                              <tr class="task-list">
                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-md border p-1 bg-light">
                                                            <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"> <a href="javascript:void(0);"   data-bs-toggle="modal" data-bs-target="#move-extrution">Ferrari Auto Part Bags</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90101 - #P34008 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/8.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Bently Motors Pvt Ltd</a>
                                                    </div>
                                                </td>
                                                <td>02-02-2025</td>
                                                <td><span class="badge bg-secondary-transparent">Completed</span></td>
                                                <td>10-02-2025</td>
                                                <td><span class="badge bg-secondary-transparent">Medium</span></td>
                                                <!-- Processing Stages -->
                                                <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>Qty: 500KG/20</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>

                                                 <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#view-roll">20 Rolls / 500KG</a>
                                                    </div></td>

                                                <!-- Assigned To -->
                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/2.jpg')}}" alt="User">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/8.jpg')}}" alt="User">
                                                        </span>
                                                        <a class="avatar avatar-sm bg-primary avatar-rounded text-fixed-white" href="javascript:void(0);">
                                                            +2
                                                        </a>
                                                    </div>
                                                </td>
                                                <!-- Actions -->
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
                                                <!-- Status Update -->

                                            </tr>
                                              <tr class="task-list">
                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-md border p-1 bg-light">
                                                            <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"> <a href="javascript:void(0);"   data-bs-toggle="modal" data-bs-target="#move-extrution">Plastic Wraps 249X53 CM</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90102 - #P86574 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/5.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Microsoft PC/Lap Division</a>
                                                    </div>
                                                </td>
                                                <td>09-03-2025</td>
                                                <td><span class="fw-medium text-primary">In Progress</span></td>
                                                <td>02-03-2025</td>
                                                <td><span class="badge bg-warning-transparent">High</span></td>
                                                <td>
                                                <div>
                                                        <span class="text-primary">80% Completed</span><br>
                                                        <span>Qty: 500KG/20</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </td>

                                                 <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#view-roll">20 Rolls / 500KG</a>
                                                    </div></td>

                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/3.jpg')}}" alt="User">
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

                                            </tr>
                                              <tr class="task-list">
                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <span class="avatar avatar-md border p-1 bg-light">
                                                            <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="">
                                                        </span>
                                                        <div class="ms-2">
                                                            <p class="fw-medium mb-0 d-flex align-items-center"> <a href="javascript:void(0);"   data-bs-toggle="modal" data-bs-target="#move-extrution">
Plastic Wraps 387X231 CM</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90103 - #P99579 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/3.png')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Tesla Motors Pvt Ltd</a>
                                                    </div>
                                                </td>
                                                <td>05-02-2025</td>
                                                <td><span class="fw-medium text-warning">Delayed</span></td>
                                                <td>15-02-2025</td>
                                                <td><span class="badge bg-danger-transparent">Critical</span></td>
                                                <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>Qty: 500KG/20</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>

                                                 <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#view-roll">20 Rolls / 500KG</a>
                                                    </div></td>

                                                <td>
                                                    <div class="avatar-list-stacked">
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/5.jpg')}}" alt="User">
                                                        </span>
                                                        <span class="avatar avatar-sm avatar-rounded">
                                                            <img src="{{ asset('assets/images/faces/6.jpg')}}" alt="User">
                                                        </span>
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




                        {{-- Start modal --}}
<div class="modal fade" id="assign-material" tabindex="-1" aria-labelledby="editDataModalLabel" style="display: none;" data-bs-keyboard="false" aria-hidden="true">
 <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="editDataModalLabel">Assign Material</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
              <!-- Start::row-1 -->
              <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body add-products">
                            <div class="row gx-4">
                                <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                    <div class="card custom-card shadow-none mb-0 border-0">
                                        <div class="card-body p-0">
                                            <div class="row gy-3">
                                                <div class="col-xl-12">
                                                    <label for="product-name-add" class="form-label">Part Name</label>
                                                    <input type="text" class="form-control" id="product-name-add" placeholder="Name" value="LD Plain Bags 10x12">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-brand-add" class="form-label">Customer Code</label>
                                                    <select class="form-control" data-trigger name="product-brand-add" id="product-brand-add">
                                                        <option value="">Select</option>
                                                        <option value="C021224 - TVS Motors">C021224 - TVS Motors</option>
                                                        <option value="C032645 - Yamaha Engines">C032645 - Yamaha Engines</option>
                                                        <option value="C045678 - Puma" selected>C045678 - Puma</option>
                                                        <option value="C045678 - Puma">C045678 - Puma</option>
                                                        <option value="C054321 - Spykar">C054321 - Spykar</option>
                                                        <option value="C067890 - Mufti">C067890 - Mufti</option>
                                                        <option value="C078902 - Home Town">C078902 - Home Town</option>
                                                        <option value="C089123 - Arrabi">C089123 - Arrabi</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-category-add" class="form-label">Category</label>
                                                    <select class="form-control" data-trigger name="product-category-add" id="product-category-add">
                                                        <option value="">Category</option>
                                                        <option value="Garbage Bags">Garbage Bags</option>
                                                        <option value="LD Plain Bags 10x12s">LD Plain Bags 10x12s</option>
                                                        <option value="LD Plain Bags 10x12s" selected>LD Plain Bags 10x12s</option>
                                                        <option value="Food Packaging">Food Packaging</option>
                                                        <option value="Industrial Packaging">Industrial Packaging</option>
                                                        <option value="Agricultural Bags">Agricultural Bags</option>
                                                        <option value="Gusseted Bags">Gusseted Bags</option>
                                                        <option value="Zip Lock Bags">Zip Lock Bags</option>
                                                        <option value="Biodegradable Bags">Biodegradable Bags</option>
                                                        <option value="HDPE Bags">HDPE Bags</option>
                                                        <option value="LDPE Bags">LDPE Bags</option>
                                                        <option value="Plastic Rolls">Plastic Rolls</option>
                                                        <option value="Courier Bags">Courier Bags</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-type" class="form-label">Part Type</label>
                                                    <input type="text" class="form-control" id="product-type" placeholder="Type" value="LD Plain Bags 10x12">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="product-hsn-add" class="form-label">HSN No</label>
                                                    <input type="text" class="form-control" id="product-hsn-add" placeholder="Name" value="3923">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="product-thickness-add" class="form-label">Reel Size</label>
                                                    <input type="text" class="form-control" id="product-thickness-add" placeholder="Reel Size" value="60x80 cm">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="product-size-add" class="form-label">Length</label>
                                                    <input type="text" class="form-control" id="product-size-add" placeholder="Length" value="50 cm">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="product-size-add" class="form-label">Width</label>
                                                    <input type="text" class="form-control" id="product-size-add" placeholder="Width" value="40 cm">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="product-size-add" class="form-label">Height</label>
                                                    <input type="text" class="form-control" id="product-size-add" placeholder="Height" value="30 cm">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="product-thickness-add" class="form-label">Thickness</label>
                                                    <input type="text" class="form-control" id="product-thickness-add" placeholder="Thickness" value="0.5 mm">
                                                </div>

                                                <div class="col-xl-3">
                                                    <label for="material-ld-ratio" class="form-label">LD Ratio (%)</label>
                                                    <input type="text" class="form-control" id="material-ld-ratio" placeholder="Enter LD Mixing Ratio" value="45">
                                                </div>

                                                <div class="col-xl-3">
                                                    <label for="material-lld-ratio" class="form-label">LLD Ratio (%)</label>
                                                    <input type="text" class="form-control" id="material-lld-ratio" placeholder="Enter LLD Mixing Ratio" value="35">
                                                </div>

                                                <div class="col-xl-3">
                                                    <label for="material-hd-ratio" class="form-label">HD Ratio (%)</label>
                                                    <input type="text" class="form-control" id="material-hd-ratio" placeholder="Enter HD Mixing Ratio" value="20">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="material-hd-ratio" class="form-label">RD Ratio (%)</label>
                                                    <input type="text" class="form-control" id="material-hd-ratio" placeholder="Enter RD Mixing Ratio" value="10">
                                                </div>





                                                <div class="col-xl-6">
                                                    <label for="product-discount" class="form-label">Item Weight</label>
                                                    <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-gender-add" class="form-label">Sealing Type</label>
                                                    <select class="form-control" data-trigger name="product-gender-add" id="product-gender-add">
                                                        <option value="">Select</option>
                                                        <option value="Side Seal" selected>Side Seal</option>
                                                        <option value="Bottom Seal">Bottom Seal</option>
                                                        <option value="Center Seal">Center Seal</option>
                                                    </select>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                    <div class="card custom-card shadow-none mb-0 border-0">
                                        <div class="card-body p-0">
                                            <div class="row gy-3 bg-success-transparent">
                                                <div class="col-xl-12">
                                                    <label class="form-label">Part Description</label>
                                                    <div id="product-feature2">High-quality packaging bag with side seal and custom printing options.</div>
                                                </div>

                                                <div class="col-xl-6">
                                                    <label for="product-category-ld" class="form-label">Matrial LD</label>
                                                    <select class="form-control" data-trigger name="product-category-ld" id="product-category-ld">
                                                        <option value="LD-51242">LD-51242 Stk-968Kg 12-01-24</option>
                                                        <option value="LD-51243">LD-51243 Stk-968Kg 13-01-24</option>
                                                        <option value="LD-51244">LD-51244 Stk-968Kg 14-01-24</option>
                                                        <option value="LD-51245">LD-51245 Stk-968Kg 15-01-24</option>
                                                        <option value="LD-51246">LD-51246 Stk-968Kg 16-01-24</option>
                                                        <option value="LD-51247">LD-51247 Stk-968Kg 17-01-24</option>
                                                        <option value="LD-51248">LD-51248 Stk-968Kg 18-01-24</option>
                                                        <option value="LD-51249">LD-51249 Stk-968Kg 19-01-24</option>
                                                        <option value="LD-51250">LD-51250 Stk-968Kg 20-01-24</option>
                                                        <option value="LD-51251">LD-51251 Stk-968Kg 21-01-24</option>
                                                        <option value="LD-51252">LD-51252 Stk-968Kg 22-01-24</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="material-ld-ratio" class="form-label">LD Weight</label>
                                                    <input type="text" class="form-control" id="material-ld-ratio" placeholder="Enter LD Mixing Ratio" value="455">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="material-ld-ratio" class="form-label">LD Used Weight</label>
                                                    <input type="text" class="form-control" id="material-ld-ratio" placeholder="Enter LD Mixing Ratio" value="457">
                                                </div>
                                                <!-- PE Section -->
                                                <div class="col-xl-6">
                                                <label for="product-category-pe" class="form-label">Material PE</label>
                                                <select class="form-control" data-trigger name="product-category-pe" id="product-category-pe">
                                                <option value="PE-61242">PE-61242 Stk-768Kg 12-01-24</option>
                                                <option value="PE-61243">PE-61243 Stk-768Kg 13-01-24</option>
                                                <option value="PE-61244">PE-61244 Stk-768Kg 14-01-24</option>
                                                <option value="PE-61245">PE-61245 Stk-768Kg 15-01-24</option>
                                                <option value="PE-61246">PE-61246 Stk-768Kg 16-01-24</option>
                                                </select>
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-pe-ratio" class="form-label">PE Weight</label>
                                                <input type="text" class="form-control" id="material-pe-ratio" placeholder="Enter PE Mixing Ratio" value="355">
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-pe-used" class="form-label">PE Used Weight</label>
                                                <input type="text" class="form-control" id="material-pe-used" placeholder="Enter PE Used Weight" value="357">
                                                </div>

                                                <!-- HD Section -->
                                                <div class="col-xl-6">
                                                <label for="product-category-hd" class="form-label">Material HD</label>
                                                <select class="form-control" data-trigger name="product-category-hd" id="product-category-hd">
                                                <option value="HD-71242">HD-71242 Stk-868Kg 12-01-24</option>
                                                <option value="HD-71243">HD-71243 Stk-868Kg 13-01-24</option>
                                                <option value="HD-71244">HD-71244 Stk-868Kg 14-01-24</option>
                                                <option value="HD-71245">HD-71245 Stk-868Kg 15-01-24</option>
                                                <option value="HD-71246">HD-71246 Stk-868Kg 16-01-24</option>
                                                </select>
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-hd-ratio" class="form-label">HD Weight</label>
                                                <input type="text" class="form-control" id="material-hd-ratio" placeholder="Enter HD Mixing Ratio" value="555">
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-hd-used" class="form-label">HD Used Weight</label>
                                                <input type="text" class="form-control" id="material-hd-used" placeholder="Enter HD Used Weight" value="557">
                                                </div>

                                                <!-- RD Section -->
                                                <div class="col-xl-6">
                                                <label for="product-category-rd" class="form-label">Material RD</label>
                                                <select class="form-control" data-trigger name="product-category-rd" id="product-category-rd">
                                                <option value="RD-81242">RD-81242 Stk-968Kg 12-01-24</option>
                                                <option value="RD-81243">RD-81243 Stk-968Kg 13-01-24</option>
                                                <option value="RD-81244">RD-81244 Stk-968Kg 14-01-24</option>
                                                <option value="RD-81245">RD-81245 Stk-968Kg 15-01-24</option>
                                                <option value="RD-81246">RD-81246 Stk-968Kg 16-01-24</option>
                                                </select>
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-rd-ratio" class="form-label">RD Weight</label>
                                                <input type="text" class="form-control" id="material-rd-ratio" placeholder="Enter RD Mixing Ratio" value="655">
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-rd-used" class="form-label">RD Used Weight</label>
                                                <input type="text" class="form-control" id="material-rd-used" placeholder="Enter RD Used Weight" value="657">
                                                </div>

                                                <!-- LLD Section -->
                                                <div class="col-xl-6">
                                                <label for="product-category-lld" class="form-label">Material LLD</label>
                                                <select class="form-control" data-trigger name="product-category-lld" id="product-category-lld">
                                                <option value="LLD-91242">LLD-91242 Stk-668Kg 12-01-24</option>
                                                <option value="LLD-91243">LLD-91243 Stk-668Kg 13-01-24</option>
                                                <option value="LLD-91244">LLD-91244 Stk-668Kg 14-01-24</option>
                                                <option value="LLD-91245">LLD-91245 Stk-668Kg 15-01-24</option>
                                                <option value="LLD-91246">LLD-91246 Stk-668Kg 16-01-24</option>
                                                </select>
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-lld-ratio" class="form-label">LLD Weight</label>
                                                <input type="text" class="form-control" id="material-lld-ratio" placeholder="Enter LLD Mixing Ratio" value="255">
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-lld-used" class="form-label">LLD Used Weight</label>
                                                <input type="text" class="form-control" id="material-lld-used" placeholder="Enter LLD Used Weight" value="257">
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>


                        </div>
                        <div class="card-footer border-top border-block-start-dashed d-sm-flex justify-content-end">
                            <button class="btn btn-primary1 me-2 mb-2 mb-sm-0">cancel<i class="bi bi-plus-lg ms-2"></i></button>
                            <button class="btn btn-primary mb-2 mb-sm-0">Save<i class="bi bi-download ms-2"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!--End::row-1 -->
        </div>
    </div>
</div>
</div>

{{-- end modal --}}





                        {{-- Start rxtrution modal --}}
 <div class="modal fade" id="move-extrution" tabindex="-1" aria-labelledby="editDataModalLabel" style="display: none;" data-bs-keyboard="false" aria-hidden="true">
 <div class="modal-dialog modal-xl modal-dialog-scrollable">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h6 class="modal-title" id="editDataModalLabel">Add Extrution Output </h6>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal"
                                           aria-label="Close"></button>
                                   </div>
                                   <div class="modal-body">
                                         <!-- Start::row-1 -->
                                         <div class="row">
                                           <div class="col-xl-12">
                                               <div class="card custom-card">
                                                   <div class="card-body add-products">
                                                       <div class="row gx-4">
                                                           <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                                               <div class="card custom-card shadow-none mb-0 border-0">
                                                                   <div class="card-body p-0">
                                                                   <div class="row gy-3 bg-warning-transparent">
                                                                           <div class="col-xl-12">
                                                                               <label for="product-name-add" class="form-label">Part Name</label>
                                                                               <input type="text" class="form-control" id="product-name-add" placeholder="Name" value="LD Plain Bags 10x12">
                                                                           </div>
                                                                           <div class="col-xl-6">
                                                                               <label for="product-brand-add" class="form-label">Customer Code</label>
                                                                               <select class="form-control" data-trigger name="product-brand-add" id="product-brand-add">
                                                                                   <option value="">Select</option>
                                                                                   <option value="C021224 - TVS Motors">C021224 - TVS Motors</option>
                                                                                   <option value="C032645 - Yamaha Engines">C032645 - Yamaha Engines</option>
                                                                                   <option value="C045678 - Puma" selected>C045678 - Puma</option>
                                                                                   <option value="C045678 - Puma">C045678 - Puma</option>
                                                                                   <option value="C054321 - Spykar">C054321 - Spykar</option>
                                                                                   <option value="C067890 - Mufti">C067890 - Mufti</option>
                                                                                   <option value="C078902 - Home Town">C078902 - Home Town</option>
                                                                                   <option value="C089123 - Arrabi">C089123 - Arrabi</option>
                                                                               </select>
                                                                           </div>
                                                                           <div class="col-xl-6">
                                                                               <label for="product-category-add" class="form-label">Category</label>
                                                                               <select class="form-control" data-trigger name="product-category-add" id="product-category-add">
                                                                                   <option value="">Category</option>
                                                                                   <option value="Garbage Bags">Garbage Bags</option>
                                                                                   <option value="LD Plain Bags 10x12s">LD Plain Bags 10x12s</option>
                                                                                   <option value="LD Plain Bags 10x12s" selected>LD Plain Bags 10x12s</option>
                                                                                   <option value="Food Packaging">Food Packaging</option>
                                                                                   <option value="Industrial Packaging">Industrial Packaging</option>
                                                                                   <option value="Agricultural Bags">Agricultural Bags</option>
                                                                                   <option value="Gusseted Bags">Gusseted Bags</option>
                                                                                   <option value="Zip Lock Bags">Zip Lock Bags</option>
                                                                                   <option value="Biodegradable Bags">Biodegradable Bags</option>
                                                                                   <option value="HDPE Bags">HDPE Bags</option>
                                                                                   <option value="LDPE Bags">LDPE Bags</option>
                                                                                   <option value="Plastic Rolls">Plastic Rolls</option>
                                                                                   <option value="Courier Bags">Courier Bags</option>
                                                                               </select>
                                                                           </div>
                                                                           <div class="col-xl-6">
                                                                               <label for="product-type" class="form-label">Part Type</label>
                                                                               <input type="text" class="form-control" id="product-type" placeholder="Type" value="LD Plain Bags 10x12">
                                                                           </div>
                                                                           <div class="col-xl-3">
                                                                               <label for="product-hsn-add" class="form-label">HSN No</label>
                                                                               <input type="text" class="form-control" id="product-hsn-add" placeholder="Name" value="3923">
                                                                           </div>
                                                                           <div class="col-xl-3">
                                                                               <label for="product-thickness-add" class="form-label">Reel Size</label>
                                                                               <input type="text" class="form-control" id="product-thickness-add" placeholder="Reel Size" value="60x80 cm">
                                                                           </div>
                                                                           <div class="col-xl-3">
                                                                               <label for="product-size-add" class="form-label">Length</label>
                                                                               <input type="text" class="form-control" id="product-size-add" placeholder="Length" value="50 cm">
                                                                           </div>
                                                                           <div class="col-xl-3">
                                                                               <label for="product-size-add" class="form-label">Width</label>
                                                                               <input type="text" class="form-control" id="product-size-add" placeholder="Width" value="40 cm">
                                                                           </div>
                                                                           <div class="col-xl-3">
                                                                               <label for="product-size-add" class="form-label">Height</label>
                                                                               <input type="text" class="form-control" id="product-size-add" placeholder="Height" value="30 cm">
                                                                           </div>
                                                                           <div class="col-xl-3">
                                                                               <label for="product-thickness-add" class="form-label">Thickness</label>
                                                                               <input type="text" class="form-control" id="product-thickness-add" placeholder="Thickness" value="0.5 mm">
                                                                           </div>

                                                                           <div class="col-xl-3">
                                                                               <label for="material-ld-ratio" class="form-label">LD Ratio (%)</label>
                                                                               <input type="text" class="form-control" id="material-ld-ratio" placeholder="Enter LD Mixing Ratio" value="45">
                                                                           </div>

                                                                           <div class="col-xl-3">
                                                                               <label for="material-lld-ratio" class="form-label">LLD Ratio (%)</label>
                                                                               <input type="text" class="form-control" id="material-lld-ratio" placeholder="Enter LLD Mixing Ratio" value="35">
                                                                           </div>

                                                                           <div class="col-xl-3">
                                                                               <label for="material-hd-ratio" class="form-label">HD Ratio (%)</label>
                                                                               <input type="text" class="form-control" id="material-hd-ratio" placeholder="Enter HD Mixing Ratio" value="20">
                                                                           </div>
                                                                           <div class="col-xl-3">
                                                                               <label for="material-hd-ratio" class="form-label">RD Ratio (%)</label>
                                                                               <input type="text" class="form-control" id="material-hd-ratio" placeholder="Enter RD Mixing Ratio" value="10">
                                                                           </div>





                                                                           <div class="col-xl-6">
                                                                               <label for="product-discount" class="form-label">Item Weight</label>
                                                                               <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                                           </div>
                                                                           <div class="col-xl-6">
                                                                               <label for="product-gender-add" class="form-label">Sealing Type</label>
                                                                               <select class="form-control" data-trigger name="product-gender-add" id="product-gender-add">
                                                                                   <option value="">Select</option>
                                                                                   <option value="Side Seal" selected>Side Seal</option>
                                                                                   <option value="Bottom Seal">Bottom Seal</option>
                                                                                   <option value="Center Seal">Center Seal</option>
                                                                               </select>
                                                                           </div>

                                                                           <div class="col-xl-12">
                                                                            <label class="form-label">Part Description</label>
                                                                            <div id="product-feature2">High-quality packaging bag with side seal and custom printing options.</div>
                                                                        </div>

                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>
                                                           <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                                               <div class="card custom-card shadow-none mb-0 border-0">
                                                                   <div class="card-body p-0">
                                                                    <div class="row">

                                                                        <div class="col-xl-3">
                                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                            <input id="BST" name="BST" type="checkbox" checked="">
                                                                            <label for="BST" class="label-primary"></label><span class="ms-3">BST</span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-xl-3">
                                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                            <input id="Plain" name="Plain" type="checkbox" >
                                                                            <label for="Plain" class="label-primary"></label><span class="ms-3">Plain</span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-xl-3">
                                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                            <input id="Flat" name="Flat" type="checkbox" checked="">
                                                                            <label for="Flat" class="label-primary"></label><span class="ms-3">Flat</span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-xl-3">
                                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                            <input id="Gazzate" name="Gazzate" type="checkbox" checked="">
                                                                            <label for="Gazzate" class="label-primary"></label><span class="ms-3">Gazzate</span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-xl-3">
                                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                            <input id="BIO" name="BIO" type="checkbox" >
                                                                            <label for="BIO" class="label-primary"></label><span class="ms-3">Bio</span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-xl-3">
                                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                            <input id="NORMAL" name="NORMAL" type="checkbox" checked="">
                                                                            <label for="NORMAL" class="label-primary"></label><span class="ms-3">Normal</span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-xl-3">
                                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                            <input id="Milky" name="Milky" type="checkbox" checked="">
                                                                            <label for="Milky" class="label-primary"></label><span class="ms-3">Milky</span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-xl-3">
                                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                            <input id="Roto" name="Roto" type="checkbox" >
                                                                            <label for="Roto" class="label-primary"></label><span class="ms-3">Roto Printing</span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-xl-3">
                                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                            <input id="Flexo" name="Flexo" type="checkbox" checked="">
                                                                            <label for="Flexo" class="label-primary"></label><span class="ms-3">Flexo Printing</span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-xl-3">
                                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                            <input id="Sideseal" name="Sideseal" type="checkbox" >
                                                                            <label for="Sideseal" class="label-primary"></label><span class="ms-3">Sideseal</span>
                                                                          </div>
                                                                        </div>
                                                                        <div class="col-xl-3">
                                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                            <input id="Recyle" name="Recyle" type="checkbox" checked="">
                                                                            <label for="Recyle" class="label-primary"></label><span class="ms-3">Recycle Logo</span>
                                                                          </div>
                                                                        </div>
                                                                </div>

<label class="form-label">Extrution Output Details</label>
<hr>
                                                                       <div class="row gy-3 bg-success-transparent">


                                                                           <div class="col-xl-6">
                                                                             <label for="product-discount" class="form-label">Roll Batch no</label>
                                                                             <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="KP06/26/2025/000012574">
                                                                         </div>

                                                                         <div class="col-xl-6">
                                                                           <label for="product-discount" class="form-label">Machine Details*</label>
                                                                           <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="EXTR8494">
                                                                       </div>

                                                                         <div class="col-xl-3">
                                                                            <label for="product-discount" class="form-label">GR Weight </label>
                                                                           <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                                       </div>

                                                                       <div class="col-xl-3">
                                                                        <label for="product-discount" class="form-label">CR Weight </label>
                                                                         <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="5">
                                                                     </div>
                                                                     <div class="col-xl-3">
                                                                       <label for="product-discount" class="form-label">Wastage (Kgs)*</label>
                                                                       <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="5">
                                                                   </div>
                                                                   <div class="col-xl-3">
                                                                    <label for="product-discount" class="form-label">Net (Kgs)*</label>
                                                                    <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="490">
                                                                </div>
                                                                         <button class="btn btn-primary">Add Roll</button>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </div>


                                                       </div>

                                                        <!--  <hr> Section --><div class="row">


                                                           </div>
                                                   </div>
                                                   </div>
                                                   <div class="card-footer border-top border-block-start-dashed d-sm-flex justify-content-end">
                                                       <button class="btn btn-primary1 me-2 mb-2 mb-sm-0">cancel<i class="bi bi-plus-lg ms-2"></i></button>
                                                       <button class="btn btn-primary mb-2 mb-sm-0">Save<i class="bi bi-download ms-2"></i></button>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                       <!--End::row-1 -->
                                   </div>
                               </div>
                           </div>
 </div>

                           {{-- end rxtrution modal --}}




{{-- Start View Rolls modal --}}
<div class="modal fade" id="view-roll" tabindex="-1" aria-labelledby="editDataModalLabel" style="display: none;" data-bs-keyboard="false" aria-hidden="true">
                           <div class="modal-dialog modal-xl modal-dialog-scrollable">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h6 class="modal-title" id="editDataModalLabel">View Completed Rolls</h6>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal"
                                          aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
                                        <!-- Start::row-1 -->
                                        <div class="row">


                                          <div class="col-xl-12">
                                            <!-- Start::row-1 -->
   <div class="card custom-card">
     <div class="card-header justify-content-between">
         <div class="card-title">
             All Extruted Rolls List
         </div>
         <div class="d-flex gap-3 align-items-center flex-wrap">
             <div class="btn-group">
                 <button class="btn btn-outline-light border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                     <i class="ti ti-sort-descending-2 me-1"></i> Sort By
                 </button>
                 <ul class="dropdown-menu">

                     <li><a class="dropdown-item" href="javascript:void(0)">Newest</a></li>
                     <li><a class="dropdown-item" href="javascript:void(0)">Oldest</a></li>
                 </ul>
             </div>
             <div class="custom-form-group flex-grow-1">
                 <input type="text" class="form-control" placeholder="Search Orders.." aria-label="Recipient's username" aria-describedby="button-addon2">
                 <a href="javascript:void(0);" class="text-muted custom-form-btn"><i class="ti ti-search"></i></a>
             </div>
         </div>
     </div>
     <div class="card-body p-0">
         <div class="table-responsive">
         <table class="table table-hover text-nowrap">
                                                                            <thead>
                                                                                <tr>
                                                                                <th>
                                                    <input class="form-check-input check-all" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </th>

                                                                                    <th scope="col">Roll Batch No</th>
                                                                                    <th scope="col">Time</th>
                                                                                    <th scope="col">Roll Weight</th>
                                                                                    <th scope="col">Wastage</th>
                                                                                    <th scope="col">Machine</th>
                                                                                    <th scope="col">Operator</th>
                                                                                    <th scope="col">Status</th>
                                                                                    <th scope="col">FG Stock</th>
                                                                                    <th scope="col">Action</th>

                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                            <tr class="order-list">
                                                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>

                                                                                    <td>#P34008</td>
                                                                                    <td>10:30 AM</td>
                                                                                    <td>62.32 kg</td>
                                                                                    <td>1.29 kg</td>
                                                                                    <td>Machine A</td>
                                                                                    <td>Raj Sekar</td>
                                                                                    <td><span class="badge bg-primary-transparent">In Progress</span></td>
                                                                                    <td>
                                                                                                               <div class="d-flex align-items-center">

                                                                                                                   <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#move-extrution">Move Printing</a>
                                                                                                               </div></td>
                                                                                    <td>
                                                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                                                                                            <i class="ri-edit-line"></i>
                                                                                        </a>
                                                                                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                                                                                            <i class="ri-download-line"></i>
                                                                                        </a>
                                                                                        <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                                                                                            <i class="ri-delete-bin-line"></i>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr class="order-list">
                                                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>
                                                                                 <td>#P34009</td>
                                                                                 <td>11:00 AM</td>
                                                                                 <td>50 kg</td>
                                                                                 <td>5 kg</td>
                                                                                 <td>Machine A</td>
                                                                                 <td>Karthik Kumar</td>
                                                                                 <td><span class="badge bg-primary-transparent">In Progress</span></td>
                                                                                 <td>
                                                                                                               <div class="d-flex align-items-center">

                                                                                                                   <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#move-extrution">Move to Cutting</a>
                                                                                                               </div></td>
                                                                                 <td>
                                                                                     <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                                                                                         <i class="ri-edit-line"></i>
                                                                                     </a>
                                                                                     <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                                                                                         <i class="ri-download-line"></i>
                                                                                     </a>
                                                                                     <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                                                                                         <i class="ri-delete-bin-line"></i>
                                                                                     </a>
                                                                                 </td>
                                                                             </tr>
                                                                             <tr class="order-list">
                                                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>
                                                                                 <td>#P34010</td>
                                                                                 <td>11:45 AM</td>
                                                                                 <td>46 kg</td>
                                                                                 <td>2 kg</td>
                                                                                 <td>Machine A</td>
                                                                                 <td>Arun Vijay</td>
                                                                                 <td><span class="badge bg-primary-transparent">In Progress</span></td>
                                                                                 <td>
                                                                                                               <div class="d-flex align-items-center">

                                                                                                                   <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#move-extrution">Move FG Store</a>
                                                                                                               </div></td>
                                                                                 <td>
                                                                                     <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                                                                                         <i class="ri-edit-line"></i>
                                                                                     </a>
                                                                                     <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                                                                                         <i class="ri-download-line"></i>
                                                                                     </a>
                                                                                     <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                                                                                         <i class="ri-delete-bin-line"></i>
                                                                                     </a>
                                                                                 </td>
                                                                             </tr>
                                                                             <tr class="order-list">
                                                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>
                                                                                 <td>#P34011</td>
                                                                                 <td>12:15 PM</td>
                                                                                 <td>67.05 kg</td>
                                                                                 <td>3.19 kg</td>
                                                                                 <td>Machine D</td>
                                                                                 <td>Suresh Reddy</td>
                                                                                 <td><span class="badge bg-primary-transparent">In Progress</span></td>
                                                                                 <td>
                                                                                                               <div class="d-flex align-items-center">

                                                                                                                   <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#move-extrution">Move Slitting</a>
                                                                                                               </div></td>
                                                                                 <td>
                                                                                     <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                                                                                         <i class="ri-edit-line"></i>
                                                                                     </a>
                                                                                     <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                                                                                         <i class="ri-download-line"></i>
                                                                                     </a>
                                                                                     <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                                                                                         <i class="ri-delete-bin-line"></i>
                                                                                     </a>
                                                                                 </td>
                                                                             </tr>
                                                                             <tr class="order-list">
                                                                                <td class="companies-checkbox">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </td>
                                                                                 <td>#P34012</td>
                                                                                 <td>12:45 PM</td>
                                                                                 <td>56.98 kg</td>
                                                                                 <td>2.56 kg</td>
                                                                                 <td>Machine E</td>
                                                                                 <td>Vikram Raj</td>
                                                                                 <td><span class="badge bg-primary-transparent">In Progress</span></td>
                                                                                 <td>
                                                                                                               <div class="d-flex align-items-center">

                                                                                                                   <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#move-extrution">Move Pasting</a>
                                                                                                               </div></td>
                                                                                 <td>
                                                                                     <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                                                                                         <i class="ri-edit-line"></i>
                                                                                     </a>
                                                                                     <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                                                                                         <i class="ri-download-line"></i>
                                                                                     </a>
                                                                                     <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                                                                                         <i class="ri-delete-bin-line"></i>
                                                                                     </a>
                                                                                 </td>
                                                                             </tr>




                                                                            </tbody>
                                                                        </table>
         </div>
     </div>
     <div class="card-footer border-top-0">
         <div class="d-flex align-items-center flex-wrap overflow-auto">
             <div class="mb-2 mb-sm-0">
                 Showing <b>1</b> to <b>10</b> entries <i class="bi bi-arrow-right ms-2 fw-semibold"></i>
             </div>
             <div class="ms-auto">
                 <ul class="pagination mb-0 overflow-auto">
                     <li class="page-item disabled">
                         <a class="page-link">Previous</a>
                     </li>
                     <li class="page-item active" aria-current="page"><a class="page-link" href="javascript:void(0)">1</a></li>
                     <li class="page-item">
                         <a class="page-link" href="javascript:void(0)">2</a>
                     </li>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                     <li class="page-item"><a class="page-link" href="javascript:void(0)">5</a></li>
                     <li class="page-item">
                         <a class="page-link" href="javascript:void(0)">Next</a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </div>
 <!--End::row-1 -->
                                          </div>
                                      </div>
                                      <!--End::row-1 -->
                                  </div>
                              </div>
                          </div>
</div>

                          {{-- end rxtrution modal --}}


                           @endsection
