<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


        Route::get('/movies/{id}/book', [MovieController::class, 'showBookingPage'])->name('movies.book');
    Route::post('/movies/reserve', [MovieController::class, 'reserveSeat'])->name('movies.reserve');
    Route::get('/movies/proceed', [MovieController::class, 'proceed'])->name('movies.proceed');
    Route::post('/movies/confirm', [MovieController::class, 'confirmBooking'])->name('movies.confirm.booking');
    Route::get('/movies/print-ticket', [MovieController::class, 'printTicket'])->name('movies.print.ticket');
    Route::get('/dashboard', [MovieController::class, 'index'])->name('dashboard');
        Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/movies/book/{id}', [DashboardController::class, 'showBookingPage'])->name('movies.book');
    Route::post('/reserve-seat', [DashboardController::class, 'reserveSeat'])->name('reserve.seat');
    Route::get('/movies/proceed', [DashboardController::class, 'proceed'])->name('movies.proceed');
    Route::get('/movies/print-ticket/{booking_id}', [DashboardController::class, 'printTicket'])->name('movies.print.ticket');



// Route for showing the booking page
Route::get('/movies/{id}/book', [BookController::class, 'showBookingPage'])->name('movies.book');

// Route for reserving a seat
Route::post('/movies/reserve', [BookController::class, 'reserveSeat'])->name('movies.reserve');

// Route for proceeding with the booking
Route::get('/movies/proceed', [BookController::class, 'proceed'])->name('movies.proceed');

// Route for showing the confirmation page
Route::get('/movies/confirm-booking', [BookController::class, 'showConfirmBookingPage'])->name('confirm.booking.page');

// POST route for confirming the booking
Route::post('/movies/confirm-booking', [BookController::class, 'confirmBooking'])->name('movies.confirm.booking');

// Route for printing the ticket
Route::get('/movies/print-ticket/{booking_id}', [BookController::class, 'printTicket'])->name('movies.print.ticket');


    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/users', [AdminController::class, 'manageUsers'])->name('admin.manage-users');
    Route::get('admin/movies/create', [MovieController::class, 'create'])->name('admin.movies.create');
    Route::post('admin/movies', [MovieController::class, 'store'])->name('admin.movies.store');
    Route::get('admin/movies/{movie}/edit', [MovieController::class, 'edit'])->name('admin.movies.edit');
    Route::put('admin/movies/{movie}', [MovieController::class, 'update'])->name('admin.movies.update');
    Route::delete('admin/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
});

require __DIR__.'/auth.php';
