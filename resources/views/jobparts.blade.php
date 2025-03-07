@extends('layouts.app')

@section('content')
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Job Parts
                    </div>
                    <div class="d-flex flex-wrap gap-2">

                        <button type="button"
                                class="modal-effect btn btn-white btn-wave"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#addJobPartDataModal">
                            <i class="ri-file-add-line lh-1 me-1 align-middle"></i> New
                        </button>

                        <button type="button"
                                class="modal-effect btn btn-primary3 btn-wave me-0"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#importJobPartDataModal">
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

    <!-- Import Modal -->
    <div class="modal fade"
         id="importJobPartDataModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="importJobPartDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="importJobPartDataModal">Import Job Parts</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="jobpartimport"
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
                                    class="btn btn-primary">Import Job Parts</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Modal (Example - Adjust if needed) -->
    <div class="modal fade"
         id="ExportJobPartModel"
         tabindex="-1"
         role="dialog"
         aria-labelledby="ExportJobPartModel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="ExportJobPartModel">Export Job Parts</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jobpartexport') }}"
                          method="POST">
                        @csrf
                        <label for="job_part_from_date">From Date:</label>
                        <input type="date"
                               name="from_date"
                               id="job_part_from_date"
                               required>

                        <label for="job_part_to_date">To Date:</label>
                        <input type="date"
                               name="to_date"
                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                               id="job_part_to_date"
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

    <!-- Add JobPart Data Modal -->
    <div class="modal fade"
         id="addJobPartDataModal"
         tabindex="-1"
         aria-labelledby="addJobPartDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="addJobPartDataModal">Add Job Part</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="add_job_part_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-3">
                            <!-- JobPart Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/8.png') }}"
                                             alt="JobPart Logo"
                                             name="job-part-logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="job_part_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="job-part-profile-change">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- JobPart Name -->
                            <div class="col-md-6">
                                <label for="job_part_name"
                                       class="form-label">Part Name <span class="text-red">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       name="job_part_name"
                                       placeholder="Enter Part Name"
                                       required>
                            </div>
                            <!-- JobPart Model -->
                            <div class="col-md-6">
                                <label for="job_part_model"
                                       class="form-label">Part Model</label>
                                <input type="text"
                                       class="form-control"
                                       name="job_part_model"
                                       placeholder="Enter Part Model">
                            </div>
                            <!-- JobPart Customer Name -->
                            <div class="col-md-6">
                                <label for="job_part_customer_name"
                                       class="form-label">Customer Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="job_part_customer_name"
                                       placeholder="Enter Customer Name">
                            </div>
                            <!-- HSN No -->
                            <div class="col-md-6">
                                <label for="hsn_no"
                                       class="form-label">HSN No</label>
                                <input type="text"
                                       class="form-control"
                                       name="hsn_no"
                                       placeholder="Enter HSN No">
                            </div>

                            <!-- Dimensions -->
                            <div class="col-md-6">
                                <label class="form-label">Dimensions (mm)</label>
                                <div class="row gy-2">
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_length"
                                               placeholder="Length">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_width"
                                               placeholder="Width">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_height"
                                               placeholder="Height">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_thickness"
                                               placeholder="Thickness">
                                    </div>
                                </div>
                            </div>

                            <!-- LD Ratios -->
                            <div class="col-md-6">
                                <label class="form-label">LD Ratios</label>
                                <div class="row gy-2">
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_ld_ratio"
                                               placeholder="LD Ratio">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_lld_ratio"
                                               placeholder="LLD Ratio">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_hd_ratio"
                                               placeholder="HD Ratio">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_rd_ratio"
                                               placeholder="RD Ratio">
                                    </div>
                                </div>
                            </div>

                            <!-- No Ups & Weight -->
                            <div class="col-md-6">
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <label for="job_part_no_ups"
                                               class="form-label">No. of Ups</label>
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_no_up"
                                               placeholder="No. of Ups">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="job_part_weight"
                                               class="form-label">Weight (kg)</label>
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_weight"
                                               step="any"
                                               placeholder="Weight">
                                    </div>
                                </div>
                            </div>

                            <!-- Sealing Type -->
                            <div class="col-md-6">
                                <label for="job_part_no_sealing_type"
                                       class="form-label">Sealing Type</label>
                                <input type="text"
                                       class="form-control"
                                       name="job_part_no_sealing_type"
                                       placeholder="Sealing Type">
                            </div>

                            <!-- Printing -->
                            <div class="col-md-6">
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_printing_status"
                                                   name="job_printing_status">
                                            <label class="form-check-label"
                                                   for="job_printing_status">Printing Status</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="job_printing_colour"
                                               class="form-label">Printing Colour</label>
                                        <input type="text"
                                               class="form-control"
                                               name="job_printing_colour"
                                               placeholder="Printing Colour">
                                    </div>
                                </div>
                            </div>

                            <!-- Bundle Qty -->
                            <div class="col-md-6">
                                <label for="job_bundle_qty"
                                       class="form-label">Bundle Quantity</label>
                                <input type="number"
                                       class="form-control"
                                       name="job_bundle_qty"
                                       placeholder="Bundle Quantity">
                            </div>

                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="job_part_category"
                                       class="form-label">Category</label>
                                <input type="text"
                                       class="form-control"
                                       name="job_part_category"
                                       placeholder="Category">
                            </div>

                            <!-- Price & Quantity -->
                            <div class="col-md-6">
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <label for="job_part_price"
                                               class="form-label">Price</label>
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_price"
                                               step="any"
                                               placeholder="Price">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="job_part_quantity"
                                               class="form-label">Quantity</label>
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_quantity"
                                               placeholder="Quantity">
                                    </div>
                                </div>
                            </div>

                            <!-- Booleans Checkboxes -->
                            <div class="col-md-12">
                                <div class="row gy-2">
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_bst"
                                                   name="job_bst">
                                            <label class="form-check-label"
                                                   for="job_bst">BST</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_lain"
                                                   name="job_lain">
                                            <label class="form-check-label"
                                                   for="job_lain">LAIN</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_flat"
                                                   name="job_flat">
                                            <label class="form-check-label"
                                                   for="job_flat">FLAT</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_gazzate"
                                                   name="job_gazzate">
                                            <label class="form-check-label"
                                                   for="job_gazzate">GAZZATE</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_bio"
                                                   name="job_bio">
                                            <label class="form-check-label"
                                                   for="job_bio">BIO</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_normal"
                                                   name="job_normal">
                                            <label class="form-check-label"
                                                   for="job_normal">NORMAL</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_milky"
                                                   name="job_milky">
                                            <label class="form-check-label"
                                                   for="job_milky">MILKY</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_roto_printing"
                                                   name="job_roto_printing">
                                            <label class="form-check-label"
                                                   for="job_roto_printing">ROTO Printing</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_flexo_printing"
                                                   name="job_flexo_printing">
                                            <label class="form-check-label"
                                                   for="job_flexo_printing">FLEXO Printing</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_sideseal"
                                                   name="job_sideseal">
                                            <label class="form-check-label"
                                                   for="job_sideseal">SIDE SEAL</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_recycle_logo"
                                                   name="job_recycle_logo">
                                            <label class="form-check-label"
                                                   for="job_recycle_logo">Recycle Logo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Job Part Status -->
                            <div class="col-md-6">
                                <label for="job_part_status"
                                       class="form-label">Part Status</label>
                                <select class="form-control"
                                        name="job_part_status">
                                    <option value="active"
                                            selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>

                            <!-- Job Status -->
                            <div class="col-md-6">
                                <label for="job_status"
                                       class="form-label">Job Status</label>
                                <select class="form-control"
                                        name="job_status">
                                    <option value="pending"
                                            selected>Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="on_hold">On Hold</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>

                            <!-- Branch & Customer Assignment -->
                            <div class="col-md-6">
                                <label class="form-label">Relationships</label>
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                name="branch_id">
                                            <option value="">Select Branch (Optional)</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                name="customer_id">
                                            <option value="">Select Customer (Optional)</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Machine & Plan Assignment -->
                            <div class="col-md-6">
                                <label class="form-label">&nbsp;</label> <!-- For alignment with previous section -->
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                name="machine_id">
                                            <option value="">Select Machine (Optional)</option>
                                            @foreach ($machines as $machine)
                                                <option value="{{ $machine->id }}">{{ $machine->machine_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                name="plan_id">
                                            <option value="">Select Production Plan (Optional)</option>
                                            @foreach ($productionPlans as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->plan_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Part Assignment -->
                            <div class="col-md-6">
                                <label class="form-label">&nbsp;</label>
                                <div class="row gy-2">
                                    <div class="col-sm-12">
                                        <select class="form-control"
                                                name="part_id">
                                            <option value="">Select Part (Optional)</option>
                                            @foreach ($parts as $part)
                                                <option value="{{ $part->id }}">{{ $part->part_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <!-- Machine Type & Branch Name -->
                            <div class="col-md-6">
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <label for="machine_type"
                                               class="form-label">Machine Type</label>
                                        <input type="text"
                                               class="form-control"
                                               name="machine_type"
                                               placeholder="Machine Type">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="branch_name"
                                               class="form-label">Branch Name</label>
                                        <input type="text"
                                               class="form-control"
                                               name="branch_name"
                                               placeholder="Branch Name">
                                    </div>
                                </div>
                            </div>

                            <!-- Job Part Documents -->
                            <div class="col-md-12">
                                <label for="job_part_documents"
                                       class="form-label">Documents (Optional)</label>
                                <textarea class="form-control"
                                          name="job_part_documents"
                                          rows="2"
                                          placeholder="Documents"></textarea>
                            </div>

                            <!-- Job Part Tags -->
                            <div class="col-md-12">
                                <label for="job_part_tags"
                                       class="form-label">Tags (Optional)</label>
                                <textarea class="form-control"
                                          name="job_part_tags"
                                          rows="2"
                                          placeholder="Tags"></textarea>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label for="job_part_description"
                                       class="form-label">Description (Optional)</label>
                                <textarea class="form-control"
                                          name="job_part_description"
                                          rows="3"
                                          placeholder="Enter description"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="add_job_part_data_btn"
                            class="btn btn-primary">Create Job Part</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit JobPart Data Modal -->
    <div class="modal fade"
         id="editJobPartDataModal"
         tabindex="-1"
         aria-labelledby="editJobPartDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="editJobPartDataModal">Edit Job Part</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="edit_job_part_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden"
                               name="job_part_id"
                               id="job_part_id_edit">
                        <div class="row gy-3">
                            <!-- JobPart Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/1.png') }}"
                                             alt="JobPart Logo"
                                             id="edit_job_part_logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="job_part_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="edit_job_part_profile_change">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- JobPart Name -->
                            <div class="col-md-6">
                                <label for="job_part_name"
                                       class="form-label">Part Name <span class="text-red">*</span></label>
                                <input type="text"
                                       class="form-control"
                                       name="job_part_name"
                                       id="job_part_name_edit"
                                       placeholder="Enter Part Name"
                                       required>
                            </div>
                            <!-- JobPart Model -->
                            <div class="col-md-6">
                                <label for="job_part_model"
                                       class="form-label">Part Model</label>
                                <input type="text"
                                       class="form-control"
                                       name="job_part_model"
                                       id="job_part_model_edit"
                                       placeholder="Enter Part Model">
                            </div>
                            <!-- JobPart Customer Name -->
                            <div class="col-md-6">
                                <label for="job_part_customer_name"
                                       class="form-label">Customer Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="job_part_customer_name"
                                       id="job_part_customer_name_edit"
                                       placeholder="Enter Customer Name">
                            </div>
                            <!-- HSN No -->
                            <div class="col-md-6">
                                <label for="hsn_no"
                                       class="form-label">HSN No</label>
                                <input type="text"
                                       class="form-control"
                                       name="hsn_no"
                                       id="hsn_no_edit"
                                       placeholder="Enter HSN No">
                            </div>

                            <!-- Dimensions -->
                            <div class="col-md-6">
                                <label class="form-label">Dimensions (mm)</label>
                                <div class="row gy-2">
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_length"
                                               id="job_part_length_edit"
                                               placeholder="Length">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_width"
                                               id="job_part_width_edit"
                                               placeholder="Width">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_height"
                                               id="job_part_height_edit"
                                               placeholder="Height">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_thickness"
                                               id="job_part_thickness_edit"
                                               placeholder="Thickness">
                                    </div>
                                </div>
                            </div>

                            <!-- LD Ratios -->
                            <div class="col-md-6">
                                <label class="form-label">LD Ratios</label>
                                <div class="row gy-2">
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_ld_ratio"
                                               id="job_part_ld_ratio_edit"
                                               placeholder="LD Ratio">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_lld_ratio"
                                               id="job_part_lld_ratio_edit"
                                               placeholder="LLD Ratio">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_hd_ratio"
                                               id="job_part_hd_ratio_edit"
                                               placeholder="HD Ratio">
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <input type="number"
                                               class="form-control"
                                               name="job_part_rd_ratio"
                                               id="job_part_rd_ratio_edit"
                                               placeholder="RD Ratio">
                                    </div>
                                </div>
                            </div>

                            <!-- No Ups & Weight -->
                            <div class="col-md-6">
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <label for="job_part_no_ups"
                                               class="form-label">No. of Ups</label>
                                        <input type="number"
                                               class="form-control"
                                               id="job_part_no_ups_edit"
                                               name="job_part_no_ups"
                                               placeholder="No. of Ups">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="job_part_weight"
                                               class="form-label">Weight (kg)</label>
                                        <input type="number"
                                               class="form-control"
                                               id="job_part_weight_edit"
                                               name="job_part_weight"
                                               step="any"
                                               placeholder="Weight">
                                    </div>
                                </div>
                            </div>

                            <!-- Sealing Type -->
                            <div class="col-md-6">
                                <label for="job_part_no_sealing_type"
                                       class="form-label">Sealing Type</label>
                                <input type="text"
                                       class="form-control"
                                       id="job_part_no_sealing_type_edit"
                                       name="job_part_no_sealing_type"
                                       placeholder="Sealing Type">
                            </div>

                            <!-- Printing -->
                            <div class="col-md-6">
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_printing_status_edit"
                                                   name="job_printing_status">
                                            <label class="form-check-label"
                                                   for="job_printing_status_edit">Printing Status</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="job_printing_colour"
                                               class="form-label">Printing Colour</label>
                                        <input type="text"
                                               class="form-control"
                                               id="job_printing_colour_edit"
                                               name="job_printing_colour"
                                               placeholder="Printing Colour">
                                    </div>
                                </div>
                            </div>

                            <!-- Bundle Qty -->
                            <div class="col-md-6">
                                <label for="job_bundle_qty"
                                       class="form-label">Bundle Quantity</label>
                                <input type="number"
                                       class="form-control"
                                       id="job_bundle_qty_edit"
                                       name="job_bundle_qty"
                                       placeholder="Bundle Quantity">
                            </div>

                            <!-- Category -->
                            <div class="col-md-6">
                                <label for="job_part_category"
                                       class="form-label">Category</label>
                                <input type="text"
                                       class="form-control"
                                       id="job_part_category_edit"
                                       name="job_part_category"
                                       placeholder="Category">
                            </div>

                            <!-- Price & Quantity -->
                            <div class="col-md-6">
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <label for="job_part_price"
                                               class="form-label">Price</label>
                                        <input type="number"
                                               class="form-control"
                                               id="job_part_price_edit"
                                               name="job_part_price"
                                               step="any"
                                               placeholder="Price">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="job_part_quantity"
                                               class="form-label">Quantity</label>
                                        <input type="number"
                                               class="form-control"
                                               id="job_part_quantity_edit"
                                               name="job_part_quantity"
                                               placeholder="Quantity">
                                    </div>
                                </div>
                            </div>

                            <!-- Booleans Checkboxes -->
                            <div class="col-md-12">
                                <div class="row gy-2">
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_bst_edit"
                                                   name="job_bst">
                                            <label class="form-check-label"
                                                   for="job_bst_edit">BST</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_lain_edit"
                                                   name="job_lain">
                                            <label class="form-check-label"
                                                   for="job_lain_edit">LAIN</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_flat_edit"
                                                   name="job_flat">
                                            <label class="form-check-label"
                                                   for="job_flat_edit">FLAT</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_gazzate_edit"
                                                   name="job_gazzate">
                                            <label class="form-check-label"
                                                   for="job_gazzate_edit">GAZZATE</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_bio_edit"
                                                   name="job_bio">
                                            <label class="form-check-label"
                                                   for="job_bio_edit">BIO</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_normal_edit"
                                                   name="job_normal">
                                            <label class="form-check-label"
                                                   for="job_normal_edit">NORMAL</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_milky_edit"
                                                   name="job_milky">
                                            <label class="form-check-label"
                                                   for="job_milky_edit">MILKY</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_roto_printing_edit"
                                                   name="job_roto_printing">
                                            <label class="form-check-label"
                                                   for="job_roto_printing_edit">ROTO Printing</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_flexo_printing_edit"
                                                   name="job_flexo_printing">
                                            <label class="form-check-label"
                                                   for="job_flexo_printing_edit">FLEXO Printing</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_sideseal_edit"
                                                   name="job_sideseal">
                                            <label class="form-check-label"
                                                   for="job_sideseal_edit">SIDE SEAL</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   id="job_recycle_logo_edit"
                                                   name="job_recycle_logo">
                                            <label class="form-check-label"
                                                   for="job_recycle_logo_edit">Recycle Logo</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Job Part Status -->
                            <div class="col-md-6">
                                <label for="job_part_status"
                                       class="form-label">Part Status</label>
                                <select class="form-control"
                                        name="job_part_status"
                                        id="job_part_status_edit">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>

                            <!-- Job Status -->
                            <div class="col-md-6">
                                <label for="job_status"
                                       class="form-label">Job Status</label>
                                <select class="form-control"
                                        name="job_status"
                                        id="job_status_edit">
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                    <option value="on_hold">On Hold</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>

                            <!-- Branch & Customer Assignment -->
                            <div class="col-md-6">
                                <label class="form-label">Relationships</label>
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                name="branch_id"
                                                id="job_part_branch_id_edit">
                                            <option value="">Select Branch (Optional)</option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                name="customer_id"
                                                id="job_part_customer_id_edit">
                                            <option value="">Select Customer (Optional)</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->customer_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Machine & Plan Assignment -->
                            <div class="col-md-6">
                                <label class="form-label">&nbsp;</label> <!-- For alignment with previous section -->
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                name="machine_id"
                                                id="job_part_machine_id_edit">
                                            <option value="">Select Machine (Optional)</option>
                                            @foreach ($machines as $machine)
                                                <option value="{{ $machine->id }}">{{ $machine->machine_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <select class="form-control"
                                                name="plan_id"
                                                id="job_part_plan_id_edit">
                                            <option value="">Select Production Plan (Optional)</option>
                                            @foreach ($productionPlans as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->plan_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Part Assignment -->
                            <div class="col-md-6">
                                <label class="form-label">&nbsp;</label>
                                <div class="row gy-2">
                                    <div class="col-sm-12">
                                        <select class="form-control"
                                                name="part_id"
                                                id="job_part_part_id_edit">
                                            <option value="">Select Part (Optional)</option>
                                            @foreach ($parts as $part)
                                                <option value="{{ $part->id }}">{{ $part->part_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Machine Type & Branch Name -->
                            <div class="col-md-6">
                                <div class="row gy-2">
                                    <div class="col-sm-6">
                                        <label for="machine_type"
                                               class="form-label">Machine Type</label>
                                        <input type="text"
                                               class="form-control"
                                               id="job_part_machine_type_edit"
                                               name="machine_type"
                                               placeholder="Machine Type">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="branch_name"
                                               class="form-label">Branch Name</label>
                                        <input type="text"
                                               class="form-control"
                                               id="job_part_branch_name_edit"
                                               name="branch_name"
                                               placeholder="Branch Name">
                                    </div>
                                </div>
                            </div>

                            <!-- Job Part Documents -->
                            <div class="col-md-12">
                                <label for="job_part_documents"
                                       class="form-label">Documents (Optional)</label>
                                <textarea class="form-control"
                                          id="job_part_documents_edit"
                                          name="job_part_documents"
                                          rows="2"
                                          placeholder="Documents"></textarea>
                            </div>

                            <!-- Job Part Tags -->
                            <div class="col-md-12">
                                <label for="job_part_tags"
                                       class="form-label">Tags (Optional)</label>
                                <textarea class="form-control"
                                          id="job_part_tags_edit"
                                          name="job_part_tags"
                                          rows="2"
                                          placeholder="Tags"></textarea>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <label for="job_part_description"
                                       class="form-label">Description (Optional)</label>
                                <textarea class="form-control"
                                          id="job_part_description_edit"
                                          name="job_part_description"
                                          rows="3"
                                          placeholder="Enter description"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="edit_job_part_data_btn"
                            class="btn btn-primary">Update Job Part</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: EDIT JobPart -->

    <!-- View JobPart Details Offcanvas -->
    <div class="offcanvas offcanvas-end"
         tabindex="-1"
         id="viewJobPartDataModal"
         aria-labelledby="viewJobPartDataModalLabel">
        <div class="offcanvas-header">
            <h5 id="viewJobPartDataModalLabel"
                class="offcanvas-title">Job Part Details</h5>
        </div>
        <div class="offcanvas-body p-0">
            <div class="d-sm-flex align-items-top border-bottom border-block-end-dashed main-profile-cover p-3">
                <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent me-3 p-2">
                    <img src="{{ asset('assets/images/company-logos/1.png') }}"
                         id="view_job_part_logo"
                         alt="JobPart Logo">
                </span>
                <div class="flex-fill main-profile-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="fw-medium mb-1"
                            id="view_job_part_name"></h6>
                        <button type="button"
                                class="btn-close crm-contact-close-btn"
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <p class="text-muted fs-12 mb-2"
                       id="view_job_part_model">
                    </p>
                    <p class="text-muted fs-12 mb-2"
                       id="view_job_part_status_text">
                        Status: <span class="fw-semibold"></span>
                    </p>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <div class="mb-0">
                    <p class="fs-15 fw-medium mb-2">Description :</p>
                    <p class="text-muted mb-0"
                       id="view_job_part_description"></p>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Job Part Details :</p>
                <div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-primary3-transparent">
                                        <i class="ri-ruler-2-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_dimensions">Dimensions: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                        <i class="ri-ratio-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_ld_ratios">LD Ratios: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                                        <i class="ri-ups-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_no_ups">No. Ups: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-info-transparent">
                                        <i class="ri-重数-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_weight">Weight: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-danger-transparent">
                                        <i class="ri-sealing-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_sealing_type">Sealing: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-secondary-transparent">
                                        <i class="ri-palette-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_printing_colour">Print Colour: <span class="text-muted">N/A</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-info-transparent">
                                        <i class="ri-bundle-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_bundle_qty">Bundle Qty: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                                        <i class="ri-category-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_category">Category: <span class="text-muted"></span></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-primary3-transparent">
                                        <i class="ri-price-tag-3-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_price">Price: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                        <i class="ri-format-quantity-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_quantity">Quantity: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                                        <i class="ri-checkbox-multiple-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_booleans">Features: <span class="text-muted">N/A</span></div>
                                <!-- Display boolean flags here dynamically -->
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-info-transparent">
                                        <i class="ri-file-text-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_documents">Documents: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-danger-transparent">
                                        <i class="ri-price-tag-3-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_tags">Tags: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-secondary-transparent">
                                        <i class="ri-branch-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_branch">Branch: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                        <i class="ri-loader-4-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_job_status">Job Status: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-info-transparent">
                                        <i class="ri-machine-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_machine">Machine: <span class="text-muted">N/A</span></div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <div class="me-2">
                                    <span class="avatar avatar-sm avatar-rounded bg-info-transparent">
                                        <i class="ri-box-3-line fs-14 align-middle"></i>
                                    </span>
                                </div>
                                <div id="view_job_part_part">Part: <span class="text-muted">N/A</span></div>
                                <!-- Display Part -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: JobPart Details Offcanvas -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

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

            // Handle form submission with AJAX for job parts
            async function submitJobPartForm(formSelector, buttonSelector, url, successMessage, modalSelector =
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
                    jobPartDataFetchAll();
                    showToast(successMessage, 'success');
                    if (modalSelector) $(modalSelector).modal('hide');
                } catch (error) {
                    console.error('Error submitting form:', error);
                    showToast('Error!', 'An error occurred.', 'error');
                } finally {
                    $(buttonSelector).attr('disabled', false).text('Submit');
                }
            }

            // Bind events for adding and editing job part data
            $('#add_job_part_data_form').on('submit', function(e) {
                e.preventDefault();
                submitJobPartForm('#add_job_part_data_form', '#add_job_part_data_btn',
                    '{{ route('jobpartstore') }}',
                    'New Job part added successfully!', '#addJobPartDataModal');
            });

            $('#edit_job_part_data_form').on('submit', function(e) {
                e.preventDefault();
                submitJobPartForm('#edit_job_part_data_form', '#edit_job_part_data_btn',
                    '{{ route('jobpartupdate') }}',
                    'Job part updated successfully!', '#editJobPartDataModal');
            });

            // Edit job part data modal population
            $(document).on('click', '.EditDataIcon', async function() {
                const id = $(this).attr('id');
                try {
                    const response = await $.ajax({
                        url: '{{ route('jobpartedit') }}',
                        method: 'GET',
                        data: {
                            id,
                            _token: '{{ csrf_token() }}'
                        }
                    });

                    $("#job_part_id_edit").val(response.id);
                    $("#edit_job_part_logo").attr('src', response.job_part_profile_picture ? response
                        .job_part_profile_picture :
                        '{{ asset('assets/images/company-logos/1.png') }}');
                    $("#job_part_name_edit").val(response.job_part_name);
                    $("#job_part_model_edit").val(response.job_part_model);
                    $("#job_part_customer_name_edit").val(response.job_part_customer_name);
                    $("#hsn_no_edit").val(response.hsn_no);
                    $("#job_part_length_edit").val(response.job_part_length);
                    $("#job_part_width_edit").val(response.job_part_width);
                    $("#job_part_height_edit").val(response.job_part_height);
                    $("#job_part_thickness_edit").val(response.job_part_thickness);
                    $("#job_part_ld_ratio_edit").val(response.job_part_ld_ratio);
                    $("#job_part_lld_ratio_edit").val(response.job_part_lld_ratio);
                    $("#job_part_hd_ratio_edit").val(response.job_part_hd_ratio);
                    $("#job_part_rd_ratio_edit").val(response.job_part_rd_ratio);
                    $("#job_part_no_ups_edit").val(response.job_part_no_ups);
                    $("#job_part_weight_edit").val(response.job_part_weight);
                    $("#job_part_no_sealing_type_edit").val(response.job_part_no_sealing_type);
                    $("#job_printing_status_edit").prop('checked', response.job_printing_status);
                    $("#job_printing_colour_edit").val(response.job_printing_colour);
                    $("#job_bundle_qty_edit").val(response.job_bundle_qty);
                    $("#job_part_category_edit").val(response.job_part_category);
                    $("#job_part_price_edit").val(response.job_part_price);
                    $("#job_part_quantity_edit").val(response.job_part_quantity);
                    $("#job_bst_edit").prop('checked', response.job_bst);
                    $("#job_lain_edit").prop('checked', response.job_lain);
                    $("#job_flat_edit").prop('checked', response.job_flat);
                    $("#job_gazzate_edit").prop('checked', response.job_gazzate);
                    $("#job_bio_edit").prop('checked', response.job_bio);
                    $("#job_normal_edit").prop('checked', response.job_normal);
                    $("#job_milky_edit").prop('checked', response.job_milky);
                    $("#job_roto_printing_edit").prop('checked', response.job_roto_printing);
                    $("#job_flexo_printing_edit").prop('checked', response.job_flexo_printing);
                    $("#job_sideseal_edit").prop('checked', response.job_sideseal);
                    $("#job_recycle_logo_edit").prop('checked', response.job_recycle_logo);
                    $("#job_part_status_edit").val(response.job_part_status);
                    $("#job_part_documents_edit").val(response.job_part_documents);
                    $("#job_part_tags_edit").val(response.job_part_tags);
                    $("#job_part_branch_id_edit").val(response.branch_id);
                    $("#job_part_customer_id_edit").val(response.customer_id);
                    $("#job_part_machine_id_edit").val(response.machine_id);
                    $("#job_part_plan_id_edit").val(response.plan_id);
                    $("#job_part_part_id_edit").val(response.part_id); // Set Part ID in edit form
                    $("#job_part_branch_name_edit").val(response.branch_name);
                    $("#job_part_machine_type_edit").val(response.machine_type);
                    $("#job_part_description_edit").val(response.job_part_description);
                    $("#job_status_edit").val(response.job_status);


                    $('#editJobPartDataModal').modal('show');
                } catch (error) {
                    console.error('Error fetching Job Parts:', error);
                }
            });

            // View JobPart Data Modal Population
            $(document).on('click', '.ViewDataIcon', async function() {
                const id = $(this).data('id');

                try {
                    const response = await $.ajax({
                        url: `{{ route('jobpartview') }}?id=${id}`,
                        method: 'GET',
                    });

                    console.log(response);

                    $('#view_job_part_name').text(response.job_part_name);
                    $('#view_job_part_model').text('Model: ' + (response.job_part_model || 'N/A'));
                    $('#view_job_part_status_text span').text(response.job_part_status);
                    $('#view_job_part_status_text span').removeClass().addClass('fw-semibold text-' + (
                        response.job_part_status === 'active' ? 'success' : (response
                            .job_part_status === 'inactive' ? 'danger' : 'warning')
                    )); // Example status coloring

                    $('#view_job_part_description').text(response.job_part_description || 'N/A');
                    $('#view_job_part_dimensions').text('Dimensions: L:' + (response.job_part_length ||
                        'N/A') + ' W:' + (response.job_part_width || 'N/A') + ' H:' + (response
                        .job_part_height || 'N/A') + ' T:' + (response.job_part_thickness ||
                        'N/A'));
                    $('#view_job_part_ld_ratios').text('LD Ratios: LD:' + (response.job_part_ld_ratio ||
                        'N/A') + ', LLD:' + (response.job_part_lld_ratio || 'N/A') + ', HD:' + (
                        response.job_part_hd_ratio || 'N/A') + ', RD:' + (response
                        .job_part_rd_ratio || 'N/A'));
                    $('#view_job_part_no_ups').text('No. Ups: ' + (response.job_part_no_ups || 'N/A'));
                    $('#view_job_part_weight').text('Weight: ' + (response.job_part_weight ? response
                        .job_part_weight + ' kg' : 'N/A'));
                    $('#view_job_part_sealing_type').text('Sealing Type: ' + (response
                        .job_part_no_sealing_type || 'N/A'));
                    $('#view_job_part_printing_colour').text('Printing Color: ' + (response
                        .job_printing_colour || 'N/A'));
                    $('#view_job_part_bundle_qty').text('Bundle Qty: ' + (response.job_bundle_qty ||
                        'N/A'));
                    $('#view_job_part_category').text('Category: ' + (response.job_part_category ||
                        'N/A'));
                    $('#view_job_part_price').text('Price: ₹' + (response.job_part_price ? parseFloat(
                        response.job_part_price).toLocaleString() : 'N/A'));
                    $('#view_job_part_quantity').text('Quantity: ' + (response.job_part_quantity ?
                        parseInt(response.job_part_quantity).toLocaleString() : 'N/A'));
                    $('#view_job_part_documents').text('Documents: ' + (response.job_part_documents ||
                        'N/A'));
                    $('#view_job_part_tags').text('Tags: ' + (response.job_part_tags || 'N/A'));
                    $('#view_job_part_branch').text('Branch: ' + (response.branch ? response.branch
                        .branch_name : 'N/A'));
                    $('#view_job_part_job_status').text('Job Status: ' + (response.job_status ||
                        'N/A'));
                    $('#view_job_part_machine').text('Machine: ' + (response.machine ? response.machine
                        .machine_name : 'N/A'));
                    $('#view_job_part_part').text('Part: ' + (response.part ? response.part.part_name :
                        'N/A')); // Display Part Name in view modal


                    // Boolean Flags Display (Dynamic)
                    let booleanFeatures = [];
                    if (response.job_bst) booleanFeatures.push('BST');
                    if (response.job_lain) booleanFeatures.push('LAIN');
                    if (response.job_flat) booleanFeatures.push('FLAT');
                    if (response.job_gazzate) booleanFeatures.push('GAZZATE');
                    if (response.job_bio) booleanFeatures.push('BIO');
                    if (response.job_normal) booleanFeatures.push('NORMAL');
                    if (response.job_milky) booleanFeatures.push('MILKY');
                    if (response.job_roto_printing) booleanFeatures.push('ROTO Printing');
                    if (response.job_flexo_printing) booleanFeatures.push('FLEXO Printing');
                    if (response.job_sideseal) booleanFeatures.push('SIDE SEAL');
                    if (response.job_recycle_logo) booleanFeatures.push('Recycle Logo');

                    $('#view_job_part_booleans').text('Features: ' + (booleanFeatures.length > 0 ?
                        booleanFeatures.join(', ') : 'N/A'));


                    // JobPart Logo
                    const logoUrl = response.job_part_profile_picture ?
                        `${response.job_part_profile_picture}` :
                        `{{ asset('assets/images/company-logos/1.png') }}`;
                    $('#view_job_part_logo').attr('src', logoUrl);


                    $('#viewJobPartDataModal').offcanvas('show');

                } catch (error) {
                    console.error('Error fetching job part details:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load job part details.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });

            // JobPart Delete Functionality
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
                                url: `{{ url('jobparts') }}/${id}`, // Corrected URL to /jobparts/{id}
                                method: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                }
                            });

                            jobPartDataFetchAll(jobPartDateFilterValue);
                            Swal.fire(
                                'Deleted!',
                                'The job part has been deleted.',
                                'success'
                            );

                        } catch (error) {
                            console.error('Error deleting job part:', error);
                            Swal.fire(
                                'Error!',
                                'Failed to delete the job part.',
                                'error'
                            );
                        }
                    }
                });
            });

            // Global variables - keep these!
            let jobPartDateFilterValue = 'last_90_days'; // Default value for date filter

            async function jobPartDataFetchAll(dateFilter = 'last_90_days') {
                try {
                    jobPartDateFilterValue = dateFilter;
                    const response = await $.ajax({
                        url: '{{ route('jobpartfetchall') }}',
                        method: 'GET',
                        data: {
                            date_filter: dateFilter
                        }
                    });

                    $('#show_all_fetched_data').html(response);
                    setupJobPartDataTable();
                    $('#date_filter').val(jobPartDateFilterValue);
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

            // Function to initialize the DataTable for JobParts
            function setupJobPartDataTable() {
                if ($.fn.DataTable.isDataTable('#data_fetch_table')) {
                    $('#data_fetch_table').DataTable().destroy();
                }

                const dataTable = $('#data_fetch_table').DataTable({
                    processing: true,
                    responsive: true,
                    scrollY: "50vh",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: true,
                    fixedColumns: {
                        leftColumns: 2,
                        rightColumns: 1
                    },
                    language: {
                        emptyTable: "No Job Parts Available"
                    },
                    // Add export buttons
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ]
                });

                // Handle date filter change event using debouncing for Job Parts
                $('#date_filter').off('change').on('change', debounce(function() {
                    const selectedDateFilter = $(this).val();
                    jobPartDataFetchAll(selectedDateFilter);
                }, 500)); // 500ms delay
            }


            // Initial data fetch and DataTable setup for Job Parts
            jobPartDataFetchAll();

        });
    </script>
        <script>
            document.getElementById('exportButton').addEventListener('click', function() {
                // Send a POST request for machine export
                fetch('{{ route('machineexport') }}', {
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
                            `machine_export_${new Date().toLocaleDateString()}.xlsx`;
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    })
                    .catch(error => console.error('Export failed:', error));
            });
        </script>
@endsection
