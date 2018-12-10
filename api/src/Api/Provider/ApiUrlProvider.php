<?php

namespace App\Api\Provider;

class ApiUrlProvider {
    
    protected $baseUri;
    protected $urls;

    public function __construct($apiSettings) {
        $this->baseUri = $apiSettings['baseUri'];
        $this->urls = $apiSettings['urls'];
    }
    
    public function getUrl($name) {
        if (!array_key_exists($name, $this->urls)) {
            throw new \Api\Exception\ApiUrlNotFoundException('error.api_url_not_found');
        }
        
        return $this->baseUri . '/' . $this->urls[$name];
    }
}
