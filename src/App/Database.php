<?php

namespace App;

use PDO;

class Database
{
    public function __construct(private $host, private $name, private $user, private $password)
    {
        
    }
    public function getConnection()
    {
        $dsn = "mysql:host=$this->host;dbname=$this->name;";
        $pdo = new PDO($dsn, $this->user, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);    
        return $pdo;
    }
}