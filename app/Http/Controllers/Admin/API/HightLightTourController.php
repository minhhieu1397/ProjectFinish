<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class HightLightTourController extends Controller
{
    public function showTourHighLight()
    {
        return Tour::where('tour_hot', 1)->get();
    }

    public function setTourHot($id, Request $request)
    {   
        $tour = Tour::find($id);
        $tour->update([
            
            'tour_hot' => $request->input('tour_hot'),
        ]);
    }
}
