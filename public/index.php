<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Config\Router;


Router::addRoute('/get-currencies', App\Controller\CurrencyController::class, "getAllCurrencyForLastAvailableDate");
Router::addRoute('/', App\Controller\CurrencyController::class, "index");
Router::addRoute('/transaction', App\Controller\TransactionController::class, "index");
Router::addRoute('/get-transactions', App\Controller\TransactionController::class, "getAllTransactionForToday");
Router::addRoute('/add-transaction', App\Controller\TransactionController::class, "addNewTransaction");
Router::addRoute('/get-available-currency-codes', App\Controller\CurrencyController::class, "getAvailableCurrencyCodes"
);

Router::handleRequest(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), setParamForAction());

function setParamForAction(): array
{
    return match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $_GET,
        'POST' => empty($_POST) ? json_decode(file_get_contents('php://input'), true) : $_POST,
        default => []
    };
}