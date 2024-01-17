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
	}
	public function makePOSTRequestType02($request_url, $request_payload, $hash_keys)
	{
		$request_payload["key"] = $this->key;
		$headers = [
			"Authorization" => $this->generateHash(array_values(Arr::only($request_payload, $hash_keys))),
		];
		$resp = Http::withHeaders($headers)
			->post($request_url, $request_payload)
			->json();
		$resp = json_decode(json_encode($resp));
		if (!$resp->success)
			throw new Exception($resp->message);
		return $resp;
	}

	public static function easebuzzAmountFormating($amount): string
	{
		$amount = $amount;
		if (round(($amount * 100), 0) % 100 == 0)
			return ((string)floor($amount)) . ".0";
		if (round(($amount * 100), 0) % 10 == 0)
			return ((string)$amount) . "0";
		return (string)$amount;
	}
}
