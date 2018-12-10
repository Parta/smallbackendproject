<?php

namespace App\Api\Handler\Chart;

use App\Api\Chart\BrandMetricsChartApiResponseParser;
use App\Api\Handler\ApiHandlerInterface;
use App\Api\Provider\MetricIntervalProvider;
use App\Api\Request\Data\ApiRequestDataInterface;
use App\Repository\MetricValueRepository;

class GetChartDataApiHandler implements ApiHandlerInterface {
    
    protected $metricValueRepository;
    protected $brandMetricsParser;

    public function __construct(MetricValueRepository $metricValueRepository, BrandMetricsChartApiResponseParser $brandMetricsParser) {
        $this->metricValueRepository = $metricValueRepository;
        $this->brandMetricsParser = $brandMetricsParser;
    }
    
    public function process(ApiRequestDataInterface $requestData) {
        try {
            $data = $this->metricValueRepository->getChartData(MetricIntervalProvider::getIntInterval($requestData->interval), $requestData->getIds());
            $response = $this->brandMetricsParser->prepareResponse($data, $requestData->interval);
            
            return $response;
        } catch (\Exception $ex) {
            return $this->brandMetricsParser->getErrorResponse();
        }
    }
}
