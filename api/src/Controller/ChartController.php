<?php

namespace App\Controller;

use App\Api\Handler\Chart\GetChartDataApiHandler;
use App\Api\Request\Data\Chart\GetChartDataApiRequestData;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChartController extends FOSRestController {

    /**
     * @Rest\Get("metric-values", name="api_get_metric_values")
     */
    public function getMetricValues(Request $request, GetChartDataApiHandler $chartDataApiHandler)
    {
        $interval = $request->query->get('interval', 'week');
        $ids = $request->query->get('ids', []);

        $response = $chartDataApiHandler->process(new GetChartDataApiRequestData($interval, $ids));

        return View::create($response, Response::HTTP_OK);
    }

}
