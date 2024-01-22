<?php

namespace ScaleXY\Easebuzz;

class Contacts
{
	const base_path = "https://wire.easebuzz.in";
	// const base_path = "https://stoplight.io/mocks/easebuzz/neobanking/90373567";

	public $client;

	public function __construct($key, $salt)
	{
		$this->client = new EasebuzzServiceHandler($key, $salt);
	}

	public function CreateContact($name, $email = "", $phone = "")
	{
		$path = "/api/v1/contacts/";
		$request_payload = ["name" => $name, "email" => $email, "phone" => $phone];
		$hash_keys = [ "name", "email", "phone" ];
		return $this->client->makePOSTRequestType01(self::base_path . $path, $request_payload, $hash_keys)->data;
	}
	public function RetrieveContacts($current = 1, $pageSize = 10)
	{
		$path = "/api/v1/contacts/";
		$query_params = [ "current" => $current, "pageSize" => $pageSize ];
		return $this->client->makeGETRequestType01(self::base_path . $path, $query_params, [])->data;
	}
}