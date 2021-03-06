<?php
namespace App\Services;
use App\Models\Admin;
use Carbon\Carbon;

class checkJwt
{
	public function checkJwt($admin, $jwt)
	{
		$ad = Admin::where('user_name', $admin)->first();
		if($ad !== null) {
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
		} else {
			return false;
		}
	}
}