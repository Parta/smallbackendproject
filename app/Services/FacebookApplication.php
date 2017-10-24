<?php

namespace App\Services;


use Facebook\Authentication\AccessToken;
use Facebook\Facebook;

class FacebookApplication extends Facebook
{

    /**
     * Facebook API version
     * @var string
     */
    private $apiVersion = "v2.10";

    /**
     * Facebook Application ID
     * @var string
     */
    private $apiApplicationId = "708652609324248";

    /**
     * Facebook Application Secret Token
     * @var string
     */
    private $apiApplicationSecret = "1a6059c1a7d04baa7203b7159bd747f2";

    public static $fields = [];

    const DEFAULT_FIELDS = [
        'id',
        'name',
        'fan_count'
    ];


    public function __construct()
    {
        parent::__construct([
            'app_id'                => $this->apiApplicationId,
            'app_secret'            => $this->apiApplicationSecret,
            'default_graph_version' => $this->apiVersion,
        ]);
    }

    public function getPageFansCount(string $page)
    {
        $response = $this->_getResponseBody($page);
        return [
            'page_id'   => $response['id'] ?? 0,
            'name'      => $response['name'] ?? $page,
            'count'     => $response['fan_count'] ?? 0,
        ];
    }

    private function _getAccessToken()
    {
        return $this->getApp()->getAccessToken();
    }

    private function _getResponseBody(string $page) {
        $fields     = join(',', self::DEFAULT_FIELDS);
        $response   = $this->get("/{$page}?fields={$fields}", $this->_getAccessToken());
        return $response ?
            $response->getDecodedBody() :
            [];
    }

}