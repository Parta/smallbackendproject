<?php

$config = include ('config.php');
Class Connection{
    private $hostname = 'localhost';
    private $username = 'root';
    private $password = '';
    private $db = 'fan_count';
    protected $conn;

    public function connect(){
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->db);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    public function disconnect(){
        $this->conn->close();
    }
}
