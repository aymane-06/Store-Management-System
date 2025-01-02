<?php
require $_SERVER['DOCUMENT_ROOT'] .'/Store-Management-System/vendor/autoload.php';

use App\Models\Client;
// Initialize error array and form data variables
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
        $error['email'] = "Email address is considered invalid.";
    }

    if(empty($name) || !preg_match("/^[a-zA-Z-' ]*$/", $name)){
        $error['name'] = "Only letters and white space allowed.";
    }

    if(strlen($password) < 8){
        $error['password'] = "Password too short!";
    }

    if(empty($error['name']) && empty($error['email']) && empty($error['password'])){
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $client=new Client($name,$email,$hashedPassword);
        $client->insert();
    }
}
?>
