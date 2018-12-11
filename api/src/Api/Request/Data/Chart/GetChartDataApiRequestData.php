<?php

namespace App\Api\Request\Data\Chart;

use App\Api\Request\Data\ApiRequestDataInterface;

class GetChartDataApiRequestData implements ApiRequestDataInterface {
    
    public $ids;
    public $interval;
    
    public function __construct($interval, $ids) {
        $this->ids = $ids;
        $this->interval = $interval;
    }
    
    public function getIds() {
        if (empty($this->ids)) {
            return [];
        }
        
        return explode(',', $this->ids);
    }
}
