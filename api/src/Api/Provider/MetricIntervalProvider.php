<?php

namespace App\Api\Provider;

class MetricIntervalProvider {

    const METRIC_INTERVAL_WEEK = 0;
    const METRIC_INTERVAL_MONTH = 1;
    const METRIC_INTERVAL_WEEK_STRING = 'week';
    const METRIC_INTERVAL_MONTH_STRING = 'month';

    public static function getStringInterval($interval) {
        return $interval === self::METRIC_INTERVAL_WEEK ? self::METRIC_INTERVAL_WEEK_STRING : self::METRIC_INTERVAL_MONTH_STRING;
    }
    
    public static function getIntInterval($interval) {
        return $interval === self::METRIC_INTERVAL_WEEK_STRING ? self::METRIC_INTERVAL_WEEK : self::METRIC_INTERVAL_MONTH;
    }

}
