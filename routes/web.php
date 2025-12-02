<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware(['guest', 'no.cache']);

Route::view('/tentang', 'pages.tentang')->name('tentang');

Route::view('/bantuan', 'pages.bantuan')->name('bantuan');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public Event Routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Registration routes for users
    Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('/my-tickets', [RegistrationController::class, 'myTickets'])->name('registrations.my-tickets');
    Route::get('/tickets/{registration}', [RegistrationController::class, 'showTicket'])->name('registrations.show-ticket');
    Route::delete('/registrations/{registration}', [RegistrationController::class, 'cancel'])->name('registrations.cancel');
    
    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])->name('notifications.unread-count');
});

Route::middleware(['auth', 'verified', 'role:organizer,admin'])->prefix('organizer')->group(function () {
    Route::get('/events', [EventController::class, 'myEvents'])->name('events.my-events');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    
    // Participant and check-in routes
    Route::get('/events/{event}/participants', [RegistrationController::class, 'participants'])->name('registrations.participants');
    Route::get('/events/{event}/scan-qr', [RegistrationController::class, 'scanQr'])->name('registrations.scan-qr');
    Route::post('/check-in', [RegistrationController::class, 'checkIn'])->name('registrations.check-in');
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/events', [AdminController::class, 'events'])->name('admin.events');
    Route::post('/events/{event}/approve', [AdminController::class, 'approveEvent'])->name('admin.events.approve');
    Route::post('/events/{event}/reject', [AdminController::class, 'rejectEvent'])->name('admin.events.reject');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{user}/update-role', [AdminController::class, 'updateUserRole'])->name('admin.users.update-role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
});

require __DIR__.'/auth.php';
