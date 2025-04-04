<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use App\Models\User;
use App\Models\BookingStatusHistory;
use App\Models\eventBooking;
use App\Notifications\BookingRequestedNotification;
use App\Notifications\BookingStatusNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;

class eventBookingController extends Controller
{
    public function index()
    {
        $eventbookings = EventBooking::with(['event', 'user'])
            ->whereHas('event', fn($query) => $query->where('user_id', Auth::id()))
            ->get();

        return view('futsal_owner.pages.bookings.eventBooking', compact('eventbookings'));
    }

    // Store new event booking
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Event_ID' => 'required|exists:events,id',
            'totalPrice' => 'required|numeric',
        ]);

        $booking = EventBooking::create([
            'TotalPrice' => $validated['totalPrice'],
            'Event_ID' => $validated['Event_ID'],
            'Status' => 'pending',
            'Date' => now(),
            'User_ID' => Auth::id(),
        ]);

        $event = Event::with('user')->find($validated['Event_ID']);
        $event->user->notify(new BookingRequestedNotification(Auth::user(), $booking->Date));

        // Keep using user.pages.checkout since that's what you want
        return redirect()->route('user.pages.checkout', ['id' => $booking->id])
            ->with('success', 'Booking created successfully!');
    }


    public function show($id)
    {
        $eventbookings = eventBooking::with(['event', 'user'])->findOrFail($id);

        if (Auth::user()->role === 'futsal_owner') {
            return view('futsal_owner.pages.bookings.eventbooking', compact('eventbookings'));
        }

        return view('user.pages.checkout', compact('eventbookings'));
    }

    public function destroy($Booking_ID)
    {
        $eventbookings = eventBooking::findOrFail($Booking_ID);

        if (Auth::user()->role !== 'futsal_owner') {
            return back()->with('error', 'Unauthorized action');
        }

        $eventbookings->delete();
        return redirect()->route('owner-bookings')->with('success', 'Booking deleted successfully');
    }

    public function showNotifications()
    {
        if (!Auth::check() || Auth::user()->role !== 'futsal_owner') {
            return redirect()->route('login')->with('error', 'Access denied.');
        }

        $notifications = Auth::user()->notifications;
        return view('futsal_owner.pages.notifications.allnotification', compact('notifications'));
    }

    // Additional methods for handling booking confirmations/cancellations
    public function confirmBooking($bookingId)
    {
        $eventbookings = eventBooking::with(['event', 'user'])->findOrFail($bookingId);

        // Check if the authenticated user is a futsal owner
        if (Auth::user()->role !== 'futsal_owner') {
            return back()->with('error', 'Unauthorized action');
        }

        // Update the booking status to 'confirmed'
        $eventbookings->update(['Status' => 'confirmed']);

        // Ensure the data for the status history is correct
        if ($eventbookings && Auth::check()) {
            // Debug: Check values before creating the record
            dd($eventbookings->id, Auth::id(), Auth::user()->name);  // Debugging line

            BookingStatusHistory::create([
                'booking_id' => $eventbookings->id,  // Valid booking ID
                'status' => 'confirmed',  // Correct status
                'changed_by' => Auth::id(),  // Valid user ID from Auth
                'notes' => 'Booking confirmed by ' . Auth::user()->name,  // Optional note
            ]);
        }

        // Notify the user about the status change
        $eventbookings->user->notify(new BookingStatusNotification(
            Auth::user(),
            'confirmed',
            $eventbookings->Date,
            $eventbookings->event->eventName,
            $eventbookings->id
        ));

        return redirect()->route('futsal_owner.notifications.allnotification')
            ->with('success', 'Booking confirmed successfully');
    }

    // Cancel booking method
    public function cancelBooking($bookingId)
    {
        $eventbookings = eventBooking::with(['event', 'user'])->findOrFail($bookingId);

        // Check if the authenticated user is a futsal owner
        if (Auth::user()->role !== 'futsal_owner') {
            return back()->with('error', 'Unauthorized action');
        }

        // Update the booking status to 'cancelled'
        $eventbookings->update(['Status' => 'cancelled']);

        // Debug: Check values before creating the record
        // dd($eventbookings->id, Auth::id(), Auth::user()->name);  

        // Create a new entry in the booking_status_histories table
        BookingStatusHistory::create([
            'booking_id' => $eventbookings->id,
            'status' => 'cancelled',
            'changed_by' => Auth::id(),
            'notes' => 'Booking cancelled by ' . Auth::user()->name,
        ]);

        // Notify the user about the status change
        $eventbookings->user->notify(new BookingStatusNotification(
            Auth::user(),
            'cancelled',
            $eventbookings->Date,
            $eventbookings->event->eventName,
            $eventbookings->id
        ));

        return redirect()->route('futsal_owner.notifications.allnotification')
            ->with('success', 'Booking cancelled successfully');
    }
}
