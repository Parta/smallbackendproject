<?php

namespace App\Api\Provider;

use App\Api\Request\Data\TotalSocial\LoginApiRequestData;

class LoginApiRequestDataProvider implements ApiRequestDataProviderInterface {
    
    protected $loginApiRequestData;
    
    public function __construct($grantType, $clientId, $clientSecret) {
        $this->loginApiRequestData = new LoginApiRequestData;
        
        $this->loginApiRequestData->grantType = $grantType;
        $this->loginApiRequestData->clientId = $clientId;
        $this->loginApiRequestData->clientSecret = $clientSecret;
    }
    
    public function getData() {
        return $this->loginApiRequestData;
    }
}
