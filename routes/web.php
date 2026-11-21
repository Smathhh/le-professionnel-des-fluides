<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminSettingsController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{product}/devis', [ProductController::class, 'devis'])->name('products.devis');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:5,1');

// Admin Dedicated Mobile App (Instant camera & piece upload)
Route::get('/admin/mobile-uploader', [\App\Http\Controllers\Admin\AdminMobileAppController::class, 'index'])->name('admin.mobile.uploader');
Route::post('/admin/mobile-uploader/pin', [\App\Http\Controllers\Admin\AdminMobileAppController::class, 'verifyPin'])->name('admin.mobile.pin')->middleware('throttle:5,1');
Route::post('/admin/mobile-uploader', [\App\Http\Controllers\Admin\AdminMobileAppController::class, 'store'])->name('admin.mobile.store');
Route::delete('/admin/mobile-uploader/{id}', [\App\Http\Controllers\Admin\AdminMobileAppController::class, 'destroy'])->name('admin.mobile.destroy');

// Android Mobile APK High-Performance Optimized API
Route::prefix('api/mobile')->group(function () {
    Route::post('/check-pin', [\App\Http\Controllers\Api\MobileApiController::class, 'checkPin'])->middleware('throttle:10,1');
    Route::get('/products', [\App\Http\Controllers\Api\MobileApiController::class, 'getProducts']);
    Route::post('/products', [\App\Http\Controllers\Api\MobileApiController::class, 'storeProduct']);
    Route::delete('/products/{id}', [\App\Http\Controllers\Api\MobileApiController::class, 'destroyProduct']);
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Products
    Route::resource('products', AdminProductController::class);
    
    // Services
    Route::resource('services', AdminServiceController::class);
    
    // Gallery
    Route::resource('gallery', AdminGalleryController::class);
    
    // Settings
    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings');
    Route::post('/settings', [AdminSettingsController::class, 'update'])->name('settings.update');
});

// Auth routes
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function () {
    $credentials = request()->only('email', 'password');
    if (auth()->attempt($credentials, request()->boolean('remember'))) {
        request()->session()->regenerate();
        return redirect()->intended('/admin');
    }
    return back()->withErrors([
        'email' => 'Invalid credentials',
    ]);
})->name('login.post')->middleware('throttle:5,1');

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');
