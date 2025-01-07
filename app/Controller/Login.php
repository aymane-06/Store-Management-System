<?php
namespace App\Controller;
require $_SERVER['DOCUMENT_ROOT'] .'/Store-Management-System/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Store-Management-System/app/Config/connect.php';

use app\Config\connect;
use PDO;
class Login{

    public function logIn(){
        
        session_start();
        $name = $email = $password = "";
        $error = [
            "name" => "",
            "email" => "",
            "password" => "",
        ];
        
        // Check if form is submitted
        if(isset($_POST['submit'])){
            
            $email = $_POST['email'];
            $password = $_POST['password'];

        
            if(empty(htmlspecialchars($email)) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['old'] = ['email' => $email];
                $_SESSION['error']['email'] = "Email address is considered invalid.";
                header('Location: ../app/views/pages/sginIn.php');
                exit;
                
            }


        $connect=new connect('localhost','root','','storemanagementsystem');
        $pdo= $connect->connect();

        
        
        $sql = "SELECT * FROM `users` WHERE email=:email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            "email" => $email
        ]);
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        // print_r($result['password']);
        if(!$stmt->fetchAll(PDO::FETCH_ASSOC)){
            $_SESSION['error']['email'] = "Email address is not signed UP.";
            header('Location: ../app/views/pages/sginIn.php');
                exit;
        }
        elseif(!password_verify($password,$result['password'])){
            $_SESSION['old'] = ['email' => $email];
            $_SESSION['error']['password'] = "incorrect password!";
            header('Location: ../app/views/pages/sginIn.php');
                exit;
        }
        else{
            $_SESSION['user']=["name"=>$result['name'],"email"=>$result['email'],"role"=>$result['role']];
            // print_r($_SESSION['user']);

        }
        
        
        
    }
}
}