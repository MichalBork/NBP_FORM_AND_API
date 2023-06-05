<?php

namespace config\Database;

use Config\Database\DatabasePDOInterface;
use Trait\ConfigLoader;

class DatabaseConnection implements DatabasePDOInterface
{
    use ConfigLoader;

    private mixed $dbConfig;

    public function __construct()
    {
        $this->dbConfig = $this->loadConfig('database');
    }

    /**
     * @return \PDO
     * @throws \PDOException
     */
    public function createConnection(): \PDO
    {
        if (!$this->isConfigValid()) {
            throw new \PDOException('Invalid database configuration');
        }
        try {
            $dsn = sprintf(
                '%s:host=%s;dbname=%s',
                $this->dbConfig['driver'],
                $this->dbConfig['host'],
                $this->dbConfig['dbname']
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        return new \PDO($dsn, $this->dbConfig['user'], $this->dbConfig['password']);
    }

    private function isConfigValid(): bool
    {
        {
            return isset($this->dbConfig['driver'])
                && isset($this->dbConfig['host'])
                && isset($this->dbConfig['dbname'])
                && isset($this->dbConfig['user'])
                && isset($this->dbConfig['password']);
        }
    }

}