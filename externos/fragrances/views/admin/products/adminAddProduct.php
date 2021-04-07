<?php ob_start();?>

 <div class="container">
     <div class="row">
         <div class="col-8 offset-2">
         <h1 class="display-6 text-center font-monospace text-decoration-underline">Ajout d'un produit</h1>
             <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="col">
                        <label for="marque">Nom</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nom de l'article">
                    </div>
                    <div class="col">
                        <label for="quantity">Quantité</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Quantité en stock">
                    </div>
                    <div class="col">
                        <label for="price">Prix</label>
                        <input type="text" id="price" name="price" class="form-control" placeholder="Prix de l'article">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Description de l'article" rows="5"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary  col-12 mt-2" name="submitted">Ajouter</button>
            </form>
         </div>
     </div>
 </div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>