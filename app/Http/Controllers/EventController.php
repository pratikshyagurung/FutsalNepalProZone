<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    // Ensure Laravel finds the index method
    public function index()
    {
        $id = Auth::id();

        if (!$id) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $events = Event::where('user_id', $id)->paginate(10);

        return view('futsal_owner.pages.events.index', compact('events'));
    }

    public function create()
    {
        return view('futsal_owner.pages.events.manage_events');
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        $request->validate([
            'eventName' => 'required|string|max:255',
            'eventLocation' => 'required|string|max:255',
            'eventMap' => 'required|url|max:255',
            'eventPrice' => 'required|numeric',
            'eventService' => 'nullable|array',
            'eventService.*' => 'string',
            'eventDescription' => 'nullable|string',
            'eventImage' => 'nullable|mimes:png,jpg,jpeg|max:2048',

        ]);
        $eventService = $request->eventService ? json_encode($request->eventService) : null;
        // Handle image upload
        $originalImageName = null;
        if ($request->hasFile('eventImage')) {
            $originalImageName = time() . '_' . $request->file('eventImage')->getClientOriginalName();
            $request->file('eventImage')->storeAs('uploads', $originalImageName, 'public');
        }

        Event::create([
            'eventName' => $request->eventName,
            'eventLocation' => $request->eventLocation,
            'eventMap' => $request->eventMap,
            'eventPrice' => $request->eventPrice,
            'eventService' => $eventService,
            'eventDescription' => $request->eventDescription,
            'image' => $originalImageName,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('events.index')->with('message', 'Event added successfully.');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        if (Auth::check() && Auth::user()->role == 'futsal_owner') {
            return view('futsal_owner.pages.events.view', compact('event'));
        } else {
            return view('user.pages.event-details', compact('event'));
        }
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('futsal_owner.pages.events.edit_event', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'eventName' => 'required|string|max:255',
            'eventLocation' => 'required|string|max:255',
            'eventMap' => 'required|string|max:255',
            'eventPrice' => 'required|numeric',
            'eventService' => 'nullable|array',
            'eventService.*' => 'string',
            'eventDescription' => 'nullable|string',
            'eventImage' => 'nullable|mimes:png,jpg,jpeg|max:2048',

        ]);
        $event = Event::findOrFail($id);

        $eventService = $request->eventService ? json_encode($request->eventService) : $event->eventService;
        // Handle image update
        if ($request->hasFile('eventImage')) {
            if ($event->image) {
                Storage::disk('public')->delete('uploads/' . $event->image);
            }
            $newImageName = time() . '_' . $request->file('eventImage')->getClientOriginalName();
            $request->file('eventImage')->storeAs('uploads', $newImageName, 'public');
            $event->image = $newImageName;
        }

        $event->eventName = $request->eventName;
        $event->eventLocation = $request->eventLocation;
        $event->eventMap = $request->eventMap;
        $event->eventPrice = $request->eventPrice;
        $event->eventService = $eventService;
        $event->eventDescription = $request->eventDescription;

        $event->save();

        return redirect()->route('events.index')->with('message', 'Event updated successfully.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Delete image if exists
        if ($event->image) {
            Storage::disk('public')->delete('uploads/' . $event->image);
        }

        $event->delete();

        return redirect()->route('events.index')->with('message', 'Event deleted successfully.');
    }
}
