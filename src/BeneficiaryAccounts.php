<?php

namespace ScaleXY\Easebuzz;

class BeneficiaryAccounts extends EasebuzzServiceHandler
{
    const base_path = 'https://wire.easebuzz.in';
    // const base_path = "https://stoplight.io/mocks/easebuzz/neobanking/90373567";

    public function __construct($key, $salt, $debug = false)
    {
        parent::__construct($key, $salt, $debug);
    }

    public function CreateBankAccount($contact_id, $beneficiary_name, $account_number, $ifsc)
    {
        return $this->Create($contact_id, 'bank_account', $beneficiary_name, $account_number, $ifsc, '');
    }

    public function CreateUPIHandle($contact_id, $beneficiary_name, $upi_handle)
    {
        return $this->Create($contact_id, 'upi', $beneficiary_name, '', '', $upi_handle);
    }

    public function Create($contact_id, $beneficiary_type, $beneficiary_name, $account_number, $ifsc, $upi_handle)
    {
        $path = '/api/v1/beneficiaries/';
        $request_payload = [
            'contact_id' => $contact_id,
            'beneficiary_type' => $beneficiary_type,
            'beneficiary_name' => $beneficiary_name,
            'account_number' => $account_number,
            'ifsc' => $ifsc,
            'upi_handle' => $upi_handle,
        ];
        $hash_keys = ['contact_id', 'beneficiary_name', 'account_number', 'ifsc', 'upi_handle'];

        return $this->makePOSTRequestType01(self::base_path.$path, $request_payload, $hash_keys)->data;
    }

    public function Retrieve($contact_id, $current = 1, $pageSize = 10)
    {
        $path = '/api/v1/beneficiaries/';
        $query_params = ['contact_id' => $contact_id, 'current' => $current, 'pageSize' => $pageSize];

        return $this->makeGETRequestType01(self::base_path.$path, $query_params, ['contact_id'])->data;
    }
}
