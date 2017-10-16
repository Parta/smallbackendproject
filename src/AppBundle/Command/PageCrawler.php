<?php
namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;

abstract class PageCrawler extends Command
{

    public function __construct()
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->container = $this->getApplication()->getKernel()->getContainer();
        $this->em = $this->container->get('doctrine.orm.entity_manager');
        $this->logger = $this->container->get('logger');

        $response = $this->client->request('get', 'cocacola');
        $html = $response->getBody()->getContents();

        $text = $this->executeCrawling($html);

        $count = $this->parseText($text);

        if( $count > -1 ) {
            $this->insertCount($count);
        } else {
            $this->logger->error("The crawler found the requested content, but couldn't parse it to get an integer.", [
                'extracted_text' => $text
            ]);
        }
    }

    protected function insertCount(int $count)
    {
        $pageRepo = $this->em->getRepository($this->pageClass);

        $page = $pageRepo->findOneByPath('cocacola');

        if( $page === null ) {
            $page = new $this->pageClass();
            $page->set('path', 'cocacola');

            $this->em->persist($page);
            $this->em->flush();
        }

        $fanCount = new $this->fanCountClass();
        $fanCount->setPage($page);
        $fanCount->set('value', $count);
        $fanCount->set('date', new \DateTime());

        $this->em->persist($fanCount);
        $this->em->flush();
    }
}
