<?php

namespace App\Api\Chart;

class BrandMetricsChartApiResponseParser {
    public $status;
    public $data;
    public $metadata;
    protected $startDates = [];
    protected $endDates = [];
    
    public function prepareResponse($data, $interval) {
        if (empty($data)) {
            return $this->getErrorResponse();
        }
        
        $brandValues = [];
        foreach ($data  as $metricValue) {
            $this->addBrand($metricValue, $brandValues);
            $this->addMetric($metricValue, $brandValues);
        }
        
        return $this->getResponse($brandValues, $interval);
    }
    
    protected function addBrand($metricValue, &$brandValues) {
        if (!array_key_exists($metricValue['brand']['apiId'], $brandValues)) {
            $brandValues[$metricValue['brand']['apiId']]['brand'] = [
                'id' => $metricValue['brand']['apiId'],
                'name' => $metricValue['brand']['name'],
            ];
        }
    }
    
    protected function addMetric($metricValue, &$brandValues) {
        $brandValues[$metricValue['brand']['apiId']]['metrics'][] = [
            'value' => $metricValue['value'],
            'startDate' => $metricValue['startDate']->getTimestamp(),
            'endDate' => $metricValue['endDate']->getTimestamp(),
        ];
        
        $this->startDates[] = $metricValue['startDate']->getTimestamp();
        $this->endDates[] = $metricValue['endDate']->getTimestamp();
    }
    
    protected function getResponse($brandValues, $interval) {
        return [
            'status' => 'success',
            'data' => array_values($brandValues),
            'metadata' => [
                'count' => count($brandValues),
                'interval' => $interval,
                'startDate' => min($this->startDates),
                'endDate' => max($this->endDates),
            ]
        ];
    }
    
    public function getErrorResponse() {
        return [
            'status' => 'error',
            'data' => [],
            'metadata' => [
                'count' => 0,
                'interval' => null,
                'startDate' => null,
                'endDate' => null,
            ]
        ];
    }
}
