<?php
include $_SERVER['DOCUMENT_ROOT'].'/Store-Management-System/vendor/autoload.php';

use App\Controller\CreateAcc;
use App\Controller\Login;
use App\Controller\CreateProduct;


$method = $_SERVER['REQUEST_METHOD'];

$url = $_POST['url'] ?? null;

$routes = [
    'adduser' => [CreateAcc::class, 'create'],
    'login'   => [Login::class, 'logIn']  ,
    'addProduct'=>[CreateProduct::class,'createProduct']
];

if (isset($routes[$url])) {
    [$controllerClass, $methodName] = $routes[$url];

    $object = new $controllerClass();

    $object->$methodName();
 
} else {
    http_response_code(404);
    echo "Route not found.";
}