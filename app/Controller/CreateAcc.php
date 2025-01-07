<?php
namespace App\Controller;
require $_SERVER['DOCUMENT_ROOT'] .'/Store-Management-System/vendor/autoload.php';

use App\Models\Client;
use Exception;

class CreateAcc
{
    public function create()
    {
        session_start();
        $name = $email = $password = "";
        $error = [
            "name" => "",
            "email" => "",
            "password" => "",
        ];
        
        // Check if form is submitted
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
        
            if(empty(htmlspecialchars($email)) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['old'] = ['name'=> $name, 'email' => $email];
                $_SESSION['error']['email'] = "Email address is considered invalid.";
                header('Location: ../app/views/pages/sginUp.php');
                exit;
                
            }
        
            if(empty($name) || !preg_match("/^[a-zA-Z-' ]*$/", $name)){
                $_SESSION['old'] = ['name'=>$name, 'email' =>$email];
                $_SESSION['error']['name'] = "Only letters and white space allowed.";
                header('Location: ../app/views/pages/sginUp.php');
                exit;
            }
        
            if(strlen($password) < 8){
                $_SESSION['old'] = ['name'=>$name, 'email' =>$email];
                $_SESSION['error']['password'] = "Password too short!";
                header('Location: ../app/views/pages/sginUp.php');
                exit;
                

            }
        
           try{ if(empty($error['name']) && empty($error['email']) && empty($error['password'])){
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $client=new Client($name,$email,$hashedPassword);
                $client->insert();
            }}
            catch(Exception $th){
                $_SESSION['error']['email'] = $th->getMessage();
                $_SESSION['old'] = ['name'=>$name, 'email' =>$email];
                header('Location: ../app/views/pages/sginUp.php');
            }
        }
    }
}
?>
