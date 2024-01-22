<?php

namespace ScaleXY\Easebuzz\Payouts;

use ScaleXY\Easebuzz\EasebuzzServiceHandler;

class Accounts
{
	const base_path = "https://wire.easebuzz.in";
	// const base_path = "https://stoplight.io/mocks/easebuzz/neobanking/90373567";

	public $client;

	public function __construct($key, $salt)
	{
		$this->client = new EasebuzzServiceHandler($key, $salt);
	}
	public function AddFundingAccount()
	{
		$path = "/api/v1/merchants/funding_accounts/";
		return $this->client->makePOSTRequestType01(self::base_path . $path, [], [])->data->virtual_accounts;
	}
	public function FetchVirtualAccounts()
	{
		$path = "/api/v1/virtual_accounts/";
		return $this->client->makeGETRequestType01(self::base_path . $path, [], [])->data->virtual_accounts;
	}
}
