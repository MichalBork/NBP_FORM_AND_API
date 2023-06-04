<?php

namespace Controller;


use Response\Response;
use Response\ResponseFactoryInterface;

abstract class AbstractController
{
    protected ResponseFactoryInterface $responseFactory;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->responseFactory = $responseFactory;
    }

    protected function returnJson(Response $response): void
    {
        http_response_code($response->getStatusCode());
        foreach ($response->getHeaders() as $name => $value) {
            header(sprintf('%s: %s', $name, $value));
        }
        echo json_encode($response->getBody());
    }
}