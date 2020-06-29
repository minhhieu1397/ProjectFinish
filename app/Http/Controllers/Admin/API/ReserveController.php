<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;

class ReserveController extends Controller
{
    // public function store(Request $request)
    // {
    //     $jwt => $request->input('jwt'),
    //     $user = $request->input('user'),
    //     dd($jwt, $user);
    //     return Reserve::create([
    //         'tour_id' => $request->input('tour_id'),
    //         'tour_name' => $request->input('tour_name'),
    //         'booking_date' => $request->input('booking_date'),
    //         'people' => $request->input('people'),
    //         'email' => $request->input('email'),
    //         'address' => $request->input('address'),
    //         'phone' => $request->input('phone'),
    //         'note' => $request->input('note'),
    //     ]);
    // }

    // public function getAll($tour_id)
    // {
    //     return Reserve::where('tour_id',$tour_id)->get();
    // }

    // public function setStatus($id)
    // {
    //     $reserve = Reserve::find($id);
    //     $reserve->status = true;
    //     $reserve->save();
        
    //     return response([
    //         'reserve' => $reserve
    //     ], 200);
        
    // }
}
