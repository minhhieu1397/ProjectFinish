<?php

namespace App\Http\Controllers\Tour\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Space;

class SpaceController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        return Space::find(1)->tour()->where('place', $search)->get();
    }
}
