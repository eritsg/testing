<?php ob_start();?>

 <div class="container">
     <div class="row">
         <div class="col-8 offset-2">
         <h1 class="display-6 text-center font-monospace text-decoration-underline">Édition d'un utilisateur</h1>
             <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="col">
                        <input
                        type="hidden"
                        id="id"
                        name="id"
                        class="d-none"
                        value="<?=$userEdition->getId();?>">
                        <input
                        type="hidden"
                        id="status"
                        name="status"
                        class="d-none"
                        value="<?=$userEdition->getStatus();?>">
                        <label for="login">Identifiant*</label>
                        <input
                        type="text"
                        id="login"
                        name="login"
                        class="form-control"
                        value="<?=$userEdition->getLogin();?>">
                    </div>
                    <div class="col">
                        <label for="name">Nom*</label>
                        <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        placeholder="Nom"
                        value="<?=$userEdition->getName();?>">
                    </div>
                    
                </div>
                <div class="row">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="email">E-mail*</label>
                        <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="E-mail"
                        value="<?=$userEdition->getEmail();?>">
                    </div>
                    <div class="col">
                        <label for="password">Mot de passe*</label>
                        <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Mot de passe"
                        value="<?=$userEdition->getPassword();?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary col-12 mt-2" name="submitted">Modifier</button>
            </form>
         </div>
     </div>
 </div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>