<?php

namespace Response;

interface ResponseFactoryInterface
{
    public function createResponse(int $statusCode, array $headers = [], array $body = []): ResponseInterface;

}