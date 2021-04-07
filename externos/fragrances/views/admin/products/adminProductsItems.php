<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <h1 class="display-6 text-center font-monospace text-decoration-underline">Liste des produits</h1>
    </div>
    <div class="row my-5">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allProducts as $product) : ?>
                        <tr>
                            <td><?= $product->getId(); ?></td>
                            <td><?= $product->getName(); ?></td>
                            <td><img src="./assets/images/<?= $product->getImage(); ?>" alt="" width="100"></td>
                            <td><?= $product->getDescription(); ?></td>
                            <td><?= $product->getQuantity(); ?></td>
                            <td><?= $product->getPrice(); ?></td>
                            <td class="text-center">
                                <a class="btn btn-warning" href="index.php?action=edit_product&id=<?= $product->getId(); ?>">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a class="btn btn-danger" href="index.php?action=del_product&id=<?= $product->getId(); ?>" onclick="return confirm('Confirmer la suppression du produit?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            <td class="text-center">

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
$contenu = ob_get_clean();
require_once('./views/templateAdmin.php');
?>