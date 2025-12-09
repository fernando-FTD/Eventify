<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $events = \App\Models\Event::with('organizer')
        ->approved()
        ->orderBy('tanggal', 'asc')
        ->take(6)
        ->get();
    return view('welcome', compact('events'));
})->middleware(['guest', 'no.cache']);

Route::view('/tentang', 'pages.tentang')->name('tentang');

Route::view('/bantuan', 'pages.bantuan')->name('bantuan');

Route::get('/dashboard', function () {
    $events = \App\Models\Event::with('organizer')
        ->approved()
        ->where('tanggal', '>=', now())
        ->orderBy('tanggal', 'asc')
        ->take(6)
        ->get();
    
    // Data untuk user biasa
    $myTickets = [];
    $myEvents = [];
    
    if (auth()->user()->role === 'user') {
        $myTickets = \App\Models\Registration::with('event')
            ->where('user_id', auth()->id())
            ->where('status', 'registered')
            ->latest()
            ->take(3)
            ->get();
    }
    
    // Data untuk organizer
    if (auth()->user()->role === 'organizer') {
        $myEvents = \App\Models\Event::where('organizer_id', auth()->id())
            ->latest()
            ->take(3)
            ->get();
    }
    
    return view('dashboard', compact('events', 'myTickets', 'myEvents'));
})->middleware(['auth'])->name('dashboard');

// Public Event Routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('google.callback');

Route::middleware(['auth'])->group(function () {
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

Route::middleware(['auth', 'role:organizer,admin'])->prefix('organizer')->group(function () {
    Route::get('/events', [EventController::class, 'myEvents'])->name('organizer.events');
    Route::get('/events/create', [EventController::class, 'create'])->name('organizer.events.create');
    Route::post('/events', [EventController::class, 'store'])->name('organizer.events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('organizer.events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('organizer.events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('organizer.events.destroy');
    
    // Participant and check-in routes
    Route::get('/events/{event}/participants', [RegistrationController::class, 'participants'])->name('organizer.events.participants');
    Route::get('/events/{event}/scan-qr', [RegistrationController::class, 'scanQr'])->name('organizer.events.scan-qr');
    Route::post('/check-in', [RegistrationController::class, 'checkIn'])->name('organizer.check-in');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/events', [AdminController::class, 'events'])->name('admin.events');
    Route::put('/events/{event}/approve', [AdminController::class, 'approveEvent'])->name('admin.events.approve');
    Route::put('/events/{event}/reject', [AdminController::class, 'rejectEvent'])->name('admin.events.reject');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::put('/users/{user}/role', [AdminController::class, 'updateUserRole'])->name('admin.users.update-role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.destroy');
});

require __DIR__.'/auth.php';
