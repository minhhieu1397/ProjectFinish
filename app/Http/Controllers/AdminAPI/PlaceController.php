<?php

namespace App\Http\Controllers\AdminAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\checkJwt;
use App\Models\Place;

class PlaceController extends Controller
{
	protected $checkJwt;

    public function __construct(checkJwt $checkJwt)
    {
        $this->checkJwt = $checkJwt;
    }

    public function view(Request $request)
    {
    	return Place::all();
    }

    public function store(Request $request)
    {
    	$admin = $request->input('admin');
        $jwt = $request->input('jwt');
        if($this->checkJwt->checkJwt($admin, $jwt)) {
	    	return Place::create([
            'place' => $request->input('place'),
        	]);
	    } else {
            return response([
                'auth' => false
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
    	$admin = $request->input('admin');
        $jwt = $request->input('jwt');
        if($this->checkJwt->checkJwt($admin, $jwt)) {
        	$place = Place::find($id);
	        $place->update([
	            'place' => $request->input('place')
	        ]);

	        return $place;
        } else {
            return response([
                'auth' => false
            ], 200);
        }
    }

    public function destroy(Request $request, $id)
    {
    	$jwt = $request->input('jwt');
    	$adminCurrent = $request->input('admin');
    	if($this->checkJwt->checkJwt($adminCurrent, $jwt)) {
	    	$place = Place::find($id);
        	$place->delete();

	        return response([
	            'result' => 'success'
	        ], 200);
	    } else {
            return response([
                'auth' => false
            ], 200);
        }
    }
}
