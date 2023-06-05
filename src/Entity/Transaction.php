<?php

namespace App\Entity;

class Transaction
{

    const TABLE_NAME = "Transactions";
//
//CREATE TABLE Transactions (
//uuid VARCHAR(36) PRIMARY KEY,
//selected_currency INT,
//selected_currency_Amount INT,
//target_currency INT,
//target_currency_Amount INT,
//date INT

    private string $uuid;
    private string $selectedCurrency;
    private int $selectedCurrencyAmount;
    private string $targetCurrency;
    private int $targetCurrencyAmount;

    private int $date;

    public function __construct(
        string $selectedCurrency,
        int $selectedCurrencyAmount,
        string $targetCurrency,
        int $targetCurrencyAmount,
    ) {
        $this->uuid = uniqid();
        $this->selectedCurrency = $selectedCurrency;
        $this->selectedCurrencyAmount = $selectedCurrencyAmount;
        $this->targetCurrency = $targetCurrency;
        $this->targetCurrencyAmount = $targetCurrencyAmount;
        $this->date = (new \DateTime("midnight"))->getTimestamp();
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid,
            'selected_currency' => $this->selectedCurrency,
            'selected_currency_amount' => $this->selectedCurrencyAmount,
            'target_currency' => $this->targetCurrency,
            'target_currency_amount' => $this->targetCurrencyAmount,
            'date' => $this->date
        ];
    }


}