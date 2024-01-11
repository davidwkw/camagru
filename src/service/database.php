<?php

declare(strict_types=1);

use PgSql\Connection;

require("../model/User.php");

class PGSQLDataSource
{
    private string $host;
    private string $port;
    private string $dbName;
    private string $dbUser;
    private string $dbPassword;
    private null | Connection | false $dbConnection;

    public function __construct($host, $port, $dbName, $dbUser, $dbPassword)
    {
        $this->host = $host;
        $this->port = $port;
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
        try {
            $this->establishDbConnection();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function __destruct()
    {
        $this->dbConnection = null; // disconnect from db
    }

    private function establishDbConnection(): void
    {
        $connectionString = "host = $this->host port = $this->port dbname = $this->dbName user = $this->dbUser $ password=$this->dbPassword";
        $this->dbConnection = pg_connect($connectionString);
        if (!$this->dbConnection) {
            throw new PDOException("Error : Unable to open database\n");
        }
    }

    public function getConnection(): Connection
    {
        return $this->dbConnection;
    }

    public function getRepository(UserRecord $recordType)
    {
    }
}

function insertUser($dbConn, $username, $hashedPassword, $email)
{
    $sql = 'INSERT INTO users (username,password,email) VALUES (:username,:hashedPassword,:email)';
    $stmt = $dbConn->pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':hashedPassword', $hashedPassword);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    return $dbConn->pdo->lastInsertId('stocks_id_seq');
}
