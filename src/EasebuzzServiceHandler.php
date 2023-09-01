<?php

namespace ScaleXY\Easebuzz;

use Exception;
use Illuminate\Support\Arr;
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

	public function makePOSTRequest($request_url, $request_payload, $hash_keys)
	{
		$payload["key"] = $this->key;
		$payload["hash"] = $this->generateHash(Arr::only($request_payload, $hash_keys));
		$resp = json_decode(json_encode(Http::post($request_url, $request_payload)->json()));
		if($resp->status)
			return $resp->data;
		throw new Exception($resp->message);
	}
}