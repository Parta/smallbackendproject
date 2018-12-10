<?php

namespace App\Api\TotalSocial;

class MetricListResponseParser {

    protected $response;

    public function __construct($response) {
        $this->response = $response;
    }
    
    public function getMetrics() {
        return $this->response['data'][0]['metadata']['metrics'];
    }
    
    protected function getItems() {
        return $this->response['data'][0]['metadata']['items'];
    }
    
    protected function getMetricValuesData() {
        return $this->response['data'][0]['data'];
    }
    
    public function getMetricValues() {
        $items = $this->getItems();
        $results = [];
        
        foreach ($this->getMetricValuesData() as $metricData) {
            
            $results[$items[$metricData['item']]['evaproId']] = $metricData['data'];
        }
        
        return $results;
    }
}
