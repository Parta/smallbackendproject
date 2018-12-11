<?php

namespace App\Api\EventListener;

use App\Api\Response\ApiResponseProvider;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTExpiredListener {

    protected $apiResponseProvider;

    public function __construct(ApiResponseProvider $apiResponseProvider) {
        $this->apiResponseProvider = $apiResponseProvider;
    }

    /**
     * @param JWTExpiredEvent $event
     */
    public function onJWTExpired(JWTExpiredEvent $event) {
        $data = $this->apiResponseProvider->getErrorResponse('Your token is expired, please renew it.');

        $event->setResponse(new JsonResponse($data, JsonResponse::HTTP_FORBIDDEN));
    }

}
