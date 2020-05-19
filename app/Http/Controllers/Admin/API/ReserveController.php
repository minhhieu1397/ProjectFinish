<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;

class ReserveController extends Controller
{
    public function store(Request $request)
    {
        return Reserve::create([
            'tour_id' => $request->input('tour_id'),
            'booking_date' => $request->input('booking_date'),
            'children' => $request->input('children'),
            'adults' => $request->input('adults'),
            'phone' => $request->input('phone'),
            'note' => $request->input('note'),
        ]);
    }
}
