<?php

namespace App\Repository;

use App\Entity\Currency;

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

    public function getAvailableCurrencyCodes(): array
    {
        $sql = "SELECT DISTINCT code FROM Currencies";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }
}