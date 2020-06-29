<?php
namespace App\Services;
use App\Models\User;
use Carbon\Carbon;

class checkJwtUser
{
	public function checkJwtUser($user, $jwt)
	{
		$ad = User::where('name', $user)->first();
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