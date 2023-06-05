<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Logger\Logger;
use App\Service\CurrencyService;

$service = new CurrencyService();
try {
    $service->setPresentValueForAllCurrencyFromNBP();
    echo "Data updated successfully";
} catch (\Exception $e) {
    Logger::log($e->getMessage(), Logger::EMERGENCY);
}

