<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Public Routes (Shared Functionalities)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome'); // Landing Page
})->name('home');


Route::get('/marketplace', [CarController::class, 'index'])->name('cars.index');
Route::get('/marketplace/{car}', [CarController::class, 'show'])->name('cars.show');


Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Car Actions (Post, Deactivate)
    Route::get('/cars/create', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
    Route::post('/cars/{car}/deactivate', [CarController::class, 'deactivate'])->name('cars.deactivate');

    // Bidding & Appointments (Interactions)
    Route::post('/cars/{car}/bid', [BidController::class, 'store'])->name('bids.store');
    Route::post('/cars/{car}/appointment', [AppointmentController::class, 'store'])->name('appointments.store');
});


Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::patch('/users/{id}/promote', [AdminController::class, 'promoteUser'])->name('users.promote');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');

    // Car Moderation
    Route::get('/cars', [AdminController::class, 'cars'])->name('cars');
    Route::patch('/cars/{id}/status', [AdminController::class, 'updateCarStatus'])->name('cars.update');

    // Transaction & Appointment Finalization
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('appointments');
    Route::patch('/appointments/{id}/status', [AdminController::class, 'updateAppointmentStatus'])->name('appointments.update');

    Route::get('/inquiries', [AdminController::class, 'inquiries'])->name('inquiries');
    Route::delete('/inquiries/{id}', [AdminController::class, 'deleteInquiry'])->name('inquiries.delete');
});

require __DIR__ . '/auth.php';
