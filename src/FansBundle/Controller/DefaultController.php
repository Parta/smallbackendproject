<?php

namespace FansBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FansBundle\Entity\pages;
use FansBundle\Entity\pages_data;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $pageId = $request->get('page_id');
        $format = $request->get('format');
        $fbPageRepository = $this->getDoctrine()->getRepository('FansBundle:pages');
        $fbPageData = $fbPageRepository->findByPage($pageId);

        if (empty($fbPageData)) {
            $message = sprintf("No Info found for %s", $pageId);
            $response = $this->failed($message);
            return JsonResponse::create($response, 400);
        }

        $fbPageId = $fbPageData[0]->getId();
        $response = $this->getDatabyFormat($fbPageId, $format);
        if (empty($response)) {
            $message = sprintf("No Info found for the Facebook page : %s", $pageId);
            return JsonResponse::create($response, 400);
        }

        return JsonResponse::create($this->success($response), 200);

    }

    /**
     * @param string $message
     * @return array
     */
    public function failed($message)
    {
        return array('error' => true,
            'message' => $message);
    }

    /**
     * @param array $dataInfo
     * @return array
     */
    public function success($dataInfo)
    {
        return array('error' => false,
            'data' => $dataInfo);
    }

    /**
     * Handle Data by format.
     * Please check the list of possible format on the routing.yml in the FansBundle
     * @param integer $fbPageId
     * @param string $format
     * @return array
     */
    public function getDatabyFormat($fbPageId, $format)
    {
        $fbPageRepository = $this->getDoctrine()->getRepository('FansBundle:pages_data');
        $fbPageData = $fbPageRepository->findByPages($fbPageId);
        $dataFormat = array();
        switch ($format) {
            default:
            case 'linechart' :
                foreach ($fbPageData as $id => $value) {
                    $dateData = (array) $value->getDate();
                    $dateTimeZone = strtotime($dateData['date']);
                    $dataFormat[$value->getPages()->getPage()][] = array("date" => $dateTimeZone,
                        "value"=> $value->getFans()
                    );
                }
                break;
            case 'table' :

                foreach ($fbPageData as $id => $value) {
                    $dateData = (array) $value->getDate();
                    $dateTimeZone = strtotime($dateData['date']);
                    $dataFormat[] = array($dateTimeZone => $value->getFans());
                }

                break;
            case 'multiplepage' :
                foreach ($fbPageData as $id => $value) {
                    $dateData = (array) $value->getDate();
                    $dateTimeZone = strtotime($dateData['date']);
                    $dataFormat[] = array("date" => $dateTimeZone,
                    "value"=> $value->getFans()
                    );
                }
                break;
        }
        return $dataFormat;
    }
}
