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
                                   <input type="file" name="company_profile_picture" accept="image/*">
                               </div>
                           </div>
                           <div class="preview-container mt-2 text-center d-none">
                               <img src="{{ asset('assets/images/company-logos/default.png') }}"
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
                                  value="AAAPA1234A"
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
                       <div class="col-md-6 col-lg-4">
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

                       <!-- Tax Registration Number -->
                       <div class="col-md-6 col-lg-4">
                           <label for="tax-registration-number"
                                  class="form-label">Tax Registration No</label>
                           <input type="text"
                                  class="form-control"
                                  id="tax-registration-number"
                                  name="tax_registration_number"
                                  placeholder="Enter Tax Registration No"
                                  data-validate="true">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Tax Exemption Number -->
                       <div class="col-md-6 col-lg-4">
                           <label for="tax-exemption-number"
                                  class="form-label">Tax Exemption No</label>
                           <input type="text"
                                  class="form-control"
                                  id="tax-exemption-number"
                                  name="tax_exemption_number"
                                  placeholder="Enter Tax Exemption No"
                                  data-validate="true">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Credit Limit -->
                       <div class="col-md-6 col-lg-4">
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
                       <div class="col-md-6 col-lg-4">
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
                       <div class="col-md-6 col-lg-4">
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
                       <div class="col-md-6 col-lg-4">
                           <label for="customer-status" class="form-label">Status</label>
                           <select class="form-select" id="customer-status" name="status" data-validate="true">
                               <option value="active" selected>Active</option>
                               <option value="inactive">Inactive</option>
                               <option value="blacklisted">Blacklisted</option>
                           </select>
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Tax Registration Number -->
                       <div class="col-md-6 col-lg-4">
                           <label for="tax-registration-number"
                                  class="form-label">Tax Registration No</label>
                           <input type="text"
                                  class="form-control"
                                  id="tax-registration-number"
                                  name="tax_registration_number"
                                  placeholder="Enter Tax Registration No"
                                  data-validate="true">
                           <div class="form-text field-feedback"></div>
                       </div>

                       <!-- Tax Exemption Number -->
                       <div class="col-md-6 col-lg-4">
                           <label for="tax-exemption-number"
                                  class="form-label">Tax Exemption No</label>
                           <input type="text"
                                  class="form-control"
                                  id="tax-exemption-number"
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
                           <label class="form-label">Bank Details</label>
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

                       <!-- Documents Upload -->
                       <div class="col-md-12">
                           <label class="form-label">Documents</label>
                           <div class="dropzone" id="documents-dropzone">
                               <div class="dz-message">
                                   <i class="ri-upload-cloud-line fs-2 text-primary mb-1"></i>
                                   <p>Drag & drop documents here<br><small class="text-muted">(or click to browse)</small></p>
                               </div>
                               <div class="fallback">
                                   <input type="file" name="documents[]" multiple>
                               </div>
                           </div>
                           <div class="documents-preview mt-2">
                               <!-- Documents will be listed here -->
                           </div>
                       </div>

                       <!-- Metadata Fields -->
                       <div class="col-md-12">
                           <label class="form-label">Additional Metadata</label>
                           <div class="row g-2">
                               <div class="col-md-6">
                                   <input type="number"
                                          class="form-control"
                                          name="metadata[employee_count]"
                                          id="employee_count"
                                          placeholder="Number of Employees"
                                          data-validate="true">
                               </div>
                               <div class="col-md-6">
                                   <input type="text"
                                          class="form-control"
                                          name="metadata[industry_sector]"
                                          id="industry_sector"
                                          placeholder="Industry Sector"
                                          data-validate="true">
                               </div>
                           </div>
                       </div>

                       <!-- Communication Preferences -->
                       <div class="col-md-12">
                           <label class="form-label">Communication Preferences</label>
                           <div class="row g-2">
                               <div class="col-md-6">
                                   <select class="form-select"
                                           name="preferences[communication_method]"
                                           id="communication_method"
                                           data-validate="true">
                                       <option value="">Select preferred communication method</option>
                                       <option value="email">Email</option>
                                       <option value="phone">Phone</option>
                                       <option value="both">Both Email and Phone</option>
                                   </select>
                               </div>
                               <div class="col-md-6">
                                   <select class="form-select"
                                           name="preferences[mailing_list]"
                                           id="mailing_list"
                                           data-validate="true">
                                       <option value="">Subscribe to mailing list?</option>
                                       <option value="yes">Yes</option>
                                       <option value="no">No</option>
                                   </select>
                               </div>
                           </div>
                       </div>

                       <!-- Custom Fields -->
                       <div class="col-md-12">
                           <label class="form-label">Custom Fields</label>
                           <div class="row g-2" id="custom-fields-container">
                               <!-- Custom fields will be dynamically added here -->
                           </div>
                           <button type="button" class="btn btn-sm btn-light mt-2" id="add-custom-field">
                               <i class="ri-add-line"></i> Add Custom Field
                           </button>
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
                                           name="email"
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
                                           name="phone"
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
                                       name="contact_person"
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

                            <!-- Company Size -->
                            <div class="col-md-6 col-lg-3">
                                <label for="company_size" class="form-label">Company Size</label>
                                <select class="form-select" id="company_size" name="company_size" data-validate="true">
                                    <option value="">Select company size...</option>
                                    <option value="Startup">Startup</option>
                                    <option value="Micro Business">Micro Business</option>
                                    <option value="Small Business">Small Business</option>
                                    <option value="Medium Size">Medium Size</option>
                                    <option value="Corporate">Corporate</option>
                                    <option value="Large Enterprise">Large Enterprise</option>
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

                            <!-- Documents Upload -->
                            <div class="col-md-12">
                                <label class="form-label">Documents</label>
                                <div class="dropzone" id="edit-documents-dropzone">
                                    <div class="dz-message">
                                        <i class="ri-upload-cloud-line fs-2 text-primary mb-1"></i>
                                        <p>Drag & drop documents here<br><small class="text-muted">(or click to browse)</small></p>
                                    </div>
                                    <div class="fallback">
                                        <input type="file" name="documents[]" multiple>
                                    </div>
                                </div>
                                <div class="documents-preview mt-2" id="edit-documents-preview">
                                    <!-- Existing documents will be listed here -->
                                </div>
                            </div>

                            <!-- Metadata Fields -->
                            <div class="col-md-12">
                                <label class="form-label">Additional Metadata</label>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <input type="number"
                                               class="form-control"
                                               name="metadata[employee_count]"
                                               id="edit_employee_count"
                                               placeholder="Number of Employees"
                                               data-validate="true">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text"
                                               class="form-control"
                                               name="metadata[industry_sector]"
                                               id="edit_industry_sector"
                                               placeholder="Industry Sector"
                                               data-validate="true">
                                    </div>
                                </div>
                            </div>

                            <!-- Communication Preferences -->
                            <div class="col-md-12">
                                <label class="form-label">Communication Preferences</label>
                                <div class="row g-2">
                                    <div class="col-md-6">
                                        <select class="form-select"
                                                name="preferences[communication_method]"
                                                id="edit_communication_method"
                                                data-validate="true">
                                            <option value="">Select preferred communication method</option>
                                            <option value="email">Email</option>
                                            <option value="phone">Phone</option>
                                            <option value="both">Both Email and Phone</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select"
                                                name="preferences[mailing_list]"
                                                id="edit_mailing_list"
                                                data-validate="true">
                                            <option value="">Subscribe to mailing list?</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Custom Fields -->
                            <div class="col-md-12">
                                <label class="form-label">Custom Fields</label>
                                <div class="row g-2" id="edit-custom-fields-container">
                                    <!-- Custom fields will be dynamically added here -->
                                </div>
                                <button type="button" class="btn btn-sm btn-light mt-2" id="edit-add-custom-field">
                                    <i class="ri-add-line"></i> Add Custom Field
                                </button>
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
            <h5 id="viewDataModalLabel" class="offcanvas-title">
                Customer Details
                <small class="d-block text-muted" id="view_customer_unique_code"></small>
            </h5>
            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
        </div>
        <div class="offcanvas-body p-0">
            <!-- Company Profile -->
            <div class="d-sm-flex align-items-top border-bottom border-block-end-dashed main-profile-cover p-3">
                <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent me-3 p-2">
                    <img src="{{ asset('assets/images/company-logos/default.png') }}"
                         id="view_company_logo"
                         alt="Company Logo">
                </span>
                <div class="flex-fill main-profile-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="fw-medium mb-1" id="view_company_name"></h6>
                    </div>
                    <p class="text-muted fs-12 mb-2" id="view_contact_person"></p>
                    <span class="badge bg-success-transparent mb-1" id="view_status">Active</span>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Contact Information:</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <i class="ri-mail-line me-2"></i>
                            <span id="view_email"></span>
                </div>
                        <div class="mb-2">
                            <i class="ri-phone-line me-2"></i>
                            <span id="view_phone"></span>
            </div>
                        <div class="mb-2">
                            <i class="ri-phone-line me-2"></i>
                            Alt: <span id="view_alt_phone">N/A</span>
                        </div>
                        </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <i class="ri-map-pin-line me-2"></i>
                            <span id="view_address"></span>
                    </div>
                        <div class="mb-2">
                            <span id="view_city"></span>,
                            <span id="view_state"></span>,
                            <span id="view_country"></span>
                            <span id="view_pincode"></span>
                        </div>
                        <div class="mb-2">
                            <i class="ri-global-line me-2"></i>
                            <span id="view_website">N/A</span>
                    </div>
                        </div>
                </div>
            </div>

            <!-- Tax Information -->
            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Tax Information:</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <strong>GST:</strong> <span id="view_gst_number">N/A</span>
                        </div>
                        <div class="mb-2">
                            <strong>PAN:</strong> <span id="view_pan_number">N/A</span>
                    </div>
                        <div class="mb-2">
                            <strong>TIN:</strong> <span id="view_tin_number">N/A</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <strong>CST:</strong> <span id="view_cst_number">N/A</span>
                        </div>
                        <div class="mb-2">
                            <strong>Tax Reg.:</strong> <span id="view_tax_registration_number">N/A</span>
                    </div>
                        <div class="mb-2">
                            <strong>Tax Exempt:</strong> <span id="view_tax_exemption_number">N/A</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Information -->
            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Business Information:</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <strong>Industry:</strong> <span id="view_industry_type">N/A</span>
                        </div>
                        <div class="mb-2">
                            <strong>Business Type:</strong> <span id="view_business_type">N/A</span>
                    </div>
                        <div class="mb-2">
                            <strong>Customer Group:</strong> <span id="view_customer_group">N/A</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <strong>Company Size:</strong> <span id="view_company_size">N/A</span>
                        </div>
                        <div class="mb-2">
                            <strong>Credit Limit:</strong> <span id="view_credit_limit">N/A</span>
                    </div>
                        <div class="mb-2">
                            <strong>Payment Terms:</strong> <span id="view_payment_terms">N/A</span>
                        </div>
                    </div>
                        </div>
                    </div>

            <!-- Bank Details -->
            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Bank Details:</p>
                <div id="view_bank_details">
                    <!-- Bank details will be populated here -->
                </div>
            </div>

            <!-- Documents -->
            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Documents:</p>
                <div id="view_documents" class="row g-2">
                    <!-- Documents will be populated here -->
                </div>
            </div>

            <!-- Additional Information -->
            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Additional Information:</p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-2">
                            <strong>Sales Person:</strong> <span id="view_sales_person">N/A</span>
                        </div>
                        <div class="mb-2">
                            <strong>Branch:</strong> <span id="view_branch">N/A</span>
                    </div>
                        </div>
                    <div class="col-md-6">
                        <div class="mb-2">
                            <strong>Created:</strong> <span id="view_created_at">N/A</span>
                    </div>
                        <div class="mb-2">
                            <strong>Last Updated:</strong> <span id="view_updated_at">N/A</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Notes:</p>
                <p class="text-muted mb-0" id="view_notes">N/A</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include customer-specific enhancements -->
    <!-- Disable external JS file to prevent conflicts -->
    <!-- <script src="{{ asset('assets/js/customer-enhancements.js') }}"></script> -->
<!-- Customer form component initialization and functionality -->
    <script>
        $(function() {
            // Initialize Dropzone for company logo
            const companyLogoDropzone = new Dropzone("#company-logo-dropzone", {
                url: "{{ route('customerstore') }}",
                maxFiles: 1,
                acceptedFiles: 'image/*',
                autoProcessQueue: false,
                addRemoveLinks: true,
                init: function() {
                    this.on("addedfile", function(file) {
                        if (this.files.length > 1) {
                            this.removeFile(this.files[0]);
                        }
                        // Show preview container
                        $('.preview-container').removeClass('d-none');
                        // Update preview image
                        if (file.type.startsWith('image/')) {
                            const reader = new FileReader();
                            reader.onload = function(e) {
                                $('#logo-preview').attr('src', e.target.result);
                            };
                            reader.readAsDataURL(file);
                        }
                    });
                    this.on("removedfile", function() {
                        $('.preview-container').addClass('d-none');
                        $('#logo-preview').attr('src', "{{ asset('assets/images/company-logos/default.png') }}");
                    });
                }
            });

            // Initialize Dropzone for documents
            const documentsDropzone = new Dropzone("#documents-dropzone", {
                url: "{{ route('customerstore') }}",
                autoProcessQueue: false,
                addRemoveLinks: true,
                maxFiles: 10,
                parallelUploads: 10,
                acceptedFiles: ".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png",
                init: function() {
                    this.on("addedfile", function(file) {
                        if (!file.type.match(/image.*/)) {
                            this.emit("thumbnail", file, "{{ asset('assets/images/file-icons/document.png') }}");
                        }
                    });
                }
            });

            // Form submission handling
            $('#add_data_form, #edit_data_form').on('submit', function(e) {
                e.preventDefault();
                const $form = $(this);
                const $submitBtn = $form.find('button[type="submit"]');
                const formData = new FormData($form[0]);

                // Add company logo if exists
                if (companyLogoDropzone.files.length > 0) {
                    formData.append('company_profile_picture', companyLogoDropzone.files[0]);
                }

                // Add documents
                documentsDropzone.files.forEach(file => {
                    formData.append('documents[]', file);
                });

                // Process JSON fields
                const jsonFields = {
                    bank_details: {},
                    preferences: {},
                    metadata: {}
                };

                // Collect bank details
                $form.find('[name^="bank_details["]').each(function() {
                    const key = $(this).attr('name').match(/\[(.*?)\]/)[1];
                    jsonFields.bank_details[key] = $(this).val();
                });

                // Collect preferences
                $form.find('[name^="preferences["]').each(function() {
                    const key = $(this).attr('name').match(/\[(.*?)\]/)[1];
                    jsonFields.preferences[key] = $(this).val();
                });

                // Collect metadata
                $form.find('[name^="metadata["]').each(function() {
                    const key = $(this).attr('name').match(/\[(.*?)\]/)[1];
                    jsonFields.metadata[key] = $(this).val();
                });

                // Add JSON fields to form data
                Object.keys(jsonFields).forEach(field => {
                    formData.set(field, JSON.stringify(jsonFields[field]));
                });

                // Disable submit button and show loading state
                $submitBtn.prop('disabled', true)
                    .find('.btn-loader')
                    .removeClass('d-none');

                // Submit form
                $.ajax({
                    url: $form.attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        console.log('Form submission started');
                        console.log('Form URL:', $form.attr('action'));
                        console.log('Form Method:', 'POST');

                        // Log form data for debugging (excluding file contents)
                        const formDataObj = {};
                        formData.forEach((value, key) => {
                            // Don't log file contents
                            if (value instanceof File) {
                                formDataObj[key] = `File: ${value.name} (${value.size} bytes)`;
                            } else {
                                formDataObj[key] = value;
                            }
                        });
                        console.log('Form Data:', formDataObj);
                    },
                    success: function(response) {
                        console.log('Form submission success:', response);
                        if (response.status === 200) {
                            // Show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });

                            // Reset form and dropzones
                            $form[0].reset();

                            // Check if dropzones exist before trying to use them
                            if (typeof companyLogoDropzone !== 'undefined' && companyLogoDropzone) {
                                companyLogoDropzone.removeAllFiles();
                            }
                            if (typeof documentsDropzone !== 'undefined' && documentsDropzone) {
                                documentsDropzone.removeAllFiles();
                            }
                            $('.preview-container').addClass('d-none');

                            // Close modal
                            $form.closest('.modal').modal('hide');

                            // Refresh data table
                            if (typeof dataFetchAll === 'function') {
                                dataFetchAll();
                            } else {
                                console.error('dataFetchAll function is not defined');
                                // Fallback: reload the page
                                window.location.reload();
                            }
                        } else {
                            console.warn('Form submission returned non-200 status:', response);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message || 'An unknown error occurred'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Form submission error:', {xhr, status, error});

                        // Log detailed error information
                        try {
                            const errorResponse = xhr.responseJSON || {};
                            console.error('Error details:', errorResponse);

                            const errors = errorResponse.errors;
                            if (errors) {
                                console.error('Validation errors:', errors);
                                Object.keys(errors).forEach(field => {
                                    const input = $form.find(`[name="${field}"]`);
                                    input.addClass('is-invalid')
                                        .next('.invalid-feedback')
                                        .text(errors[field][0]);

                                    console.log(`Field error: ${field} - ${errors[field][0]}`);
                                });
                            }
                        } catch (e) {
                            console.error('Error parsing error response:', e);
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: xhr.responseJSON?.message || 'Please check the form for errors.'
                        });
                    },
                    complete: function() {
                        console.log('Form submission completed');
                        // Re-enable submit button and hide loading state
                        $submitBtn.prop('disabled', false)
                            .find('.btn-loader')
                            .addClass('d-none');
                    }
                });
            });

            // Initialize form validation
            $('form input, form select, form textarea').on('input change', function() {
                $(this).removeClass('is-invalid')
                    .next('.invalid-feedback')
                    .text('');
            });

            // Initialize Tom Select for searchable dropdowns
            document.querySelectorAll('.tom-select').forEach(select => {
                new TomSelect(select, {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            });

            // View Data Modal Population
            $(document).on('click', '.ViewDataIcon', async function() {
                const id = $(this).data('id');

                try {
                    const response = await $.ajax({
                        url: `{{ route('customerview') }}?id=${id}`,
                        method: 'GET'
                    });

                    // Basic Information
                    $('#view_customer_unique_code').text(response.customer_unique_code);
                    $('#view_company_name').text(response.company_name);
                    $('#view_contact_person').text(response.contact_person);
                    $('#view_email').text(response.email || 'N/A');
                    $('#view_phone').text(response.phone || 'N/A');
                    $('#view_alt_phone').text(response.alt_phone || 'N/A');
                    $('#view_address').text(response.address || 'N/A');
                    $('#view_city').text(response.city || 'N/A');
                    $('#view_state').text(response.state || 'N/A');
                    $('#view_country').text(response.country || 'N/A');
                    $('#view_pincode').text(response.pincode || 'N/A');
                    $('#view_website').html(response.website ?
                        `<a href="${response.website}" target="_blank">${response.website}</a>` :
                        'N/A');

                    // Tax Information
                    $('#view_gst_number').text(response.gst_number || 'N/A');
                    $('#view_pan_number').text(response.pan_number || 'N/A');
                    $('#view_tin_number').text(response.tin_number || 'N/A');
                    $('#view_cst_number').text(response.cst_number || 'N/A');
                    $('#view_tax_registration_number').text(response.tax_registration_number || 'N/A');
                    $('#view_tax_exemption_number').text(response.tax_exemption_number || 'N/A');

                    // Business Information
                    $('#view_industry_type').text(response.industry_type || 'N/A');
                    $('#view_business_type').text(response.business_type ?
                        response.business_type.charAt(0).toUpperCase() + response.business_type.slice(1) :
                        'N/A');
                    $('#view_customer_group').text(response.customer_group ?
                        response.customer_group.charAt(0).toUpperCase() + response.customer_group.slice(1) :
                        'N/A');
                    $('#view_company_size').text(response.company_size || 'N/A');
                    $('#view_credit_limit').text(response.credit_limit ?
                        '₹' + parseFloat(response.credit_limit).toLocaleString() :
                        'N/A');
                    $('#view_payment_terms').text(response.payment_terms ?
                        response.payment_terms.replace('_', ' ').charAt(0).toUpperCase() +
                        response.payment_terms.replace('_', ' ').slice(1) :
                        'N/A');
                    $('#view_status').text(response.status ?
                        response.status.charAt(0).toUpperCase() + response.status.slice(1) :
                        'Active');

                    // Bank Details
                    if (response.bank_details) {
                        const bankDetails = typeof response.bank_details === 'string' ?
                            JSON.parse(response.bank_details) :
                            response.bank_details;

                        const bankHtml = `
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Bank Name:</strong><br>
                                    ${bankDetails.bank_name || 'N/A'}
                                </div>
                                <div class="col-md-4">
                                    <strong>Account Number:</strong><br>
                                    ${bankDetails.account_number || 'N/A'}
                                </div>
                                <div class="col-md-4">
                                    <strong>IFSC Code:</strong><br>
                                    ${bankDetails.ifsc_code || 'N/A'}
                                </div>
                            </div>
                        `;
                        $('#view_bank_details').html(bankHtml);
                    } else {
                        $('#view_bank_details').html('<p class="text-muted mb-0">No bank details available</p>');
                    }

                    // Documents
                    if (response.documents && response.documents.length > 0) {
                        const documents = typeof response.documents === 'string' ?
                            JSON.parse(response.documents) :
                            response.documents;

                        const documentsHtml = documents.map(doc => `
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <i class="ri-file-line fs-24 me-2"></i>
                                        <span>${doc.name}</span>
                                        <a href="${doc.url}" class="btn btn-sm btn-primary float-end" target="_blank">
                                            <i class="ri-download-line"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `).join('');
                        $('#view_documents').html(documentsHtml);
                    } else {
                        $('#view_documents').html('<p class="text-muted mb-0">No documents available</p>');
                    }

                    // Additional Information
                    $('#view_sales_person').text(response.sales_person?.name || 'N/A');
                    $('#view_branch').text(response.branch?.name || 'N/A');
                    $('#view_created_at').text(response.created_at ?
                        new Date(response.created_at).toLocaleString() :
                        'N/A');
                    $('#view_updated_at').text(response.updated_at ?
                        new Date(response.updated_at).toLocaleString() :
                        'N/A');

                    // Notes
                    $('#view_notes').text(response.notes || 'N/A');

                    // Company Logo
                    const logoUrl = response.company_profile_picture ?
                        `${response.company_profile_picture}` :
                        `{{ asset('assets/images/company-logos/default.png') }}`;
                    $('#view_company_logo').attr('src', logoUrl);

                    // Show the modal
                    $('#viewDataModal').offcanvas('show');
                } catch (error) {
                    console.error('Error fetching customer details:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load customer details.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });

            // Edit Data Modal Population
            $(document).on('click', '.EditDataIcon', async function() {
                const id = $(this).data('id');

                try {
                    const response = await $.ajax({
                        url: `{{ route('customeredit') }}?id=${id}`,
                        method: 'GET'
                    });

                    // Populate form fields with customer data
                    $('#customer_id').val(response.id);
                    $('#company_name').val(response.company_name);
                    $('#company_mail').val(response.email);
                    $('#company_phone').val(response.phone);
                    $('#alt_phone').val(response.alt_phone);
                    $('#company_gst').val(response.gst_number);
                    $('#pan_number').val(response.pan_number);
                    $('#tin_number').val(response.tin_number);
                    $('#cst_number').val(response.cst_number);
                    $('#key_contact').val(response.contact_person);
                    $('#industry_edit').val(response.industry_type);
                    $('#business_type').val(response.business_type);
                    $('#customer_group').val(response.customer_group);
                    $('#company_size').val(response.company_size);
                    $('#status').val(response.status);
                    $('#tax_registration_number').val(response.tax_registration_number);
                    $('#tax_exemption_number').val(response.tax_exemption_number);
                    $('#sales_person_id').val(response.sales_person_id);
                    $('#branch_id').val(response.branch_id);

                    // Handle metadata fields
                    if (response.metadata) {
                        const metadata = typeof response.metadata === 'string' ?
                            JSON.parse(response.metadata) :
                            response.metadata;

                        $('#company_year_established').val(metadata.year_established || '');
                    }

                    // Handle bank details
                    if (response.bank_details) {
                        const bankDetails = typeof response.bank_details === 'string' ?
                            JSON.parse(response.bank_details) :
                            response.bank_details;

                        $('#bank_name').val(bankDetails.bank_name || '');
                        $('#account_number').val(bankDetails.account_number || '');
                        $('#ifsc_code').val(bankDetails.ifsc_code || '');
                    }

                    // Handle social media links
                    if (response.preferences) {
                        const preferences = typeof response.preferences === 'string' ?
                            JSON.parse(response.preferences) :
                            response.preferences;

                        if (preferences.social_media) {
                            $('#social_media_links').val(preferences.social_media.join(', '));
                        }
                    }

                    // Handle notes
                    $('#additional_notes').val(response.notes);

                    // Handle company logo
                    if (response.company_profile_picture) {
                        $('#edit_company_logo').attr('src', response.company_profile_picture);
                        $('.preview-container').removeClass('d-none');
                    } else {
                        $('#edit_company_logo').attr('src', '{{ asset("assets/images/company-logos/default.png") }}');
                    }

                    // Refresh Tom Select instances
                    document.querySelectorAll('.tom-select').forEach(select => {
                        if (select.tomselect) {
                            select.tomselect.setValue($(select).val());
                        }
                    });

                    // Show the modal
                    $('#editDataModal').modal('show');
                } catch (error) {
                    console.error('Error fetching customer details for edit:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load customer details for editing.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });
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

    <!-- Add dataFetchAll function directly in the blade file -->
    <script>
        $(function() {
            // Call dataFetchAll when the page loads
            dataFetchAll();

            // Handle date filter changes
            $('#date_filter').on('change', function() {
                dataFetchAll($(this).val());
            });

            // Define the dataFetchAll function
            async function dataFetchAll(dateFilter = 'all') {
                try {
                    // Show loading spinner
                    $('#table-loading').removeClass('d-none');

                    // Check if the route exists
                    let url = '';
                    try {
                        url = '{{ route('customerfetchall') }}';
                    } catch (routeError) {
                        console.error('Route error:', routeError);
                        // Fallback to a default URL if the route doesn't exist
                        url = '/customerfetchall';
                    }

                    const response = await $.ajax({
                        url: url,
                        method: 'GET',
                        data: {
                            date_filter: dateFilter
                        },
                        timeout: 30000 // 30 seconds timeout
                    });

                    // Update the table with new data
                    $('#show_all_fetched_data').html(response);

                    // Initialize DataTable if needed
                    if ($.fn.DataTable) {
                        try {
                            if ($.fn.DataTable.isDataTable('#data_fetch_table')) {
                                $('#data_fetch_table').DataTable().destroy();
                            }

                            $('#data_fetch_table').DataTable({
                                responsive: true,
                                lengthMenu: [10, 25, 50, 100],
                                order: [[0, 'desc']]
                            });
                        } catch (dtError) {
                            console.error('DataTable initialization error:', dtError);
                        }
                    }

                    // Update customer count
                    const count = $('#data_fetch_table tbody tr').length || 0;
                    $('#customer-count').text(count);

                    // Initialize tooltips for new elements
                    if (typeof tippy === 'function') {
                        try {
                            tippy('[data-tippy-content]', {
                                arrow: true,
                                animation: 'scale'
                            });
                        } catch (tippyError) {
                            console.error('Tippy initialization error:', tippyError);
                        }
                    }
                } catch (error) {
                    console.error('Error fetching customers:', error);

                    // Check if it's a network error
                    if (error.status === 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Network Error',
                            text: 'Could not connect to the server. Please check your internet connection.',
                            timer: 5000,
                            showConfirmButton: true
                        });
                    } else if (error.status === 404) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Route Not Found',
                            text: 'The customerfetchall route is not defined. Please check your routes configuration.',
                            timer: 5000,
                            showConfirmButton: true
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to fetch customer data: ' + (error.responseJSON?.message || error.statusText || 'Unknown error'),
                            timer: 5000,
                            showConfirmButton: true
                        });
                    }

                    // Show a placeholder message in the table area
                    $('#show_all_fetched_data').html(`
                        <div class="alert alert-warning m-3">
                            <i class="ri-error-warning-line me-2"></i>
                            Could not load customer data. Please try refreshing the page.
                            <button class="btn btn-sm btn-primary ms-3" onclick="dataFetchAll()">
                                <i class="ri-refresh-line me-1"></i> Retry
                            </button>
                        </div>
                    `);
                } finally {
                    // Hide loading spinner
                    $('#table-loading').addClass('d-none');
                }
            }

            // Fix Dropzone initialization issues
            if (typeof Dropzone !== 'undefined') {
                // Completely disable Dropzone auto discover
                Dropzone.autoDiscover = false;

                // Helper function to safely initialize Dropzone
                function safeInitDropzone(selector, options) {
                    const element = document.querySelector(selector);
                    if (!element) {
                        console.warn(`Dropzone element not found: ${selector}`);
                        return null;
                    }

                    // Check if already initialized
                    if (element.dropzone) {
                        console.warn(`Dropzone already initialized for: ${selector}`);
                        return element.dropzone;
                    }

                    try {
                        const dropzoneInstance = new Dropzone(selector, options);
                        element.dropzone = dropzoneInstance;
                        return dropzoneInstance;
                    } catch (error) {
                        console.error(`Error initializing Dropzone for ${selector}:`, error);
                        return null;
                    }
                }

                // Common Dropzone options
                const commonOptions = {
                    url: "{{ route('customerstore') }}",
                    autoProcessQueue: false,
                    addRemoveLinks: true,
                };

                // Initialize company logo dropzone
                const companyLogoDropzone = safeInitDropzone("#company-logo-dropzone", {
                    ...commonOptions,
                    maxFiles: 1,
                    acceptedFiles: 'image/*',
                    init: function() {
                        this.on("addedfile", function(file) {
                            if (this.files.length > 1) {
                                this.removeFile(this.files[0]);
                            }

                            // Find the preview container safely
                            const element = this.element;
                            if (!element) return;

                            const parent = element.closest('.col-md-6') || element.parentElement;
                            if (!parent) return;

                            const previewContainer = parent.querySelector('.preview-container');
                            if (previewContainer) {
                                previewContainer.classList.remove('d-none');
                            }

                            // Update preview image
                            if (file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const logoPreview = parent.querySelector('#logo-preview') ||
                                                       document.getElementById('logo-preview');
                                    if (logoPreview) {
                                        logoPreview.setAttribute('src', e.target.result);
                                    }
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        this.on("removedfile", function() {
                            // Find the preview container safely
                            const element = this.element;
                            if (!element) return;

                            const parent = element.closest('.col-md-6') || element.parentElement;
                            if (!parent) return;

                            const previewContainer = parent.querySelector('.preview-container');
                            if (previewContainer) {
                                previewContainer.classList.add('d-none');
                            }

                            const logoPreview = parent.querySelector('#logo-preview') ||
                                               document.getElementById('logo-preview');
                            if (logoPreview) {
                                logoPreview.setAttribute('src', "{{ asset('assets/images/company-logos/default.png') }}");
                            }
                        });
                    }
                });

                // Initialize documents dropzone
                const documentsDropzone = safeInitDropzone("#documents-dropzone", {
                    ...commonOptions,
                    maxFiles: 10,
                    parallelUploads: 10,
                    acceptedFiles: ".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png",
                    init: function() {
                        this.on("addedfile", function(file) {
                            if (!file.type.match(/image.*/)) {
                                this.emit("thumbnail", file, "{{ asset('assets/images/file-icons/document.png') }}");
                            }
                        });
                    }
                });

                // Initialize edit company logo dropzone
                const editCompanyLogoDropzone = safeInitDropzone("#edit-company-logo-dropzone", {
                    ...commonOptions,
                    maxFiles: 1,
                    acceptedFiles: 'image/*',
                    init: function() {
                        this.on("addedfile", function(file) {
                            if (this.files.length > 1) {
                                this.removeFile(this.files[0]);
                            }

                            // Find the preview container safely
                            const element = this.element;
                            if (!element) return;

                            const parent = element.closest('.col-md-6') || element.parentElement;
                            if (!parent) return;

                            const previewContainer = parent.querySelector('.preview-container');
                            if (previewContainer) {
                                previewContainer.classList.remove('d-none');
                            }

                            // Update preview image
                            if (file.type.startsWith('image/')) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    const logoPreview = parent.querySelector('#edit_company_logo') ||
                                                       document.getElementById('edit_company_logo');
                                    if (logoPreview) {
                                        logoPreview.setAttribute('src', e.target.result);
                                    }
                                };
                                reader.readAsDataURL(file);
                            }
                        });

                        this.on("removedfile", function() {
                            // Find the preview container safely
                            const element = this.element;
                            if (!element) return;

                            const parent = element.closest('.col-md-6') || element.parentElement;
                            if (!parent) return;

                            const previewContainer = parent.querySelector('.preview-container');
                            if (previewContainer) {
                                previewContainer.classList.add('d-none');
                            }

                            const logoPreview = parent.querySelector('#edit_company_logo') ||
                                               document.getElementById('edit_company_logo');
                            if (logoPreview) {
                                logoPreview.setAttribute('src', "{{ asset('assets/images/company-logos/default.png') }}");
                            }
                        });
                    }
                });

                // Initialize edit documents dropzone
                const editDocumentsDropzone = safeInitDropzone("#edit-documents-dropzone", {
                    ...commonOptions,
                    maxFiles: 10,
                    parallelUploads: 10,
                    acceptedFiles: ".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png",
                    init: function() {
                        this.on("addedfile", function(file) {
                            if (!file.type.match(/image.*/)) {
                                this.emit("thumbnail", file, "{{ asset('assets/images/file-icons/document.png') }}");
                            }
                        });
                    }
                });

                // Store dropzone instances in a global object for later access
                window.customerDropzones = {
                    companyLogo: companyLogoDropzone,
                    documents: documentsDropzone,
                    editCompanyLogo: editCompanyLogoDropzone,
                    editDocuments: editDocumentsDropzone
                };
            }
        });
    </script>

@endsection
