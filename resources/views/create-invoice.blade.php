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
                <li class="breadcrumb-item active" aria-current="page">Create Invoice</li>
            </ol>
        </nav>
        <h1 class="page-title fw-medium fs-18 mb-0">Create Invoice</h1>
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
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-md-flex d-block">
                <div class="h5 mb-0 d-sm-flex d-block align-items-center">
                    <div>
                        <img src="{{ asset('assets/images/brand-logos/toggle-logo.png')}}" alt="">
                    </div>
                    <div class="ms-sm-2 ms-0 mt-sm-0 mt-2">
                        <input type="text" class="form-control form-control-light form-control-sm" placeholder="Invoice Title" value="INV TITLE">
                    </div>
                    <div class="mx-2">:</div>
                    <div class="mt-sm-0 mt-2">
                        <input type="text" class="form-control form-control-light form-control-sm" placeholder="Invoice ID" value="#SHG148756965">
                    </div>
                </div>
                <div class="ms-auto mt-md-0 mt-2">
                    <button class="btn btn-sm btn-primary me-2">Save As PDF<i class="ri-file-pdf-line ms-1 align-middle d-inline-block"></i></button>
                    <button class="btn btn-sm btn-icon btn-primary1-light me-2"><i class="bi bi-plus-lg"></i></button>
                    <button class="btn btn-sm btn-icon btn-primary2-light me-2"><i class="bi bi-download"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row gy-3">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <p class="dw-semibold mb-2">
                                    Billing From:
                                </p>
                                <div class="row gy-2">
                                    <div class="col-xl-12">
                                        <input type="text" class="form-control form-control-light" id="Company-Name" placeholder="Company Name" value="Kemplast Systems">
                                    </div>
                                    <div class="col-xl-12">
                                        <textarea class="form-control form-control-light" id="company-address" placeholder="Enter Address" rows="3">Goa, India</textarea>
                                    </div>
                                    <div class="col-xl-12">
                                        <input type="text" class="form-control form-control-light" id="company-mail" placeholder="Company Email" value="info@kemplastsystems.com">
                                    </div>
                                    <div class="col-xl-12">
                                        <input type="text" class="form-control form-control-light" id="company-phone" placeholder="Phone Number" value="+91-9876543210">
                                    </div>
                                    <div class="col-xl-12">
                                        <textarea class="form-control form-control-light" id="invoice-subject" placeholder="Subject" rows="4">Invoice Details</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 ms-auto mt-sm-0 mt-3">
                                <p class="dw-semibold mb-2">
                                    Billing To:
                                </p>
                                <div class="row gy-2">
                                    <div class="col-xl-12">
                                        <input type="text" class="form-control form-control-light" id="customer-Name" placeholder="Customer Name" value="TVS Motors">
                                    </div>
                                    <div class="col-xl-12">
                                        <textarea class="form-control form-control-light" id="customer-address" placeholder="Enter Address" rows="3"></textarea>
                                    </div>
                                    <div class="col-xl-12">
                                        <input type="text" class="form-control form-control-light" id="customer-mail" placeholder="Customer Email" value="">
                                    </div>
                                    <div class="col-xl-12">
                                        <input type="text" class="form-control form-control-light" id="customer-phone" placeholder="Phone Number" value="">
                                    </div>
                                    <div class="col-xl-12">
                                        <input type="text" class="form-control form-control-light" id="zip-code" placeholder="Zip Code" value="">
                                    </div>
                                    <div class="col-xl-12 choices-control">
                                        <p class="dw-semibold mb-2 mt-2">
                                            Currency:
                                        </p>
                                        <select class="form-control" data-trigger name="invoice-currency" id="invoice-currency">
                                            <option value="">Select Currency</option>
                                            <option value="INR">INR - (Indian Rupee)</option>
                                            <option value="USD">USD - (United States Dollar)</option>
                                            <option value="BHD">BHD - (Bahraini Dinar)</option>
                                            <option value="KWD">KWD - (Kuwaiti Dinar)</option>
                                            <option value="CHF">CHF - (Swiss Franc)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <label for="invoice-number" class="form-label">Invoice ID</label>
                        <input type="text" class="form-control form-control-light" id="invoice-number" placeholder="Inv No" value="#SHG148756965">
                    </div>
                    <div class="col-xl-3">
                        <label for="invoice-date-issued" class="form-label">Date Issued</label>
                        <input type="date" class="form-control form-control-light" id="invoice-date-issued" placeholder="Choose date">
                    </div>
                    <div class="col-xl-3">
                        <label for="invoice-date-due" class="form-label">Due Date</label>
                        <input type="date" class="form-control form-control-light" id="invoice-date-due" placeholder="Choose date">
                    </div>
                    <div class="col-xl-3">
                        <label for="invoice-due-amount" class="form-label">Due Amount</label>
                        <input type="text" class="form-control form-control-light" id="invoice-due-amount" placeholder="Enter Amount" value="₹24,784.54">
                    </div>
                    <div class="col-xl-12">
                        <div class="table-responsive">
                            <table class="table nowrap text-nowrap border mt-3">
                                <thead>
                                    <tr>
                                        <th>PRODUCT NAME</th>
                                        <th>DESCRIPTION</th>
                                        <th>QUANTITY</th>
                                        <th>PRICE PER UNIT</th>
                                        <th>TOTAL</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control form-control-light" placeholder="Enter Product Name">
                                        </td>
                                        <td>
                                            <textarea rows="1" class="form-control form-control-light" placeholder="Enter Description"></textarea>
                                        </td>
                                        <td class="invoice-quantity-container">
                                            <div class="input-group border rounded flex-nowrap">
                                                <button class="btn btn-icon btn-primary input-group-text flex-fill product-quantity-minus"><i class="ri-subtract-line"></i></button>
                                                <input type="text" class="form-control form-control-sm border-0 text-center w-100" aria-label="quantity" id="product-quantity4" value="1">
                                                <button class="btn btn-icon btn-primary input-group-text flex-fill product-quantity-plus"><i class="ri-add-line"></i></button>
                                            </div>
                                        </td>
                                        <td><input class="form-control form-control-light" placeholder="" type="text" value="₹84.00"></td>
                                        <td><input class="form-control form-control-light" placeholder="" type="text" value="₹251.00"></td>
                                        <td>
                                            <button class="btn btn-sm btn-icon btn-danger-light"><i class="ri-delete-bin-5-line"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control form-control-light" placeholder="Enter Product Name">
                                        </td>
                                        <td>
                                            <textarea rows="1" class="form-control form-control-light" placeholder="Enter Description"></textarea>
                                        </td>
                                        <td class="invoice-quantity-container">
                                            <div class="input-group border rounded flex-nowrap">
                                                <button class="btn btn-icon btn-primary input-group-text flex-fill product-quantity-minus"><i class="ri-subtract-line"></i></button>
                                                <input type="text" class="form-control form-control-sm border-0 text-center w-100" aria-label="quantity" id="product-quantity5" value="1">
                                                <button class="btn btn-icon btn-primary input-group-text flex-fill product-quantity-plus"><i class="ri-add-line"></i></button>
                                            </div>
                                        </td>
                                        <td><input class="form-control form-control-light" placeholder="Enter Amount" type="text"></td>
                                        <td><input class="form-control form-control-light" placeholder="Enter Amount" type="text"></td>
                                        <td>
                                            <button class="btn btn-sm btn-icon btn-danger-light"><i class="ri-delete-bin-5-line"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="border-bottom-0"><a class="btn btn-light" href="javascript:void(0);"><i class="bi bi-plus-lg"></i> Add Product</a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4"></td>
                                        <td colspan="2">
                                            <table class="table table-sm text-nowrap mb-0 table-borderless">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="fw-medium">Sub Total :</div>
                                                        </th>
                                                        <td>
                                                            <input type="text" class="form-control form-control-light invoice-amount-input" placeholder="Enter Amount" value="₹52519.89">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="fw-medium">Avail Discount :</div>
                                                        </th>
                                                        <td>
                                                            <input type="text" class="form-control form-control-light invoice-amount-input" placeholder="Enter Amount" value="₹1005.58">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">
                                                            <div class="fw-medium">GST <span class="text-danger">(18%)</span> :</div>
                                                        </th>
                                                        <td>
                                                            <input type="text" class="form-control form-control-light invoice-amount-input" placeholder="Enter Amount" value="₹4000.00">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="fw-medium">Due Till Date :</div>
                                                        </th>
                                                        <td>
                                                            <input type="text" class="form-control form-control-light invoice-amount-input" placeholder="Enter Amount" value="₹2.00">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">
                                                            <div class="fs-14 fw-medium">Total :</div>
                                                        </th>
                                                        <td>
                                                            <input type="text" class="form-control form-control-light invoice-amount-input" placeholder="Enter Amount" value="₹18,106.68">
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
            <div class="card-footer d-flex align-items-center justify-content-between gap-2">
                <button class="btn btn-primary1-light"><i class="ri-eye-line me-1 align-middle d-inline-block"></i>Preview</button>
                <button class="btn btn-primary">Send Invoice <i class="ri-send-plane-2-line ms-1 align-middle d-inline-block"></i></button>
            </div>
        </div>
    </div>

</div>
<!--End::row-1 -->

    <!-- Internal Create Invoice JS -->
    <script src="{{ asset('assets/js/create-invoice.js')}}"></script>

@endsection
