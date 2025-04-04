<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Court;
use App\Models\Event;

use Illuminate\Support\Facades\DB;




use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $courts = Court::take(4)->get();
        $events = Event::take(4)->get();
        return view('user.pages.index', compact('courts', 'events'));
    }

    public function courts()
    {
        $courts = Court::all();
        $events = Event::all();
        return view('user.pages.courts', compact('courts', 'events'));
    }

    public function courtDetails($id)
    {
        $court = Court::find($id);

        if (!$court) {
            abort(404, 'Court not found');
        }

        return view('user.pages.court-details', compact('court'));
    }
    public function events()
    {
        $courts = Court::all();
        $events = Event::all();
        return view('user.pages.events', compact('courts', 'events'));
    }
    public function eventDetails($id)
    {
        $event = Event::find($id);

        if (!$event) {
            abort(404, 'Event not found');
        }

        return view('user.pages.event-details', compact('event'));
    }

    public function timeslots()
    {
        // $courts = Court::all();
        // $events = Event::all();
        return view('user.pages.timeslots');
    }

    public function location(Request $request)
    {
        if (!$request->ajax()) {
            return view('user.pages.location');
        }
        $courts = Court::select(['id', 'courtName'])
            ->when($request->long and $request->lat, function ($query) use ($request) {
                $query->addSelect(DB::raw("ST_Distance_Sphere(
                POINT('$request->long', '$request->lang'), POINT(longitude, latitude
                )) as distance"))
                    ->orderBy('distance');
            })
            ->when($request->courtName, function ($query, $courtName) {
                $query->where('courts.name', 'like', "%{$courtName}%");
            })
            ->take(9)
            ->get();

        return response()->json([
            'courts' => $courts,
        ]);
    }

    // public function showNotifications()
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login')->with('error', 'You need to log in first.');
    //     }

    //     $user = Auth::user();

    //     // Fetch notifications
    //     $notifications = $user->notifications;

    //     return view('user.pages.notification', compact('notifications'));
    // }
}
