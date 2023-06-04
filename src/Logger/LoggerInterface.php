<?php

namespace Logger;

interface LoggerInterface
{
    public static function log(string $message, string $level): void;

}