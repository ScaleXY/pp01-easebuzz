<?php

namespace ScaleXY\Easebuzz;

class Contacts extends EasebuzzServiceHandler
{
	const base_path = "https://wire.easebuzz.in";
	// const base_path = "https://stoplight.io/mocks/easebuzz/neobanking/90373567";

	public function __construct($key, $salt, $debug = false)
	{
		parent::__construct($key, $salt, $debug);
	}

	public function CreateContact($name, $email = "", $phone = "")
	{
		$path = "/api/v1/contacts/";
		$request_payload = ["name" => $name, "email" => $email, "phone" => $phone];
		$hash_keys = [ "name", "email", "phone" ];
		return $this->makePOSTRequestType01(self::base_path . $path, $request_payload, $hash_keys)->data;
	}

	public function UpdateContact($eb_id, $name, $email = "", $phone = "")
	{
		$path = "/api/v1/contacts/$eb_id/";
		$request_payload = ["name" => $name, "email" => $email, "phone" => $phone];
		$hash_keys = [ "name", "email", "phone" ];
		return $this->makePUTRequestType01(self::base_path . $path, $request_payload, $hash_keys)->data;
	}

	public function RetrieveContacts($current = 1, $pageSize = 10)
	{
		$path = "/api/v1/contacts/";
		$query_params = [ "current" => $current, "pageSize" => $pageSize ];
		return $this->makeGETRequestType01(self::base_path . $path, $query_params, [])->data;
	}
}