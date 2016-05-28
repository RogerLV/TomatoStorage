<?php 

namespace App\Logic;

class Util
{
	public static function returnError($message)
	{
		echo json_encode([
			'status' => 'bad',
			'message' => $message
		]);
		exit;
	}
}