<?php

namespace Controller;

use http\Response\ResponseFactoryInterface;


class MyController extends AbstractController
{

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        parent::__construct($responseFactory);
    }

    public function hello(): void
    {
        $response = $this->responseFactory->createResponse(
            200,
            ['Content-Type' => 'text/html'],
            ['message' => 'Hello World!']
        );
        $this->returnTemplate("index.html");
    }


}