<?php

namespace App\Http\Controllers;

use App\Models\Court;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LocationController extends Controller
{
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
}
