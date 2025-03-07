@extends('layouts.app')


@section('content')
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Companies <span
                              class="badge bg-primary text-default fs-12 text-fixed-white ms-2 rounded align-middle">23</span>
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
                                id="export_button">
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


    <!-- Start:: Supplier Details Offcanvas -->
    <div class="offcanvas offcanvas-end"
         tabindex="-1"
         id="offcanvasExample"
         aria-labelledby="offcanvasExample">
        <div class="offcanvas-body p-0">
            <div class="d-sm-flex align-items-top border-bottom border-block-end-dashed main-profile-cover p-3">
                <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent me-3 p-2">
                    <img src="{{ asset('assets/images/company-logos/1.png') }}"
                         alt="TVS Motors Logo">
                </span>
                <div class="flex-fill main-profile-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="fw-medium mb-1">Raja Bhaguth</h6>
                        <span class="badge bg-success-transparent fs-10"><i
                               class="ri-circle-fill fs-8 text-success me-1"></i> New Lead</span>
                        <button type="button"
                                class="btn-close crm-contact-close-btn"
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <p class="text-muted fs-12 mb-2">Founder & Managing Director</p>
                    <div class="d-flex fs-15 mt-1 gap-2">
                        <a href="javascript:void(0);"
                           class="btn btn-icon btn-sm rounded-pill btn-primary1-light"><i class="ri-phone-line"></i></a>
                        <a href="javascript:void(0);"
                           class="btn btn-icon btn-sm rounded-pill btn-primary2-light"><i class="ri-mail-line"></i></a>
                        <a href="javascript:void(0);"
                           class="btn btn-icon btn-sm rounded-pill btn-primary3-light"><i class="ri-message-line"></i></a>
                        <div class="dropdown">
                            <a href="javascript:void(0);"
                               data-bs-toggle="dropdown"
                               aria-expanded="false"
                               class="btn btn-icon btn-sm rounded-pill btn-secondary-light"><i class="ri-more-fill"></i></a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item"
                                       href="javascript:void(0);">Size</a></li>
                                <li><a class="dropdown-item"
                                       href="javascript:void(0);">Deals</a></li>
                                <li><a class="dropdown-item"
                                       href="javascript:void(0);">Status</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex border-bottom border-block-end-dashed mt-3 gap-3 p-1 py-0">
                <div class="flex-fill p-2 text-center">
                    <i class="ri-shake-hands-line fs-5 rounded-circle lh-1 text-fixed-white bg-primary p-2 shadow-sm"></i>
                    <p class="fw-semibold fs-20 text-shadow mb-0 mt-2">356</p>
                    <p class="text-muted mb-0">Orders</p>
                </div>
                <div class="flex-fill p-2 text-center">
                    <i
                       class="ri-money-dollar-circle-line fs-5 rounded-circle lh-1 text-fixed-white bg-primary p-2 shadow-sm"></i>
                    <p class="fw-semibold fs-20 text-shadow mb-0 mt-2">₹17K</p>
                    <p class="text-muted mb-0">Contributions</p>
                </div>
                <div class="flex-fill p-2 text-center">
                    <i class="ri-thumb-up-line fs-5 rounded-circle lh-1 text-fixed-white bg-primary p-2 shadow-sm"></i>
                    <p class="fw-semibold fs-20 text-shadow mb-0 mt-2">₹12K</p>
                    <p class="text-muted mb-0">Dispatched</p>
                </div>
            </div>
            <div class="border-bottom border-block-end-dashed p-3">
                <div class="mb-0">
                    <p class="fs-15 fw-medium mb-2">Professional Bio :</p>
                    <p class="text-muted mb-0">
                        I am <b class="text-default">Saravana Kumar,</b> the Founder & Managing Director of Saravana
                        Enterprises, and I serve as the Chief Financial Officer (CFO) of the company. Thompson Enterprises
                        is a leading player in the manufacturing industry, focused on inFebation, quality, and sustainable
                        practices. Under my leadership, the company has expanded its global presence and continues to build
                        a legacy of trust and excellence.
                    </p>
                </div>
            </div>
            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Contact Information :</p>
                <div class="">
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary1-transparent">
                                <i class="ri-mail-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>
                            saravana@example.com <span class="bg-light text-muted lh-1 rounded-circle ms-1 p-1"
                                  data-bs-toggle="tooltip"
                                  data-bs-placement="top"
                                  data-bs-original-title="Copy"><i class="ri-file-copy-line"></i></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary2-transparent">
                                <i class="ri-phone-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>
                            +(91) 987-654-3210
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-0">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary3-transparent">
                                <i class="ri-map-pin-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>
                            456, Industrial Area, Sector 17, New Delhi, Delhi, 110017, India

                        </div>
                    </div>

                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                <i class="ri-tax-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div>
                            GSTIN: 09ABCDE1234F1Z5
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Priority:</p>
                <div class="badge bg-success-transparent"><i class="ri-circle-fill lh-1 fs-9 me-1 align-middle"></i>
                    Medium Priority</div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center gap-3 p-3">
                <div class="fs-14 fw-medium">
                    Supplier Size:
                </div>
                <div>
                    <span class="badge bg-primary-transparent">Corporate</span> - 500+ Employees
                </div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Created Date:</p>
                <div>1-January-2000</div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Lead Source:</p>
                <div><i class="ri-instagram-line bg-danger-transparent lh-1 fs-15 me-1 rounded p-1 align-middle"></i>
                    Instagram</div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Social Networks :</p>
                <div class="btn-list mb-0">
                    <button class="btn btn-sm btn-icon btn-primary-light btn-wave waves-effect waves-light mb-0">
                        <i class="ri-facebook-line fw-medium"></i>
                    </button>
                    <button class="btn btn-sm btn-icon btn-secondary-light btn-wave waves-effect waves-light mb-0">
                        <i class="ri-twitter-x-line fw-medium"></i>
                    </button>
                    <button class="btn btn-sm btn-icon btn-primary2-light btn-wave waves-effect waves-light mb-0">
                        <i class="ri-instagram-line fw-medium"></i>
                    </button>
                    <button class="btn btn-sm btn-icon btn-success-light btn-wave waves-effect waves-light mb-0">
                        <i class="ri-github-line fw-medium"></i>
                    </button>
                    <button class="btn btn-sm btn-icon btn-danger-light btn-wave waves-effect waves-light mb-0">
                        <i class="ri-youtube-line fw-medium"></i>
                    </button>
                </div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Tags :</p>
                <div>
                    <span class="badge bg-primary-transparent">New Lead</span>
                    <span class="badge bg-secondary-transparent">Follow Up</span>
                </div>
            </div>
            <div class="p-3 text-center">
                <div class="d-flex align-items-center gap-2">
                    <a href="javascript:void(0);"
                       class="btn btn-primary btn-sm">Connect</a>
                    <a href="javascript:void(0);"
                       class="btn btn-light btn-sm">Close</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: Supplier Details Offcanvas -->

    <!-- End:: Supplier Details Offcanvas -->
    <!-- Start:: Add Material Stock Modal -->
    <div class="modal fade"
         id="addDataModal"
         tabindex="-1"
         aria-labelledby="addDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="addDataModal">Add Material Stock</h6>
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
                            <!-- Material Stock Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/default-stock.png') }}"
                                             alt="Material Stock Logo"
                                             name="stock-logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="stock_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="profile-change">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- Stock Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="stock_name"
                                       class="form-label">Stock Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="stock_name"
                                       placeholder="Enter Stock Name"
                                       required>
                            </div>

                            <!-- Material Name -->
                            <div class="col-md-6 col-lg-4">
                                <label for="material_name"
                                       class="form-label">Material Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_name"
                                       placeholder="Enter Material Name"
                                       required>
                            </div>

                            <!-- Current Quantity -->
                            <div class="col-md-6 col-lg-4">
                                <label for="current_quantity"
                                       class="form-label">Current Quantity</label>
                                <input type="number"
                                       step="0.01"
                                       class="form-control"
                                       name="current_quantity"
                                       placeholder="Enter Current Quantity"
                                       required>
                            </div>

                            <!-- Minimum Stock -->
                            <div class="col-md-6 col-lg-4">
                                <label for="minimum_stock"
                                       class="form-label">Minimum Stock Level</label>
                                <input type="number"
                                       step="0.01"
                                       class="form-control"
                                       name="minimum_stock"
                                       placeholder="Enter Minimum Stock Level">
                            </div>

                            <!-- Unit of Measurement -->
                            <div class="col-md-6 col-lg-4">
                                <label for="unit_of_measurement"
                                       class="form-label">Unit of Measurement</label>
                                <select class="form-control"
                                        name="unit_of_measurement">
                                    <option value="kg">Kilogram (kg)</option>
                                    <option value="g">Gram (g)</option>
                                    <option value="ltr">Liter (ltr)</option>
                                    <option value="pcs">Pieces (pcs)</option>
                                </select>
                            </div>

                            <!-- Warehouse Location -->
                            <div class="col-md-6 col-lg-4">
                                <label for="warehouse_location"
                                       class="form-label">Warehouse Location</label>
                                <input type="text"
                                       class="form-control"
                                       name="warehouse_location"
                                       placeholder="Enter Warehouse Location">
                            </div>

                            <!-- Material ID (Optional) -->
                            <div class="col-md-6 col-lg-4">
                                <label for="material_id"
                                       class="form-label">Material ID</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_id"
                                       placeholder="Enter Material ID">
                            </div>

                            <!-- Branch ID (Optional) -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_id"
                                       class="form-label">Branch</label>
                                <select class="form-control"
                                        name="branch_id">
                                    <option value="">Select Branch</option>
                                    <!-- Populate with actual branches -->
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="add_data_btn"
                            class="btn btn-primary">Create Material Stock</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Start:: Edit Material Stock Modal -->
    <div class="modal fade"
         id="editDataModal"
         tabindex="-1"
         aria-labelledby="editDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="editDataModal">Edit Material Stock</h6>
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
                               name="material_stock_id"
                               id="material_stock_id">
                        <div class="row gy-3">
                            <!-- Material Stock Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/default-stock.png') }}"
                                             alt="Material Stock Logo"
                                             id="stock_profile_picture_preview">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="stock_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="stock_profile_picture">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- Stock Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="stock_name"
                                       class="form-label">Stock Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="stock_name"
                                       id="stock_name"
                                       placeholder="Enter Stock Name"
                                       required>
                            </div>

                            <!-- Material Name -->
                            <div class="col-md-6 col-lg-4">
                                <label for="material_name"
                                       class="form-label">Material Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_name"
                                       id="material_name"
                                       placeholder="Enter Material Name"
                                       required>
                            </div>

                            <!-- Current Quantity -->
                            <div class="col-md-6 col-lg-4">
                                <label for="current_quantity"
                                       class="form-label">Current Quantity</label>
                                <input type="number"
                                       step="0.01"
                                       class="form-control"
                                       name="current_quantity"
                                       id="current_quantity"
                                       placeholder="Enter Current Quantity"
                                       required>
                            </div>

                            <!-- Minimum Stock -->
                            <div class="col-md-6 col-lg-4">
                                <label for="minimum_stock"
                                       class="form-label">Minimum Stock Level</label>
                                <input type="number"
                                       step="0.01"
                                       class="form-control"
                                       name="minimum_stock"
                                       id="minimum_stock"
                                       placeholder="Enter Minimum Stock Level">
                            </div>

                            <!-- Unit of Measurement -->
                            <div class="col-md-6 col-lg-4">
                                <label for="unit_of_measurement"
                                       class="form-label">Unit of Measurement</label>
                                <select class="form-control"
                                        name="unit_of_measurement"
                                        id="unit_of_measurement">
                                    <option value="kg">Kilogram (kg)</option>
                                    <option value="g">Gram (g)</option>
                                    <option value="ltr">Liter (ltr)</option>
                                    <option value="pcs">Pieces (pcs)</option>
                                </select>
                            </div>

                            <!-- Warehouse Location -->
                            <div class="col-md-6 col-lg-4">
                                <label for="warehouse_location"
                                       class="form-label">Warehouse Location</label>
                                <input type="text"
                                       class="form-control"
                                       name="warehouse_location"
                                       id="warehouse_location"
                                       placeholder="Enter Warehouse Location">
                            </div>

                            <!-- Material ID (Optional) -->
                            <div class="col-md-6 col-lg-4">
                                <label for="material_id"
                                       class="form-label">Material ID</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_id"
                                       id="material_id"
                                       placeholder="Enter Material ID">
                            </div>

                            <!-- Branch ID (Optional) -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_id"
                                       class="form-label">Branch</label>
                                <select class="form-control"
                                        name="branch_id"
                                        id="branch_id">
                                    <option value="">Select Branch</option>
                                    <!-- Populate with actual branches -->
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="edit_data_btn"
                            class="btn btn-primary">Update Material Stock</button>
                </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            // Setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            // Ensure showToast function exists
            function showToast(message, type = 'info') {
                alert(message); // Replace with an actual toast notification library if needed
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
                    dataFetchAll();
                    showToast(successMessage, 'success');
                    if (modalSelector) $(modalSelector).modal('hide');

                } catch (error) {
                    console.error('Error submitting form:', error);
                    showToast('An error occurred.', 'error');
                } finally {
                    $(buttonSelector).attr('disabled', false).text('Submit');
                }
            }

            // Edit data modal population
            $(document).on('click', '.EditDataIcon', async function() {
                const id = $(this).attr('id');
                try {
                    const response = await $.ajax({
                        url: '{{ route('productionPlanedit') }}',
                        method: 'GET',
                        data: {
                            id,
                            _token: $('meta[name="_token"]').attr('content')
                        }
                    });

                    // Access production plan data
                    const productionPlan = response;

                    // Populate form fields
                    $("#material_stock_id").val(response.id);
                    $("#stock_name").val(response.stock_name);
                    $("#material_name").val(response.material_name);
                    $("#current_quantity").val(response.current_quantity);
                    $("#minimum_stock").val(response.minimum_stock);
                    $("#unit_of_measurement").val(response.unit_of_measurement);
                    $("#warehouse_location").val(response.warehouse_location);
                    $("#material_id").val(response.material_id);
                    $("#branch_id").val(response.branch_id);

                    // Update profile picture preview
                    if (response.stock_profile_picture) {
                        $("#stock_profile_picture_preview").attr("src",
                            `{{ asset('storage/') }}/${response.stock_profile_picture}`);
                    } else {
                        $("#stock_profile_picture_preview").attr("src",
                            "{{ asset('assets/images/default-stock.png') }}");
                    }

                    $('#editDataModal').modal('show');
                } catch (error) {
                    console.error('Error fetching production plan:', error);
                    alert('Failed to fetch production plan data.');
                }
            });

            // Bind events for adding and editing data
            $('#add_data_form').on('submit', function(e) {
                e.preventDefault();
                submitForm('#add_data_form', '#add_data_btn', '{{ route('productionPlanstore') }}',
                    'New Production Plan added successfully!', '#addDataModal');
            });

            $('#edit_data_form').on('submit', function(e) {
                e.preventDefault();
                submitForm('#edit_data_form', '#edit_data_btn', '{{ route('productionPlanupdate') }}',
                    'Production Plan updated successfully!', '#editDataModal');
            });

            // Global variables
            let dateFilterValue = 'last_90_days'; // Default value for date filter

            async function dataFetchAll(dateFilter = 'last_90_days') {
                try {
                    dateFilterValue = dateFilter; // Update global filter value

                    const response = await $.ajax({
                        url: '{{ route('productionPlanfetchall') }}',
                        method: 'GET',
                        data: {
                            date_filter: dateFilter
                        }
                    });

                    $('#show_all_fetched_data').html(response); // Populate the table with new data
                    setupDataTable(); // Reinitialize DataTable after data fetch
                    $('#date_filter').val(dateFilterValue); // Set the filter dropdown value
                } catch (error) {
                    console.error('Error fetching production plans:', error);
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
                }
            }

            function setupDataTable() {
                // Similar to the supplier view's setupDataTable method
                // Implement DataTable initialization with similar configurations
                if ($.fn.DataTable.isDataTable('#data_fetch_table')) {
                    $('#data_fetch_table').DataTable().destroy();
                }
                $('.filter-input').select2('destroy');

                const dataTable = $('#data_fetch_table').DataTable({
                    // DataTable configuration similar to supplier view
                    // Adjust columns and settings specific to production plans
                    order: [0, 'desc'],
                    responsive: true,
                    scrollY: '600px',
                    scrollX: true,
                    scrollCollapse: true,
                    fixedHeader: true,
                    pageLength: 200,
                    lengthMenu: [100, 200, 500, 1000],
                    // ... other configurations
                });
            }

            // Fetch data on page load
            dataFetchAll(dateFilterValue);

            // Export functionality
            document.getElementById('exportButton').addEventListener('click', function() {
                fetch('{{ route('productionPlanexport') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.blob())
                    .then(blob => {
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = `production_plan_export_${new Date().toLocaleDateString()}.xlsx`;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    })
                    .catch(error => console.error('Export failed:', error));
            });

            // Status update functionality
            $(document).on('click', '.UpdateStatusIcon', async function() {
                const id = $(this).attr('id');
                const newStatus = $(this).data('status');

                try {
                    const response = await $.ajax({
                        url: '{{ route('productionPlanStatusUpdate') }}',
                        method: 'POST',
                        data: {
                            id: id,
                            status: newStatus,
                            _token: $('meta[name="_token"]').attr('content')
                        }
                    });

                    showToast('Production Plan status updated successfully!', 'success');
                    dataFetchAll(); // Refresh the table
                } catch (error) {
                    console.error('Error updating status:', error);
                    showToast('Failed to update status.', 'error');
                }
            });
        });
    </script>
@endsection
