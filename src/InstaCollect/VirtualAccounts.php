<?php

namespace ScaleXY\Easebuzz\InstaCollect;

use ScaleXY\Easebuzz\EasebuzzServiceHandler;

class VirtualAccounts extends EasebuzzServiceHandler
{
	const base_path = "https://wire.easebuzz.in";
	// const base_path = "https://stoplight.io/mocks/easebuzz/neobanking/90373567";

	public function __construct($key, $salt, $debug = false)
	{
		parent::__construct($key, $salt, $debug);
	}

	public function CreateVirtualAccount($virtual_account_number, $virtual_payment_address = null, $label = null, $description = null): object
	{
		$path = "/api/v1/insta-collect/virtual_accounts/";
		return $this->makePOSTRequestType01(self::base_path . $path, [
			"virtual_account_number" => $virtual_account_number,
			"virtual_payment_address" => $virtual_payment_address ?? $virtual_account_number,
			"label" => $label ?? "VA " . $virtual_account_number,
			"description" => $description ?? "No description",
		], [
			"label"
		])->data->virtual_account;
	}
	
	// public function handleWebhook($virtual_account_number, $virtual_payment_address = null, $label = null, $description = null): void
	// {
	// 	$path = "/api/v1/insta-collect/virtual_accounts/";
	// 	return $this->makePOSTRequestType01(self::base_path . $path, [
	// 		"virtual_account_number" => $virtual_account_number,
	// 		"virtual_payment_address" => $virtual_payment_address ?? $virtual_account_number,
	// 		"label" => $label ?? "VA " . $virtual_account_number,
	// 		"description" => $description ?? "No description",
	// 	], [
	// 		"label"
	// 	]);
	// }
}