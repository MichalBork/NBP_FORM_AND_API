<?php

namespace Logger;


use Trait\ConfigLoader;

class Logger implements LoggerInterface
{
    use ConfigLoader;

    public const EMERGENCY = 'EMERGENCY';
    public const ERROR = 'ERROR';
    public const WARNING = 'WARNING';
    protected array $loggerConfig;

    private const DEFAULT_LOG_FORMAT = 'Y-m-d H:i:s';
    private const DEFAULT_LOG_PATH = __DIR__ . '/../../logs/';


    public static function log(string $message, string $level): void
    {
        $logFile = sprintf('%s%s.log', self::DEFAULT_LOG_PATH, date('Y-m-d'));
        $message = sprintf("%s %s %s\n", date(self::DEFAULT_LOG_FORMAT), $level, $message);
        file_put_contents($logFile, $message, FILE_APPEND);
    }


}