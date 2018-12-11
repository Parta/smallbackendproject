<?php

namespace App\Api\Handler\TotalSocial;

use App\Api\Client\ApiClient;
use App\Api\Handler\ApiHandlerInterface;
use App\Api\Request\Data\ApiRequestDataInterface;

class LoginApiHandler implements ApiHandlerInterface {

    protected $apiClient;

    public function __construct(ApiClient $apiClient) {
        $this->apiClient = $apiClient;
    }

    public function process(ApiRequestDataInterface $requestData) {

        $response = $this->apiClient->login($requestData->grantType, $requestData->clientId, $requestData->clientSecret);

        return $response['access_token'];
    }

}
