@props([
    'mode' => 'create', // create or edit
    'part' => null,     // null for create, Part model for edit
])

@php
    $modalId = $mode === 'create' ? 'addPartModal' : 'editPartModal';
    $title = $mode === 'create' ? 'Add New Part' : 'Edit Part';
    $submitText = $mode === 'create' ? 'Create Part' : 'Update Part';
    $formId = $mode === 'create' ? 'addPartForm' : 'editPartForm';
@endphp

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}Label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="{{ $formId }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if($mode === 'edit')
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $part?->id }}">
                    @endif

                    <div class="row g-3">
                        <!-- Basic Information -->
                        <div class="col-md-6">
                            <label class="form-label">Part Code</label>
                            <input type="text" class="form-control" name="part_unique_code" 
                                value="{{ $part?->part_unique_code }}" 
                                {{ $mode === 'edit' ? 'readonly' : '' }}
                                required maxlength="50">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Part Name</label>
                            <input type="text" class="form-control" name="part_name" 
                                value="{{ $part?->part_name }}" required maxlength="100">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <input type="text" class="form-control" name="part_category" 
                                value="{{ $part?->part_category }}" maxlength="50">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Model</label>
                            <input type="text" class="form-control" name="part_model" 
                                value="{{ $part?->part_model }}" maxlength="50">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">HSN Number</label>
                            <input type="text" class="form-control" name="hsn_no" 
                                value="{{ $part?->hsn_no }}" maxlength="20">
                        </div>

                        <!-- Dimensions -->
                        <div class="col-12">
                            <h6 class="mb-3">Dimensions</h6>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Length (mm)</label>
                            <input type="number" class="form-control" name="part_length" 
                                value="{{ $part?->part_length }}" step="0.001">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Width (mm)</label>
                            <input type="number" class="form-control" name="part_width" 
                                value="{{ $part?->part_width }}" step="0.001">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Height (mm)</label>
                            <input type="number" class="form-control" name="part_height" 
                                value="{{ $part?->part_height }}" step="0.001">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Thickness (mm)</label>
                            <input type="number" class="form-control" name="part_thickness" 
                                value="{{ $part?->part_thickness }}" step="0.001">
                        </div>

                        <!-- Material Ratios -->
                        <div class="col-12">
                            <h6 class="mb-3">Material Ratios</h6>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">LD Ratio</label>
                            <input type="number" class="form-control" name="part_ld_ratio" 
                                value="{{ $part?->part_ld_ratio }}" step="0.001">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">LLD Ratio</label>
                            <input type="number" class="form-control" name="part_lld_ratio" 
                                value="{{ $part?->part_lld_ratio }}" step="0.001">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">HD Ratio</label>
                            <input type="number" class="form-control" name="part_hd_ratio" 
                                value="{{ $part?->part_hd_ratio }}" step="0.001">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">RD Ratio</label>
                            <input type="number" class="form-control" name="part_rd_ratio" 
                                value="{{ $part?->part_rd_ratio }}" step="0.001">
                        </div>

                        <!-- Production Details -->
                        <div class="col-12">
                            <h6 class="mb-3">Production Details</h6>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Number of Ups</label>
                            <input type="number" class="form-control" name="no_ups" 
                                value="{{ $part?->no_ups }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sealing Type</label>
                            <input type="text" class="form-control" name="sealing_type" 
                                value="{{ $part?->sealing_type }}" maxlength="50">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Printing Color</label>
                            <input type="text" class="form-control" name="printing_colour" 
                                value="{{ $part?->printing_colour }}" maxlength="50">
                        </div>

                        <!-- Toggle Properties -->
                        <div class="col-12">
                            <h6 class="mb-3">Properties</h6>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bst" 
                                    {{ $part?->bst ? 'checked' : '' }}>
                                <label class="form-check-label">BST</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="plain" 
                                    {{ $part?->plain ? 'checked' : '' }}>
                                <label class="form-check-label">Plain</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="flat" 
                                    {{ $part?->flat ? 'checked' : '' }}>
                                <label class="form-check-label">Flat</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="gazzate" 
                                    {{ $part?->gazzate ? 'checked' : '' }}>
                                <label class="form-check-label">Gazzate</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="bio" 
                                    {{ $part?->bio ? 'checked' : '' }}>
                                <label class="form-check-label">Bio</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="normal" 
                                    {{ $part?->normal ? 'checked' : '' }}>
                                <label class="form-check-label">Normal</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="milky" 
                                    {{ $part?->milky ? 'checked' : '' }}>
                                <label class="form-check-label">Milky</label>
                            </div>
                        </div>

                        <!-- Additional Details -->
                        <div class="col-12">
                            <h6 class="mb-3">Additional Details</h6>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Weight (kg)</label>
                            <input type="number" class="form-control" name="part_weight" 
                                value="{{ $part?->part_weight }}" step="0.001">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Price</label>
                            <input type="number" class="form-control" name="part_price" 
                                value="{{ $part?->part_price }}" step="0.01">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="part_description" rows="3">{{ $part?->part_description }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="active" {{ $part?->status === 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $part?->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="archived" {{ $part?->status === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" name="part_profile_picture" accept="image/*">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            {{ $submitText }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>