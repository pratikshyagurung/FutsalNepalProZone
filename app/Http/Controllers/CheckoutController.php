<?php

namespace App\Http\Controllers;

use App\Models\CourtBooking;
use App\Models\EventBooking;
use App\Models\Court;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show($id)
    {
        // Try to find as court booking first
        $booking = CourtBooking::with(['court', 'user'])->find($id);
        $type = 'court';

        if (!$booking) {
            // If not court booking, try event booking
            $booking = EventBooking::with(['event', 'user'])->findOrFail($id);
            $type = 'event';
        }

        // Get the appropriate resource
        $resource = $type === 'court'
            ? Court::findOrFail($booking->Court_ID)
            : Event::findOrFail($booking->Event_ID);

        // Verify the booking belongs to the authenticated user
        if ($booking->User_ID !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        return view('user.pages.checkout', [
            'booking' => $booking,
            'resource' => $resource,
            'type' => $type
        ]);
    }
}
