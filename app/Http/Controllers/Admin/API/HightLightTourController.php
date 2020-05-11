<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class HightLightTourController extends Controller
{
    public function showTourHighLight()
    {
        return Tour::all();
    }
}
