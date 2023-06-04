<?php

namespace Response;

class ResponseFactory implements ResponseFactoryInterface
{
    public function createResponse(int $statusCode, array $headers = [], array $body = []): ResponseInterface
    {
        return new Response($statusCode, $headers, $body);
    }

}