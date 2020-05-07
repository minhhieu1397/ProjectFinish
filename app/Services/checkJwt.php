<?php
namespace App\Services;
use App\Models\Admin;
use Carbon\Carbon;

class checkJwt 
{
        public function checkJwt($jwt, $admin)
        {
                $ad = Admin::whereuser_name($admin)->get();
                if($ad->jwt = $jwt) {
                        $data = explode('.', $jwt);
                        $result = base64_decode($data[1]);
                        $payload = json_decode($result, true);
                        $today = strtotime(Carbon::now());
                        $exp = strtotime($payload['exp']);

                        if ($today > $exp ) {
                                return false;
                        } else {
                                return true;
                        } 
                } else {
                        return false;
                }
                
        }
}