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
    public $interval = 'month';
    public $accessToken;

    public function __construct($accessToken) {
        date_default_timezone_set('UTC') ;
//        $testDate = new \DateTime('2018-09-30T23:59:59', new \DateTimeZone('UTC'));
//        echo $testDate->getTimestamp() . '<br />';
//        echo strtotime(date('2018-09-30 23:59:59'));
//        //echo date('Y-m-d H:i:s', 1538348399);
//        exit;
//        $this->from = strtotime(date('2018-09-01 0:00:00'));
//        $this->to = strtotime(date('2018-09-30 23:59:59'));
        $this->from = strtotime(date('2018-08-27 0:00:00'));
        $this->to = strtotime(date('2018-09-30 23:59:59'));
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
