// Parts DataTable Management
$(document).ready(function() {
    // Initialize Select2 for all select2 elements
    $('.select2').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });

    $('.select2-multiple').select2({
        theme: 'bootstrap-5',
        width: '100%',
        tags: true,
        tokenSeparators: [','],
        placeholder: 'Select or type to add'
    });

    // Initialize DataTable with enhanced features
    const dataTable = $('#data_fetch_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/parts/fetch',
            type: 'POST',
            data: function(d) {
                d._token = $('meta[name="csrf-token"]').attr('content');
                // Add additional filters
                d.status = $('#status_filter').val();
                d.customer = $('#customer_filter').val();
                d.branch = $('#branch_filter').val();
            }
        },
        columns: [
            { data: 'part_unique_code', name: 'part_unique_code' },
            { data: 'part_name', name: 'part_name' },
            {
                data: 'customers',
                name: 'customers',
                render: function(data) {
                    return data.map(c => c.customer_name).join(', ');
                }
            },
            {
                data: 'branches',
                name: 'branches',
                render: function(data) {
                    return data.map(b => b.branch_name).join(', ');
                }
            },
            {
                data: 'part_status',
                name: 'part_status',
                render: function(data) {
                    const statusClasses = {
                        'active': 'success',
                        'inactive': 'danger',
                        'development': 'warning'
                    };
                    return `<span class="badge bg-${statusClasses[data] || 'secondary'}">${data}</span>`;
                }
            },
            {
                data: 'part_tags',
                name: 'part_tags',
                render: function(data) {
                    if (!data) return '';
                    return data.split(',').map(tag =>
                        `<span class="badge bg-info me-1">${tag.trim()}</span>`
                    ).join('');
                }
            },
            {
                data: null,
                orderable: false,
                render: function(data) {
                    return `
                        <div class="btn-group">
                            <button class="btn btn-sm btn-primary EditPartIcon" id="${data.id}">
                                <i class="ri-pencil-line"></i>
                            </button>
                            <button class="btn btn-sm btn-danger DeletePartIcon" id="${data.id}">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </div>
                    `;
                }
            }
        ],
        order: [[0, 'desc']],
        pageLength: 25,
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        initComplete: function() {
            // Add individual column searching
            this.api().columns().every(function() {
                let column = this;
                let title = $(column.header()).text();

                // Create input element
                let input = $('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />')
                    .appendTo($(column.header()))
                    .on('keyup change', function() {
                        if (column.search() !== this.value) {
                            column.search(this.value).draw();
                        }
                    });
            });
        }
    });

    // Handle form submission
    $('#add_part_data_form').on('submit', async function(e) {
        e.preventDefault();
        const form = $(this);
        const btn = $('#add_part_data_btn');
        const formData = new FormData(this);

        try {
            btn.prop('disabled', true)
               .find('span').text('Processing...');
            btn.find('.btn-loader').removeClass('d-none');

            const response = await $.ajax({
                url: '/parts/store',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false
            });

            form[0].reset();
            $('.select2-multiple').val(null).trigger('change');
            $('#addPartDataModal').modal('hide');
            dataTable.ajax.reload();

            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Part created successfully',
                timer: 2000,
                showConfirmButton: false
            });
        } catch (error) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.responseText || 'Failed to create part',
                timer: 3000,
                showConfirmButton: true
            });
        } finally {
            btn.prop('disabled', false)
               .find('span').text('Create Part');
            btn.find('.btn-loader').addClass('d-none');
        }
    });
});
