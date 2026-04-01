<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Customer
    Route::get('/customer/cetak-pdf', [CustomerController::class, 'cetakPdf'])->name('customer.cetak-pdf');
    Route::post('/customer/ajax-store', [CustomerController::class, 'ajaxStore'])->name('customer.ajaxStore'); // Pindahkan ke sini
    Route::resource('customer', CustomerController::class);

    // Service
    Route::get('/service/cetak-pdf', [ServiceController::class, 'cetakPdf'])->name('service.cetak-pdf');
    Route::resource('service', ServiceController::class);

    // Member
    Route::get('/member/cetak-pdf', [MemberController::class, 'cetakPdf'])->name('member.cetak-pdf');
    Route::resource('member', MemberController::class);

    // Transaksi
    Route::resource('transaksi', TransaksiController::class);
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
