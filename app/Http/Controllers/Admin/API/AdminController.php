<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ApiCreateRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Admin::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiCreateRequest $request)
    {
        $s = $request->input('user_name');
        $admin = Auth::guard('admin')->user();
        
        $admin = Admin::find(1);
        $abc = $this->base64($s, $admin);
        
        return Admin::create([
            'user_name' => $request->input('user_name'),
            'password' => \Hash::make($request->input('password')),
            'is_super_manager' => $request->input('is_super_manager'),
        ]);
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        
        $admin->update([
            'user_name' => $request->input('user_name'),
            'is_super_manager' => $request->input('is_super_manager')
        ]);

        return response([
            'admin' => $admin
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);
        $admin->delete();

        return response([
            'result' => 'success'
        ], 200);
    }
}
