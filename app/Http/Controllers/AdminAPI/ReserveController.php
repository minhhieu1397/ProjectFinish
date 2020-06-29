<?php

namespace App\Http\Controllers\AdminAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Services\checkJwtUser;
use App\Http\Requests\CreateReserverRequest;

class ReserveController extends Controller
{
	protected $checkJwtUser;

    public function __construct(checkJwtUser $checkJwtUser)
    {
        $this->checkJwtUser = $checkJwtUser;
    }

	public function store(CreateReserverRequest $request)
    {
        $jwt = $request->input('jwt');
        $user = $request->input('user');
        if($this->checkJwtUser->checkJwtUser($user, $jwt)) {
            return Reserve::create([
                'tour_id' => $request->input('tour_id'),
                'tour_name' => $request->input('tour_name'),
                'booking_date' => $request->input('booking_date'),
                'people' => $request->input('people'),
                'email' => $request->input('email'),
                'status' => false,
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'note' => $request->input('note'),
            ]);
        } else {
            return response([
                'auth' => false
            ], 200);
        }
    }

    public function getAll($tour_id)
    {
        return Reserve::where('tour_id',$tour_id)->get();
    }

    public function setStatus($id)
    {
        $reserve = Reserve::find($id);
        $reserve->status = true;
        $reserve->save();

        return response([
            'reserve' => $reserve
        ], 200);
    }
}
