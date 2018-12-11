<?php

namespace App\Api\EventListener;

use App\Api\Response\ApiResponseProvider;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTInvalidEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class JWTInvalidListener {

    protected $apiResponseProvider;

    public function __construct(ApiResponseProvider $apiResponseProvider) {
        $this->apiResponseProvider = $apiResponseProvider;
    }

    /**
     * @param JWTInvalidEvent $event
     */
    public function onJWTInvalid(JWTInvalidEvent $event) {
        $data = $this->apiResponseProvider->getErrorResponse('Your token is invalid, please login again to get a new one');

        $event->setResponse(new JsonResponse($data, JsonResponse::HTTP_FORBIDDEN));
    }

    /**
     * @param JWTNotFoundEvent $event
     */
    public function onJWTNotFound(JWTNotFoundEvent $event) {
        $data = $this->apiResponseProvider->getErrorResponse('Missing token');

        $event->setResponse(new JsonResponse($data, JsonResponse::HTTP_FORBIDDEN));
    }

}
