<?php
namespace App\Models;

require_once $_SERVER['DOCUMENT_ROOT'] . '/Store-Management-System/app/Config/connect.php';
use App\Config\Database;
use App\Config\connect;
use PDO;
use Exception;


class Client extends User {
    private $role = 'Client';
    private $pdo;

    public function __construct($name,$email,$password) {
        $database = new connect('localhost', 'root', '', 'storemanagementsystem');
        $this->pdo = $database->connect();
        parent::__construct($name,$email,$password);
    }

    public function insert() {
        $sql="SELECT * FROM users WHERE email=:email";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([
            "email"=>$this->email
        ]);
        $result= $stmt->fetch(PDO::FETCH_ASSOC);
         if($result){
            throw new Exception("this email is already signUp!");
         }

        $sql = "INSERT INTO `users`(`name`, `email`, `password`, `role`) VALUES (:name, :email, :psw, :role)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "name" => $this->name,
            "email" => $this->email,
            "psw" => $this->password,
            "role" => $this->role
        ]);
    }

    // Select method
    public  function select() {
        $sql = "SELECT `UserId`, `name`, `email`, `password`, `role`, `status`, `created_at`, `deleted_at` FROM `users` WHERE email=:email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "email" => $this->email
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
?>
