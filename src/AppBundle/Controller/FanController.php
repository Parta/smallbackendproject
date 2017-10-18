<?php
namespace AppBundle\Controller;

use AppBundle\Entity\FanPage\Page;
use AppBundle\Entity\FanPage\Facebook\FacebookPage;
use AppBundle\Entity\FanPage\Twitter\TwitterPage;
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
    public function facebookAction(Request $request, string $path)
    {
        $contents = $this->renderFanCounts($request, FacebookPage::class, $path);
        return $this->json($contents);
    }

    /**
     * @Route("/fans/twitter/{path}")
     */
    public function twitterAction(Request $request, string $path)
    {
        $contents = $this->renderFanCounts($request, TwitterPage::class, $path);
        return $this->json($contents);
    }

    private function renderFanCounts(Request $request, string $pageClass, string $path): array
    {
        $em = $this->getDoctrine()->getManager();

        $pageRepo = $em->getRepository($pageClass);
        $page = $pageRepo->findOneByPath($path);

        // if no row has been found for the given path in table {Facebook|Twitter}Pages, return an error message
        if( $page === null ) {
            return [
                'error' => true,
                'message' => "No data found for $path"
            ];
        }

        // if no paramter has been passed in url, set it to 'linechart' by default
        $format = $request->query->get('format') ?? 'linechart';

        $contents = $page->formatFanCounts($format);

        return $contents;
    }
}
