@extends('layouts.app')

@section('content')
    <!-- CSS for enhanced form components -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Add monthSelectPlugin CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tippy.js@6.3.7/dist/tippy.css">
    <style>
        /* Card-based selection styles */
        .card-radio-btn input[type="radio"] {
            display: none;
        }
        .card-radio-btn .card {
            cursor: pointer;
            border: 2px solid #e0e0e0;
            transition: all 0.3s ease;
        }
        .card-radio-btn input[type="radio"]:checked + .card {
            border-color: var(--bs-primary);
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        .card-radio-btn input[type="radio"]:checked + .card .card-body {
            background-color: rgba(var(--bs-primary-rgb), 0.05);
        }
        .card-radio-btn .card-icon {
            font-size: 1.5rem;
            color: var(--bs-primary);
        }

        /* Validation Styles */
        .field-feedback {
            transition: all 0.3s ease;
            font-size: 0.8rem;
        }
        .field-valid {
            border-color: var(--bs-success) !important;
        }
        .field-invalid {
            border-color: var(--bs-danger) !important;
        }

        /* Loading Spinner */
        .overlay-spinner {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255,255,255,0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        /* Dropzone customization */
        .dropzone {
            border: 2px dashed var(--bs-primary);
            border-radius: 5px;
            background: #f8fafc;
        }
        .dropzone .dz-message {
            color: #6c757d;
        }
        .dropzone .dz-preview .dz-progress {
            top: 70%;
        }

        /* Form skeleton loading */
        .skeleton {
            animation: skeleton-loading 1s linear infinite alternate;
        }
        @keyframes skeleton-loading {
            0% { background-color: rgba(var(--bs-light-rgb), 0.7); }
            100% { background-color: rgba(var(--bs-light-rgb), 0.9); }
        }

        /* Success animation */
        @keyframes success-animation {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        .animate-success {
            animation: success-animation 0.5s ease-in-out;
        }
    </style>

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Overall Customers <span
                              class="badge bg-primary text-default fs-12 text-fixed-white ms-2 rounded align-middle"
                              id="customer-count">23</span>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button type="button"
                                class="modal-effect btn btn-white btn-wave"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#addDataModal">
                            <i class="ri-file-add-line lh-1 me-1 align-middle"></i> New
                        </button>

                        <button type="button"
                                class="modal-effect btn btn-primary3 btn-wave me-0"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#importDataModal">
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
                         class="table-responsive position-relative">
                        <!-- Loading state skeleton -->
                        <div class="overlay-spinner d-none" id="table-loading">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->

    <!-- Start:: Company Details Offcanvas -->


    <!-- End:: Company Details Offcanvas -->



    <!-- Add Import From  -->
    <div class="modal fade"
         id="importDataModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="importDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="importDataModal">Import Customers</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="customerimport"
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
                                    class="btn btn-primary">Import Customers</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Export From  -->
    <div class="modal fade"
         id="ExportModel"
         tabindex="-1"
         role="dialog"
         aria-labelledby="ExportModel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="ImportModel">Export Customers</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('customerexport') }}"
                          method="POST">
                        @csrf
                        <label for="from_date">From Date:</label>
                        <input type="date"
                               name="from_date"
                               id="from_date"
                               required>

                        <label for="to_date">To Date:</label>
                        <input type="date"
                               name="to_date"
                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                               id="to_date"
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

    <!-- Start:: Add Company add data modal -->
    <div class="modal fade"
    id="addDataModal"
    tabindex="-1"
    aria-labelledby="addDataModal"
    aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered">
       <div class="modal-content position-relative">
           <!-- Loading overlay -->
           <div class="overlay-spinner d-none" id="form-loading">
               <div class="spinner-border text-primary" role="status">
                   <span class="visually-hidden">Loading...</span>
               </div>
           </div>

           <div class="modal-header">
               <h6 class="modal-title"
                   id="addDataModal">Add Customer</h6>
               <button type="button"
                       class="btn-close"
                       data-bs-dismiss="modal"
                       aria-label="Close"></button>
           </div>
           <div class="modal-body">
               <form action="#"
                     method="POST"
                     id="add_data_form"
                     enctype="multipart/form-data">
                   @csrf
                   <div class="row gy-3">
                       <!-- Company Logo Section - Drag & Drop Upload -->
                       <div class="col-md-6 col-lg-4">
                           <label class="form-label">Company Logo</label>
                           <div class="dropzone" id="company-logo-dropzone">
                               <div class="dz-message">
                                   <i class="ri-upload-cloud-line fs-2 text-primary mb-1"></i>
                                   <p>Drag & drop logo here<br><small class="text-muted">(or click to browse)</small></p>
                               </div>
                               <div class="fallback">
                                   <input type="file" name="company_profile_picture">
                               </div>
                           </div>
                           <div class="preview-container mt-2 text-center d-none">
                               <img src="{{ asset('assets/images/company-logos/8.png') }}"
                                    id="logo-preview"
                                    class="avatar avatar-xl avatar-rounded"
                                    alt="Company Logo">
                           </div>
                       </div>

                       <!-- Company Name -->
                       <div class="col-md-12 col-lg-8">
                           <label for="company-name"
                                  class="form-label">Company Name <span class="text-danger">*</span></label>
                           <div class="input-group has-validation">
                               <input type="text"
                                      class="form-control"
                                      id="company-name"
                                      name="company_name"
                                      value="Srinivasan Fabtech"
                                      placeholder="Enter Company Name"
                                      required
                                      data-validate="true">
                               <div class="invalid-feedback">Please enter a company name</div>
                           </div>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Email -->
                       <div class="col-md-6 col-lg-4">
                           <label for="company-mail"
                                  class="form-label">Email <span class="text-danger">*</span></label>
                           <div class="input-group has-validation">
                               <input type="email"
                                      class="form-control"
                                      id="company-mail"
                                      name="email"
                                      value="contact@sft.com"
                                      placeholder="Enter Email"
                                      required
                                      data-validate="true"
                                      data-validate-pattern="email">
                               <div class="invalid-feedback">Please enter a valid email</div>
                           </div>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Phone -->
                       <div class="col-md-6 col-lg-4">
                           <label for="company-phone"
                                  class="form-label">Phone No <span class="text-danger">*</span></label>
                           <div class="input-group has-validation">
                               <input type="tel"
                                      class="form-control phone-input"
                                      id="company-phone"
                                      name="phone"
                                      value="1234567890"
                                      placeholder="Enter Phone Number"
                                      required
                                      data-validate="true">
                               <div class="invalid-feedback">Please enter a valid phone number</div>
                           </div>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Alternate Phone -->
                       <div class="col-md-6 col-lg-4">
                           <label for="alt-phone"
                                  class="form-label">Alternate Phone</label>
                           <input type="tel"
                                  class="form-control phone-input"
                                  id="alt-phone"
                                  name="alt_phone"
                                  placeholder="Enter Alternate Phone"
                                  data-validate="true">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- GST Number -->
                       <div class="col-md-6 col-lg-4">
                           <label for="company-gst"
                                  class="form-label">
                               GST No
                               <span data-tippy-content="Enter the 15-digit GST Identification Number"
                                     class="badge badge-sm bg-primary-transparent rounded-pill text-primary ms-1">
                                   <i class="ri-information-line"></i>
                               </span>
                           </label>
                           <input type="text"
                                  class="form-control"
                                  id="company-gst"
                                  name="gst_number"
                                  value="27AAAPA1234A1Z5"
                                  placeholder="Enter GST No"
                                  data-validate="true"
                                  data-validate-pattern="gst">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- PAN Number -->
                       <div class="col-md-6 col-lg-4">
                           <label for="company-pan"
                                  class="form-label">
                               PAN No
                               <span data-tippy-content="Enter the 10-digit Permanent Account Number"
                                     class="badge badge-sm bg-primary-transparent rounded-pill text-primary ms-1">
                                   <i class="ri-information-line"></i>
                               </span>
                           </label>
                           <input type="text"
                                  class="form-control"
                                  id="company-pan"
                                  name="pan_number"
                                  placeholder="Enter PAN No"
                                  data-validate="true"
                                  data-validate-pattern="pan">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- TIN Number -->
                       <div class="col-md-6 col-lg-4">
                           <label for="company-tin"
                                  class="form-label">TIN No</label>
                           <input type="text"
                                  class="form-control"
                                  id="company-tin"
                                  name="tin_number"
                                  placeholder="Enter TIN No"
                                  data-validate="true">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- CST Number -->
                       <div class="col-md-6 col-lg-4">
                           <label for="company-cst"
                                  class="form-label">CST No</label>
                           <input type="text"
                                  class="form-control"
                                  id="company-cst"
                                  name="cst_number"
                                  placeholder="Enter CST No"
                                  data-validate="true">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Key Contact -->
                       <div class="col-md-6 col-lg-4">
                           <label for="key-contact"
                                  class="form-label">Key Contact <span class="text-danger">*</span></label>
                           <input type="text"
                                  class="form-control"
                                  id="key-contact"
                                  name="contact_person"
                                  value="Saravana Kumar"
                                  placeholder="Contact Name"
                                  required
                                  data-validate="true">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Industry - Searchable Select -->
                       <div class="col-md-6 col-lg-4">
                           <label for="industry-select" class="form-label">Industry Type</label>
                           <select class="form-select tom-select" id="industry-select" name="industry_type" data-validate="true" placeholder="Select industry...">
                               <option value="">Select industry...</option>
                               <option value="Information Technology">Information Technology</option>
                               <option value="Telecommunications">Telecommunications</option>
                               <option value="Logistics" selected>Logistics</option>
                               <option value="Professional Services">Professional Services</option>
                               <option value="Education">Education</option>
                               <option value="Manufacturing">Manufacturing</option>
                               <option value="Healthcare">Healthcare</option>
                               <option value="Retail">Retail</option>
                               <option value="Financial Services">Financial Services</option>
                               <option value="Construction">Construction</option>
                               <option value="Energy">Energy</option>
                               <option value="Agriculture">Agriculture</option>
                           </select>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Business Type -->
                       <div class="col-md-6 col-lg-4">
                           <label for="business-type" class="form-label">Business Type</label>
                           <select class="form-select" id="business-type" name="business_type" data-validate="true">
                               <option value="">Select business type...</option>
                               <option value="manufacturer">Manufacturer</option>
                               <option value="distributor">Distributor</option>
                               <option value="retailer">Retailer</option>
                               <option value="wholesaler">Wholesaler</option>
                               <option value="importer">Importer</option>
                               <option value="exporter">Exporter</option>
                           </select>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Customer Group -->
                       <div class="col-md-6 col-lg-4">
                           <label for="customer-group" class="form-label">Customer Group</label>
                           <select class="form-select" id="customer-group" name="customer_group" data-validate="true">
                               <option value="">Select customer group...</option>
                               <option value="retail">Retail</option>
                               <option value="wholesale">Wholesale</option>
                               <option value="corporate" selected>Corporate</option>
                               <option value="government">Government</option>
                           </select>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Company Size - Card-based Selection -->
                       <div class="col-md-12 col-lg-12">
                           <label class="form-label">Company Size <span class="text-danger">*</span></label>
                           <div class="row g-3 card-radio-btn">
                               <div class="col-md-4 col-lg-2">
                                   <input type="radio" class="btn-check" name="company_size" id="size-startup" value="Startup">
                                   <label class="card h-100 text-center p-2" for="size-startup">
                                       <div class="card-body p-2">
                                           <div class="card-icon mb-1">
                                               <i class="ri-rocket-line"></i>
                                           </div>
                                           <h6 class="mb-0 fs-13">Startup</h6>
                                           <small class="text-muted">1-10 employees</small>
                                       </div>
                                   </label>
                               </div>
                               <div class="col-md-4 col-lg-2">
                                   <input type="radio" class="btn-check" name="company_size" id="size-micro" value="Micro Business">
                                   <label class="card h-100 text-center p-2" for="size-micro">
                                       <div class="card-body p-2">
                                           <div class="card-icon mb-1">
                                               <i class="ri-home-4-line"></i>
                                           </div>
                                           <h6 class="mb-0 fs-13">Micro</h6>
                                           <small class="text-muted">11-50 employees</small>
                                       </div>
                                   </label>
                               </div>
                               <div class="col-md-4 col-lg-2">
                                   <input type="radio" class="btn-check" name="company_size" id="size-small" value="Small Business">
                                   <label class="card h-100 text-center p-2" for="size-small">
                                       <div class="card-body p-2">
                                           <div class="card-icon mb-1">
                                               <i class="ri-store-2-line"></i>
                                           </div>
                                           <h6 class="mb-0 fs-13">Small</h6>
                                           <small class="text-muted">51-200 employees</small>
                                       </div>
                                   </label>
                               </div>
                               <div class="col-md-4 col-lg-2">
                                   <input type="radio" class="btn-check" name="company_size" id="size-medium" value="Medium Size">
                                   <label class="card h-100 text-center p-2" for="size-medium">
                                       <div class="card-body p-2">
                                           <div class="card-icon mb-1">
                                               <i class="ri-building-2-line"></i>
                                           </div>
                                           <h6 class="mb-0 fs-13">Medium</h6>
                                           <small class="text-muted">201-500 employees</small>
                                       </div>
                                   </label>
                               </div>
                               <div class="col-md-4 col-lg-2">
                                   <input type="radio" class="btn-check" name="company_size" id="size-corporate" value="Corporate" checked>
                                   <label class="card h-100 text-center p-2" for="size-corporate">
                                       <div class="card-body p-2">
                                           <div class="card-icon mb-1">
                                               <i class="ri-building-4-line"></i>
                                           </div>
                                           <h6 class="mb-0 fs-13">Corporate</h6>
                                           <small class="text-muted">501-1000 employees</small>
                                       </div>
                                   </label>
                               </div>
                               <div class="col-md-4 col-lg-2">
                                   <input type="radio" class="btn-check" name="company_size" id="size-enterprise" value="Large Enterprise">
                                   <label class="card h-100 text-center p-2" for="size-enterprise">
                                       <div class="card-body p-2">
                                           <div class="card-icon mb-1">
                                               <i class="ri-building-line"></i>
                                           </div>
                                           <h6 class="mb-0 fs-13">Enterprise</h6>
                                           <small class="text-muted">1000+ employees</small>
                                       </div>
                                   </label>
                               </div>
                           </div>
                           <div class="form-text field-feedback mt-2"></div>
                       </div>

                       <!-- Address - Smart Address with Autocomplete -->
                       <div class="col-md-12 col-lg-6">
                           <label for="company-address"
                                  class="form-label">Address</label>
                           <input type="text"
                                  class="form-control address-autocomplete"
                                  id="company-address"
                                  name="address"
                                  value="123 Tech Avenue, Tamilnadu"
                                  placeholder="Start typing your address"
                                  data-validate="true">
                           <div class="mt-2">
                               <div class="row g-2">
                                   <div class="col-md-4">
                                       <input type="text" class="form-control" id="address-city" name="city" value="hosur" placeholder="City">
                                   </div>
                                   <div class="col-md-4">
                                       <input type="text" class="form-control" id="address-state" name="state" value="Tamilnadu" placeholder="State">
                                   </div>
                                   <div class="col-md-4">
                                       <input type="text" class="form-control" id="address-country" name="country" value="India" placeholder="Country">
                                   </div>
                               </div>
                               <div class="row g-2 mt-2">
                                   <div class="col-md-6">
                                       <input type="text" class="form-control" id="address-pincode" name="pincode" placeholder="Pincode">
                                   </div>
                               </div>
                           </div>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Website -->
                       <div class="col-md-6 col-lg-3">
                           <label for="company-website"
                                  class="form-label">Website</label>
                           <input type="url"
                                  class="form-control"
                                  id="company-website"
                                  name="website"
                                  value="https://www.sft.com"
                                  placeholder="Enter Website URL"
                                  data-validate="true"
                                  data-validate-pattern="url">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Credit Limit -->
                       <div class="col-md-6 col-lg-3">
                           <label for="company-credit-limit"
                                  class="form-label">Credit Limit</label>
                           <div class="input-group">
                               <span class="input-group-text">₹</span>
                               <input type="text"
                                      class="form-control currency-input"
                                      id="company-credit-limit"
                                      name="credit_limit"
                                      value="10000000"
                                      placeholder="Credit Limit"
                                      data-validate="true">
                           </div>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Payment Terms -->
                       <div class="col-md-6 col-lg-3">
                           <label for="payment-terms" class="form-label">Payment Terms</label>
                           <select class="form-select" id="payment-terms" name="payment_terms" data-validate="true">
                               <option value="">Select payment terms...</option>
                               <option value="advance">Advance</option>
                               <option value="15_days">15 Days</option>
                               <option value="30_days" selected>30 Days</option>
                               <option value="45_days">45 Days</option>
                               <option value="60_days">60 Days</option>
                           </select>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Year Established - Date Picker -->
                       <div class="col-md-6 col-lg-3">
                           <label for="company-year-established"
                                  class="form-label">Year Established</label>
                           <input type="text"
                                  class="form-control year-picker"
                                  id="company-year-established"
                                  name="metadata[year_established]"
                                  value="2005"
                                  placeholder="Select Year"
                                  data-validate="true">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Status -->
                       <div class="col-md-6 col-lg-3">
                           <label for="customer-status" class="form-label">Status</label>
                           <select class="form-select" id="customer-status" name="status" data-validate="true">
                               <option value="active" selected>Active</option>
                               <option value="inactive">Inactive</option>
                               <option value="blacklisted">Blacklisted</option>
                           </select>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Tax Registration Number -->
                       <div class="col-md-6 col-lg-3">
                           <label for="tax-reg-number"
                                  class="form-label">Tax Registration No</label>
                           <input type="text"
                                  class="form-control"
                                  id="tax-reg-number"
                                  name="tax_registration_number"
                                  placeholder="Enter Tax Registration No"
                                  data-validate="true">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Tax Exemption Number -->
                       <div class="col-md-6 col-lg-3">
                           <label for="tax-exempt-number"
                                  class="form-label">Tax Exemption No</label>
                           <input type="text"
                                  class="form-control"
                                  id="tax-exempt-number"
                                  name="tax_exemption_number"
                                  placeholder="Enter Tax Exemption No"
                                  data-validate="true">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Sales Person -->
                       <div class="col-md-6 col-lg-3">
                           <label for="sales-person" class="form-label">Sales Person</label>
                           <select class="form-select tom-select" id="sales-person" name="sales_person_id" data-validate="true">
                               <option value="">Select sales person...</option>
                               <!-- This would be populated dynamically -->
                           </select>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Branch -->
                       <div class="col-md-6 col-lg-3">
                           <label for="branch" class="form-label">Branch</label>
                           <select class="form-select tom-select" id="branch" name="branch_id" data-validate="true">
                               <option value="">Select branch...</option>
                               <!-- This would be populated dynamically -->
                           </select>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Social Media Links - Tag Input -->
                       <div class="col-md-6 col-lg-6">
                           <label for="social-media-links"
                                  class="form-label">Social Media Links</label>
                           <input type="text"
                                  class="form-control tag-input"
                                  id="social-media-links"
                                  name="preferences[social_media]"
                                  value="[https://facebook.com/sft, https://twitter.com/sft]"
                                  placeholder="Add social media links"
                                  data-validate="true">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Bank Details -->
                       <div class="col-md-12">
                           <label class="form-label">Bank Account Details</label>
                           <div class="row g-2">
                               <div class="col-md-4">
                                   <input type="text"
                                          class="form-control"
                                          name="bank_details[bank_name]"
                                          placeholder="Bank Name"
                                          data-validate="true">
                               </div>
                               <div class="col-md-4">
                                   <input type="text"
                                          class="form-control"
                                          name="bank_details[account_number]"
                                          placeholder="Account Number"
                                          data-validate="true">
                               </div>
                               <div class="col-md-4">
                                   <input type="text"
                                          class="form-control"
                                          name="bank_details[ifsc_code]"
                                          placeholder="IFSC Code"
                                          data-validate="true">
                               </div>
                           </div>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Additional Notes -->
                       <div class="col-md-12">
                           <label for="additional-notes"
                                  class="form-label">Additional Notes</label>
                           <textarea class="form-control"
                                     id="additional-notes"
                                     name="notes"
                                     rows="3"
                                     placeholder="Enter any additional notes"
                                     data-validate="true">Leading provider of packaging solutions for various industries.</textarea>
                           <div class="form-text field-feedback"></div>
                           <div class="d-flex justify-content-between mt-1">
                               <small class="text-muted" id="notes-character-count">0/500 characters</small>
                               <small class="text-muted" id="notes-save-status">Saved</small>
                           </div>
                       </div>
                   </div>
           </div>
           <div class="modal-footer">
               <button type="button"
                       class="btn btn-light"
                       data-bs-dismiss="modal">Cancel</button>
               <button type="submit"
                       id="add_data_btn"
                       class="btn btn-primary position-relative">
                   <span>Create Company</span>
                   <span class="btn-loader d-none">
                       <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                   </span>
               </button>
           </div>
           </form>
       </div>
   </div>
</div>
    <!-- Start:: EDIT Company data modal -->
    <div class="modal fade"
         id="editDataModal"
         tabindex="-1"
         aria-labelledby="editDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content position-relative">
                <!-- Loading overlay -->
                <div class="overlay-spinner d-none" id="edit-form-loading">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>

                <div class="modal-header">
                    <h6 class="modal-title"
                        id="editDataModal">Edit Customer</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="edit_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden"
                               name="customer_id"
                               id="customer_id">
                        <div class="row gy-3">
                            <!-- Company Logo Section - Drag & Drop Upload -->
                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Company Logo</label>
                                <div class="dropzone" id="edit-company-logo-dropzone">
                                    <div class="dz-message">
                                        <i class="ri-upload-cloud-line fs-2 text-primary mb-1"></i>
                                        <p>Drag & drop logo here<br><small class="text-muted">(or click to browse)</small></p>
                                    </div>
                                    <div class="fallback">
                                        <input type="file" name="company_profile_picture">
                                    </div>
                                </div>
                                <div class="preview-container mt-2 text-center">
                                    <img src="{{ asset('assets/images/company-logos/8.png') }}"
                                         id="edit_company_logo"
                                         class="avatar avatar-xl avatar-rounded"
                                         alt="Company Logo">
                                </div>
                            </div>

                            <!-- Company Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="company_name"
                                       class="form-label">Company Name <span class="text-danger">*</span></label>
                                <div class="input-group has-validation">
                                    <input type="text"
                                           class="form-control"
                                           name="company_name"
                                           id="company_name"
                                           value=""
                                           placeholder="Enter Company Name"
                                           required
                                           data-validate="true">
                                    <div class="invalid-feedback">Please enter a company name</div>
                                </div>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 col-lg-4">
                                <label for="company_mail"
                                       class="form-label">Email <span class="text-danger">*</span></label>
                                <div class="input-group has-validation">
                                    <input type="email"
                                           class="form-control"
                                           name="company_mail"
                                           id="company_mail"
                                           value=""
                                           placeholder="Enter Email"
                                           required
                                           data-validate="true"
                                           data-validate-pattern="email">
                                    <div class="invalid-feedback">Please enter a valid email</div>
                                </div>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6 col-lg-4">
                                <label for="company_phone"
                                       class="form-label">Phone No <span class="text-danger">*</span></label>
                                <div class="input-group has-validation">
                                    <input type="tel"
                                           class="form-control phone-input"
                                           name="company_phone"
                                           id="company_phone"
                                           value=""
                                           placeholder="Enter Phone Number"
                                           required
                                           data-validate="true">
                                    <div class="invalid-feedback">Please enter a valid phone number</div>
                                </div>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Alternate Phone -->
                            <div class="col-md-6 col-lg-4">
                                <label for="alt_phone"
                                       class="form-label">Alternate Phone</label>
                                <input type="tel"
                                       class="form-control phone-input"
                                       name="alt_phone"
                                       id="alt_phone"
                                       value=""
                                       placeholder="Enter Alternate Phone"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- GST Number -->
                            <div class="col-md-6 col-lg-4">
                                <label for="company_gst"
                                       class="form-label">
                                    GST No
                                    <span data-tippy-content="Enter the 15-digit GST Identification Number"
                                          class="badge badge-sm bg-primary-transparent rounded-pill text-primary ms-1">
                                        <i class="ri-information-line"></i>
                                    </span>
                                </label>
                                <input type="text"
                                       class="form-control"
                                       name="company_gst"
                                       id="company_gst"
                                       value=""
                                       placeholder="Enter GST No"
                                       data-validate="true"
                                       data-validate-pattern="gst">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- PAN Number -->
                            <div class="col-md-6 col-lg-4">
                                <label for="pan_number"
                                       class="form-label">
                                    PAN No
                                    <span data-tippy-content="Enter the 10-digit Permanent Account Number"
                                          class="badge badge-sm bg-primary-transparent rounded-pill text-primary ms-1">
                                        <i class="ri-information-line"></i>
                                    </span>
                                </label>
                                <input type="text"
                                       class="form-control"
                                       name="pan_number"
                                       id="pan_number"
                                       value=""
                                       placeholder="Enter PAN No"
                                       data-validate="true"
                                       data-validate-pattern="pan">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- TIN Number -->
                            <div class="col-md-6 col-lg-4">
                                <label for="tin_number"
                                       class="form-label">TIN No</label>
                                <input type="text"
                                       class="form-control"
                                       name="tin_number"
                                       id="tin_number"
                                       value=""
                                       placeholder="Enter TIN No"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- CST Number -->
                            <div class="col-md-6 col-lg-4">
                                <label for="cst_number"
                                       class="form-label">CST No</label>
                                <input type="text"
                                       class="form-control"
                                       name="cst_number"
                                       id="cst_number"
                                       value=""
                                       placeholder="Enter CST No"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Key Contact -->
                            <div class="col-md-6 col-lg-4">
                                <label for="key_contact"
                                       class="form-label">Key Contact <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       name="key_contact"
                                       id="key_contact"
                                       value=""
                                       placeholder="Contact Name"
                                       required
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Industry - Searchable Select -->
                            <div class="col-md-6 col-lg-4">
                                <label for="industry_edit" class="form-label">Industry <span class="text-danger">*</span></label>
                                <select class="form-select tom-select"
                                        name="industry"
                                        id="industry_edit"
                                        required
                                        data-validate="true"
                                        placeholder="Select industry...">
                                    <option value="">Select industry...</option>
                                    <option value="Information Technology">Information Technology</option>
                                    <option value="Telecommunications">Telecommunications</option>
                                    <option value="Logistics">Logistics</option>
                                    <option value="Professional Services">Professional Services</option>
                                    <option value="Education">Education</option>
                                    <option value="Manufacturing">Manufacturing</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="Retail">Retail</option>
                                    <option value="Financial Services">Financial Services</option>
                                    <option value="Construction">Construction</option>
                                    <option value="Energy">Energy</option>
                                    <option value="Agriculture">Agriculture</option>
                                </select>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Business Type -->
                            <div class="col-md-6 col-lg-4">
                                <label for="business_type" class="form-label">Business Type</label>
                                <select class="form-select" id="business_type" name="business_type" data-validate="true">
                                    <option value="">Select business type...</option>
                                    <option value="manufacturer">Manufacturer</option>
                                    <option value="distributor">Distributor</option>
                                    <option value="retailer">Retailer</option>
                                    <option value="wholesaler">Wholesaler</option>
                                    <option value="importer">Importer</option>
                                    <option value="exporter">Exporter</option>
                                </select>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Customer Group -->
                            <div class="col-md-6 col-lg-4">
                            <div class="col-md-6 col-lg-3">
                                <label for="customer_group" class="form-label">Customer Group</label>
                                <select class="form-select" id="customer_group" name="customer_group" data-validate="true">
                                    <option value="">Select customer group...</option>
                                    <option value="retail">Retail</option>
                                    <option value="wholesale">Wholesale</option>
                                    <option value="corporate">Corporate</option>
                                    <option value="government">Government</option>
                                </select>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6 col-lg-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" data-validate="true">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="blacklisted">Blacklisted</option>
                                </select>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Tax Registration Number -->
                            <div class="col-md-6 col-lg-3">
                                <label for="tax_registration_number"
                                       class="form-label">Tax Registration No</label>
                                <input type="text"
                                       class="form-control"
                                       id="tax_registration_number"
                                       name="tax_registration_number"
                                       placeholder="Enter Tax Registration No"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Tax Exemption Number -->
                            <div class="col-md-6 col-lg-3">
                                <label for="tax_exemption_number"
                                       class="form-label">Tax Exemption No</label>
                                <input type="text"
                                       class="form-control"
                                       id="tax_exemption_number"
                                       name="tax_exemption_number"
                                       placeholder="Enter Tax Exemption No"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Sales Person -->
                            <div class="col-md-6 col-lg-3">
                                <label for="sales_person_id" class="form-label">Sales Person</label>
                                <select class="form-select tom-select" id="sales_person_id" name="sales_person_id" data-validate="true">
                                    <option value="">Select sales person...</option>
                                    <!-- This would be populated dynamically -->
                                </select>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Branch -->
                            <div class="col-md-6 col-lg-3">
                                <label for="branch_id" class="form-label">Branch</label>
                                <select class="form-select tom-select" id="branch_id" name="branch_id" data-validate="true">
                                    <option value="">Select branch...</option>
                                    <!-- This would be populated dynamically -->
                                </select>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Year Established - Date Picker -->
                            <div class="col-md-6 col-lg-3">
                                <label for="company_year_established"
                                       class="form-label">Year Established</label>
                                <input type="text"
                                       class="form-control year-picker"
                                       name="metadata[year_established]"
                                       id="company_year_established"
                                       value=""
                                       placeholder="Select Year"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Bank Details -->
                            <div class="col-md-12">
                                <label class="form-label">Bank Details</label>
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <input type="text"
                                               class="form-control"
                                               name="bank_details[bank_name]"
                                               id="bank_name"
                                               placeholder="Bank Name"
                                               data-validate="true">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text"
                                               class="form-control"
                                               name="bank_details[account_number]"
                                               id="account_number"
                                               placeholder="Account Number"
                                               data-validate="true">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text"
                                               class="form-control"
                                               name="bank_details[ifsc_code]"
                                               id="ifsc_code"
                                               placeholder="IFSC Code"
                                               data-validate="true">
                                    </div>
                                </div>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Social Media Links - Tag Input -->
                            <div class="col-md-6 col-lg-6">
                                <label for="social_media_links"
                                       class="form-label">Social Media Links</label>
                                <input type="text"
                                       class="form-control tag-input"
                                       name="preferences[social_media]"
                                       id="social_media_links"
                                       value=""
                                       placeholder="Add social media links"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Additional Notes -->
                            <div class="col-md-12">
                                <label for="additional_notes"
                                       class="form-label">Additional Notes</label>
                                <textarea class="form-control"
                                          name="notes"
                                          id="additional_notes"
                                          rows="3"
                                          placeholder="Enter any additional notes"
                                          data-validate="true"></textarea>
                                <div class="form-text field-feedback"></div>
                                <div class="d-flex justify-content-between mt-1">
                                    <small class="text-muted" id="edit-notes-character-count">0/500 characters</small>
                                    <small class="text-muted" id="edit-notes-save-status">Saved</small>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="edit_data_btn"
                            class="btn btn-primary position-relative">
                        <span>Update Company</span>
                        <span class="btn-loader d-none">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </span>
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- End:: Add Company -->


    <!-- Start:: Company Details Offcanvas -->
    <div class="offcanvas offcanvas-end"
         tabindex="-1"
         id="viewDataModal"
         aria-labelledby="viewDataModalLabel">

        <div class="offcanvas-header">
            <h5 id="viewDataModalLabel"
                class="offcanvas-title">Customer Details</h5>

        </div>
        <div class="offcanvas-body p-0">
            <div class="d-sm-flex align-items-top border-bottom border-block-end-dashed main-profile-cover p-3">
                <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent me-3 p-2">
                    <img src="{{ asset('assets/images/company-logos/1.png') }}"
                         id="view_company_logo"
                         alt="Company Logo">
                </span>
                <div class="flex-fill main-profile-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="fw-medium mb-1"
                            id="view_company_name"></h6>
                        <button type="button"
                                class="btn-close crm-contact-close-btn"
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <p class="text-muted fs-12 mb-2"
                       id="view_key_contact"></p>
                    <span class="badge bg-success-transparent mb-1" id="view_status">Active</span>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <div class="mb-0">
                    <p class="fs-15 fw-medium mb-2">Professional Bio :</p>
                    <p class="text-muted mb-0"
                       id="view_additional_notes"></p>
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
                            <span id="view_company_email"></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary2-transparent">
                                <i class="ri-phone-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_company_phone"></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary2-transparent">
                                <i class="ri-phone-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_alt_phone">N/A</div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary3-transparent">
                                <i class="ri-map-pin-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_company_address"></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary3-transparent">
                                <i class="ri-map-pin-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>
                            <span id="view_city">City</span>,
                            <span id="view_state">State</span>,
                            <span id="view_country">Country</span> -
                            <span id="view_pincode">Pincode</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                <i class="ri-tax-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_company_gst"></div>
                    </div>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Tax Information :</p>
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                <i class="ri-file-list-3-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>PAN: <span id="view_pan_number">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                <i class="ri-file-list-3-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>TIN: <span id="view_tin_number">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                <i class="ri-file-list-3-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>CST: <span id="view_cst_number">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                <i class="ri-file-list-3-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>Tax Registration: <span id="view_tax_registration_number">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                <i class="ri-file-list-3-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>Tax Exemption: <span id="view_tax_exemption_number">N/A</span></div>
                    </div>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Business Information :</p>
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                                <i class="ri-building-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>Industry: <span id="view_industry">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                                <i class="ri-store-2-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>Business Type: <span id="view_business_type">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                                <i class="ri-user-star-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>Customer Group: <span id="view_customer_group">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                                <i class="ri-team-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>Company Size: <span id="view_company_size">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                                <i class="ri-global-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>Website: <span id="view_company_website">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                                <i class="ri-calendar-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>Year Established: <span id="view_company_year">N/A</span></div>
                    </div>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Financial Information :</p>
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-info-transparent">
                                <i class="ri-money-dollar-circle-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>Credit Limit: <span id="view_credit_limit">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-info-transparent">
                                <i class="ri-time-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>Payment Terms: <span id="view_payment_terms">N/A</span></div>
                    </div>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Bank Details :</p>
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-purple-transparent">
                                <i class="ri-bank-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>Bank Name: <span id="view_bank_name">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-purple-transparent">
                                <i class="ri-bank-card-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>Account Number: <span id="view_account_number">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-purple-transparent">
                                <i class="ri-bank-card-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>IFSC Code: <span id="view_ifsc_code">N/A</span></div>
                    </div>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Social Media :</p>
                <div id="view_social_links" class="d-flex gap-1 mb-2">
                    <!-- Social links will be populated here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include customer-specific enhancements -->
    <script src="{{ asset('assets/js/customer-enhancements.js') }}"></script>
<!-- Customer form component initialization and functionality -->
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
                timer: 5000, // Increased timer for better readability
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            // Enhanced showToast function with more detailed information
            function showToast(title, message, type = 'info') {
                const iconMap = {
                    success: 'success',
                    error: 'error',
                    warning: 'warning',
                    info: 'info'
                };

                Toast.fire({
                    icon: iconMap[type] || 'info',
                    title: title,
                    text: message,
                    className: `toast-${type}`,
                    customClass: {
                        popup: 'colored-toast'
                    }
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

            // Handle form submission with AJAX
            async function submitForm(formSelector, buttonSelector, url, successMessage, modalSelector = null) {
                const $form = $(formSelector);
                const formData = new FormData($form[0]);

                // Process JSON fields
                const jsonFields = ['bank_details', 'preferences', 'metadata', 'documents'];
                jsonFields.forEach(field => {
                    const fieldInputs = {};
                    $form.find(`[name^="${field}["]`).each(function() {
                        const inputName = $(this).attr('name');
                        const key = inputName.match(/\[(.*?)\]/)[1];
                        fieldInputs[key] = $(this).val();
                    });

                    if (Object.keys(fieldInputs).length > 0) {
                        formData.set(field, JSON.stringify(fieldInputs));
                    }
                });

                try {
                    $(buttonSelector).attr('disabled', true)
                        .find('span:first').text('Processing...');

                    const response = await $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    });

                    $form[0].reset();
                    dataFetchAll();

                    // Enhanced success message
                    showToast(
                        'Success!',
                        successMessage,
                        'success'
                    );

                    if (modalSelector) $(modalSelector).modal('hide');
                } catch (error) {
                    console.error('Error submitting form:', error);

                    // Enhanced error message with details
                    let errorMessage = 'An error occurred while processing your request.';
                    if (error.responseJSON && error.responseJSON.message) {
                        errorMessage = error.responseJSON.message;
                    }
                    if (error.responseJSON && error.responseJSON.errors) {
                        errorMessage += '\n' + Object.values(error.responseJSON.errors).flat().join('\n');
                    }

                    showToast(
                        'Error!',
                        errorMessage,
                        'error'
                    );
                } finally {
                    $(buttonSelector).attr('disabled', false)
                        .find('span:first').text('Submit');
                }
            }

            // Bind events for adding and editing data
            $('#add_data_form').on('submit', function(e) {
                e.preventDefault();
                submitForm('#add_data_form', '#add_data_btn', '{{ route('customerstore') }}',
                    'New Customer added successfully!', '#addDataModal');
            });

            $('#edit_data_form').on('submit', function(e) {
                e.preventDefault();
                submitForm('#edit_data_form', '#edit_data_btn', '{{ route('customerupdate') }}',
                    'Customer updated successfully!', '#editDataModal');
            });

            // Edit data modal population
            $(document).on('click', '.EditDataIcon', async function() {
                const id = $(this).attr('id');
                try {
                    const response = await $.ajax({
                        url: '{{ route('customeredit') }}',
                        method: 'GET',
                        data: {
                            id,
                            _token: '{{ csrf_token() }}'
                        }
                    });

                    $("#customer_id").val(response.id);
                    $("#customer_unique_code").val(response.customer_unique_code);
                    $("#edit_company_profile_picture").val(response.company_profile_picture);

                    $("#company_name").val(response.company_name);
                    $("#company_mail").val(response.email);
                    $("#company_phone").val(response.phone);
                    $("#alt_phone").val(response.alt_phone);
                    $("#company_gst").val(response.gst_number);
                    $("#pan_number").val(response.pan_number);
                    $("#tin_number").val(response.tin_number);
                    $("#cst_number").val(response.cst_number);
                    $("#key_contact").val(response.contact_person);
                    $("#industry_edit").val(response.industry_type);
                    $("#business_type").val(response.business_type);
                    $("#customer_group").val(response.customer_group);
                    $("#status").val(response.status);

                    // Address fields
                    $("#company_address").val(response.address);
                    $("#edit-address-city").val(response.city);
                    $("#edit-address-state").val(response.state);
                    $("#edit-address-country").val(response.country);
                    $("#edit-address-pincode").val(response.pincode);

                    $("#company_website").val(response.website);
                    $("#credit_limit").val(response.credit_limit);
                    $("#payment_terms").val(response.payment_terms);
                    $("#tax_registration_number").val(response.tax_registration_number);
                    $("#tax_exemption_number").val(response.tax_exemption_number);
                    $("#sales_person_id").val(response.sales_person_id);
                    $("#branch_id").val(response.branch_id);

                    // Company size radio buttons
                    $(`input[name="company_size"][value="${response.company_size}"]`).prop('checked', true);

                    // Bank details
                    if (response.bank_details) {
                        const bankDetails = typeof response.bank_details === 'string'
                            ? JSON.parse(response.bank_details)
                            : response.bank_details;

                        $("#bank_name").val(bankDetails.bank_name || '');
                        $("#account_number").val(bankDetails.account_number || '');
                        $("#ifsc_code").val(bankDetails.ifsc_code || '');
                    }

                    // Metadata
                    if (response.metadata) {
                        const metadata = typeof response.metadata === 'string'
                            ? JSON.parse(response.metadata)
                            : response.metadata;

                        $("#company_year_established").val(metadata.year_established || '');
                    }

                    // Preferences
                    if (response.preferences) {
                        const preferences = typeof response.preferences === 'string'
                            ? JSON.parse(response.preferences)
                            : response.preferences;

                        if (preferences.social_media) {
                            $("#social_media_links").val(
                                Array.isArray(preferences.social_media)
                                    ? preferences.social_media.join(',')
                                    : preferences.social_media
                            );
                        }
                    }

                    $("#additional_notes").val(response.notes);

                    // Company Logo (already correct)
                    const logoUrl = response.company_profile_picture ?
                        `${response.company_profile_picture}` :
                        `{{ asset('assets/images/company-logos/1.png') }}`;

                    $('#edit_company_logo').attr('src', logoUrl);

                    $('#editDataModal').modal('show');
                } catch (error) {
                    console.error('Error fetching Customers:', error);
                }
            });



            // View Data Modal Population (CORRECTED)
            $(document).on('click', '.ViewDataIcon', async function() {

                const id = $(this).data('id'); // Corrected: Use .data('id')

                try {
                    const response = await $.ajax({
                        url: `{{ route('customerview') }}?id=${id}`, // Corrected: Pass ID in URL
                        method: 'GET',
                        // data: {  // data is now in the URL
                        //     _token: '{{ csrf_token() }}' // No longer needed
                        // }
                    });

                    // Populate Company Details (This section should be correct)
                    $('#view_company_name').text(response.company_name);
                    $('#view_key_contact').text(response.contact_person);
                    $('#view_company_email').text(response.email);
                    $('#view_company_phone').text(response.phone);
                    $('#view_alt_phone').text(response.alt_phone || 'N/A');
                    $('#view_company_address').text(response.address);
                    $('#view_city').text(response.city || 'N/A');
                    $('#view_state').text(response.state || 'N/A');
                    $('#view_country').text(response.country || 'N/A');
                    $('#view_pincode').text(response.pincode || 'N/A');
                    $('#view_company_gst').text(response.gst_number ? 'GSTIN: ' + response.gst_number : 'N/A');
                    $('#view_pan_number').text(response.pan_number || 'N/A');
                    $('#view_tin_number').text(response.tin_number || 'N/A');
                    $('#view_cst_number').text(response.cst_number || 'N/A');
                    $('#view_tax_registration_number').text(response.tax_registration_number || 'N/A');
                    $('#view_tax_exemption_number').text(response.tax_exemption_number || 'N/A');
                    $('#view_additional_notes').text(response.notes || 'N/A');
                    $('#view_industry').text(response.industry_type || 'N/A');
                    $('#view_business_type').text(response.business_type ? response.business_type.charAt(0).toUpperCase() + response.business_type.slice(1) : 'N/A');
                    $('#view_customer_group').text(response.customer_group ? response.customer_group.charAt(0).toUpperCase() + response.customer_group.slice(1) : 'N/A');
                    $('#view_status').text(response.status ? response.status.charAt(0).toUpperCase() + response.status.slice(1) : 'Active');
                    $('#view_company_size').text(response.company_size || 'N/A');
                    $('#view_company_website').html(response.website ?
                        `<a href="${response.website}" target="_blank">${response.website}</a>` :
                        'N/A');
                    $('#view_credit_limit').text(response.credit_limit ?
                        '₹' + parseFloat(response.credit_limit).toLocaleString() :
                        'N/A');
                    $('#view_payment_terms').text(response.payment_terms ?
                        response.payment_terms.replace('_', ' ').charAt(0).toUpperCase() + response.payment_terms.replace('_', ' ').slice(1) :
                        'N/A');

                    // Bank Details
                    if (response.bank_details) {
                        const bankDetails = typeof response.bank_details === 'string'
                            ? JSON.parse(response.bank_details)
                            : response.bank_details;

                        $('#view_bank_name').text(bankDetails.bank_name || 'N/A');
                        $('#view_account_number').text(bankDetails.account_number || 'N/A');
                        $('#view_ifsc_code').text(bankDetails.ifsc_code || 'N/A');
                    } else {
                        $('#view_bank_name').text('N/A');
                        $('#view_account_number').text('N/A');
                        $('#view_ifsc_code').text('N/A');
                    }

                    // Metadata
                    if (response.metadata) {
                        const metadata = typeof response.metadata === 'string'
                            ? JSON.parse(response.metadata)
                            : response.metadata;

                        $('#view_company_year').text(metadata.year_established || 'N/A');
                    } else {
                        $('#view_company_year').text('N/A');
                    }

                    // Social Links (already correct)
                    const socialLinks = response.preferences && response.preferences.social_media ?
                        (typeof response.preferences.social_media === 'string' ?
                            response.preferences.social_media.split(',') :
                            response.preferences.social_media) :
                        [];

                    const socialButtons = socialLinks.map(link => {
                        const trimmedLink = link.trim(); // Trim whitespace
                        const icon = trimmedLink.includes('facebook') ? 'facebook' :
                            trimmedLink.includes('twitter') ? 'twitter-x' :
                            trimmedLink.includes('instagram') ? 'instagram' :
                            trimmedLink.includes('linkedin') ? 'linkedin' :
                            'share'; // Default icon

                        // Check if link is valid before creating the 'a' element
                        if (trimmedLink) {
                            return `
                    <a href="${trimmedLink}" target="_blank" class="btn btn-sm btn-icon btn-primary-light">
                        <i class="ri-${icon}-line"></i>
                    </a>
                `;
                        } else {
                            return ''; // Return empty string if link is empty
                        }
                    }).join('');
                    $('#view_social_links').html(socialButtons || 'N/A');

                    // Company Logo (already correct)
                    const logoUrl = response.company_profile_picture ?
                        `${response.company_profile_picture}` :
                        `{{ asset('assets/images/company-logos/1.png') }}`;

                    $('#view_company_logo').attr('src', logoUrl);


                    // Make *sure* this offcanvas('show') is *after* all the above.  Correct Placement!
                    $('#viewDataModal').offcanvas('show');

                } catch (error) {
                    console.error('Error fetching company details:', error);
                    // Use SweetAlert2 for better error display (already in your code!)
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load company details.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });



            // Add this to your $(function() { ... });  in your <script> section
            $(document).on('click', '.DeleteDataIcon', function() {
                const id = $(this).attr('id'); // Again, data-id is preferred
                const companyName = $(this).data('company-name') || 'this company'; // Get company name if available

                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete ${companyName}. This action cannot be undone!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const response = await $.ajax({
                                url: `{{ url('customers') }}/${id}`,
                                method: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                }
                            });

                            dataFetchAll(dateFilterValue);

                            // Enhanced success message
                            showToast(
                                'Deleted Successfully!',
                                `${companyName} has been deleted from the system.`,
                                'success'
                            );

                        } catch (error) {
                            console.error('Error deleting company:', error);

                            // Enhanced error message
                            let errorMessage = 'Failed to delete the company.';
                            if (error.responseJSON && error.responseJSON.message) {
                                errorMessage = error.responseJSON.message;
                            }

                            showToast(
                                'Delete Failed!',
                                errorMessage,
                                'error'
                            );
                        }
                    }
                });
            });


            // Global variables - keep these!
            let dateFilterValue = 'last_90_days'; // Default value for date filter

            async function dataFetchAll(dateFilter = 'last_90_days') {


                try {
                    dateFilterValue = dateFilter; // Update global filter value

                    const response = await $.ajax({
                        url: '{{ route('customerfetchall') }}',
                        method: 'GET',
                        data: {
                            date_filter: dateFilter
                        }
                    });

                    $('#show_all_fetched_data').html(response); // Populate the table
                    setupDataTable(); // Reinitialize DataTable
                    $('#date_filter').val(dateFilterValue); // Set dropdown
                } catch (error) {
                    console.error('Error fetching data:', error);
                    // Use SweetAlert2 (as you already do)
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
                } finally {

                }
            }
            // Function to initialize the DataTable with filters
            function setupDataTable() {
                if ($.fn.DataTable.isDataTable('#data_fetch_table')) {
                    $('#data_fetch_table').DataTable().destroy(); // Destroy previous instance
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
                            targets: [0, 1, 2, 3, 4], // Make first 4 columns sortable
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
                        const columnUniqueValues = new Map(); // Cache unique values for each column

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
                                await dataFetchAll(dateFilter);
                            }, 300));
                            $('#date_filter').val(dateFilterValue);
                        }

                        // Loop through each column and cache unique values for Select2 filtering
                        api.columns().every(function(index) {
                            const column = this;
                            if (!column.data().any()) return; // Skip empty columns

                            // Cache unique values if not cached yet
                            if (!columnUniqueValues.has(column.index())) {
                                const uniqueValues = [];
                                column.data().unique().sort().each(function(d) {
                                    const cleanValue = $('<div>').html(d).text();
                                    if (cleanValue && !uniqueValues.includes(cleanValue)) {
                                        uniqueValues.push(cleanValue);
                                    }
                                });
                                columnUniqueValues.set(column.index(), uniqueValues);
                            }

                            const headerText = $(column.header()).text().trim();
                            const uniqueValues = columnUniqueValues.get(column.index());

                            // Create Select2 dropdown for column filtering with improved performance
                            const selectHtml = $(
                                '<select class="filter-input" multiple="multiple" data-column="' + index + '"></select>'
                            );

                            // Add placeholder option
                            selectHtml.append(`<option></option>`);

                            // Batch append options for better performance
                            const optionsHtml = uniqueValues.map(value =>
                                `<option value="${value}">${value}</option>`
                            ).join('');
                            selectHtml.append(optionsHtml);

                            $(column.header()).empty().append(selectHtml);

                            // Initialize Select2 with optimized settings
                            selectHtml.select2({
                                placeholder: `Filter ${headerText}`,
                                width: '100%',
                                allowClear: true,
                                closeOnSelect: false,
                                dropdownAutoWidth: true,
                                selectOnClose: false,
                                minimumResultsForSearch: 10,
                                templateResult: function(data) {
                                    if (data.loading) return data.text;
                                    return $('<span>').text(data.text);
                                }
                            });

                            // Optimize change event handling
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
                                    column.search(searchString, true, false).draw();
                                }, 300);
                            });
                        });

                        // Adjust the column widths after drawing the table
                        api.on('draw.dt', function() {
                            dataTable.columns.adjust();
                        });
                    }
                });

                // Ensure header and body columns are aligned
                dataTable.columns.adjust();
            }


            // Fetch data on page load
            dataFetchAll(dateFilterValue);
        });
    </script>

    <!-- JavaScript libraries for enhanced UI components -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Add flatpickr plugins -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tippy.js@6.3.7/dist/tippy-bundle.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0/dist/cdn/places.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>



@endsection
