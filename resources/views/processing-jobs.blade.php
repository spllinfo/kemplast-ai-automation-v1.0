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
            <th scope="col">Due</th>
            <th scope="col">Status</th>
            
            
            <th scope="col">Extrusion</th>
           
            <th scope="col">Printing</th>
            <th scope="col">Pasting</th>
            <th scope="col">Slitting</th>  
            <th scope="col">Cutting</th>                     
            <th scope="col">FG Stock</th>
            <th scope="col">Assigned To</th>
            <th scope="col">Action</th>
            <th scope="col">Job Status</th>
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
                                                            <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Plastic Wraps 249X53 CM</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90102 - #P86574 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                             
                                                          
                                                <td>
                                                    <div class="d-flex">
                                                    <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/5.png')}}" alt="Company Logo">
                                                        </span>
                                                        <div class="ms-2">
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Ford Auto Parts</a><br>
                                                        <p class="fs-12 badge bg-warning-transparent mb-0">High</p>
                                                        
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                <div>
                                                        <span class="text-info">5days ago</span><br>
                                                        <span class="text-danger">14-02-2025</span>
                                                      
                                                    </div>

</td>  
                                                
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine3.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary1 " data-bs-toggle="modal" data-bs-target="#assign-material"><i class="ri-add-line fw-medium align-middle me-1"></i>Raw Mat.</a>
                                                    </div></td>
                       
                                                
                                                <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>565.45kg / 20 Rolls</span>
                                                        
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div>
                                                        <span class="text-primary">80% Completed</span><br>
                                                        <span>420.45kg / 15 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                     
                                                <td>
                                                    <div>
                                                        <span class="text-primary">60% Completed</span><br>
                                                        <span>390.45kg / 13 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-primary">60% Completed</span><br>
                                                        <span>390.45kg / 13 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-primary">60% Completed</span><br>
                                                        <span>300Kg /5000 Bags</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 60%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                             
                                                <td>
                                                    <div>
                                                        <span class="text-success">60% Completed</span><br>
                                                        <span>300Kg /5000 Bags</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 60%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                          
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
                                                <td>
                                                    <div>
                                                        <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                        </div>
                                                        <div class="mt-1"><span class="text-primary fw-medium">50%</span> Completed</div>
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
                        <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Plastic Wraps 249X53 CM 26X36CM</a></p>
                        <p class="fs-12 text-primary mb-0">#J90102 - #P86574 - Part Type</p>
                    </div>
                </div>
            </td>
            <td>
                                                    <div class="d-flex">
                                                    <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/5.png')}}" alt="Company Logo">
                                                        </span>
                                                        <div class="ms-2">
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Tesla Motors Pvt Ltd pvt</a><br>
                                                        <p class="fs-12 badge bg-warning-transparent mb-0">High</p>
                                                        
                                                        </div>
                                                    </div>
                                                </td>
                                      
            <td>
                                                <div>
                                                        <span class="text-info">5days ago</span><br>
                                                        <span class="text-danger">14-02-2025</span>
                                                      
                                                    </div>

</td>  
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                        <img src="{{ asset('assets/images/media/machine3.jpg')}}" alt="Company Logo">
                    </span>
                    <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary2" data-bs-toggle="modal" data-bs-target="#move-extrution"><i class="ri-add-line fw-medium align-middle me-1"></i> Extrution</a>
                </div>
            </td>
            
            
            <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>565.45kg / 20 Rolls</span>
                                                        
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div>
                                                        <span class="text-primary">80% Completed</span><br>
                                                        <span>420.45kg / 15 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                     
                                                <td>
                                                    <div>
                                                        <span class="text-primary">60% Completed</span><br>
                                                        <span>390.45kg / 13 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-primary">40% Completed</span><br>
                                                        <span>390.45kg / 13 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-warning">20% Completed</span><br>
                                                        <span>300Kg /13 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-warning" style="width: 60%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                             
                                                <td>
                                                    <div>
                                                        <span class="text-danger">20% Completed</span><br>
                                                        <span>300Kg /13 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" style="width: 60%"></div>
                                                        </div>
                                                    </div>
                                                </td>
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
            <td>
                <div>
                    <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-primary" style="width: 30%"></div>
                    </div>
                    <div class="mt-1"><span class="text-primary fw-medium">30%</span> Completed</div>
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
                                                            <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Plastic Wraps 249X53 CM 50X60CM</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90102 - #P86574 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
 
                                                <td>
                                                    <div class="d-flex">
                                                    <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/5.png')}}" alt="Company Logo">
                                                        </span>
                                                        <div class="ms-2">
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Orio Cookies pvt</a><br>
                                                        <p class="fs-12 badge bg-danger-transparent mb-0">High</p>
                                                        
                                                        </div>
                                                    </div>
                                                </td>                     
                                                <td>
                                                <div>
                                                        <span class="text-info">5days ago</span><br>
                                                        <span class="text-danger">14-02-2025</span>
                                                      
                                                    </div>

</td>  
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary3"  data-bs-toggle="modal" data-bs-target="#move-printing"><i class="bi bi-plus-lg " style="font-weight: bold;"></i> Printing</a>
                                                    </div></td>
                                                
                                                
                                                <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>565.45kg / 20 Rolls</span>
                                                        
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-danger">No Process</span><br>
                                                        <span>No Process</span>
                                                        <!-- <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" style="width: 20%"></div>
                                                        </div> -->
                                                    </div>
                                                </td>
                                                     
                                                <td>
                                                    <div>
                                                        <span class="text-primary">60% Completed</span><br>
                                                        <span>390.45kg / 13 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-danger">No Process</span><br>
                                                        <span>No Process</span>
                                                        <!-- <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" style="width: 20%"></div>
                                                        </div> -->
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-warning">20% Completed</span><br>
                                                        <span>300Kg /5000 Bags</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-warning" style="width: 60%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                             
                                                <td>
                                                    <div>
                                                        <span class="text-danger">20% Completed</span><br>
                                                        <span>300Kg /5000 Bags</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" style="width: 60%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                              
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
                                                <td>
                                                    <div>
                                                        <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-primary" style="width: 50%"></div>
                                                        </div>
                                                        <div class="mt-1"><span class="text-primary fw-medium">50%</span> Completed</div>
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
                <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Plastic Wraps 249X53 CM 30X69CM</a></p>
                <p class="fs-12 text-primary mb-0">#J90102 - #P86574 - Part Type</p>
            </div>
        </div>
    </td>

    <td>
        <div class="d-flex">
        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                <img src="{{ asset('assets/images/company-logos/5.png')}}" alt="Company Logo">
            </span>
            <div class="ms-2">
            <a href="javascript:void(0);" class="fw-medium mb-0">Orio Cookies pvt</a><br>
            <p class="fs-12 badge bg-danger-transparent mb-0">High</p>
            
            </div>
        </div>
    </td>                     
    <td>
    <div>
            <span class="text-info">5days ago</span><br>
            <span class="text-danger">14-02-2025</span>
          
        </div>

</td>  
    <td>
        <div class="d-flex align-items-center">
            <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
            </span>
            <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-secondary"  data-bs-toggle="modal" data-bs-target="#move-pasting"><i class="bi bi-plus-lg " style="font-weight: bold;"></i> Pasting</a>
        </div></td>
    
    
    <td>
        <div>
            <span class="text-success">100% Completed</span><br>
            <span>565.45kg / 20 Rolls</span>
            
            <div class="progress progress-xs">
                <div class="progress-bar bg-success" style="width: 100%"></div>
            </div>
        </div>
    </td>
    <td>
        <div>
            <span class="text-danger">No Process</span><br>
            <span>No Process</span>
            <!-- <div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: 20%"></div>
            </div> -->
        </div>
    </td>
         
    <td>
        <div>
            <span class="text-primary">60% Completed</span><br>
            <span>390.45kg / 13 Rolls</span>
            <div class="progress progress-xs">
                <div class="progress-bar bg-primary" style="width: 80%"></div>
            </div>
        </div>
    </td>
    <td>
        <div>
            <span class="text-danger">No Process</span><br>
            <span>No Process</span>
            <!-- <div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: 20%"></div>
            </div> -->
        </div>
    </td>
    <td>
        <div>
            <span class="text-warning">20% Completed</span><br>
            <span>300Kg /5000 Bags</span>
            <div class="progress progress-xs">
                <div class="progress-bar bg-warning" style="width: 60%"></div>
            </div>
        </div>
    </td>
 
    <td>
        <div>
            <span class="text-danger">20% Completed</span><br>
            <span>300Kg /5000 Bags</span>
            <div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: 60%"></div>
            </div>
        </div>
    </td>
  
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
    <td>
        <div>
            <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-primary" style="width: 50%"></div>
            </div>
            <div class="mt-1"><span class="text-primary fw-medium">50%</span> Completed</div>
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
                <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Plastic Wraps 249X53 CM 80X90CM</a></p>
                <p class="fs-12 text-primary mb-0">#J90102 - #P86574 - Part Type</p>
            </div>
        </div>
    </td>

    <td>
        <div class="d-flex">
        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                <img src="{{ asset('assets/images/company-logos/5.png')}}" alt="Company Logo">
            </span>
            <div class="ms-2">
            <a href="javascript:void(0);" class="fw-medium mb-0">Microsoft PC/Lap Division</a><br>
            <p class="fs-12 badge bg-danger-transparent mb-0">High</p>
            
            </div>
        </div>
    </td>                     
    <td>
    <div>
            <span class="text-info">5days ago</span><br>
            <span class="text-danger">14-02-2025</span>
          
        </div>

</td>  
    <td>
        <div class="d-flex align-items-center">
            <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                <img src="{{ asset('assets/images/media/machine2.jpg')}}" alt="Company Logo">
            </span>
            <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-primary"  data-bs-toggle="modal" data-bs-target="#move-slitting"><i class="bi bi-plus-lg " style="font-weight: bold;"></i>  Slitting</a>
        </div></td>
    
    
    <td>
        <div>
            <span class="text-success">100% Completed</span><br>
            <span>565.45kg / 20 Rolls</span>
            
            <div class="progress progress-xs">
                <div class="progress-bar bg-success" style="width: 100%"></div>
            </div>
        </div>
    </td>
    <td>
        <div>
            <span class="text-danger">No Process</span><br>
            <span>No Process</span>
            <!-- <div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: 20%"></div>
            </div> -->
        </div>
    </td>
         
    <td>
        <div>
            <span class="text-primary">60% Completed</span><br>
            <span>390.45kg / 13 Rolls</span>
            <div class="progress progress-xs">
                <div class="progress-bar bg-primary" style="width: 80%"></div>
            </div>
        </div>
    </td>
    <td>
        <div>
            <span class="text-danger">No Process</span><br>
            <span>No Process</span>
            <!-- <div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: 20%"></div>
            </div> -->
        </div>
    </td>
    <td>
        <div>
            <span class="text-warning">20% Completed</span><br>
            <span>300Kg /5000 Bags</span>
            <div class="progress progress-xs">
                <div class="progress-bar bg-warning" style="width: 60%"></div>
            </div>
        </div>
    </td>
 
    <td>
        <div>
            <span class="text-danger">20% Completed</span><br>
            <span>300Kg /5000 Bags</span>
            <div class="progress progress-xs">
                <div class="progress-bar bg-danger" style="width: 60%"></div>
            </div>
        </div>
    </td>
  
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
    <td>
        <div>
            <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-primary" style="width: 50%"></div>
            </div>
            <div class="mt-1"><span class="text-primary fw-medium">50%</span> Completed</div>
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
                                                            <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Plastic Wraps 249X53 CM 35X160CM</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90103 - #P99579 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                            
                                                       
                                                <td>
                                                    <div class="d-flex">
                                                    <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/3.png')}}" alt="Company Logo">
                                                        </span>
                                                        <div class="ms-2">
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Tesla Motors Pvt Ltd</a><br>
                                                        <p class="fs-12 badge bg-warning-transparent mb-0">Critical</p>
                                                        
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                <div>
                                                        <span class="text-info">10days ago</span><br>
                                                        <span class="text-danger">14-02-2025</span>
                                                      
                                                    </div>

</td>  
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine3.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-warning"  data-bs-toggle="modal" data-bs-target="#move-cutting"><i class="bi bi-plus-lg " style="font-weight: bold;"></i>  Cutting</a>
                                                    </div></td>
                                                
                                                
                                                <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>565.45kg / 20 Rolls</span>
                                                        
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-danger">No Process</span><br>
                                                        <span>No Process</span>
                                                        <!-- <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" style="width: 20%"></div>
                                                        </div> -->
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-primary">80% Completed</span><br>
                                                        <span>420.45kg / 15 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                     
                                                <td>
                                                    <div>
                                                        <span class="text-primary">60% Completed</span><br>
                                                        <span>390.45kg / 13 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-primary">40% Completed</span><br>
                                                        <span>390.45kg / 13 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-warning">20% Completed</span><br>
                                                        <span>300Kg /5000 Bags</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-warning" style="width: 60%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                             
                                              
                                            
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
                                            
                                          
                                                <td>
                                                    <div>
                                                        <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-primary" style="width: 20%"></div>
                                                        </div>
                                                        <div class="mt-1"><span class="text-primary fw-medium">20%</span> Completed</div>
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
                                                            <p class="fw-medium mb-0 d-flex align-items-center"><a href="job-details.html">Ferrari Auto Part Bags</a></p>
                                                            <p class="fs-12 text-primary mb-0">#J90101 - #P34008 - Part Type</p>
                                                        </div>
                                                    </div>
                                                </td>
                                             
                                                                       
                                                <td>
                                                    <div class="d-flex">
                                                    <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/company-logos/5.png')}}" alt="Company Logo">
                                                        </span>
                                                        <div class="ms-2">
                                                        <a href="javascript:void(0);" class="fw-medium mb-0">Bently Motors Pvt Ltd</a><br>
                                                        <p class="fs-12 badge bg-primary-transparent mb-0">Medium</p>
                                                        
                                                        </div>
                                                    </div>
                                                </td>                     
                                                <td>
                                                <div>
                                                        <span class="text-info">5days ago</span><br>
                                                        <span class="text-danger">14-02-2025</span>
                                                      
                                                    </div>

</td>  
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <span class="avatar avatar-sm p-1 me-1 bg-light avatar-rounded">
                                                            <img src="{{ asset('assets/images/media/machine3.jpg')}}" alt="Company Logo">
                                                        </span>
                                                        <a href="javascript:void(0);" class="fw-medium mb-0 badge btn-success"  data-bs-toggle="modal" data-bs-target="#move-finish"><i class="bi bi-plus-lg " style="font-weight: bold;"></i>  Finish</a>
                                                    </div></td>
                                                
                                                
                                                <td>
                                                    <div>
                                                        <span class="text-success">100% Completed</span><br>
                                                        <span>565.45kg / 20 Rolls</span>
                                                        
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-success" style="width: 100%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-danger">No Process</span><br>
                                                        <span>No Process</span>
                                                        <!-- <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" style="width: 20%"></div>
                                                        </div> -->
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-danger">No Process</span><br>
                                                        <span>No Process</span>
                                                        <!-- <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" style="width: 20%"></div>
                                                        </div> -->
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div>
                                                        <span class="text-danger">No Process</span><br>
                                                        <span>No Process</span>
                                                        <!-- <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" style="width: 20%"></div>
                                                        </div> -->
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="text-primary">60% Completed</span><br>
                                                        <span>390.45kg / 13 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                             
                                                <td>
                                                    <div>
                                                        <span class="text-danger">20% Completed</span><br>
                                                        <span>390.45kg / 13 Rolls</span>
                                                        <div class="progress progress-xs">
                                                            <div class="progress-bar bg-danger" style="width: 60%"></div>
                                                        </div>
                                                    </div>
                                                </td>
                                               
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
                                                <td>
                                                    <div>
                                                        <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar bg-primary" style="width: 65%"></div>
                                                        </div>
                                                        <div class="mt-1"><span class="text-primary fw-medium">65%</span> Completed</div>
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

 



                <!-- {{-- Start modal --}} -->
<div class="modal fade" id="assign-material" tabindex="-1" aria-labelledby="editDataModalLabel" style="display: none;" data-bs-keyboard="false" aria-hidden="true">
 <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="editDataModalLabel">Assign Raw Material</h6>
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
                                                    <input type="text" class="form-control" id="product-name-add" placeholder="Name" value="HM Printed Bags 32x60"> 
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
                                                        <option value="HM Printed Bags 32x60s">HM Printed Bags 32x60s</option>
                                                        <option value="HM Printed Bags 32x60s" selected>HM Printed Bags 32x60s</option>
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
                                                    <input type="text" class="form-control" id="product-type" placeholder="Type" value="HM Printed Bags 32x60"> 
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
                                                    <input type="text" class="form-control" id="material-hd-ratio" placeholder="Enter HD Mixing Ratio" value="14">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="material-hd-ratio" class="form-label">RD Ratio (%)</label>
                                                    <input type="text" class="form-control" id="material-hd-ratio" placeholder="Enter RD Mixing Ratio" value="6">
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
                                                    <label class="form-label">High-quality packaging bag with side seal and custom printing options.</label>
                                                </div>
                                                  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                    <div class="card custom-card shadow-none mb-0 border-0">
                                        <div class="card-body p-0">
                                           
                                            <div class="row gy-3 bg-success-transparent">
                                            <p class="text-primary">USED RAW MATERIAL INFORMATION</p>
                                               
                                                
                                                <div class="col-xl-6">
                                                    <label for="product-category-ld" class="form-label">Matrial LD</label>
                                                    <select class="form-control" data-trigger name="product-category-ld" id="product-category-ld">
                                                    <option value="LD-51242">51242 | 968Kg | 12-Jan</option>
<option value="LD-51243">51243 | 968Kg | 13-Jan</option>
<option value="LD-51244">51244 | 968Kg | 14-Jan</option>
<option value="LD-51245">51245 | 968Kg | 15-Jan</option>
<option value="LD-51246">51246 | 968Kg | 16-Jan</option>
<option value="LD-51247">51247 | 968Kg | 17-Jan</option>
<option value="LD-51248">51248 | 968Kg | 18-Jan</option>
<option value="LD-51249">51249 | 968Kg | 19-Jan</option>
<option value="LD-51250">51250 | 968Kg | 20-Jan</option>
<option value="LD-51251">51251 | 968Kg | 21-Jan</option>
<option value="LD-51252">51252 | 968Kg | 22-Jan</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="material-ld-ratio" class="form-label">LD Req Wgt</label>
                                                    <input type="text" class="form-control" id="material-ld-ratio" placeholder="Enter LD Mixing Ratio" value="120 Kg">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="material-ld-ratio" class="form-label">Stock Ret Wgt</label>
                                                    <input type="text" class="form-control" id="material-ld-ratio" placeholder="Enter LD Mixing Ratio" value="457 Kg">
                                                </div>
                                                 <!--  <hr> Section -->
                                                <!-- PE Section -->
                                                <div class="col-xl-6">
                                                <label for="product-category-pe" class="form-label">Material PE</label>
                                                <select class="form-control" data-trigger name="product-category-pe" id="product-category-pe">
                                                <option value="PE-61242">61242 | 768Kg | 12-Jan</option>
<option value="PE-61243">61243 | 768Kg | 13-Jan</option>
<option value="PE-61244">61244 | 768Kg | 14-Jan</option>
<option value="PE-61245">61245 | 768Kg | 15-Jan</option>
<option value="PE-61246">61246 | 768Kg | 16-Jan</option>
                                                </select>
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-pe-ratio" class="form-label">PE Req Wgt</label>
                                                <input type="text" class="form-control" id="material-pe-ratio" placeholder="Enter PE Mixing Ratio" value="80 Kg">
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-pe-used" class="form-label">Stock Ret Wgt</label>
                                                <input type="text" class="form-control" id="material-pe-used" placeholder="Enter PE Stock Ret Wgt" value="357 Kg">
                                                </div>
                                                 <!--  <hr> Section -->
                                                <!-- HD Section -->
                                                <div class="col-xl-6">
                                                <label for="product-category-hd" class="form-label">Material HD</label>
                                                <select class="form-control" data-trigger name="product-category-hd" id="product-category-hd">
                                                <option value="HD-71242">71242 | 868Kg | 12-Jan</option>
<option value="HD-71243">71243 | 868Kg | 13-Jan</option>
<option value="HD-71244">71244 | 868Kg | 14-Jan</option>
<option value="HD-71245">71245 | 868Kg | 15-Jan</option>
<option value="HD-71246">71246 | 868Kg | 16-Jan</option>

                                                </select>
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-hd-ratio" class="form-label">HD Req Wgt</label>
                                                <input type="text" class="form-control" id="material-hd-ratio" placeholder="Enter HD Mixing Ratio" value="30 Kg">
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-hd-used" class="form-label">Stock Ret Wgt</label>
                                                <input type="text" class="form-control" id="material-hd-used" placeholder="Enter HD Stock Ret Wgt" value="557 Kg">
                                                </div>
                                                 <!--  <hr> Section -->
                                                <!-- RD Section -->
                                                <div class="col-xl-6">
                                                <label for="product-category-rd" class="form-label">Material RD</label>
                                                <select class="form-control" data-trigger name="product-category-rd" id="product-category-rd">
                                                <option value="RD-81242">81242 | 968Kg | 12-Jan</option>
<option value="RD-81243">81243 | 968Kg | 13-Jan</option>
<option value="RD-81244">81244 | 968Kg | 14-Jan</option>
<option value="RD-81245">81245 | 968Kg | 15-Jan</option>
<option value="RD-81246">81246 | 968Kg | 16-Jan</option>
                                                </select>
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-rd-ratio" class="form-label">RD Req Wgt</label>
                                                <input type="text" class="form-control" id="material-rd-ratio" placeholder="Enter RD Mixing Ratio" value="10 Kg">
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-rd-used" class="form-label">Stock Ret Wgt</label>
                                                <input type="text" class="form-control" id="material-rd-used" placeholder="Enter RD Stock Ret Wgt" value="657 Kg">
                                                </div>
                                                 <!--  <hr> Section -->
                                                <!-- LLD Section -->
                                                <div class="col-xl-6">
                                                <label for="product-category-lld" class="form-label">Material LLD</label>
                                                <select class="form-control" data-trigger name="product-category-lld" id="product-category-lld">
                                                <option value="LLD-91242">91242 | 668Kg | 12-Jan</option>
<option value="LLD-91243">91243 | 668Kg | 13-Jan</option>
<option value="LLD-91244">91244 | 668Kg | 14-Jan</option>
<option value="LLD-91245">91245 | 668Kg | 15-Jan</option>
<option value="LLD-91246">91246 | 668Kg | 16-Jan</option>
                                                </select>
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-lld-ratio" class="form-label">LLD Req Wgt</label>
                                                <input type="text" class="form-control" id="material-lld-ratio" placeholder="Enter LLD Mixing Ratio" value="2.58 Kg">
                                                </div>
                                                <div class="col-xl-3">
                                                <label for="material-lld-used" class="form-label">Stock Ret Wgt</label>
                                                <input type="text" class="form-control" id="material-lld-used" placeholder="Enter LLD Stock Ret Wgt" value="257 Kg">
                                                </div>
                                                
                                                <button class="btn btn-primary">Raw Material Mixture (Batch-based)</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
     
                            </div>
                             <!--  <hr> Section --><div class="row">
                            <div class="col-xl-3">
    <div class="custom-toggle-switch d-flex flex-column align-items-start mb-4">
        <div class="d-flex align-items-center">
            <input id="batch1" name="batch1" type="checkbox" checked="">
            <label for="batch1" class="label-primary"></label>
            <span class="ms-3">Batch 1</span>
        </div>
        <span class="badge bg-primary-transparent mt-2">Total R.M Wgt: 150KG</span>
    </div>
</div>

<div class="col-xl-3">
    <div class="custom-toggle-switch d-flex flex-column align-items-start mb-4">
        <div class="d-flex align-items-center">
            <input id="batch2" name="batch2" type="checkbox" checked="">
            <label for="batch2" class="label-primary"></label>
            <span class="ms-3">Batch 2</span>
        </div>
        <span class="badge bg-primary-transparent mt-2">Total R.M Wgt: 150KG</span>
    </div>
</div>

<div class="col-xl-3">
    <div class="custom-toggle-switch d-flex flex-column align-items-start mb-4">
        <div class="d-flex align-items-center">
            <input id="batch3" name="batch3" type="checkbox" checked="">
            <label for="batch3" class="label-primary"></label>
            <span class="ms-3">Batch 3</span>
        </div>
        <span class="badge bg-primary-transparent mt-2">Total R.M Wgt: 150KG</span>
    </div>
</div>

<div class="col-xl-3">
    <div class="custom-toggle-switch d-flex flex-column align-items-start mb-4">
        <div class="d-flex align-items-center">
            <input id="batch4" name="batch4" type="checkbox" checked="">
            <label for="batch4" class="label-primary"></label>
            <span class="ms-3">Batch 4</span>
        </div>
        <span class="badge bg-primary-transparent mt-2">Total R.M Wgt: 86KG</span>
    </div>
</div>
                            
                             <!--  <hr> Section --><div class="row">
                                
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
</div></div>

<!-- -- end modal  -->




                        <!-- {{-- Start extrution modal --}} -->
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
                                                                               <input type="text" class="form-control" id="product-name-add" placeholder="Name" value="HM Printed Bags 32x60"> 
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
                                                                                   <option value="HM Printed Bags 32x60s">HM Printed Bags 32x60s</option>
                                                                                   <option value="HM Printed Bags 32x60s" selected>HM Printed Bags 32x60s</option>
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
                                                                               <input type="text" class="form-control" id="product-type" placeholder="Type" value="HM Printed Bags 32x60"> 
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
                                                                 <!--  <hr> Section -->
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
                                                        <!--  <hr> Section -->
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
                                                    <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="8">
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
                           
                           <!-- {{-- end rxtrution modal --}} -->

               
               
               
               
                            <!-- {start printing modal -->
                            <div class="modal fade" id="move-printing" tabindex="-1" aria-labelledby="editDataModalLabel" style="display: none;" data-bs-keyboard="false" aria-hidden="true">
                              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h6 class="modal-title" id="editDataModalLabel">Add Printing Output </h6>
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
                                                                                 <input type="text" class="form-control" id="product-name-add" placeholder="Name" value="HM Printed Bags 32x60"> 
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
                                                                                     <option value="HM Printed Bags 32x60s">HM Printed Bags 32x60s</option>
                                                                                     <option value="HM Printed Bags 32x60s" selected>HM Printed Bags 32x60s</option>
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
                                                                                 <input type="text" class="form-control" id="product-type" placeholder="Type" value="HM Printed Bags 32x60"> 
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
                                                                             <div class="card custom-card shadow-none mb-0 border-0">
                                                                  <div class="card-body p-0">
                                                                      <div class="row gy-3">
                                                                          <div class="col-xl-12">
                                                                              <label class="form-label">Part Description</label>
                                                                              <div id="product-features"></div>
                                                                          </div>
                                                                          <div class="col-xl-12 product-documents-container">
                                                                              <p class="fw-medium mb-2 fs-14">Part Images</p>
                                                                              <div class="avatar-list-stacked">
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}"  alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User">
                                                                                  </span>  
                                                                                  <a class="avatar avatar-md bg-primary text-fixed-white" style="width: 3rem; height: 3rem;" href="javascript:void(0);">
                                                                                      +6
                                                                                  </a>
                                                                              </div>
                                                                          </div>
                                                                          <label class="form-label text-muted mt-3 fw-normal fs-12">* Minimum of 6 images are need to be uploaded,
                                                                              all images should be uniformly maintained, width and height to the container.
                                                                          </label>
                                                                      
                                                                          <div class="col-xl-12 product-documents-container">
                                                                              <p class="fw-medium mb-2 fs-14">Part Pdf Documents</p>
                                                                              <div class="avatar-list-stacked">
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}"  alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User">
                                                                                  </span>  
                                                                                  <a class="avatar avatar-md bg-primary text-fixed-white" style="width: 3rem; height: 3rem;" href="javascript:void(0);">
                                                                                      +6
                                                                                  </a>
                                                                              </div>
                                                                          </div>
                                                                      
                                                                        
                                                                         
                                                                      </div>
                                                                  </div>
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
                                                                         <div class="row gy-3 bg-success-transparent">
                                                                         
                                                                                  
                                                                             <div class="col-xl-6">
                                                                               <label for="product-discount" class="form-label">Roll Batch no</label>
                                                                               <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="KP06/26/2025/000012574">
                                                                           </div>
                             
                                                                           <div class="col-xl-6">
                                                                             <label for="product-discount" class="form-label">Machine Details*</label>
                                                                             <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="PRINT8494">
                                                                         </div>
                             
                                                                           <div class="col-xl-3">
                                                                              <label for="product-discount" class="form-label">GR Weight </label>
                                                                             <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                                         </div>
                                                                         
                                                                         <div class="col-xl-3">
                                                                          <label for="product-discount" class="form-label">CR Weight </label>
                                                                           <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="12">
                                                                       </div>
                                                                       <div class="col-xl-3">
                                                                         <label for="product-discount" class="form-label">Wastage (Kgs)*</label>
                                                                         <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="5">
                                                                     </div>
                                                                     <div class="col-xl-3">
                                                                      <label for="product-discount" class="form-label">Net (Kgs)*</label>
                                                                      <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="490">
                                                                  </div>
                                                                           <!--  <hr> Section -->
                                                                  <div class="col-xl-6">
                                                                      <label for="product-discount" class="form-label">Roll Batch no</label>
                                                                      <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="KP06/26/2025/000012574">
                                                                  </div>
                          
                                                                  <div class="col-xl-6">
                                                                    <label for="product-discount" class="form-label">Machine Details*</label>
                                                                    <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="PRINT8494">
                                                                </div>
                          
                                                                  <div class="col-xl-3">
                                                                     <label for="product-discount" class="form-label">GR Weight </label>
                                                                    <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                                </div>
                                                                
                                                                <div class="col-xl-3">
                                                                 <label for="product-discount" class="form-label">CR Weight </label>
                                                                  <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="12">
                                                              </div>
                                                              <div class="col-xl-3">
                                                                <label for="product-discount" class="form-label">Wastage (Kgs)*</label>
                                                                <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="5">
                                                            </div>
                                                            <div class="col-xl-3">
                                                             <label for="product-discount" class="form-label">Net (Kgs)*</label>
                                                             <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="490">
                                                         </div>
                                                          <!--  <hr> Section -->
                                                         <div class="col-xl-6">
                                                          <label for="product-discount" class="form-label">Roll Batch no</label>
                                                          <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="KP06/26/2025/000012574">
                                                      </div>
                          
                                                      <div class="col-xl-6">
                                                        <label for="product-discount" class="form-label">Machine Details*</label>
                                                        <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="PRINT8494">
                                                    </div>
                          
                                                      <div class="col-xl-3">
                                                         <label for="product-discount" class="form-label">GR Weight </label>
                                                        <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                    </div>
                                                    
                                                    <div class="col-xl-3">
                                                     <label for="product-discount" class="form-label">CR Weight </label>
                                                      <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="12">
                                                  </div>
                                                  <div class="col-xl-3">
                                                    <label for="product-discount" class="form-label">Wastage (Kgs)*</label>
                                                    <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="5">
                                                </div>
                                                <div class="col-xl-3">
                                                 <label for="product-discount" class="form-label">Net (Kgs)*</label>
                                                 <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="490">
                                             </div>   <!--  <hr> Section -->
                                                         <div class="col-xl-6">
                                                          <label for="product-discount" class="form-label">Roll Batch no</label>
                                                          <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="KP06/26/2025/000012574">
                                                      </div>
                          
                                                      <div class="col-xl-6">
                                                        <label for="product-discount" class="form-label">Machine Details*</label>
                                                        <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="PRINT8494">
                                                    </div>
                          
                                                      <div class="col-xl-3">
                                                         <label for="product-discount" class="form-label">GR Weight </label>
                                                        <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                    </div>
                                                    
                                                    <div class="col-xl-3">
                                                     <label for="product-discount" class="form-label">CR Weight </label>
                                                      <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="12">
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
                                                             <hr>
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
                             
                            <!-- end printing modal           -->
               
                   <!-- {start Slitting modal -->
    <div class="modal fade" id="move-pasting" tabindex="-1" aria-labelledby="editDataModalLabel" style="display: none;" data-bs-keyboard="false" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h6 class="modal-title" id="editDataModalLabel">Add Pasting Output </h6>
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
                                                         <input type="text" class="form-control" id="product-name-add" placeholder="Name" value="HM Printed Bags 32x60"> 
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
                                                             <option value="HM Printed Bags 32x60s">HM Printed Bags 32x60s</option>
                                                             <option value="HM Printed Bags 32x60s" selected>HM Printed Bags 32x60s</option>
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
                                                         <input type="text" class="form-control" id="product-type" placeholder="Type" value="HM Printed Bags 32x60"> 
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
                                                     <div class="card custom-card shadow-none mb-0 border-0">
                                          <div class="card-body p-0">
                                              <div class="row gy-3">
                                                  <div class="col-xl-12">
                                                      <label class="form-label">Part Description</label>
                                                      <div id="product-features"></div>
                                                  </div>
                                                  <div class="col-xl-12 product-documents-container">
                                                      <p class="fw-medium mb-2 fs-14">Part Images</p>
                                                      <div class="avatar-list-stacked">
                                                          <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                              <img src="{{ asset('assets/images/media/ongoing.png')}}"  alt="User"></span>
                                                          <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                              <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                          <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                              <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User"></span>
                                                          <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                              <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="User"></span>
                                                          <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                              <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                          <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                              <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User">
                                                          </span>  
                                                          <a class="avatar avatar-md bg-primary text-fixed-white" style="width: 3rem; height: 3rem;" href="javascript:void(0);">
                                                              +6
                                                          </a>
                                                      </div>
                                                  </div>
                                                  <label class="form-label text-muted mt-3 fw-normal fs-12">* Minimum of 6 images are need to be uploaded,
                                                      all images should be uniformly maintained, width and height to the container.
                                                  </label>
                                              
                                                  <div class="col-xl-12 product-documents-container">
                                                      <p class="fw-medium mb-2 fs-14">Part Pdf Documents</p>
                                                      <div class="avatar-list-stacked">
                                                          <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                              <img src="{{ asset('assets/images/media/ongoing.png')}}"  alt="User"></span>
                                                          <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                              <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                          <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                              <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User"></span>
                                                          <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                              <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="User"></span>
                                                          <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                              <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                          <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                              <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User">
                                                          </span>  
                                                          <a class="avatar avatar-md bg-primary text-fixed-white" style="width: 3rem; height: 3rem;" href="javascript:void(0);">
                                                              +6
                                                          </a>
                                                      </div>
                                                  </div>
                                               
                                                
                                                 
                                              </div>
                                          </div>
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
                                                      <div id="product-feature2">High-quality packaging bag with side seal and custom cutting options.</div>
                                                  </div>
                                                       
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                         <div class="card custom-card shadow-none mb-0 border-0">
                                          
                                          <div class="card-body p-0"> 
                                                 <div class="row gy-3 bg-success-transparent">
                                                 <label for="batch-number" class="form-label text-primary2">Pasting Rolls Output</label>
                                                  <div class="col-xl-6">
                                                    <label for="roll-batch-1" class="form-label">Roll Batch No 1</label>
                                                    <input type="text" class="form-control" id="roll-batch-1" placeholder="Batch Number" value="PB06/26/2025/000123456">
                                                  </div>
                                                
                                                  <div class="col-xl-6">
                                                    <label for="machine-details-1" class="form-label">Machine Details*</label>
                                                    <input type="text" class="form-control" id="machine-details-1" placeholder="Machine ID" value="LAM8494">
                                                  </div>
                                                
                                                  <div class="col-xl-3">
                                                    <label for="gr-weight-1" class="form-label">Gr Wgt (Kgs)</label>
                                                    <input type="text" class="form-control" id="gr-weight-1" placeholder="Weight in Kgs" value="520.5">
                                                  </div>
                                                
                                                  <div class="col-xl-3">
                                                    <label for="cr-weight-1" class="form-label">Core Wgt (Kgs)</label>
                                                    <input type="text" class="form-control" id="cr-weight-1" placeholder="Weight in Kgs" value="15.2">
                                                  </div>
                                                
                                                  <div class="col-xl-3">
                                                    <label for="wastage-1" class="form-label">Wastage (Kgs)*</label>
                                                    <input type="text" class="form-control" id="wastage-1" placeholder="Weight in Kgs" value="6.3">
                                                  </div>
                                                
                                                  <div class="col-xl-3">
                                                    <label for="net-weight-1" class="form-label">Net Wgt (Kgs)*</label>
                                                    <input type="text" class="form-control" id="net-weight-1" placeholder="Weight in Kgs" value="499.0">
                                                  </div>
                                                
                                                   <!--  <hr> Section -->
                                                
                                                  <div class="col-xl-6">
                                                    <label for="roll-batch-2" class="form-label">Roll Batch No 2</label>
                                                    <input type="text" class="form-control" id="roll-batch-2" placeholder="Batch Number" value="PB06/26/2025/000123457">
                                                  </div>
                                                
                                                  <div class="col-xl-6">
                                                    <label for="machine-details-2" class="form-label">Machine Details*</label>
                                                    <input type="text" class="form-control" id="machine-details-2" placeholder="Machine ID" value="LAM8500">
                                                  </div>
                                                
                                                  <div class="col-xl-3">
                                                    <label for="gr-weight-2" class="form-label">Gr Wgt (Kgs)</label>
                                                    <input type="text" class="form-control" id="gr-weight-2" placeholder="Weight in Kgs" value="530.7">
                                                  </div>
                                                
                                                  <div class="col-xl-3">
                                                    <label for="cr-weight-2" class="form-label">Core Wgt (Kgs)</label>
                                                    <input type="text" class="form-control" id="cr-weight-2" placeholder="Weight in Kgs" value="16.5">
                                                  </div>
                                                
                                                  <div class="col-xl-3">
                                                    <label for="wastage-2" class="form-label">Wastage (Kgs)*</label>
                                                    <input type="text" class="form-control" id="wastage-2" placeholder="Weight in Kgs" value="7.0">
                                                  </div>
                                                
                                                  <div class="col-xl-3">
                                                    <label for="net-weight-2" class="form-label">Net Wgt (Kgs)*</label>
                                                    <input type="text" class="form-control" id="net-weight-2" placeholder="Weight in Kgs" value="507.2">
                                                  </div>
                                                
                                                   <!--  <hr> Section -->
                                                
                                                  <div class="col-xl-6">
                                                    <label for="roll-batch-3" class="form-label">Roll Batch No</label>
                                                    <input type="text" class="form-control" id="roll-batch-3" placeholder="Batch Number" value="PB06/26/2025/000123458">
                                                  </div>
                                                
                                                  <div class="col-xl-6">
                                                    <label for="machine-details-3" class="form-label">Machine Details*</label>
                                                    <input type="text" class="form-control" id="machine-details-3" placeholder="Machine ID" value="LAM8510">
                                                  </div>
                                                
                                                  <div class="col-xl-3">
                                                    <label for="gr-weight-3" class="form-label">Gross Weight (Kgs)</label>
                                                    <input type="text" class="form-control" id="gr-weight-3" placeholder="Weight in Kgs" value="540.0">
                                                  </div>
                                                
                                                  <div class="col-xl-3">
                                                    <label for="cr-weight-3" class="form-label">Core Weight (Kgs)</label>
                                                    <input type="text" class="form-control" id="cr-weight-3" placeholder="Weight in Kgs" value="18.0">
                                                  </div>
                                                
                                                  <div class="col-xl-3">
                                                    <label for="wastage-3" class="form-label">Wastage (Kgs)*</label>
                                                    <input type="text" class="form-control" id="wastage-3" placeholder="Weight in Kgs" value="8.5">
                                                  </div>
                                                
                                                  <div class="col-xl-3">
                                                    <label for="net-weight-3" class="form-label">Net Weight (Kgs)*</label>
                                                    <input type="text" class="form-control" id="net-weight-3" placeholder="Weight in Kgs" value="513.5">
                                                  </div>
                                                
                     
                                                   <button class="btn btn-primary">Add Roll</button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                    
          
                                 </div>
                                 
                                  <!--  <hr> Section --><div class="row">
                                     
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
     
    <!-- end pasting modal           -->


                                      
               
                            <!-- {start Slitting modal -->
                            <div class="modal fade" id="move-slitting" tabindex="-1" aria-labelledby="editDataModalLabel" style="display: none;" data-bs-keyboard="false" aria-hidden="true">
                              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h6 class="modal-title" id="editDataModalLabel">Add Slitting Output </h6>
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
                                                                                 <input type="text" class="form-control" id="product-name-add" placeholder="Name" value="HM Printed Bags 32x60"> 
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
                                                                                     <option value="HM Printed Bags 32x60s">HM Printed Bags 32x60s</option>
                                                                                     <option value="HM Printed Bags 32x60s" selected>HM Printed Bags 32x60s</option>
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
                                                                                 <input type="text" class="form-control" id="product-type" placeholder="Type" value="HM Printed Bags 32x60"> 
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
                                                                             <div class="card custom-card shadow-none mb-0 border-0">
                                                                  <div class="card-body p-0">
                                                                      <div class="row gy-3">
                                                                          <div class="col-xl-12">
                                                                              <label class="form-label">Part Description</label>
                                                                              <div id="product-features"></div>
                                                                          </div>
                                                                          <div class="col-xl-12 product-documents-container">
                                                                              <p class="fw-medium mb-2 fs-14">Part Images</p>
                                                                              <div class="avatar-list-stacked">
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}"  alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User">
                                                                                  </span>  
                                                                                  <a class="avatar avatar-md bg-primary text-fixed-white" style="width: 3rem; height: 3rem;" href="javascript:void(0);">
                                                                                      +6
                                                                                  </a>
                                                                              </div>
                                                                          </div>
                                                                          <label class="form-label text-muted mt-3 fw-normal fs-12">* Minimum of 6 images are need to be uploaded,
                                                                              all images should be uniformly maintained, width and height to the container.
                                                                          </label>
                                                                      
                                                                          <div class="col-xl-12 product-documents-container">
                                                                              <p class="fw-medium mb-2 fs-14">Part Pdf Documents</p>
                                                                              <div class="avatar-list-stacked">
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}"  alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User">
                                                                                  </span>  
                                                                                  <a class="avatar avatar-md bg-primary text-fixed-white" style="width: 3rem; height: 3rem;" href="javascript:void(0);">
                                                                                      +6
                                                                                  </a>
                                                                              </div>
                                                                          </div>
                                                                       
                                                                        
                                                                         
                                                                      </div>
                                                                  </div>
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
                                                                              <div id="product-feature2">High-quality packaging bag with side seal and custom cutting options.</div>
                                                                          </div>
                                                                               
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                                                 <div class="card custom-card shadow-none mb-0 border-0">
                                                                     <div class="card-body p-0">
                                                                         <div class="row gy-3 bg-success-transparent">
                                                                         <label for="batch-number" class="form-label text-primary2">SLITTING ROLLS OUTPUT</label>
                                                                                  
                                                                             <div class="col-xl-6">
                                                                               <label for="product-discount" class="form-label">Roll Batch no 1</label>
                                                                               <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="KP06/26/2025/000012574">
                                                                           </div>
                             
                                                                           <div class="col-xl-6">
                                                                             <label for="product-discount" class="form-label">Machine Details*</label>
                                                                             <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="PRINT8494">
                                                                         </div>
                             
                                                                           <div class="col-xl-3">
                                                                              <label for="product-discount" class="form-label">GR Weight </label>
                                                                             <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                                         </div>
                                                                         
                                                                         <div class="col-xl-3">
                                                                          <label for="product-discount" class="form-label">CR Weight </label>
                                                                           <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="12">
                                                                       </div>
                                                                       <div class="col-xl-3">
                                                                         <label for="product-discount" class="form-label">Wastage (Kgs)*</label>
                                                                         <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="5">
                                                                     </div>
                                                                     <div class="col-xl-3">
                                                                      <label for="product-discount" class="form-label">Net (Kgs)*</label>
                                                                      <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="490">
                                                                  </div>
                                                                           <!--  <hr> Section -->
                                                                  <div class="col-xl-6">
                                                                      <label for="product-discount" class="form-label">Roll Batch no 2</label>
                                                                      <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="KP06/26/2025/000012574">
                                                                  </div>
                          
                                                                  <div class="col-xl-6">
                                                                    <label for="product-discount" class="form-label">Machine Details*</label>
                                                                    <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="PRINT8494">
                                                                </div>
                          
                                                                  <div class="col-xl-3">
                                                                     <label for="product-discount" class="form-label">GR Weight </label>
                                                                    <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                                </div>
                                                                
                                                                <div class="col-xl-3">
                                                                 <label for="product-discount" class="form-label">CR Weight </label>
                                                                  <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="12">
                                                              </div>
                                                              <div class="col-xl-3">
                                                                <label for="product-discount" class="form-label">Wastage (Kgs)*</label>
                                                                <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="5">
                                                            </div>
                                                            <div class="col-xl-3">
                                                             <label for="product-discount" class="form-label">Net (Kgs)*</label>
                                                             <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="490">
                                                         </div>
                                                      
                                           
                                                           <!--  <hr> Section -->
                                                          <div class="col-xl-6">
                                                            <label for="product-discount" class="form-label">Roll Batch no</label>
                                                            <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="KP06/26/2025/000012574">
                                                        </div>
          
                                                        <div class="col-xl-6">
                                                          <label for="product-discount" class="form-label">Machine Details*</label>
                                                          <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="PRINT8494">
                                                      </div>
          
                                                        <div class="col-xl-3">
                                                           <label for="product-discount" class="form-label">GR Weight </label>
                                                          <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                      </div>
                                                      
                                                      <div class="col-xl-3">
                                                       <label for="product-discount" class="form-label">CR Weight </label>
                                                        <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="12">
                                                    </div>
                                                    <div class="col-xl-3">
                                                      <label for="product-discount" class="form-label">Wastage (Kgs)*</label>
                                                      <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="5">
                                                  </div>
                                                  <div class="col-xl-3">
                                                   <label for="product-discount" class="form-label">Net (Kgs)*</label>
                                                   <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="490">
                                               </div>
                                                        <!--  <hr> Section -->
                                               <div class="col-xl-6">
                                                   <label for="product-discount" class="form-label">Roll Batch no</label>
                                                   <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="KP06/26/2025/000012574">
                                               </div>
       
                                               <div class="col-xl-6">
                                                 <label for="product-discount" class="form-label">Machine Details*</label>
                                                 <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="PRINT8494">
                                             </div>
       
                                               <div class="col-xl-3">
                                                  <label for="product-discount" class="form-label">GR Weight </label>
                                                 <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                             </div>
                                             
                                             <div class="col-xl-3">
                                              <label for="product-discount" class="form-label">CR Weight </label>
                                               <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="12">
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
                             
                            <!-- end Slitting modal           -->
                
                
                
               
                            <!-- {start cutting modal -->
             <div class="modal fade" id="move-cutting" tabindex="-1" aria-labelledby="editDataModalLabel" style="display: none;" data-bs-keyboard="false" aria-hidden="true">
              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h6 class="modal-title" id="editDataModalLabel">Add cutting Output </h6>
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
                                                                 <input type="text" class="form-control" id="product-name-add" placeholder="Name" value="HM Printed Bags 32x60"> 
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
                                                                     <option value="HM Printed Bags 32x60s">HM Printed Bags 32x60s</option>
                                                                     <option value="HM Printed Bags 32x60s" selected>HM Printed Bags 32x60s</option>
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
                                                                 <input type="text" class="form-control" id="product-type" placeholder="Type" value="HM Printed Bags 32x60"> 
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
                                                             <div class="card custom-card shadow-none mb-0 border-0">
                                                  <div class="card-body p-0">
                                                      <div class="row gy-3">
                                                          <div class="col-xl-12">
                                                              <label class="form-label">Part Description</label>
                                                              <div id="product-features"></div>
                                                          </div>
                                                          <div class="col-xl-12 product-documents-container">
                                                              <p class="fw-medium mb-2 fs-14">Part Images</p>
                                                              <div class="avatar-list-stacked">
                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}"  alt="User"></span>
                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User"></span>
                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="User"></span>
                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User">
                                                                  </span>  
                                                                  <a class="avatar avatar-md bg-primary text-fixed-white" style="width: 3rem; height: 3rem;" href="javascript:void(0);">
                                                                      +6
                                                                  </a>
                                                              </div>
                                                          </div>
                                                          <label class="form-label text-muted mt-3 fw-normal fs-12">* Minimum of 6 images are need to be uploaded,
                                                              all images should be uniformly maintained, width and height to the container.
                                                          </label>
                                                      
                                                          <div class="col-xl-12 product-documents-container">
                                                              <p class="fw-medium mb-2 fs-14">Part Pdf Documents</p>
                                                              <div class="avatar-list-stacked">
                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}"  alt="User"></span>
                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User"></span>
                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="User"></span>
                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User">
                                                                  </span>  
                                                                  <a class="avatar avatar-md bg-primary text-fixed-white" style="width: 3rem; height: 3rem;" href="javascript:void(0);">
                                                                      +6
                                                                  </a>
                                                              </div>
                                                          </div>
                                                       
                                                        
                                                         
                                                      </div>
                                                  </div>
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
                                                              <div id="product-feature2">High-quality packaging bag with side seal and custom cutting options.</div>
                                                          </div>
                                                               
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                             <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                                 <div class="card custom-card shadow-none mb-0 border-0">
                                                     <div class="card-body p-0">
                                                         <div class="row gy-3 bg-success-transparent">
                                                         <label for="batch-number" class="form-label text-primary2">Cutting Bags Rolls Output</label>
                                                                  
                                                             <div class="col-xl-6">
                                                               <label for="product-discount" class="form-label">Roll Batch no</label>
                                                               <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="KP06/26/2025/000012574">
                                                           </div>
             
                                                           <div class="col-xl-6">
                                                             <label for="product-discount" class="form-label">Machine Details*</label>
                                                             <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="PRINT8494">
                                                         </div>
             
                                                           <div class="col-xl-3">
                                                              <label for="product-discount" class="form-label">GR Weight </label>
                                                             <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                         </div>
                                                         
                                                         <div class="col-xl-3">
                                                          <label for="product-discount" class="form-label">CR Weight </label>
                                                           <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="12">
                                                       </div>
                                                       <div class="col-xl-3">
                                                         <label for="product-discount" class="form-label">Wastage (Kgs)*</label>
                                                         <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="5">
                                                     </div>
                                                     <div class="col-xl-3">
                                                      <label for="product-discount" class="form-label">Net (Kgs)*</label>
                                                      <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="490">
                                                  </div>
                                                           <!--  <hr> Section -->
                                                  <div class="col-xl-6">
                                                      <label for="product-discount" class="form-label">Roll Batch no</label>
                                                      <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="KP06/26/2025/000012574">
                                                  </div>
          
                                                  <div class="col-xl-6">
                                                    <label for="product-discount" class="form-label">Machine Details*</label>
                                                    <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="PRINT8494">
                                                </div>
          
                                                  <div class="col-xl-3">
                                                     <label for="product-discount" class="form-label">GR Weight </label>
                                                    <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                </div>
                                                
                                                <div class="col-xl-3">
                                                 <label for="product-discount" class="form-label">CR Weight </label>
                                                  <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="12">
                                              </div>
                                              <div class="col-xl-3">
                                                <label for="product-discount" class="form-label">Wastage (Kgs)*</label>
                                                <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="5">
                                            </div>
                                            <div class="col-xl-3">
                                             <label for="product-discount" class="form-label">Net (Kgs)*</label>
                                             <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="490">
                                         </div>
                                      
                           
                                           <!--  <hr> Section -->
                                          <label for="batch-number" class="form-label text-primary2">Cutting Bags Qty Output</label>
                                          <!-- Batch Information -->
                                          <div class="col-xl-6">
                                              <label for="batch-number" class="form-label">Batch Number</label>
                                              <input type="text" class="form-control" id="batch-number" placeholder="Enter batch number" value="PB06/26/2025/000012574">
                                          </div>
                                          
                                          <div class="col-xl-6">
                                              <label for="machine-details" class="form-label">Machine Details*</label>
                                              <input type="text" class="form-control" id="machine-details" placeholder="Enter machine details" value="CUT8494">
                                          </div>
                          
                                          <!-- Output Quantities -->
                                          <div class="col-xl-4">
                                              <label for="total-quantity" class="form-label">Total Qty (Nos)</label>
                                              <input type="text" class="form-control" id="total-quantity" placeholder="Enter total quantity" value="2000">
                                          </div>
                          
                                          <div class="col-xl-4">
                                              <label for="quantity-per-bundle" class="form-label">Qty Per Bundle (Nos)*</label>
                                              <input type="text" class="form-control" id="quantity-per-bundle" placeholder="Enter quantity per bundle" value="100">
                                          </div>
                          
                                          <div class="col-xl-4">
                                              <label for="number-of-bundles" class="form-label">Number of Bundles</label>
                                              <input type="text" class="form-control" id="number-of-bundles" placeholder="Enter number of bundles" value="20">
                                          </div>
                          
                                         
                             
                                                           <button class="btn btn-primary">Add Roll</button>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                            
                  
                                         </div>
                                         
                                          <!--  <hr> Section --><div class="row">
                                             
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
             
            <!-- end cutting modal           -->



                 
               
               
                            <!-- {start finish modal -->
                            <div class="modal fade" id="move-finish" tabindex="-1" aria-labelledby="editDataModalLabel" style="display: none;" data-bs-keyboard="false" aria-hidden="true">
                              <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h6 class="modal-title" id="editDataModalLabel">Move Finished Job Stock Store </h6>
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
                                                             <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-6">
                                                                 <div class="card custom-card shadow-none mb-0 border-0">
                                                                     <div class="card-body p-0">
                                                                     <div class="row gy-3 bg-warning-transparent">
                                                                             <div class="col-xl-6">
                                                                                 <label for="product-name-add" class="form-label">Part Name</label>
                                                                                 <input type="text" class="form-control" id="product-name-add" placeholder="Name" value="HM Printed Bags 32x60"> 
                                                                             </div>
                                                                             <div class="col-xl-3">
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
                                                                            
                                                                             <div class="col-xl-3">
                                                                                 <label for="product-type" class="form-label">Part Type</label>
                                                                                 <input type="text" class="form-control" id="product-type" placeholder="Type" value="Bio Digrade Bag"> 
                                                                             </div>
                                                                             <div class="col-xl-2">
                                                                                 <label for="product-hsn-add" class="form-label">HSN No</label>
                                                                                 <input type="text" class="form-control" id="product-hsn-add" placeholder="Name" value="3923">
                                                                             </div>
                                                                             <div class="col-xl-2">
                                                                                 <label for="product-thickness-add" class="form-label">Reel Size</label>
                                                                                 <input type="text" class="form-control" id="product-thickness-add" placeholder="Reel Size" value="60x80 cm">
                                                                             </div>
                                                                             <div class="col-xl-3">
                                                                                 <label for="product-size-add" class="form-label">L X W X H</label>
                                                                                 <input type="text" class="form-control" id="product-size-add" placeholder="Length" value="50 cm X 40 cm X 30 cm">
                                                                             </div>
                                                                            
                                                                                 
                                                                             <div class="col-xl-2">
                                                                              <label for="product-discount" class="form-label"> Weight</label>
                                                                              <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                                          </div>
                                                                          <div class="col-xl-3">
                                                                              <label for="product-gender-add" class="form-label">Sealing Type</label>
                                                                              <select class="form-control" data-trigger name="product-gender-add" id="product-gender-add">
                                                                                  <option value="">Select</option>
                                                                                  <option value="Side Seal" selected>Side Seal</option>
                                                                                  <option value="Bottom Seal">Bottom Seal</option>
                                                                                  <option value="Center Seal">Center Seal</option>
                                                                              </select>
                                                                          </div>
                                                                             <div class="card custom-card shadow-none mb-0 border-0">
                                                                  <div class="card-body p-0">
                                                                      <div class="row gy-3">
                                                                          

                                                                          <div class="col-xl-6 product-documents-container">
                                                                              <p class="fw-medium mb-2 fs-14">Part Images</p>
                                                                              <div class="avatar-list-stacked">
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}"  alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User">
                                                                                  </span>  
                                                                                  <a class="avatar avatar-md bg-primary text-fixed-white" style="width: 3rem; height: 3rem;" href="javascript:void(0);">
                                                                                      +6
                                                                                  </a>
                                                                              </div>
                                                                          </div>
                                                                         
                                                                      
                                                                          <div class="col-xl-6 product-documents-container">
                                                                              <p class="fw-medium mb-2 fs-14">Part Pdf Documents</p>
                                                                              <div class="avatar-list-stacked">
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}"  alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/ongoing.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/pending.png')}}" alt="User"></span>
                                                                                  <span class="avatar avatar-md " style="width: 3rem; height: 3rem;">
                                                                                      <img src="{{ asset('assets/images/media/urgent.png')}}" alt="User">
                                                                                  </span>  
                                                                                  <a class="avatar avatar-md bg-primary text-fixed-white" style="width: 3rem; height: 3rem;" href="javascript:void(0);">
                                                                                      +6
                                                                                  </a>
                                                                              </div>
                                                                          </div>
                                                                          <label class="form-label text-muted mt-3 fw-normal fs-12">* Minimum of 6 images are need to be uploaded,
                                                                            all images should be uniformly maintained, width and height to the container.
                                                                        </label>
                                                                        
                                                                         
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                                            
                                                                           
                                                                        
                                                                             
                                                                           
                                                                               
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-6">
                                                                 <div class="card custom-card shadow-none mb-0 border-0">
                                                                  <div class="card-header justify-content-between">
                                                                    <div class="card-title">
                                                                        All Jobs Item List
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
                                                    <input class="form-check-input check-all" type="checkbox" id="all-tasks" value="" aria-label="...">
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
                                                                                 <td>#P34009</td>
                                                                                 <td>11:00 AM</td>
                                                                                 <td>50 kg</td>
                                                                                 <td>5 kg</td>
                                                                                 <td>Machine A</td>
                                                                                 <td>Karthik Kumar</td>
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
                                                                                 <td>#P34012</td>
                                                                                 <td>12:45 PM</td>
                                                                                 <td>56.98 kg</td>
                                                                                 <td>2.56 kg</td>
                                                                                 <td>Machine E</td>
                                                                                 <td>Vikram Raj</td>
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
                                                             </div>
                                                            
                                  
                                                         </div>
                                                         
                                                          <!--  <hr> Section --><div class="row">
                                                             
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
                             
                            <!-- end finish modal           -->
                           @endsection