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
            $_POST['id']='wow';
            print_r($image);
            $img_url = '/Store-Management-System/uploads/'.time().$image['name'];
                $target=$_SERVER['DOCUMENT_ROOT'].$img_url;
                move_uploaded_file($image['tmp_name'],$target);
            
            // Validate inputs
            foreach ($_POST as $key => $value) {
                if (!$value || empty($value)) {
                    $_SESSION['error'][$key] = "$key is required";
                $_SESSION['old'] = ['name' => $name, 'price' => $price, 'desc' => $desc, 'quantity' => $quantity,'image'=>$img_url];
                    setcookie("error", 1, time() + 3600, "/");
                    header('location:/Store-Management-System/app/views/pages/admin/product.php');
                    exit;
                }
            }

            $_SESSION['old'] = ['name' => $name, 'price' => $price, 'desc' => $desc, 'quantity' => $quantity,'image'=>$img_url];

            

            
            
            try {
                $product = new Product($name, $desc, $price, $quantity, $img_url);
                $product->insert();
                header('location:/Store-Management-System/app/views/pages/admin/product.php');
            } catch (\Exception $exception) {
                echo "Error: " . $exception->getMessage();
            }
        }
    }
}
