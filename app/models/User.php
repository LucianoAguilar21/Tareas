<?php

namespace App\Models;

use PDO;

class User{
    private $conn;
    private $table = 'users';

    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    public function register($name,$email,$password){
        $sql = "INSERT INTO {$this->table} (name,email,password) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute([$name,$email,$hashed]);

    }

    public function login($email, $password){

        $sql = "SELECT * FROM {$this->table} WHERE email = ? LIMIT 1";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }
    

    
}