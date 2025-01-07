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
}