<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'customer.home');

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('/login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

//customers
Route::get('/bookings', function () {
    return view('customer.bookings');
});
Route::get('/inquiry', function () {
    return view('customer.inquiry');
});
Route::get('/profile', function () {
    return view('customer.profile');
});
Route::get('/package', function () {
    return view('customer.package');
});

//travel agency

Route::get('/agency/packages', function () {
    return view('agency.packages');
});
Route::get('/agency/bookings', function () {
    return view('agency.bookings');
});
Route::get('/agency/inquiry', function () {
    return view('agency.inquiry');
});
Route::get('/agency/profile', function () {
    return view('agency.profile');
});



//admin
Route::get('/admin', function () {
    return view('admin.users');
});
Route::get('/admin/services', function () {
    return view('admin.services');
});
Route::get('/admin/destinations', function () {
    return view('admin.destinations');
});



