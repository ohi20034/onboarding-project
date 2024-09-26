<?php
// Include the configuration file
require_once 'config.php';

class DatabaseConnection
{
    private $servername;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct()
    {
        global $servername, $username, $password, $database;
       
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->connect();
    }

    private function connect()
    {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);
        
        if ($this->connection->connect_error) {
            throw new Exception("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function close()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }
}
?>