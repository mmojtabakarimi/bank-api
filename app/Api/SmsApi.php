<?php

namespace App\Api;

class SmsApi extends  Api
{
    public function __construct()
    {
        parent::__construct();
        $this->apiUrl = config('config.sms_provider_api_url');
        $this->apiKey = config('config.sms_provider_api_key');

    }
}
