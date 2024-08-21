<?php

namespace ScaleXY\Easebuzz\Payouts;

use ScaleXY\Easebuzz\EasebuzzServiceHandler;

class Accounts extends EasebuzzServiceHandler
{
    const base_path = 'https://wire.easebuzz.in';
    // const base_path = "https://stoplight.io/mocks/easebuzz/neobanking/90373567";

    public function __construct($key, $salt, $debug = false)
    {
        parent::__construct($key, $salt, $debug);
    }

    public function AddFundingAccount()
    {
        $path = '/api/v1/merchants/funding_accounts/';

        return $this->makePOSTRequestType01(self::base_path.$path, [], [])->data->virtual_accounts;
    }

    public function FetchVirtualAccounts()
    {
        $path = '/api/v1/virtual_accounts/';

        return $this->makeGETRequestType01(self::base_path.$path, [], [])->data->virtual_accounts;
    }
}
