<?php
include '../../vendor/autoload.php';

use App\Repositories\AccountManager;

if(isset($_GET['id'])&&isset($_GET['status'])){
$id=$_GET['id'];
$status=$_GET['status'];

$editedAcc=new AccountManager();
$editedAcc->update($id,$status);
}