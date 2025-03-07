@extends('layouts.app')

@section('content')



     <!-- Page Header -->
     <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
        <div>
            <nav>
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Overall Branchs</li>
                </ol>
            </nav>
            <h1 class="page-title fw-medium fs-18 mb-0">Branchs / Warehouse</h1>
        </div>
        <div class="btn-list">
            <button type="button" class="modal-effect btn btn-white btn-wave" data-bs-effect="effect-slide-in-right" data-bs-toggle="modal"
            data-bs-target="#addDataModal">
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

    


    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Branchs <span class="badge bg-primary text-default rounded ms-2 fs-12 align-middle text-fixed-white">50</span>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-primary btn-sm btn-wave" data-bs-toggle="modal" data-bs-target="#create-material"><i class="ri-add-line me-1 fw-medium align-middle"></i>Add new</button>
                        <button class="btn btn-success-light btn-sm btn-wave">Export As CSV</button>
                        <div class="dropdown">
                            <a href="javascript:void(0);" class="btn btn-light btn-sm btn-wave" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort By<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a class="dropdown-item" href="javascript:void(0);">Newest</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">Date Added</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);">A - Z</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                  
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input class="form-check-input check-all" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
                                    </th>
                                    <th scope="col">Branch Name</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Warehouse Capacity</th>
                                    <th scope="col">Storage Space</th>
                                    <th scope="col">No. of Rolls</th>
                                    <th scope="col">No. of Bundles</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="crm-contact companies-list">
                                    <td class="companies-checkbox">
                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lh-1">
                                                <span class="avatar avatar-sm p-1 bg-light avatar-rounded">
                                                    <img src="{{ asset('assets/images/media/branch.jpg')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Goa Branch</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span  class="d-block">Goa</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">5000 Sq Ft</span>
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
                                    <td>
                                        <div>
                                            <span class="badge bg-primary1-transparent">120 Rolls</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary1-transparent">50 Bundles</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary-transparent">14-02-2025</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="btn btn-sm btn-primary-light btn-icon"><i class="ri-eye-line"></i></a>
                                            <button class="btn btn-sm btn-info-light btn-icon"><i class="ri-pencil-line"></i></button>
                                            <button class="btn btn-sm btn-primary2-light btn-icon contact-delete"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            
                                <tr class="crm-contact companies-list">
                                    <td class="companies-checkbox">
                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel2" value="" aria-label="...">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lh-1">
                                                <span class="avatar avatar-sm p-1 bg-light avatar-rounded">
                                                    <img src="{{ asset('assets/images/media/branch.jpg')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Mao Branch</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Mao</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">8000 Sq Ft</span>
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
                                    <td>
                                        <div>
                                            <span class="badge bg-primary1-transparent">300 Rolls</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary1-transparent">200 Bundles</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary-transparent">14-02-2025</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="btn btn-sm btn-primary-light btn-icon"><i class="ri-eye-line"></i></a>
                                            <button class="btn btn-sm btn-info-light btn-icon"><i class="ri-pencil-line"></i></button>
                                            <button class="btn btn-sm btn-primary2-light btn-icon contact-delete"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            
                                <tr class="crm-contact companies-list">
                                    <td class="companies-checkbox">
                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel3" value="" aria-label="...">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lh-1">
                                                <span class="avatar avatar-sm p-1 bg-light avatar-rounded">
                                                    <img src="{{ asset('assets/images/media/m1.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Baingini Branch</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Baingini</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">6000 Sq Ft</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-primary" style="width: 75%"></div>
                                            </div>
                                            <div class="mt-1"><span class="text-primary fw-medium">75%</span> Completed</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary1-transparent">200 Rolls</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary1-transparent">120 Bundles</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary-transparent">14-02-2025</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="btn btn-sm btn-primary-light btn-icon"><i class="ri-eye-line"></i></a>
                                            <button class="btn btn-sm btn-info-light btn-icon"><i class="ri-pencil-line"></i></button>
                                            <button class="btn btn-sm btn-primary2-light btn-icon contact-delete"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            
                                <tr class="crm-contact companies-list">
                                    <td class="companies-checkbox">
                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lh-1">
                                                <span class="avatar avatar-sm p-1 bg-light avatar-rounded">
                                                    <img src="{{ asset('assets/images/media/branch.jpg')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Goa Branch</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Goa</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">5000 Sq Ft</span>
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
                                    <td>
                                        <div>
                                            <span class="badge bg-primary1-transparent">120 Rolls</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary1-transparent">50 Bundles</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary-transparent">14-02-2025</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="btn btn-sm btn-primary-light btn-icon"><i class="ri-eye-line"></i></a>
                                            <button class="btn btn-sm btn-info-light btn-icon"><i class="ri-pencil-line"></i></button>
                                            <button class="btn btn-sm btn-primary2-light btn-icon contact-delete"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            
                                <tr class="crm-contact companies-list">
                                    <td class="companies-checkbox">
                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel2" value="" aria-label="...">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lh-1">
                                                <span class="avatar avatar-sm p-1 bg-light avatar-rounded">
                                                    <img src="{{ asset('assets/images/media/branch.jpg')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Mao Branch</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Mao</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">8000 Sq Ft</span>
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
                                    <td>
                                        <div>
                                            <span class="badge bg-primary1-transparent">300 Rolls</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary1-transparent">200 Bundles</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary-transparent">14-02-2025</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="btn btn-sm btn-primary-light btn-icon"><i class="ri-eye-line"></i></a>
                                            <button class="btn btn-sm btn-info-light btn-icon"><i class="ri-pencil-line"></i></button>
                                            <button class="btn btn-sm btn-primary2-light btn-icon contact-delete"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            
                                <tr class="crm-contact companies-list">
                                    <td class="companies-checkbox">
                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel3" value="" aria-label="...">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lh-1">
                                                <span class="avatar avatar-sm p-1 bg-light avatar-rounded">
                                                    <img src="{{ asset('assets/images/media/m1.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Baingini Branch</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Baingini</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">6000 Sq Ft</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="progress progress-xs progress-animate" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar bg-primary" style="width: 75%"></div>
                                            </div>
                                            <div class="mt-1"><span class="text-primary fw-medium">75%</span> Completed</div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary1-transparent">200 Rolls</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary1-transparent">120 Bundles</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge bg-primary-transparent">14-02-2025</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-list">
                                            <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample" class="btn btn-sm btn-primary-light btn-icon"><i class="ri-eye-line"></i></a>
                                            <button class="btn btn-sm btn-info-light btn-icon"><i class="ri-pencil-line"></i></button>
                                            <button class="btn btn-sm btn-primary2-light btn-icon contact-delete"><i class="ri-delete-bin-line"></i></button>
                                        </div>
                                    </td>
                                </tr>                                                     
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer border-top-0">
                    <div class="d-flex align-items-center">
                        <div>
                            Showing 9 Entries <i class="bi bi-arrow-right ms-2 fw-medium"></i>
                        </div>
                        <div class="ms-auto">
                            <nav aria-label="Page navigation" class="pagination-style-4">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="javascript:void(0);">
                                            Prev
                                        </a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                    <li class="page-item">
                                        <a class="page-link text-primary" href="javascript:void(0);">
                                            next
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->

    <!-- Start:: Company Details Offcanvas -->
   
<!-- Start:: Branch Details Offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExample">
    <div class="offcanvas-body p-0">
        <!-- Profile Header -->
        <div class="d-sm-flex align-items-top p-3 border-bottom border-block-end-dashed main-profile-cover">
            <span class="avatar avatar-xxl avatar-rounded me-3 p-2 bg-primary-transparent">
                <img src="{{ asset('assets/images/media/branch.jpg')}}" alt="Mao Branch Logo">
            </span>
            <div class="flex-fill main-profile-info">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-medium mb-1">Mao Branch</h6>
                    <button type="button" class="btn-close crm-contact-close-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <p class="mb-2 text-muted fs-12">Warehouse Manager: Rajesh Kumar</p>
                <div class="d-flex gap-2 fs-15 mt-1">
                    <a href="javascript:void(0);" class="btn btn-icon btn-sm rounded-pill btn-primary1-light"><i class="ri-phone-line"></i></a>
                    <a href="javascript:void(0);" class="btn btn-icon btn-sm rounded-pill btn-primary2-light"><i class="ri-mail-line"></i></a>
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="d-flex mt-3 gap-3 p-1 py-0 border-bottom border-block-end-dashed">
            <div class="p-2 text-center flex-fill">
                <i class="ri-stack-line p-2 fs-5 rounded-circle lh-1 text-fixed-white shadow-sm bg-primary"></i>
                <p class="fw-semibold fs-20 text-shadow mb-0 mt-2">8000 Sq Ft</p>
                <p class="mb-0 text-muted">Storage Space</p>
            </div>
            <div class="p-2 text-center flex-fill">
                <i class="ri-inbox-archive-line p-2 fs-5 rounded-circle lh-1 text-fixed-white shadow-sm bg-primary"></i>
                <p class="fw-semibold fs-20 text-shadow mb-0 mt-2">300 Rolls</p>
                <p class="mb-0 text-muted">Available Rolls</p>
            </div>
            <div class="p-2 text-center flex-fill">
                <i class="ri-archive-line p-2 fs-5 rounded-circle lh-1 text-fixed-white shadow-sm bg-primary"></i>
                <p class="fw-semibold fs-20 text-shadow mb-0 mt-2">200 Bundles</p>
                <p class="mb-0 text-muted">Available Bundles</p>
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="p-3 border-bottom border-block-end-dashed">
            <p class="fs-15 mb-2 fw-medium">Recent Activities:</p>
            <ul class="list-unstyled">
                <li class="mb-2">
                    <p class="mb-1 text-muted"><b>Dispatch:</b> 50 Rolls to Client ABC</p>
                    <p class="mb-0 text-muted"><b>Date:</b> 10-December-2025</p>
                </li>
                <li class="mb-2">
                    <p class="mb-1 text-muted"><b>Restock:</b> Added 100 Bundles</p>
                    <p class="mb-0 text-muted"><b>Date:</b> 05-December-2025</p>
                </li>
            </ul>
        </div>

        <!-- Tags and Priority -->
        <div class="p-3 d-flex align-items-center flex-wrap gap-4">
            <p class="fs-14 mb-0 fw-medium">Priority:</p>
            <div class="badge bg-success-transparent"><i class="ri-circle-fill lh-1 align-middle fs-9 me-1"></i> High Priority</div>
        </div>
        <div class="p-3 border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4">
            <p class="fs-14 mb-0 fw-medium">Tags :</p>
            <div>
                <span class="badge bg-primary-transparent">Stock Update</span>
                <span class="badge bg-secondary-transparent">New Dispatch</span>
                <span class="badge bg-warning-transparent">Capacity Alert</span>
            </div>
        </div>
    </div>
</div>
        <!-- Footer Buttons -->
        <div class="p-3 text-center">
            <div class="d-flex align-items-center gap-2">
                <a href="javascript:void(0);" class="btn btn-primary btn-sm">Update Details</a>
                <a href="javascript:void(0);" class="btn btn-light btn-sm">Close</a>
            </div>
        </div>
    </div>
</div>

<!-- End:: Company Details Offcanvas -->

    <!-- End:: Company Details Offcanvas -->
<!-- Start:: Add Raw Material -->
<div class="modal fade" id="create-material" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Add Machine</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-3">
                    <div class="col-xl-12">
                        <div class="mb-0 text-center">
                            <span class="avatar avatar-xxl avatar-rounded p-2 bg-light">
                                <img src="{{ asset('assets/images/media/machine.jpg') }}" alt="" id="profile-img">
                                <span class="badge rounded-pill bg-primary avatar-badge">
                                    <input type="file" name="photo" class="position-absolute w-100 h-100 op-0" id="profile-change">
                                    <i class="fe fe-camera"></i>
                                </span>
                            </span>
                        </div>
                    </div>
                     <!-- Item Code -->
                     <div class="col-md-12 col-lg-12">
                        <label for="item-code" class="form-label">Machine Name </label>
                        <input type="text" class="form-control" id="item-code" placeholder="Enter Machine Name" required>
                    </div>

                    <!-- Grade -->
                    <div class="col-md-12 col-lg-12">
                        <label for="grade" class="form-label">Branch Name </label>
                        <input type="text" class="form-control" id="grade" placeholder="Enter Branch Name" required>
                    </div>

                 

                    <!-- Additional Fields (as required) -->
                    <div class="col-md-12 col-lg-12">
                        <label for="item-category" class="form-label">Machine Type</label>
                        <select class="form-control" id="item-category">
                            <option value="Extrusion">Extrusion</option>
                            <option value="Cutting">Cutting</option>
                            <option value="Printing">Printing</option>
                            <option value="Slitting">Slitting</option>
                            <option value="Bundling">Bundling</option>
                            <option value="Bundling">Other</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- End:: Add Company -->


    @endsection 