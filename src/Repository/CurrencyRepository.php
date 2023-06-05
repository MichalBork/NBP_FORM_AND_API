<?php

namespace Repository;

use Entity\Currency;

class CurrencyRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct($this->initializeConnection());
    }

    public function getSpecificCurrencyByDate(string $code, int $date): array
    {
        return $this->findBy(Currency::TABLE_NAME, ['code' => $code, 'date' => $date]);
    }
}