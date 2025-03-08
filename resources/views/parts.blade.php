@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
        <div>
            <nav>
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Parts Management</li>
                </ol>
            </nav>
            <h1 class="page-title fw-medium fs-18 mb-0">Parts</h1>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <button type="button"
                    class="modal-effect btn btn-white btn-wave"
                    data-bs-effect="effect-slide-in-right"
                    data-bs-toggle="modal"
                    data-bs-target="#addPartDataModal">
                <i class="ri-file-add-line lh-1 me-1 align-middle"></i> New
            </button>

            <button type="button"
                    class="modal-effect btn btn-primary3 btn-wave me-0"
                    data-bs-effect="effect-slide-in-right"
                    data-bs-toggle="modal"
                    data-bs-target="#importPartDataModal">
                <i class="ri-download-2-line me-1"></i> Import
            </button>
            <button type="button"
                    class="modal-effect btn btn-primary btn-wave me-0"
                    id="exportButton">
                <i class="ri-share-forward-line me-1"></i> Export
            </button>
        </div>
    </div>
    <!-- Page Header Close -->

    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Parts List
                    </div>
                    <div class="d-flex gap-3 align-items-center flex-wrap">
                        <div class="btn-group">
                            <button class="btn btn-outline-light border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti ti-sort-descending-2 me-1"></i> Sort By
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:void(0)">Created Date</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)">Status</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)">Part Name</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)">Newest</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)">Oldest</a></li>
                            </ul>
                        </div>
                        <div class="custom-form-group flex-grow-1">
                            <input type="text" class="form-control" placeholder="Search Parts.." aria-label="Search" aria-describedby="button-addon2">
                            <a href="javascript:void(0);" class="text-muted custom-form-btn"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="show_all_fetched_data"
                         class="table-responsive">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th scope="col">Part ID</th>
                                    <th scope="col">Part Name</th>
                                    <th scope="col">HSN No</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Updated Date</th>
                                    <th scope="col">Weight</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Dimensions</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Table data will be loaded dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->

    <!-- Add Import From Part -->
    <div class="modal fade"
         id="importPartDataModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="importPartDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="importPartDataModal">Import Parts</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="partimport"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Select File</label>
                            <input type="file" class="form-control" name="file">
                            <small class="text-muted">Upload Excel/CSV file with part data</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button"
                                    class="btn btn-light"
                                    data-bs-dismiss="modal">Close</button>
                            <button type="submit"
                                    class="btn btn-primary">Import Parts</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Export From Part -->
    <div class="modal fade"
         id="ExportPartModel"
         tabindex="-1"
         role="dialog"
         aria-labelledby="ExportPartModel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="ExportPartModel">Export Parts</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('partexport') }}"
                          method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="part_from_date">From Date:</label>
                                <input type="date" class="form-control" name="from_date" id="part_from_date" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="part_to_date">To Date:</label>
                                <input type="date" class="form-control" name="to_date" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                                    id="part_to_date" required>
                            </div>
                        </div>
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

    <!-- Start:: Add Part add data modal -->
    <div class="modal fade"
         id="addPartDataModal"
         tabindex="-1"
         aria-labelledby="addPartDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="addPartDataModal">Add Part</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-body add-products">
                                    <form action="#"
                                        method="POST"
                                        id="add_part_data_form"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row gx-4">
                                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                                <div class="card custom-card shadow-none mb-0 border-0">
                                                    <div class="card-body p-0">
                                                        <div class="row gy-3">
                                                            <!-- Basic Information -->
                                                            <div class="col-xl-12">
                                                                <label for="part_name" class="form-label">Part Name <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="part_name" placeholder="Enter Part Name" required>
                                                            </div>

                                                            <div class="col-xl-12">
                                                                <label class="form-label">Customer</label>
                                                                <select class="form-control" name="customer_id">
                                                                    <option value="">Select Customer (Optional)</option>
                                                                    @foreach ($customers as $customer)
                                                                        <option value="{{ $customer->id }}">{{ $customer->customer_unique_code }}- {{ $customer->company_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <label for="part_category" class="form-label">Category</label>
                                                                <select class="form-control" data-trigger name="part_category">
                                                                    <option value="">Select Category</option>
                                                                    <option value="Garbage Bags">Garbage Bags</option>
                                                                    <option value="LD Plain Bags">LD Plain Bags</option>
                                                                    <option value="Food Packaging">Food Packaging</option>
                                                                    <option value="Industrial Packaging">Industrial Packaging</option>
                                                                    <option value="Agricultural Bags">Agricultural Bags</option>
                                                                    <option value="Gusseted Bags">Gusseted Bags</option>
                                                                    <option value="Zip Lock Bags">Zip Lock Bags</option>
                                                                    <option value="Biodegradable Bags">Biodegradable Bags</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <label for="part_model" class="form-label">Part Type</label>
                                                                <input type="text" class="form-control" name="part_model" placeholder="Enter Part Type">
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <label for="hsn_no" class="form-label">HSN No</label>
                                                                <input type="text" class="form-control" name="hsn_no" placeholder="Enter HSN No">
                                                            </div>
                                                            <div class="col-xl-6">
                                                                <label for="reel_size" class="form-label">Reel Size</label>
                                                                <input type="text" class="form-control" name="reel_size" placeholder="Enter Reel Size">
                                                            </div>

                                                            <!-- Part Dimensions -->
                                                            <div class="col-12">
                                                                <h5 class="mt-3">Part Dimensions (in mm)</h5>
                                                            </div>
                                                            <div class="col-xl-3">
                                                                <label for="part_length" class="form-label">Length</label>
                                                                <input type="number" step="0.001" class="form-control" name="part_length" placeholder="Length">
                                                            </div>
                                                            <div class="col-xl-3">
                                                                <label for="part_width" class="form-label">Width</label>
                                                                <input type="number" step="0.001" class="form-control" name="part_width" placeholder="Width">
                                                            </div>
                                                            <div class="col-xl-3">
                                                                <label for="part_height" class="form-label">Height</label>
                                                                <input type="number" step="0.001" class="form-control" name="part_height" placeholder="Height">
                                                            </div>
                                                            <div class="col-xl-3">
                                                                <label for="part_thickness" class="form-label">Thickness</label>
                                                                <input type="number" step="0.001" class="form-control" name="part_thickness" placeholder="Thickness">
                                                            </div>

                                                            <!-- Material Ratios -->
                                                            <div class="col-12">
                                                                <h5 class="mt-3">Material Ratios (%)</h5>
                                                            </div>
                                                            <div class="col-xl-3">
                                                                <label for="part_ld_ratio" class="form-label">LD Ratio</label>
                                                                <input type="number" step="0.001" max="100" class="form-control" name="part_ld_ratio" placeholder="Enter LD Mixing Ratio">
                                                            </div>
                                                            <div class="col-xl-3">
                                                                <label for="part_lld_ratio" class="form-label">LLD Ratio</label>
                                                                <input type="number" step="0.001" max="100" class="form-control" name="part_lld_ratio" placeholder="Enter LLD Mixing Ratio">
                                                            </div>
                                                            <div class="col-xl-3">
                                                                <label for="part_hd_ratio" class="form-label">HD Ratio</label>
                                                                <input type="number" step="0.001" max="100" class="form-control" name="part_hd_ratio" placeholder="Enter HD Mixing Ratio">
                                                            </div>
                                                            <div class="col-xl-3">
                                                                <label for="part_rd_ratio" class="form-label">RD Ratio</label>
                                                                <input type="number" step="0.001" max="100" class="form-control" name="part_rd_ratio" placeholder="Enter RD Mixing Ratio">
                                                            </div>

                                                            <!-- Part Properties -->
                                                            <div class="col-12">
                                                                <h5 class="mt-3">Properties</h5>
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <label for="part_weight" class="form-label">Item Weight (in grams)</label>
                                                                <input type="number" step="0.001" class="form-control" name="part_weight" placeholder="Weight in grams">
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <label for="part_price" class="form-label">Price (₹)</label>
                                                                <input type="number" step="0.01" class="form-control" name="part_price" placeholder="Enter Price">
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <label for="no_ups" class="form-label">No. of Ups</label>
                                                                <input type="number" min="1" class="form-control" name="no_ups" placeholder="Enter No. of Ups">
                                                            </div>

                                                            <div class="col-xl-4">
                                                                <label for="sealing_type" class="form-label">Sealing Type</label>
                                                                <select class="form-control" name="sealing_type">
                                                                    <option value="">Select</option>
                                                                    <option value="Side Seal">Side Seal</option>
                                                                    <option value="Bottom Seal">Bottom Seal</option>
                                                                    <option value="Center Seal">Center Seal</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-xl-4">
                                                                <label for="bundle_qty" class="form-label">Bundle Quantity</label>
                                                                <input type="number" class="form-control" name="bundle_qty" placeholder="Bundle Quantity">
                                                            </div>

                                                            <div class="col-xl-4">
                                                                <label for="part_quantity" class="form-label">Stock Quantity</label>
                                                                <input type="number" class="form-control" name="part_quantity" placeholder="Stock Quantity">
                                                            </div>

                                                            <div class="col-xl-6">
                                                                <label for="printing_status" class="form-label d-block">Printing Status</label>
                                                                <div class="form-check form-check-inline">
                                                                    <input type="checkbox" class="form-check-input" name="printing_status" id="printing_status">
                                                                    <label class="form-check-label" for="printing_status">Enable Printing</label>
                                                                </div>
                                                            </div>

                                                            <div class="col-xl-6">
                                                                <label for="printing_colour" class="form-label">Printing Colors</label>
                                                                <select class="form-control" name="printing_colour" multiple>
                                                                    <option value="White">White</option>
                                                                    <option value="Black">Black</option>
                                                                    <option value="Red">Red</option>
                                                                    <option value="Orange">Orange</option>
                                                                    <option value="Yellow">Yellow</option>
                                                                    <option value="Green">Green</option>
                                                                    <option value="Blue">Blue</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                                <div class="card custom-card shadow-none mb-0 border-0">
                                                    <div class="card-body p-0">
                                                        <div class="row gy-3">
                                                            <div class="col-xl-12">
                                                                <label class="form-label">Part Description</label>
                                                                <textarea class="form-control" name="part_description" rows="3" placeholder="Enter part description"></textarea>
                                                            </div>

                                                            <div class="col-xl-12 product-documents-container">
                                                                <p class="fw-medium mb-2 fs-14">Part Image</p>
                                                                <input type="file" class="form-control" name="part_profile_picture" accept="image/*">
                                                                <label class="form-label text-muted mt-2 fw-normal fs-12">Upload main image of the part</label>
                                                            </div>

                                                            <div class="col-xl-12">
                                                                <label for="part_tags" class="form-label">Part Tags</label>
                                                                <input type="text" class="form-control" name="part_tags" placeholder="Enter Part Tags (comma separated)">
                                                            </div>

                                                            <div class="col-xl-12">
                                                                <label for="status" class="form-label">Status</label>
                                                                <select class="form-control" name="status" required>
                                                                    <option value="active">Active</option>
                                                                    <option value="inactive">Inactive</option>
                                                                    <option value="archived">Archived</option>
                                                                </select>
                                                            </div>

                                                            <!-- Branch Assignment -->
                                                            <div class="col-xl-12">
                                                                <label class="form-label">Branch</label>
                                                                <select class="form-control" name="branch_id">
                                                                    <option value="">Select Branch (Optional)</option>
                                                                    @foreach ($branches as $branch)
                                                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <!-- Material & Printing Properties Toggles -->
                                                            <div class="col-12">
                                                                <h5 class="mt-3">Material Properties</h5>
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                    <input id="BST" name="bst" type="checkbox" value="1">
                                                                    <label for="BST" class="label-primary"></label>
                                                                    <span class="ms-3">BST</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                    <input id="Plain" name="plain" type="checkbox" value="1">
                                                                    <label for="Plain" class="label-primary"></label>
                                                                    <span class="ms-3">Plain</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                    <input id="Flat" name="flat" type="checkbox" value="1">
                                                                    <label for="Flat" class="label-primary"></label>
                                                                    <span class="ms-3">Flat</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                    <input id="Gazzate" name="gazzate" type="checkbox" value="1">
                                                                    <label for="Gazzate" class="label-primary"></label>
                                                                    <span class="ms-3">Gazzate</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                    <input id="BIO" name="bio" type="checkbox" value="1">
                                                                    <label for="BIO" class="label-primary"></label>
                                                                    <span class="ms-3">Bio</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                    <input id="NORMAL" name="normal" type="checkbox" value="1">
                                                                    <label for="NORMAL" class="label-primary"></label>
                                                                    <span class="ms-3">Normal</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                    <input id="Milky" name="milky" type="checkbox" value="1">
                                                                    <label for="Milky" class="label-primary"></label>
                                                                    <span class="ms-3">Milky</span>
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <h5 class="mt-3">Printing Properties</h5>
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                    <input id="Roto" name="roto_printing" type="checkbox" value="1">
                                                                    <label for="Roto" class="label-primary"></label>
                                                                    <span class="ms-3">Roto Printing</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                    <input id="Flexo" name="flexo_printing" type="checkbox" value="1">
                                                                    <label for="Flexo" class="label-primary"></label>
                                                                    <span class="ms-3">Flexo Printing</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                                    <input id="Recyle" name="recycle_logo" type="checkbox" value="1">
                                                                    <label for="Recyle" class="label-primary"></label>
                                                                    <span class="ms-3">Recycle Logo</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer border-top border-block-start-dashed d-sm-flex justify-content-end">
                                            <button type="button" class="btn btn-light me-2 mb-2 mb-sm-0" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" id="add_part_data_btn" class="btn btn-primary mb-2 mb-sm-0">Create Part<i class="bi bi-plus-lg ms-2"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- Start:: EDIT Part data modal -->
   <div class="modal fade"
   id="editPartDataModal"
   tabindex="-1"
   aria-labelledby="editPartDataModal"
   aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
          <div class="modal-header">
              <h6 class="modal-title"
                  id="editPartDataModal">Edit Part</h6>
              <button type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xl-12">
                      <div class="card custom-card">
                          <div class="card-body add-products">
                              <form action="#"
                                  method="POST"
                                  id="edit_part_data_form"
                                  enctype="multipart/form-data">
                                  @csrf
                                  <input type="hidden" name="part_id" id="part_id">
                                  <div class="row gx-4">
                                      <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                          <div class="card custom-card shadow-none mb-0 border-0">
                                              <div class="card-body p-0">
                                                  <div class="row gy-3">
                                                      <!-- Basic Information -->
                                                      <div class="col-xl-12">
                                                          <label for="part_name_edit" class="form-label">Part Name <span class="text-danger">*</span></label>
                                                          <input type="text" class="form-control" name="part_name" id="part_name_edit" placeholder="Enter Part Name" required>
                                                      </div>

                                                      <div class="col-xl-12">
                                                          <label class="form-label">Customer</label>
                                                          <select class="form-control" name="customer_id" id="customer_id_edit">
                                                              <option value="">Select Customer (Optional)</option>
                                                              @foreach ($customers as $customer)
                                                                  <option value="{{ $customer->id }}">{{ $customer->customer_unique_code }}- {{ $customer->company_name }}</option>
                                                              @endforeach
                                                          </select>
                                                      </div>

                                                      <div class="col-xl-6">
                                                          <label for="part_category_edit" class="form-label">Category</label>
                                                          <select class="form-control" data-trigger name="part_category" id="part_category_edit">
                                                              <option value="">Select Category</option>
                                                              <option value="Garbage Bags">Garbage Bags</option>
                                                              <option value="LD Plain Bags">LD Plain Bags</option>
                                                              <option value="Food Packaging">Food Packaging</option>
                                                              <option value="Industrial Packaging">Industrial Packaging</option>
                                                              <option value="Agricultural Bags">Agricultural Bags</option>
                                                              <option value="Gusseted Bags">Gusseted Bags</option>
                                                              <option value="Zip Lock Bags">Zip Lock Bags</option>
                                                              <option value="Biodegradable Bags">Biodegradable Bags</option>
                                                          </select>
                                                      </div>

                                                      <div class="col-xl-6">
                                                          <label for="part_model_edit" class="form-label">Part Type</label>
                                                          <input type="text" class="form-control" name="part_model" id="part_model_edit" placeholder="Enter Part Type">
                                                      </div>

                                                      <div class="col-xl-6">
                                                          <label for="hsn_no_edit" class="form-label">HSN No</label>
                                                          <input type="text" class="form-control" name="hsn_no" id="hsn_no_edit" placeholder="Enter HSN No">
                                                      </div>

                                                      <div class="col-xl-6">
                                                          <label for="reel_size_edit" class="form-label">Reel Size</label>
                                                          <input type="text" class="form-control" name="reel_size" id="reel_size_edit" placeholder="Enter Reel Size">
                                                      </div>

                                                      <!-- Part Dimensions -->
                                                      <div class="col-12">
                                                          <h5 class="mt-3">Part Dimensions (in mm)</h5>
                                                      </div>
                                                      <div class="col-xl-3">
                                                          <label for="part_length_edit" class="form-label">Length</label>
                                                          <input type="number" step="0.001" class="form-control" name="part_length" id="part_length_edit" placeholder="Length">
                                                      </div>
                                                      <div class="col-xl-3">
                                                          <label for="part_width_edit" class="form-label">Width</label>
                                                          <input type="number" step="0.001" class="form-control" name="part_width" id="part_width_edit" placeholder="Width">
                                                      </div>
                                                      <div class="col-xl-3">
                                                          <label for="part_height_edit" class="form-label">Height</label>
                                                          <input type="number" step="0.001" class="form-control" name="part_height" id="part_height_edit" placeholder="Height">
                                                      </div>
                                                      <div class="col-xl-3">
                                                          <label for="part_thickness_edit" class="form-label">Thickness</label>
                                                          <input type="number" step="0.001" class="form-control" name="part_thickness" id="part_thickness_edit" placeholder="Thickness">
                                                      </div>

                                                      <!-- Material Ratios -->
                                                      <div class="col-12">
                                                          <h5 class="mt-3">Material Ratios (%)</h5>
                                                      </div>
                                                      <div class="col-xl-3">
                                                          <label for="part_ld_ratio_edit" class="form-label">LD Ratio</label>
                                                          <input type="number" step="0.001" max="100" class="form-control" name="part_ld_ratio" id="part_ld_ratio_edit" placeholder="Enter LD Mixing Ratio">
                                                      </div>
                                                      <div class="col-xl-3">
                                                          <label for="part_lld_ratio_edit" class="form-label">LLD Ratio</label>
                                                          <input type="number" step="0.001" max="100" class="form-control" name="part_lld_ratio" id="part_lld_ratio_edit" placeholder="Enter LLD Mixing Ratio">
                                                      </div>
                                                      <div class="col-xl-3">
                                                          <label for="part_hd_ratio_edit" class="form-label">HD Ratio</label>
                                                          <input type="number" step="0.001" max="100" class="form-control" name="part_hd_ratio" id="part_hd_ratio_edit" placeholder="Enter HD Mixing Ratio">
                                                      </div>
                                                      <div class="col-xl-3">
                                                          <label for="part_rd_ratio_edit" class="form-label">RD Ratio</label>
                                                          <input type="number" step="0.001" max="100" class="form-control" name="part_rd_ratio" id="part_rd_ratio_edit" placeholder="Enter RD Mixing Ratio">
                                                      </div>

                                                      <!-- Part Properties -->
                                                      <div class="col-12">
                                                          <h5 class="mt-3">Properties</h5>
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <label for="part_weight_edit" class="form-label">Item Weight (in grams)</label>
                                                          <input type="number" step="0.001" class="form-control" name="part_weight" id="part_weight_edit" placeholder="Weight in grams">
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <label for="part_price_edit" class="form-label">Price (₹)</label>
                                                          <input type="number" step="0.01" class="form-control" name="part_price" id="part_price_edit" placeholder="Enter Price">
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <label for="no_ups_edit" class="form-label">No. of Ups</label>
                                                          <input type="number" min="1" class="form-control" name="no_ups" id="no_ups_edit" placeholder="Enter No. of Ups">
                                                      </div>

                                                      <div class="col-xl-4">
                                                          <label for="sealing_type_edit" class="form-label">Sealing Type</label>
                                                          <select class="form-control" name="sealing_type" id="sealing_type_edit">
                                                              <option value="">Select</option>
                                                              <option value="Side Seal">Side Seal</option>
                                                              <option value="Bottom Seal">Bottom Seal</option>
                                                              <option value="Center Seal">Center Seal</option>
                                                          </select>
                                                      </div>

                                                      <div class="col-xl-4">
                                                          <label for="bundle_qty_edit" class="form-label">Bundle Quantity</label>
                                                          <input type="number" class="form-control" name="bundle_qty" id="bundle_qty_edit" placeholder="Bundle Quantity">
                                                      </div>

                                                      <div class="col-xl-4">
                                                          <label for="part_quantity_edit" class="form-label">Stock Quantity</label>
                                                          <input type="number" class="form-control" name="part_quantity" id="part_quantity_edit" placeholder="Stock Quantity">
                                                      </div>

                                                      <div class="col-xl-6">
                                                          <label for="printing_status_edit" class="form-label d-block">Printing Status</label>
                                                          <div class="form-check form-check-inline">
                                                              <input type="checkbox" class="form-check-input" name="printing_status" id="printing_status_edit">
                                                              <label class="form-check-label" for="printing_status_edit">Enable Printing</label>
                                                          </div>
                                                      </div>

                                                      <div class="col-xl-6">
                                                          <label for="printing_colour_edit" class="form-label">Printing Colors</label>
                                                          <select class="form-control" name="printing_colour" id="printing_colour_edit" multiple>
                                                              <option value="White">White</option>
                                                              <option value="Black">Black</option>
                                                              <option value="Red">Red</option>
                                                              <option value="Orange">Orange</option>
                                                              <option value="Yellow">Yellow</option>
                                                              <option value="Green">Green</option>
                                                              <option value="Blue">Blue</option>
                                                          </select>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>

                                      <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                          <div class="card custom-card shadow-none mb-0 border-0">
                                              <div class="card-body p-0">
                                                  <div class="row gy-3">
                                                      <div class="col-xl-12">
                                                          <label class="form-label">Part Description</label>
                                                          <textarea class="form-control" name="part_description" id="part_description_edit" rows="3" placeholder="Enter part description"></textarea>
                                                      </div>

                                                      <div class="col-xl-12 product-documents-container">
                                                          <p class="fw-medium mb-2 fs-14">Part Image</p>
                                                          <div class="mb-2">
                                                              <img src="" id="edit_part_logo" alt="Current Part Image" class="img-thumbnail mb-2" style="max-height: 100px;">
                                                          </div>
                                                          <input type="file" class="form-control" name="part_profile_picture" accept="image/*">
                                                          <label class="form-label text-muted mt-2 fw-normal fs-12">Upload new image to replace current one</label>
                                                      </div>

                                                      <div class="col-xl-12">
                                                          <label for="part_tags_edit" class="form-label">Part Tags</label>
                                                          <input type="text" class="form-control" name="part_tags" id="part_tags_edit" placeholder="Enter Part Tags (comma separated)">
                                                      </div>

                                                      <div class="col-xl-12">
                                                          <label for="status_edit" class="form-label">Status</label>
                                                          <select class="form-control" name="status" id="status_edit" required>
                                                              <option value="active">Active</option>
                                                              <option value="inactive">Inactive</option>
                                                              <option value="archived">Archived</option>
                                                          </select>
                                                      </div>

                                                      <!-- Branch Assignment -->
                                                      <div class="col-xl-12">
                                                          <label class="form-label">Branch</label>
                                                          <select class="form-control" name="branch_id" id="branch_id_edit">
                                                              <option value="">Select Branch (Optional)</option>
                                                              @foreach ($branches as $branch)
                                                                  <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                                              @endforeach
                                                          </select>
                                                      </div>

                                                      <!-- Material & Printing Properties Toggles -->
                                                      <div class="col-12">
                                                          <h5 class="mt-3">Material Properties</h5>
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                              <input id="BST_edit" name="bst" type="checkbox" value="1">
                                                              <label for="BST_edit" class="label-primary"></label>
                                                              <span class="ms-3">BST</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                              <input id="Plain_edit" name="plain" type="checkbox" value="1">
                                                              <label for="Plain_edit" class="label-primary"></label>
                                                              <span class="ms-3">Plain</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                              <input id="Flat_edit" name="flat" type="checkbox" value="1">
                                                              <label for="Flat_edit" class="label-primary"></label>
                                                              <span class="ms-3">Flat</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                              <input id="Gazzate_edit" name="gazzate" type="checkbox" value="1">
                                                              <label for="Gazzate_edit" class="label-primary"></label>
                                                              <span class="ms-3">Gazzate</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                              <input id="BIO_edit" name="bio" type="checkbox" value="1">
                                                              <label for="BIO_edit" class="label-primary"></label>
                                                              <span class="ms-3">Bio</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                              <input id="NORMAL_edit" name="normal" type="checkbox" value="1">
                                                              <label for="NORMAL_edit" class="label-primary"></label>
                                                              <span class="ms-3">Normal</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                              <input id="Milky_edit" name="milky" type="checkbox" value="1">
                                                              <label for="Milky_edit" class="label-primary"></label>
                                                              <span class="ms-3">Milky</span>
                                                          </div>
                                                      </div>

                                                      <div class="col-12">
                                                          <h5 class="mt-3">Printing Properties</h5>
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                              <input id="Roto_edit" name="roto_printing" type="checkbox" value="1">
                                                              <label for="Roto_edit" class="label-primary"></label>
                                                              <span class="ms-3">Roto Printing</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                              <input id="Flexo_edit" name="flexo_printing" type="checkbox" value="1">
                                                              <label for="Flexo_edit" class="label-primary"></label>
                                                              <span class="ms-3">Flexo Printing</span>
                                                          </div>
                                                      </div>
                                                      <div class="col-xl-4">
                                                          <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                                              <input id="Recyle_edit" name="recycle_logo" type="checkbox" value="1">
                                                              <label for="Recyle_edit" class="label-primary"></label>
                                                              <span class="ms-3">Recycle Logo</span>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="card-footer border-top border-block-start-dashed d-sm-flex justify-content-end">
                                      <button type="button" class="btn btn-light me-2 mb-2 mb-sm-0" data-bs-dismiss="modal">Cancel</button>
                                      <button type="submit" id="edit_part_data_btn" class="btn btn-primary mb-2 mb-sm-0">Update Part<i class="bi bi-check-lg ms-2"></i></button>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- Start:: Part Details Offcanvas -->
<div class="offcanvas offcanvas-end"
   tabindex="-1"
   id="viewPartDataModal"
   aria-labelledby="viewPartDataModalLabel">
  <div class="offcanvas-header">
      <h5 id="viewPartDataModalLabel"
          class="offcanvas-title">Part Details</h5>
      <button type="button"
              class="btn-close"
              data-bs-dismiss="offcanvas"
              aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0">
      <div class="d-sm-flex align-items-top border-bottom border-block-end-dashed main-profile-cover p-3">
          <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent me-3 p-2">
              <img src="{{ asset('assets/images/company-logos/1.png') }}"
                   id="view_part_logo"
                   alt="Part Logo">
          </span>
          <div class="flex-fill main-profile-info">
              <div class="d-flex align-items-center justify-content-between">
                  <h6 class="fw-medium mb-1"
                      id="view_part_name"></h6>
                  <button type="button"
                          class="btn-close crm-contact-close-btn"
                          data-bs-dismiss="offcanvas"
                          aria-label="Close"></button>
              </div>
              <p class="text-muted fs-12 mb-2"
                 id="view_part_model_customer"></p>
          </div>
      </div>

      <div class="border-bottom border-block-end-dashed p-3">
          <div class="mb-0">
              <p class="fs-15 fw-medium mb-2">Part Description :</p>
              <p class="text-muted mb-0"
                 id="view_part_description"></p>
          </div>
      </div>

      <div class="border-bottom border-block-end-dashed p-3">
          <p class="fs-14 fw-medium mb-2">Basic Information :</p>
          <div>
              <div class="d-flex align-items-center mb-2">
                  <div class="me-2">
                      <span class="avatar avatar-sm avatar-rounded bg-primary3-transparent">
                          <i class="ri-list-settings-line fs-14 align-middle"></i>
                      </span>
                  </div>
                  <div id="view_part_category"></div>
              </div>
              <div class="d-flex align-items-center mb-2">
                  <div class="me-2">
                      <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                          <i class="ri-hashtag fs-14 align-middle"></i>
                      </span>
                  </div>
                  <div id="view_part_hsn"></div>
              </div>
              <div class="d-flex align-items-center mb-2">
                  <div class="me-2">
                      <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                          <i class="ri-store-line fs-14 align-middle"></i>
                      </span>
                  </div>
                  <div id="view_part_branch"></div>
              </div>

          </div>
      </div>

      <div class="border-bottom border-block-end-dashed p-3">
          <p class="fs-14 fw-medium mb-2">Dimensions (mm) :</p>
          <div>
              <div class="d-flex align-items-center mb-2">
                  <div class="me-2">
                      <span class="avatar avatar-sm avatar-rounded bg-primary1-transparent">
                          <i class="ri-straighten-line fs-14 align-middle"></i>
                      </span>
                  </div>
                  <div id="view_part_dimensions"></div>
              </div>
              <div class="d-flex align-items-center mb-2">
                  <div class="me-2">
                      <span class="avatar avatar-sm avatar-rounded bg-primary2-transparent">
                          <i class="ri-calculator-line fs-14 align-middle"></i>
                      </span>
                  </div>
                  <div id="view_part_ratios"></div>
              </div>
          </div>
      </div>
      <div class="border-bottom border-block-end-dashed p-3">
          <p class="fs-14 fw-medium mb-2">Properties :</p>
          <div>
              <div class="d-flex align-items-center mb-2">
                  <div class="me-2">
                      <span class="avatar avatar-sm avatar-rounded bg-primary3-transparent">
                          <i class="ri-sort-up-line fs-14 align-middle"></i>
                      </span>
                  </div>
                  <div id="view_part_properties_1"></div>
              </div>
              <div class="d-flex align-items-center mb-2">
                  <div class="me-2">
                      <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                          <i class="ri-printer-line fs-14 align-middle"></i>
                      </span>
                  </div>
                  <div id="view_part_properties_2"></div>
              </div>
          </div>
      </div>

      <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
          <p class="fs-14 fw-medium mb-0">Price:</p>
          <div id="view_part_price"></div>
      </div>
      <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
          <p class="fs-14 fw-medium mb-0">Stock Quantity:</p>
          <div id="view_part_quantity"></div>
      </div>
      <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
          <p class="fs-14 fw-medium mb-0">Status:</p>
          <div id="view_part_status"></div>
      </div>

      <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
          <p class="fs-14 fw-medium mb-0">Documents:</p>
          <div id="view_part_documents"></div>
      </div>
      <div class="border-bottom border-block-end-dashed d-flex align-items-center flex-wrap gap-4 p-3">
          <p class="fs-14 fw-medium mb-0">Tags:</p>
          <div id="view_part_tags"></div>
      </div>
  </div>
</div>
<!-- End:: Part Details Offcanvas -->


<table id="data_fetch_table" class="table table-hover text-nowrap">
    <!-- ... other markup ... -->
</table>

<script>
  $(function() {
      // Constants
      const AJAX_HEADERS = {
          'X-XSRF-TOKEN': $('meta[name="_token"]').attr('content'),
          'Accept': 'application/json'
      };

      const TOAST_CONFIG = {
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
              toast.addEventListener('mouseenter', Swal.stopTimer);
              toast.addEventListener('mouseleave', Swal.resumeTimer);
          },
          customClass: { popup: 'colored-toast' }
      };

      // Global variables
      let partDateFilterValue = 'last_90_days';

      // Setup AJAX defaults
      $.ajaxSetup({
          headers: AJAX_HEADERS,
          error: function(xhr, status, error) {
              console.error('AJAX Error:', {xhr, status, error});
              const errorMessage = xhr.responseJSON?.message || 'An unknown error occurred';
              showToast('Error', errorMessage, 'error');
          }
      });

      const Toast = Swal.mixin(TOAST_CONFIG);

      function showToast(title, message = '', type = 'info') {
          if (!title && !message) return;
          const validTypes = ['success', 'error', 'warning', 'info', 'question'];
          type = validTypes.includes(type) ? type : 'info';

          Toast.fire({
              icon: type,
              title: title || message
          }).catch(error => {
              console.error('Toast error:', error);
              alert(`${title}: ${message}`);
          });
      }

      // Form submission handler
      async function submitPartForm(formSelector, buttonSelector, url, successMessage, modalSelector = null) {
          const $form = $(formSelector);
          const $button = $(buttonSelector);
          const originalText = $button.text();

          try {
              $button.prop('disabled', true).text('Processing...');

              const formData = new FormData($form[0]);

              // Handle boolean fields
              ['printing_status', 'bst', 'plain', 'flat', 'gazzate', 'bio', 'normal', 'milky',
               'roto_printing', 'flexo_printing', 'recycle_logo'].forEach(field => {
                  formData.set(field, $form.find(`[name="${field}"]`).is(':checked') ? '1' : '0');
              });

              // Handle array fields
              if ($form.find('[name="part_tags"]').length) {
                  const tags = $form.find('[name="part_tags"]').val().split(',').map(tag => tag.trim());
                  formData.set('part_tags', JSON.stringify(tags));
              }

              const response = await $.ajax({
                  url: url,
                  method: 'POST',
                  data: formData,
                  cache: false,
                  contentType: false,
                  processData: false
              });

              $form[0].reset();
              await partDataFetchAll();
              showToast('Success', successMessage, 'success');
              if (modalSelector) $(modalSelector).modal('hide');
          } catch (error) {
              console.error('Form submission error:', error);
              showToast('Error', error.responseJSON?.message || 'Form submission failed', 'error');
          } finally {
              $button.prop('disabled', false).text(originalText);
          }
      }

      // Event handlers
      $('#add_part_data_form').on('submit', function(e) {
          e.preventDefault();
          submitPartForm(
              '#add_part_data_form',
              '#add_part_data_btn',
              '{{ route('partstore') }}',
              'New Part added successfully!',
              '#addPartDataModal'
          );
      });

      $('#edit_part_data_form').on('submit', function(e) {
          e.preventDefault();
          submitPartForm(
              '#edit_part_data_form',
              '#edit_part_data_btn',
              '{{ route('partupdate') }}',
              'Part updated successfully!',
              '#editPartDataModal'
          );
      });

      // DataTable initialization
      function setupPartDataTable() {
          if ($.fn.DataTable.isDataTable('#data_fetch_table')) {
              $('#data_fetch_table').DataTable().destroy();
          }

          return $('#data_fetch_table').DataTable({
              processing: true,
              serverSide: false,
              responsive: true,
              scrollY: '700px',
              scrollX: true,
              scrollCollapse: true,
              fixedHeader: true,
              fixedColumns: {
                  left: 2,
                  right: 1
              },
              pageLength: 200,
              lengthMenu: [100, 200, 500, 1000],
              autoWidth: false,
              dom: 'Blfrtip',
              buttons: ['copy', 'csv', 'excel', 'print', 'colvis'],
              order: [[0, 'desc']],
              columns: [
                  { data: 'part_unique_code', title: 'Part ID' },
                  { data: 'part_name', title: 'Part Name' },
                  { data: 'hsn_no', title: 'HSN No' },
                  { data: 'customer_name', title: 'Customer' },
                  { data: 'part_category', title: 'Category' },
                  { data: 'updated_at', title: 'Updated Date',
                    render: function(data) {
                        return moment(data).format('DD-MM-YYYY HH:mm');
                    }
                  },
                  { data: 'part_weight', title: 'Weight (g)' },
                  { data: 'status_badge', title: 'Status' },
                  { data: 'dimensions', title: 'Dimensions' },
                  { data: 'part_price', title: 'Price',
                    render: function(data) {
                        return '₹' + parseFloat(data).toFixed(2);
                    }
                  },
                  { data: 'actions', title: 'Actions', orderable: false }
              ],
              language: {
                  search: "_INPUT_",
                  searchPlaceholder: "Search Parts..."
              }
          });
      }

      // Data fetching function
      async function partDataFetchAll(dateFilter = 'last_90_days') {
          try {
              partDateFilterValue = dateFilter;
              const response = await $.ajax({
                  url: '{{ route('partfetchall') }}',
                  method: 'GET',
                  data: { date_filter: dateFilter }
              });

              $('#show_all_fetched_data').html(response);
              setupPartDataTable();
              $('#date_filter').val(partDateFilterValue);
          } catch (error) {
              console.error('Data fetch error:', error);
              showToast('Error', 'Failed to fetch data', 'error');
          }
      }

      // Initialize on page load
      partDataFetchAll(partDateFilterValue);

      // View part details
      $(document).on('click', '.view_part', function(e) {
          e.preventDefault();
          const part = $(this).data('part');

          // Basic Information
          $('#view_part_name').text(part.part_name);
          $('#view_part_model_customer').text(`${part.part_model} - ${part.customer_name}`);
          $('#view_part_description').text(part.part_description || 'No description available');
          $('#view_part_category').text(part.part_category || 'N/A');
          $('#view_part_hsn').text(part.hsn_no || 'N/A');
          $('#view_part_branch').text(part.branch_name || 'N/A');

          // Dimensions
          $('#view_part_dimensions').html(`
              Length: ${part.part_length}mm<br>
              Width: ${part.part_width}mm<br>
              Height: ${part.part_height}mm<br>
              Thickness: ${part.part_thickness}mm
          `);

          // Material Ratios
          $('#view_part_ratios').html(`
              LD: ${part.part_ld_ratio}%<br>
              LLD: ${part.part_lld_ratio}%<br>
              HD: ${part.part_hd_ratio}%<br>
              RD: ${part.part_rd_ratio}%
          `);

          // Properties
          $('#view_part_properties_1').html(`
              Weight: ${part.part_weight}g<br>
              Bundle Qty: ${part.bundle_qty}<br>
              Sealing: ${part.sealing_type || 'N/A'}
          `);

          $('#view_part_properties_2').html(`
              Printing: ${part.printing_status ? 'Yes' : 'No'}<br>
              Colors: ${part.printing_colour || 'N/A'}<br>
              Type: ${[
                  part.bst && 'BST',
                  part.plain && 'Plain',
                  part.flat && 'Flat',
                  part.gazzate && 'Gazzate',
                  part.bio && 'Bio',
                  part.normal && 'Normal',
                  part.milky && 'Milky'
              ].filter(Boolean).join(', ') || 'N/A'}
          `);

          // Price and Status
          $('#view_part_price').text(`₹${parseFloat(part.part_price).toFixed(2)}`);
          $('#view_part_quantity').text(part.part_quantity || '0');
          $('#view_part_status').html(`<span class="badge bg-${
              part.status === 'active' ? 'success' :
              part.status === 'inactive' ? 'warning' : 'danger'
          }">${part.status}</span>`);

          // Tags
          $('#view_part_tags').html(
              part.part_tags ?
              part.part_tags.map(tag => `<span class="badge bg-light text-dark me-1">${tag}</span>`).join('') :
              'No tags'
          );

          // Profile Picture
          if (part.part_profile_picture) {
              $('#view_part_logo').attr('src', `{{ asset('storage') }}/${part.part_profile_picture}`);
          } else {
              $('#view_part_logo').attr('src', '{{ asset('assets/images/company-logos/default.png') }}');
          }

          $('#viewPartDataModal').offcanvas('show');
      });

      // Edit part
      $(document).on('click', '.edit_part', function(e) {
          e.preventDefault();
          const part = $(this).data('part');

          // Populate form fields
          $('#edit_part_data_form [name="part_id"]').val(part.id);
          $('#edit_part_data_form [name="part_name"]').val(part.part_name);
          $('#edit_part_data_form [name="part_category"]').val(part.part_category);
          $('#edit_part_data_form [name="part_model"]').val(part.part_model);
          $('#edit_part_data_form [name="hsn_no"]').val(part.hsn_no);
          $('#edit_part_data_form [name="reel_size"]').val(part.reel_size);

          // Dimensions
          $('#edit_part_data_form [name="part_length"]').val(part.part_length);
          $('#edit_part_data_form [name="part_width"]').val(part.part_width);
          $('#edit_part_data_form [name="part_height"]').val(part.part_height);
          $('#edit_part_data_form [name="part_thickness"]').val(part.part_thickness);

          // Material Ratios
          $('#edit_part_data_form [name="part_ld_ratio"]').val(part.part_ld_ratio);
          $('#edit_part_data_form [name="part_lld_ratio"]').val(part.part_lld_ratio);
          $('#edit_part_data_form [name="part_hd_ratio"]').val(part.part_hd_ratio);
          $('#edit_part_data_form [name="part_rd_ratio"]').val(part.part_rd_ratio);

          // Properties
          $('#edit_part_data_form [name="part_weight"]').val(part.part_weight);
          $('#edit_part_data_form [name="part_price"]').val(part.part_price);
          $('#edit_part_data_form [name="no_ups"]').val(part.no_ups);
          $('#edit_part_data_form [name="sealing_type"]').val(part.sealing_type);
          $('#edit_part_data_form [name="printing_status"]').prop('checked', part.printing_status);
          $('#edit_part_data_form [name="printing_colour"]').val(part.printing_colour);
          $('#edit_part_data_form [name="bundle_qty"]').val(part.bundle_qty);
          $('#edit_part_data_form [name="part_quantity"]').val(part.part_quantity);

          // Toggles
          $('#edit_part_data_form [name="bst"]').prop('checked', part.bst);
          $('#edit_part_data_form [name="plain"]').prop('checked', part.plain);
          $('#edit_part_data_form [name="flat"]').prop('checked', part.flat);
          $('#edit_part_data_form [name="gazzate"]').prop('checked', part.gazzate);
          $('#edit_part_data_form [name="bio"]').prop('checked', part.bio);
          $('#edit_part_data_form [name="normal"]').prop('checked', part.normal);
          $('#edit_part_data_form [name="milky"]').prop('checked', part.milky);
          $('#edit_part_data_form [name="roto_printing"]').prop('checked', part.roto_printing);
          $('#edit_part_data_form [name="flexo_printing"]').prop('checked', part.flexo_printing);
          $('#edit_part_data_form [name="recycle_logo"]').prop('checked', part.recycle_logo);

          // Other fields
          $('#edit_part_data_form [name="part_description"]').val(part.part_description);
          $('#edit_part_data_form [name="part_tags"]').val(part.part_tags ? part.part_tags.join(', ') : '');
          $('#edit_part_data_form [name="status"]').val(part.status);
          $('#edit_part_data_form [name="branch_id"]').val(part.branch_id);
          $('#edit_part_data_form [name="customer_id"]').val(part.customer_id);

          // Show current image
          if (part.part_profile_picture) {
              $('#edit_part_logo').attr('src', `{{ asset('storage') }}/${part.part_profile_picture}`);
          }

          $('#editPartDataModal').modal('show');
      });

      // Delete part
      $(document).on('click', '.delete_part', function(e) {
          e.preventDefault();
          const part = $(this).data('part');

          Swal.fire({
              title: 'Are you sure?',
              text: `You want to delete part "${part.part_name}"?`,
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                      url: `{{ url('parts') }}/${part.id}`,
                      method: 'DELETE',
                      success: function(response) {
                          showToast('Success', 'Part deleted successfully', 'success');
                          partDataFetchAll();
                      }
                  });
              }
          });
      });

      // Export functionality
      $('#exportButton').on('click', async function() {
          try {
              const response = await fetch('{{ route('partexport') }}', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json',
                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                  }
              });

              const blob = await response.blob();
              const url = window.URL.createObjectURL(blob);
              const a = document.createElement('a');
              a.href = url;
              a.download = `part_export_${new Date().toLocaleDateString()}.xlsx`;
              document.body.appendChild(a);
              a.click();
              a.remove();
              window.URL.revokeObjectURL(url);
          } catch (error) {
              console.error('Export failed:', error);
              showToast('Error', 'Export failed', 'error');
          }
      });
  });
</script>
@endsection






