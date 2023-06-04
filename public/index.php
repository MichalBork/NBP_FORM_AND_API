<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Config\Router;
use Controller\MyController;
use Logger\Logger;
use Config\Database\DatabaseConnection;

Router::addRoute('/hello', MyController::class, "hello");
Router::handleRequest("/hello", $_REQUEST);