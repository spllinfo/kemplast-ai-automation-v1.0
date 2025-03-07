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
                    <div id="show_all_fetched_data"
                         class="table-responsive">

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

                            <!-- Machine Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="machine-name"
                                       class="form-label">Machine Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="machine_name"
                                       placeholder="Enter Machine Name">
                            </div>
                            <!-- Machine Type -->
                            <div class="col-md-6 col-lg-4">
                                <label for="machine-type"
                                       class="form-label">Machine Type</label>
                                <input type="text"
                                       class="form-control"
                                       name="machine_type"
                                       placeholder="Enter Machine Type">
                            </div>
                            <!-- Machine Capacity -->
                            <div class="col-md-6 col-lg-4">
                                <label for="machine-capacity"
                                       class="form-label">Machine Capacity</label>
                                <input type="number"
                                       class="form-control"
                                       name="machine_capacity"
                                       placeholder="Enter Machine Capacity">
                            </div>
                            <!-- Branch Assignment -->
                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Branch</label>
                                <select class="form-control"
                                        name="branch_id">
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
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
                        <input type="hidden"
                               name="machine_id"
                               id="machine_id">
                        <div class="row gy-3">
                            <!-- Machine Logo Section -->
                            <div class="col-md-6 col-lg-4">
                                <div class="mb-0 text-center">
                                    <span class="avatar avatar-xxl avatar-rounded bg-light p-2">
                                        <img src="{{ asset('assets/images/company-logos/1.png') }}"
                                             alt="Machine Logo"
                                             id="edit_machine_logo">
                                        <span class="badge rounded-pill bg-primary avatar-badge">
                                            <input type="file"
                                                   name="machine_profile_picture"
                                                   class="position-absolute w-100 h-100 op-0"
                                                   id="">
                                            <i class="fe fe-camera"></i>
                                        </span>
                                    </span>
                                </div>
                            </div>

                            <!-- Machine Name -->
                            <div class="col-md-12 col-lg-8">
                                <label for="machine_name"
                                       class="form-label">Machine Name</label>
                                <input type="text"
                                       class="form-control"
                                       name="machine_name"
                                       id="machine_name"
                                       value=""
                                       placeholder="Enter Machine Name">
                            </div>
                            <!-- Machine Type -->
                            <div class="col-md-6 col-lg-4">
                                <label for="machine_type"
                                       class="form-label">Machine Type</label>
                                <input type="text"
                                       class="form-control"
                                       name="machine_type"
                                       id="machine_type"
                                       value=""
                                       placeholder="Enter Machine Type">
                            </div>
                            <!-- Machine Capacity -->
                            <div class="col-md-6 col-lg-4">
                                <label for="machine_capacity"
                                       class="form-label">Machine Capacity</label>
                                <input type="number"
                                       class="form-control"
                                       name="machine_capacity"
                                       id="machine_capacity"
                                       value=""
                                       placeholder="Enter Machine Capacity">
                            </div>
                            <!-- Branch Assignment -->
                            <div class="col-md-6 col-lg-4">
                                <label class="form-label">Branch</label>
                                <select class="form-control"
                                        name="branch_id"
                                        id="machine_branch_id">
                                    <option value="">Select Branch</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->branch_name }}</option>
                                    @endforeach
                                </select>
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
        </div>
        <div class="offcanvas-body p-0">
            <div class="d-sm-flex align-items-top border-bottom border-block-end-dashed main-profile-cover p-3">
                <span class="avatar avatar-xxl avatar-rounded bg-primary-transparent me-3 p-2">
                    <img src="{{ asset('assets/images/company-logos/1.png') }}"
                         id="view_machine_logo"
                         alt="Machine Logo">
                </span>
                <div class="flex-fill main-profile-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <h6 class="fw-medium mb-1"
                            id="view_machine_name"></h6>
                        <button type="button"
                                class="btn-close crm-contact-close-btn"
                                data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                    </div>
                    <p class="text-muted fs-12 mb-2"
                       id="view_machine_type">
                        <span class="badge bg-primary1-transparent"
                              id="view_machine_capacity"></span>
                    </p>
                </div>
            </div>


            <div class="border-bottom border-block-end-dashed d-flex align-items-center gap-3 p-3">
                <div class="fs-14 fw-medium">Branch:</div>
                <div id="view_machine_branch"></div>
            </div>
        </div>
    </div>
    <!-- End:: Machine Details Offcanvas -->

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

            // Handle form submission with AJAX for machines
            async function submitMachineForm(formSelector, buttonSelector, url, successMessage, modalSelector =
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
                    machineDataFetchAll();
                    showToast(successMessage, 'success');
                    if (modalSelector) $(modalSelector).modal('hide');
                } catch (error) {
                    console.error('Error submitting form:', error);
                    showToast('Error!', 'An error occurred.', 'error');
                } finally {
                    $(buttonSelector).attr('disabled', false).text('Submit');
                }
            }

            // Bind events for adding and editing machine data
            $('#add_machine_data_form').on('submit', function(e) {
                e.preventDefault();
                submitMachineForm('#add_machine_data_form', '#add_machine_data_btn',
                    '{{ route('machinestore') }}',
                    'New Machine added successfully!', '#addMachineDataModal');
            });

            $('#edit_machine_data_form').on('submit', function(e) {
                e.preventDefault();
                submitMachineForm('#edit_machine_data_form', '#edit_machine_data_btn',
                    '{{ route('machineupdate') }}',
                    'Machine updated successfully!', '#editMachineDataModal');
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
                    $("#machine_name").val(response.machine_name);
                    $("#machine_type").val(response.machine_type);
                    $("#machine_capacity").val(response.machine_capacity);
                    $("#machine_branch_id").val(response.branch_id);


                    $('#editMachineDataModal').modal('show');
                } catch (error) {
                    console.error('Error fetching Machines:', error);
                }
            });

            // View Machine Data Modal Population
            $(document).on('click', '.ViewDataIcon', async function() {
                const id = $(this).data('id');

                try {
                    const response = await $.ajax({
                        url: `{{ route('machineview') }}?id=${id}`,
                        method: 'GET',
                    });

                    $('#view_machine_name').text(response.machine_name);
                    $('#view_machine_type').text('Type: ' + response.machine_type);
                    $('#view_machine_capacity').text('Capacity: ' + response.machine_capacity);
                    $('#view_machine_branch').text(response.branch ? response.branch.branch_name :
                        'N/A');


                    // Machine Logo
                    const logoUrl = response.machine_profile_picture ?
                        `${response.machine_profile_picture}` :
                        `{{ asset('assets/images/company-logos/1.png') }}`;
                    $('#view_machine_logo').attr('src', logoUrl);


                    $('#viewMachineDataModal').offcanvas('show');
                } catch (error) {
                    console.error('Error fetching machine details:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Failed to load machine details.',
                        timer: 3000,
                        showConfirmButton: false
                    });
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

                    $('#show_all_fetched_data').html(response);
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
                                await machineDataFetchAll(dateFilter);
                            }, 300));
                            $('#date_filter').val(machineDateFilterValue);
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
            machineDataFetchAll(machineDateFilterValue);
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
