<?php

declare(strict_types=1);

class PSQLDB
{
    private string $type;
    private string $host;
    private string $port;
    private string $dbName;
    private string $dbUser;
    private string $dbPassword;
    private null | PDO $dbConnection;

    public function __construct($type, $host, $port, $dbName, $dbUser, $dbPassword)
    {
        $this->type = $type;
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

    private function establishDbConnection(): void
    {
        $type = $this->selectDSNName($this->type);
        $dsn = "$type:dbname=$this->dbName;host=$this->host;port=$this->port";
        $pdoModes = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $this->dbConnection = new PDO($dsn, $this->dbUser, $this->dbPassword, $pdoModes);
        if (!$this->dbConnection) {
            throw new PDOException("Connection to database has failed");
        }
        $this->dbConnection->beginTransaction();
    }

    private function selectDSNName(string $type): string
    {
        $type = strtolower($type);

        switch ($type) {
            case 'postgresql':
                return 'pgsql';
            case 'mysql':
                return 'mysql';
            default:
                throw new PDOException("Database type is not supported");
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
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
