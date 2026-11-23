<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomBouquetController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminOrderStatusController;
use App\Http\Controllers\Admin\AdminCustomRequestController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\AdminCancellationController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminPersonalizationController;
use App\Http\Controllers\Admin\AdminAddOnController;

/*
|--------------------------------------------------------------------------
| Web Routes — BLOOMÉ Flowers & Stories
|--------------------------------------------------------------------------
| Sesuai Dokumen Spesifikasi Arsitektur Routing (Task ARC-005)
*/

// ==========================================
// 1. RUTE PUBLIK (GUEST DOMAIN)
// ==========================================

Route::get('/', [HomeController::class, 'index'])->name('home');

// Katalog & Detail Produk
Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/katalog/{slug}', [CatalogController::class, 'show'])->name('catalog.show');
Route::post('/katalog/{slug}/estimasi', [CatalogController::class, 'estimate'])->name('catalog.estimate');

// Pemesanan Katalog Siap Pesan (Guest Checkout)
Route::get('/pesan/{slug}', [OrderController::class, 'create'])->name('order.create');
Route::post('/pesan/{slug}', [OrderController::class, 'store'])->name('order.store');
Route::get('/pesanan/{order_code}', [OrderController::class, 'summary'])->name('order.summary');
Route::post('/pesanan/{order_code}/batal', [OrderController::class, 'cancel'])->name('order.cancel');

// Pengajuan Buket Personalisasi Custom
Route::get('/custom-bouquet', [CustomBouquetController::class, 'create'])->name('custom.create');
Route::post('/custom-bouquet', [CustomBouquetController::class, 'store'])->middleware('throttle:6,1')->name('custom.store');
Route::get('/custom-bouquet/sukses/{code}', [CustomBouquetController::class, 'success'])->name('custom.success');

// Konfirmasi Pembayaran Manual
Route::get('/pembayaran/{order_code}', [PaymentController::class, 'create'])->name('payment.create');
Route::post('/pembayaran/{order_code}', [PaymentController::class, 'store'])->middleware('throttle:5,1')->name('payment.store');

// Pelacakan Status Pesanan
Route::get('/lacak-pesanan', [TrackingController::class, 'index'])->name('tracking.index');
Route::get('/lacak-pesanan/{order_code}', [TrackingController::class, 'show'])->name('tracking.show');

// Halaman Informasi Statis Butik
Route::get('/tentang-kami', [StaticPageController::class, 'about'])->name('static.about');
Route::get('/kontak', [StaticPageController::class, 'contact'])->name('static.contact');

// ==========================================
// 2. RUTE OTENTIKASI ADMIN
// ==========================================

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->middleware('throttle:5,1')->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// ==========================================
// 3. RUTE DASHBOARD & OPERASIONAL ADMIN
// ==========================================

Route::prefix('admin')->middleware(['auth:admin'])->group(function () {
    // Dashboard Metrik
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Manajemen Master Produk
    Route::get('/produk', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/produk/tambah', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/produk', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/produk/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/produk/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::patch('/produk/{id}/toggle', [AdminProductController::class, 'toggleStatus'])->name('admin.products.toggle');
    Route::delete('/produk/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

    // Manajemen Kategori
    Route::get('/kategori', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/kategori', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('/kategori/{id}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/kategori/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Manajemen Pesanan & Status
    Route::get('/pesanan', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/pesanan/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/pesanan/{id}/status', [AdminOrderStatusController::class, 'update'])->name('admin.orders.update_status');

    // Manajemen Tiket Custom & Penentuan Harga (BR-007)
    Route::get('/custom-requests', [AdminCustomRequestController::class, 'index'])->name('admin.custom.index');
    Route::get('/custom-requests/{id}', [AdminCustomRequestController::class, 'show'])->name('admin.custom.show');
    Route::post('/custom-requests/{id}/pricing', [AdminCustomRequestController::class, 'setPrice'])->name('admin.custom.set_price');

    // Verifikasi Bukti Transfer Manual
    Route::get('/pembayaran', [AdminPaymentController::class, 'index'])->name('admin.payments.index');
    Route::patch('/pembayaran/{id}/verifikasi', [AdminPaymentController::class, 'verify'])->name('admin.payments.verify');
    Route::patch('/pembayaran/{id}/tolak', [AdminPaymentController::class, 'reject'])->name('admin.payments.reject');

    // Pengelolaan Pembatalan
    Route::get('/pembatalan', [AdminCancellationController::class, 'index'])->name('admin.cancellations.index');
    Route::patch('/pembatalan/{id}/proses', [AdminCancellationController::class, 'process'])->name('admin.cancellations.process');

    // Pengaturan Akun & Profil Toko
    Route::get('/pengaturan', [AdminSettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/pengaturan', [AdminSettingController::class, 'update'])->name('admin.settings.update');

    Route::get('/personalisasi', [AdminPersonalizationController::class, 'index'])->name('admin.personalization.index');
    Route::post('/personalisasi', [AdminPersonalizationController::class, 'store'])->name('admin.personalization.store');
    Route::post('/personalisasi/{optionId}/nilai', [AdminPersonalizationController::class, 'storeValue'])->name('admin.personalization.values.store');
    Route::delete('/personalisasi/{optionId}', [AdminPersonalizationController::class, 'destroy'])->name('admin.personalization.destroy');

    Route::get('/add-on', [AdminAddOnController::class, 'index'])->name('admin.addons.index');
    Route::post('/add-on', [AdminAddOnController::class, 'store'])->name('admin.addons.store');
    Route::delete('/add-on/{id}', [AdminAddOnController::class, 'destroy'])->name('admin.addons.destroy');
});

