<?php

namespace App\Http\Controllers\AdminAPI;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tour\CreateTourRequest;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Services\checkJwt;

class TourController extends Controller
{
    protected $checkJwt;

    public function __construct(checkJwt $checkJwt)
    {
        $this->checkJwt = $checkJwt;
    }

    public function store(CreateTourRequest $request)
    {
        $admin = $request->input('admin');
        $jwt = $request->input('jwt');
        if($this->checkJwt->checkJwt($admin, $jwt)) {
            if ($request->hasFile('img')) {
                $imageName = time().'.'.$request->img->getClientOriginalExtension();
                $request->img->move(public_path('image\tour'), $imageName);

                Tour::create([
                    'tour_name' => $request->input('tour_name'),
                    'vehicle' => $request->input('vehicle'),
                    'departure' => $request->input('departure'),
                    'day_night' => $request->input('day_night'),
                    'price' => $request->input('price'),
                    'note' => $request->input('note'),
                    'img' => $imageName,
                    'place_id' => $request->input('place_id'),
                ]);

                return response([
                    'auth' => true
                ], 200);
            } else {
                return response()->json(['errorsFile' => 'Have errors'], 500);
            }
        } else {
            return response([
                'auth' => false
            ], 200);
        }
    }

    public function view(Request $request)
    {
    	$jwt = $request->input('jwt');
    	$admin = $request->input('admin');

    	return Tour::all();
    }

    public function destroy(Request $request, $id)
    {
    	$jwt = $request->input('jwt');
    	$adminCurrent = $request->input('admin');

    	if($this->checkJwt->checkJwt($adminCurrent, $jwt)) {
	    	$tour = Tour::find($id);
        	$tour->delete();

	        return response([
	            'result' => 'success'
	        ], 200);
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
            $tour = Tour::find($id);
            $tour->update([
                'tour_name' => $request->input('tour_name'),
                'vehicle' => $request->input('vehicle'),
                'departune' => $request->input('departune'),
                'day_night' => $request->input('day_night'),
                'price' => $request->input('price'),
                'note' => $request->input('note'),
                'place_id' => $request->input('place_id'),
            ]);
        } else {
            return response([
                'auth' => false
            ], 200);
        }
        
        return response([
            'tour' => $tour
        ], 200);
    }
}
