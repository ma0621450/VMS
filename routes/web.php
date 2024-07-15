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
Route::get('/', [UserController::class, 'create'])->name('user.home');
Route::get('/package/single/{id}', [UserController::class, 'show'])->name('package.show');
Route::get('/user/inquiry', [UserController::class, 'inquiries'])->name('user.inquiry');
Route::post('/user/inquiry/{id}', [UserController::class, 'inquiry'])->name('user.inquiry.create');
Route::delete('/user/inquiry/{id}', [UserController::class, 'deleteInquiry'])->name('user.inquiry.delete');
Route::get('/user/bookings', [UserController::class, 'bookings'])->name('user.bookings');
Route::post('/package/book/{id}', [UserController::class, 'book'])->name('package.book');
Route::delete('/user/bookings/{id}', [UserController::class, 'deleteBooking'])->name('package.booking.delete');
Route::view('/profile', 'customer.profile');
Route::post('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');


//travel agency
Route::get('/agency/packages', [TravelAgencyController::class, 'create'])->name('agency.packages');
Route::post('/agency/packages', [TravelAgencyController::class, 'store'])->name('agency.packages.store');
Route::get('/package/{id}', [TravelAgencyController::class, 'edit'])->name('package.edit');
Route::put('/package/{id}', [TravelAgencyController::class, 'update'])->name('agency.packages.update');
Route::delete('/packages/{vp_id}', [TravelAgencyController::class, 'destroy'])->name('package.destroy');

Route::get('/agency/bookings', [TravelAgencyController::class, 'getBookings'])->name('agency.bookings');
Route::delete('/agency/bookings/{id}', [TravelAgencyController::class, 'cancelBookings'])->name('agency.booking.cancel');
Route::get('/agency/inquiry', [TravelAgencyController::class, 'getInquiries'])->name('agency.inquiries');
Route::post('/agency/inquiry/respond', [TravelAgencyController::class, 'respondToInquiry'])->name('agency.inquiry.respond');
Route::get('/agency/profile', [TravelAgencyController::class, 'showProfileForm'])->name('agency.profile');
Route::post('/agency/profile', [TravelAgencyController::class, 'updateProfile'])->name('agency.profile.update');
Route::put('/agency/password', [TravelAgencyController::class, 'updatePassword'])->name('agency.password.update');



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



