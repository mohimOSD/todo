<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'todo_list1';
    private $user = 'root';
    private $pass = '';
    public $conn;


    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $ex) {
           echo "Connection failed: " . $ex->getMessage();
           return $this->conn;
        }
    }
}