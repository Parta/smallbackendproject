<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FacebookPage;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\{
    Request,
    Response
};

class FanController extends Controller
{
    /**
     * @Route("/facebook/fans")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $facebookPageRepo = $em->getRepository(FacebookPage::class);
        $facebookPage = $facebookPageRepo->findOneByPath('cocacola');

        $facebookFanCounts = $facebookPage->get('facebookFanCounts');

        $contents = [];
        foreach( $facebookFanCounts as $fanCount ) {
            $contents[] = [
                'id' => $fanCount->get('id'),
                'value' => $fanCount->get('value')
            ];
        }

        return $this->json($contents);
    }
}
