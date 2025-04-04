<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\CourtBooking;
use App\Models\TimeSlot;
use App\Models\User;
use App\Models\BookingStatusHistory;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CourtBookingController extends Controller
{
    public function index()
    {
        $courtbookings = CourtBooking::with(['court', 'user'])
            ->whereHas('court', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('futsal_owner.pages.bookings.courtbooking', compact('courtbookings'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Court_ID' => 'required|exists:courts,id',
            'totalPrice' => 'required|numeric',
        ]);

        $courtbooking = CourtBooking::create([
            'TotalPrice' => $validated['totalPrice'],
            'Court_ID' => $validated['Court_ID'],
            'Status' => 'pending',
            'Date' => now(),
            'User_ID' => Auth::id(),
        ]);

        // Keep using user.pages.checkout since that's what you want
        return redirect()->route('user.pages.checkout', ['id' => $courtbooking->id])
            ->with('success', 'Booking created successfully!');
    }
    public function show($id)
    {
        $courtbooking = CourtBooking::with(['court', 'user', 'timeSlots'])->findOrFail($id);

        if (Auth::user()->role === 'futsal_owner') {
            return view('futsal_owner.pages.bookings.courtBooking', compact('courtbooking'));
        }

        return view('user.pages.checkout', compact('courtbooking'));
    }


    public function destroy($id)
    {
        $courtbooking = CourtBooking::findOrFail($id);

        // Authorization check
        if (Auth::user()->role !== 'futsal_owner') {
            return back()->with('error', 'Unauthorized action');
        }

        // Detach time slots first
        $courtbooking->timeSlots()->detach();

        // Delete the booking
        $courtbooking->delete();

        return redirect()->route('futsal_owner.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }
}
