<?php 

class Entity
{

    private static $dsn = "mysql:host=localhost;dbname=agenda;chaset=utf8mb4";
    private static $user = "root";
    private static $password = "";

    protected static function getPDO (): PDO
    {
        return new PDO(self::$dsn, self::$user, self::$password);
    }
}

?>