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
     * @Route("/fans/facebook/{path}")
     */
    public function facebookAction(Request $request, $path)
    {
        $contents = $this->renderFanCounts($request, FacebookPage::class, $path);
        return $this->json($contents);
    }

    private function renderFanCounts(Request $request, string $pageClass, string $path): array
    {
        $em = $this->getDoctrine()->getManager();

        $pageRepo = $em->getRepository($pageClass);
        $page = $pageRepo->findOneByPath($path);

        if( $page === null ) {
            return [
                'error' => true,
                'message' => "No data found for $path"
            ];
        }

        $format = $request->query->get('format');

        $contents = $page->formatFanCounts($format);

        return $contents;
    }
}
