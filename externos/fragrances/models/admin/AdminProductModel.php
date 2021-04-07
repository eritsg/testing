<?php

class AdminProductModel extends Driver{

    public function getProducts(){ // $sql = literally the request
        $sql ="SELECT * FROM products p
            ORDER BY p.id DESC";

        $result = $this->getRequest($sql); // getting the db ready with $sql

        $rows = $result->fetchAll(PDO::FETCH_OBJ); // excecute the request & keeping the data
        $tabProduct = [];

        foreach($rows as $row){
            $product = new Product();
            $product->setId($row->id);
            $product->setName($row->name);
            $product->setDescription($row->description);
            $product->setQuantity($row->quantity);
            $product->setPrice($row->price);
            $product->setImage($row->image);
            array_push($tabProduct,$product);
        }
            return $tabProduct;
    }

    public function insertProduct(Product $product){

        $sql = "INSERT INTO products(name, description, quantity, price, image)
                VALUES(:name, :description, :quantity, :price, :image)";

        $tabParams = ["name"=>$product->getName(),"description"=>$product->getDescription(), "quantity"=>$product->getQuantity(), "price"=>$product->getPrice(), "image"=>$product->getImage()];

        $result= $this->getRequest($sql, $tabParams);

        return $result;
    }

    public function deleteProduct(Product $product){

        $sql = "DELETE FROM products WHERE id = :id";
        $result = $this->getRequest($sql, ['id'=>$product->getId()]);

        return $result->rowCount();
    }

    public function productItem(Product $productParam){
        $sql = "SELECT * FROM products
                WHERE id = :id";
        $result = $this->getRequest($sql, ['id'=>$productParam->getId()]);
        
        if($result->rowCount() > 0){

            $productRow = $result->fetch(PDO::FETCH_OBJ);
            $product = new Product();
            $product->setId($productRow->id);
            $product->setName($productRow->name);
            $product->setDescription($productRow->description);
            $product->setQuantity($productRow->quantity);
            $product->setPrice($productRow->price);
            $product->setImage($productRow->image);
    
            return $product;
        }

    }

    public function updateProduct(Product $editProduct){
        if($editProduct->getImage() === ""){
            $sql = "UPDATE products

                SET name = :name,
                    description = :description,
                    quantity = :quantity,
                    price = :price

                WHERE id = :id";
                
          $tabParams = [
                        "id"=>$editProduct->getId(),
                        "name"=>$editProduct->getName(),
                        "description"=>$editProduct->getDescription(),
                        "quantity"=>$editProduct->getQuantity(),
                        "price"=>$editProduct->getPrice()
                        ];

        }else{
            $sql = "UPDATE products

                    SET name = :name,
                    description = :description,
                    quantity = :quantity,
                    price = :price,
                    image = :image

                    WHERE id = :id";
                    
            $tabParams = [
                    "id"=>$editProduct->getId(),
                    "name"=>$editProduct->getName(),
                    "description"=>$editProduct->getDescription(),
                    "quantity"=>$editProduct->getQuantity(),
                    "price"=>$editProduct->getPrice(),
                    "image"=>$editProduct->getImage()
                    ];
        }

        $result = $this->getRequest($sql, $tabParams);

        return $result->rowCount();
    }
}