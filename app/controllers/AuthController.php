<?php
namespace App\Controllers;



use App\Models\User;
use App\Config\Database;
use PDO;

class AuthController{
    private $user;

    public function __construct( PDO $db) {
        $this->user = new User($db);
    }

    public function register($name,$email,$password){
        return $this->user->register($name,$email,$password);
    }

    public function login($email,$password){
        $user = $this->user->login($email,$password);

        if($user && password_verify($password, $user['password'])){
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_name"] = $user["name"];
            return true;
        }
        return false;

    }
}