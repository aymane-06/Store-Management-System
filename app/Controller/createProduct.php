<?php
namespace App\Controller;
require $_SERVER['DOCUMENT_ROOT'] . '/Store-Management-System/vendor/autoload.php';
use App\Models\Product;

class CreateProduct
{
    public function createProduct()
    {
        if (isset($_POST['submit'])) {
            session_start();

            $name = $_POST['name'];
            $price = $_POST['price'];
            $desc = $_POST['desc'];
            $quantity = $_POST['quantity'];
            $image = $_FILES['image'];

            // Validate inputs
            foreach ($_POST as $key => $value) {
                if (!$value || empty($value)) {
                    $_SESSION['error'][$key] = "$key is required";
                $_SESSION['old'] = ['name' => $name, 'price' => $price, 'desc' => $desc, 'quantity' => $quantity];
                    setcookie("error", 1, time() + 3600, "/");
                    header('location:/Store-Management-System/app/views/pages/admin/product.php');
                    exit;
                }
            }

            // if (!$image || $image['error'] !== UPLOAD_ERR_OK) {
            //     $_SESSION['error']['image'] = "Image upload failed";
            //     $_SESSION['old'] = ['name' => $name, 'price' => $price, 'desc' => $desc, 'quantity' => $quantity];
            //     setcookie("error", 1, time() + 3600, "/");
            //     header('location:/Store-Management-System/app/views/pages/admin/product.php');
            //     exit;
            // }

            $_SESSION['old'] = ['name' => $name, 'price' => $price, 'desc' => $desc, 'quantity' => $quantity];

            // $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/Store-Management-System/uploads/';
            // $imageFileName = uniqid() . '-' . basename($image['name']);
            // $uploadFilePath = $uploadDir . $imageFileName;

            // if (!move_uploaded_file($image['tmp_name'], $uploadFilePath)) {
            //     $_SESSION['error']['image'] = "Failed to save the uploaded image.";
            //     header('location:/Store-Management-System/app/views/pages/admin/product.php');
            //     exit;
            // }

            // $imageURL = '/Store-Management-System/uploads/' . $imageFileName;
            
            try {
                $product = new Product($name, $desc, $price, $quantity, $image);
                $product->insert();
                header('location:/Store-Management-System/app/views/pages/admin/product.php');
            } catch (\Exception $exception) {
                echo "Error: " . $exception->getMessage();
            }
        }
    }
}
