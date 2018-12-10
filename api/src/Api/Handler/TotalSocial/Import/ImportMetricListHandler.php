<?php

namespace App\Api\Handler\TotalSocial\Import;

use App\Api\Client\ApiClient;
use App\Api\Handler\ApiHandlerInterface;
use App\Api\Provider\MetricIntervalProvider;
use App\Api\Request\Data\ApiRequestDataInterface;
use App\Api\TotalSocial\MetricListResponseParser;
use App\Repository\MetricRepository;
use App\Repository\MetricValueRepository;

class ImportMetricListHandler implements ApiHandlerInterface {

    protected $apiClient;
    protected $metricRepository;
    protected $metricValueRepository;

    public function __construct(ApiClient $apiClient, MetricRepository $metricRepository, MetricValueRepository $metricValueRepository) {
        $this->apiClient = $apiClient;
        $this->metricRepository = $metricRepository;
        $this->metricValueRepository = $metricValueRepository;
    }

    public function process(ApiRequestDataInterface $requestData) {
        $response = $this->apiClient->getMetricList($requestData);
        
        //$response = json_decode(file_get_contents('/var/www/html/week.json'), true); //tmp for tests
        $metricParser = new MetricListResponseParser($response);
        $metricValues = $metricParser->getMetricValues();
        $metrics = $this->metricRepository->importMetrics($metricParser->getMetrics());
        $this->metricValueRepository->importMetricValues($metricValues, $metrics, MetricIntervalProvider::getIntInterval($requestData->interval));
        
        return true;
    }

}
