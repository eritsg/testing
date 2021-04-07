<?php

class AdminProductController{

    private $product; // defining a variable to assign it to its model!

    public function __construct()
    {
        $this->product = new AdminProductModel();
    }

    public function listProducts(){
        AuthController::isLogged();
        //var_dump($_POST);
            $allProducts = $this->product->getProducts();
            require_once('./views/admin/products/AdminProductsItems.php');
    }

    public function addProduct(){
        AuthController::isLogged();

        if(isset($_POST['submitted']) ){
            // && !empty($_POST['marque']) && !empty($_POST['prix'])
            $name = trim(htmlentities(addslashes($_POST['name'])));
            $description = trim(htmlentities(addslashes($_POST['description'])));
            $quantity = trim(htmlentities(addslashes($_POST['quantity'])));
            $price = trim(htmlentities(addslashes($_POST['price'])));
            $image = $_FILES['image']['name'];

            $newProduct = new Product();
            $newProduct->setName($name);
            $newProduct->setDescription($description);
            $newProduct->setQuantity($quantity);
            $newProduct->setPrice($price);
            $newProduct->setImage($image);

            $destination = './assets/images/';
            move_uploaded_file($_FILES['image']['tmp_name'],$destination.$image);
            $ok = $this->product->insertProduct($newProduct);
            if($ok){
                header('location:index.php?action=list_products');
            }
        }
        //affichage du formulaire
    //    $tabCat = $this->adcat->getCategories();
        require_once('./views/admin/products/adminAddProduct.php');
    }

    public function removeProduct(){
        AuthController::isLogged();
        // AuthController::accessUser();
       if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
           $id = $_GET['id'];
           $deleteProduct = new Product();
           $deleteProduct->setId($id);
           $nb = $this->product->deleteProduct($deleteProduct);

           if($nb > 0){
               header('location:index.php?action=list_products');
           }
           
       } 
    }

    public function editProduct(){
        AuthController::isLogged();
        if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
            $id = $_GET['id'];
            $editProduct = new Product();
            $editProduct->setId($id);
            $productEdition = $this->product->productItem($editProduct);
           
           if(isset($_POST['submitted'])){
               $id = trim(htmlentities(addslashes($_POST['id'])));
               $name = trim(htmlentities(addslashes($_POST['name'])));
               $description = trim(htmlentities(addslashes($_POST['description'])));
               $quantity = trim(htmlentities(addslashes($_POST['quantity'])));
               $price = trim(htmlentities(addslashes($_POST['price'])));
               $image = $_FILES['image']['name'];
               
               $productEdition->setName($name);
               $productEdition->setDescription($description);
               $productEdition->setQuantity($quantity);
               $productEdition->setPrice($price);
               $productEdition->setImage($image);
               
               $destination = './assets/images/';
               move_uploaded_file($_FILES['image']['tmp_name'],$destination.$image);
               $ok = $this->product->updateProduct($productEdition);
               if($ok > 0){
                   header('location:index.php?action=list_products');
                }
            }
            require_once('./views/admin/products/editProduct.php');
        }
    }
}