<?php

namespace Repository;

use config\Database\DatabaseConnection;
use Logger\Logger;

abstract class AbstractRepository
{
    protected \PDO $connection;

    public function __construct()
    {
        try {
            $this->connection = (new DatabaseConnection())->createConnection();
        } catch (\PDOException $e) {
            Logger::log($e->getMessage(), Logger::EMERGENCY);
        }
    }

    /**
     * @param array $conditions
     * @return string
     */
    private function getAllSearchParam(array $conditions): string
    {
        return implode(
            ' AND ',
            array_map(fn($condition) => sprintf('%s = :%s', $condition, $condition), array_keys($conditions))
        );
    }

    /**
     * @param string $table
     * @param array $conditions
     * @return array
     * @throws \PDOException
     */
    protected function findBy(string $table, array $conditions): array
    {
        try {
            $query = sprintf(
                'SELECT * FROM %s WHERE %s',
                $table,
                $this->getAllSearchParam($conditions)
            );
            $statement = $this->connection->prepare($query);
            $statement->execute($conditions);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * @param string $table
     * @param array $record
     * @return void
     */
    protected function addRecord(string $table, array $record): void
    {
        try {
            $query = sprintf(
                'INSERT INTO %s (%s) VALUES (%s)',
                $table,
                implode(', ', array_keys($record)),
                ':' . implode(', :', array_keys($record))
            );
            $statement = $this->connection->prepare($query);
            $statement->execute($record);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }


}