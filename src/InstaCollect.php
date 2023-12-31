<?php

namespace ScaleXY\Easebuzz;

use Exception;
use Illuminate\Support\Facades\Http;

class InstaCollect
{
	const base_path = "https://wire.easebuzz.in";

	public $client;

	public function __construct($key, $salt)
	{
		$this->client = new EasebuzzServiceHandler($key, $salt);
	}

	public function CreateVirtualAccount($virtual_account_number, $virtual_payment_address = null, $label = null, $description = null): object
	{
		$path = "/api/v1/insta-collect/virtual_accounts/";
		return $this->client->makePOSTRequestType02(self::base_path . $path, [
			"virtual_account_number" => $virtual_account_number,
			"virtual_payment_address" => $virtual_payment_address ?? $virtual_account_number,
			"label" => $label ?? "VA " . $virtual_account_number,
			"description" => $description ?? "No description",
		], [
			"label"
		]);
	}
}
