<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Config\Router;


Router::addRoute('/get-currencies', \Controller\CurrencyController::class, "getAllCurrencyForLastAvailableDate");
Router::addRoute('/', \Controller\CurrencyController::class, "index");
Router::addRoute('/transaction', \Controller\TransactionController::class, "index");
Router::addRoute('/get-transactions', \Controller\TransactionController::class, "getAllTransactionForToday");
Router::addRoute('/add-transaction', \Controller\TransactionController::class, "addNewTransaction");


Router::handleRequest($_SERVER["REQUEST_URI"], setParamForAction());

function setParamForAction(): array
{
    return match ($_SERVER['REQUEST_METHOD']) {
        'GET' => $_GET,
        'POST' => empty($_POST) ? json_decode(file_get_contents('php://input'), true) : $_POST,
        default => []
    };
}