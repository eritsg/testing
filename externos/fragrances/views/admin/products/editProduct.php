<?php ob_start();?>

 <div class="container">
     <div class="row">
         <div class="col-8 offset-2">
         <h1 class="display-6 text-center font-monospace text-decoration-underline">Édition du produit nº<?=$productEdition->getId();?></h1>
             <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="col">
                        <input
                        type="hidden"
                        id="id"
                        name="id"
                        class="d-none"
                        value="<?=$productEdition->getId();?>">
                        <label for="marque">Nom</label>
                        <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        placeholder="Nom de l'article"
                        value="<?=$productEdition->getName();?>">
                    </div>
                    <div class="col">
                        <label for="quantity">Quantité</label>
                        <input type="number"
                        id="quantity"
                        name="quantity"
                        class="form-control"
                        placeholder="Quantité en stock"
                        value="<?=$productEdition->getQuantity();?>">
                    </div>
                    <div class="col">
                        <label for="price">Prix</label>
                        <input type="text"
                        id="price"
                        name="price"
                        class="form-control"
                        placeholder="Prix de l'article"
                        value="<?=$productEdition->getPrice();?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="description">Description</label>
                        <textarea id="description"
                        name="description"
                        class="form-control"
                        placeholder="Description de l'article"
                        rows="5"><?=$productEdition->getDescription();?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="image">Image</label>
                        <input type="file"
                        id="image"
                        name="image"
                        class="form-control"
                        value="<?=$productEdition->getImage();?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col mt-3 mb-2">
                        <img src="./assets/images/<?=$productEdition->getImage();?>" class="img-fluid">
                    </div>
                </div>
                <button type="submit" class="btn btn-warning col-12 mt-2 mb-3" name="submitted">Modifier</button>
            </form>
         </div>
     </div>
 </div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>