<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\TattooGalleryController;
use App\Http\Controllers\PiercingGalleryController;

// ==================== ROOT DEFAULT ROUTE ====================
Route::get('/', function () {
    return view('homme');
});

// ==================== AUTH ROUTES ====================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== DASHBOARD ROUTE ====================
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ==================== SHORTCUT REDIRECT ROUTES ====================
Route::get('/reservation', fn() => redirect()->route('dashboard', ['page' => 'reservation']))->name('dashboard.reservation');
Route::get('/booking', fn() => redirect()->route('dashboard', ['page' => 'booking']))->name('dashboard.booking');
Route::get('/artist', fn() => redirect()->route('dashboard', ['page' => 'artist']))->name('dashboard.artist');
Route::get('/inventory', fn() => redirect()->route('dashboard', ['page' => 'inventory']))->name('dashboard.inventory');
Route::get('/mainshop', fn() => redirect()->route('dashboard', ['page' => 'mainshop']))->name('dashboard.mainshop');
Route::get('/piercingsgallery', fn() => redirect()->route('dashboard', ['page' => 'piercingsgallery']))->name('dashboard.piercingsgallery');
Route::get('/tattoogallery', fn() => redirect()->route('dashboard', ['page' => 'tattoogallery']))->name('dashboard.tattoogallery');
Route::get('/dashboard/users', fn() => redirect()->route('dashboard', ['page' => 'users']))->name('dashboard.users');
Route::get('/dashboard/products', fn() => redirect()->route('dashboard', ['page' => 'products']))->name('dashboard.products');
Route::get('/dashboard/equipments', fn() => redirect()->route('dashboard', ['page' => 'equipments']))->name('dashboard.equipments');
Route::get('/dashboard/suppliers', fn() => redirect()->route('dashboard', ['page' => 'suppliers']))->name('dashboard.suppliers');
Route::get('/dashboard/delreports', fn() => redirect()->route('dashboard', ['page' => 'delreports']))->name('dashboard.delreports');
Route::get('/dashboard/audtrail', fn() => redirect()->route('dashboard', ['page' => 'audtrail']))->name('dashboard.daudtrail');
    // ==================== INVERNTORY ROUTES ====================
Route::post('/submit-product', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/inventory/get-product/{id}', [InventoryController::class, 'getProductById'])->name('inventory.getProduct');
Route::get('/get-product/{product_id}', [InventoryController::class, 'getProductDetails']);
Route::get('/products/{id}', [InventoryController::class, 'getProductById']);
Route::get('/inventories', [InventoryController::class, 'index'])->name('inventories.index');
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
Route::post('/submit-product', [InventoryController::class, 'store'])->name('inventory.store');
Route::post('/inventory/update-photo', [InventoryController::class, 'updatePhoto'])->name('inventory.update-photo');

// ==================== BOOKING MANAGEMENT ROUTES ====================
// Bookings
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings');
Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
Route::post('/bookings/{id}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');

// Reservations
Route::post('/reservations/{id}/finish', [BookingController::class, 'finishReservation'])->name('reservations.finish');
Route::post('/reservations/{id}/cancel', [BookingController::class, 'cancelReservation'])->name('reservations.cancel');

Route::get('/delreports', [DeliveryController::class, 'index'])->name('delreports.index');

// ==================== UNDER 18 ROUTES ====================
Route::get('/under18', function () {
    return view('under18');
});

// Update existing artist page (upload)
Route::put('/artist_pages/{id}', [ArtistController::class, 'updateArtistPage'])->name('artist_pages.update');


// Artist CRUD
Route::resource('artists', ArtistController::class);

// Fetch artworks for one artist (for your modal)
Route::get('/artists/{id}/artworks', [ArtistController::class, 'getArtistWithArtworks'])->name('artists.artworks');

// ==================== PRODUCTS MANAGEMENT ROUTES ====================
Route::resource('products', ProductsController::class);
Route::get('/products', [ProductsController::class, 'index'])->name('products.index');
Route::delete('/products/{id}', [ProductsController::class, 'destroy'])->name('products.destroy');
Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductsController::class, 'update'])->name('products.update');

// ==================== USERS CRUD ROUTES ====================
Route::resource('users', UserController::class);

// ==================== RESERVATION CRUD ROUTES ====================
Route::resource('reservations', ReservationController::class)->except(['edit', 'show']);
Route::get('/reservations/{id}/edit-show', [ReservationController::class, 'showEditModal'])->name('reservations.edit.show');
Route::get('/reservations/clear-edit', [ReservationController::class, 'clearEdit'])->name('reservations.edit.clear');

// ==================== SUPER ADMIN AUTH ====================
Route::get('/superadmin-auth', [DashboardController::class, 'usersAuthForm'])->name('superadmin.auth.form');
Route::post('/superadmin-auth', [DashboardController::class, 'checkUsersAuth'])->name('dashboard.users.auth.check');

// ==================== Contact Form ====================
Route::post('/send-email', [ContactController::class, 'sendEmail']);
Route::get('/contact', function () {
    return view('contact');
});
Route::resource('equipments', EquipmentController::class) ->only(['index', 'store', 'update', 'destroy']);
// ==================== Supplier Form ====================
Route::resource('suppliers', SupplierController::class) ->only(['index', 'store', 'update', 'destroy']); 

Route::get('/tattoogallery', [TattooGalleryController::class, 'index'])->name('tattoogallery.index');
Route::post('/tattoogallery', [TattooGalleryController::class, 'store'])->name('tattoogallery.store');


Route::get('/api/tattoo-header', [TattooGalleryController::class, 'getHeaderData']); 
Route::get('/admin/tattoo-gallery', [TattooGalleryController::class, 'index'])->name('tattoogallery.index');
Route::get('/admin/tattoo-gallery', [TattooGalleryController::class, 'index'])
    ->name('tattoogallery.index');

Route::post('/admin/tattoo-gallery', [TattooGalleryController::class, 'store'])->name('tattoogallery.store');
Route::get('/admin/tattoo-gallery', [TattooGalleryController::class, 'index'])->name('tattoogallery.index');

Route::get('/admin/piercing-gallery', [PiercingGalleryController::class, 'index'])->name('piercinggallery.index');
Route::post('/admin/piercing-gallery/store', [PiercingGalleryController::class, 'store'])->name('piercinggallery.store');

Route::get('/api/piercing-gallery', [PiercingGalleryController::class, 'showGallery']);

Route::get('/piercing-gallery', [PiercingGalleryController::class, 'index'])->name('piercinggallery.index');
Route::post('/piercing-gallery/store', [PiercingGalleryController::class, 'store'])->name('piercinggallery.store');
Route::get('/piercing-gallery/show', [PiercingGalleryController::class, 'showGallery']);
Route::get('/tattoo-gallery-data', [TattooGalleryController::class, 'showGallery']);

Route::get('/piercingsgallery', [PiercingGalleryController::class, 'index'])->name('piercingsgallery.index');
Route::post('/piercingsgallery', [PiercingGalleryController::class, 'store'])->name('piercingsgallery.store');

// API for frontend display

// ==================== SPA Catch-All Route ====================
Route::get('/{homme}', function () {
    return view('homme');
})->where('any', '.*');
