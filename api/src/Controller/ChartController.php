<?php

namespace App\Controller;

use App\Api\Handler\Chart\GetChartDataApiHandler;
use App\Api\Request\Data\Chart\GetChartDataApiRequestData;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class ChartController extends FOSRestController {

    /**
     * @Rest\Get("metric-values/{interval}/{ids}", name="api_get_metric_values", defaults={"interval": "week", "ids": null}, requirements={"interval": "week|month"})
     */
    public function getMetricValues($interval, $ids, GetChartDataApiHandler $chartDataApiHandler) {
        $response = $chartDataApiHandler->process(new GetChartDataApiRequestData($interval, $ids));

        return View::create($response, Response::HTTP_OK);
    }

}
