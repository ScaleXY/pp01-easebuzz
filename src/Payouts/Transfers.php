<?php

namespace ScaleXY\Easebuzz\Payouts;

use ScaleXY\Easebuzz\EasebuzzServiceHandler;

class Transfers
{
	const base_path = "https://wire.easebuzz.in";
	// const base_path = "https://stoplight.io/mocks/easebuzz/neobanking/90373567";

	public $client;

	public function __construct($key, $salt)
	{
		$this->client = new EasebuzzServiceHandler($key, $salt);
	}

	public function InitiatePayout($virtual_account_number, $beneficiary_code, $uuid, string $payment_mode, float $amount)
	{
		$path = "/api/v1/transfers/initiate/";
		return $this->client->makePOSTRequestType01(self::base_path . $path, [
			"virtual_account_number" => $virtual_account_number,
			"beneficiary_code" => $beneficiary_code,
			"unique_request_number" => str_replace("-", "", $uuid),
			"payment_mode" => $payment_mode,
			"amount" => $amount,
		], [
			"beneficiary_code",
			"unique_request_number",
			"amount"
		])->data;
	}
}