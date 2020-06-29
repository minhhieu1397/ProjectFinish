<?php

namespace App\Http\Controllers\AdminAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\checkJwt;
use App\Models\Detail;

class DetailController extends Controller
{
	protected $checkJwt;

    public function __construct(checkJwt $checkJwt)
    {
        $this->checkJwt = $checkJwt;
    }

    public function store(Request $request)
    {
    	$admin = $request->input('admin');
        $jwt = $request->input('jwt');

        if($this->checkJwt->checkJwt($admin, $jwt)) {
	    	Detail::create([
	            'tour_id' => $request->input('tour_id'),
	            'day_start' => $request->input('day_start'),
	            'day_end' => $request->input('day_end'),
	            'total' => $request->input('total'),
	            'amount' => 0,
	            'account' => $request->input('account'),
	            'description' => $request->input('description')
	        ]);
	    return response([
                    'auth' => true
                ], 200);
        } else {
            return response([
                'auth' => false
            ], 200);
        }
    }

    public function view(Request $request, $id)
    {
        return Detail::where('tour_id', $id)->get();
    }
}
