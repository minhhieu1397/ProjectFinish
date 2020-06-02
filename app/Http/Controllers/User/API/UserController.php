<?php

namespace App\Http\Controllers\User\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\JwtService;
use Carbon\Carbon;

class UserController extends Controller
{
    protected $Jwt;

    public function __construct(JwtService $Jwt)
    {
        $this->Jwt = $Jwt; 
    }

    public function register(Request $request)
    {
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'phone' => $request->input('phone'),
        ]);
    }

    public function login(Request $request)
    {
        $phone = $request->input('phone');
        $password = $request->input('password');
        if (Auth::attempt(['phone' => $phone, 'password' => $password])) {
            
            $user = User::where('phone', $phone)->first();
            $header = $this->Jwt->HeaderJWT();
            $date = Carbon::now();
            $payload = array(
                "iss" => "Project Finish, From Hust",
                "iat"=> $date->toDateTimeString(),
                "exp"=> $date->addDays(29)->toDateTimeString(),
                "aud"=> "www.doan.com",
                "sub"=> "minhhieu97.hust@gmail.com",
                "GivenName"=> $user->name,
                "Surname"=> "Rocket",
                "Email"=> $user->email
            );
            $PayLoadJwt = $this->Jwt->PayloadJWT($payload);

            $string = [
                $header,
                $PayLoadJwt
            ];
            $data =  implode(".", $string);
            $signature = $this->Jwt->Signature($data);
            $Jwt = [
                $data,
                $signature
            ];
            $Jwt =  implode(".", $Jwt);
            $user->jwt = $Jwt;
            $user->save();
            return response([
                'message' => 'Đăng nhập thành công',
                'result' => true,
                'jwt' => $Jwt,
                'name_user' => $user->name
            ], 200);
        } else {
            return response([
                'message' => 'Đăng nhập thất bại',
                'result' => false
            ]);
        }
    }
}
