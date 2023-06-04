<?php

namespace config\Database;

use PDO;

interface DatabasePDOInterface
{
    public function createConnection(): PDO;

}