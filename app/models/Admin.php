<?php
namespace App\Models;
include './User.php';
include '../Config/connect.php';

class Admin extends User{
private $role;
public function insert() {
    global $pdo;
    $sql="INSERT INTO `users`(`name`, `email`, `password`) VALUES (:name,:email,:psw)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        "name"=>$this->name,
        "email"=>$this->email,
        "psw"=>$this->password
    ]);


}
public function select() {
    
}

}