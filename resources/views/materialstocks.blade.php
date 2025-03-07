@extends('layouts.app')

@section('content')
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Material Stocks
                    </div>
                    <div class="d-flex flex-wrap gap-2">

                        <button type="button"
                                class="modal-effect btn btn-white btn-wave"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#addMaterialStockDataModal">
                            <i class="ri-file-add-line lh-1 me-1 align-middle"></i> New
                        </button>

                        <button type="button"
                                class="modal-effect btn btn-primary3 btn-wave me-0"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#importMaterialStockDataModal">
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

    <!-- Add Import From MaterialStock -->
    <div class="modal fade"
         id="importMaterialStockDataModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="importMaterialStockDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="importMaterialStockDataModal">Import Material Stocks</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="materialstockimport"
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
                                    class="btn btn-primary">Import Material Stocks</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Export From MaterialStock -->
    <div class="modal fade"
         id="ExportMaterialStockModel"
         tabindex="-1"
         role="dialog"
         aria-labelledby="ExportMaterialStockModel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="ExportMaterialStockModel">Export Material Stocks</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('materialstockexport') }}"
                          method="POST">
                        @csrf
                        <label for="material_stock_from_date">From Date:</label>
                        <input type="date"
                               name="from_date"
                               id="material_stock_from_date"
                               required>

                        <label for="material_stock_to_date">To Date:</label>
                        <input type="date"
                               name="to_date"
                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                               id="material_stock_to_date"
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

    <!-- Start:: Add MaterialStock add data modal -->
    <div class="modal fade"
         id="addMaterialStockDataModal"
         tabindex="-1"
         aria-labelledby="addMaterialStockDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="addMaterialStockDataModal">Add Material Stock</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="add_material_stock_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-3">
                            <!-- MaterialStock Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/8.png') }}"
                                             alt="MaterialStock Logo"
                                             name="material-stock-logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="material_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="material-stock-profile-change">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- MaterialStock Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="material_name"
                                       class="form-label">Material Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_name"
                                       placeholder="Enter Material Name" required>
                            </div>
                            <!-- MaterialStock Grade -->
                            <div class="col-md-6 col-lg-4">
                                <label for="material_grade"
                                       class="form-label">Material Grade</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_grade"
                                       placeholder="Enter Material Grade">
                            </div>
                            <!-- MaterialStock Category -->
                            <div class="col-md-6 col-lg-4">
                                <label for="material_category"
                                       class="form-label">Material Category</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_category"
                                       placeholder="Enter Material Category">
                            </div>
                             <!-- UOM -->
                             <div class="col-md-6 col-lg-4">
                                <label for="material_UOM"
                                       class="form-label">UOM (Unit of Measure)</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_UOM"
                                       placeholder="e.g., kg, lbs, meters">
                            </div>
                            <!-- Quantity -->
                            <div class="col-md-6 col-lg-4">
                                <label for="material_quantity"
                                       class="form-label">Quantity</label>
                                <input type="number"
                                       class="form-control"
                                       name="material_quantity"
                                       step="any"
                                       placeholder="Enter Quantity">
                            </div>
                             <!-- Price -->
                             <div class="col-md-6 col-lg-4">
                                <label for="material_price"
                                       class="form-label">Price</label>
                                <input type="number"
                                       class="form-control"
                                       name="material_price"
                                       step="any"
                                       placeholder="Enter Price">
                            </div>
                            <!-- Warehouse Location -->
                            <div class="col-md-6 col-lg-4">
                                <label for="material_warehouse_location"
                                       class="form-label">Warehouse Location</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_warehouse_location"
                                       placeholder="Enter Warehouse Location">
                            </div>

                             <!-- Supplier Assignment -->
                             <div class="col-md-6 col-lg-4">
                                <label class="form-label">Supplier</label>
                                <select class="form-control"
                                        name="supplier_id">
                                    <option value="">Select Supplier (Optional)</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
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

                            <!-- MaterialStock Description -->
                            <div class="col-md-12">
                                <label for="material_description"
                                       class="form-label">Material Description</label>
                                <textarea class="form-control"
                                          name="material_description"
                                          rows="3"
                                          placeholder="Enter material description"></textarea>
                            </div>


                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="add_material_stock_data_btn"
                            class="btn btn-primary">Create Material Stock</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Start:: EDIT MaterialStock data modal -->
    <div class="modal fade"
         id="editMaterialStockDataModal"
         tabindex="-1"
         aria-labelledby="editMaterialStockDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="editMaterialStockDataModal">Edit Material Stock</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="edit_material_stock_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden"
                               name="material_stock_id"
                               id="material_stock_id">
                        <div class="row gy-3">
                            <!-- MaterialStock Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/1.png') }}"
                                             alt="MaterialStock Logo"
                                             id="edit_material_stock_logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="material_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                           <!-- MaterialStock Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="material_name"
                                       class="form-label">Material Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_name"
                                       id="material_name_edit"
                                       placeholder="Enter Material Name" required>
                            </div>
                            <!-- MaterialStock Grade -->
                            <div class="col-md-6 col-lg-4">
                                <label for="material_grade"
                                       class="form-label">Material Grade</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_grade"
                                       id="material_grade_edit"
                                       placeholder="Enter Material Grade">
                            </div>
                            <!-- MaterialStock Category -->
                            <div class="col-md-6 col-lg-4">
                                <label for="material_category"
                                       class="form-label">Material Category</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_category"
                                       id="material_category_edit"
                                       placeholder="Enter Material Category">
                            </div>
                             <!-- UOM -->
                             <div class="col-md-6 col-lg-4">
                                <label for="material_UOM"
                                       class="form-label">UOM (Unit of Measure)</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_UOM"
                                       id="material_UOM_edit"
                                       placeholder="e.g., kg, lbs, meters">
                            </div>
                            <!-- Quantity -->
                            <div class="col-md-6 col-lg-4">
                                <label for="material_quantity"
                                       class="form-label">Quantity</label>
                                <input type="number"
                                       class="form-control"
                                       name="material_quantity"
                                       step="any"
                                       id="material_quantity_edit"
                                       placeholder="Enter Quantity">
                            </div>
                             <!-- Price -->
                             <div class="col-md-6 col-lg-4">
                                <label for="material_price"
                                       class="form-label">Price</label>
                                <input type="number"
                                       class="form-control"
                                       name="material_price"
                                       step="any"
                                       id="material_price_edit"
                                       placeholder="Enter Price">
                            </div>
                            <!-- Warehouse Location -->
                            <div class="col-md-6 col-lg-4">
                                <label for="material_warehouse_location"
                                       class="form-label">Warehouse Location</label>
                                <input type="text"
                                       class="form-control"
                                       name="material_warehouse_location"
                                       id="material_warehouse_location_edit"
                                       placeholder="Enter Warehouse Location">
                            </div>

                             <!-- Supplier Assignment -->
                             <div class="col-md-6 col-lg-4">
                                <label class="form-label">Supplier</label>
                                <select class="form-control"
                                        name="supplier_id"
                                        id="material_supplier_id_edit">
                                    <option value="">Select Supplier (Optional)</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                             <!-- Branch Assignment -->
                             <div class="col-md-6 col-lg-4">
                                <label class="form-label">Branch</label>
                                <select class="form-control"
                                        name="branch_id"
                                        id="material_branch_id_edit">
                                    <option value="">Select Branch (Optional)</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- MaterialStock Description -->
                            <div class="col-md-12">
                                <label for="material_description"
                                       class="form-label">Material Description</label>
                                <textarea class="form-control"
                                          name="material_description"
                                          rows="3"
                                          id="material_description_edit"
                                          placeholder="Enter material description"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="edit_material_stock_data_btn"
                            class="btn btn-primary">Update Material Stock</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: EDIT MaterialStock -->

    <!-- Start:: MaterialStock Details Offcanvas -->
    <div class="offcanvas offcanvas-end"
         tabindex="-1"
         id="viewMaterialStockDataModal"
         aria-labelledby="viewMaterialStockDataModalLabel">
        <div class="offcanvas-header">
            <h5 id="viewMaterialStockDataModalLabel"
                class="offcanvas-title">Material Stock Details</h5>
        </div>
        <div class="offcanvas-body p-0">
            <div class="d-sm-flex align-items-top border-bottom border-block-end-dashed main-profile-cover p-3">
                <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent me-3 p-2">
                    <img src="{{ asset('assets/images/company-logos/1.png') }}"
                         id="view_material_stock_logo"
                         alt="MaterialStock Logo">
                </span>
                <div class="flex-fill main-profile-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="fw-medium mb-1"
                            id="view_material_stock_name"></h6>
                        <button type="button"
                                class="btn-close crm-contact-close-btn"
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <p class="text-muted fs-12 mb-2"
                       id="view_material_stock_grade_category">
                    </p>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <div class="mb-0">
                    <p class="fs-15 fw-medium mb-2">Description :</p>
                    <p class="text-muted mb-0"
                       id="view_material_stock_description"></p>
                </div>
            </div>

            <div class="border-bottom border-block-end-dashed p-3">
                <p class="fs-14 fw-medium mb-2">Stock Information :</p>
                <div>
                     <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-primary3-transparent">
                                <i class="ri-stack-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_material_stock_quantity_uom"></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-warning-transparent">
                                <i class="ri-price-tag-3-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_material_stock_price"></div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-success-transparent">
                                <i class="ri-warehouse-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_material_stock_warehouse_location"></div>
                    </div>
                     <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-info-transparent">
                                <i class="ri-truck-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_material_stock_supplier"></div>
                    </div>
                     <div class="d-flex align-items-center mb-2">
                        <div class="me-2">
                            <span class="avatar avatar-sm avatar-rounded bg-danger-transparent">
                                <i class="ri-home-office-line fs-14 align-middle"></i>
                            </span>
                        </div>
                        <div id="view_material_stock_branch"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End:: MaterialStock Details Offcanvas -->

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

            // Handle form submission with AJAX for material stocks
            async function submitMaterialStockForm(formSelector, buttonSelector, url, successMessage, modalSelector =
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
                    materialStockDataFetchAll();
                    showToast(successMessage, 'success');
                    if (modalSelector) $(modalSelector).modal('hide');
                } catch (error) {
                    console.error('Error submitting form:', error);
                    showToast('Error!', 'An error occurred.', 'error');
                } finally {
                    $(buttonSelector).attr('disabled', false).text('Submit');
                }
            }

            // Bind events for adding and editing material stock data
            $('#add_material_stock_data_form').on('submit', function(e) {
                e.preventDefault();
                submitMaterialStockForm('#add_material_stock_data_form', '#add_material_stock_data_btn',
                    '{{ route('materialstockstore') }}',
                    'New Material Stock added successfully!', '#addMaterialStockDataModal');
            });

            $('#edit_material_stock_data_form').on('submit', function(e) {
                e.preventDefault();
                submitMaterialStockForm('#edit_material_stock_data_form', '#edit_material_stock_data_btn',
                    '{{ route('materialstockupdate') }}',
                    'Material Stock updated successfully!', '#editMaterialStockDataModal');
            });

            // Edit material stock data modal population
            $(document).on('click', '.EditDataIcon', async function() {
                const id = $(this).attr('id');
                try {
                    const response = await $.ajax({
                        url: '{{ route('materialstockedit') }}',
                        method: 'GET',
                        data: {
                            id,
                            _token: '{{ csrf_token() }}'
                        }
                    });

                    $("#material_stock_id").val(response.id);
                    $("#edit_material_stock_logo").attr('src', response.material_profile_picture ? response
                        .material_profile_picture :
                        '{{ asset('assets/images/company-logos/1.png') }}');
                    $("#material_name_edit").val(response.material_name);
                    $("#material_grade_edit").val(response.material_grade);
                    $("#material_category_edit").val(response.material_category);
                    $("#material_UOM_edit").val(response.material_UOM);
                    $("#material_quantity_edit").val(response.material_quantity);
                    $("#material_price_edit").val(response.material_price);
                    $("#material_warehouse_location_edit").val(response.material_warehouse_location);
                    $("#material_supplier_id_edit").val(response.supplier_id);
                    $("#material_branch_id_edit").val(response.branch_id);
                    $("#material_description_edit").val(response.material_description);


                    $('#editMaterialStockDataModal').modal('show');
                } catch (error) {
                    console.error('Error fetching Material Stocks:', error);
                }
            });

            // View MaterialStock Data Modal Population
            $(document).on('click', '.ViewDataIcon', async function() {
                const id = $(this).data('id');

                try {
                    const response = await $.ajax({
                        url: `{{ route('materialstockview') }}?id=${id}`,
                        method: 'GET',
                    });

                    $('#view_material_stock_name').text(response.material_name);
                    $('#view_material_stock_grade_category').text((response.material_grade ? response.material_grade + ' - ' : '') + (response.material_category || 'N/A'));
                    $('#view_material_stock_description').text(response.material_description || 'N/A');
                    $('#view_material_stock_quantity_uom').text('Quantity: ' + (response.material_quantity ? parseFloat(response.material_quantity).toLocaleString() + ' ' + (response.material_UOM || '') : 'N/A'));
                    $('#view_material_stock_price').text('Price: ₹' + (response.material_price ? parseFloat(response.material_price).toLocaleString() : 'N/A'));
                    $('#view_material_stock_warehouse_location').text('Warehouse Location: ' + (response.material_warehouse_location || 'N/A'));
                    $('#view_material_stock_supplier').text('Supplier: ' + (response.supplier ? response.supplier.supplier_name : 'N/A'));
                    $('#view_material_stock_branch').text('Branch: ' + (response.branch ? response.branch.branch_name : 'N/A'));


                    // MaterialStock Logo
                    const logoUrl = response.material_profile_picture ?
                        `${response.material_profile_picture}` :
                        `{{ asset('assets/images/company-logos/1.png') }}`;
                    $('#view_material_stock_logo').attr('src', logoUrl);


                    $('#viewMaterialStockDataModal').offcanvas('show');

                } catch (error) {
                    console.error('Error fetching material stock details:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load material stock details.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });

            // MaterialStock Delete Functionality
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
                                url: `{{ url('materialstocks') }}/${id}`, // Corrected URL to /materialstocks/{id}
                                method: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                }
                            });

                            materialStockDataFetchAll(materialStockDateFilterValue);
                            Swal.fire(
                                'Deleted!',
                                'The material stock has been deleted.',
                                'success'
                            );

                        } catch (error) {
                            console.error('Error deleting material stock:', error);
                            Swal.fire(
                                'Error!',
                                'Failed to delete the material stock.',
                                'error'
                            );
                        }
                    }
                });
            });

            // Global variables - keep these!
            let materialStockDateFilterValue = 'last_90_days'; // Default value for date filter

            async function materialStockDataFetchAll(dateFilter = 'last_90_days') {
                try {
                    materialStockDateFilterValue = dateFilter;
                    const response = await $.ajax({
                        url: '{{ route('materialstockfetchall') }}',
                        method: 'GET',
                        data: {
                            date_filter: dateFilter
                        }
                    });

                    $('#show_all_fetched_data').html(response);
                    setupMaterialStockDataTable();
                    $('#date_filter').val(materialStockDateFilterValue);
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

            // Function to initialize the DataTable for MaterialStocks
            function setupMaterialStockDataTable() {
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
                                await materialStockDataFetchAll(dateFilter);
                            }, 300));
                            $('#date_filter').val(materialStockDateFilterValue);
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
            materialStockDataFetchAll(materialStockDateFilterValue);
        });
    </script>

    <script>
        document.getElementById('exportButton').addEventListener('click', function() {
            // Send a POST request for material stock export
            fetch('{{ route('materialstockexport') }}', {
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
                        `material_stock_export_${new Date().toLocaleDateString()}.xlsx`;
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                })
                .catch(error => console.error('Export failed:', error));
        });
    </script>
@endsection


