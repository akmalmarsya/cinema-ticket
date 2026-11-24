<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPemesananController;
use App\Http\Controllers\AdminPembayaranController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FilmDetailController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerDashboardController;

// HOMEPAGE PENGUNJUNG
Route::get('/', [
    HomeController::class,
    'index'
])->name('home');

// DETAIL FILM
Route::get('/film/{film}', [
    FilmDetailController::class,
    'show'
])->name('films.show');


// CUSTOMER AUTHENTICATION

Route::prefix('customer')
    ->name('customer.')
    ->group(function () {

        // Login
        Route::get('/login', [
            CustomerAuthController::class,
            'showLogin'
        ])->name('login');

        Route::post('/login', [
            CustomerAuthController::class,
            'login'
        ])->name('login.process');

        // Register
        Route::get('/register', [
            CustomerAuthController::class,
            'showRegister'
        ])->name('register');

        Route::post('/register', [
            CustomerAuthController::class,
            'register'
        ])->name('register.process');

        // Halaman khusus customer
        Route::middleware('customer')->group(function () {

            Route::get('/dashboard', [
                CustomerDashboardController::class,
                'index'
            ])->name('dashboard');

            Route::post('/logout', [
                CustomerAuthController::class,
                'logout'
            ])->name('logout');

        });

    });

// BOOKING DAN PEMBAYARAN
Route::prefix('booking')
    ->name('booking.')
    ->group(function () {

        Route::post('/pilih-jadwal', [
            BookingController::class,
            'selectSchedule'
        ])->name('schedule.select');

        /*
        | SELURUH PROSES BOOKING CUSTOMER
        */

        Route::middleware('customer')->group(function () {

            // Pemilihan kursi
            Route::get('/pilih-kursi', [
                BookingController::class,
                'showSeats'
            ])->name('seats');

            Route::post('/pilih-kursi', [
                BookingController::class,
                'storeSeats'
            ])->name('store-seats');


            // Data pemesan
            Route::get('/data-pemesan', [
                BookingController::class,
                'showCustomer'
            ])->name('customer');

            Route::post('/simpan', [
                BookingController::class,
                'storeBooking'
            ])->name('store');


            // Konfirmasi booking
            Route::get('/berhasil/{kode_booking}', [
                BookingController::class,
                'showSuccess'
            ])->name('success');


            // Ringkasan pembayaran
            Route::get('/ringkasan-pembayaran/{kode_booking}', [
                PaymentController::class,
                'summary'
            ])->name('payment.summary');


            // Pilihan metode pembayaran
            Route::get('/metode-pembayaran/{kode_booking}', [
                PaymentController::class,
                'methods'
            ])->name('payment.methods');

            Route::post('/metode-pembayaran/{kode_booking}', [
                PaymentController::class,
                'storeMethod'
            ])->name('payment.store-method');


            // Simulasi pembayaran
            Route::get('/proses-pembayaran/{kode_booking}', [
                PaymentController::class,
                'showSimulation'
            ])->name('payment.process');

            Route::post('/proses-pembayaran/{kode_booking}', [
                PaymentController::class,
                'simulate'
            ])->name('payment.simulate');


            // E-Ticket milik customer
            Route::get('/e-ticket/{kode_booking}', [
                PaymentController::class,
                'tickets'
            ])->name('tickets.index');

        });

        /*
        | VERIFIKASI QR CODE
        | Tetap publik agar petugas dapat memindai tiket.
        */

        Route::get('/tiket/{kode_tiket}', [
            PaymentController::class,
            'ticketDetail'
        ])->name('ticket.show');

    });

// AUTHENTICATION ADMIN
Route::get('/admin/login', [
    AdminAuthController::class,
    'showLogin'
])->name('admin.login');

Route::post('/admin/login', [
    AdminAuthController::class,
    'login'
])->name('admin.login.process');

// HALAMAN ADMINISTRATOR
Route::prefix('admin')
    ->name('admin.')
    ->middleware('admin')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [
            AdminDashboardController::class,
            'index'
        ])->name('dashboard');

        // Logout
        Route::post('/logout', [
            AdminAuthController::class,
            'logout'
        ])->name('logout');

        // Manajemen Film
        Route::resource('films', FilmController::class)
            ->except(['show']);

        // Manajemen Studio
        Route::resource('studios', StudioController::class)
            ->except(['show']);

        // Manajemen Jadwal
        Route::resource('jadwals', JadwalController::class)
            ->except(['show']);

        // Manajemen Pemesanan
        Route::resource('pemesanans', AdminPemesananController::class)
            ->only(['index', 'show']);

        // Manajemen Pembayaran
        Route::resource('pembayarans', AdminPembayaranController::class)
            ->only(['index', 'show']);

    });