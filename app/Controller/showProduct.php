<?php
include '../../vendor/autoload.php';
include '../repositories/ProductManager.php';
use app\Repositories\ProductManager;
$select=new ProductManager();

echo json_encode($select->select());