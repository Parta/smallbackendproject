<?php

$config = include ('../config.php');
Class Connection{
    protected $conn;
    public function connect(){
        $this->conn = new mysqli($config->host, $config->username, $config->password, $this->dbName);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    public function disconnect(){
        $this->conn->close();
    }
}
