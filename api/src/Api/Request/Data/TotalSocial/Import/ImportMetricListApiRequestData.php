<?php

namespace App\Api\Request\Data\TotalSocial\Import;

use App\Api\Request\Data\ApiRequestDataInterface;
use App\Api\Services\VariableNameConverter;

class ImportMetricListApiRequestData implements ApiRequestDataInterface {

    public $ids = [70905, 70933];
    public $metrics = 'offline.scoreVolume.value';
    public $outputType = 'overtime';
    public $from = 1442188800;
    public $to = 1543190399;
    public $interval = 'week';
    public $accessToken;

    public function __construct($accessToken) {
        $this->from = strtotime(date('2015-09-14 02:00:00'));
        $this->to = strtotime(date('2018-11-26 00:59:59'));
        $this->accessToken = $accessToken;
    }

    public function getParams() {
        $params = [];
        foreach (get_object_vars($this) as $name => $value) {
            $params[VariableNameConverter::uncamelCase($name)] = $value;
        }
        $params['ids'] = implode(',', $this->ids);
        unset($params['access_token']);
        
        return $params;
    }

}
