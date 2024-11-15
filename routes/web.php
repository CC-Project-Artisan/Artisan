<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\VendorController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/dashboard/updatedUserInformation', [UserController::class, 'update'])->name('user-profile.update');

//Page Routes
Route::get('/', [PageController::class, 'index'])->name('welcome');
Route::get('/shop', [PageController::class, 'shop'])->name('pages.shop');
Route::get('/about', [PageController::class, 'about'])->name('pages.about');

// Route::get('/shop', [ProductController::class, 'index'])->name('pages.shop');
// Route::get('/products', [ProductController::class, 'index']);

//Dashboard Routes
Route::get('/dashboard', [PageController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::post('/dashboard/register-vendor', [VendorController::class, 'registerVendor'])->name('vendor.register');
// Route::post('/dashboard/update-store-details', [VendorController::class, 'updateStoreDetails'])->name('vendor.update');
// Route::get('/dashboard/create-listing', [ProductController::class, 'create'])->name('product.create');
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::post('/register-vendor', [VendorController::class, 'registerVendor'])->name('vendor.register');
        Route::post('/update-store-details', [VendorController::class, 'updateStoreDetails'])->name('vendor.update');
        Route::get('/create-listing', [ProductController::class, 'index'])->name('product.create');
        Route::post('/store-listing', [ProductController::class, 'store'])->name('product.store');
    });
});


Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');






//test admin middleware (make the function in the controller and the middleware and register it in the kernel)
Route::get('/admintest', [PageController::class, 'admintest'])->middleware('admin', 'auth')->name('testAdmin');

require __DIR__.'/auth.php';
