<?php

namespace App\Service;

use App\Entity\Currency;
use App\Entity\Transaction;
use App\Repository\CurrencyRepository;
use App\Repository\TransactionRepository;

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


    /**
     * @throws \Exception
     */
    public function addNewTransaction(array $param): void
    {
        try {
            $this->validateTransaction($param);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }


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
        return round($amountInPLN / $expectedCurrency[0]['buy_value']);
    }

    private function validateTransaction(array $param): void
    {
        if (!isset($param['selectedCurrency']) || !isset($param['selectedCurrencyAmount']) || !isset($param['expectedCurrency'])) {
            throw new \InvalidArgumentException('Invalid transaction data');
        }

        if (!is_numeric($param['selectedCurrencyAmount']) || $param['selectedCurrencyAmount'] <= 0) {
            throw new \InvalidArgumentException('Invalid transaction amount');
        }


        if ($this->isCurrencyCorrectSelected($param['selectedCurrency']) || $this->isCurrencyCorrectSelected(
                $param['expectedCurrency']
            )) {
            throw new \InvalidArgumentException('Invalid selected currency');
        }
    }

    /**
     * @param $selectedCurrency
     * @return bool
     */
    private function isCurrencyCorrectSelected($selectedCurrency): bool
    {
        return !in_array(
            $selectedCurrency,
            array_map(function ($currency) {
                return $currency['code'];
            }, $this->currencyRepository->getAvailableCurrencyCodes())
        );
    }


}