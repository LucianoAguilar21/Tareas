<?php

namespace App\Config;

use PDO;
use PDOException;

class Database{
    private $host = "127.0.0.1";
    private $db = "todo_app";
    private $user = "root";
    private $password = "";

    public $conn;

    public function connect()
    {
        try{
            $dsn = "mysql:host={$this->host};dbname={$this->db};charset=utf8";
            $this->conn = new PDO($dsn, $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $exception){
            die('Error de conexion: ' . $exception->getMessage());
        }
    }


}