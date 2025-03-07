@extends('layouts.app')

@section('content')



    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
        <div>
            <nav>
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Parts Settings</li>
                </ol>
            </nav>
            <h1 class="page-title fw-medium fs-18 mb-0">Part Items</h1>
        </div>
        <div class="btn-list">
            <button type="button" class="modal-effect btn btn-white btn-wave" data-bs-effect="effect-slide-in-right" data-bs-toggle="modal"
            data-bs-target="#addDataModal">
        <i class="ri-file-add-line align-middle me-1 lh-1"></i> New
    </button>          
            <button class="btn btn-primary3 btn-wave me-0">
                <i class="ri-download-2-line me-1"></i> Import
            </button>
            <button class="btn btn-primary btn-wave me-0">
                <i class="ri-share-forward-line me-1"></i> Export
            </button>
           
        </div>
    </div>
    <!-- Page Header Close -->



{{-- Start modal --}}
<div class="modal fade" id="editDataModal" tabindex="-1"
aria-labelledby="editDataModalLabel" style="display: none;" data-bs-keyboard="false" aria-hidden="true">
<div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h6 class="modal-title" id="editDataModalLabel">Add Part Item</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal"
                aria-label="Close"></button>
        </div>
        <div class="modal-body">
              <!-- Start::row-1 -->
              <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body add-products">
                            <div class="row gx-4">
                                <div class="col-xxl-6 col-xl-12 col-lg-12 col-md-6">
                                    <div class="card custom-card shadow-none mb-0 border-0">
                                        <div class="card-body p-0">
                                            <div class="row gy-3">
                                                <div class="col-xl-12">
                                                    <label for="product-name-add" class="form-label">Part Name</label>
                                                    <input type="text" class="form-control" id="product-name-add" placeholder="Name" value="LD Plain Bags 10x12"> 
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-brand-add" class="form-label">Customer Code</label>
                                                    <select class="form-control" data-trigger name="product-brand-add" id="product-brand-add">
                                                        <option value="">Select</option>
                                                        <option value="C021224 - TVS Motors">C021224 - TVS Motors</option>
                                                        <option value="C032645 - Yamaha Engines">C032645 - Yamaha Engines</option>
                                                        <option value="C045678 - Puma" selected>C045678 - Puma</option>
                                                        <option value="C045678 - Puma">C045678 - Puma</option>
                                                        <option value="C054321 - Spykar">C054321 - Spykar</option>
                                                        <option value="C067890 - Mufti">C067890 - Mufti</option>
                                                        <option value="C078902 - Home Town">C078902 - Home Town</option>
                                                        <option value="C089123 - Arrabi">C089123 - Arrabi</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-category-add" class="form-label">Category</label>
                                                    <select class="form-control" data-trigger name="product-category-add" id="product-category-add">
                                                        <option value="">Category</option>
                                                        <option value="Garbage Bags">Garbage Bags</option>
                                                        <option value="LD Plain Bags 10x12s">LD Plain Bags 10x12s</option>
                                                        <option value="LD Plain Bags 10x12s" selected>LD Plain Bags 10x12s</option>
                                                        <option value="Food Packaging">Food Packaging</option>
                                                        <option value="Industrial Packaging">Industrial Packaging</option>
                                                        <option value="Agricultural Bags">Agricultural Bags</option>
                                                        <option value="Gusseted Bags">Gusseted Bags</option>
                                                        <option value="Zip Lock Bags">Zip Lock Bags</option>
                                                        <option value="Biodegradable Bags">Biodegradable Bags</option>
                                                        <option value="HDPE Bags">HDPE Bags</option>
                                                        <option value="LDPE Bags">LDPE Bags</option>
                                                        <option value="Plastic Rolls">Plastic Rolls</option>
                                                        <option value="Courier Bags">Courier Bags</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-type" class="form-label">Part Type</label>
                                                    <input type="text" class="form-control" id="product-type" placeholder="Type" value="LD Plain Bags 10x12"> 
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="product-hsn-add" class="form-label">HSN No</label>
                                                    <input type="text" class="form-control" id="product-hsn-add" placeholder="Name" value="3923">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="product-thickness-add" class="form-label">Reel Size</label>
                                                    <input type="text" class="form-control" id="product-thickness-add" placeholder="Reel Size" value="60x80 cm">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="product-size-add" class="form-label">Length</label>
                                                    <input type="text" class="form-control" id="product-size-add" placeholder="Length" value="50 cm">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="product-size-add" class="form-label">Width</label>
                                                    <input type="text" class="form-control" id="product-size-add" placeholder="Width" value="40 cm">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="product-size-add" class="form-label">Height</label>
                                                    <input type="text" class="form-control" id="product-size-add" placeholder="Height" value="30 cm">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="product-thickness-add" class="form-label">Thickness</label>
                                                    <input type="text" class="form-control" id="product-thickness-add" placeholder="Thickness" value="0.5 mm">
                                                </div>
                                               
                                                <div class="col-xl-3">
                                                    <label for="material-ld-ratio" class="form-label">LD Ratio (%)</label>
                                                    <input type="text" class="form-control" id="material-ld-ratio" placeholder="Enter LD Mixing Ratio" value="45">
                                                </div>
                                                
                                                <div class="col-xl-3">
                                                    <label for="material-lld-ratio" class="form-label">LLD Ratio (%)</label>
                                                    <input type="text" class="form-control" id="material-lld-ratio" placeholder="Enter LLD Mixing Ratio" value="35">
                                                </div>
                                                
                                                <div class="col-xl-3">
                                                    <label for="material-hd-ratio" class="form-label">HD Ratio (%)</label>
                                                    <input type="text" class="form-control" id="material-hd-ratio" placeholder="Enter HD Mixing Ratio" value="20">
                                                </div>
                                                <div class="col-xl-3">
                                                    <label for="material-hd-ratio" class="form-label">RD Ratio (%)</label>
                                                    <input type="text" class="form-control" id="material-hd-ratio" placeholder="Enter RD Mixing Ratio" value="10">
                                                </div>

                                               
                                               
                                              
                                               
                                                <div class="col-xl-6">
                                                    <label for="product-discount" class="form-label">Item Weight</label>
                                                    <input type="text" class="form-control" id="product-discount1" placeholder="Weight in gms" value="500">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-gender-add" class="form-label">Sealing Type</label>
                                                    <select class="form-control" data-trigger name="product-gender-add" id="product-gender-add">
                                                        <option value="">Select</option>
                                                        <option value="Side Seal" selected>Side Seal</option>
                                                        <option value="Bottom Seal">Bottom Seal</option>
                                                        <option value="Center Seal">Center Seal</option>
                                                    </select>
                                                </div>
                                                
                                                
                                                <div class="col-xl-6">
                                                    <label for="product-gender-add" class="form-label">Printing</label>
                                                    <select class="form-control" data-trigger name="product-gender-add" id="product-gender-add">
                                                        <option value="">Select</option>
                                                        <option value="Yes" selected>Yes</option>
                                                        <option value="No">No</option>                                                      
                                                    </select>
                                                </div>
                                                <div class="col-xl-6 color-selection">
                                                    <label for="product-color-add" class="form-label">Printing Colors</label>
                                                    <select class="form-control" name="product-color-add" id="product-color-add2" multiple>
                                                        <option value="White" selected>White</option>
                                                        <option value="Black" selected>Black</option>
                                                        <option value="Red">Red</option>
                                                        <option value="Orange">Orange</option>
                                                        <option value="Yellow">Yellow</option>
                                                        <option value="Green">Green</option>
                                                        <option value="Blue">Blue</option>
                                                        <option value="Pink">Pink</option>
                                                        <option value="Purple">Purple</option>
                                                    </select>
                                                </div>
                                              
                                             
                                                <div class="col-xl-6">
                                                    <label for="product-status-add1" class="form-label">Availability</label>
                                                    <select class="form-control" data-trigger name="product-status-add1" id="product-status-add1">
                                                        <option value="">Select</option>
                                                        <option value="In Stock" selected>In Stock</option>
                                                        <option value="Out Of Stock">Out Of Stock</option>
                                                    </select>
                                                </div>

                                                <div class="col-xl-6">
                                                    <label for="product-thickness-add" class="form-label">Bundle Qty</label>
                                                    <input type="text" class="form-control" id="product-thickness-add" placeholder="Name" value="100">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-actual-price" class="form-label">Actual Price</label>
                                                    <input type="text" class="form-control" id="product-actual-price" placeholder="Actual Price" value="150.00">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-dealer-price" class="form-label">Dealer Price</label>
                                                    <input type="text" class="form-control" id="product-dealer-price" placeholder="Dealer Price" value="120.00">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="product-discount" class="form-label">Discount</label>
                                                    <input type="text" class="form-control" id="product-discount" placeholder="Discount in %"  value="10">
                                                </div>
                                                {{-- <div class="col-xl-6">
                                                    <label for="publish-date" class="form-label">Publish Date</label>
                                                    <input type="text" class="form-control" id="publish-date" placeholder="Choose date">
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="publish-time" class="form-label">Publish Time</label>
                                                    <input type="text" class="form-control" id="publish-time" placeholder="Choose time">
                                                </div> --}}
                                                <div class="col-xl-6">
                                                    <label for="product-status-add" class="form-label">Published Status</label>
                                                    <select class="form-control" data-trigger name="product-status-add" id="product-status-add">
                                                        <option value="">Select</option>
                                                        <option value="Published" selected>Published</option>
                                                        <option value="Scheduled">Scheduled</option>
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
                                                    <div id="product-feature2">High-quality packaging bag with side seal and custom printing options.</div>
                                                </div>
                                                <div class="col-xl-12 product-documents-container">
                                                    <p class="fw-medium mb-2 fs-14">Part Images</p>
                                                    <input type="file" class="product-Images" name="filepond" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="6">
                                                </div>
                                                <label class="form-label text-muted mt-3 fw-normal fs-12">* Minimum of 6 images are need to be uploaded,
                                                    all images should be uniformly maintained, width and height to the container.
                                                </label>
                                                <div class="col-xl-12 product-documents-container">
                                                    <p class="fw-medium mb-2 fs-14">Pdf Documents :</p>
                                                    <input type="file" class="product-documents2" name="filepond" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="6">
                                                </div>
                                               
                                                
                                                <div class="col-xl-12">
                                                    <label for="product-tags" class="form-label">Part Tags</label>
                                                    <select class="form-control" name="product-tags" id="product-tags" multiple>
                                                        <option value="Relaxed" selected>Relaxed</option>
                                                        <option value="Solid">Solid</option>
                                                        
                                                        <option value="Plain" selected>Plain</option>
                                                    </select>
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
     
                            </div>
                            
                            <hr><div class="row">
                                
                                <div class="col-xl-3">
                                  <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                    <input id="BST" name="BST" type="checkbox" checked="">
                                    <label for="BST" class="label-primary"></label><span class="ms-3">BST</span>
                                  </div>
                                </div>
                                <div class="col-xl-3">
                                  <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                    <input id="Plain" name="Plain" type="checkbox" checked="">
                                    <label for="Plain" class="label-primary"></label><span class="ms-3">Plain</span>
                                  </div>
                                </div>
                                <div class="col-xl-3">
                                  <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                    <input id="Flat" name="Flat" type="checkbox" checked="">
                                    <label for="Flat" class="label-primary"></label><span class="ms-3">Flat</span>
                                  </div>
                                </div>
                                <div class="col-xl-3">
                                  <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                    <input id="Gazzate" name="Gazzate" type="checkbox" checked="">
                                    <label for="Gazzate" class="label-primary"></label><span class="ms-3">Gazzate</span>
                                  </div>
                                </div>
                                <div class="col-xl-3">
                                  <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                    <input id="BIO" name="BIO" type="checkbox" checked="">
                                    <label for="BIO" class="label-primary"></label><span class="ms-3">Bio</span>
                                  </div>
                                </div>
                                <div class="col-xl-3">
                                  <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                    <input id="NORMAL" name="NORMAL" type="checkbox" checked="">
                                    <label for="NORMAL" class="label-primary"></label><span class="ms-3">Normal</span>
                                  </div>
                                </div>
                                <div class="col-xl-3">
                                  <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                    <input id="Milky" name="Milky" type="checkbox" checked="">
                                    <label for="Milky" class="label-primary"></label><span class="ms-3">Milky</span>
                                  </div>
                                </div>
                                <div class="col-xl-3">
                                  <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                    <input id="Roto" name="Roto" type="checkbox" checked="">
                                    <label for="Roto" class="label-primary"></label><span class="ms-3">Roto Printing</span>
                                  </div>
                                </div>
                                <div class="col-xl-3">
                                  <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                    <input id="Flexo" name="Flexo" type="checkbox" checked="">
                                    <label for="Flexo" class="label-primary"></label><span class="ms-3">Flexo Printing</span>
                                  </div>
                                </div>
                                <div class="col-xl-3">
                                  <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                    <input id="Sideseal" name="Sideseal" type="checkbox" checked="">
                                    <label for="Sideseal" class="label-primary"></label><span class="ms-3">Sideseal</span>
                                  </div>
                                </div>
                                <div class="col-xl-3">
                                  <div class="custom-toggle-switch d-flex align-items-center mb-4">
                                    <input id="Recyle" name="Recyle" type="checkbox" checked="">
                                    <label for="Recyle" class="label-primary"></label><span class="ms-3">Recycle Logo</span>
                                  </div>
                                </div>
                        </div>
                        </div>
                        <div class="card-footer border-top border-block-start-dashed d-sm-flex justify-content-end">
                            <button class="btn btn-primary1 me-2 mb-2 mb-sm-0">Update Product<i class="bi bi-plus-lg ms-2"></i></button>
                            <button class="btn btn-primary mb-2 mb-sm-0">Save Product<i class="bi bi-download ms-2"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!--End::row-1 -->
        </div>
    </div>
</div>
</div>

{{-- end modal --}}


    <!-- Start::row-1 -->
    <div class="card custom-card">
        <div class="card-header justify-content-between">
            <div class="card-title">
                All Orders List
            </div>
            <div class="d-flex gap-3 align-items-center flex-wrap">
                <div class="btn-group">
                    <button class="btn btn-outline-light border dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-sort-descending-2 me-1"></i> Sort By
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:void(0)">Created Date</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)">Status</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)">Orders</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)">Product Name</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)">Newest</a></li>
                        <li><a class="dropdown-item" href="javascript:void(0)">Oldest</a></li>
                    </ul>
                </div>
                <div class="custom-form-group flex-grow-1">
                    <input type="text" class="form-control" placeholder="Search Orders.." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <a href="javascript:void(0);" class="text-muted custom-form-btn"><i class="ti ti-search"></i></a>
                </div> 
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                        <th scope="col">Item Code</th>
            <th scope="col">Product</th>
            <th scope="col">Part ID</th>
            <th scope="col">Customer</th>
            <th scope="col">Contact</th>
            <th scope="col">Date</th>
            <th scope="col">Instock</th>
            <th scope="col">Dispatched</th>
            <th scope="col">Produced</th>
          
           
            <th scope="col">Status</th>
            <th scope="col">Size</th>
            <th scope="col">Price (₹)</th>
            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                  
                    <tr class="order-list">
            <td>#FG1001</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm avatar-square bg-gray-300">
                        <img src="{{ asset('assets/images/media/ongoing.png') }}" class="w-100 h-100" alt="Part Image">
                    </span>
                    <div class="ms-2">
                        <p class="fw-semibold mb-0 d-flex align-items-center"><a href="stock-details.html">Corrugated Box</a></p>
                    </div>
                </div>
            </td>
            <td>8421</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm me-2 avatar-rounded">
                        <img src="{{ asset('assets/images/faces/7.jpg') }}" alt="Customer Image">
                    </span>Reliance Retail
                </div>
            </td>
            <td>(909) 123 - 4567</td>
            <td>2024-12-20</td>
            <td>996.58 Kg</td>
            <td>758.50 Kg</td>
            <td>996.25 Kg</td>
            <td><span class="badge bg-success-transparent">In Stock</span></td>
            <td>45x60 cm</td>
            <td class="fw-semibold">₹305811</td>
            <td>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-edit-line"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                    <i class="ri-download-line"></i>
                </a>
                <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                    <i class="ri-delete-bin-line"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>#FG1002</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm avatar-square bg-gray-300">
                        <img src="{{ asset('assets/images/media/pending.png') }}" class="w-100 h-100" alt="Part Image">
                    </span>
                    <div class="ms-2">
                        <p class="fw-semibold mb-0 d-flex align-items-center"><a href="stock-details.html">Paper Bag</a></p>
                    </div>
                </div>
            </td>
            <td>8422</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm me-2 avatar-rounded">
                        <img src="{{ asset('assets/images/faces/8.jpg') }}" alt="Customer Image">
                    </span>Spencer's Retail
                </div>
            </td>
            <td>(900) 111 - 2222</td>
            <td>2024-12-18</td>
            <td>139.58 Kg</td>
            <td>758.50 Kg</td>
            <td>996.25 Kg</td>
            <td><span class="badge bg-warning-transparent">Low Stock</span></td>
            <td>30x40 cm</td>
            <td class="fw-semibold">₹656481</td>
            <td>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-edit-line"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                    <i class="ri-download-line"></i>
                </a>
                <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                    <i class="ri-delete-bin-line"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>#FG1003</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm avatar-square bg-gray-300">
                        <img src="{{ asset('assets/images/media/pending.png') }}" class="w-100 h-100" alt="Part Image">
                    </span>
                    <div class="ms-2">
                        <p class="fw-semibold mb-0 d-flex align-items-center"><a href="stock-details.html">Plastic Container</a></p>
                    </div>
                </div>
            </td>
            <td>8423</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm me-2 avatar-rounded">
                        <img src="{{ asset('assets/images/faces/9.jpg') }}" alt="Customer Image">
                    </span>Big Bazaar
                </div>
            </td>
            <td>(905) 678 - 1234</td>
            <td>2024-12-15</td>
            <td>0 Kg</td>
            <td>595.50 Kg</td>
            <td>596.25 Kg</td>
            <td><span class="badge bg-danger-transparent">Out Of Stock</span></td>
            <td>25x25x20 cm</td>
            <td class="fw-semibold">₹48572</td>
            <td>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-edit-line"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                    <i class="ri-download-line"></i>
                </a>
                <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                    <i class="ri-delete-bin-line"></i>
                </a>
            </td>
        </tr>           
        <tr>
            <td>#FG1004</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm avatar-square bg-gray-300">
                        <img src="{{ asset('assets/images/media/urgent.png') }}" class="w-100 h-100" alt="Part Image">
                    </span>
                    <div class="ms-2">
                        <p class="fw-semibold mb-0 d-flex align-items-center"><a href="stock-details.html">Plastic Container</a></p>
                    </div>
                </div>
            </td>
            <td>8423</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm me-2 avatar-rounded">
                        <img src="{{ asset('assets/images/faces/9.jpg') }}" alt="Customer Image">
                    </span>Big Bazaar
                </div>
            </td>
            <td>(905) 678 - 1234</td>
            <td>2024-12-15</td>
            <td>0 Kg</td>
            <td>995.50 Kg</td>
            <td>996.25 Kg</td>
            <td><span class="badge bg-danger-transparent">Out Of Stock</span></td>
            <td>25x25x20 cm</td>
            <td class="fw-semibold">₹48572</td>
            <td>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-edit-line"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                    <i class="ri-download-line"></i>
                </a>
                <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                    <i class="ri-delete-bin-line"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>#FG1002</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm avatar-square bg-gray-300">
                        <img src="{{ asset('assets/images/media/pending.png') }}" class="w-100 h-100" alt="Part Image">
                    </span>
                    <div class="ms-2">
                        <p class="fw-semibold mb-0 d-flex align-items-center"><a href="stock-details.html">Paper Bag</a></p>
                    </div>
                </div>
            </td>
            <td>8422</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm me-2 avatar-rounded">
                        <img src="{{ asset('assets/images/faces/8.jpg') }}" alt="Customer Image">
                    </span>Spencer's Retail
                </div>
            </td>
            <td>(900) 111 - 2222</td>
            <td>2024-12-18</td>
            <td>139.58 Kg</td>
            <td>758.50 Kg</td>
            <td>996.25 Kg</td>
            <td><span class="badge bg-warning-transparent">Low Stock</span></td>
            <td>30x40 cm</td>
            <td class="fw-semibold">₹656481</td>
            <td>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-edit-line"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                    <i class="ri-download-line"></i>
                </a>
                <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                    <i class="ri-delete-bin-line"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>#FG1003</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm avatar-square bg-gray-300">
                        <img src="{{ asset('assets/images/media/pending.png') }}" class="w-100 h-100" alt="Part Image">
                    </span>
                    <div class="ms-2">
                        <p class="fw-semibold mb-0 d-flex align-items-center"><a href="stock-details.html">Plastic Container</a></p>
                    </div>
                </div>
            </td>
            <td>8423</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm me-2 avatar-rounded">
                        <img src="{{ asset('assets/images/faces/9.jpg') }}" alt="Customer Image">
                    </span>Big Bazaar
                </div>
            </td>
            <td>(905) 678 - 1234</td>
            <td>2024-12-15</td>
            <td>0 Kg</td>
            <td>595.50 Kg</td>
            <td>596.25 Kg</td>
            <td><span class="badge bg-danger-transparent">Out Of Stock</span></td>
            <td>25x25x20 cm</td>
            <td class="fw-semibold">₹48572</td>
            <td>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-edit-line"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                    <i class="ri-download-line"></i>
                </a>
                <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                    <i class="ri-delete-bin-line"></i>
                </a>
            </td>
        </tr>           
        <tr>
            <td>#FG1004</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm avatar-square bg-gray-300">
                        <img src="{{ asset('assets/images/media/urgent.png') }}" class="w-100 h-100" alt="Part Image">
                    </span>
                    <div class="ms-2">
                        <p class="fw-semibold mb-0 d-flex align-items-center"><a href="stock-details.html">Plastic Container</a></p>
                    </div>
                </div>
            </td>
            <td>8423</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm me-2 avatar-rounded">
                        <img src="{{ asset('assets/images/faces/9.jpg') }}" alt="Customer Image">
                    </span>Big Bazaar
                </div>
            </td>
            <td>(905) 678 - 1234</td>
            <td>2024-12-15</td>
            <td>0 Kg</td>
            <td>995.50 Kg</td>
            <td>996.25 Kg</td>
            <td><span class="badge bg-danger-transparent">Out Of Stock</span></td>
            <td>25x25x20 cm</td>
            <td class="fw-semibold">₹48572</td>
            <td>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-edit-line"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                    <i class="ri-download-line"></i>
                </a>
                <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                    <i class="ri-delete-bin-line"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>#FG1002</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm avatar-square bg-gray-300">
                        <img src="{{ asset('assets/images/media/pending.png') }}" class="w-100 h-100" alt="Part Image">
                    </span>
                    <div class="ms-2">
                        <p class="fw-semibold mb-0 d-flex align-items-center"><a href="stock-details.html">Paper Bag</a></p>
                    </div>
                </div>
            </td>
            <td>8422</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm me-2 avatar-rounded">
                        <img src="{{ asset('assets/images/faces/8.jpg') }}" alt="Customer Image">
                    </span>Spencer's Retail
                </div>
            </td>
            <td>(900) 111 - 2222</td>
            <td>2024-12-18</td>
            <td>139.58 Kg</td>
            <td>758.50 Kg</td>
            <td>996.25 Kg</td>
            <td><span class="badge bg-warning-transparent">Low Stock</span></td>
            <td>30x40 cm</td>
            <td class="fw-semibold">₹656481</td>
            <td>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-edit-line"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                    <i class="ri-download-line"></i>
                </a>
                <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                    <i class="ri-delete-bin-line"></i>
                </a>
            </td>
        </tr>
        <tr>
            <td>#FG1003</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm avatar-square bg-gray-300">
                        <img src="{{ asset('assets/images/media/pending.png') }}" class="w-100 h-100" alt="Part Image">
                    </span>
                    <div class="ms-2">
                        <p class="fw-semibold mb-0 d-flex align-items-center"><a href="stock-details.html">Plastic Container</a></p>
                    </div>
                </div>
            </td>
            <td>8423</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm me-2 avatar-rounded">
                        <img src="{{ asset('assets/images/faces/9.jpg') }}" alt="Customer Image">
                    </span>Big Bazaar
                </div>
            </td>
            <td>(905) 678 - 1234</td>
            <td>2024-12-15</td>
            <td>0 Kg</td>
            <td>595.50 Kg</td>
            <td>596.25 Kg</td>
            <td><span class="badge bg-danger-transparent">Out Of Stock</span></td>
            <td>25x25x20 cm</td>
            <td class="fw-semibold">₹48572</td>
            <td>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-edit-line"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                    <i class="ri-download-line"></i>
                </a>
                <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                    <i class="ri-delete-bin-line"></i>
                </a>
            </td>
        </tr>           
        <tr>
            <td>#FG1004</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm avatar-square bg-gray-300">
                        <img src="{{ asset('assets/images/media/urgent.png') }}" class="w-100 h-100" alt="Part Image">
                    </span>
                    <div class="ms-2">
                        <p class="fw-semibold mb-0 d-flex align-items-center"><a href="stock-details.html">Plastic Container</a></p>
                    </div>
                </div>
            </td>
            <td>8423</td>
            <td>
                <div class="d-flex align-items-center">
                    <span class="avatar avatar-sm me-2 avatar-rounded">
                        <img src="{{ asset('assets/images/faces/9.jpg') }}" alt="Customer Image">
                    </span>Big Bazaar
                </div>
            </td>
            <td>(905) 678 - 1234</td>
            <td>2024-12-15</td>
            <td>0 Kg</td>
            <td>995.50 Kg</td>
            <td>996.25 Kg</td>
            <td><span class="badge bg-danger-transparent">Out Of Stock</span></td>
            <td>25x25x20 cm</td>
            <td class="fw-semibold">₹48572</td>
            <td>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-primary-light btn-wave waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#editDataModal">
                    <i class="ri-edit-line"></i>
                </a>
                <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-info-light btn-wave waves-effect waves-light">
                    <i class="ri-download-line"></i>
                </a>
                <a href="javascript:void(0);" class="order-delete-btn btn btn-icon btn-sm btn-primary2-light btn-wave waves-effect waves-light">
                    <i class="ri-delete-bin-line"></i>
                </a>
            </td>
        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer border-top-0">
            <div class="d-flex align-items-center flex-wrap overflow-auto">
                <div class="mb-2 mb-sm-0">
                    Showing <b>1</b> to <b>10</b> entries <i class="bi bi-arrow-right ms-2 fw-semibold"></i>
                </div>
                <div class="ms-auto">
                    <ul class="pagination mb-0 overflow-auto">
                        <li class="page-item disabled">
                            <a class="page-link">Previous</a>
                        </li>
                        <li class="page-item active" aria-current="page"><a class="page-link" href="javascript:void(0)">1</a></li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                        <li class="page-item"><a class="page-link" href="javascript:void(0)">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="javascript:void(0)">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--End::row-1 -->
    @endsection