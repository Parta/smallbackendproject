<?php

namespace App\Api\Client;

use App\Api\Client\Request\RequestApiClientInterface;
use App\Api\Provider\ApiUrlProvider;
use App\Api\Request\Data\TotalSocial\Import\ImportMetricListApiRequestData;

class ApiClient {

    protected $client;
    protected $urlProvider;

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
        return $this->client->authorizedRequest('GET', $this->urlProvider->getUrl('list_items'), $accessToken);
    }
    
    public function getMetricList(ImportMetricListApiRequestData $requestData) {
        return $this->client->authorizedRequest('GET', $this->urlProvider->getUrl('list_metrics'), $requestData->accessToken, $requestData->getParams());
    }

}
