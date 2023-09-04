<?php

namespace ScaleXY\Easebuzz;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class EasebuzzServiceHandler
{
	public $key;
	public $salt;

	public function __construct($key, $salt)
	{
		$this->key = $key;
		$this->salt = $salt;
	}

	public function generateHash($hash_params = [])
	{
		return hash("sha512", $this->key . "|" . implode("|", $hash_params) . "|" . $this->salt);
	}

	public function makePOSTRequestType01($request_url, $request_payload, $hash_keys)
	{
		// $request_payload["hash"] = $this->generateHash(array_values(Arr::only($request_payload, $hash_keys)));
		// $resp = Http::post($request_url, $request_payload)
		// 	->json();
		// $resp = json_decode(json_encode($resp));
		// if($resp->status)
		// 	return $resp->data;
		// throw new Exception($resp->message);
	}
	public function makePOSTRequestType02($request_url, $request_payload, $hash_keys)
	{
		$request_payload["key"] = $this->key;
		$headers = [
			// "WIRE-API-KEY" => $this->key,
			"Authorization" => $this->generateHash(array_values(Arr::only($request_payload, $hash_keys))),
		];
		$resp = Http::withHeaders($headers)
			->post($request_url, $request_payload)
			->json();
		$resp = json_decode(json_encode($resp));
		// Log::warning($request_url);
		// Log::warning(json_encode($headers));
		// Log::warning(json_encode($request_payload));
		// Log::warning(json_encode($resp));
		if(!$resp->success)
			throw new Exception($resp->message);
		return $resp->data->virtual_account;
	}

	public static function fuckNutsAmountFormating($amount): string
	{
		$amount = $amount;
		if(round(($amount * 100), 0) % 100 == 0)
			return ((string)floor($amount)) . ".0";
		if(round(($amount * 100), 0) % 10 == 0)
			return ((string)$amount) . "0";
		return (string)$amount;
	}
}