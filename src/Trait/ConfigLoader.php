<?php

namespace Trait;

trait ConfigLoader
{

    private string $configPath = __DIR__ . '/../../config/config.php';

    public function loadConfig($configName)
    {
        $config = require $this->configPath;
        return $config[$configName];
    }


}