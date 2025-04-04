<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\Event;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        // Get top 4 courts and events
        $courts = Court::take(4)->get();
        $events = Event::take(4)->get();

        return view('user.pages.index', compact('courts', 'events'));
    }

    public function court()
    {
        return view('user.pages.courts', compact('courts'));
    }

    public function event()
    {
        return view('user.events');
    }

    public function timeslot()
    {
        return view('user.timeslots');
    }

    public function location()
    {
        return view('user.location');
    }

    public function aboutUs()
    {
        return view('user.aboutus');
    }

    public function contactUs()
    {
        return view('user.contactus');
    }
}
