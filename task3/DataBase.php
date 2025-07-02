<?php
class DataBase
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

    public static function prepare(string $statement): \PDOStatement
    {
        return static::connection()->prepare($statement);
    }   

    public function execute(string $statement, array $params = []): DataBase
    {
        $this->statement = static::connection()->prepare($statement);
        $this->statement->execute($params);
        return $this;
    }

    public function getComments(): array
    {
        $this->execute("SELECT * FROM users");
        return $this->statement->fetchAll();
    }

    public function addComment(string $username, string $comment): bool | string {
        $username = trim($username);
        $this->execute("INSERT INTO users(username, comment) VALUES (:username, :comment)", [
            'username' => ($username) ?: "Аноним",
            'comment' => $comment,
        ]);
        return $this->connection()->lastInsertId();
    }
}