<?php
class Database
{
    //databáze parametry
    private $host = 'localhost';
    private $db_name = 'second_round_task';
    private $username = 'root';
    private $password = '';
    private $connection;

    //databáze připojení
    public function connect()
    {
        $this->connection = null;

        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->connection;
    }
}
