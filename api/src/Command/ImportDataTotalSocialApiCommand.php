<?php

namespace App\Command;

use App\Api\Handler\TotalSocial\Import\ImportItemListApiHandler;
use App\Api\Handler\TotalSocial\Import\ImportMetricListHandler;
use App\Api\Handler\TotalSocial\LoginApiHandler;
use App\Api\Provider\LoginApiRequestDataProvider;
use App\Api\Request\Data\TotalSocial\Import\ImportItemListApiRequestData;
use App\Api\Request\Data\TotalSocial\Import\ImportMetricListApiRequestData;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportDataTotalSocialApiCommand extends Command {

    protected static $defaultName = 'import-social-api-data';
    protected $loginApiHandler;
    protected $loginApiDataProvider;
    protected $importItemListApiHandler;
    protected $importMetricListApiHandler;

    public function __construct(LoginApiHandler $loginApiHandler, LoginApiRequestDataProvider $loginApiDataProvider, ImportItemListApiHandler $importItemListApiHandler, ImportMetricListHandler $importMetricListApiHandler) {
        $this->importItemListApiHandler = $importItemListApiHandler;
        $this->importMetricListApiHandler = $importMetricListApiHandler;
        $this->loginApiHandler = $loginApiHandler;
        $this->loginApiDataProvider = $loginApiDataProvider;

        parent::__construct();
    }

    protected function configure() {
        $this
                ->setDescription('Import needed data from TotalSocial API')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $io = new SymfonyStyle($input, $output);
        try {
            $accessToken = $this->loginApiHandler->process($this->loginApiDataProvider->getData());
            $this->importItemListApiHandler->process(new ImportItemListApiRequestData($accessToken));

            $this->importMetricListApiHandler->process(new ImportMetricListApiRequestData($accessToken));

            $io->success('Import Success');
        } catch (\Exception $ex) {
            $io->error('ERROR:' . $ex->getMessage());
        }
    }

}
