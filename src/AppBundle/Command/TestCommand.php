<?php
// src/AppBundle/Command/CreateUserCommand.php
namespace AppBundle\Command;

use AppBundle\Entity\{
    FacebookPage,
    FacebookFanCount
};
use GuzzleHttp\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

class TestCommand extends Command
{
    protected $client;

    public function __construct()
    {
        parent::__construct();

        $this->client = new Client([
            'base_uri' => 'https://www.facebook.com'
        ]);
    }

    protected function configure()
    {
        $this
            ->setName("test")
            ->setDescription("Just a test command");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->container = $this->getApplication()->getKernel()->getContainer();
        $this->em = $this->container->get('doctrine.orm.entity_manager');

        $response = $this->client->request('get', '/cocacola');
        $html = $response->getBody()->getContents();

        $text = $this->executeCrawling($html);

        $count = $this->parseText($text);

        if( $count > -1 ) {
            $this->insertCount($count);
        }
    }

    protected function executeCrawling(string $html): string
    {
        $crawler = new Crawler($html);
        $text = $crawler
            ->filter('body #pages_side_column div._4-u2._3xaf._4-u8')
            ->first()
            ->filter('._2pi9._2pi2 ._4bl9 > div')
            ->reduce(function(Crawler $node, $i) {
                return $i === 1;
            })
            ->text();

        return $text;
    }

    protected function parseText(string $text): int
    {
        preg_match("/^\d+(\,\d{3})*/", $text, $matches);
        if( empty($matches) ) {
            return -1;
        }
        $stringCount = $matches[0];

        $digitsGroups = explode(',', $stringCount);

        $count = '';
        foreach( $digitsGroups as $dGroup ) {
            $count .= $dGroup;
        }

        try {
            $count = intval($count);
        } catch( \Exception $e ) {
            $count = -1;
        }

        return $count;
    }

    protected function insertCount(int $count)
    {
        $facebookPageRepo = $this->em->getRepository(FacebookPage::class);

        $facebookPage = $facebookPageRepo->findOneByPath('cocacola');

        if( $facebookPage === null ) {
            $facebookPage = new FacebookPage();
            $facebookPage->set('path', 'cocacola');

            $this->em->persist($facebookPage);
            $this->em->flush();
        }

        $facebookFanCount = new FacebookFanCount();
        $facebookFanCount->setPage($facebookPage);
        $facebookFanCount->set('value', $count);
        $facebookFanCount->set('date', new \DateTime());

        $this->em->persist($facebookFanCount);
        $this->em->flush();
    }
}
