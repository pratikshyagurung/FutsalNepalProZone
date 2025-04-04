<?php

namespace App\Http\Controllers;

use App\Helpers\TimeslotHelper;
use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use function Termwind\style;

class CourtController extends Controller
{
    public function index()
    {
        if (!Auth::check() || Auth::user()->role !== 'futsal_owner') {
            return redirect()->route('login')->with('error', 'Access denied.');
        }

        $courts = Court::where('user_id', Auth::id())->paginate(10);
        return view('futsal_owner.pages.courts.index', compact('courts'));
    }



    public function create()
    {
        return view('futsal_owner.pages.courts.manage_courts');
    }

    public function store(Request $request)
    {

        $request->validate([
            'courtName' => 'required|string|max:255',
            'courtLocation' => 'required|string|max:255',
            // 'latitude' => 'required|numeric',
            // 'longitude' => 'required|numeric',
            'courtMap' => [
                'required',
                'url',
                function ($attribute, $value, $fail) {
                    if (
                        !str_contains($value, 'google.com/maps') &&
                        !str_contains($value, 'maps.app.goo.gl')
                    ) {
                        $fail('Please provide a valid Google Maps link');
                    }
                }
            ],
            'courtPrice' => 'required|numeric',
            'courtAvailability' => 'required|string|max:255',
            'courtService' => 'nullable|array',
            'courtService.*' => 'string',
            'courtDescription' => 'nullable|string',
            'courtImage' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Handle Image Upload
        $originalImageName = null;
        if ($request->hasFile('courtImage')) {
            $originalImageName = time() . '_' . $request->file('courtImage')->getClientOriginalName();
            $request->file('courtImage')->storeAs('uploads', $originalImageName, 'public');
        }

        Court::create([
            'user_id' => Auth::id(),
            'courtName' => $request->courtName,
            'courtLocation' => $request->courtLocation,
            // 'latitude' => $request->latitude,
            // 'longitude' => $request->longitude,
            'courtMap' => $request->courtMap,
            'courtPrice' => $request->courtPrice,
            'courtAvailability' => $request->courtAvailability,
            'courtService' => json_encode($request->courtService ?? []),
            'courtDescription' => $request->courtDescription,
            'image' => $originalImageName,
        ]);



        return redirect()->route('owner-courts.index')->with('success', 'Court added successfully!');
    }


    public function show($id)
    {
        $court = Court::findOrFail($id);


        if (Auth::check() && Auth::user()->role == 'futsal_owner') {
            return view('futsal_owner.pages.courts.view', compact('court'));
        } else {
            return view('user.pages.court-details', compact('court'));
        }
    }

    public function embedMap(Court $court)
    {
        return response()->json(['embed_url' => $court->getEmbedMapUrl()]);
    }


    public function edit($id)
    {
        $court = Court::findOrFail($id);
        return view('futsal_owner.pages.courts.edit_court', compact('court'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'courtName' => 'required|string|max:255',
            'courtLocation' => 'required|string|max:255',
            // 'latitude' => 'required|numeric',
            // 'longitude' => 'required|numeric',
            'courtMap' => 'required|url|max:255',
            'courtPrice' => 'required|numeric',
            'courtAvailability' => 'required|string|max:255',
            'courtService' => 'nullable|array',
            'courtService.*' => 'string',
            'courtDescription' => 'nullable|string',
            'courtImage' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        ]);

        $court = Court::findOrFail($id);

        // Serialize services
        $courtService = $request->courtService ? json_encode($request->courtService) : $court->courtService;

        // Handle image update
        if ($request->hasFile('courtImage')) {
            if ($court->image) {
                Storage::disk('public')->delete('uploads/' . $court->image);
            }
            $newImageName = time() . '_' . $request->file('courtImage')->getClientOriginalName();
            $request->file('courtImage')->storeAs('uploads', $newImageName, 'public');
            $court->image = $newImageName;
        }

        // Update court details
        $court->courtName = $request->courtName;
        $court->courtLocation = $request->courtLocation;
        // $court->latitude = $request->latitude;
        // $court->longitude = $request->longitude;
        $court->courtMap = $request->courtMap;
        $court->courtPrice = $request->courtPrice;
        $court->courtAvailability = $request->courtAvailability;
        $court->courtService = $courtService;
        $court->courtDescription = $request->courtDescription;

        $court->save();

        return redirect()->route('courts.index')->with('message', 'Court updated successfully.');
    }

    public function destroy($id)
    {
        $court = Court::findOrFail($id);

        // Delete image if exists
        if ($court->image) {
            Storage::disk('public')->delete('uploads/' . $court->image);
        }

        // Delete the court record
        $court->delete();

        return redirect()->route('courts.index')->with('message', 'Court deleted successfully.');
    }
}
