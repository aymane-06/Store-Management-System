<?php
namespace App\Controller;
require $_SERVER['DOCUMENT_ROOT'] .'/Store-Management-System/vendor/autoload.php';
use App\Models\Product;

class CreateProduct{

    public  function createProduct(){
        if(isset($_POST['submit'])){
            session_start();
            $name=$_POST['name'];
            $price=$_POST['price'];
            $desc=$_POST['desc'];
            $image=$_POST['image'];
            $quantity=$_POST['quantity'];
            // print_r($_POST);
            foreach ($_POST as $key => $value) {
                if (!$value || empty($value)) {
                    $_SESSION['error'][$key] = "$key is required";
                    setcookie("error", 1, time() + 3600, "/");
                    header('location:/Store-Management-System/app/views/pages/admin/product.php');
            }
            $_SESSION['old']=['name'=>$name,'price'=>$price,'desc'=>$desc,'image'=>$image,'quantity'=>$quantity];
            }
            try{
            $product=new product($name,$desc,$price,$quantity,$image);
            $product->insert();
            header('location:/Store-Management-System/app/views/pages/admin/product.php');
            }catch(\Exception $exception){
                echo "error";
        }

    }
}

}