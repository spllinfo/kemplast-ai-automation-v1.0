@extends('layouts.app')

@section('content')
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Branches <span
                              class="badge bg-primary text-default fs-12 text-fixed-white ms-2 rounded align-middle">23</span>
                    </div>
                    <div class="d-flex flex-wrap gap-2">

                        <button type="button"
                                class="modal-effect btn btn-white btn-wave"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#addBranchDataModal">
                            <i class="ri-file-add-line lh-1 me-1 align-middle"></i> New
                        </button>

                        <button type="button"
                                class="modal-effect btn btn-primary3 btn-wave me-0"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#importBranchDataModal">
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

    <!-- Add Import From Branch -->
    <div class="modal fade"
         id="importBranchDataModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="importBranchDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="importBranchDataModal">Import Branches</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="branchimport"
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
                                    class="btn btn-primary">Import Branches</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Export From Branch -->
    <div class="modal fade"
         id="ExportBranchModel"
         tabindex="-1"
         role="dialog"
         aria-labelledby="ExportBranchModel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="ExportBranchModel">Export Branches</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('branchexport') }}"
                          method="POST">
                        @csrf
                        <label for="branch_from_date">From Date:</label>
                        <input type="date"
                               name="from_date"
                               id="branch_from_date"
                               required>

                        <label for="branch_to_date">To Date:</label>
                        <input type="date"
                               name="to_date"
                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                               id="branch_to_date"
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

    <!-- Start:: Add Branch add data modal -->
    <div class="modal fade"
         id="addBranchDataModal"
         tabindex="-1"
         aria-labelledby="addBranchDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="addBranchDataModal">Add Branch</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="add_branch_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-3">
                            <!-- Branch Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/8.png') }}"
                                             alt="Branch Logo"
                                             name="branch-logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="branch_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="branch-profile-change">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- Branch Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="branch-name"
                                       class="form-label">Branch Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="branch_name"
                                       placeholder="Enter Branch Name">
                            </div>
                            <!-- Branch Type -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch-type"
                                       class="form-label">Branch Type</label>
                                <input type="text"
                                       class="form-control"
                                       name="branch_type"
                                       placeholder="Enter Branch Type">
                            </div>
                            <!-- Email -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch-mail"
                                       class="form-label">Email</label>
                                <input type="email"
                                       class="form-control"
                                       name="branch_email"
                                       placeholder="Enter Email">
                            </div>
                            <!-- Phone -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch-phone"
                                       class="form-label">Phone No</label>
                                <input type="tel"
                                       class="form-control"
                                       name="branch_phone"
                                       placeholder="Enter Phone Number">
                            </div>

                            <!-- Contact Number -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch-contact-number"
                                       class="form-label">Contact Number</label>
                                <input type="text"
                                       class="form-control"
                                       name="branch_contact_number"
                                       placeholder="Enter Contact Number">
                            </div>

                            <!-- Revenue -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch-revenue"
                                       class="form-label">Revenue</label>
                                <input type="number"
                                       class="form-control"
                                       name="branch_revenue"
                                       placeholder="Branch Revenue">
                            </div>

                            <!-- Address -->
                            <div class="col-md-12 col-lg-8">
                                <label for="branch-address"
                                       class="form-label">Address</label>
                                <input type="text"
                                       class="form-control"
                                       name="branch_address"
                                       placeholder="Branch Address">
                            </div>

                            <!-- City -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch-city"
                                       class="form-label">City</label>
                                <input type="text"
                                       class="form-control"
                                       name="branch_city"
                                       placeholder="Branch City">
                            </div>

                            <!-- Opening Time -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch-opening-time"
                                       class="form-label">Opening Time</label>
                                <input type="time"
                                       class="form-control"
                                       name="branch_opening_time"
                                       placeholder="Opening Time">
                            </div>

                            <!-- Closing Time -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch-closing-time"
                                       class="form-label">Closing Time</label>
                                <input type="time"
                                       class="form-control"
                                       name="branch_closing_time"
                                       placeholder="Closing Time">
                            </div>


                            <!-- Social Media Links -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch-social-media-links"
                                       class="form-label">Social Media Links</label>
                                <input type="text"
                                       class="form-control"
                                       name="social_media_links"
                                       placeholder="Enter Social Media Links (comma separated)">
                            </div>
                            <!-- Additional Notes -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch-additional-notes"
                                       class="form-label">Additional Notes</label>
                                <textarea class="form-control"
                                          name="additional_notes"
                                          rows="3"
                                          placeholder="Enter any additional notes"></textarea>
                            </div>
                            <!-- Description -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch-description"
                                       class="form-label">Description</label>
                                <textarea class="form-control"
                                          name="branch_description"
                                          rows="3"
                                          placeholder="Enter branch description"></textarea>
                            </div>
                            <!-- Map -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch-map"
                                       class="form-label">Map URL (Embed or Link)</label>
                                <textarea class="form-control"
                                          name="branch_map"
                                          rows="3"
                                          placeholder="Embed or Link of Branch Map"></textarea>
                            </div>
                            <!-- Status -->
                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Status</label>
                                <select class="form-control"
                                        name="branch_status">
                                    <option value="1"
                                            selected>Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="add_branch_data_btn"
                            class="btn btn-primary">Create Branch</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Start:: EDIT Branch data modal -->
    <div class="modal fade"
         id="editBranchDataModal"
         tabindex="-1"
         aria-labelledby="editBranchDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="editBranchDataModal">Edit Branch</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="edit_branch_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden"
                               name="branch_id"
                               id="branch_id">
                        <div class="row gy-3">
                            <!-- Branch Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/1.png') }}"
                                             alt="Branch Logo"
                                             id="edit_branch_logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="branch_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- Branch Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="branch_name"
                                       class="form-label">Branch Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="branch_name"
                                       id="branch_name"
                                       value=""
                                       placeholder="Enter Branch Name">
                            </div>
                            <!-- Branch Type -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_type"
                                       class="form-label">Branch Type</label>
                                <input type="text"
                                       class="form-control"
                                       name="branch_type"
                                       id="branch_type"
                                       placeholder="Enter Branch Type">
                            </div>

                            <!-- Email -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_email"
                                       class="form-label">Email</label>
                                <input type="email"
                                       class="form-control"
                                       name="branch_email"
                                       id="branch_email"
                                       value=""
                                       placeholder="Enter Email">
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_phone"
                                       class="form-label">Phone No</label>
                                <input type="tel"
                                       class="form-control"
                                       name="branch_phone"
                                       id="branch_phone"
                                       value=""
                                       placeholder="Enter Phone Number">
                            </div>

                            <!-- Contact Number -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_contact_number"
                                       class="form-label">Contact Number</label>
                                <input type="text"
                                       class="form-control"
                                       name="branch_contact_number"
                                       id="branch_contact_number"
                                       placeholder="Enter Contact Number">
                            </div>

                            <!-- Revenue -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_revenue"
                                       class="form-label">Revenue</label>
                                <input type="number"
                                       class="form-control"
                                       name="branch_revenue"
                                       id="branch_revenue"
                                       value=""
                                       placeholder="Branch Revenue">
                            </div>

                            <!-- Address -->
                            <div class="col-md-12 col-lg-8">
                                <label for="branch_address"
                                       class="form-label">Address</label>
                                <input type="text"
                                       class="form-control"
                                       name="branch_address"
                                       id="branch_address"
                                       value=""
                                       placeholder="Branch Address">
                            </div>

                            <!-- City -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_city"
                                       class="form-label">City</label>
                                <input type="text"
                                       class="form-control"
                                       name="branch_city"
                                       id="branch_city"
                                       value=""
                                       placeholder="Branch City">
                            </div>

                            <!-- Opening Time -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_opening_time"
                                       class="form-label">Opening Time</label>
                                <input type="time"
                                       class="form-control"
                                       name="branch_opening_time"
                                       id="branch_opening_time"
                                       value=""
                                       placeholder="Opening Time">
                            </div>

                            <!-- Closing Time -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_closing_time"
                                       class="form-label">Closing Time</label>
                                <input type="time"
                                       class="form-control"
                                       name="branch_closing_time"
                                       id="branch_closing_time"
                                       value=""
                                       placeholder="Closing Time">
                            </div>

                            <!-- Social Media Links -->
                            <div class="col-md-6 col-lg-4">
                                <label for="social_media_links"
                                       class="form-label">Social Media Links</label>
                                <input type="text"
                                       class="form-control"
                                       name="social_media_links"
                                       id="branch_social_media_links"
                                       value=""
                                       placeholder="Enter Social Media Links">
                            </div>

                            <!-- Additional Notes -->
                            <div class="col-md-6 col-lg-4">
                                <label for="additional_notes"
                                       class="form-label">Additional Notes</label>
                                <textarea class="form-control"
                                          name="additional_notes"
                                          id="branch_additional_notes"
                                          rows="3"
                                          placeholder="Enter any additional notes"></textarea>
                            </div>
                            <!-- Description -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_description"
                                       class="form-label">Description</label>
                                <textarea class="form-control"
                                          name="branch_description"
                                          id="branch_description"
                                          rows="3"
                                          placeholder="Enter branch description"></textarea>
                            </div>
                            <!-- Map -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_map"
                                       class="form-label">Map URL (Embed or Link)</label>
                                <textarea class="form-control"
                                          name="branch_map"
                                          id="branch_map"
                                          rows="3"
                                          placeholder="Embed or Link of Branch Map"></textarea>
                            </div>
                            <!-- Status -->
                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Status</label>
                                <select class="form-control"
                                        name="branch_status"
                                        id="branch_status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="edit_branch_data_btn"
                            class="btn btn-primary">Update Branch</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: EDIT Branch -->

    <!-- Start:: Branch Details Offcanvas -->
    <div class="offcanvas offcanvas-end"
         tabindex="-1"
         id="viewBranchDataModal"
         aria-labelledby="viewBranchDataModalLabel">
        <div class="offcanvas-header">
            <h5 id="viewBranchDataModalLabel"
                class="offcanvas-title">Branch Details</h5>
        </div>
        <div class="offcanvas-body p-0">
            <div class="d-sm-flex align-items-top border-bottom border-block-end-dashed main-profile-cover p-3">
                <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent me-3 p-2">
                    <img src="{{ asset('assets/images/company-logos/1.png') }}"
                         id="view_branch_logo"
                         alt="Branch Logo">
                </span>
                <div class="flex-fill main-profile-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="fw-medium mb-1"
                            id="view_branch_name"></h6>
                        <button type="button"
                                class="btn-close crm-contact-close-btn"
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <p class="text-muted fs-12 mb-2"
                       id="view_branch_type_and_city"></p>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <div class="mb-0">
                    <p class="fs-15 fw-medium mb-2">Branch Description :</p>
                    <p class="text-muted mb-0"
                       id="view_branch_description"></p>
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
                            <span id="view_branch_email"></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary2-transparent">
                                <i class="ri-phone-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_branch_phone"></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary2-transparent">
                                <i class="ri-phone-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_branch_contact_number"></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary3-transparent">
                                <i class="ri-map-pin-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_branch_address"></div>
                    </div>

                </div>
            </div>

            <div class="border-bottom border-block-end-dashed d-flex align-items-center gap-3 p-3">
                <div class="fs-14 fw-medium">Revenue:</div>
                <div id="view_branch_revenue"></div>
            </div>

            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Opening Time:</p>
                <div id="view_branch_opening_time"></div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Closing Time:</p>
                <div id="view_branch_closing_time"></div>
            </div>

            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Social Networks:</p>
                <div class="btn-list mb-0"
                     id="view_branch_social_links"></div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Map:</p>
                <div id="view_branch_map"></div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Additional Notes:</p>
                <div id="view_branch_additional_notes"></div>
            </div>
            <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
                <p class="fs-14 fw-medium mb-0">Status:</p>
                <div id="view_branch_status"></div>
            </div>
        </div>
    </div>
    <!-- End:: Branch Details Offcanvas -->

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

            // Handle form submission with AJAX for branches
            async function submitBranchForm(formSelector, buttonSelector, url, successMessage, modalSelector =
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
                    branchDataFetchAll();
                    showToast(successMessage, 'success');
                    if (modalSelector) $(modalSelector).modal('hide');
                } catch (error) {
                    console.error('Error submitting form:', error);
                    showToast('Error!', 'An error occurred.', 'error');
                } finally {
                    $(buttonSelector).attr('disabled', false).text('Submit');
                }
            }

            // Bind events for adding and editing branch data
            $('#add_branch_data_form').on('submit', function(e) {
                e.preventDefault();
                submitBranchForm('#add_branch_data_form', '#add_branch_data_btn',
                    '{{ route('branchstore') }}',
                    'New Branch added successfully!', '#addBranchDataModal');
            });

            $('#edit_branch_data_form').on('submit', function(e) {
                e.preventDefault();
                submitBranchForm('#edit_branch_data_form', '#edit_branch_data_btn',
                    '{{ route('branchupdate') }}',
                    'Branch updated successfully!', '#editBranchDataModal');
            });

            // Edit branch data modal population
            $(document).on('click', '.EditDataIcon', async function() {
                const id = $(this).attr('id');
                try {
                    const response = await $.ajax({
                        url: '{{ route('branchedit') }}',
                        method: 'GET',
                        data: {
                            id,
                            _token: '{{ csrf_token() }}'
                        }
                    });

                    $("#branch_id").val(response.id);
                    $("#edit_branch_logo").attr('src', response.branch_profile_picture ? response
                        .branch_profile_picture :
                        '{{ asset('assets/images/company-logos/1.png') }}');
                    $("#branch_name").val(response.branch_name);
                    $("#branch_email").val(response.branch_email);
                    $("#branch_phone").val(response.branch_phone);
                    $("#branch_contact_number").val(response.branch_contact_number);
                    $("#branch_revenue").val(response.branch_revenue);
                    $("#branch_address").val(response.branch_address);
                    $("#branch_city").val(response.branch_city);
                    $("#branch_opening_time").val(response.branch_opening_time ? response
                        .branch_opening_time.slice(0, 5) : null); // Format time
                    $("#branch_closing_time").val(response.branch_closing_time ? response
                        .branch_closing_time.slice(0, 5) : null); // Format time
                    $("#branch_social_media_links").val(response.social_media_links);
                    $("#branch_additional_notes").val(response.additional_notes);
                    $("#branch_description").val(response.branch_description);
                    $("#branch_map").val(response.branch_map);
                    $("#branch_type").val(response.branch_type);
                    $("#branch_status").val(response.branch_status);


                    $('#editBranchDataModal').modal('show');
                } catch (error) {
                    console.error('Error fetching Branches:', error);
                }
            });

            // View Branch Data Modal Population
            $(document).on('click', '.ViewDataIcon', async function() {
                const id = $(this).data('id');

                try {
                    const response = await $.ajax({
                        url: `{{ route('branchview') }}?id=${id}`,
                        method: 'GET',
                    });

                    $('#view_branch_name').text(response.branch_name);
                    $('#view_branch_type_and_city').text(response.branch_type + (response.branch_city ?
                        ', ' + response.branch_city : ''));
                    $('#view_branch_email').text(response.branch_email);
                    $('#view_branch_phone').text(response.branch_phone);
                    $('#view_branch_contact_number').text(response.branch_contact_number);
                    $('#view_branch_address').text(response.branch_address);
                    $('#view_branch_description').text(response.branch_description);
                    $('#view_branch_additional_notes').text(response.additional_notes);
                    $('#view_branch_status').text(response.branch_status ? 'Active' : 'Inactive');
                    $('#view_branch_revenue').text(response.branch_revenue ?
                        '₹' + parseInt(response.branch_revenue).toLocaleString() :
                        'N/A');
                    $('#view_branch_opening_time').text(response.branch_opening_time ? response
                        .branch_opening_time.slice(0, 5) : 'N/A'); //Format time
                    $('#view_branch_closing_time').text(response.branch_closing_time ? response
                        .branch_closing_time.slice(0, 5) : 'N/A'); //Format time
                    $('#view_branch_map').html(response.branch_map || 'N/A');


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
                    $('#view_branch_social_links').html(socialButtons || 'N/A');

                    // Branch Logo
                    const logoUrl = response.branch_profile_picture ?
                        `${response.branch_profile_picture}` :
                        `{{ asset('assets/images/company-logos/1.png') }}`;
                    $('#view_branch_logo').attr('src', logoUrl);


                    $('#viewBranchDataModal').offcanvas('show');

                } catch (error) {
                    console.error('Error fetching branch details:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load branch details.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });

            // Branch Delete Functionality
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
                                url: `{{ url('branches') }}/${id}`, // Corrected URL to /branches/{id}
                                method: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                }
                            });

                            branchDataFetchAll(branchDateFilterValue);
                            Swal.fire(
                                'Deleted!',
                                'The branch has been deleted.',
                                'success'
                            );

                        } catch (error) {
                            console.error('Error deleting branch:', error);
                            Swal.fire(
                                'Error!',
                                'Failed to delete the branch.',
                                'error'
                            );
                        }
                    }
                });
            });

            // Global variables - keep these!
            let branchDateFilterValue = 'last_90_days'; // Default value for date filter

            async function branchDataFetchAll(dateFilter = 'last_90_days') {
                try {
                    branchDateFilterValue = dateFilter;
                    const response = await $.ajax({
                        url: '{{ route('branchfetchall') }}',
                        method: 'GET',
                        data: {
                            date_filter: dateFilter
                        }
                    });

                    $('#show_all_fetched_data').html(response);
                    setupBranchDataTable();
                    $('#date_filter').val(branchDateFilterValue);
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

            // Function to initialize the DataTable for Branches
            function setupBranchDataTable() {
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
                                await branchDataFetchAll(dateFilter);
                            }, 300));
                            $('#date_filter').val(branchDateFilterValue);
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
            branchDataFetchAll(branchDateFilterValue);
        });
    </script>

    <script>
        document.getElementById('exportButton').addEventListener('click', function() {
            // Send a POST request for branch export
            fetch('{{ route('branchexport') }}', {
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
                        `branch_export_${new Date().toLocaleDateString()}.xlsx`;
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                })
                .catch(error => console.error('Export failed:', error));
        });
    </script>
@endsection
