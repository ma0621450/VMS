<?php

use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TravelAgencyController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('/login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);


//customers
Route::get('/', [UserController::class, 'create']);
Route::get('/package/single/{id}', [UserController::class, 'show'])->name('package.show');
Route::post('/package/book/{id}', [UserController::class, 'book'])->name('package.book');
Route::post('/user/inquiry/{id}', [UserController::class, 'inquiry'])->name('user.inquiry');
Route::get('/user/inquiry', [UserController::class, 'inquiries'])->name('user.inquiry');
Route::get('/user/bookings', [UserController::class, 'bookings'])->name('user.bookings');

Route::get('/bookings', function () {
    return view('customer.bookings');
});
Route::get('/inquiry', function () {
    return view('customer.inquiry');
});
Route::get('/profile', function () {
    return view('customer.profile');
});
// Route::get('/package', function () {
//     return view('customer.package');
// });

//travel agency
Route::get('/agency/packages', [TravelAgencyController::class, 'create'])->name('agency.packages');
Route::post('/agency/packages', [TravelAgencyController::class, 'store'])->name('agency.packages.store');
Route::get('/package/{id}', [TravelAgencyController::class, 'edit'])->name('package.edit');
Route::put('/package/{id}', [TravelAgencyController::class, 'update'])->name('agency.packages.update');
Route::delete('/packages/{vp_id}', [TravelAgencyController::class, 'destroy'])->name('package.destroy');

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



