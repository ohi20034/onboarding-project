<?php
// Include the configuration file
require_once 'config.php';

class DatabaseConnection
{
    private $servername;
    private $username;
    private $password;
    private $database;
    public $connection;

    public function __construct()
    {
        echo "hello construct ";
        // Declare the global variables to access them
        global $servername, $username, $password, $database;

        // Assign the global variables to the class properties
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        // Establish the connection
        $this->connect();
    }

    private function connect()
    {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        } else {
            echo "Connected successfully";
        }
    }

    public function close()
    {
        if ($this->connection) {
            echo "closed";
            $this->connection->close();
        }
    }
}

$obj = new DatabaseConnection();
$obj->close();