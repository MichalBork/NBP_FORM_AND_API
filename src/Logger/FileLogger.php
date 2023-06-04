<?php
namespace Logger;


class FileLogger extends AbstractLogger
{

    public function log($message, $level): void
    {
        $this->saveLogToFile($message, $level);
    }
}