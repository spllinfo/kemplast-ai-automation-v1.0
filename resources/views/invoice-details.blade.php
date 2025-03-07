@extends('layouts.app')
@section('content')




      <!-- Start::page-header -->
      <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
        <div>
            <nav>
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">
                            Pages
                        </a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page"><a href="javascript:void(0);">Invoice</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Invoice Details</li>
                </ol>
            </nav>
            <h1 class="page-title fw-medium fs-18 mb-0">Invoice Details</h1>
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
    <!-- End::page-header -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-9">
            <div class="card custom-card">
                <div class="card-header d-md-flex d-block">
                    <div class="h5 mb-0 d-sm-flex d-bllock align-items-center">
                        <div class="avatar avatar-sm">
                            <img src="{{ asset('assets/images/company-logos/11.jpg')}}" alt="Customer">
                        </div>
                        <div class="ms-sm-2 ms-0 mt-sm-0 mt-2">
                            <div class="h6 fw-medium mb-0">DISPATCH INVOICE : <span class="text-primary">#7864-1542</span></div>
                        </div>
                    </div>
                    <div class="ms-auto mt-md-0 mt-2">
                        <button class="btn btn-sm btn-primary1 me-1" onclick="javascript:window.print();">Print<i class="ri-printer-line ms-1 align-middle d-inline-block"></i></button>
                        <button class="btn btn-sm btn-primary">Save As PDF<i class="ri-file-pdf-line ms-1 align-middle d-inline-block"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <p class="text-muted mb-2">
                                        Billing From :
                                    </p>
                                    <p class="fw-bold mb-1">
                                        Kemplast Systems
                                    </p>
                                    <p class="mb-1 text-muted">
                                        Plot No. 24, Industrial Estate
                                    </p>
                                    <p class="mb-1 text-muted">
                                        Verna, Goa, India, 403722
                                    </p>
                                    <p class="mb-1 text-muted">
                                        info@kemplastsystems.com
                                    </p>
                                    <p class="mb-1 text-muted">
                                        +91 832-258-3654
                                    </p>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 ms-auto mt-sm-0 mt-3">
                                    <p class="text-muted mb-2">
                                        Billing To :
                                    </p>
                                    <p class="fw-bold mb-1">
                                        Global Supply Ltd.
                                    </p>
                                    <p class="text-muted mb-1">
                                        22 Park Street, London, UK
                                    </p>
                                    <p class="text-muted mb-1">
                                        globalsupply@companymail.com
                                    </p>
                                    <p class="text-muted">
                                        +44 20 7946 0958
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <p class="fw-medium text-muted mb-1">Invoice ID :</p>
                            <p class="fs-15 mb-1">#KPL78641542</p>
                        </div>
                        <div class="col-xl-3">
                            <p class="fw-medium text-muted mb-1">Date Issued :</p>
                            <p class="fs-15 mb-1">15, May 2024 - <span class="text-muted fs-12">11:13AM</span></p>
                        </div>
                        <div class="col-xl-3">
                            <p class="fw-medium text-muted mb-1">Due Date :</p>
                            <p class="fs-15 mb-1">28, June 2024</p>
                        </div>
                        <div class="col-xl-3">
                            <p class="fw-medium text-muted mb-1">Due Amount :</p>
                            <p class="fs-16 mb-1 fw-medium">₹3,84,653.00</p>
                        </div>
                        <div class="col-xl-12">
                            <div class="table-responsive">
                                <table class="table nowrap text-nowrap border mt-4">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT</th>
                                            <th>DESCRIPTION</th>
                                            <th>QUANTITY</th>
                                            <th>PRICE PER UNIT</th>
                                            <th>TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="fw-medium">
                                                    LDPE Bags
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted">
                                                    Lightweight, recyclable, high strength
                                                </div>
                                            </td>
                                            <td class="product-quantity-container">
                                                5,000
                                            </td>
                                            <td>
                                                ₹3.50
                                            </td>
                                            <td>
                                                ₹17,500.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="fw-medium">
                                                    HDPE Bags
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted">
                                                    Tear-resistant, durable, high load capacity
                                                </div>
                                            </td>
                                            <td class="product-quantity-container">
                                                2,500
                                            </td>
                                            <td>
                                                ₹5.00
                                            </td>
                                            <td>
                                                ₹12,500.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="fw-medium">
                                                    BOPP Bags
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-muted">
                                                    Glossy finish, excellent clarity
                                                </div>
                                            </td>
                                            <td class="product-quantity-container">
                                                4,000
                                            </td>
                                            <td>
                                                ₹4.20
                                            </td>
                                            <td>
                                                ₹16,800.00
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">
                                                <table class="table table-sm text-nowrap mb-0 table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">
                                                                <p class="mb-0">Sub Total :</p>
                                                            </th>
                                                            <td>
                                                                <p class="mb-0 fw-medium fs-15">₹46,800.00</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <p class="mb-0">GST (18%) :</p>
                                                            </th>
                                                            <td>
                                                                <p class="mb-0 fw-medium fs-15">₹8,424.00</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                <p class="mb-0 fs-14">Total :</p>
                                                            </th>
                                                            <td>
                                                                <p class="mb-0 fw-medium fs-16 text-success">₹55,224.00</p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div>
                                <label for="invoice-note" class="form-label">Note:</label>
                                <textarea class="form-control form-control-light" id="invoice-note" rows="3">If you're not satisfied with the product, you can return the unused item within 10 days of the delivery date. For refund options, please visit the official website and review the available refund policies.</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button class="btn btn-primary">Download <i class="ri-download-2-line ms-1 align-middle"></i></button>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Mode Of Payment
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-xl-12">
                            <p class="fs-14 fw-medium">
                                Credit/Debit Card
                            </p>
                            <p>
                                <span class="fw-medium text-muted fs-12">Card Number :</span> 1323 3213 4546 XXXX
                            </p>
                            <p>
                                <span class="fw-medium text-muted fs-12">Name On Card :</span> Ravichandran
                            </p>
                            <p>
                                <span class="fw-medium text-muted fs-12">Total Amount :</span> <span class="text-success fw-medium fs-14">₹3,45,846.53</span>
                            </p>
                            <p>
                                <span class="fw-medium text-muted fs-12">Due Date :</span> 28,June 2024 - <span class="text-danger fs-12 fw-medium">18 days due</span>
                            </p>
                            <p>
                                <span class="fw-medium text-muted fs-12">Invoice Status : <span class="badge bg-primary3-transparent">Processing</span></span>
                            </p>
                            <div class="alert alert-primary2" role="alert">
                                Please Make sure to pay the invoice bill within 60 days.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->


@endsection