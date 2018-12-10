<?php

namespace App\Api\Client\Request;

use GuzzleHttp\Client;

class RequestApiClient implements RequestApiClientInterface {

    protected $guzzleClient;

    public function __construct() {
        $this->guzzleClient = new Client();
    }

    public function requestJson($method, $endpoint, $params = []) {
        $response = $this->guzzleClient->request($method, $endpoint, [
            'headers' => [
                'Content-type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'json' => $params,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function authorizedRequest($method, $endpoint, $accessToken, $params = []) {
        $requestParamName = $method === 'GET' ? 'query' : 'json';
        $response = $this->guzzleClient->request($method ,$endpoint, [
            'headers' => [
                'Content-type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '. $accessToken,
            ],
            $requestParamName => $params,
        ]);
        
        return json_decode($response->getBody()->getContents(), true);
    }

}
