<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Futsal_OwnerController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\FutsalOwnerController;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\courtBookingController;

use App\Http\Controllers\eventBookingController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


use App\Models\Court;

use App\Http\Controllers\LocationController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index']);
Route::get('court', [FrontendController::class, 'court']);
Route::get('event', [FrontendController::class, 'event']);
Route::get('timeslot', [FrontendController::class, 'timeslot']);
Route::get('location', [FrontendController::class, 'location']);
Route::get('aboutus', [FrontendController::class, 'aboutus']);
Route::get('contactus', [FrontendController::class, 'contactus']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Group routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes for admin users
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
});

// Routes for futsal_owner users
Route::middleware(['auth', 'role:futsal_owner'])->group(function () {
    Route::get('/futsal_owner/dashboard', [Futsal_OwnerController::class, 'dashboard']);
    // Route to manage courts
    Route::get('/owner-courts', [CourtController::class, 'ownerCourts'])->name('futsal_owner.courts');
    Route::resource('owner-courts', CourtController::class);
    // Route to manage events
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::resource('events', EventController::class);
    //Route to manage bookings
    // Route::get('owner-allbooking', [eventBookingController::class, 'allbooking'])->name('owner-allbooking');
    // Route::get('owner-courtbookings', [eventBookingController::class, 'index'])->name('owner-eventbookings');


    // Event Bookings
    Route::get('/bookings', [EventBookingController::class, 'index'])
        ->name('eventbookings');

    // Court Bookings
    Route::get('/bookings.courtbooking', [courtBookingController::class, 'index'])
        ->name('courtbookings');

    Route::post('/courtbookings/{booking}/update-status', [courtBookingController::class, 'updateStatus'])
        ->name('courtbookings.updateStatus');

    // Notifications
    Route::get('/notifications', [EventBookingController::class, 'showNotifications'])->name('notifications');



    //notification
    // Notification Routes for futsal_owner
    // Route::get('/futsal_owner/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    // Route::post('/futsal_owner/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

    Route::get('/notifications', [eventBookingController::class, 'showNotifications'])
        ->name('futsal_owner.notifications.allnotification');


    Route::get('/notifications', [NotificationController::class, 'index'])->name('futsal_owner.notifications.allnotification');
    Route::post('/notifications/confirm/{notificationId}', [NotificationController::class, 'confirm'])->name('futsal_owner.notifications.confirm');
    Route::delete('/notifications/cancel/{notification}', [NotificationController::class, 'cancel'])->name('futsal_owner.notifications.cancel');


    //MAPS
    Route::get('/courts/{court}/embed-map', function (Court $court) {
        return response()->json(['embed_url' => $court->getEmbedMapUrl()]);
    });
    Route::get('/courts/{court}/embed-map', [CourtController::class, 'embedMap']);
});

// Routes for normal users
Route::middleware(['auth', 'role:user'])->group(function () {
    // Add route for Index of Court Management
    Route::get('user.pages.index', [UserController::class, 'index'])->name('user.index');

    Route::get('user.pages.courts', [UserController::class, 'courts'])->name('user.courts');
    Route::get('user/pages/court-details/{id}', [UserController::class, 'courtDetails'])->name('user.courtDetails');

    Route::get('user.pages.events', [UserController::class, 'events'])->name('user.events');
    Route::get('user.pages.event-details/{id}', [UserController::class, 'eventDetails'])->name('user.eventDetails');

    Route::get('user.pages.timeslots', [UserController::class, 'timeslots'])->name('user.timeslots');

    Route::get('user.pages.location', [UserController::class, 'location'])->name('user.location');

    Route::post('booking', [eventBookingController::class, 'store'])->name('booking.store');

    // Checkout route
    Route::get('/checkout/{id}', [CheckoutController::class, 'show'])->name('user.pages.checkout');




    Route::get('/notifications/mark-as-read/{id}', function ($id) {
        $notification = Auth::user()->notifications->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    })->name('notifications.markAsRead');
});


// Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Route for managing courts (CRUD operations)
Route::resource('courts', CourtController::class);
Route::resource('events', EventController::class);
Route::resource('bookings', eventBookingController::class);




require __DIR__ . '/auth.php';
