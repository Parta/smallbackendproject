<?php

namespace App\Api\EventListener;

use App\Api\Response\ApiResponseProvider;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthenticationFailureListener {

    protected $apiResponseProvider;

    public function __construct(ApiResponseProvider $apiResponseProvider) {
        $this->apiResponseProvider = $apiResponseProvider;
    }

    /**
     * @param AuthenticationFailureEvent $event
     */
    public function onAuthenticationFailureResponse(AuthenticationFailureEvent $event) {
        $data = $this->apiResponseProvider->getErrorResponse('Bad credentials, please verify that your username/password are correctly set');

        $event->setResponse(new JsonResponse($data, JsonResponse::HTTP_UNAUTHORIZED));
    }

}
