<?php

declare(strict_types=1);

namespace Camagru;

use Exception;
use PgSql\Connection;

class PGSQLDB
{
    private string $host;
    private string $port;
    private string $dbName;
    private string $dbUser;
    private string $dbPassword;
    private Connection $dbConnection;

    public function __construct(string $host, string $port, string $dbName, string $dbUser, string $dbPassword)
    {
        $this->host = $host;
        $this->port = $port;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
        $this->establishDbConnection();
    }

    public function __destruct()
    {
        pg_close($this->dbConnection); // disconnect from db
    }

    private function establishDbConnection(): void
    {
        $connectionString = "host=$this->host port=$this->port dbname=$this->dbName user=$this->dbUser password=$this->dbPassword";
        $this->dbConnection = pg_connect($connectionString);
        if (!$this->dbConnection) {
            throw new Exception("Error : Unable to open database\n");
        }
    }

    public function getDbConnection(): Connection
    {
        return $this->dbConnection;
    }
}
