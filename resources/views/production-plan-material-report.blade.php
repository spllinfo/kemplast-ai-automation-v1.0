@extends('layouts.app')

@section('content')



     <!-- Page Header -->
     <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
        <div>
            <nav>
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Plan Material Report </li>
                </ol>
            </nav>
            <h1 class="page-title fw-medium fs-18 mb-0">Plan Raw Material Material Report</h1>
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
                       Plan Raw Materials  <span class="badge bg-primary text-default rounded ms-2 fs-12 align-middle text-fixed-white">264</span>
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
                <div class="card-body p-0">ẏ
                  
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input class="form-check-input check-all" type="checkbox" id="checkboxNoLabel" value="" aria-label="...">
                                    </th>
                                    <th scope="col">Material Name</th>
    <th scope="col">Type</th>
    <th scope="col">Price</th>
    <th scope="col">Supplier</th>
    <th scope="col">Order Date</th>
    <th scope="col">R.W. Need</th>
    <th scope="col">Instock</th>
    <th scope="col">Used</th>
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
                                                    <img src="{{ asset('assets/images/media/m1.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Polyethylene (PE) Resin</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block mb-1">Raw Material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">₹150/kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Alpha Plastics Inc.</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary-transparent"><i class="bi bi-clock me-1"></i>Feb 12 2025</span></td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-danger-transparent">32,146 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary-transparent">50,000 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary1-transparent">20,000 kg</span>
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
                                                    <img src="{{ asset('assets/images/media/m2.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Polypropylene (PP) Granules</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block mb-1">Raw Material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">₹175/kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Beta Plastics Ltd.</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger-transparent"><i class="bi bi-clock me-1"></i>Oct 15 2025</span></td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-danger-transparent">62,146 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary-transparent">100,000 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary1-transparent">40,000 kg</span>
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
                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel5" value="" aria-label="...">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lh-1">
                                                <span class="avatar avatar-sm p-1 bg-light avatar-rounded">
                                                    <img src="{{ asset('assets/images/media/m1.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">HDPE Plastic Rolls</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block mb-1">Raw Material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">₹120/kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Reliance Polymers Pvt. Ltd.</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary-transparent"><i class="bi bi-clock me-1"></i>May 15 2025</span></td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-danger-transparent">49,146 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary-transparent">80,000 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary1-transparent">35,000 kg</span>
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
                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel6" value="" aria-label="...">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lh-1">
                                                <span class="avatar avatar-sm p-1 bg-light avatar-rounded">
                                                    <img src="{{ asset('assets/images/media/m2.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Polyethylene Granules</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block mb-1">Raw Material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">₹105/kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Plastic Pro Suppliers</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary-transparent"><i class="bi bi-clock me-1"></i>Feb 12 2025</span></td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-danger-transparent">28,147 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary-transparent">50,000 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary1-transparent">20,000 kg</span>
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
                                                    <img src="{{ asset('assets/images/media/m1.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Polyethylene (PE) Resin</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block mb-1">Raw Material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">₹150/kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Alpha Plastics Inc.</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary-transparent"><i class="bi bi-clock me-1"></i>Feb 12 2025</span></td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-danger-transparent">26,146 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary-transparent">50,000 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary1-transparent">20,000 kg</span>
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
                                                    <img src="{{ asset('assets/images/media/m2.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Polypropylene (PP) Granules</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block mb-1">Raw Material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">₹175/kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Beta Plastics Ltd.</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger-transparent"><i class="bi bi-clock me-1"></i>Oct 15 2025</span></td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-danger-transparent">52,146 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary-transparent">100,000 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary1-transparent">40,000 kg</span>
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
                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel5" value="" aria-label="...">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lh-1">
                                                <span class="avatar avatar-sm p-1 bg-light avatar-rounded">
                                                    <img src="{{ asset('assets/images/media/m1.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">HDPE Plastic Rolls</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block mb-1">Raw Material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">₹120/kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Reliance Polymers Pvt. Ltd.</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary-transparent"><i class="bi bi-clock me-1"></i>May 15 2025</span></td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-danger-transparent">52,146 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary-transparent">80,000 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary1-transparent">35,000 kg</span>
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
                                                    <img src="{{ asset('assets/images/media/m1.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Polyethylene (PE) Resin</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block mb-1">Raw Material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">₹150/kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Alpha Plastics Inc.</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary-transparent"><i class="bi bi-clock me-1"></i>Feb 12 2025</span></td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-danger-transparent">28,146 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary-transparent">50,000 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary1-transparent">20,000 kg</span>
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
                                                    <img src="{{ asset('assets/images/media/m2.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Polypropylene (PP) Granules</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block mb-1">Raw Material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">₹175/kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Beta Plastics Ltd.</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger-transparent"><i class="bi bi-clock me-1"></i>Oct 15 2025</span></td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-danger-transparent">67,146 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary-transparent">100,000 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary1-transparent">40,000 kg</span>
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
                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel5" value="" aria-label="...">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lh-1">
                                                <span class="avatar avatar-sm p-1 bg-light avatar-rounded">
                                                    <img src="{{ asset('assets/images/media/m1.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">HDPE Plastic Rolls</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block mb-1">Raw Material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">₹120/kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Reliance Polymers Pvt. Ltd.</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary-transparent"><i class="bi bi-clock me-1"></i>May 15 2025</span></td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-danger-transparent">52,985 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary-transparent">80,000 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary1-transparent">35,000 kg</span>
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
                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel6" value="" aria-label="...">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lh-1">
                                                <span class="avatar avatar-sm p-1 bg-light avatar-rounded">
                                                    <img src="{{ asset('assets/images/media/m2.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Polyethylene Granules</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block mb-1">Raw Material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">₹105/kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Plastic Pro Suppliers</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary-transparent"><i class="bi bi-clock me-1"></i>Feb 12 2025</span></td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-danger-transparent">32,146 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary-transparent">50,000 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary1-transparent">20,000 kg</span>
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
                                        <input class="form-check-input" type="checkbox" id="checkboxNoLabel6" value="" aria-label="...">
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lh-1">
                                                <span class="avatar avatar-sm p-1 bg-light avatar-rounded">
                                                    <img src="{{ asset('assets/images/media/m2.png')}}" alt="">
                                                </span>
                                            </div>
                                            <div>
                                                <a data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Polyethylene Granules</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block mb-1">Raw Material</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">₹105/kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="d-block">Plastic Pro Suppliers</span>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-primary-transparent"><i class="bi bi-clock me-1"></i>Feb 12 2025</span></td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-danger-transparent">32,146 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary-transparent">50,000 kg</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center flex-wrap gap-1">
                                            <span class="badge bg-primary1-transparent">20,000 kg</span>
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
   <!-- Start:: Company Details Offcanvas -->
   <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExample">
    <div class="offcanvas-body p-0">
        <!-- Profile Header -->
        <div class="d-sm-flex align-items-top p-3 border-bottom border-block-end-dashed main-profile-cover">
            <span class="avatar avatar-xxl avatar-rounded me-3 p-2 bg-primary-transparent">
                <img src="{{ asset('assets/images/company-logos/1.png')}}" alt="TVS Motors Logo">
            </span>
            <div class="flex-fill main-profile-info">
                <div class="d-flex align-items-center justify-content-between">
                    <h6 class="fw-medium mb-1">Raja Desing</h6>
                    <span class="badge bg-success-transparent fs-10"><i class="ri-circle-fill fs-8 text-success me-1"></i> New Order</span>
                    <button type="button" class="btn-close crm-contact-close-btn" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <p class="mb-2 text-muted fs-12">Founder & Managing Director</p>
                <div class="d-flex gap-2 fs-15 mt-1">
                    <a href="javascript:void(0);" class="btn btn-icon btn-sm rounded-pill btn-primary1-light"><i class="ri-phone-line"></i></a>
                    <a href="javascript:void(0);" class="btn btn-icon btn-sm rounded-pill btn-primary2-light"><i class="ri-mail-line"></i></a>
                    <a href="javascript:void(0);" class="btn btn-icon btn-sm rounded-pill btn-primary3-light"><i class="ri-message-line"></i></a>
                    <div class="dropdown">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-icon btn-sm rounded-pill btn-secondary-light"><i class="ri-more-fill"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);">Size</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Deals</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Status</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="d-flex mt-3 gap-3 p-1 py-0 border-bottom border-block-end-dashed">
            <div class="p-2 text-center flex-fill">
                <i class="ri-shake-hands-line p-2 fs-5 rounded-circle lh-1 text-fixed-white shadow-sm bg-primary"></i>
                <p class="fw-semibold fs-20 text-shadow mb-0 mt-2">455 Tons</p>
                <p class="mb-0 text-muted">Orders</p>
            </div>
            <div class="p-2 text-center flex-fill">
                <i class="ri-money-dollar-circle-line p-2 fs-5 rounded-circle lh-1 text-fixed-white shadow-sm bg-primary"></i>
                <p class="fw-semibold fs-20 text-shadow mb-0 mt-2">₹99467K</p>
                <p class="mb-0 text-muted">Billings</p>
            </div>
            <div class="p-2 text-center flex-fill">
                <i class="ri-thumb-up-line p-2 fs-5 rounded-circle lh-1 text-fixed-white shadow-sm bg-primary"></i>
                <p class="fw-semibold fs-20 text-shadow mb-0 mt-2">252  Tons</p>
                <p class="mb-0 text-muted">Deliverd</p>
            </div>
        </div>

        <!-- Raw Material and Supplier Details -->
        <div class="p-3 border-bottom border-block-end-dashed">
            <p class="fs-15 mb-2 fw-medium">Raw Material Details:</p>
            <div class="mb-2">
                <p class="mb-1 text-muted"><b>Material:</b> High-Grade HDPE</p>
                <p class="mb-1 text-muted"><b>Quantity Available:</b> 10 Tons</p>
                <p class="mb-0 text-muted"><b>Last Purchased:</b> 25-Febember-2025</p>
            </div>
        </div>
        <div class="p-3 border-bottom border-block-end-dashed">
            <p class="fs-15 mb-2 fw-medium">Supplier Information:</p>
            <div class="mb-2">
                <p class="mb-1 text-muted"><b>Name:</b> ABC HDPE Suppliers</p>
                <p class="mb-1 text-muted"><b>Contact:</b> +(91) 987-123-4567</p>
                <p class="mb-0 text-muted"><b>Address:</b> 123, Supplier Lane, Mumbai, Maharashtra</p>
            </div>
            <div class="d-flex align-items-center gap-2 mt-2">
                <a href="javascript:void(0);" class="btn btn-sm btn-primary">Contact Supplier</a>
                <a href="javascript:void(0);" class="btn btn-sm btn-light">View All Suppliers</a>
            </div>
        </div>

        <!-- Priority, Tags, Social Links -->
        <div class="p-3 d-flex align-items-center flex-wrap gap-4">
            <p class="fs-14 mb-0 fw-medium">Priority:</p>
            <div class="badge bg-success-transparent"><i class="ri-circle-fill lh-1 align-middle fs-9 me-1"></i> High Priority</div>
        </div>
        <div class="p-3 border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4">
            <p class="fs-14 mb-0 fw-medium">Tags :</p>
            <div>
                <span class="badge bg-primary-transparent">New Order</span>
                <span class="badge bg-secondary-transparent">Follow Up</span>
                <span class="badge bg-danger-transparent">Raw Material Shortage</span>
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
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLgLabel">Add Raw Material</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gy-3">
                    <!-- Item Code -->
                    <div class="col-md-6 col-lg-4">
                        <label for="item-code" class="form-label">Item Code </label>
                        <input type="text" class="form-control" id="item-code" placeholder="Enter Item Code" required>
                    </div>

                    <!-- Grade -->
                    <div class="col-md-6 col-lg-4">
                        <label for="grade" class="form-label">Grade </label>
                        <input type="text" class="form-control" id="grade" placeholder="Enter Grade" required>
                    </div>

                    <!-- Item Name -->
                    <div class="col-md-6 col-lg-4">
                        <label for="item-name" class="form-label">Item Name </label>
                        <input type="text" class="form-control" id="item-name" placeholder="Enter Item Name" required>
                    </div>


                    <!-- Additional Fields (as required) -->
                    <div class="col-md-6 col-lg-4">
                        <label for="item-category" class="form-label">Category</label>
                        <select class="form-control" id="item-category">
                            <option value="Metal">Metal</option>
                            <option value="Plastic">Plastic</option>
                            <option value="Wood">Wood</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <label for="uom" class="form-label">Unit of Measurement (UOM)</label>
                        <select class="form-control" id="uom">
                            <option value="kg">kg</option>
                            <option value="litre">litre</option>
                            <option value="piece">piece</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <label for="item-price" class="form-label">Unit Price</label>
                        <input type="number" class="form-control" id="item-price" placeholder="Enter Unit Price">
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <label for="supplier" class="form-label">Supplier</label>
                        <input type="text" class="form-control" id="supplier" placeholder="Enter Supplier Name">
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <label for="supplier" class="form-label">Warehouse</label>
                        <input type="text" class="form-control" id="supplier" placeholder="Enter Supplier Name">
                    </div>
                  

                    
                    <!-- Item Description -->
                    <div class="col-md-12">
                        <label for="item-description" class="form-label">Item Description</label>
                        <textarea class="form-control" id="item-description" rows="3" placeholder="Enter Item Description"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="create-material-btn">Add Instock</button>
            </div>
        </div>
    </div>
</div>
<!-- End:: Add Raw Material -->



    @endsection