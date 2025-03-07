@extends('layouts.app')


@section('content')
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Overall Suppliers <span
                              class="badge bg-primary text-default fs-12 text-fixed-white ms-2 rounded align-middle">23</span>
                    </div>
                    <div class="d-flex flex-wrap gap-2">



                        <button type="button"
                                class="modal-effect btn btn-white btn-wave"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#addSupplierDataModal">
                            <i class="ri-file-add-line lh-1 me-1 align-middle"></i> New
                        </button>


                        <button type="button"
                                class="modal-effect btn btn-primary3 btn-wave me-0"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#importSupplierDataModal">
                            <i class="ri-download-2-line me-1"></i> Import
                        </button>
                        <button type="button"
                                class="modal-effect btn btn-primary btn-wave me-0"
                                id="exportButton">
                            <i class="ri-share-forward-line me-1"></i> Export
                        </button>

                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="show_all_fetched_data"
                         class="table-responsive">

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--End::row-1 -->
    <!-- Add Import From Supplier -->
    <div class="modal fade"
         id="importSupplierDataModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="importSupplierDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="importSupplierDataModal">Import Suppliers</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="supplierimport"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="file"
                               name="file">

                        <div class="modal-footer">
                            <button type="button"
                                    class="btn btn-light"
                                    data-bs-dismiss="modal">Close</button>
                            <button type="submit"
                                    class="btn btn-primary">Import Suppliers</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Export From Supplier -->
    <div class="modal fade"
         id="ExportSupplierModel"
         tabindex="-1"
         role="dialog"
         aria-labelledby="ExportSupplierModel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="ExportSupplierModel">Export Suppliers</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('supplierexport') }}"
                          method="POST">
                        @csrf
                        <label for="supplier_from_date">From Date:</label>
                        <input type="date"
                               name="from_date"
                               id="supplier_from_date"
                               required>

                        <label for="supplier_to_date">To Date:</label>
                        <input type="date"
                               name="to_date"
                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                               id="supplier_to_date"
                               required>

                        <div class="modal-footer">
                            <button type="button"
                                    class="btn btn-light"
                                    data-bs-dismiss="modal">Close</button>
                            <button type="submit"
                                    class="btn btn-primary">Export</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Start:: Add Supplier add data modal -->
    <div class="modal fade"
         id="addSupplierDataModal"
         tabindex="-1"
         aria-labelledby="addSupplierDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="addSupplierDataModal">Add Supplier</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="add_supplier_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-3">
                            <!-- Supplier Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/8.png') }}"
                                             alt="Supplier Logo"
                                             name="supplier-logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="company_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="supplier-profile-change">

                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- Supplier Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="supplier-name"
                                       class="form-label">Supplier Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="company_name"
                                       value="Supplier Inc"
                                       placeholder="Enter Supplier Name">
                            </div>
                            <!-- Email -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier-mail"
                                       class="form-label">Email</label>
                                <input type="email"
                                       class="form-control"
                                       name="company_mail"
                                       value="supplier@example.com"
                                       placeholder="Enter Email">
                            </div>
                            <!-- Phone -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier-phone"
                                       class="form-label">Phone No</label>
                                <input type="tel"
                                       class="form-control"
                                       name="company_phone"
                                       value="9876543210"
                                       placeholder="Enter Phone Number">
                            </div>
                            <!-- GST Number -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier-gst-contact"
                                       class="form-label">GST No</label>
                                <input type="text"
                                       class="form-control"
                                       name="company_gst"
                                       value="GST987654321"
                                       placeholder="Enter GST No">
                            </div>

                            <!-- Key Contact -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier-key-contact"
                                       class="form-label">Key Contact</label>
                                <input type="text"
                                       class="form-control"
                                       name="key_contact"
                                       value="Priya Sharma"
                                       placeholder="Contact Name">
                            </div>
                            <!-- Industry -->
                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Industry</label>
                                <select class="form-control"
                                        name="industry">
                                    <option value="Raw Materials">Raw Materials</option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Packaging"
                                            selected>Packaging</option>
                                    <option value="Chemicals">Chemicals</option>
                                    <option value="Textiles">Textiles</option>
                                    <option value="Automotive">Automotive</option>
                                    <option value="Food & Beverage">Food & Beverage</option>
                                </select>
                            </div>
                            <!-- Company Size -->
                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Company Size</label>
                                <select class="form-control"
                                        name="company_size">
                                    <option value="Large"
                                            selected>Large</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Small">Small</option>
                                </select>
                            </div>
                            <!-- Business Type -->
                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Business Type</label>
                                <select class="form-control"
                                        name="supplier_business_type">
                                    <option value="Manufacturer"
                                            selected>Manufacturer</option>
                                    <option value="Distributor">Distributor</option>
                                    <option value="Wholesaler">Wholesaler</option>
                                    <option value="Retailer">Retailer</option>
                                </select>
                            </div>

                            <!-- Delivery Terms -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier-delivery-terms"
                                       class="form-label">Delivery Terms</label>
                                <input type="text"
                                       class="form-control"
                                       name="supplier_delivery_terms"
                                       value="FOB"
                                       placeholder="Delivery Terms">
                            </div>

                            <!-- Payment Terms -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier-payment-terms"
                                       class="form-label">Payment Terms</label>
                                <input type="text"
                                       class="form-control"
                                       name="supplier_payment_terms"
                                       value="Net 30"
                                       placeholder="Payment Terms">
                            </div>

                            <!-- Address -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier-address-contact"
                                       class="form-label">Address</label>
                                <input type="text"
                                       class="form-control"
                                       name="company_address"
                                       value="456 Supply Street, Haryana"
                                       placeholder="Supplier Address">
                            </div>
                            <!-- Website -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier-website"
                                       class="form-label">Website</label>
                                <input type="url"
                                       class="form-control"
                                       name="company_website"
                                       value="https://www.supplier-inc.com"
                                       placeholder="Enter Website URL">
                            </div>
                            <!-- Revenue -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier-revenue"
                                       class="form-label">Revenue</label>
                                <input type="number"
                                       class="form-control"
                                       name="company_revenue"
                                       value="5000000"
                                       placeholder="Annual Revenue">
                            </div>


                            <!-- Social Media Links -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier-social-media-links"
                                       class="form-label">Social Media Links</label>
                                <input type="text"
                                       class="form-control"
                                       name="social_media_links"
                                       value="https://facebook.com/supplierinc, https://linkedin.com/company/supplierinc"
                                       placeholder="Enter Social Media Links (comma separated)">
                            </div>
                            <!-- Additional Notes -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier-additional-notes"
                                       class="form-label">Additional Notes</label>
                                <textarea class="form-control"
                                          name="additional_notes"
                                          rows="3"
                                          placeholder="Enter any additional notes">Leading supplier in packaging industry, known for quality and reliability.</textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="add_supplier_data_btn"
                            class="btn btn-primary">Create Supplier</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Start:: EDIT Supplier data modal -->
    <div class="modal fade"
         id="editSupplierDataModal"
         tabindex="-1"
         aria-labelledby="editSupplierDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="editSupplierDataModal">Edit Supplier</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="edit_supplier_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden"
                               name="supplier_id"
                               id="supplier_id">
                        <div class="row gy-3">
                            <!-- Supplier Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/1.png') }}"
                                             alt="Supplier Logo"
                                             id="edit_supplier_logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">

                                            <input type="file"
                                                   name="company_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- Supplier Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="company_name"
                                       class="form-label">Supplier Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="company_name"
                                       id="supplier_name"
                                       value=""
                                       placeholder="Enter Supplier Name">
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 col-lg-4">
                                <label for="company_mail"
                                       class="form-label">Email</label>
                                <input type="email"
                                       class="form-control"
                                       name="company_mail"
                                       id="supplier_mail"
                                       value=""
                                       placeholder="Enter Email">
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6 col-lg-4">
                                <label for="company_phone"
                                       class="form-label">Phone No</label>
                                <input type="tel"
                                       class="form-control"
                                       name="company_phone"
                                       id="supplier_phone"
                                       value=""
                                       placeholder="Enter Phone Number">
                            </div>

                            <!-- GST Number -->
                            <div class="col-md-6 col-lg-4">
                                <label for="company_gst"
                                       class="form-label">GST No</label>
                                <input type="text"
                                       class="form-control"
                                       name="company_gst"
                                       id="supplier_gst"
                                       value=""
                                       placeholder="Enter GST No">
                            </div>

                            <!-- Key Contact -->
                            <div class="col-md-6 col-lg-4">
                                <label for="key_contact"
                                       class="form-label">Key Contact</label>
                                <input type="text"
                                       class="form-control"
                                       name="key_contact"
                                       id="supplier_key_contact"
                                       value=""
                                       placeholder="Contact Name">
                            </div>

                            <!-- Industry -->
                            <div class="col-md-6 col-lg-4">
                                <label for="industry"
                                       class="form-label">Industry</label>
                                <select class="form-control"
                                        name="industry"
                                        id="supplier_industry">
                                    <option value="">Select Industry</option>
                                    <option value="Raw Materials">Raw Materials</option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Packaging">Packaging</option>
                                    <option value="Chemicals">Chemicals</option>
                                    <option value="Textiles">Textiles</option>
                                    <option value="Automotive">Automotive</option>
                                    <option value="Food & Beverage">Food & Beverage</option>
                                </select>
                            </div>

                            <!-- Company Size -->
                            <div class="col-md-6 col-lg-4">
                                <label for="company_size"
                                       class="form-label">Company Size</label>
                                <select class="form-control"
                                        name="company_size"
                                        id="supplier_company_size">
                                    <option value="">Select Size</option>
                                    <option value="Large">Large</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Small">Small</option>
                                </select>
                            </div>
                            <!-- Business Type -->
                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Business Type</label>
                                <select class="form-control"
                                        name="supplier_business_type"
                                        id="supplier_business_type">
                                    <option value="">Select Type</option>
                                    <option value="Manufacturer">Manufacturer</option>
                                    <option value="Distributor">Distributor</option>
                                    <option value="Wholesaler">Wholesaler</option>
                                    <option value="Retailer">Retailer</option>
                                </select>
                            </div>

                            <!-- Delivery Terms -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier_delivery_terms"
                                       class="form-label">Delivery Terms</label>
                                <input type="text"
                                       class="form-control"
                                       name="supplier_delivery_terms"
                                       id="supplier_delivery_terms"
                                       value=""
                                       placeholder="Delivery Terms">
                            </div>

                            <!-- Payment Terms -->
                            <div class="col-md-6 col-lg-4">
                                <label for="supplier_payment_terms"
                                       class="form-label">Payment Terms</label>
                                <input type="text"
                                       class="form-control"
                                       name="supplier_payment_terms"
                                       id="supplier_payment_terms"
                                       value=""
                                       placeholder="Payment Terms">
                            </div>

                            <!-- Address -->
                            <div class="col-md-6 col-lg-4">
                                <label for="company_address"
                                       class="form-label">Address</label>
                                <input type="text"
                                       class="form-control"
                                       name="company_address"
                                       id="supplier_address"
                                       value=""
                                       placeholder="Supplier Address">
                            </div>

                            <!-- Website -->
                            <div class="col-md-6 col-lg-4">
                                <label for="company_website"
                                       class="form-label">Website</label>
                                <input type="url"
                                       class="form-control"
                                       name="company_website"
                                       id="supplier_website"
                                       value=""
                                       placeholder="Enter Website URL">
                            </div>

                            <!-- Revenue -->
                            <div class="col-md-6 col-lg-4">
                                <label for="company_revenue"
                                       class="form-label">Revenue</label>
                                <input type="number"
                                       class="form-control"
                                       name="company_revenue"
                                       id="supplier_revenue"
                                       value=""
                                       placeholder="Annual Revenue">
                            </div>


                            <!-- Social Media Links -->
                            <div class="col-md-6 col-lg-4">
                                <label for="social_media_links"
                                       class="form-label">Social Media Links</label>
                                <input type="text"
                                       class="form-control"
                                       name="social_media_links"
                                       id="supplier_social_media_links"
                                       value=""
                                       placeholder="Enter Social Media Links">
                            </div>

                            <!-- Additional Notes -->
                            <div class="col-md-6 col-lg-4">
                                <label for="additional_notes"
                                       class="form-label">Additional Notes</label>
                                <textarea class="form-control"
                                          name="additional_notes"
                                          id="supplier_additional_notes"
                                          rows="3"
                                          placeholder="Enter any additional notes"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="edit_supplier_data_btn"
                            class="btn btn-primary">Update Supplier</button>
                </div>
            </div>
        </div>
    </div>

    <!-- End:: EDIT Supplier -->


    <!-- Start:: Supplier Details Offcanvas -->
    <div class="offcanvas offcanvas-end"
         tabindex="-1"
         id="viewSupplierDataModal"
         aria-labelledby="viewSupplierDataModalLabel">

        <div class="offcanvas-header">
            <h5 id="viewSupplierDataModalLabel"
                class="offcanvas-title">Supplier Details</h5>

        </div>
        <div class="offcanvas-body p-0">
            <div class="d-sm-flex align-items-top border-bottom border-block-end-dashed main-profile-cover p-3">
                <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent me-3 p-2">
                    <img src="{{ asset('assets/images/company-logos/1.png') }}"
                         id="view_supplier_logo"
                         alt="Supplier Logo">
                </span>
                <div class="flex-fill main-profile-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="fw-medium mb-1"
                            id="view_supplier_name"></h6>
                        <button type="button"
                                class="btn-close crm-contact-close-btn"
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <p class="text-muted fs-12 mb-2"
                       id="view_supplier_key_contact"></p>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <div class="mb-0">
                    <p class="fs-15 fw-medium mb-2">Professional Bio :</p>
                    <p class="text-muted mb-0"
                       id="view_supplier_additional_notes"></p>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Contact Information :</p>
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary1-transparent">
                                <i class="ri-mail-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>
                            <span id="view_supplier_email"></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary2-transparent">
                                <i class="ri-phone-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_supplier_phone"></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary3-transparent">
                                <i class="ri-map-pin-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_supplier_address"></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                <i class="ri-tax-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_supplier_gst"></div>
                    </div>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed d-flex align-items-center gap-3 p-3">
                <div class="fs-14 fw-medium">Industry:</div>
                <div id="view_supplier_industry"></div>
            </div>

            <div class="border-bottom border-block-end-dashed d-flex align-items-center gap-3 p-3">
                <div class="fs-14 fw-medium">Company Size:</div>
                <div id="view_supplier_company_size"></div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center gap-3 p-3">
                <div class="fs-14 fw-medium">Business Type:</div>
                <div id="view_supplier_business_type"></div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center gap-3 p-3">
                <div class="fs-14 fw-medium">Delivery Terms:</div>
                <div id="view_supplier_delivery_terms"></div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center gap-3 p-3">
                <div class="fs-14 fw-medium">Payment Terms:</div>
                <div id="view_supplier_payment_terms"></div>
            </div>

            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Website:</p>
                <div id="view_supplier_website"></div>
            </div>

            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Revenue:</p>
                <div id="view_supplier_revenue"></div>
            </div>


            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Social Networks:</p>
                <div class="btn-list mb-0"
                     id="view_supplier_social_links"></div>
            </div>
        </div>
    </div>
    <!-- End:: Supplier Details Offcanvas -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(function() {
            // Setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            // Ensure showToast function exists (using the Toast mixin)
            function showToast(title, message, type = 'info') {
                Toast.fire({ // Use Toast.fire() to trigger the pre-configured toast
                    icon: type, // Dynamically set the icon based on 'type'
                    title: title ? title :
                        message // Use title if provided, otherwise message as title (adjust as needed)
                });
            }

            // Debounce function to limit event firing frequency
            const debounce = (func, delay) => {
                let timer;
                return function(...args) {
                    clearTimeout(timer);
                    timer = setTimeout(() => func.apply(this, args), delay);
                };
            };

            // Handle form submission with AJAX for suppliers
            async function submitSupplierForm(formSelector, buttonSelector, url, successMessage, modalSelector =
                null) {
                const $form = $(formSelector);
                const formData = new FormData($form[0]);

                try {
                    $(buttonSelector).attr('disabled', true).text('Processing...');
                    const response = await $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    });

                    $form[0].reset();
                    supplierDataFetchAll();
                    showToast(successMessage, 'success');
                    if (modalSelector) $(modalSelector).modal('hide');
                } catch (error) {
                    console.error('Error submitting form:', error);
                    showToast('Error!', 'An error occurred.', 'error');
                } finally {
                    $(buttonSelector).attr('disabled', false).text('Submit');
                }
            }

            // Bind events for adding and editing supplier data
            $('#add_supplier_data_form').on('submit', function(e) {
                e.preventDefault();
                submitSupplierForm('#add_supplier_data_form', '#add_supplier_data_btn',
                    '{{ route('supplierstore') }}',
                    'New Supplier added successfully!', '#addSupplierDataModal');
            });

            $('#edit_supplier_data_form').on('submit', function(e) {
                e.preventDefault();
                submitSupplierForm('#edit_supplier_data_form', '#edit_supplier_data_btn',
                    '{{ route('supplierupdate') }}',
                    'Supplier updated successfully!', '#editSupplierDataModal');
            });

            // Edit supplier data modal population
            $(document).on('click', '.EditDataIcon', async function() {
                const id = $(this).attr('id');
                try {
                    const response = await $.ajax({
                        url: '{{ route('supplieredit') }}',
                        method: 'GET',
                        data: {
                            id,
                            _token: '{{ csrf_token() }}'
                        }
                    });

                    $("#supplier_id").val(response.id);
                    $("#edit_supplier_logo").attr('src', response.supplier_profile_picture ? response
                        .supplier_profile_picture :
                        '{{ asset('assets/images/company-logos/1.png') }}');
                    $("#supplier_name").val(response.supplier_name);
                    $("#supplier_mail").val(response.supplier_mail);
                    $("#supplier_phone").val(response.supplier_phone);
                    $("#supplier_gst").val(response.supplier_gst);
                    $("#supplier_key_contact").val(response.key_contact);
                    $("#supplier_industry").val(response.industry);
                    $("#supplier_company_size").val(response.company_size);
                    $("#supplier_address").val(response.supplier_address);
                    $("#supplier_website").val(response.supplier_website);
                    $("#supplier_revenue").val(response.company_revenue);
                    $("#supplier_social_media_links").val(response.social_media_links);
                    $("#supplier_additional_notes").val(response.additional_notes);
                    $("#supplier_payment_terms").val(response.supplier_payment_terms);
                    $("#supplier_delivery_terms").val(response.supplier_delivery_terms);
                    $("#supplier_business_type").val(response.supplier_business_type);

                    $('#editSupplierDataModal').modal('show');
                } catch (error) {
                    console.error('Error fetching Suppliers:', error);
                }
            });

            // View Supplier Data Modal Population
            $(document).on('click', '.ViewDataIcon', async function() {
                const id = $(this).data('id');

                try {
                    const response = await $.ajax({
                        url: `{{ route('supplierview') }}?id=${id}`,
                        method: 'GET',
                    });

                    $('#view_supplier_name').text(response.supplier_name);
                    $('#view_supplier_key_contact').text(response.key_contact);
                    $('#view_supplier_email').text(response.supplier_mail);
                    $('#view_supplier_phone').text(response.supplier_phone);
                    $('#view_supplier_address').text(response.supplier_address);
                    $('#view_supplier_gst').text('GSTIN: ' + response.supplier_gst);
                    $('#view_supplier_additional_notes').text(response.additional_notes);
                    $('#view_supplier_industry').text(response.industry);
                    $('#view_supplier_company_size').text(response.company_size);
                    $('#view_supplier_business_type').text(response.supplier_business_type);
                    $('#view_supplier_delivery_terms').text(response.supplier_delivery_terms);
                    $('#view_supplier_payment_terms').text(response.supplier_payment_terms);
                    $('#view_supplier_website').html(response.supplier_website ?
                        `<a href="${response.supplier_website}" target="_blank">${response.supplier_website}</a>` :
                        'N/A');
                    $('#view_supplier_revenue').text(response.company_revenue ?
                        '₹' + parseInt(response.company_revenue).toLocaleString() :
                        'N/A');


                    // Social Links
                    const socialLinks = response.social_media_links ? response.social_media_links.split(
                        ',') : [];
                    const socialButtons = socialLinks.map(link => {
                        const trimmedLink = link.trim();
                        const icon = trimmedLink.includes('facebook') ? 'facebook' :
                            trimmedLink.includes('twitter') ? 'twitter-x' :
                            trimmedLink.includes('instagram') ? 'instagram' :
                            trimmedLink.includes('linkedin') ? 'linkedin' :
                            'share';

                        if (trimmedLink) {
                            return `
                    <a href="${trimmedLink}" target="_blank" class="btn btn-sm btn-icon btn-primary-light">
                        <i class="ri-${icon}-line"></i>
                    </a>
                `;
                        } else {
                            return '';
                        }
                    }).join('');
                    $('#view_supplier_social_links').html(socialButtons || 'N/A');

                    // Supplier Logo
                    const logoUrl = response.supplier_profile_picture ?
                        `${response.supplier_profile_picture}` :
                        `{{ asset('assets/images/company-logos/1.png') }}`;
                    $('#view_supplier_logo').attr('src', logoUrl);


                    $('#viewSupplierDataModal').offcanvas('show');

                } catch (error) {
                    console.error('Error fetching supplier details:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load supplier details.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });

            // Supplier Delete Functionality
            $(document).on('click', '.DeleteDataIcon', function() {
                const id = $(this).attr('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const response = await $.ajax({
                                url: `{{ url('suppliers') }}/${id}`,
                                method: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                }
                            });

                            supplierDataFetchAll(supplierDateFilterValue);
                            Swal.fire(
                                'Deleted!',
                                'The supplier has been deleted.',
                                'success'
                            );

                        } catch (error) {
                            console.error('Error deleting supplier:', error);
                            Swal.fire(
                                'Error!',
                                'Failed to delete the supplier.',
                                'error'
                            );
                        }
                    }
                });
            });

            // Global variables - keep these!
            let supplierDateFilterValue = 'last_90_days'; // Default value for date filter

            async function supplierDataFetchAll(dateFilter = 'last_90_days') {
                try {
                    supplierDateFilterValue = dateFilter;
                    const response = await $.ajax({
                        url: '{{ route('supplierfetchall') }}',
                        method: 'GET',
                        data: {
                            date_filter: dateFilter
                        }
                    });

                    $('#show_all_fetched_data').html(response);
                    setupSupplierDataTable();
                    $('#date_filter').val(supplierDateFilterValue);
                } catch (error) {
                    console.error('Error fetching data:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to fetch data.',
                        timer: 3000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end',
                        timerProgressBar: true,
                    });
                } finally {}
            }

            // Function to initialize the DataTable for Suppliers
            function setupSupplierDataTable() {
                if ($.fn.DataTable.isDataTable('#data_fetch_table')) {
                    $('#data_fetch_table').DataTable().destroy();
                }

                const dataTable = $('#data_fetch_table').DataTable({
                    processing: true,
                    responsive: true,
                    scrollY: '700px',
                    scrollX: true,
                    scrollCollapse: true,
                    fixedHeader: true,
                    pageLength: 200,
                    lengthMenu: [100, 200, 500, 1000],
                    autoWidth: false,
                    columnDefs: [{
                            orderable: true,
                            targets: 0,
                            width: '20px',
                        },
                        {
                            orderable: false,
                            targets: '_all'
                        }
                    ],
                    language: {
                        search: '_INPUT_',
                        searchPlaceholder: 'Search here...'
                    },
                    initComplete: function() {
                        const api = this.api();
                        const columnUniqueValues = new Map();

                        // Add date filter dropdown to the table length area
                        if (!$('#date_filter').length) {
                            $('#data_fetch_table_length').append(`
                        <select id="date_filter" class="form-control form-select form-select-sm">
                            <option value="all">All</option>
                            <option value="today">Today</option>
                            <option value="this_week">This Week</option>
                            <option value="last_30_days">Last 30 Days</option>
                            <option value="last_90_days">Last 90 Days</option>
                            <option value="six_months">Last 180 Days</option>
                            <option value="this_year">This Year</option>
                        </select>
                    `);

                            $('#date_filter').on('change', debounce(async function() {
                                const dateFilter = $(this).val();
                                await supplierDataFetchAll(dateFilter);
                            }, 300));
                            $('#date_filter').val(supplierDateFilterValue);
                        }


                        api.columns().every(function() {
                            const column = this;
                            if (!column.data().any()) return;

                            if (!columnUniqueValues.has(column.index())) {
                                const uniqueValues = [];
                                column.data().unique().sort().each(function(d) {
                                    const cleanValue = $('<div>').html(d).text();
                                    if (cleanValue && !uniqueValues.includes(
                                            cleanValue)) {
                                        uniqueValues.push(cleanValue);
                                    }
                                });
                                columnUniqueValues.set(column.index(), uniqueValues);
                            }

                            const headerText = $(column.header()).text().trim();
                            const uniqueValues = columnUniqueValues.get(column.index());

                            const selectHtml = $(
                                '<select class="filter-input" multiple="multiple"></select>'
                            );
                            uniqueValues.forEach(value => {
                                selectHtml.append(
                                    `<option value="${value}">${value}</option>`);
                            });

                            $(column.header()).empty().append(selectHtml);
                            selectHtml.select2({
                                placeholder: `Sort ${headerText}`,
                                width: '100%',
                                allowClear: true
                            });

                            let timeout;
                            selectHtml.on('change', function() {
                                clearTimeout(timeout);
                                timeout = setTimeout(() => {
                                    const selectedValues = $(this).val();
                                    const searchString = selectedValues ?
                                        selectedValues.map(value =>
                                            `^${$.fn.dataTable.util.escapeRegex(value)}$`
                                        ).join('|') :
                                        '';
                                    column.search(searchString, true, false)
                                        .draw();
                                }, 300);
                            });
                        });

                        api.on('draw.dt', function() {
                            dataTable.columns.adjust();
                        });
                    }
                });
                dataTable.columns.adjust();
            }


            // Fetch data on page load
            supplierDataFetchAll(supplierDateFilterValue);
        });
    </script>

    <script>
        document.getElementById('exportButton').addEventListener('click', function() {
            // Send a POST request for supplier export
            fetch('{{ route('supplierexport') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json', // Or 'application/x-www-form-urlencoded' if not sending JSON
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Important to include CSRF token for POST requests in Laravel
                    }
                })
                .then(response => response.blob()) // Get response as a blob (binary data)
                .then(blob => {
                    // Create a URL for the blob
                    const url = window.URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download =
                    `supplier_export_${new Date().toLocaleDateString()}.xlsx`; // Suggest a filename
                    document.body.appendChild(a);
                    a.click(); // Programmatically click the link to trigger download
                    a.remove(); // Clean up: remove the link from the DOM
                    window.URL.revokeObjectURL(url); // Release the URL object
                })
                .catch(error => console.error('Export failed:', error));
        });
    </script>
@endsection
