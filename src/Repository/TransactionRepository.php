<?php

namespace App\Repository;

class TransactionRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct($this->initializeConnection());
    }

}