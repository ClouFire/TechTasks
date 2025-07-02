<?php

require_once __DIR__ . '/config.php';

class DB
{
    private static $instance = null;

    private $connection = null;
    private $statement;

    protected function __construct()
    {
        $this->connection = new \PDO
        (
            "mysql:host=" . DBHOST . ";dbname=". DBNAME .";charset=utf8",
            DBLOGIN,
            DBPASS,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \BadMethodCallException('Unable to deserialize database connection');
    }

    public static function getInstance(): DB
    {
        if(null === self::$instance) {
            return self::$instance = new static();
        }

        return self::$instance;
    }

    public static function connection(): \PDO
    {
        return static::getInstance()->connection;
    }

    public static function prepare($statement): \PDOStatement
    {
        return static::connection()->prepare($statement);
    }

}
