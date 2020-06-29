<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\JwtService;
use Carbon\Carbon;

class LoginController extends Controller
{
    protected $Jwt;

    public function __construct(JwtService $Jwt)
    {
        $this->Jwt = $Jwt; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_name = $request->input('user_name');
        $password = $request->input('password');
        if (Auth::guard('admin')->attempt(['user_name' => $user_name, 'password' => $password])) {
            $admin = Auth::guard('admin')->user();
            $header = $this->Jwt->HeaderJWT();
            $date = Carbon::now();
            $payload = array(
                "iss" => "Project Finish, From Hust",
                "iat"=> $date->toDateTimeString(),
                "exp"=> $date->addDays(29)->toDateTimeString(),
                "aud"=> "www.doan.com",
                "sub"=> "minhhieu97.hust@gmail.com",
                "GivenName"=> $user_name,
            );
            $PayLoadJwt = $this->Jwt->PayloadJWT($payload);

            $string = [
                $header,
                $PayLoadJwt
            ];
            $data = implode(".", $string);
            $signature = $this->Jwt->Signature($data);
            $Jwt = [
                $data,
                $signature
            ];
            $Jwt = implode(".", $Jwt);
            $admin->jwt = $Jwt;
            $admin->save();

            return response([
                'message' => 'Đăng nhập thành công',
                'result' => true,
                'jwt' => $Jwt,
            ], 200);
        } else {
            return response([
                'message' => 'Đăng nhập thất bại',
                'result' => false
            ]);
        }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
