<?php

namespace App\Api\Handler\TotalSocial\Import;

use App\Api\Client\ApiClient;
use App\Api\Handler\ApiHandlerInterface;
use App\Api\Request\Data\ApiRequestDataInterface;

class ImportMetricListHandler implements ApiHandlerInterface {

    protected $apiClient;

    public function __construct(ApiClient $apiClient) {
        $this->apiClient = $apiClient;
    }

    public function process(ApiRequestDataInterface $requestData) {
       $response = $this->apiClient->getMetricList($requestData);
       print '<pre>';
       print_r($response);exit;
    }

}
