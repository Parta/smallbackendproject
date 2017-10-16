<?php
namespace AppBundle\Controller;

use AppBundle\Entity\FanPage\Facebook\FacebookPage;
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

        $pageRepo = $em->getRepository(FacebookPage::class);
        $page = $pageRepo->findOneByPath('cocacola');

        $format = $request->query->get('format');

        $contents = $page->formatFanCounts($format);

        return $this->json($contents);
    }
}
