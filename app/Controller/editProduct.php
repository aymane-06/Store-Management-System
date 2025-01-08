<?php
require $_SERVER['DOCUMENT_ROOT'] . '/Store-Management-System/vendor/autoload.php';
include '../repositories/ProductManager.php';
use app\Repositories\ProductManager;
use app\models\Product;
$id;
if(isset($_GET['id'])){
    global $id;
 $id=$_GET['id'];

    $product= new ProductManager();
    echo json_encode($product->selectAProduct($id));
}

if (isset($_POST['submit'])) {
    session_start();
    $id=$_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $quantity = $_POST['quantity'];
    $image = $_POST['image'];

    // Validate required fields
    foreach ($_POST as $key => $value) {
        if (!$value || empty($value)) {
            $_SESSION['error'][$key] = "$key is required";
            $_SESSION['old'] = [
                'name' => $name,
                'price' => $price,
                'desc' => $desc,
                'quantity' => $quantity
            ];
            setcookie("error", 1, time() + 3600, "/");
            header('location:/Store-Management-System/app/views/pages/admin/product.php');
            exit;
        }
    }

    // Validate if price and quantity are numeric
    if (!is_numeric($price) || !is_numeric($quantity)) {
        $_SESSION['error']['numeric'] = "Price and quantity must be numeric values.";
        $_SESSION['old'] = [
            'name' => $name,
            'price' => $price,
            'desc' => $desc,
            'quantity' => $quantity
        ];
        setcookie("error", 1, time() + 3600, "/");
        header('location:/Store-Management-System/app/views/pages/admin/product.php');
        exit;
    }

    
    $_SESSION['old'] = [
        'name' => $name,
        'price' => $price,
        'desc' => $desc,
        'quantity' => $quantity
    ];

    try {
        // Assume $id is available from elsewhere (e.g., product ID)
        $product = new ProductManager();
        $product->update($id, $name, $desc, $price, $quantity, $image);
        header('location:/Store-Management-System/app/views/pages/admin/product.php');

    } catch (\Exception $exception) {
        echo "Error: " . $exception->getMessage();
    }
}



