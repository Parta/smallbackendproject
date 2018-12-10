<?php

namespace App\Controller;

use App\Api\Handler\Chart\GetChartDataApiHandler;
use App\Api\Request\Data\Chart\GetChartDataApiRequestData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class ChartController extends AbstractController {

    /**
     * @Route("/metric-values/{interval}/{ids}", name="metric_values", defaults={"interval": "week", "ids": null}, requirements={"interval": "week|month"}, methods={"GET"})
     */
    public function index($interval, $ids, GetChartDataApiHandler $chartDataApiHandler) {
        
        $response = $chartDataApiHandler->process(new GetChartDataApiRequestData($interval, $ids));
        
        
        return new JsonResponse($response);
    }

}
