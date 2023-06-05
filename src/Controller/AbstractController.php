<?php

namespace Controller;


use http\Response\Response;
use http\Response\ResponseFactoryInterface;

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

    protected function returnTemplate(string $templateName): void
    {
        $template = file_get_contents(__DIR__ . '/../../templates/' . $templateName);
        echo $template;
    }
}