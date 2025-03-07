/**
 * Customer Module Enhancements
 * This file contains enhancements for the customer module's user experience
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize enhanced UI components
    initializeUIComponents();

    // Set up DataTable enhancements
    enhanceDataTable();

    // Initialize form state preservation
    initFormStatePreservation();

    // Set up keyboard navigation
    setupKeyboardNavigation();

    // Initialize inline validation
    setupValidation();

    // Setup auto-saving
    setupAutoSave();
});

/**
 * Initialize all modern UI components
 */
function initializeUIComponents() {
    // Initialize searchable selects with TomSelect
    document.querySelectorAll('.ts-select').forEach(select => {
        new TomSelect(select, {
            plugins: ['remove_button', 'clear_button'],
            persist: false,
            createOnBlur: true,
            create: true,
            maxItems: select.hasAttribute('multiple') ? null : 1,
            placeholder: select.getAttribute('placeholder') || 'Select option...',
            onInitialize: function() {
                // Add a fade-in animation
                this.wrapper.classList.add('ts-shown');
            },
            render: {
                option: function(data, escape) {
                    return `<div class="py-2 px-3 d-flex align-items-center">
                        <div>
                            <div class="mb-1 font-weight-medium">${escape(data.text)}</div>
                        </div>
                    </div>`;
                },
                item: function(data, escape) {
                    return `<div class="ts-item">${escape(data.text)}</div>`;
                }
            }
        });
    });

    // Initialize Flatpickr date pickers
    document.querySelectorAll('.date-picker').forEach(element => {
        flatpickr(element, {
            dateFormat: "Y-m-d",
            allowInput: true,
            onOpen: function(selectedDates, dateStr, instance) {
                instance.element.classList.add('focused');
            },
            onClose: function(selectedDates, dateStr, instance) {
                instance.element.classList.remove('focused');
                validateField(instance.element);
            }
        });
    });

            // Initialize year picker with Flatpickr - safely handle plugin availability
            document.querySelectorAll('.year-picker').forEach(element => {
                try {
                    // Define base configuration that works with or without the plugin
                    const config = {
                        dateFormat: "Y",
                        allowInput: true,
                        maxDate: new Date().getFullYear(),
                        minDate: 1900
                    };

                    // Check if Flatpickr is loaded
                    if (typeof flatpickr === 'function') {
                        // Try to use the monthSelectPlugin if available
                        if (window.flatpickr &&
                            window.flatpickr.plugins &&
                            typeof window.flatpickr.plugins.monthSelectPlugin === 'function') {

                            config.plugins = [
                                new window.flatpickr.plugins.monthSelectPlugin({
                                    shorthand: true,
                                    dateFormat: "Y",
                                    altFormat: "Y",
                                    theme: "light"
                                })
                            ];
                        }

                        // Initialize flatpickr with available configuration
                        flatpickr(element, config);

                        console.log("Year picker initialized successfully");
                    } else {
                        console.warn("Flatpickr not available, using standard date input");
                    }
                } catch (error) {
                    console.error("Error initializing year picker:", error);
                    // Fallback to standard HTML date input with year format
                    element.type = "number";
                    element.min = "1900";
                    element.max = new Date().getFullYear().toString();
                    element.placeholder = "Enter year";
                }
            });

    // Initialize Dropzone for file uploads
    if (document.querySelector('.dropzone')) {
        const dropzoneOptions = {
            url: '/customerstore', // Will be overridden in the form submission
            autoProcessQueue: false,
            uploadMultiple: false,
            parallelUploads: 1,
            maxFiles: 1,
            maxFilesize: 5, // MB
            acceptedFiles: 'image/*',
            addRemoveLinks: true,
            thumbnailWidth: 120,
            thumbnailHeight: 120,
            previewTemplate: `
                <div class="dz-preview dz-file-preview">
                    <div class="dz-image">
                        <img data-dz-thumbnail />
                    </div>
                    <div class="dz-details">
                        <div class="dz-filename"><span data-dz-name></span></div>
                        <div class="dz-size"><span data-dz-size></span></div>
                    </div>
                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                    <div class="dz-success-mark"><span>✓</span></div>
                    <div class="dz-error-mark"><span>✗</span></div>
                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                </div>
            `,
            init: function() {
                let dropzone = this;

                this.on("addedfile", function(file) {
                    // Show preview container
                    this.element.closest('.form-group').querySelector('.dropzone-previews').style.display = 'block';

                    // Trigger change for form validation
                    const event = new Event('change', { bubbles: true });
                    this.element.dispatchEvent(event);
                });

                this.on("removedfile", function(file) {
                    // Hide preview container if no files
                    if (this.files.length === 0) {
                        this.element.closest('.form-group').querySelector('.dropzone-previews').style.display = 'none';
                    }

                    // Clear file input
                    const fileInput = this.element.closest('.form-group').querySelector('input[type="file"]');
                    if (fileInput) {
                        fileInput.value = '';
                    }

                    // Trigger change for form validation
                    const event = new Event('change', { bubbles: true });
                    this.element.dispatchEvent(event);
                });

                // If there's already an image (for edit form)
                const previewContainer = this.element.closest('.form-group').querySelector('.existing-file');
                if (previewContainer && previewContainer.getAttribute('data-file')) {
                    const mockFile = {
                        name: previewContainer.getAttribute('data-filename') || 'Existing file',
                        size: 0,
                        type: 'image/jpeg',
                        status: Dropzone.ADDED,
                        accepted: true
                    };

                    this.displayExistingFile(
                        mockFile,
                        previewContainer.getAttribute('data-file')
                    );

                    this.files.push(mockFile);
                    this.element.closest('.form-group').querySelector('.dropzone-previews').style.display = 'block';
                }
            }
        };

        // Initialize all dropzones
        document.querySelectorAll('.dropzone').forEach(el => {
            new Dropzone(el, dropzoneOptions);
        });
    }

    // Initialize card selectors
    document.querySelectorAll('.card-selector').forEach(container => {
        const cards = container.querySelectorAll('.selector-card');
        const hiddenInput = container.querySelector('input[type="hidden"]');

        cards.forEach(card => {
            card.addEventListener('click', function() {
                // Remove active class from all cards
                cards.forEach(c => c.classList.remove('active'));

                // Add active class to clicked card
                this.classList.add('active');

                // Update hidden input
                if (hiddenInput) {
                    hiddenInput.value = this.getAttribute('data-value');

                    // Trigger change event for validation
                    const event = new Event('change', { bubbles: true });
                    hiddenInput.dispatchEvent(event);
                }
            });
        });

        // Set initial active state if value exists
        if (hiddenInput && hiddenInput.value) {
            const activeCard = container.querySelector(`.selector-card[data-value="${hiddenInput.value}"]`);
            if (activeCard) {
                activeCard.classList.add('active');
            }
        }
    });

    // Initialize tooltips
    tippy('[data-tippy-content]', {
        arrow: true,
        animation: 'scale'
    });

    // Initialize address autocomplete
    document.querySelectorAll('.address-autocomplete').forEach(input => {
        const autocomplete = new google.maps.places.Autocomplete(input, {
            types: ['address'],
            fields: ['address_components', 'formatted_address', 'geometry']
        });

        autocomplete.addListener('place_changed', function() {
            const place = autocomplete.getPlace();
            if (!place.geometry) return;

            // Fill in address components
            const addressComponents = {
                street_number: '',
                route: '',
                locality: '',
                administrative_area_level_1: '',
                country: '',
                postal_code: ''
            };

            place.address_components.forEach(component => {
                const type = component.types[0];
                if (addressComponents.hasOwnProperty(type)) {
                    addressComponents[type] = component.long_name;
                }
            });

            // Update related fields
            const form = input.closest('form');
            if (form) {
                if (form.querySelector('[name="city"]')) {
                    form.querySelector('[name="city"]').value = addressComponents.locality;
                }
                if (form.querySelector('[name="state"]')) {
                    form.querySelector('[name="state"]').value = addressComponents.administrative_area_level_1;
                }
                if (form.querySelector('[name="country"]')) {
                    form.querySelector('[name="country"]').value = addressComponents.country;
                }
                if (form.querySelector('[name="zipcode"]')) {
                    form.querySelector('[name="zipcode"]').value = addressComponents.postal_code;
                }

                // Trigger validation on updated fields
                form.querySelectorAll('.address-field').forEach(field => {
                    validateField(field);
                });
            }
        });
    });
}

/**
 * Enhance the DataTable with multi-column sorting and other features
 */
function enhanceDataTable() {
    const dataTable = $('#customer-datatable').DataTable();
    if (!dataTable) return;

    // Add column visibility toggle
    new $.fn.dataTable.Buttons(dataTable, {
        buttons: [
            {
                extend: 'colvis',
                text: '<i class="fe fe-eye"></i> Columns',
                className: 'btn btn-sm btn-primary'
            }
        ]
    });

    dataTable.buttons().container()
        .appendTo('#customer-datatable_wrapper .col-md-6:eq(0)');

    // Add multi-column sort instructions
    $('<div class="sort-instructions mt-2 mb-3">' +
        '<i class="fe fe-info"></i> ' +
        '<small>Hold <kbd>Shift</kbd> and click column headers for multi-column sorting</small>' +
        '</div>'
    ).insertBefore('#customer-datatable');

    // Add sort order indicators
    const addSortOrderIndicators = function() {
        const order = dataTable.order();

        // Remove existing indicators
        $('.sort-order-indicator').remove();

        // Add sort order indicators to column headers
        for (let i = 0; i < order.length; i++) {
            const columnIdx = order[i][0];
            const direction = order[i][1];

            const header = $(dataTable.column(columnIdx).header());
            const indicator = $('<span class="sort-order-indicator">' + (i + 1) + '</span>');

            if (direction === 'asc') {
                indicator.addClass('sort-asc');
            } else {
                indicator.addClass('sort-desc');
            }

            header.append(indicator);
        }
    };

    // Update indicators when sorting changes
    dataTable.on('order.dt', addSortOrderIndicators);
    addSortOrderIndicators();

    // Add row selection
    $('#customer-datatable tbody').on('click', 'tr', function() {
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');
        } else {
            dataTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
}

/**
 * Set up keyboard navigation for the DataTable
 */
function setupKeyboardNavigation() {
    if (!$('#customer-datatable').length) return;

    const dataTable = $('#customer-datatable').DataTable();
    let selectedRow = -1;

    // Update visual selection
    const updateSelection = function() {
        const rows = dataTable.rows().nodes();
        $(rows).removeClass('kbd-selected');

        if (selectedRow >= 0 && selectedRow < rows.length) {
            $(rows[selectedRow]).addClass('kbd-selected');

            // Scroll to selection if needed
            const $row = $(rows[selectedRow]);
            const $container = $('#customer-datatable').closest('.dataTables_wrapper');

            const rowTop = $row.position().top;
            const rowBottom = rowTop + $row.height();
            const containerTop = 0;
            const containerBottom = $container.height();

            if (rowTop < containerTop) {
                $container.scrollTop($container.scrollTop() + rowTop - 50);
            } else if (rowBottom > containerBottom) {
                $container.scrollTop($container.scrollTop() + rowBottom - containerBottom + 50);
            }
        }
    };

    // Handle keyboard events
    $(document).on('keydown', function(e) {
        // Only handle if DataTable is in view
        if (!$('#customer-datatable').is(':visible')) return;

        const rows = dataTable.rows().nodes();

        // Arrow Up (select previous row)
        if (e.key === 'ArrowUp' && !e.ctrlKey && !e.shiftKey) {
            e.preventDefault();
            selectedRow = Math.max(0, selectedRow - 1);
            updateSelection();
        }

        // Arrow Down (select next row)
        else if (e.key === 'ArrowDown' && !e.ctrlKey && !e.shiftKey) {
            e.preventDefault();
            selectedRow = Math.min(rows.length - 1, selectedRow + 1);
            if (selectedRow === -1) selectedRow = 0; // Initialize if not set
            updateSelection();
        }

        // Enter key (view selected row)
        else if (e.key === 'Enter' && selectedRow >= 0) {
            e.preventDefault();
            const row = dataTable.row(selectedRow);
            const rowData = row.data();

            // Assuming the view button is the last column
            const viewBtn = $(rows[selectedRow]).find('.viewdetailbtn');
            if (viewBtn.length) {
                viewBtn.trigger('click');
            }
        }

        // Ctrl+E (edit selected row)
        else if (e.key === 'e' && e.ctrlKey && selectedRow >= 0) {
            e.preventDefault();
            const editBtn = $(rows[selectedRow]).find('.editbtn');
            if (editBtn.length) {
                editBtn.trigger('click');
            }
        }

        // Search (jump to search box)
        else if (e.key === '/' && !e.ctrlKey && !e.shiftKey) {
            e.preventDefault();
            dataTable.search('').draw();
            $('#customer-datatable_filter input').focus();
        }
    });

    // Show keyboard shortcut help
    $('<div class="keyboard-shortcuts mt-3 mb-3">' +
        '<h6><i class="fe fe-command"></i> Keyboard Shortcuts</h6>' +
        '<div class="shortcuts-list small">' +
            '<div><kbd>↑</kbd> / <kbd>↓</kbd> Navigate rows</div>' +
            '<div><kbd>Enter</kbd> View selected customer</div>' +
            '<div><kbd>Ctrl</kbd> + <kbd>E</kbd> Edit selected customer</div>' +
            '<div><kbd>/</kbd> Focus search box</div>' +
        '</div>' +
    '</div>').insertBefore('#customer-datatable');
}

/**
 * Initialize form state preservation to prevent data loss
 */
function initFormStatePreservation() {
    const addForm = document.getElementById('addform');
    const editForm = document.getElementById('editform');

    if (addForm) {
        // Check if there is saved data
        const savedState = loadFormState('customer_add_form');
        if (savedState) {
            // Restore form data
            Object.keys(savedState).forEach(key => {
                const field = addForm.elements[key];
                if (field) {
                    if (field.type === 'checkbox' || field.type === 'radio') {
                        field.checked = savedState[key] === true;
                    } else {
                        field.value = savedState[key];
                    }

                    // Handle TomSelect fields
                    if (field.classList.contains('ts-select')) {
                        const tomSelect = field.tomselect;
                        if (tomSelect) {
                            tomSelect.setValue(savedState[key], true);
                        }
                    }

                    // Handle card selectors
                    if (key === 'company_size') {
                        const card = document.querySelector(`.selector-card[data-value="${savedState[key]}"]`);
                        if (card) {
                            card.click();
                        }
                    }
                }
            });

            // Show notification about restored data
            Swal.fire({
                title: 'Form Data Restored',
                text: 'Your previously entered data has been restored.',
                icon: 'info',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
        }

        // Save form state when input changes
        addForm.addEventListener('input', debounce(function() {
            saveFormState(addForm, 'customer_add_form');
        }, 500));

        // Clear saved state on successful submission
        addForm.addEventListener('submit', function() {
            localStorage.removeItem('customer_add_form');
        });
    }

    if (editForm) {
        // Save form state when input changes
        editForm.addEventListener('input', debounce(function() {
            saveFormState(editForm, 'customer_edit_form');
        }, 500));

        // Clear saved state on successful submission
        editForm.addEventListener('submit', function() {
            localStorage.removeItem('customer_edit_form');
        });
    }

    // Restore edit form data from server on edit form shown
    $('#editCustomerModal').on('shown.bs.modal', function() {
        const customerId = document.getElementById('edit_id').value;

        // Fetch saved form state from server
        fetch(`/customerformstate?id=${customerId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    const formData = data.data;

                    // Show notification about server-saved data
                    Swal.fire({
                        title: 'Auto-saved Data Available',
                        text: 'There is auto-saved data from your previous session.',
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonText: 'Restore Data',
                        cancelButtonText: 'Ignore'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Restore form fields
                            Object.keys(formData).forEach(key => {
                                const field = editForm.elements[key];
                                if (field) {
                                    if (field.type === 'checkbox' || field.type === 'radio') {
                                        field.checked = formData[key] === true;
                                    } else {
                                        field.value = formData[key];
                                    }

                                    // Update TomSelect
                                    if (field.classList.contains('ts-select')) {
                                        const tomSelect = field.tomselect;
                                        if (tomSelect) {
                                            tomSelect.setValue(formData[key], true);
                                        }
                                    }

                                    // Trigger change event for validation
                                    const event = new Event('change', { bubbles: true });
                                    field.dispatchEvent(event);
                                }
                            });
                        }
                    });
                }
            })
            .catch(error => console.error('Error fetching form state:', error));
    });
}

/**
 * Save form state to localStorage
 */
function saveFormState(form, storageKey) {
    if (!form) return;

    const formData = {};

    Array.from(form.elements).forEach(field => {
        if (field.name && field.name !== '') {
            if (field.type === 'checkbox' || field.type === 'radio') {
                formData[field.name] = field.checked;
            } else if (field.type !== 'button' && field.type !== 'submit') {
                formData[field.name] = field.value;
            }
        }
    });

    localStorage.setItem(storageKey, JSON.stringify(formData));
}

/**
 * Load form state from localStorage
 */
function loadFormState(storageKey) {
    const savedState = localStorage.getItem(storageKey);
    return savedState ? JSON.parse(savedState) : null;
}

/**
 * Set up inline validation for form fields
 */
function setupValidation() {
    const forms = document.querySelectorAll('form.needs-validation');

    forms.forEach(form => {
        // Add validation feedback on input
        form.querySelectorAll('input, select, textarea').forEach(field => {
            field.addEventListener('input', function() {
                validateField(this);
            });

            field.addEventListener('blur', function() {
                validateField(this);
            });
        });

        // Handle form submission
        form.addEventListener('submit', function(event) {
            if (!validateForm(form)) {
                event.preventDefault();
                event.stopPropagation();

                // Scroll to first invalid field
                const firstInvalid = form.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }

                // Show validation message
                Swal.fire({
                    title: 'Validation Error',
                    text: 'Please check the form for errors and try again.',
                    icon: 'error',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
            } else {
                // Show loading indicator during form submission
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...';
                    submitBtn.disabled = true;

                    // Automatically restore button after 10 seconds (failsafe)
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 10000);
                }

                // Clear form state on successful submission
                localStorage.removeItem('customer_add_form');
                localStorage.removeItem('customer_edit_form');
            }
        });
    });
}

/**
 * Validate a single form field
 */
function validateField(field) {
    let isValid = true;
    let errorMessage = '';

    // Check required
    if (field.required && field.value.trim() === '') {
        isValid = false;
        errorMessage = 'This field is required';
    }

    // Check email format
    if (field.type === 'email' && field.value.trim() !== '') {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(field.value.trim())) {
            isValid = false;
            errorMessage = 'Please enter a valid email address';
        }
    }

    // Check phone format
    if (field.classList.contains('phone-input') && field.value.trim() !== '') {
        const phoneRegex = /^[+]?[\d\s()-]{7,15}$/;
        if (!phoneRegex.test(field.value.trim())) {
            isValid = false;
            errorMessage = 'Please enter a valid phone number';
        }
    }

    // Check GST number format (for India)
    if (field.name === 'gst_number' && field.value.trim() !== '') {
        const gstRegex = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/;
        if (!gstRegex.test(field.value.trim())) {
            isValid = false;
            errorMessage = 'Please enter a valid GST number (e.g., 29AABCT1332L1Z7)';
        }
    }

    // Update field status
    if (isValid) {
        field.classList.remove('is-invalid');
        field.classList.add('is-valid');

        // Clear error message
        const errorElement = field.parentNode.querySelector('.invalid-feedback');
        if (errorElement) {
            errorElement.textContent = '';
        }
    } else {
        field.classList.remove('is-valid');
        field.classList.add('is-invalid');

        // Set error message
        let errorElement = field.parentNode.querySelector('.invalid-feedback');
        if (!errorElement) {
            errorElement = document.createElement('div');
            errorElement.className = 'invalid-feedback';
            field.parentNode.appendChild(errorElement);
        }
        errorElement.textContent = errorMessage;
    }

    return isValid;
}

/**
 * Validate an entire form
 */
function validateForm(form) {
    let isValid = true;

    // Validate all fields
    form.querySelectorAll('input, select, textarea').forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });

    return isValid;
}

/**
 * Set up auto-saving for text fields like notes
 */
function setupAutoSave() {
    const autoSaveFields = document.querySelectorAll('.auto-save');

    autoSaveFields.forEach(field => {
        field.addEventListener('input', debounce(function() {
            if (field.value.trim() === '') return;

            // Get form data for the field
            const data = {
                id: document.getElementById('edit_id')?.value,
                field_name: field.name,
                field_value: field.value
            };

            // Show auto-save indicator
            const saveIndicator = document.createElement('span');
            saveIndicator.className = 'auto-save-indicator';
            saveIndicator.innerHTML = '<i class="fe fe-refresh-cw spin"></i> Saving...';

            // Position indicator next to the field
            field.parentNode.style.position = 'relative';
            field.parentNode.appendChild(saveIndicator);

            // Send auto-save request
            fetch('/customerautosave', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update save indicator
                    saveIndicator.innerHTML = '<i class="fe fe-check text-success"></i> Saved';

                    // Remove indicator after a delay
                    setTimeout(() => {
                        saveIndicator.remove();
                    }, 2000);
                } else {
                    // Show error
                    saveIndicator.innerHTML = '<i class="fe fe-alert-triangle text-danger"></i> Failed to save';

                    // Remove indicator after a delay
                    setTimeout(() => {
                        saveIndicator.remove();
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Auto-save error:', error);
                saveIndicator.innerHTML = '<i class="fe fe-alert-triangle text-danger"></i> Error saving';

                // Remove indicator after a delay
                setTimeout(() => {
                    saveIndicator.remove();
                }, 3000);
            });
        }, 1000));
    });
}

/**
 * Debounce function to limit how often a function can be called
 */
function debounce(func, wait, immediate) {
    let timeout;
    return function() {
        const context = this, args = arguments;
        const later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

// Add custom styles for enhanced UI
const enhancementStyles = `
    /* TomSelect enhancements */
    .ts-wrapper {
        transition: all 0.3s;
        opacity: 0;
    }
    .ts-shown {
        opacity: 1;
    }
    .ts-control {
        border-radius: 0.25rem;
        box-shadow: none !important;
    }
    .ts-dropdown {
        border-radius: 0.25rem;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        animation: fadeInUp 0.2s;
    }

    /* Card selectors */
    .card-selector {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    .selector-card {
        flex: 1 0 calc(33.333% - 1rem);
        min-width: 120px;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .selector-card:hover {
        border-color: #6c757d;
        background-color: #f8f9fa;
    }
    .selector-card.active {
        border-color: #5066e1;
        background-color: rgba(80, 102, 225, 0.1);
        box-shadow: 0 2px 5px rgba(80, 102, 225, 0.2);
    }
    .selector-card .card-icon {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: #5066e1;
    }

    /* Dropzone enhancements */
    .dropzone {
        border: 2px dashed #dee2e6;
        border-radius: 0.25rem;
        background: white;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s;
        min-height: auto;
    }
    .dropzone:hover, .dropzone.dz-drag-hover {
        border-color: #5066e1;
        background-color: rgba(80, 102, 225, 0.05);
    }
    .dropzone-previews {
        display: none;
        margin-top: 1rem;
    }
    .dz-preview {
        margin: 0.5rem !important;
    }
    .dz-image {
        border-radius: 0.25rem !important;
        overflow: hidden;
    }
    .dz-progress {
        height: 5px !important;
    }

    /* Keyboard navigation */
    tr.kbd-selected {
        background-color: rgba(80, 102, 225, 0.15) !important;
        outline: 2px solid #5066e1;
    }
    .keyboard-shortcuts {
        background-color: #f8f9fa;
        border-radius: 0.25rem;
        padding: 0.75rem;
        border-left: 3px solid #5066e1;
    }
    .shortcuts-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
    kbd {
        background-color: #eee;
        border-radius: 3px;
        border: 1px solid #b4b4b4;
        box-shadow: 0 1px 1px rgba(0,0,0,.2), 0 2px 0 0 rgba(255,255,255,.7) inset;
        color: #333;
        display: inline-block;
        font-size: 0.75rem;
        font-weight: 500;
        line-height: 1;
        padding: 0.2rem 0.4rem;
        white-space: nowrap;
    }

    /* Sort indicators */
    .sort-order-indicator {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #5066e1;
        color: white;
        font-size: 10px;
        margin-left: 5px;
        position: relative;
    }
    .sort-order-indicator.sort-asc::after {
        content: "↑";
        font-size: 8px;
        position: absolute;
        top: 9px;
        right: -3px;
    }
    .sort-order-indicator.sort-desc::after {
        content: "↓";
        font-size: 8px;
        position: absolute;
        top: 9px;
        right: -3px;
    }
    .sort-instructions {
        color: #6c757d;
        background-color: #f8f9fa;
        border-radius: 0.25rem;
        padding: 0.5rem;
    }

    /* Auto-save indicator */
    .auto-save-indicator {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        color: #6c757d;
        background: rgba(255,255,255,0.9);
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        z-index: 1;
    }
    .spin {
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Fade-in animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 10px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }
`;

// Add styles to page
const styleElement = document.createElement('style');
styleElement.textContent = enhancementStyles;
document.head.appendChild(styleElement);
