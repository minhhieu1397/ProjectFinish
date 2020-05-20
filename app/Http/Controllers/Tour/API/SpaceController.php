<?php

namespace App\Http\Controllers\Tour\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Tour;

class SpaceController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        $place = Place::where('place', $search)->first();
        if ($place != null) {
            return Place::where('place', $search)->first()->tour;
        } else {
            return response()->json(['errorsFile' => 'Have errors'], 500);
        }
    }
}
