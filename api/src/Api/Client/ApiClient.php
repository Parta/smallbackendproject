<?php

namespace App\Api\Client;

use App\Api\Client\Request\RequestApiClientInterface;
use App\Api\Exception\ApiErrorException;
use App\Api\Provider\ApiUrlProvider;
use App\Api\Request\Data\TotalSocial\Import\ImportMetricListApiRequestData;

class ApiClient {

    protected $client;
    protected $urlProvider;
    
    const API_SUCCESS_STATUS = 'success';

    public function __construct(RequestApiClientInterface $requestApiClient, ApiUrlProvider $urlProvider) {
        $this->client = $requestApiClient;
        $this->urlProvider = $urlProvider;
    }
    
    public function login($grantType, $clientId, $clientSecret) {
        return $this->client->requestJson('POST', $this->urlProvider->getUrl('login'), [
            'grant_type' => $grantType,
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
        ]);
    }
    
    public function getItemList($accessToken) {
        $response = $this->client->authorizedRequest('GET', $this->urlProvider->getUrl('list_items'), $accessToken);
        
        return $this->checkApiResponse($response);
    }
    
    public function getMetricList(ImportMetricListApiRequestData $requestData) {
        $response = $this->client->authorizedRequest('GET', $this->urlProvider->getUrl('list_metrics'), $requestData->accessToken, $requestData->getParams());
        
        return $this->checkApiResponse($response);
    }
    
    protected function checkApiResponse($response) {
        if ($response['status'] !== self::API_SUCCESS_STATUS) {
            throw new ApiErrorException('api_request_with_no_success_status');
        }
        
        return $response;
    }

}
