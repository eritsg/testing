<?php ob_start();?>

 <div class="container">
     <div class="row">
         <div class="col-8 offset-2">
         <h1 class="display-6 text-center font-monospace text-decoration-underline">Inscription d'un utilisateur</h1>
             <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                
                <div class="row">
                    <div class="col">
                        <label for="login">Identifiant*</label>
                        <input type="text" id="login" name="login" class="form-control" placeholder="Identifiant" >
                    </div>
                    <div class="col">
                        <label for="name">Nom*</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nom" >
                    </div>
                    
                </div>
                <div class="row">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="email">E-mail*</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="E-mail" >
                    </div>
                    <div class="col">
                        <label for="password">Mot de passe*</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" >
                    </div>
                </div>
                <button type="submit" class="btn btn-primary col-12 mt-2" name="submitted">Enregistrer</button>
            </form>
         </div>
     </div>
 </div>
<?php 
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
?>