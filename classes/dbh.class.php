<?php

class Dbh
{

    private $host = 'localhost';
    private $user = '';
    private $pass = '';
    private $dbName = 'Users';

    protected function connect()
    {
        $dsn = "sqlsrv:server=$this->host;Database=$this->dbName";
        $pdo = new PDO($dsn, $this->user, $this->pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //fetch associative array
        return $pdo;
    }
}
