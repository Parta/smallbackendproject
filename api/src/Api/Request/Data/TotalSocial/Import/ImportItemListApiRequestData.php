<?php

namespace App\Api\Request\Data\TotalSocial\Import;

use App\Api\Request\Data\ApiRequestDataInterface;

class ImportItemListApiRequestData implements ApiRequestDataInterface {

    public $accessToken;

    public function __construct($accessToken) {
        $this->accessToken = $accessToken;
    }

}
