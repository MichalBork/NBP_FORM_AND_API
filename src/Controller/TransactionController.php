<?php

namespace Controller;

use Http\Response\ResponseFactoryInterface;
use Service\TransactionService;

class TransactionController extends AbstractController
{
    private TransactionService $transactionService;

    public function __construct(ResponseFactoryInterface $responseFactory)
    {
        $this->transactionService = new TransactionService();
        parent::__construct($responseFactory);
    }

    public function index(): void
    {
        $this->returnTemplate("transaction/index.html");
    }


    public function getAllTransactionForToday(): void
    {
        $this->returnJson(
            $this->responseFactory->createResponse(
                200,
                ['Content-Type' => 'application/json'],
                [
                    'data' => $this->transactionService->getAllTransactionForToday(
                        (new \DateTime("midnight"))->getTimestamp()
                    )
                ]
            )
        );
    }

    public function addNewTransaction(array $requestParams): void
    {
        $this->transactionService->addNewTransaction($requestParams);
        $this->returnJson(
            $this->responseFactory->createResponse(
                200,
                ['Content-Type' => 'application/json'],
                [
                    'data' => 'Transaction added successfully'
                ]
            )
        );
    }
}