<?php

namespace ScaleXY\Easebuzz;

class Payouts
{
	const base_path = "https://wire.easebuzz.in";
	// const base_path = "https://stoplight.io/mocks/easebuzz/neobanking/90373567";

	public $client;

	public function __construct($key, $salt)
	{
		$this->client = new EasebuzzServiceHandler($key, $salt);
	}

	public function InitiatePayout($virtual_account_number, $beneficiary_code, $uuid, $payment_mode, $amount)
	{
		$path = "/api/v1/transfers/initiate/";
		return $this->client->makePOSTRequestType02(self::base_path . $path, [
			"virtual_account_number" => $virtual_account_number,
			"beneficiary_code" => $beneficiary_code,
			"unique_request_number" => substr($uuid, 0, 8) . substr($uuid, 9, 4) . substr($uuid, 14, 4) . substr($uuid, 19, 4) . substr($uuid, 24, 12),
			"payment_mode" => $payment_mode,
			"amount" => $amount,
		], [
			"beneficiary_code",
			"unique_request_number",
			"amount"
		]);
	}
}