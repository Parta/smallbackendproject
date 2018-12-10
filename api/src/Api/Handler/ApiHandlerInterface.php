<?php

namespace App\Api\Handler;

use App\Api\Request\Data\ApiRequestDataInterface;

interface ApiHandlerInterface {
    
    public function process(ApiRequestDataInterface $requestData);
}
