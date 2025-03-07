@extends('layouts.app')

<!-- Apex Charts JS -->
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script> 
@section('content')

  <!-- Start::page-header -->
  <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
                    <div>
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">
                                    Dashboards
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Sales</li>
                        </ol>
                        <h1 class="page-title fw-medium fs-18 mb-0">Sales Dashboard</h1>
                    </div>
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text bg-white border"> <i class="ri-calendar-line"></i> </div>
                                <input type="text" class="form-control breadcrumb-input" id="daterange" placeholder="Search By Date Range">
                            </div>
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
                </div>
                <!-- End::page-header -->

                <!-- Start:: row-1 -->
                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-xxl-3 col-xl-6">
                                <div class="card custom-card overflow-hidden main-content-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between mb-2">
                                            <div>
                                                <span class="text-muted d-block mb-1">Total Parts</span>
                                                <h4 class="fw-medium mb-0">8954</h4>
                                            </div>
                                            <div class="lh-1">
                                                <span class="avatar avatar-md avatar-rounded bg-primary">
                                                    <i class="ti ti-layout fs-5"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-muted fs-13">Increased By <span class="text-success">6.56%<i class="ti ti-arrow-narrow-up fs-16"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-6">
                                <div class="card custom-card overflow-hidden main-content-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between mb-2">
                                            <div>
                                                <span class="d-block text-muted mb-1">Total Dispatch</span>
                                                <h4 class="fw-medium mb-0">3,01,876</h4>
                                            </div>
                                            <div class="lh-1">
                                                <span class="avatar avatar-md avatar-rounded bg-primary1">
                                                    <i class="ti ti-shopping-cart fs-5"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-muted fs-13">Increased By <span class="text-success">0.34%<i class="ti ti-arrow-narrow-up fs-16"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-6">
                                <div class="card custom-card overflow-hidden main-content-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between mb-2">
                                            <div>
                                                <span class="text-muted d-block mb-1">Total Revenue</span>
                                                <h4 class="fw-medium mb-0">₹3,64,241</h4>
                                            </div>
                                            <div class="lh-1">
                                                <span class="avatar avatar-md avatar-rounded bg-primary2">
                                                    <i class="ti ti-currency-dollar fs-5"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-muted fs-13">Increased By <span class="text-success">7.66%<i class="ti ti-arrow-narrow-up fs-16"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3 col-xl-6">
                                <div class="card custom-card overflow-hidden main-content-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start justify-content-between mb-2">
                                            <div>
                                                <span class="text-muted d-block mb-1">Total Sales</span>
                                                <h4 class="fw-medium mb-0">₹1,76,586</h4>
                                            </div>
                                            <div class="lh-1">
                                                <span class="avatar avatar-md avatar-rounded bg-primary3">
                                                    <i class="ti ti-chart-bar fs-5"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-muted fs-13">Decreased By <span class="text-danger">0.004%<i class="ti ti-arrow-narrow-down fs-16"></i></span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-8 col-xl-6">
                                <div class="card custom-card">
                                    <div class="card-header justify-content-between">
                                        <div class="card-title">
                                            Sales Overview
                                        </div>
                                        <div class="dropdown"> 
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light text-muted dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true"> Sort By</a> 
                                            <ul class="dropdown-menu" role="menu" data-popper-placement="bottom-end"> 
                                                <li><a class="dropdown-item" href="javascript:void(0);">This Week</a></li>
                                                 <li><a class="dropdown-item" href="javascript:void(0);">Last Week</a></li> 
                                                 <li><a class="dropdown-item" href="javascript:void(0);">This Month</a></li> 
                                            </ul> 
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="sales-overview"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-6">
                                <div class="card custom-card overflow-hidden">
                                    <div class="card-header pb-0 justify-content-between">
                                        <div class="card-title">
                                            Order Statistics
                                        </div>
                                        <div class="dropdown">
                                            <a aria-label="anchor" href="javascript:void(0);" class="btn btn-light btn-icons btn-sm text-muted" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fe fe-more-vertical"></i>
                                            </a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li class="border-bottom"><a class="dropdown-item" href="javascript:void(0);">Today</a></li>
                                                <li class="border-bottom"><a class="dropdown-item" href="javascript:void(0);">This Week</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">Last Week</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body py-4 px-3">
                                        <div class="d-flex gap-3 mb-3">
                                            <div class="avatar avatar-md bg-primary-transparent">
                                                <i class="ti ti-trending-up fs-5"></i>
                                            </div>
                                            <div class="flex-fill d-flex align-items-start justify-content-between">
                                                <div>
                                                    <span class="fs-11 mb-1 d-block fw-medium">TOTAL ORDERS</span> 
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h4 class="mb-0 d-flex align-items-center">98,736<span class="text-success fs-12 ms-2 op-1"><i class="ti ti-trending-up align-middle me-1"></i>0.57%</span></h4>
                                                    </div>
                                                </div>
                                                <a href="javascript:void(0);" class="text-success fs-12 text-decoration-underline">Increased ?</a>
                                            </div>
                                        </div>
                                        <div id="orders" class="my-2"></div>
                                    </div>
                                    <div class="card-footer border-top border-block-start-dashed">
                                        <div class="d-grid">
                                            <button class="btn btn-primary-ghost btn-wave fw-medium waves-effect waves-light table-icon">Complete Statistics<i class="ti ti-arrow-narrow-right ms-2 fs-16 d-inline-block"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card custom-card main-dashboard-banner main-dashboard-banner2 overflow-hidden">
                                    <div class="card-body p-4">
                                        <div class="row justify-content-between">
                                            <div class="col-xxl-7 col-xl-5 col-lg-5 col-md-5 col-sm-5">
                                                <h4 class="mb-2 fw-medium text-fixed-white">Enhance Production</h4>
                                                <p class="mb-1 text-fixed-white">Analyze metrics, track performance, gain insights to drive your business forward.</p>
                                                <a href="javascript:void(0);" class="fw-medium text-fixed-white text-decoration-underline">Production Plans<i class="ti ti-arrow-narrow-right"></i></a>
                                            </div>
                                            <div class="col-xxl-4 col-xl-7 col-lg-7 col-md-7 col-sm-7 d-sm-block d-none text-end my-auto">
                                                <img src="{{ asset('assets/images/media/media-85.png') }}" alt="" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           

                            <div class="col-xl-12">
                                <div class="card custom-card overflow-hidden">
                                    <div class="card-header justify-content-between">
                                        <div class="card-title">
                                            Top Selling Products
                                        </div>
                                        <div class="dropdown"> 
                                            <a href="javascript:void(0);" class="btn btn-sm btn-light text-muted dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true"> Sort By</a> 
                                            <ul class="dropdown-menu" role="menu" data-popper-placement="bottom-end"> 
                                                <li><a class="dropdown-item" href="javascript:void(0);">This Week</a></li>
                                                <li><a class="dropdown-item" href="javascript:void(0);">Last Week</a></li> 
                                                <li><a class="dropdown-item" href="javascript:void(0);">This Month</a></li> 
                                            </ul> 
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="p-3 pb-0">
                                            <div class="progress-stacked progress-sm mb-2 gap-1">
                                                <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-primary1" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-primary2" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-primary3" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <div>Overall Sales</div>
                                                <div class="h6 mb-0"><span class="text-success me-2 fs-11">3.12%<i class="ti ti-arrow-narrow-up"></i></span>1,58,643</div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table text-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <span class="fw-medium top-category-name one">Garbage Bags</span>
                                                        </td>
                                                        <td>
                                                            <span class="fw-medium">42,786</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="text-muted fs-12">30% Gross</span>
                                                        </td>
                                                        <td class="text-end">
                                                            <span class="badge bg-success">1.25% <i class="ti ti-trending-up"></i></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="fw-medium top-category-name two">LD Plain Bags</span>
                                                        </td>
                                                        <td>
                                                            <span class="fw-medium">36,542</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="text-muted fs-12">25% Gross</span>
                                                        </td>
                                                        <td class="text-end">
                                                            <span class="badge bg-warning">0.89% <i class="ti ti-trending-up"></i></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="fw-medium top-category-name three">Bio Printed Carry Bags</span>
                                                        </td>
                                                        <td>
                                                            <span class="fw-medium">28,673</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="text-muted fs-12">20% Gross</span>
                                                        </td>
                                                        <td class="text-end">
                                                            <span class="badge bg-secondary">1.02% <i class="ti ti-trending-up"></i></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="fw-medium top-category-name four">LD Shrink Film</span>
                                                        </td>
                                                        <td>
                                                            <span class="fw-medium">25,417</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="text-muted fs-12">18% Gross</span>
                                                        </td>
                                                        <td class="text-end">
                                                            <span class="badge bg-primary1">0.58% <i class="ti ti-trending-up"></i></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-bottom-0">
                                                            <span class="fw-medium top-category-name five">PP Plain Bags</span>
                                                        </td>
                                                        <td class="border-bottom-0">
                                                            <span class="fw-medium">15,225</span>
                                                        </td>
                                                        <td class="text-center border-bottom-0">
                                                            <span class="text-muted fs-12">15% Gross</span>
                                                        </td>
                                                        <td class="text-end border-bottom-0">
                                                            <span class="badge bg-primary">1.47% <i class="ti ti-trending-up"></i></span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!-- End:: row-1 -->

                <!-- Start:: row-2 -->
                <div class="row">
                    <div class="col-xxl-3 col-xl-6">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Recent Inventory Stock
                                </div>
                                <a href="javascript:void(0);" class="btn btn-light btn-wave btn-sm text-muted">View All<i class="ti ti-arrow-narrow-right ms-1"></i></a>
                            </div>
                            <div class="card-body p-0 pb-1">
                                <div class="table-responsive">
                                    <table class="table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Material</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-sm">
                                                                <img src="{{ asset('assets/images/media/12raw-m.jpg') }}" alt="LLD">
                                                            </span>
                                                        </div>
                                                        <div class="fw-medium">LLD</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-medium">500 kg</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary">Available</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-sm">
                                                                <img src="{{ asset('assets/images/media/12raw-m.jpg') }}" alt="LD">
                                                            </span>
                                                        </div>
                                                        <div class="fw-medium">LD</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-medium">1.5 tons</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary1">Pending</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-sm">
                                                                <img src="{{ asset('assets/images/media/12raw-m.jpg') }}" alt="HD">
                                                            </span>
                                                        </div>
                                                        <div class="fw-medium">HD</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-medium">2 tons</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-danger">Low Stock</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-sm">
                                                                <img src="{{ asset('assets/images/media/12raw-m.jpg') }}" alt="RD">
                                                            </span>
                                                        </div>
                                                        <div class="fw-medium">RD</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-medium">3 tons</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary3">Available</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-sm">
                                                                <img src="{{ asset('assets/images/media/12raw-m.jpg') }}" alt="LLD">
                                                            </span>
                                                        </div>
                                                        <div class="fw-medium">LLD</div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fw-medium">250 kg</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">Available</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-sm">
                                                                <img src="{{ asset('assets/images/media/12raw-m.jpg') }}" alt="HD">
                                                            </span>
                                                        </div>
                                                        <div class="fw-medium">HD</div>
                                                    </div>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <span class="fw-medium">750 kg</span>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <span class="badge bg-warning">Available</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xxl-3">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Running Jobs 
                                </div>
                                <button type="button" class="btn btn-sm btn-primary-light ">View All</button>
                            </div>
                            <div class="p-3 pb-2">
                                <div class="d-flex align-items-start gap-3 mb-3">
                                    <div class="flex-grow-1">
                                        <p class="fw-medium mb-1 fs-14">Extrusion Process <a href="javascript:void(0);" class="text-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Get Info"><i class="ri-information-2-line fs-13 op-7 lh-1 align-middle"></i></a></p>
                                        <p class="text-muted mb-1 fw-normal fs-12">Extrusion of polyethylene film for bag production.</p>
                                        <div>Status: <span class="text-success fw-normal fs-12">80% completed</span></div>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <p class="mb-3 fs-11 text-muted"><i class="ri-time-line text-muted fs-11 align-middle lh-1 me-1 d-inline-block"></i>5mins ago</p>
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ asset('assets/images/faces/11.jpg')}}" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ asset('assets/images/faces/2.jpg')}}" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ asset('assets/images/faces/5.jpg')}}" alt="img">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress progress-lg rounded-pill p-1 ms-auto bg-primary-transparent" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated rounded-pill" style="width: 80%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 pb-2">
                                <div class="d-flex align-items-start gap-3 mb-3">
                                    <div class="flex-grow-1">
                                        <p class="fw-medium mb-1 fs-14">Cutting and Sealing <a href="javascript:void(0);" class="text-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Get Info"><i class="ri-information-2-line fs-13 op-7 lh-1 align-middle"></i></a></p>
                                        <p class="text-muted mb-1 fw-normal fs-12">Cutting and sealing bag material into desired sizes.</p>
                                        <div>Status: <span class="text-warning fw-medium fs-12">69% completed</span></div>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <p class="mb-3 fs-11 text-muted"><i class="ri-time-line text-muted fs-11 align-middle lh-1 me-1 d-inline-block"></i>20mins ago</p>
                                        <div class="avatar-list-stacked">
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ asset('assets/images/faces/11.jpg')}}" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ asset('assets/images/faces/8.jpg')}}" alt="img">
                                            </span>
                                            <span class="avatar avatar-sm avatar-rounded">
                                                <img src="{{ asset('assets/images/faces/2.jpg')}}" alt="img">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress progress-lg rounded-pill p-1 ms-auto flex-fill bg-primary1-transparent" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-primary1 progress-bar-striped progress-bar-animated rounded-pill" style="width: 69%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="d-flex align-items-start gap-3 mb-3">
                                    <div class="flex-grow-1">
                                        <p class="fw-medium mb-1 fs-14">Printing on Bags <a href="javascript:void(0);" class="text-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Get Info"><i class="ri-information-2-line fs-13 op-7 lh-1 align-middle"></i></a></p>
                                        <p class="text-muted mb-1 fs-12">Printing logos and designs on manufactured bags.</p>
                                        <div>Status: <span class="text-success fw-medium fs-12">52% completed</span></div>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <p class="mb-3 fs-11 text-muted"><i class="ri-time-line text-muted fs-11 align-middle lh-1 me-1 d-inline-block"></i>30mins ago</p>
                                        <div class="avatar-list-stacked">
                                            <div class="avatar-list-stacked">
                                                <span class="avatar avatar-sm avatar-rounded">
                                                    <img src="{{ asset('assets/images/faces/15.jpg')}}" alt="img">
                                                </span>
                                                <span class="avatar avatar-sm avatar-rounded">
                                                    <img src="{{ asset('assets/images/faces/3.jpg')}}" alt="img">
                                                </span>
                                                <a class="avatar avatar-sm bg-primary border border-2 avatar-rounded text-fixed-white" href="javascript:void(0);"> 3+ </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="progress progress-lg rounded-pill p-1 ms-auto flex-fill bg-primary2-transparent" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar bg-primary2 progress-bar-striped progress-bar-animated rounded-pill" style="width: 52%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    


                    <div class="col-xxl-6">
                        <div class="card custom-card">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Material Usage Analytics
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary-light btn-sm"><i class="ri-share-forward-line me-1 align-middle d-inline-block"></i>Export</button>
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                <div id="materialUsageMetric"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->

                <!-- Start:: row-3 -->
                <div class="row">
                    <div class="col-xl-9">
                        <div class="card custom-card overflow-hidden">
                            <div class="card-header justify-content-between">
                                <div class="card-title">
                                    Recent Orders
                                </div>
                                <a href="javascript:void(0);" class="btn btn-light btn-wave btn-sm text-muted waves-effect waves-light">View All</a>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel1" value="" aria-label="...">
                                                </th>
                                                <th>Customer</th>
                                                <th>Product</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Amount</th>
                                                <th>Status</th>
                                                <th>Due Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel05" value="" aria-label="..." checked>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-sm">
                                                                <img src="{{ asset('assets/images/faces/1.jpg') }}" alt="">
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="d-block fw-medium">Honda Unit-5</span>
                                                            <span class="d-block fs-11 text-muted">honda@example.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    Garbage Bags
                                                </td>
                                                <td class="text-center">
                                                    50000
                                                </td>
                                                <td class="text-center">
                                                    ₹2,44,546
                                                </td>
                                                <td>
                                                    <span class="badge bg-success-transparent">Completed</span>
                                                </td>
                                                <td>
                                                    10, Feb 2025
                                                </td>
                                                <td>
                                                    <div class="btn-list">
                                                        <button class="btn btn-sm btn-icon btn-success-light"><i class="ri-pencil-line"></i></button>
                                                        <button class="btn btn-sm btn-icon btn-danger-light"><i class="ri-delete-bin-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel06" value="" aria-label="...">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-sm">
                                                                <img src="{{ asset('assets/images/faces/12.jpg') }}" alt="">
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="d-block fw-medium">TVS Motors</span>
                                                            <span class="d-block fs-11 text-muted">tvs@example.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    LD Plain Bags
                                                </td>
                                                <td class="text-center">
                                                    36000
                                                </td>
                                                <td class="text-center">
                                                    ₹1,44,546
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning-transparent">Pending</span>
                                                </td>
                                                <td>
                                                    05, Feb 2025
                                                </td>
                                                <td>
                                                    <div class="btn-list">
                                                        <button class="btn btn-sm btn-icon btn-success-light"><i class="ri-pencil-line"></i></button>
                                                        <button class="btn btn-sm btn-icon btn-danger-light"><i class="ri-delete-bin-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel42" value="" aria-label="..." checked>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-sm">
                                                                <img src="{{ asset('assets/images/faces/6.jpg') }}" alt="">
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="d-block fw-medium">Green Foods</span>
                                                            <span class="d-block fs-11 text-muted">green@example.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    Bio Printed Carrybags
                                                </td>
                                                <td class="text-center">
                                                  42000
                                                </td>
                                                <td class="text-center">
                                                    ₹3,44,546
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary2-transparent">In Progress</span>
                                                </td>
                                                <td>
                                                    12, Feb 2025
                                                </td>
                                                <td>
                                                    <div class="btn-list">
                                                        <button class="btn btn-sm btn-icon btn-success-light"><i class="ri-pencil-line"></i></button>
                                                        <button class="btn btn-sm btn-icon btn-danger-light"><i class="ri-delete-bin-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel12" value="" aria-label="...">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-sm">
                                                                <img src="{{ asset('assets/images/faces/11.jpg') }}" alt="">
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="d-block fw-medium">Tata Motors</span>
                                                            <span class="d-block fs-11 text-muted">tvs@example.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    LD Plain Bags
                                                </td>
                                                <td class="text-center">
                                                    36000
                                                </td>
                                                <td class="text-center">
                                                    ₹1,44,546
                                                </td>
                                                <td>
                                                    <span class="badge bg-warning-transparent">Pending</span>
                                                </td>
                                                <td>
                                                    05, Feb 2025
                                                </td>
                                                <td>
                                                    <div class="btn-list">
                                                        <button class="btn btn-sm btn-icon btn-success-light"><i class="ri-pencil-line"></i></button>
                                                        <button class="btn btn-sm btn-icon btn-danger-light"><i class="ri-delete-bin-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" id="checkboxNoLabel42" value="" aria-label="..." checked>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="lh-1">
                                                            <span class="avatar avatar-sm">
                                                                <img src="{{ asset('assets/images/faces/2.jpg') }}" alt="">
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="d-block fw-medium">Green Foods</span>
                                                            <span class="d-block fs-11 text-muted">green@example.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    Bio Printed Carrybags
                                                </td>
                                                <td class="text-center">
                                                  42000
                                                </td>
                                                <td class="text-center">
                                                    ₹3,44,546
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary2-transparent">In Progress</span>
                                                </td>
                                                <td>
                                                    12, Feb 2025
                                                </td>
                                                <td>
                                                    <div class="btn-list">
                                                        <button class="btn btn-sm btn-icon btn-success-light"><i class="ri-pencil-line"></i></button>
                                                        <button class="btn btn-sm btn-icon btn-danger-light"><i class="ri-delete-bin-line"></i></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                   <div class="col-xl-3">
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">
                Sales By Customer
            </div>
            <a href="javascript:void(0);" class="btn btn-light btn-wave btn-sm text-muted waves-effect waves-light">View All</a>
        </div>
        <div class="card-body">
            <ul class="list-unstyled sales-country-list">
                <li>
                    <div class="d-flex align-items-start gap-3">
                        <div class="lh-1">
                            <span class="avatar avatar-sm p-1 bg-light border">
                                <img src="{{ asset('assets/images/company-logos/1.png') }}" alt="">
                            </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-block fw-medium mb-2 lh-1">Honda Unit-5</span>
                                <span class="fs-14 fw-medium d-block lh-1">31,672</span>
                            </div>
                            <div class="progress progress-md p-1" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="d-flex align-items-start gap-3">
                        <div class="lh-1">
                            <span class="avatar avatar-sm p-1 bg-light border">
                                <img src="{{ asset('assets/images/company-logos/2.png') }}" alt="">
                            </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-block fw-medium mb-2 lh-1">
                                    TVS Motors</span>
                                <span class="fs-14 fw-medium d-block lh-1">29,557</span>
                            </div>
                            <div class="progress progress-md p-1" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-primary1 progress-bar-striped progress-bar-animated"
                                    style="width: 85%"></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="d-flex align-items-start gap-3">
                        <div class="lh-1">
                            <span class="avatar avatar-sm p-1 bg-light border">
                                <img src="{{ asset('assets/images/company-logos/3.png') }}" alt="">
                            </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-block fw-medium mb-2 lh-1">Tata Motors</span>
                                <span class="fs-14 fw-medium d-block lh-1">24,562</span>
                            </div>
                            <div class="progress progress-md p-1" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-primary2 progress-bar-striped progress-bar-animated"
                                    style="width: 80%"></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="d-flex align-items-start gap-3">
                        <div class="lh-1">
                            <span class="avatar avatar-sm p-1 bg-light border">
                                <img src="{{ asset('assets/images/company-logos/4.png') }}" alt="">
                            </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-block fw-medium mb-2 lh-1">Green Foods</span>
                                <span class="fs-14 fw-medium d-block lh-1">21,532</span>
                            </div>
                            <div class="progress progress-md p-1" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-primary3 progress-bar-striped progress-bar-animated"
                                    style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="d-flex align-items-start gap-3">
                        <div class="lh-1">
                            <span class="avatar avatar-sm p-1 bg-light border">
                                <img src="{{ asset('assets/images/company-logos/5.png') }}" alt="">
                            </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-block fw-medium mb-2 lh-1">Honda Unit-2</span>
                                <span class="fs-14 fw-medium d-block lh-1">18,753</span>
                            </div>
                            <div class="progress progress-md p-1" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-secondary progress-bar-striped progress-bar-animated"
                                    style="width: 70%"></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="d-flex align-items-start gap-3">
                        <div class="lh-1">
                            <span class="avatar avatar-sm p-1 bg-light border">
                                <img src="{{ asset('assets/images/company-logos/6.png') }}" alt="">
                            </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-block fw-medium mb-2 lh-1">Rolls Royce Unit-5</span>
                                <span class="fs-14 fw-medium d-block lh-1">12,342</span>
                            </div>
                            <div class="progress progress-md p-1" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-info progress-bar-striped progress-bar-animated"
                                    style="width: 65%"></div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="d-flex align-items-start gap-3">
                        <div class="lh-1">
                            <span class="avatar avatar-sm p-1 bg-light border">
                                <img src="{{ asset('assets/images/company-logos/9.png') }}" alt="">
                            </span>
                        </div>
                        <div class="flex-fill">
                            <div class="d-flex align-items-center justify-content-between">
                                <span class="d-block fw-medium mb-2 lh-1">Customer 7</span>
                                <span class="fs-14 fw-medium d-block lh-1">15,533</span>
                            </div>
                            <div class="progress progress-md p-1" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated"
                                    style="width: 60%"></div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>


                </div>
                <!-- End:: row-3 -->

<!-- Sales Dashboard -->
<script src="{{ asset('assets/js/sales-dashboard.js') }}"></script>


 <!-- Projects Dashboard --> 
 <script src="{{ asset('assets/js/analytics-dashboard.js') }}"></script> 
  <!-- Projects Dashboard --> 
  <script src="{{ asset('assets/js/projects-dashboard.js') }}"></script> 

@endsection