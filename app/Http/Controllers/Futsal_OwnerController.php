<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Court;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;



class Futsal_OwnerController extends Controller
{
    public function dashboard()
    {
        return view('futsal_owner.dashboard');
    }

    public function manageCourts()
    {
        // Fetch all courts for the futsal owner (if you're showing the courts belonging to the current user)
        $courts = Court::all();

        // Return the manage_courts.blade.php view with the courts data
        return view('futsal_owner.pages.courts.manage_courts', compact('courts'));
    }

    public function indexCourts()
    {
        // Fetch all courts for the futsal owner (if you're showing the courts belonging to the current user)
        $courts = Court::all();

        // Return the manage_courts.blade.php view with the courts data
        return view('futsal_owner.pages.courts.index', compact('courts'));
    }

    public function events()
    {
        // Fetch all courts for the futsal owner (if you're showing the courts belonging to the current user)
        $events = Event::all();

        // Return the manage_courts.blade.php view with the courts data
        return view('futsal_owner.pages.events.event', compact('events'));
    }
    public function showNotifications()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in first.');
        }

        $user = Auth::user();

        // Fetch notifications
        $notifications = $user->notifications;

        return view('futsal_owner.pages.notifications.allnotification', compact('notifications'));
    }
}
