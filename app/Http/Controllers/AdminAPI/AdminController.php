<?php

namespace App\Http\Controllers\AdminAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ApiCreateRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\checkJwt;

class AdminController extends Controller
{
	protected $checkJwt;

    public function __construct(checkJwt $checkJwt)
    {
        $this->checkJwt = $checkJwt;
    }

    public function store(ApiCreateRequest $request)
    {
    	$admin = $request->input('admin');
        $jwt = $request->input('jwt');
        if($this->checkJwt->checkJwt($admin, $jwt)) {
	    	return Admin::create([
	            'user_name' => $request->input('user_name'),
	            'password' => Hash::make($request->input('password')),
	            'is_super_manager' => $request->input('is_super_manager'),
	        ]);
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

        if($this->checkJwt->checkJwt($admin, $jwt)) {
    		return Admin::all();
    	} else {
            return response([
                'auth' => false
            ], 200);
        }
    }

    public function update(Request $request, $id)
    {
    	$jwt = $request->input('jwt');
    	$adminCurrent = $request->input('admin');

    	if($this->checkJwt->checkJwt($adminCurrent, $jwt)) {
	    	$admin = Admin::find($id);

	        $admin->update([
	            'user_name' => $request->input('user_name'),
	            'is_super_manager' => $request->input('is_super_manager')
	        ]);

	        return response([
	            'admin' => $admin
	        ], 200);
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
	    	$admin = Admin::find($id);
        	$admin->delete();

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
