<?php
namespace FansBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use FansBundle\Entity\pages;
use FansBundle\Entity\pages_data;

class ImportPageDataCommand extends ContainerAwareCommand {

    /*
     * config for the command
     */
    protected function configure()
    {
        $this
            ->setName('app:ImportPageData')
            ->setDescription('Import Facebook Page Data')
            ->setDefinition(
                new InputDefinition(array(
                    new InputOption('uri', '', InputOption::VALUE_REQUIRED),
                    new InputOption('page_id', '', InputOption::VALUE_REQUIRED),
                ))
            );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $pageId = $input->getOption('page_id');
        $uri = $input->getOption('uri');

        $pageFans = 2;
        if ($uri == 'crawler/fans' && !empty($pageId)) {
            $fbPageData = $this->getFbPageData($pageId);
            if ($fbPageData) {
                if ($this->importData($pageId, $fbPageData['fan_count'], $output)) {
                    $this->success($pageId, $output);
                } else {
                    $this->failure($input->getOptions(), $output);
                }
            } else {
                $this->failure($input->getOptions(), $output);
            }

        } else {
            $this->failure($input->getOptions(), $output);
        }

    }

    /**
     * Call the Facebook API to get the number of fan
     * @param string $pageId
     * @return array|bool
     */
    public function getFbPageData($pageId) {
        $clientSecret = $this->getContainer()->getParameter('client_secret');
        $clientId = $this->getContainer()->getParameter('client_id');
        $facebookUrl = $this->getContainer()->getParameter('facebook_url');
        $accessToken = sprintf('%s|%s', $clientId, $clientSecret);
        $url = sprintf('%s/%s?access_token=%s&fields=fan_count',
            $facebookUrl,
            $pageId,
            $accessToken
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);
        $data = (array) json_decode($response);

        if (isset($data['error'])) {
            return false;
        }
        return $data;
    }

    /**
     * Import Data by using the transaction process
     * @param string $page
     * @param integer $pageFans
     * @param OutputInterface $output
     * @return bool
     */
    public function importData($page, $pageFans, OutputInterface $output)
    {
        if (empty($pageFans) || !is_numeric($pageFans)) {
            trigger_error('PageFans value is null or is not an integer');
            return false;
        }

        //get the Entity Manager
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        //Prepare transaction
        $em->getConnection()->beginTransaction();

        try {
            $pageId = self::addFbPage($page);
            
            if (empty($pageId)) {
                trigger_error('Page Id not found');
                return false;
            }

            self::addFbPageData($pageId, $pageFans);
            $em->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $output->writeln('Can\'t add Data');
            $em->getConnection()->rollback();
        }

    }

    /**
     * Add facebook page if not exist or return the id
     * @param string $page
     * @return int
     */
    public function addFbPage($page)
    {
        $pagesRepository = $this->getContainer()->get('doctrine')->getRepository('FansBundle:pages');
        $pagesEntity = $pagesRepository->findByPage($page);
        if (empty($pagesEntity)) {
            $pagesEntity = new pages();
            $pagesEntity->setPage($page);
            $em = $this->getContainer()->get('doctrine')->getManager();
            $em->persist($pagesEntity);
            $em->flush();
        } else {
            $pagesEntity = $pagesEntity[0];
        }

        return $pagesEntity->getId();
    }

    /**
     * add Facebook Page Data
     * @param integer $pageId
     * @param integer $fanNumber
     * @return int
     */
    public function addFbPageData($pageId, $fanNumber)
    {
        $pagesRepository = $this->getContainer()->get('doctrine')->getRepository('FansBundle:pages');
        $pagesEntity = $pagesRepository->find($pageId);
        $date = new \DateTime('now');
        $pagesDataEntity = new pages_data();
        $pagesDataEntity->setFans($fanNumber);
        $pagesDataEntity->setPages($pagesEntity);

        $pagesDataEntity->setDate($date);
        $em = $this->getContainer()->get('doctrine')->getManager();
        $em->persist($pagesDataEntity);
        $em->flush();
        return $pagesDataEntity->getId();
    }

    /**
     * get the success message when it's success
     * @param string $page
     * @param OutputInterface $output
     */
    public function success($page, OutputInterface $output)
    {
        $message = sprintf('%s import done', $page);
        $output->writeln($message);
    }

    /**
     * get the message when something goes wrong
     * @param array $options
     * @param OutputInterface $options
     */
    public function failure($options, OutputInterface $output)
    {
        $failureOption = array();
        $output->writeln('No info found! Please provide uri and page_id');
    }
}