<?php

namespace Service;

use Entity\Currency;
use Entity\Transaction;
use Repository\CurrencyRepository;
use Repository\TransactionRepository;

class TransactionService
{

    private TransactionRepository $transactionRepository;

    public function __construct()
    {
        $this->transactionRepository = new TransactionRepository();
        $this->currencyRepository = new CurrencyRepository();
    }

    public function getAllTransactionForToday(int $getTimestamp): array
    {
        return $this->transactionRepository->findBy(Transaction::TABLE_NAME, ['date' => $getTimestamp]);
    }


    public function addNewTransaction(array $param): void
    {
        $selectedCurrency = $this->currencyRepository->getSpecificCurrencyByDate(
            $param['selectedCurrency'],
            (new \DateTime("midnight"))->getTimestamp()
        );
        $expectedCurrency = $this->currencyRepository->getSpecificCurrencyByDate(
            $param['expectedCurrency'],
            (new \DateTime("midnight"))->getTimestamp()
        );

        $transaction = new Transaction(
            $param['selectedCurrency'],
            $param['selectedCurrencyAmount'],
            $param['expectedCurrency'],
            $this->swapPLNToExpectedCurrencyAmount(
                $expectedCurrency,
                $this->swapSelectedCurrencyAmountToPLN(
                    $selectedCurrency,
                    $param['selectedCurrencyAmount']
                )
            )
        );

        $this->transactionRepository->addRecord(Transaction::TABLE_NAME, $transaction->toArray());
    }

    private function swapSelectedCurrencyAmountToPLN(array $selectedCurrency, int $amountFromRequest): int
    {
        return $amountFromRequest * $selectedCurrency[0]['sell_value'];
    }

    private function swapPLNToExpectedCurrencyAmount(array $expectedCurrency, int $amountInPLN): int
    {
        return $amountInPLN / $expectedCurrency[0]['buy_value'];
    }

}