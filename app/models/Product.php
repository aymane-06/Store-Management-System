<?php
namespace App\Models;
// include $_SERVER['DOCUMENT_ROOT'].'/Store-Management-System/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Store-Management-System/app/Config/connect.php';

use app\Config\connect;
class Product{
    private $pdo;
    private $id;
    private $name;
    private $description;
    private $price;
    private $quantity;
    private $image;

    public function __construct($name,$description,$price,$quantity,$image) {
        $this->name=$name;
        $this->description=$description;
        $this->price=$price;
        $this->quantity=$quantity;
        $this->image=$image;
        $database = new connect('localhost', 'root', '', 'storemanagementsystem');
        $this->pdo = $database->connect();
    }

    public function insert(){
        $sql="INSERT INTO `products`(`name`, `description`, `price`, `quantity`, `image_url`) VALUES (:name,:desc,:price,:quantity,:img)";
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([
            "name"=>$this->name,
            "desc"=>$this->description,
            "price"=>$this->price,
            "quantity"=>$this->quantity,
            "img"=>$this->image,
        ]);
    }
}