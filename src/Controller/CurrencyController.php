<?php

namespace App\Controller;

use App\Http\Response\ResponseFactoryInterface;
use App\Service\CurrencyService;

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

    public function getAvailableCurrencyCodes(): void
    {
        $this->returnJson(
            $this->responseFactory->createResponse(
                200,
                ['Content-Type' => 'application/json'],
                [
                    'data' => $this->currencyService->getAvailableCurrencyCodes()
                ]
            )
        );
    }

}