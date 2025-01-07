<?php
namespace App\Repositories;

use App\Models\Client;
use App\Models\User;
use App\Config\connect;
use PDO;

class AccountManager{
    private $pdo;
    public function __construct() {
        $database = new connect('localhost', 'root', '', 'storemanagementsystem');
        $this->pdo = $database->connect();
    }
    public  function select(){
        $sql="SELECT UserId,name,email,role,created_at,status FROM users";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update($id,$status){
        $sql="UPDATE `users` SET `status` = :status WHERE `users`.`UserId` = :id";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([
            "id"=>$id,
            "status"=>$status
        ]);
    }

}
