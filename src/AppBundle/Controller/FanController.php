<?php
namespace AppBundle\Controller;

use AppBundle\Entity\FanPage\Page;
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
    public function facebookAction(Request $request)
    {
        $contents = $this->renderFanCounts($request, FacebookPage::class);
        return $this->json($contents);
    }

    private function renderFanCounts(Request $request, string $pageClass)
    {
        $em = $this->getDoctrine()->getManager();

        $pageRepo = $em->getRepository($pageClass);
        $page = $pageRepo->findOneByPath('cocacola');

        $format = $request->query->get('format');

        $contents = $page->formatFanCounts($format);

        return $contents;
    }
}
