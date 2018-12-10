<?php

namespace App\Api\Handler\TotalSocial\Import;

use App\Api\Client\ApiClient;
use App\Api\Handler\ApiHandlerInterface;
use App\Api\Request\Data\ApiRequestDataInterface;
use App\Repository\BrandRepository;

class ImportItemListApiHandler implements ApiHandlerInterface {

    protected $apiClient;
    protected $brandRepository;
    protected $acceptedBrandIds = [70905, 70933];

    public function __construct(ApiClient $apiClient, BrandRepository $brandRepository) {
        $this->apiClient = $apiClient;
        $this->brandRepository = $brandRepository;
    }

    public function process(ApiRequestDataInterface $requestData) {
        $response = $this->apiClient->getItemList($requestData->accessToken);
        
        $this->brandRepository->importBrands($response['data'], $this->acceptedBrandIds);

        return $this->brandRepository->getBrandImportList();
    }

}
