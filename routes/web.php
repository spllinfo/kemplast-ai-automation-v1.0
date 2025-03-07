<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\MaterialStockController;
use App\Http\Controllers\ProductionPlanController;
use App\Http\Controllers\JobPartController;
use App\Http\Controllers\StaffController;

use App\Http\Controllers\SettingController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\BiometricController;

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::match(['put', 'patch'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile-settings/{id?}', [ProfileController::class, 'settings'])->name('profile.settings');
    Route::post('/profile-settings/update', [ProfileController::class, 'settingsUpdate'])->name('profile.settings.update');

    // Staff Routes
    Route::get('/staffs', [StaffController::class, 'staffs'])->name('staffs');
    Route::get('/staffs/fetchall', [StaffController::class, 'stafffetchall'])->name('stafffetchall');
    Route::post('/staffs/store', [StaffController::class, 'staffstore'])->name('staffstore');
    Route::get('/staffedit', [StaffController::class, 'staffedit'])->name('staffedit');
    Route::post('/staffs/update', [StaffController::class, 'staffupdate'])->name('staffupdate');
    Route::delete('/staffs/delete', [StaffController::class, 'staffdelete'])->name('staffdelete');
    Route::post('/staffexport', [ExcelController::class, 'staffexport'])->name('staffexport');
    Route::post('/staffimport', [ExcelController::class, 'staffimport'])->name('staffimport');

    // Staff Profile Settings Route
    Route::get('/staff-profile-settings/{id?}', [StaffController::class, 'profileSettings'])->name('staff.profile.settings');

    // Staff Profile Settings Route
    Route::get('/staff-profile-settings/{id?}', [StaffController::class, 'profileSettings'])->name('staff.profile.settings');

    // Settings Routes
    Route::get('/settings', function() {
        return redirect()->route('settings.website');
    })->name('settings');
    Route::get('/settings/website', [SettingController::class, 'website'])->name('settings.website');
    Route::post('/settings/website/update', [SettingController::class, 'websiteUpdate'])->name('settings.website.update');

    // Biometric Authentication Routes
    Route::prefix('biometric')->group(function () {
        Route::post('/scan', [BiometricController::class, 'scan'])->name('biometric.scan');
        Route::post('/validate', [BiometricController::class, 'validate'])->name('biometric.validate');
        Route::post('/enroll', [BiometricController::class, 'enroll'])->name('biometric.enroll');
        Route::post('/remove', [BiometricController::class, 'remove'])->name('biometric.remove');
    });

// Parts Routes
Route::get('/parts', [PartController::class, 'index'])->name('parts.index');
Route::get('/parts/fetchall', [PartController::class, 'fetchAll'])->name('parts.fetchAll');
Route::post('/parts/store', [PartController::class, 'store'])->name('parts.store');
Route::get('/parts/edit/{id}', [PartController::class, 'edit'])->name('parts.edit');
Route::get('/parts/view/{id}', [PartController::class, 'view'])->name('parts.view');
Route::put('/parts/update/{id}', [PartController::class, 'update'])->name('parts.update');
Route::delete('/parts/destroy/{id}', [PartController::class, 'destroy'])->name('parts.destroy');
Route::post('/parts/export', [PartController::class, 'export'])->name('parts.export');
Route::post('/parts/upload-documents', [PartController::class, 'uploadDocuments'])->name('parts.upload-documents');


Route::get('/extrusion', function () {
    return view('extrusion');
});
Route::get('/printing', function () {
    return view('printing');
});
Route::get('/pasting', function () {
    return view('pasting');
});
Route::get('/slitting', function () {
    return view('slitting');
});
Route::get('/finish', function () {
    return view('finish');
});
Route::get('/cutting', function () {
    return view('cutting');
});
Route::get('/dispatch', function () {
    return view('dispatch');
});
Route::get('/create-invoice', function () {
    return view('create-invoice');
});
Route::get('/dispatch-details', function () {
    return view('invoice-details');
});
Route::get('/rawmaterial', function () {
    return view('rawmaterial');
});

Route::get('/machines', function () {
    return view('machines');
});
Route::get('/warehouse', function () {
    return view('warehouse');
});

// Admin Production Plan Routes
Route::get('/productionplans', [ProductionPlanController::class, 'productionplans'])->name('productionplans');
Route::get('/productionplans/fetchall', [ProductionPlanController::class, 'productionplanfetchall'])->name('productionplanfetchall');
Route::post('/productionplans/store', [ProductionPlanController::class, 'productionplanstore'])->name('productionplanstore');
Route::get('/productionplans/edit', [ProductionPlanController::class, 'productionplanedit'])->name('productionplanedit');
Route::get('/productionplans/view', [ProductionPlanController::class, 'productionplanview'])->name('productionplanview');
Route::post('/productionplans/update', [ProductionPlanController::class, 'productionplanupdate'])->name('productionplanupdate');
Route::post('/productionplans/destroy', [ProductionPlanController::class, 'productionplandestroy'])->name('productionplandestroy');
Route::post('/productionplans/export', [ProductionPlanController::class, 'productionplanexport'])->name('productionplanexport');

// Admin Dispatch Routes
Route::get('/dispatches', [DispatchController::class, 'dispatches'])->name('dispatches');
Route::post('/dispatch-store', [DispatchController::class, 'dispatchStore'])->name('dispatch.store');
Route::get('/dispatch-fetch-all', [DispatchController::class, 'dispatchfetchall'])->name('dispatch.fetch.all');
Route::get('/dispatch-edit', [DispatchController::class, 'dispatchedit'])->name('dispatch.edit');
Route::post('/dispatch-update', [DispatchController::class, 'dispatchupdate'])->name('dispatch.update');
Route::delete('/dispatch-delete', [DispatchController::class, 'dispatchdelete'])->name('dispatch.delete');

Route::post('/dispatch-export', [ExcelController::class, 'dispatchexport'])->name('dispatch.export');
Route::post('/dispatch-import', [ExcelController::class, 'dispatchimport'])->name('dispatch.import');

// Admin Customer Routes


// Customer routes with request-logger middleware

    Route::get('/customers', [CustomerController::class, 'customers']); // Index page
    // Read operations
    Route::get('/customerfetchall', [CustomerController::class, 'customerfetchall'])->name('customerfetchall');
    Route::get('/customeredit', [CustomerController::class, 'customeredit'])->name('customeredit');
    Route::get('/customerview', [CustomerController::class, 'customerview'])->name('customerview');
    Route::get('/customerformstate', [CustomerController::class, 'getFormState'])->name('customerformstate');

    // Write operations with rate limiting (10 requests per minute)

        Route::post('/customerstore', [CustomerController::class, 'customerstore'])->name('customerstore');
        Route::post('/customerupdate', [CustomerController::class, 'customerupdate'])->name('customerupdate');
        Route::delete('/customers/{customer}', [CustomerController::class, 'destroy']);
        Route::post('/customerexport', [CustomerController::class, 'customerexport'])->name('customerexport');
        Route::post('/customerautosave', [CustomerController::class, 'autosave'])->name('customerautosave');
        Route::post('/customerimport', [CustomerController::class, 'customerimport'])->name('customerimport');


// Admin Supplier Routes
Route::get('/suppliers', [SupplierController::class, 'suppliers']); //for index page.
Route::get('/supplierfetchall', [SupplierController::class, 'supplierfetchall'])->name('supplierfetchall');
Route::post('/supplierstore', [SupplierController::class, 'supplierstore'])->name('supplierstore');
Route::get('/supplieredit', [SupplierController::class, 'supplieredit'])->name('supplieredit');
Route::get('/supplierview', [SupplierController::class, 'supplierview'])->name('supplierview');
Route::post('/supplierupdate', [SupplierController::class, 'supplierupdate'])->name('supplierupdate');
Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy']);

Route::post('/supplierimport', [SupplierController::class, 'supplierimport'])->name('supplierimport');
Route::post('/supplierexport', [SupplierController::class, 'supplierexport'])->name('supplierexport');

// Admin Machine Routes
Route::get('/machines', [MachineController::class, 'machines'])->name('machines');
Route::get('/machines/fetchall', [MachineController::class, 'machinefetchall'])->name('machinefetchall');
Route::post('/machines/store', [MachineController::class, 'machinestore'])->name('machinestore');
Route::get('/machines/edit', [MachineController::class, 'machineedit'])->name('machineedit');
Route::get('/machines/view', [MachineController::class, 'machineview'])->name('machineview');
Route::post('/machines/update', [MachineController::class, 'machineupdate'])->name('machineupdate');
Route::post('/machines/destroy', [MachineController::class, 'machinedestroy'])->name('machinedestroy');
Route::post('/machines/export', [MachineController::class, 'machineexport'])->name('machineexport');

Route::post('/machineimport', [MachineController::class, 'machineimport'])->name('machineimport');

// Admin Branch Routes
Route::get('/branches', [BranchController::class, 'branches'])->name('branches');
Route::get('/branches/fetchall', [BranchController::class, 'branchfetchall'])->name('branchfetchall');
Route::post('/branches/store', [BranchController::class, 'branchstore'])->name('branchstore');
Route::get('/branches/edit', [BranchController::class, 'branchedit'])->name('branchedit');
Route::get('/branches/view', [BranchController::class, 'branchview'])->name('branchview');
Route::post('/branches/update', [BranchController::class, 'branchupdate'])->name('branchupdate');
Route::post('/branches/destroy', [BranchController::class, 'branchdestroy'])->name('branchdestroy');
Route::post('/branches/export', [BranchController::class, 'branchexport'])->name('branchexport');


// Parts Routes
// Route::get('/parts', [PartController::class, 'parts'])->name('parts');
// Route::get('/parts/fetchall', [PartController::class, 'partfetchall'])->name('partfetchall');
// Route::post('/parts/store', [PartController::class, 'partstore'])->name('partstore');
// Route::get('/parts/edit', [PartController::class, 'partedit'])->name('partedit');
// Route::get('/parts/view', [PartController::class, 'partview'])->name('partview');
// Route::post('/parts/update', [PartController::class, 'partupdate'])->name('partupdate');
// Route::post('/parts/destroy', [PartController::class, 'partdestroy'])->name('partdestroy');
// Route::post('/parts/export', [PartController::class, 'partexport'])->name('partexport');
// Route::post('/parts/import', [PartController::class, 'partimport'])->name('partimport');

// Admin Job Part Routes
Route::get('/jobparts', [JobPartController::class, 'jobparts'])->name('jobparts');
Route::get('/jobparts/fetchall', [JobPartController::class, 'jobpartfetchall'])->name('jobpartfetchall');
Route::post('/jobparts/store', [JobPartController::class, 'jobpartstore'])->name('jobpartstore');
Route::get('/jobparts/edit', [JobPartController::class, 'jobpartedit'])->name('jobpartedit');
Route::get('/jobparts/view', [JobPartController::class, 'jobpartview'])->name('jobpartview');
Route::post('/jobparts/update', [JobPartController::class, 'jobpartupdate'])->name('jobpartupdate');
Route::post('/jobparts/destroy', [JobPartController::class, 'jobpartdestroy'])->name('jobpartdestroy');
Route::post('/jobparts/export', [JobPartController::class, 'jobpartexport'])->name('jobpartexport');

// Admin Material Stock Routes
Route::get('/materialstocks', [MaterialStockController::class, 'materialstocks'])->name('materialstocks');
Route::get('/materialstocks/fetchall', [MaterialStockController::class, 'materialstockfetchall'])->name('materialstockfetchall');
Route::post('/materialstocks/store', [MaterialStockController::class, 'materialstockstore'])->name('materialstockstore');
Route::get('/materialstocks/edit', [MaterialStockController::class, 'materialstockedit'])->name('materialstockedit');
Route::get('/materialstocks/view', [MaterialStockController::class, 'materialstockview'])->name('materialstockview');
Route::post('/materialstocks/update', [MaterialStockController::class, 'materialstockupdate'])->name('materialstockupdate');
Route::post('/materialstocks/destroy', [MaterialStockController::class, 'materialstockdestroy'])->name('materialstockdestroy');
Route::post('/materialstocks/export', [MaterialStockController::class, 'materialstockexport'])->name('materialstockexport');


Route::get('/stock-alert', function () {
    return view('stock-alert');
});
Route::get('/production-plan', function () {
    return view('production-plan');
});
Route::get('/production-jobs', function () {
    return view('production-jobs');
});
Route::get('/processing-jobs', function () {
    return view('processing-jobs');
});
Route::get('/production-plan-report', function () {
    return view('production-plan-report');
});
Route::get('/production-plan-material-report', function () {
    return view('production-plan-material-report');
});

Route::get('/parts-stocks', function () {
    return view('parts-stocks');
});

Route::get('/profile-settings', function () {
    return view('profile-settings');
});
// Removing duplicate settings route

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('optimize');
    return 'All caches cleared and application optimized successfully.';
});




// Route::middleware(['auth'])->group(function () {
//     // Dashboard Routes
//     Route::get('/dashboard', [DashboardController::class, 'index'])
//         ->name('dashboard');

//     // Admin Routes
//     Route::middleware(['role:admin'])->group(function () {
//         Route::get('/admin', function () {
//             return view('admin.index');
//         })->name('admin.index');
//     });

//     // Manager Routes
//     Route::middleware(['role:admin,manager'])->group(function () {
//         Route::get('/reports', function () {
//             return view('reports.index');
//         })->name('reports.index');
//     });

//     // Profile Routes
//     Route::get('/profile', [ProfileController::class, 'edit'])
//         ->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])
//         ->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])
//         ->name('profile.destroy');
// });

require __DIR__.'/auth.php';
