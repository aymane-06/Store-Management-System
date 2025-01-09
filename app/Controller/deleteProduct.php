<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Store-Management-System/vendor/autoload.php';
include '../repositories/ProductManager.php';
use app\Repositories\ProductManager;
use app\models\Product;

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $product=new ProductManager();
    $product->delete($id);
}