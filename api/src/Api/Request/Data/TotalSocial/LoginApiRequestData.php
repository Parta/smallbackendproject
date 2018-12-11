<?php

namespace App\Api\Request\Data\TotalSocial;

use App\Api\Request\Data\ApiRequestDataInterface;

class LoginApiRequestData implements ApiRequestDataInterface {

    public $grantType;
    public $clientId;
    public $clientSecret;

}
