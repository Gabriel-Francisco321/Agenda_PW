<?php 

class Entity
{
    protected PDO $pdo;

    private $dsn = "mysql:host=localhost;dbname=agenda;chaset=utf8mb4";
    private $user = "root";
    private $password = "";

    public function __construct() {
        $this->pdo = $pdo = new PDO($this->dsn, $this->user, $this->password);;
    }
}

?>