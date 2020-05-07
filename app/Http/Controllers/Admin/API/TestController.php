<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Services\checkJwt;

class TestController extends Controller
{
    protected $checkJwt;

    public function __construct(checkJwt $checkJwt)
    {
        $this->checkJwt = $checkJwt; 
    }

    public function get(Request $request)
    {
        $jwt = $request->input('jwt');
        $admin = $request->input('admin');

        if($this->checkJwt->checkJwt($admin, $jwt)) {
            return Tour::all();
        } else {
            return response([
                'auth' => false
            ], 200);
        }
    }
}
