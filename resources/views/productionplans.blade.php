@extends('layouts.app')

@section('content')
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Production Plans
                    </div>
                    <div class="d-flex flex-wrap gap-2">

                        <button type="button"
                                class="modal-effect btn btn-white btn-wave"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#addProductionPlanDataModal">
                            <i class="ri-file-add-line lh-1 me-1 align-middle"></i> New
                        </button>

                        <button type="button"
                                class="modal-effect btn btn-primary3 btn-wave me-0"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#importProductionPlanDataModal">
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

    <!-- Add Import From ProductionPlan -->
    <div class="modal fade"
         id="importProductionPlanDataModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="importProductionPlanDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="importProductionPlanDataModal">Import Production Plans</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="productionplanimport"
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
                                    class="btn btn-primary">Import Production Plans</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Export From ProductionPlan -->
    <div class="modal fade"
         id="ExportProductionPlanModel"
         tabindex="-1"
         role="dialog"
         aria-labelledby="ExportProductionPlanModel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="ExportProductionPlanModel">Export Production Plans</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('productionplanexport') }}"
                          method="POST">
                        @csrf
                        <label for="production_plan_from_date">From Date:</label>
                        <input type="date"
                               name="from_date"
                               id="production_plan_from_date"
                               required>

                        <label for="production_plan_to_date">To Date:</label>
                        <input type="date"
                               name="to_date"
                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                               id="production_plan_to_date"
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

    <!-- Start:: Add ProductionPlan add data modal -->
    <div class="modal fade"
         id="addProductionPlanDataModal"
         tabindex="-1"
         aria-labelledby="addProductionPlanDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="addProductionPlanDataModal">Add Production Plan</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="add_production_plan_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-3">
                            <!-- ProductionPlan Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/8.png') }}"
                                             alt="ProductionPlan Logo"
                                             name="production-plan-logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="plan_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="production-plan-profile-change">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- ProductionPlan Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="plan_name"
                                       class="form-label">Plan Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="plan_name"
                                       placeholder="Enter Plan Name" required>
                            </div>

                             <!-- Production Start Date -->
                             <div class="col-md-6 col-lg-4">
                                <label for="production_start_date"
                                       class="form-label">Production Start Date</label>
                                <input type="date"
                                       class="form-control"
                                       name="production_start_date"
                                       required>
                            </div>

                            <!-- Production End Date -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_end_date"
                                       class="form-label">Production End Date (Optional)</label>
                                <input type="date"
                                       class="form-control"
                                       name="production_end_date">
                            </div>

                            <!-- Production Status -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_status"
                                       class="form-label">Production Status</label>
                                <select class="form-control"
                                        name="production_status">
                                    <option value="pending" selected>Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="on_hold">On Hold</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>

                            <!-- Production Cost -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_cost"
                                       class="form-label">Production Cost (Optional)</label>
                                <input type="number"
                                       class="form-control"
                                       name="production_cost"
                                       step="any"
                                       placeholder="Enter Production Cost">
                            </div>

                            <!-- Production Time -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_time"
                                       class="form-label">Production Time (Optional)</label>
                                <input type="number"
                                       class="form-control"
                                       name="production_time"
                                       placeholder="Enter Production Time">
                            </div>

                            <!-- Production Quantity -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_quantity"
                                       class="form-label">Production Quantity (Optional)</label>
                                <input type="number"
                                       class="form-control"
                                       name="production_quantity"
                                       placeholder="Enter Production Quantity">
                            </div>

                            <!-- Production Location -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_location"
                                       class="form-label">Production Location (Optional)</label>
                                <input type="text"
                                       class="form-control"
                                       name="production_location"
                                       placeholder="Enter Production Location">
                            </div>

                             <!-- Production Budget -->
                             <div class="col-md-6 col-lg-4">
                                <label for="production_budget"
                                       class="form-label">Production Budget (Optional)</label>
                                <input type="number"
                                       class="form-control"
                                       name="production_budget"
                                       step="any"
                                       placeholder="Enter Production Budget">
                            </div>

                            <!-- Production Priority -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_priority"
                                       class="form-label">Production Priority</label>
                                <select class="form-control"
                                        name="production_priority">
                                    <option value="1" selected>Low</option>
                                    <option value="2">Medium</option>
                                    <option value="3">High</option>
                                </select>
                            </div>

                            <!-- Production Type -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_type"
                                       class="form-label">Production Type (Optional)</label>
                                <input type="text"
                                       class="form-control"
                                       name="production_type"
                                       placeholder="Enter Production Type">
                            </div>


                             <!-- Branch Assignment -->
                             <div class="col-md-6 col-lg-4">
                                <label class="form-label">Branch</label>
                                <select class="form-control"
                                        name="branch_id">
                                    <option value="">Select Branch (Optional)</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Production Notes -->
                            <div class="col-md-12">
                                <label for="production_notes"
                                       class="form-label">Production Notes (Optional)</label>
                                <textarea class="form-control"
                                          name="production_notes"
                                          rows="3"
                                          placeholder="Enter production notes"></textarea>
                            </div>

                            <!-- Production Description -->
                            <div class="col-md-12">
                                <label for="production_description"
                                       class="form-label">Production Description (Optional)</label>
                                <textarea class="form-control"
                                          name="production_description"
                                          rows="3"
                                          placeholder="Enter production description"></textarea>
                            </div>


                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="add_production_plan_data_btn"
                            class="btn btn-primary">Create Production Plan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Start:: EDIT ProductionPlan data modal -->
    <div class="modal fade"
         id="editProductionPlanDataModal"
         tabindex="-1"
         aria-labelledby="editProductionPlanDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="editProductionPlanDataModal">Edit Production Plan</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="edit_production_plan_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden"
                               name="production_plan_id"
                               id="production_plan_id">
                        <div class="row gy-3">
                            <!-- ProductionPlan Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/1.png') }}"
                                             alt="ProductionPlan Logo"
                                             id="edit_production_plan_logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="plan_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- ProductionPlan Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="plan_name"
                                       class="form-label">Plan Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="plan_name"
                                       id="plan_name_edit"
                                       placeholder="Enter Plan Name" required>
                            </div>

                             <!-- Production Start Date -->
                             <div class="col-md-6 col-lg-4">
                                <label for="production_start_date"
                                       class="form-label">Production Start Date</label>
                                <input type="date"
                                       class="form-control"
                                       name="production_start_date"
                                       id="production_start_date_edit"
                                       required>
                            </div>

                            <!-- Production End Date -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_end_date"
                                       class="form-label">Production End Date (Optional)</label>
                                <input type="date"
                                       class="form-control"
                                       name="production_end_date"
                                       id="production_end_date_edit">
                            </div>

                            <!-- Production Status -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_status"
                                       class="form-label">Production Status</label>
                                <select class="form-control"
                                        name="production_status"
                                        id="production_status_edit">
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="on_hold">On Hold</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>

                            <!-- Production Cost -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_cost"
                                       class="form-label">Production Cost (Optional)</label>
                                <input type="number"
                                       class="form-control"
                                       name="production_cost"
                                       step="any"
                                       id="production_cost_edit"
                                       placeholder="Enter Production Cost">
                            </div>

                            <!-- Production Time -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_time"
                                       class="form-label">Production Time (Optional)</label>
                                <input type="number"
                                       class="form-control"
                                       name="production_time"
                                       id="production_time_edit"
                                       placeholder="Enter Production Time">
                            </div>

                            <!-- Production Quantity -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_quantity"
                                       class="form-label">Production Quantity (Optional)</label>
                                <input type="number"
                                       class="form-control"
                                       name="production_quantity"
                                       id="production_quantity_edit"
                                       placeholder="Enter Production Quantity">
                            </div>

                            <!-- Production Location -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_location"
                                       class="form-label">Production Location (Optional)</label>
                                <input type="text"
                                       class="form-control"
                                       name="production_location"
                                       id="production_location_edit"
                                       placeholder="Enter Production Location">
                            </div>

                             <!-- Production Budget -->
                             <div class="col-md-6 col-lg-4">
                                <label for="production_budget"
                                       class="form-label">Production Budget (Optional)</label>
                                <input type="number"
                                       class="form-control"
                                       name="production_budget"
                                       step="any"
                                       id="production_budget_edit"
                                       placeholder="Enter Production Budget">
                            </div>

                            <!-- Production Priority -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_priority"
                                       class="form-label">Production Priority</label>
                                <select class="form-control"
                                        name="production_priority"
                                        id="production_priority_edit">
                                    <option value="1">Low</option>
                                    <option value="2">Medium</option>
                                    <option value="3">High</option>
                                </select>
                            </div>

                            <!-- Production Type -->
                            <div class="col-md-6 col-lg-4">
                                <label for="production_type"
                                       class="form-label">Production Type (Optional)</label>
                                <input type="text"
                                       class="form-control"
                                       name="production_type"
                                       id="production_type_edit"
                                       placeholder="Enter Production Type">
                            </div>


                             <!-- Branch Assignment -->
                             <div class="col-md-6 col-lg-4">
                                <label class="form-label">Branch</label>
                                <select class="form-control"
                                        name="branch_id"
                                        id="production_branch_id_edit">
                                    <option value="">Select Branch (Optional)</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Production Notes -->
                            <div class="col-md-12">
                                <label for="production_notes"
                                       class="form-label">Production Notes (Optional)</label>
                                <textarea class="form-control"
                                          name="production_notes"
                                          rows="3"
                                          id="production_notes_edit"
                                          placeholder="Enter production notes"></textarea>
                            </div>

                            <!-- Production Description -->
                            <div class="col-md-12">
                                <label for="production_description"
                                       class="form-label">Production Description (Optional)</label>
                                <textarea class="form-control"
                                          name="production_description"
                                          rows="3"
                                          id="production_description_edit"
                                          placeholder="Enter production description"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="edit_production_plan_data_btn"
                            class="btn btn-primary">Update Production Plan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: EDIT ProductionPlan -->

    <!-- Start:: ProductionPlan Details Offcanvas -->
    <div class="offcanvas offcanvas-end"
         tabindex="-1"
         id="viewProductionPlanDataModal"
         aria-labelledby="viewProductionPlanDataModalLabel">
        <div class="offcanvas-header">
            <h5 id="viewProductionPlanDataModalLabel"
                class="offcanvas-title">Production Plan Details</h5>
        </div>
        <div class="offcanvas-body p-0">
            <div class="d-sm-flex align-items-top border-bottom border-block-end-dashed main-profile-cover p-3">
                <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent me-3 p-2">
                    <img src="{{ asset('assets/images/company-logos/1.png') }}"
                         id="view_production_plan_logo"
                         alt="ProductionPlan Logo">
                </span>
                <div class="flex-fill main-profile-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="fw-medium mb-1"
                            id="view_production_plan_name"></h6>
                        <button type="button"
                                class="btn-close crm-contact-close-btn"
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <p class="text-muted fs-12 mb-2"
                       id="view_production_plan_dates">
                    </p>
                    <p class="text-muted fs-12 mb-2"
                       id="view_production_plan_status">
                        Status: <span class="fw-semibold text-primary"></span>
                    </p>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <div class="mb-0">
                    <p class="fs-15 fw-medium mb-2">Description :</p>
                    <p class="text-muted mb-0"
                       id="view_production_plan_description"></p>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Production Details :</p>
                <div>
                     <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary3-transparent">
                                <i class="ri-calendar-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_production_plan_time">Time: <span class="text-muted">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                <i class="ri-刻印-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_production_plan_quantity">Quantity: <span class="text-muted">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                                <i class="ri-price-tag-3-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_production_plan_cost">Cost: <span class="text-muted">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-info-transparent">
                                <i class="ri- бюджетирование-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_production_plan_budget">Budget: <span class="text-muted">N/A</span></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-danger-transparent">
                                <i class="ri-map-pin-2-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_production_plan_location">Location: <span class="text-muted">N/A</span></div>
                    </div>
                     <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-secondary-transparent">
                                <i class="ri-priority-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_production_plan_priority">Priority: <span class="text-muted">N/A</span></div>
                    </div>
                     <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                <i class="ri-file-text-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_production_plan_notes">Notes: <span class="text-muted">N/A</span></div>
                    </div>
                     <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-info-transparent">
                                <i class="ri-branch-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_production_plan_branch">Branch: <span class="text-muted">N/A</span></div>
                    </div>
                     <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                                <i class="ri-user-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_production_plan_user">Created By: <span class="text-muted">N/A</span></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End:: ProductionPlan Details Offcanvas -->

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

            // Handle form submission with AJAX for production plans
            async function submitProductionPlanForm(formSelector, buttonSelector, url, successMessage, modalSelector =
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
                    productionPlanDataFetchAll();
                    showToast(successMessage, 'success');
                    if (modalSelector) $(modalSelector).modal('hide');
                } catch (error) {
                    console.error('Error submitting form:', error);
                    showToast('Error!', 'An error occurred.', 'error');
                } finally {
                    $(buttonSelector).attr('disabled', false).text('Submit');
                }
            }

            // Bind events for adding and editing production plan data
            $('#add_production_plan_data_form').on('submit', function(e) {
                e.preventDefault();
                submitProductionPlanForm('#add_production_plan_data_form', '#add_production_plan_data_btn',
                    '{{ route('productionplanstore') }}',
                    'New Production plan added successfully!', '#addProductionPlanDataModal');
            });

            $('#edit_production_plan_data_form').on('submit', function(e) {
                e.preventDefault();
                submitProductionPlanForm('#edit_production_plan_data_form', '#edit_production_plan_data_btn',
                    '{{ route('productionplanupdate') }}',
                    'Production plan updated successfully!', '#editProductionPlanDataModal');
            });

            // Edit production plan data modal population
            $(document).on('click', '.EditDataIcon', async function() {
                const id = $(this).attr('id');
                try {
                    const response = await $.ajax({
                        url: '{{ route('productionplanedit') }}',
                        method: 'GET',
                        data: {
                            id,
                            _token: '{{ csrf_token() }}'
                        }
                    });

                    $("#production_plan_id").val(response.id);
                    $("#edit_production_plan_logo").attr('src', response.plan_profile_picture ? response
                        .plan_profile_picture :
                        '{{ asset('assets/images/company-logos/1.png') }}');
                    $("#plan_name_edit").val(response.plan_name);
                    $("#production_start_date_edit").val(response.production_start_date);
                    $("#production_end_date_edit").val(response.production_end_date);
                    $("#production_status_edit").val(response.production_status);
                    $("#production_notes_edit").val(response.production_notes);
                    $("#production_cost_edit").val(response.production_cost);
                    $("#production_time_edit").val(response.production_time);
                    $("#production_quantity_edit").val(response.production_quantity);
                    $("#production_location_edit").val(response.production_location);
                    $("#production_budget_edit").val(response.production_budget);
                    $("#production_priority_edit").val(response.production_priority);
                    $("#production_type_edit").val(response.production_type);
                    $("#production_branch_id_edit").val(response.branch_id);
                    $("#production_description_edit").val(response.production_description);

                    $('#editProductionPlanDataModal').modal('show');
                } catch (error) {
                    console.error('Error fetching Production Plans:', error);
                }
            });

            // View ProductionPlan Data Modal Population
            $(document).on('click', '.ViewDataIcon', async function() {
                const id = $(this).data('id');

                try {
                    const response = await $.ajax({
                        url: `{{ route('productionplanview') }}?id=${id}`,
                        method: 'GET',
                    });

                    console.log(response);

                    $('#view_production_plan_name').text(response.plan_name);
                    $('#view_production_plan_dates').text('Start Date: ' + new Date(response.production_start_date).toLocaleDateString() + (response.production_end_date ? ' | End Date: ' + new Date(response.production_end_date).toLocaleDateString() : ''));
                    $('#view_production_plan_status span').text(response.production_status);
                    $('#view_production_plan_description').text(response.production_description || 'N/A');
                    $('#view_production_plan_time').text('Time: ' + (response.production_time ? response.production_time + ' hours' : 'N/A')); // Adjust unit as needed
                    $('#view_production_plan_quantity').text('Quantity: ' + (response.production_quantity ? parseInt(response.production_quantity).toLocaleString() : 'N/A'));
                    $('#view_production_plan_cost').text('Cost: ₹' + (response.production_cost ? parseFloat(response.production_cost).toLocaleString() : 'N/A'));
                    $('#view_production_plan_budget').text('Budget: ₹' + (response.production_budget ? parseFloat(response.production_budget).toLocaleString() : 'N/A'));
                    $('#view_production_plan_location').text('Location: ' + (response.production_location || 'N/A'));
                    $('#view_production_plan_priority').text('Priority: ' + (response.production_priority || 'N/A'));
                    $('#view_production_plan_notes').text('Notes: ' + (response.production_notes || 'N/A'));
                    $('#view_production_plan_branch').text('Branch: ' + (response.branch ? response.branch.branch_name : 'N/A'));
                    $('#view_production_plan_user').text('Created By: ' + (response.user ? response.user.name : 'N/A'));


                    // ProductionPlan Logo
                    const logoUrl = response.plan_profile_picture ?
                        `${response.plan_profile_picture}` :
                        `{{ asset('assets/images/company-logos/1.png') }}`;
                    $('#view_production_plan_logo').attr('src', logoUrl);


                    $('#viewProductionPlanDataModal').offcanvas('show');

                } catch (error) {
                    console.error('Error fetching production plan details:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load production plan details.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });

            // ProductionPlan Delete Functionality
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
                                url: `{{ url('productionplans') }}/${id}`, // Corrected URL to /productionplans/{id}
                                method: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                }
                            });

                            productionPlanDataFetchAll(productionPlanDateFilterValue);
                            Swal.fire(
                                'Deleted!',
                                'The production plan has been deleted.',
                                'success'
                            );

                        } catch (error) {
                            console.error('Error deleting production plan:', error);
                            Swal.fire(
                                'Error!',
                                'Failed to delete the production plan.',
                                'error'
                            );
                        }
                    }
                });
            });

            // Global variables - keep these!
            let productionPlanDateFilterValue = 'last_90_days'; // Default value for date filter

            async function productionPlanDataFetchAll(dateFilter = 'last_90_days') {
                try {
                    productionPlanDateFilterValue = dateFilter;
                    const response = await $.ajax({
                        url: '{{ route('productionplanfetchall') }}',
                        method: 'GET',
                        data: {
                            date_filter: dateFilter
                        }
                    });

                    $('#show_all_fetched_data').html(response);
                    setupProductionPlanDataTable();
                    $('#date_filter').val(productionPlanDateFilterValue);
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

            // Function to initialize the DataTable for ProductionPlans
            function setupProductionPlanDataTable() {
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

                        // Add date filter dropdown to the table length area - if not already there
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
                                await productionPlanDataFetchAll(dateFilter);
                            }, 300));
                            $('#date_filter').val(productionPlanDateFilterValue);
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
            productionPlanDataFetchAll(productionPlanDateFilterValue);
        });
    </script>

    <script>
        document.getElementById('exportButton').addEventListener('click', function() {
            // Send a POST request for production plan export
            fetch('{{ route('productionplanexport') }}', {
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
                    a.download =
                        `production_plan_export_${new Date().toLocaleDateString()}.xlsx`;
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                })
                .catch(error => console.error('Export failed:', error));
        });
    </script>
@endsection


