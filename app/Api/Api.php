<?php

namespace App\Api;

use Illuminate\Support\Facades\Log;

class Api
{
    /**
     * @var string
     */
    protected string $apiUrl;
    /**
     * @var string
     */
    public string $apiKey;
    /**
     * @var array
     */
    protected array $defaultParams;

    public function __construct()
    {
        $this->defaultParams = [];
        $this->apiUrl = '';
        $this->apiKey = '';
    }

    public function call($method, $route, $requestParams = [])
    {
        $params = array_merge($this->defaultParams, $requestParams);
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request(
                $method,
                $this->apiUrl . $route,
                $params
            );
            return json_decode($response->getBody()->getContents());
        } catch (\Exception $e) {
            Log::error('Failed to send', ['exception' => $e->getMessage()]);
            return ['error' => $e->getMessage()];
        }
    }

}
