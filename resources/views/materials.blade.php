@extends('layouts.app')

@section('title', 'Material Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-gray-800">Material Management</h1>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDataModal">
                    <i class="fas fa-plus"></i> Add Material
                </button>
            </div>
        </div>
    </div>

    <!-- DataTable -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>UOM</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Data Modal -->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDataModalLabel">Add Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add_data_form">
                <div class="modal-body">
                    <div class="row g-3">
                        <!-- Basic Information -->
                        <div class="col-12">
                            <h6 class="fw-bold">Basic Information</h6>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Material Code*</label>
                            <input type="text" class="form-control" name="material_code" placeholder="e.g., LD2023001" required>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Material Name*</label>
                            <input type="text" class="form-control" name="material_name" placeholder="e.g., LDPE Film Grade" required>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Material Type*</label>
                            <select class="form-select" name="material_type" required>
                                <option value="">Select Type</option>
                                <option value="LD">LD - Low Density</option>
                                <option value="LLD">LLD - Linear Low Density</option>
                                <option value="HD">HD - High Density</option>
                                <option value="RD">RD - Recycled</option>
                                <option value="MB">MB - Master Batch</option>
                                <option value="OTHER">OTHER</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Material Grade</label>
                            <input type="text" class="form-control" name="material_grade" placeholder="e.g., Film Grade F2001">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Category*</label>
                            <select class="form-select" name="material_category" required>
                                <option value="">Select Category</option>
                                <option value="Raw Material" selected>Raw Material</option>
                                <option value="Finished Good">Finished Good</option>
                                <option value="Semi-Finished">Semi-Finished</option>
                                <option value="Packaging">Packaging</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Color</label>
                            <input type="text" class="form-control" name="material_color" placeholder="e.g., Natural, White, Black">
                        </div>

                        <!-- Stock Information -->
                        <div class="col-12">
                            <h6 class="fw-bold mt-3">Stock Information</h6>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Opening Balance*</label>
                            <input type="number" class="form-control" name="opening_balance" step="0.001" value="1000" required>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Quantity*</label>
                            <input type="number" class="form-control" name="quantity" step="0.001" value="1000" required>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">UOM*</label>
                            <select class="form-select" name="uom" required>
                                <option value="KG" selected>KG</option>
                                <option value="MT">MT</option>
                                <option value="PCS">PCS</option>
                                <option value="BOX">BOX</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Minimum Stock Level*</label>
                            <input type="number" class="form-control" name="minimum_stock_level" step="0.001" value="100" required>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Maximum Stock Level</label>
                            <input type="number" class="form-control" name="maximum_stock_level" step="0.001" value="5000">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Reorder Point*</label>
                            <input type="number" class="form-control" name="reorder_point" step="0.001" value="200" required>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Safety Stock*</label>
                            <input type="number" class="form-control" name="safety_stock" step="0.001" value="150" required>
                        </div>

                        <!-- Pricing -->
                        <div class="col-12">
                            <h6 class="fw-bold mt-3">Pricing Information</h6>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Unit Price*</label>
                            <input type="number" class="form-control" name="unit_price" step="0.01" value="120.50" required>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Last Purchase Price</label>
                            <input type="number" class="form-control" name="last_purchase_price" step="0.01" value="118.75">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Currency*</label>
                            <input type="text" class="form-control" name="currency" value="INR" required>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Tax Rate (%)*</label>
                            <input type="number" class="form-control" name="tax_rate" step="0.01" value="18.00" required>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">HSN Code</label>
                            <input type="text" class="form-control" name="hsn_code" placeholder="e.g., 39011010" value="39011010">
                        </div>

                        <!-- Physical Properties -->
                        <div class="col-12">
                            <h6 class="fw-bold mt-3">Physical Properties</h6>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Density (g/cm³)</label>
                            <input type="number" class="form-control" name="density" step="0.001" value="0.918" placeholder="e.g., 0.918">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Melt Flow Index (g/10min)</label>
                            <input type="number" class="form-control" name="melt_flow_index" step="0.001" value="2.000" placeholder="e.g., 2.0">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Standard Weight (kg)</label>
                            <input type="number" class="form-control" name="standard_weight" step="0.001" value="25.000">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Standard Length (mm)</label>
                            <input type="number" class="form-control" name="standard_length" step="0.001" value="1000.000">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Standard Width (mm)</label>
                            <input type="number" class="form-control" name="standard_width" step="0.001" value="1000.000">
                        </div>

                        <!-- Storage -->
                        <div class="col-12">
                            <h6 class="fw-bold mt-3">Storage Information</h6>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Warehouse Location</label>
                            <input type="text" class="form-control" name="warehouse_location" placeholder="e.g., WH-A12" value="WH-A12">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Bin Location</label>
                            <input type="text" class="form-control" name="bin_location" placeholder="e.g., BIN-B15" value="BIN-B15">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Shelf Life (Days)</label>
                            <input type="number" class="form-control" name="shelf_life_days" value="365">
                        </div>

                        <!-- Quality -->
                        <div class="col-12">
                            <h6 class="fw-bold mt-3">Quality Information</h6>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Quality Grade</label>
                            <select class="form-select" name="quality_grade">
                                <option value="">Select Grade</option>
                                <option value="Premium" selected>Premium</option>
                                <option value="Standard">Standard</option>
                                <option value="Economy">Economy</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Manufacture Date</label>
                            <input type="date" class="form-control" name="manufacture_date" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Expiry Date</label>
                            <input type="date" class="form-control" name="expiry_date" value="{{ date('Y-m-d', strtotime('+1 year')) }}">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Inspection Interval (Days)</label>
                            <input type="number" class="form-control" name="inspection_interval_days" value="30">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" name="requires_inspection" value="1" checked>
                                <label class="form-check-label">Requires Inspection</label>
                            </div>
                        </div>

                        <!-- Supplier Info -->
                        <div class="col-12">
                            <h6 class="fw-bold mt-3">Supplier Information</h6>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Primary Supplier</label>
                            <select class="form-select" name="primary_supplier_id">
                                <option value="">Select Supplier</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Manufacturer Name</label>
                            <input type="text" class="form-control" name="manufacturer_name">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Brand Name</label>
                            <input type="text" class="form-control" name="brand_name">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Lead Time (Days)</label>
                            <input type="number" class="form-control" name="lead_time_days">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Minimum Order Quantity</label>
                            <input type="number" class="form-control" name="minimum_order_quantity" step="0.001">
                        </div>

                        <!-- Documentation -->
                        <div class="col-12">
                            <h6 class="fw-bold mt-3">Documentation</h6>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Material Image URL</label>
                            <input type="text" class="form-control" name="material_image">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">MSDS Document URL</label>
                            <input type="text" class="form-control" name="msds_document">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Technical Datasheet URL</label>
                            <input type="text" class="form-control" name="technical_datasheet">
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Quality Certificate URL</label>
                            <input type="text" class="form-control" name="quality_certificate">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" name="notes" rows="3"></textarea>
                        </div>

                        <!-- Status and Control -->
                        <div class="col-12">
                            <h6 class="fw-bold mt-3">Status and Control</h6>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Status*</label>
                            <select class="form-select" name="status" required>
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="pending_approval">Pending Approval</option>
                                <option value="discontinued">Discontinued</option>
                                <option value="out_of_stock">Out of Stock</option>
                                <option value="expired">Expired</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" name="is_active" value="1" checked>
                                <label class="form-check-label">Is Active</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" name="is_returnable" value="1">
                                <label class="form-check-label">Is Returnable</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" name="is_batch_tracked" value="1" checked>
                                <label class="form-check-label">Is Batch Tracked</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-check mt-4">
                                <input type="checkbox" class="form-check-input" name="requires_coa" value="1" checked>
                                <label class="form-check-label">Requires COA</label>
                            </div>
                        </div>

                        <!-- Branch -->
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Branch*</label>
                            <select class="form-select" name="branch_id" required>
                                <option value="">Select Branch</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Material</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Data Modal -->
<div class="modal fade" id="editDataModal" tabindex="-1" aria-labelledby="editDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataModalLabel">Edit Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit_data_form">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-body">
                    <!-- Same form fields as add modal with 'edit_' prefix -->
                    <div class="row g-3">
                        <!-- Basic Information -->
                        <div class="col-12">
                            <h6 class="fw-bold">Basic Information</h6>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <label class="form-label">Material Code*</label>
                            <input type="text" class="form-control" name="material_code" id="edit_material_code" required>
                        </div>
                        <!-- Repeat all form fields from add modal with 'edit_' prefix -->
                        <!-- ... -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Material</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Data Modal -->
<div class="modal fade" id="viewDataModal" tabindex="-1" aria-labelledby="viewDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewDataModalLabel">View Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <!-- Basic Information -->
                    <div class="col-12">
                        <h6 class="fw-bold">Basic Information</h6>
                        <hr>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <p><strong>Material Code:</strong> <span id="view_material_code"></span></p>
                    </div>
                    <!-- Repeat for all fields -->
                    <!-- ... -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('materials.list') }}",
        columns: [
            {data: 'material_code', name: 'material_code'},
            {data: 'material_name', name: 'material_name'},
            {data: 'material_type', name: 'material_type'},
            {data: 'material_category', name: 'material_category'},
            {data: 'quantity', name: 'quantity'},
            {data: 'uom', name: 'uom'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

    // Add Material Form Submit
    $('#add_data_form').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('materials.store') }}",
            method: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                $('#addDataModal').modal('hide');
                table.ajax.reload();
                toastr.success('Material added successfully');
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                Object.keys(errors).forEach(function(key) {
                    toastr.error(errors[key][0]);
                });
            }
        });
    });

    // Edit Material
    $(document).on('click', '.edit-btn', function() {
        let id = $(this).data('id');
        $.get("{{ route('materials.show', '') }}/" + id, function(data) {
            $('#edit_id').val(data.id);
            $('#edit_material_code').val(data.material_code);
            // Populate all other fields
            // ...
            $('#editDataModal').modal('show');
        });
    });

    // Update Material Form Submit
    $('#edit_data_form').on('submit', function(e) {
        e.preventDefault();
        let id = $('#edit_id').val();
        $.ajax({
            url: "{{ route('materials.update', '') }}/" + id,
            method: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function(response) {
                $('#editDataModal').modal('hide');
                table.ajax.reload();
                toastr.success('Material updated successfully');
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                Object.keys(errors).forEach(function(key) {
                    toastr.error(errors[key][0]);
                });
            }
        });
    });

    // View Material
    $(document).on('click', '.view-btn', function() {
        let id = $(this).data('id');
        $.get("{{ route('materials.show', '') }}/" + id, function(data) {
            $('#view_material_code').text(data.material_code);
            // Populate all other view fields
            // ...
            $('#viewDataModal').modal('show');
        });
    });

    // Delete Material
    $(document).on('click', '.delete-btn', function() {
        let id = $(this).data('id');
        if (confirm('Are you sure you want to delete this material?')) {
            $.ajax({
                url: "{{ route('materials.destroy', '') }}/" + id,
                method: "DELETE",
                success: function(response) {
                    table.ajax.reload();
                    toastr.success('Material deleted successfully');
                },
                error: function(xhr) {
                    toastr.error('Error deleting material');
                }
            });
        }
    });
});
</script>
@endsection
