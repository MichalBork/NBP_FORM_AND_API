<?php

namespace Console;

use Logger\Logger;

class UpdateCurrenciesData
{


    public function __construct()
    {
        $service = new \Service\CurrencyService();
        try {
            $service->setPresentValueForAllCurrencyFromNBP();
        } catch (\Exception $e) {
            Logger::log($e->getMessage(), Logger::EMERGENCY);
        }
    }

}