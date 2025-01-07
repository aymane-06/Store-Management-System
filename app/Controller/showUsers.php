<?php
include '../../vendor/autoload.php';
include '../repositories/AccountManager.php';
use app\Repositories\AccountManager;
$select=new AccountManager();

echo json_encode($select->select());