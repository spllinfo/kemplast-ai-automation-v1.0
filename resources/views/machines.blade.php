@extends('layouts.app')

@section('content')
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        Machines
                    </div>
                    <div class="d-flex flex-wrap gap-2">

                        <button type="button"
                                class="modal-effect btn btn-white btn-wave"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#addMachineDataModal">
                            <i class="ri-file-add-line lh-1 me-1 align-middle"></i> New
                        </button>

                        <button type="button"
                                class="modal-effect btn btn-primary3 btn-wave me-0"
                                data-bs-effect="effect-slide-in-right"
                                data-bs-toggle="modal"
                                data-bs-target="#importMachineDataModal">
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
                    <div class="table-responsive">
                        <table id="machines_table" class="table table-hover table-striped table-vcenter text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Machine</th>
                                    <th>Technical Details</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Warranty</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->

    <!-- Add Import From Machine -->
    <div class="modal fade"
         id="importMachineDataModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="importMachineDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="importMachineDataModal">Import Machines</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="machineimport"
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
                                    class="btn btn-primary">Import Machines</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Export From Machine -->
    <div class="modal fade"
         id="ExportMachineModel"
         tabindex="-1"
         role="dialog"
         aria-labelledby="ExportMachineModel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered"
             role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"
                        id="ExportMachineModel">Export Machines</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('machineexport') }}"
                          method="POST">
                        @csrf
                        <label for="machine_from_date">From Date:</label>
                        <input type="date"
                               name="from_date"
                               id="machine_from_date"
                               required>

                        <label for="machine_to_date">To Date:</label>
                        <input type="date"
                               name="to_date"
                               value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                               id="machine_to_date"
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

    <!-- Start:: Add Machine add data modal -->
    <div class="modal fade"
         id="addMachineDataModal"
         tabindex="-1"
         aria-labelledby="addMachineDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="addMachineDataModal">Add Machine</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="add_machine_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row gy-3">
                            <!-- Machine Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/8.png') }}"
                                             alt="Machine Logo"
                                             name="machine-logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="machine_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="machine-profile-change">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- Basic Information -->
                            <div class="col-md-12 col-lg-8">
                                <div class="row gy-2">
                                    <!-- Machine Code -->
                                    <div class="col-md-6">
                                        <label for="machine_code" class="form-label">Machine Code <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                               id="machine_code"
                                               name="machine_code"
                                               placeholder="Enter Machine Code"
                                               value="MCH-001"
                                               data-validate="true"
                                               required>
                                        <div class="form-text field-feedback"></div>
                            </div>

                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control"
                                               id="name"
                                               name="name"
                                               placeholder="Enter Machine Name"
                                               value="Test Machine"
                                               data-validate="true"
                                               required>
                                        <div class="form-text field-feedback"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Model and Serial Numbers -->
                            <div class="col-md-6 col-lg-6">
                                <label for="model_number" class="form-label">Model Number</label>
                                <input type="text"
                                       class="form-control"
                                       id="model_number"
                                       name="model_number"
                                       placeholder="Enter Model Number"
                                       value="MDL-2023"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <label for="serial_number" class="form-label">Serial Number</label>
                                <input type="text"
                                       class="form-control"
                                       id="serial_number"
                                       name="serial_number"
                                       placeholder="Enter Serial Number"
                                       value="SN-12345"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Manufacturer and Dates -->
                            <div class="col-md-6 col-lg-4">
                                <label for="manufacturer" class="form-label">Manufacturer</label>
                                <input type="text"
                                       class="form-control"
                                       id="manufacturer"
                                       name="manufacturer"
                                       placeholder="Enter Manufacturer"
                                       value="Test Manufacturer"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label for="manufacturing_date" class="form-label">Manufacturing Date</label>
                                <input type="date"
                                       class="form-control"
                                       id="manufacturing_date"
                                       name="manufacturing_date"
                                       value="{{ date('Y-m-d', strtotime('-1 year')) }}"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label for="purchase_date" class="form-label">Purchase Date</label>
                                <input type="date"
                                       class="form-control"
                                       id="purchase_date"
                                       name="purchase_date"
                                       value="{{ date('Y-m-d', strtotime('-6 months')) }}"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Warranty Dates -->
                            <div class="col-md-6 col-lg-6">
                                <label for="warranty_start_date" class="form-label">Warranty Start Date</label>
                                <input type="date"
                                       class="form-control"
                                       id="warranty_start_date"
                                       name="warranty_start_date"
                                       value="{{ date('Y-m-d', strtotime('-6 months')) }}"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <label for="warranty_end_date" class="form-label">Warranty End Date</label>
                                <input type="date"
                                       class="form-control"
                                       id="warranty_end_date"
                                       name="warranty_end_date"
                                       value="{{ date('Y-m-d', strtotime('+1 year +6 months')) }}"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Financial Information -->
                            <div class="col-md-6 col-lg-6">
                                <label for="purchase_price" class="form-label">Purchase Price</label>
                                <input type="number"
                                       class="form-control"
                                       id="purchase_price"
                                       name="purchase_price"
                                       step="0.01"
                                       value="50000.00"
                                       placeholder="Enter Purchase Price"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <label for="current_value" class="form-label">Current Value</label>
                                <input type="number"
                                       class="form-control"
                                       id="current_value"
                                       name="current_value"
                                       step="0.01"
                                       value="45000.00"
                                       placeholder="Enter Current Value"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Location and Status -->
                            <div class="col-md-6 col-lg-4">
                                <label for="branch_id" class="form-label">Branch <span class="text-danger">*</span></label>
                                <select class="form-select"
                                        id="branch_id"
                                        name="branch_id"
                                        data-validate="true"
                                        required>
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label for="location" class="form-label">Location</label>
                                <input type="text"
                                       class="form-control"
                                       id="location"
                                       name="location"
                                       value="Production Floor A"
                                       placeholder="Enter Location"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select"
                                        id="status"
                                        name="status"
                                        data-validate="true">
                                    <option value="active" selected>Active</option>
                                    <option value="maintenance">Maintenance</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="repair">Repair</option>
                                    <option value="scrapped">Scrapped</option>
                                </select>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Technical Specifications -->
                            <div class="col-md-6 col-lg-3">
                                <label for="capacity" class="form-label">Capacity</label>
                                <input type="number"
                                       class="form-control"
                                       id="capacity"
                                       name="capacity"
                                       step="0.01"
                                       value="1000"
                                       placeholder="Enter Capacity"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="capacity_unit" class="form-label">Capacity Unit</label>
                                <input type="text"
                                       class="form-control"
                                       id="capacity_unit"
                                       name="capacity_unit"
                                       value="kg/hr"
                                       placeholder="Enter Unit"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="power_consumption" class="form-label">Power Consumption</label>
                                <input type="number"
                                       class="form-control"
                                       id="power_consumption"
                                       name="power_consumption"
                                       step="0.01"
                                       value="7.5"
                                       placeholder="Enter Power"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="power_unit" class="form-label">Power Unit</label>
                                <input type="text"
                                       class="form-control"
                                       id="power_unit"
                                       name="power_unit"
                                       value="kW"
                                       placeholder="Enter Unit"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="operating_pressure" class="form-label">Operating Pressure</label>
                                <input type="number"
                                       class="form-control"
                                       id="operating_pressure"
                                       name="operating_pressure"
                                       step="0.01"
                                       value="6.5"
                                       placeholder="Enter Pressure"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="pressure_unit" class="form-label">Pressure Unit</label>
                                <input type="text"
                                       class="form-control"
                                       id="pressure_unit"
                                       name="pressure_unit"
                                       value="bar"
                                       placeholder="Enter Unit"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="operating_temperature" class="form-label">Operating Temperature</label>
                                <input type="number"
                                       class="form-control"
                                       id="operating_temperature"
                                       name="operating_temperature"
                                       step="0.01"
                                       value="180"
                                       placeholder="Enter Temperature"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="temperature_unit" class="form-label">Temperature Unit</label>
                                <input type="text"
                                       class="form-control"
                                       id="temperature_unit"
                                       name="temperature_unit"
                                       value="°C"
                                       placeholder="Enter Unit"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Additional Information -->
                            <div class="col-md-12">
                                <label for="specifications" class="form-label">Specifications</label>
                                <textarea class="form-control"
                                          id="specifications"
                                          name="specifications"
                                          rows="3"
                                          placeholder="Enter Specifications (JSON format)"
                                          data-validate="true">{
    "motor_power": "5.5 kW",
    "control_system": "PLC Based",
    "dimensions": "2.5m x 1.5m x 2m",
    "weight": "1200 kg"
}</textarea>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-12">
                                <label for="maintenance_schedule" class="form-label">Maintenance Schedule</label>
                                <textarea class="form-control"
                                          id="maintenance_schedule"
                                          name="maintenance_schedule"
                                          rows="3"
                                          placeholder="Enter Maintenance Schedule (JSON format)"
                                          data-validate="true">{
    "daily": ["Clean machine", "Check oil level"],
    "weekly": ["Lubricate bearings", "Check belt tension"],
    "monthly": ["Replace filters", "Calibrate sensors"],
    "quarterly": ["Full service", "Safety inspection"]
}</textarea>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-12">
                                <label for="spare_parts" class="form-label">Spare Parts</label>
                                <textarea class="form-control"
                                          id="spare_parts"
                                          name="spare_parts"
                                          rows="3"
                                          placeholder="Enter Spare Parts (JSON format)"
                                          data-validate="true">{
    "critical": ["Heating elements", "Drive belts", "Control board"],
    "consumables": ["Oil filters", "Air filters", "Lubricants"],
    "wear_parts": ["Bearings", "Seals", "Gaskets"]
}</textarea>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-12">
                                <label for="documents" class="form-label">Documents</label>
                                <textarea class="form-control"
                                          id="documents"
                                          name="documents"
                                          rows="3"
                                          placeholder="Enter Documents (JSON format)"
                                          data-validate="true">{
    "manuals": ["Operating manual", "Maintenance guide", "Parts catalog"],
    "certificates": ["CE certification", "Safety compliance"],
    "warranties": ["Main warranty", "Extended warranty"]
}</textarea>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-12">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control"
                                          id="notes"
                                          name="notes"
                                          rows="3"
                                          placeholder="Enter Notes"
                                          data-validate="true">Test machine for production line. Regular maintenance required every 3 months. Critical for main production process.</textarea>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-12">
                                <label for="metadata" class="form-label">Metadata</label>
                                <textarea class="form-control"
                                          id="metadata"
                                          name="metadata"
                                          rows="3"
                                          placeholder="Enter Metadata (JSON format)"
                                          data-validate="true">{
    "installation_date": "2023-01-15",
    "installed_by": "Technical Team A",
    "last_major_service": "2023-06-15",
    "next_service_due": "2023-09-15"
}</textarea>
                                <div class="form-text field-feedback"></div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="add_machine_data_btn"
                            class="btn btn-primary">Create Machine</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Start:: EDIT Machine data modal -->
    <div class="modal fade"
         id="editMachineDataModal"
         tabindex="-1"
         aria-labelledby="editMachineDataModal"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"
                        id="editMachineDataModal">Edit Machine</h6>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#"
                          method="POST"
                          id="edit_machine_data_form"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="machine_id" id="machine_id">
                        <div class="row gy-3">
                            <!-- Machine Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/8.png') }}"
                                             alt="Machine Logo"
                                             id="edit_machine_logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="machine_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="edit-machine-profile-change">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- Basic Information -->
                            <div class="col-md-12 col-lg-8">
                                <div class="row gy-2">
                                    <!-- Machine Code -->
                                    <div class="col-md-6">
                                        <label for="edit_machine_code" class="form-label">Machine Code <span class="text-danger">*</span></label>
                                <input type="text"
                                       class="form-control"
                                               id="edit_machine_code"
                                               name="machine_code"
                                               placeholder="Enter Machine Code"
                                               data-validate="true"
                                               required>
                                        <div class="form-text field-feedback"></div>
                            </div>

                                    <!-- Name -->
                                    <div class="col-md-6">
                                        <label for="edit_name" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                               class="form-control"
                                               id="edit_name"
                                               name="name"
                                               placeholder="Enter Machine Name"
                                               data-validate="true"
                                               required>
                                        <div class="form-text field-feedback"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Model and Serial Numbers -->
                            <div class="col-md-6 col-lg-6">
                                <label for="edit_model_number" class="form-label">Model Number</label>
                                <input type="text"
                                       class="form-control"
                                       id="edit_model_number"
                                       name="model_number"
                                       placeholder="Enter Model Number"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <label for="edit_serial_number" class="form-label">Serial Number</label>
                                <input type="text"
                                       class="form-control"
                                       id="edit_serial_number"
                                       name="serial_number"
                                       placeholder="Enter Serial Number"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Manufacturer and Dates -->
                            <div class="col-md-6 col-lg-4">
                                <label for="edit_manufacturer" class="form-label">Manufacturer</label>
                                <input type="text"
                                       class="form-control"
                                       id="edit_manufacturer"
                                       name="manufacturer"
                                       placeholder="Enter Manufacturer"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label for="edit_manufacturing_date" class="form-label">Manufacturing Date</label>
                                <input type="date"
                                       class="form-control"
                                       id="edit_manufacturing_date"
                                       name="manufacturing_date"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label for="edit_purchase_date" class="form-label">Purchase Date</label>
                                <input type="date"
                                       class="form-control"
                                       id="edit_purchase_date"
                                       name="purchase_date"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Warranty Dates -->
                            <div class="col-md-6 col-lg-6">
                                <label for="edit_warranty_start_date" class="form-label">Warranty Start Date</label>
                                <input type="date"
                                       class="form-control"
                                       id="edit_warranty_start_date"
                                       name="warranty_start_date"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <label for="edit_warranty_end_date" class="form-label">Warranty End Date</label>
                                <input type="date"
                                       class="form-control"
                                       id="edit_warranty_end_date"
                                       name="warranty_end_date"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Financial Information -->
                            <div class="col-md-6 col-lg-6">
                                <label for="edit_purchase_price" class="form-label">Purchase Price</label>
                                <input type="number"
                                       class="form-control"
                                       id="edit_purchase_price"
                                       name="purchase_price"
                                       step="0.01"
                                       placeholder="Enter Purchase Price"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <label for="edit_current_value" class="form-label">Current Value</label>
                                <input type="number"
                                       class="form-control"
                                       id="edit_current_value"
                                       name="current_value"
                                       step="0.01"
                                       placeholder="Enter Current Value"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Location and Status -->
                            <div class="col-md-6 col-lg-4">
                                <label for="edit_branch_id" class="form-label">Branch <span class="text-danger">*</span></label>
                                <select class="form-select"
                                        id="edit_branch_id"
                                        name="branch_id"
                                        data-validate="true"
                                        required>
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label for="edit_location" class="form-label">Location</label>
                                <input type="text"
                                       class="form-control"
                                       id="edit_location"
                                       name="location"
                                       placeholder="Enter Location"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                                <label for="edit_status" class="form-label">Status</label>
                                <select class="form-select"
                                        id="edit_status"
                                        name="status"
                                        data-validate="true">
                                    <option value="active">Active</option>
                                    <option value="maintenance">Maintenance</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="repair">Repair</option>
                                    <option value="scrapped">Scrapped</option>
                                </select>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Technical Specifications -->
                            <div class="col-md-6 col-lg-3">
                                <label for="edit_capacity" class="form-label">Capacity</label>
                                <input type="number"
                                       class="form-control"
                                       id="edit_capacity"
                                       name="capacity"
                                       step="0.01"
                                       placeholder="Enter Capacity"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="edit_capacity_unit" class="form-label">Capacity Unit</label>
                                <input type="text"
                                       class="form-control"
                                       id="edit_capacity_unit"
                                       name="capacity_unit"
                                       placeholder="Enter Unit"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="edit_power_consumption" class="form-label">Power Consumption</label>
                                <input type="number"
                                       class="form-control"
                                       id="edit_power_consumption"
                                       name="power_consumption"
                                       step="0.01"
                                       placeholder="Enter Power"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="edit_power_unit" class="form-label">Power Unit</label>
                                <input type="text"
                                       class="form-control"
                                       id="edit_power_unit"
                                       name="power_unit"
                                       placeholder="Enter Unit"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="edit_operating_pressure" class="form-label">Operating Pressure</label>
                                <input type="number"
                                       class="form-control"
                                       id="edit_operating_pressure"
                                       name="operating_pressure"
                                       step="0.01"
                                       placeholder="Enter Pressure"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="edit_pressure_unit" class="form-label">Pressure Unit</label>
                                <input type="text"
                                       class="form-control"
                                       id="edit_pressure_unit"
                                       name="pressure_unit"
                                       placeholder="Enter Unit"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="edit_operating_temperature" class="form-label">Operating Temperature</label>
                                <input type="number"
                                       class="form-control"
                                       id="edit_operating_temperature"
                                       name="operating_temperature"
                                       step="0.01"
                                       placeholder="Enter Temperature"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-6 col-lg-3">
                                <label for="edit_temperature_unit" class="form-label">Temperature Unit</label>
                                <input type="text"
                                       class="form-control"
                                       id="edit_temperature_unit"
                                       name="temperature_unit"
                                       placeholder="Enter Unit"
                                       data-validate="true">
                                <div class="form-text field-feedback"></div>
                            </div>

                            <!-- Additional Information -->
                            <div class="col-md-12">
                                <label for="edit_specifications" class="form-label">Specifications</label>
                                <textarea class="form-control"
                                          id="edit_specifications"
                                          name="specifications"
                                          rows="3"
                                          placeholder="Enter Specifications (JSON format)"
                                          data-validate="true"></textarea>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-12">
                                <label for="edit_maintenance_schedule" class="form-label">Maintenance Schedule</label>
                                <textarea class="form-control"
                                          id="edit_maintenance_schedule"
                                          name="maintenance_schedule"
                                          rows="3"
                                          placeholder="Enter Maintenance Schedule (JSON format)"
                                          data-validate="true"></textarea>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-12">
                                <label for="edit_spare_parts" class="form-label">Spare Parts</label>
                                <textarea class="form-control"
                                          id="edit_spare_parts"
                                          name="spare_parts"
                                          rows="3"
                                          placeholder="Enter Spare Parts (JSON format)"
                                          data-validate="true"></textarea>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-12">
                                <label for="edit_documents" class="form-label">Documents</label>
                                <textarea class="form-control"
                                          id="edit_documents"
                                          name="documents"
                                          rows="3"
                                          placeholder="Enter Documents (JSON format)"
                                          data-validate="true"></textarea>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-12">
                                <label for="edit_notes" class="form-label">Notes</label>
                                <textarea class="form-control"
                                          id="edit_notes"
                                          name="notes"
                                          rows="3"
                                          placeholder="Enter Notes"
                                          data-validate="true"></textarea>
                                <div class="form-text field-feedback"></div>
                            </div>

                            <div class="col-md-12">
                                <label for="edit_metadata" class="form-label">Metadata</label>
                                <textarea class="form-control"
                                          id="edit_metadata"
                                          name="metadata"
                                          rows="3"
                                          placeholder="Enter Metadata (JSON format)"
                                          data-validate="true"></textarea>
                                <div class="form-text field-feedback"></div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal">Cancel</button>
                    <button type="submit"
                            id="edit_machine_data_btn"
                            class="btn btn-primary">Update Machine</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: EDIT Machine -->

    <!-- Start:: Machine Details Offcanvas -->
    <div class="offcanvas offcanvas-end"
         tabindex="-1"
         id="viewMachineDataModal"
         aria-labelledby="viewMachineDataModalLabel">
        <div class="offcanvas-header">
            <h5 id="viewMachineDataModalLabel"
                class="offcanvas-title">Machine Details</h5>
                        <button type="button"
                    class="btn-close text-reset"
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
        <div class="offcanvas-body">
            <div class="text-center mb-5">
                <img src="{{ asset('assets/images/company-logos/8.png') }}"
                     id="view_machine_logo"
                     class="avatar avatar-xxl avatar-rounded"
                     alt="Machine Logo">
            </div>

            <div class="row gy-4">
                <!-- Basic Information -->
                <div class="col-12">
                    <h6 class="mb-4">Basic Information</h6>
                    <div class="row gy-4">
                        <div class="col-sm-6">
                            <div class="text-muted small">Machine Code</div>
                            <div id="view_machine_code"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small">Name</div>
                            <div id="view_name"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small">Model Number</div>
                            <div id="view_model_number"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small">Serial Number</div>
                            <div id="view_serial_number"></div>
                        </div>
                </div>
            </div>

                <!-- Manufacturer and Dates -->
                <div class="col-12">
                    <h6 class="mb-4">Manufacturer & Dates</h6>
                    <div class="row gy-4">
                        <div class="col-sm-6">
                            <div class="text-muted small">Manufacturer</div>
                            <div id="view_manufacturer"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small">Manufacturing Date</div>
                            <div id="view_manufacturing_date"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small">Purchase Date</div>
                            <div id="view_purchase_date"></div>
                        </div>
                    </div>
                </div>

                <!-- Warranty Information -->
                <div class="col-12">
                    <h6 class="mb-4">Warranty Information</h6>
                    <div class="row gy-4">
                        <div class="col-sm-6">
                            <div class="text-muted small">Warranty Start Date</div>
                            <div id="view_warranty_start_date"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small">Warranty End Date</div>
                            <div id="view_warranty_end_date"></div>
                        </div>
                    </div>
                </div>

                <!-- Financial Information -->
                <div class="col-12">
                    <h6 class="mb-4">Financial Information</h6>
                    <div class="row gy-4">
                        <div class="col-sm-6">
                            <div class="text-muted small">Purchase Price</div>
                            <div id="view_purchase_price"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small">Current Value</div>
                            <div id="view_current_value"></div>
                        </div>
                    </div>
                </div>

                <!-- Location and Status -->
                <div class="col-12">
                    <h6 class="mb-4">Location & Status</h6>
                    <div class="row gy-4">
                        <div class="col-sm-6">
                            <div class="text-muted small">Branch</div>
                            <div id="view_branch_name"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small">Location</div>
                            <div id="view_location"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small">Status</div>
                            <div id="view_status"></div>
                        </div>
                    </div>
                </div>

                <!-- Technical Specifications -->
                <div class="col-12">
                    <h6 class="mb-4">Technical Specifications</h6>
                    <div class="row gy-4">
                        <div class="col-sm-6">
                            <div class="text-muted small">Capacity</div>
                            <div><span id="view_capacity"></span> <span id="view_capacity_unit"></span></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small">Power Consumption</div>
                            <div><span id="view_power_consumption"></span> <span id="view_power_unit"></span></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small">Operating Pressure</div>
                            <div><span id="view_operating_pressure"></span> <span id="view_pressure_unit"></span></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-muted small">Operating Temperature</div>
                            <div><span id="view_operating_temperature"></span> <span id="view_temperature_unit"></span></div>
                        </div>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="col-12">
                    <h6 class="mb-4">Additional Information</h6>
                    <div class="row gy-4">
                        <div class="col-12">
                            <div class="text-muted small">Specifications</div>
                            <pre class="mt-2"><code id="view_specifications"></code></pre>
                        </div>
                        <div class="col-12">
                            <div class="text-muted small">Maintenance Schedule</div>
                            <pre class="mt-2"><code id="view_maintenance_schedule"></code></pre>
                        </div>
                        <div class="col-12">
                            <div class="text-muted small">Spare Parts</div>
                            <pre class="mt-2"><code id="view_spare_parts"></code></pre>
                        </div>
                        <div class="col-12">
                            <div class="text-muted small">Documents</div>
                            <pre class="mt-2"><code id="view_documents"></code></pre>
                        </div>
                        <div class="col-12">
                            <div class="text-muted small">Notes</div>
                            <div id="view_notes"></div>
                        </div>
                        <div class="col-12">
                            <div class="text-muted small">Metadata</div>
                            <pre class="mt-2"><code id="view_metadata"></code></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End:: Machine Details Offcanvas -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(function() {
            // Debug Mode Flag
            const DEBUG_MODE = true;

            // Debug Logger
            const Logger = {
                info: function(message, data = null) {
                    if (DEBUG_MODE) {
                        console.log(`%c[INFO] ${message}`, 'color: #0066cc', data || '');
                    }
                },
                error: function(message, error = null) {
                    if (DEBUG_MODE) {
                        console.error(`%c[ERROR] ${message}`, 'color: #cc0000', error || '');
                    }
                },
                warn: function(message, data = null) {
                    if (DEBUG_MODE) {
                        console.warn(`%c[WARN] ${message}`, 'color: #cc6600', data || '');
                    }
                },
                success: function(message, data = null) {
                    if (DEBUG_MODE) {
                        console.log(`%c[SUCCESS] ${message}`, 'color: #006600', data || '');
                    }
                }
            };

            // Modal Event Debugging
            ['show.bs.modal', 'shown.bs.modal', 'hide.bs.modal', 'hidden.bs.modal'].forEach(event => {
                $('.modal').on(event, function(e) {
                    Logger.info(`Modal Event: ${event} - ${this.id}`);
                });
            });

            // Setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-XSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            // Add Global AJAX Event Handlers
            $(document).ajaxSend(function(event, jqXHR, settings) {
                Logger.info('AJAX Request Started:', {
                    url: settings.url,
                    type: settings.type,
                    data: settings.data
                });
            });

            $(document).ajaxSuccess(function(event, jqXHR, settings, data) {
                Logger.success('AJAX Request Successful:', {
                    url: settings.url,
                    response: data
                });
            });

            $(document).ajaxError(function(event, jqXHR, settings, error) {
                Logger.error('AJAX Request Failed:', {
                    url: settings.url,
                    status: jqXHR.status,
                    error: error,
                    response: jqXHR.responseJSON
                });
            });

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    Logger.info('Toast Opened');
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });

            function showToast(title, message, type = 'info') {
                Logger.info('Showing Toast:', { title, message, type });
                Toast.fire({
                    icon: type,
                    title: title ? title : message
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

            // Handle form submission with AJAX for machines
            async function submitMachineForm(formSelector, buttonSelector, url, successMessage, modalSelector = null) {
                Logger.info('Form Submission Started:', { formSelector, url });

                const $form = $(formSelector);
                const $button = $(buttonSelector);
                const formData = new FormData($form[0]);

                // Debug Form Data
                for (let pair of formData.entries()) {
                    Logger.info('Form Data:', { field: pair[0], value: pair[1] });
                }

                // JSON Fields Validation
                const jsonFields = ['specifications', 'maintenance_schedule', 'spare_parts', 'documents', 'metadata'];
                for (const field of jsonFields) {
                    try {
                        const value = $form.find(`[name="${field}"]`).val();
                        if (value) {
                            const parsedJson = JSON.parse(value.trim());
                            formData.set(field, JSON.stringify(parsedJson));
                            Logger.info(`JSON Field Parsed Successfully: ${field}`, parsedJson);
                        }
                    } catch (e) {
                        Logger.error(`JSON Parse Error in ${field}:`, e);
                        showToast('Error', `Invalid JSON format in ${field}`, 'error');
                        return false;
                    }
                }

                try {
                    $button.prop('disabled', true)
                           .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

                    const response = await $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false
                    });

                    Logger.success('Form Submission Success:', response);

                    if (response.status === 200) {
                    $form[0].reset();
                        if (machineTable) {
                            Logger.info('Refreshing DataTable');
                            machineTable.draw();
                        }
                        showToast('Success', successMessage, 'success');
                        if (modalSelector) {
                            $(modalSelector).modal('hide');
                        }
                    } else {
                        throw new Error(response.message || 'Unknown error occurred');
                    }
                } catch (error) {
                    Logger.error('Form Submission Error:', error);

                    if (error.responseJSON && error.responseJSON.errors) {
                        Object.entries(error.responseJSON.errors).forEach(([field, [message]]) => {
                            Logger.warn(`Validation Error: ${field}`, message);
                            const $field = $form.find(`[name="${field}"]`);
                            const $feedback = $field.siblings('.field-feedback');
                            $field.addClass('is-invalid');
                            $feedback.html(`<div class="invalid-feedback">${message}</div>`);
                        });
                        showToast('Validation Error', 'Please check the form for errors', 'error');
                    } else {
                        showToast('Error', error.responseJSON?.message || 'An error occurred while saving the machine', 'error');
                    }
                } finally {
                    $button.prop('disabled', false)
                           .text(buttonSelector === '#add_machine_data_btn' ? 'Create Machine' : 'Update Machine');
                }
            }

            // Bind events for adding and editing machine data
            $('#add_machine_data_form').on('submit', function(e) {
                e.preventDefault();
                submitMachineForm(
                    '#add_machine_data_form',
                    '#add_machine_data_btn',
                    '{{ route('machinestore') }}',
                    'New Machine added successfully!',
                    '#addMachineDataModal'
                );
            });

            // Clear validation errors when modal is hidden
            $('#addMachineDataModal, #editMachineDataModal').on('hidden.bs.modal', function() {
                const $form = $(this).find('form');
                $form.find('.is-invalid').removeClass('is-invalid');
                $form.find('.field-feedback').empty();
            });

            // Edit machine data modal population
            $(document).on('click', '.EditDataIcon', async function() {
                const id = $(this).attr('id');
                try {
                    const response = await $.ajax({
                        url: '{{ route('machineedit') }}',
                        method: 'GET',
                        data: {
                            id,
                            _token: '{{ csrf_token() }}'
                        }
                    });

                    $("#machine_id").val(response.id);
                    $("#edit_machine_logo").attr('src', response.machine_profile_picture ? response
                        .machine_profile_picture :
                        '{{ asset('assets/images/company-logos/1.png') }}');
                    $("#edit_machine_code").val(response.machine_code);
                    $("#edit_name").val(response.name);
                    $("#edit_model_number").val(response.model_number);
                    $("#edit_serial_number").val(response.serial_number);
                    $("#edit_manufacturer").val(response.manufacturer);
                    $("#edit_manufacturing_date").val(response.manufacturing_date);
                    $("#edit_purchase_date").val(response.purchase_date);
                    $("#edit_warranty_start_date").val(response.warranty_start_date);
                    $("#edit_warranty_end_date").val(response.warranty_end_date);
                    $("#edit_purchase_price").val(response.purchase_price);
                    $("#edit_current_value").val(response.current_value);
                    $("#edit_branch_id").val(response.branch_id);
                    $("#edit_location").val(response.location);
                    $("#edit_status").val(response.status);
                    $("#edit_capacity").val(response.capacity);
                    $("#edit_capacity_unit").val(response.capacity_unit);
                    $("#edit_power_consumption").val(response.power_consumption);
                    $("#edit_power_unit").val(response.power_unit);
                    $("#edit_operating_pressure").val(response.operating_pressure);
                    $("#edit_pressure_unit").val(response.pressure_unit);
                    $("#edit_operating_temperature").val(response.operating_temperature);
                    $("#edit_temperature_unit").val(response.temperature_unit);
                    $("#edit_specifications").val(response.specifications);
                    $("#edit_maintenance_schedule").val(response.maintenance_schedule);
                    $("#edit_spare_parts").val(response.spare_parts);
                    $("#edit_documents").val(response.documents);
                    $("#edit_notes").val(response.notes);
                    $("#edit_metadata").val(response.metadata);

                    $('#editMachineDataModal').modal('show');
                } catch (error) {
                    console.error('Error fetching Machines:', error);
                }
            });

            // View Machine Data Modal Population
            $(document).on('click', '.ViewDataIcon', async function() {
                const id = $(this).attr('id');
                try {
                    const response = await $.ajax({
                        url: '{{ route('machineview') }}',
                        method: 'GET',
                        data: {
                            id,
                            _token: '{{ csrf_token() }}'
                        }
                    });

                    // Update view modal with machine data
                    $("#view_machine_logo").attr('src', response.machine_profile_picture ?
                        response.machine_profile_picture :
                        '{{ asset('assets/images/company-logos/8.png') }}');

                    // Basic Information
                    $("#view_machine_code").text(response.machine_code);
                    $("#view_name").text(response.name);
                    $("#view_model_number").text(response.model_number || 'N/A');
                    $("#view_serial_number").text(response.serial_number || 'N/A');

                    // Manufacturer and Dates
                    $("#view_manufacturer").text(response.manufacturer || 'N/A');
                    $("#view_manufacturing_date").text(response.manufacturing_date ?
                        moment(response.manufacturing_date).format('MMMM D, YYYY') : 'N/A');
                    $("#view_purchase_date").text(response.purchase_date ?
                        moment(response.purchase_date).format('MMMM D, YYYY') : 'N/A');

                    // Warranty Information
                    $("#view_warranty_start_date").text(response.warranty_start_date ?
                        moment(response.warranty_start_date).format('MMMM D, YYYY') : 'N/A');
                    $("#view_warranty_end_date").text(response.warranty_end_date ?
                        moment(response.warranty_end_date).format('MMMM D, YYYY') : 'N/A');

                    // Financial Information
                    $("#view_purchase_price").text(response.purchase_price ?
                        new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' })
                            .format(response.purchase_price) : 'N/A');
                    $("#view_current_value").text(response.current_value ?
                        new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' })
                            .format(response.current_value) : 'N/A');

                    // Location and Status
                    $("#view_branch_name").text(response.branch ? response.branch.branch_name : 'N/A');
                    $("#view_location").text(response.location || 'N/A');
                    $("#view_status").html(`<span class="badge bg-${getStatusBadgeColor(response.status)}">${response.status}</span>`);

                    // Technical Specifications
                    $("#view_capacity").text(response.capacity || 'N/A');
                    $("#view_capacity_unit").text(response.capacity_unit || '');
                    $("#view_power_consumption").text(response.power_consumption || 'N/A');
                    $("#view_power_unit").text(response.power_unit || '');
                    $("#view_operating_pressure").text(response.operating_pressure || 'N/A');
                    $("#view_pressure_unit").text(response.pressure_unit || '');
                    $("#view_operating_temperature").text(response.operating_temperature || 'N/A');
                    $("#view_temperature_unit").text(response.temperature_unit || '');

                    // Additional Information
                    $("#view_specifications").text(response.specifications ?
                        JSON.stringify(response.specifications, null, 2) : 'N/A');
                    $("#view_maintenance_schedule").text(response.maintenance_schedule ?
                        JSON.stringify(response.maintenance_schedule, null, 2) : 'N/A');
                    $("#view_spare_parts").text(response.spare_parts ?
                        JSON.stringify(response.spare_parts, null, 2) : 'N/A');
                    $("#view_documents").text(response.documents ?
                        JSON.stringify(response.documents, null, 2) : 'N/A');
                    $("#view_notes").text(response.notes || 'N/A');
                    $("#view_metadata").text(response.metadata ?
                        JSON.stringify(response.metadata, null, 2) : 'N/A');

                    // Helper function for status badge colors
                    function getStatusBadgeColor(status) {
                        const colors = {
                            'active': 'success',
                            'maintenance': 'warning',
                            'inactive': 'danger',
                            'repair': 'info',
                            'scrapped': 'secondary'
                        };
                        return colors[status] || 'primary';
                    }

                    $('#viewMachineDataModal').offcanvas('show');
                } catch (error) {
                    console.error('Error fetching machine details:', error);
                    showToast('Error!', 'Failed to fetch machine details', 'error');
                }
            });

            // Machine Delete Functionality
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
                                url: `{{ url('machines') }}/${id}`, // Corrected URL to /machines/{id}
                                method: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                }
                            });

                            machineDataFetchAll(machineDateFilterValue);
                            Swal.fire(
                                'Deleted!',
                                'The machine has been deleted.',
                                'success'
                            );

                        } catch (error) {
                            console.error('Error deleting machine:', error);
                            Swal.fire(
                                'Error!',
                                'Failed to delete the machine.',
                                'error'
                            );
                        }
                    }
                });
            });

            // Global variables - keep these!
            let machineDateFilterValue = 'last_90_days'; // Default value for date filter

            async function machineDataFetchAll(dateFilter = 'last_90_days') {
                try {
                    machineDateFilterValue = dateFilter;
                    const response = await $.ajax({
                        url: '{{ route('machinefetchall') }}',
                        method: 'GET',
                        data: {
                            date_filter: dateFilter
                        }
                    });

                    $('#machines_table').html(response);
                    setupMachineDataTable();
                    $('#date_filter').val(machineDateFilterValue);
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

            // Function to initialize the DataTable for Machines
            function setupMachineDataTable() {
                Logger.info('Initializing DataTable');

                if ($.fn.DataTable.isDataTable('#machines_table')) {
                    Logger.info('Destroying existing DataTable instance');
                    $('#machines_table').DataTable().destroy();
                }

                const dataTable = $('#machines_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('machinedata') }}",
                        data: function(d) {
                            d.date_filter = $('#date_filter').val();
                            Logger.info('DataTable AJAX Request Data:', d);
                        },
                        error: function(xhr, error, thrown) {
                            Logger.error('DataTable AJAX Error:', { xhr, error, thrown });
                            showToast('Error', 'Failed to fetch machine data', 'error');
                        }
                    },
                    columns: [
                        {
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'machine_details',
                            name: 'name',
                            orderable: true,
                            searchable: true,
                            render: function(data) {
                                return data || 'N/A';
                            }
                        },
                        {
                            data: 'technical_details',
                            name: 'model_number',
                            orderable: true,
                            searchable: true,
                            render: function(data) {
                                return data || 'N/A';
                            }
                        },
                        {
                            data: 'location_details',
                            name: 'branch.branch_name',
                            orderable: true,
                            searchable: true,
                            render: function(data) {
                                return data || 'N/A';
                            }
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: true,
                            searchable: true,
                            render: function(data) {
                                return data || 'N/A';
                            }
                        },
                        {
                            data: 'warranty',
                            name: 'warranty_end_date',
                            orderable: true,
                            searchable: false,
                            render: function(data) {
                                return data || 'N/A';
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    order: [[1, 'asc']],
                    pageLength: 25,
                    responsive: true,
                    scrollY: '700px',
                    scrollX: true,
                    scrollCollapse: true,
                    fixedHeader: true,
                    lengthMenu: [25, 50, 100, 200],
                    autoWidth: false,
                    columnDefs: [{
                            orderable: true,
                        targets: [1, 2, 3, 4], // Make name, technical details, location, and status sortable
                            width: '20px',
                        },
                        {
                            orderable: false,
                            targets: '_all'
                    }],
                    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
                         '<"row"<"col-sm-12"tr>>' +
                         '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                    language: {
                        search: '',
                        searchPlaceholder: 'Search...',
                        sLengthMenu: '_MENU_',
                        info: 'Showing _START_ to _END_ of _TOTAL_ machines',
                        paginate: {
                            first: '<i class="ri-arrow-left-line"></i>',
                            last: '<i class="ri-arrow-right-line"></i>',
                            next: '<i class="ri-arrow-right-s-line"></i>',
                            previous: '<i class="ri-arrow-left-s-line"></i>'
                        },
                        processing: '<div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div>'
                    },
                    initComplete: function() {
                        Logger.info('DataTable Initialization Complete');
                        const api = this.api();
                        const columnUniqueValues = new Map();

                        // Debug Column Data
                        api.columns().every(function(index) {
                            const column = this;
                            const columnData = column.data().unique().toArray();
                            Logger.info(`Column ${index} Unique Values:`, columnData);
                        });

                        // Setup Select2 Filters
                        api.columns().every(function(index) {
                            const column = this;
                            if (!column.data().any() || index === 0 || index === 6) return;

                            Logger.info(`Setting up Select2 filter for column ${index}`);

                            // Cache unique values
                            if (!columnUniqueValues.has(column.index())) {
                                const uniqueValues = [];
                                column.data().unique().sort().each(function(d) {
                                    const cleanValue = $('<div>').html(d).text();
                                    if (cleanValue && !uniqueValues.includes(cleanValue)) {
                                        uniqueValues.push(cleanValue);
                                    }
                                });
                                columnUniqueValues.set(column.index(), uniqueValues);
                                Logger.info(`Column ${index} Unique Values:`, uniqueValues);
                            }

                            const headerText = $(column.header()).text().trim();
                            const uniqueValues = columnUniqueValues.get(column.index());

                            // Create and initialize Select2
                            const selectHtml = $(
                                '<select class="filter-input" multiple="multiple" data-column="' + index + '"></select>'
                            );

                            selectHtml.append(`<option></option>`);

                            const optionsHtml = uniqueValues.map(value =>
                                `<option value="${value}">${value}</option>`
                            ).join('');
                            selectHtml.append(optionsHtml);

                            $(column.header()).empty().append(selectHtml);

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
                            }).on('select2:select select2:unselect', function(e) {
                                Logger.info('Select2 Selection Changed:', {
                                    column: index,
                                    event: e.type,
                                    value: e.params.data
                                });
                            });

                            // Optimize filter change handling
                            let timeout;
                            selectHtml.on('change', function() {
                                clearTimeout(timeout);
                                    const selectedValues = $(this).val();
                                Logger.info(`Column ${index} Filter Changed:`, selectedValues);

                                timeout = setTimeout(() => {
                                    const searchString = selectedValues ?
                                        selectedValues.map(value =>
                                            `^${$.fn.dataTable.util.escapeRegex(value)}$`
                                        ).join('|') :
                                        '';
                                    column.search(searchString, true, false).draw();
                                }, 300);
                            });
                        });

                        // Add date filter
                        if (!$('#date_filter').length) {
                            $('#machines_table_length').append(`
                                <select id="date_filter" class="form-control form-select form-select-sm ms-2">
                                    <option value="all">All</option>
                                    <option value="today">Today</option>
                                    <option value="this_week">This Week</option>
                                    <option value="last_30_days">Last 30 Days</option>
                                    <option value="last_90_days" selected>Last 90 Days</option>
                                    <option value="six_months">Last 180 Days</option>
                                    <option value="this_year">This Year</option>
                                </select>
                            `);

                            $('#date_filter').on('change', debounce(function() {
                                const value = $(this).val();
                                Logger.info('Date Filter Changed:', value);
                                dataTable.draw();
                            }, 300));
                        }

                        // Monitor table updates
                        api.on('draw.dt', function() {
                            Logger.info('DataTable Redrawn');
                            dataTable.columns.adjust();
                            tippy('[data-tippy-content]');
                        });
                    }
                });

                Logger.info('DataTable Setup Complete');
                return dataTable;
            }

            // Initialize DataTable
            let machineTable = setupMachineDataTable();

            // Add CSS for Select2 styling
            $('<style>')
                .text(`
                    .dataTables_scrollHead .select2-container {
                        width: 100% !important;
                        margin-top: 5px;
                    }
                    .filter-input {
                        width: 100%;
                        margin-top: 5px;
                    }
                    .select2-container--default .select2-selection--multiple {
                        border-color: #dee2e6;
                    }
                    .select2-container--default.select2-container--focus .select2-selection--multiple {
                        border-color: #80bdff;
                        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
                    }
                `)
                .appendTo('head');

            Logger.info('JavaScript Initialization Complete');
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
