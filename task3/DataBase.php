<?php
class DataBase
{
    private static $instance = null;
    private $connection = null;

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

    protected function __clone(): void
    {
    }
    public function __wakeup()
    {
        throw new \BadMethodCallException('Unable to deserialize database connection');
    }

    public static function getInstance(): DataBase
    {
        if(null === self::$instance)
        {
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

    public function getComments()
    {
        $query = DataBase::prepare("SELECT * FROM users");
        $query->execute();
        return $query->fetchAll();
    }

    public function addComment($username, $comment) {

        $query = DataBase::prepare("INSERT INTO users(username, comment) VALUES (:username, :comment)");
        $query->execute([
            'username' => $username ?: "Аноним",
            'comment' => $comment,
        ]);

        return True;
    }
}