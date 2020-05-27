<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Detail;

class SetAmountController extends Controller
{
    public function setAmount($id, Request $request)
    {
        $people = $request->input('people');
        $detail_tour = Detail::where('tour_id', $id)->first();
        $detail_tour->amount = $detail_tour->amount + $people;
        $detail_tour->save();

        return response([
            'detail' => $detail_tour
        ], 200);
    }
}
