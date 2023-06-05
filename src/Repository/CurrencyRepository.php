<?php

namespace Repository;

class CurrencyRepository extends AbstractRepository
{

    public function __construct()
    {
        parent::__construct($this->initializeConnection());
    }
}