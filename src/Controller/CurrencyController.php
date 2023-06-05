<?php

namespace Controller;

use Http\Response\ResponseFactoryInterface;
use Service\CurrencyService;

class CurrencyController extends AbstractController
{

    private CurrencyService $currencyService;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->currencyService = new CurrencyService();
        parent::__construct($responseFactory);
    }


    public function index(): void
    {
        $this->returnTemplate("index.html");
    }

    public function getAllCurrencyForLastAvailableDate(): void
    {
        $this->returnJson(
            $this->responseFactory->createResponse(
                200,
                ['Content-Type' => 'application/json'],
                [
                    'data' => $this->currencyService->getAllCurrencyForAvailableDate(
                        (new \DateTime("midnight"))->getTimestamp()
                    )
                ]
            )
        );
    }

}