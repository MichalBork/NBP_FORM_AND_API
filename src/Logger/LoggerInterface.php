<?php

namespace App\Logger;

interface LoggerInterface
{
    public static function log(string $message, string $level): void;

}