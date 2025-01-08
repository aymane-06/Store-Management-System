<?php
namespace App\Repositories;

use App\Models\Client;
use App\Models\User;
use App\Config\connect;
use PDO;

class ProductManager{

    private $pdo;

    public function __construct(){
        $database = new connect('localhost', 'root', '', 'storemanagementsystem');
        $this->pdo = $database->connect();
    }
    public function select(){
        $sql="SELECT * FROM products WHERE deleted_at IS NULL";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function update($id,$name,$desc,$price,$qte,$image){
        $sql="UPDATE `products` SET `name`=:name,`description`=:desc,`price`=:price,`quantity`=:qte,`image_url`=:image WHERE id=:id";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([
            "name"=>$name,
            "desc"=>$desc,
            "price"=>$price,
            "qte"=>$qte,
            "image"=>$image,
            "id"=>$id
        ]);
    }
    public function selectAProduct($id){
        $sql="SELECT * FROM products WHERE deleted_at IS NULL && id=:id";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([
            "id"=>$id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}