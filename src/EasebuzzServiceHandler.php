<?php

namespace ScaleXY\Easebuzz;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EasebuzzServiceHandler
{
    protected $key;

    protected $salt;

    public $debug;

    public function __construct($key, $salt, $debug = false)
    {
        $this->key = $key;
        $this->salt = $salt;
        $this->debug = $debug;
    }

    public function generateHash($hash_params = [])
    {
        $hash_values_array = [];
        array_push($hash_values_array, $this->key);
        foreach ($hash_params as $param) {
            array_push($hash_values_array, $param);
        }
        array_push($hash_values_array, $this->salt);
        if ($this->debug) {
            Log::warning($hash_values_array);
        }
        $hash = hash('sha512', implode('|', $hash_values_array));
        if ($this->debug) {
            Log::warning($hash);
        }

        return $hash;
    }

    public function makePOSTRequestType01($request_url, $request_payload, $hash_keys)
    {
        $request_payload['key'] = $this->key;
        $headers = [
            'Authorization' => $this->generateHash(array_values(Arr::only($request_payload, $hash_keys))),
        ];
        $resp = Http::withHeaders($headers)
            ->post($request_url, $request_payload)
            ->json();
        if ($this->debug) {
            Log::warning(json_encode($resp));
        }
        $resp = json_decode(json_encode($resp));
        if (! $resp->success) {
            throw new Exception($resp->message);
        }

        return $resp;
    }

    public function makePUTRequestType01($request_url, $request_payload, $hash_keys)
    {
        $request_payload['key'] = $this->key;
        $headers = [
            'Authorization' => $this->generateHash(array_values(Arr::only($request_payload, $hash_keys))),
        ];
        $resp = Http::withHeaders($headers)
            ->put($request_url, $request_payload)
            ->json();
        if ($this->debug) {
            Log::warning(json_encode($resp));
        }
        $resp = json_decode(json_encode($resp));
        if (! $resp->success) {
            throw new Exception($resp->message);
        }

        return $resp;
    }

    public function makeGETRequestType01($request_url, $query_params, $hash_keys)
    {
        $query_params['key'] = $this->key;
        $hash_values = array_values(Arr::only($query_params, $hash_keys));
        $headers = [
            'Authorization' => $this->generateHash($hash_values),
        ];
        $resp = Http::withHeaders($headers)
            ->get($request_url, $query_params)
            ->json();
        if ($this->debug) {
            Log::warning(json_encode($resp));
        }
        $resp = json_decode(json_encode($resp));
        if (! $resp->success) {
            throw new Exception($resp->message);
        }

        return $resp;
    }

    public static function easebuzzAmountFormating($amount): string
    {
        $amount = $amount;
        if (round(($amount * 100), 0) % 100 == 0) {
            return ((string) floor($amount)).'.0';
        }
        if (round(($amount * 100), 0) % 10 == 0) {
            return ((string) $amount).'0';
        }

        return (string) $amount;
    }
}
