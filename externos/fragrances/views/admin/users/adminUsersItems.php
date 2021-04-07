<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <h1 class="display-6 text-center font-monospace text-decoration-underline">Liste des utilisateurs</h1>
    </div>
    <div class="row my-5">
        <div class="col-12">
        <table class="table table-striped">
      <thead>
          <tr>
              <th class="text-center">Id</th>
              <th class="text-center">Identifiant</th>
              <th class="text-center">Nom</th>
              <th class="text-center">Email</th>
              <th class="text-center">Statut</th>
              <th class="text-center">Actions</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach ($allUsers as $user) : ?>
          <tr>
              <td class="text-center"><?=$user->getId();?></td>
              <td class="text-center"><?=$user->getLogin();?></td>
              <td class="text-center"><?=$user->getName();?></td>
              <td class="text-center"><?=$user->getEmail();?></td>
              <td class="text-center">
                <?php
                    echo($user->getStatus())
                    ? "<a href='index.php?action=list_users&id=".$user->getId()."&status=".$user->getStatus()."'  onclick='return confirm(`Désactiver cet utilisateur?`)' class='btn btn-danger'><i class='fas fa-unlock'> Désactiver</i></a>"
                    : "<a href='index.php?action=list_users&id=".$user->getId()."&status=".$user->getStatus()."' onclick='return confirm(`Activer cet utilisateur?`)' class='btn btn-success'><i class='fas fa-lock'> Activer</i></a>"
                ?>
              </td>
              <td class="text-center">
                                <a class="btn btn-warning" href="index.php?action=edit_user&id=<?= $user->getId(); ?>">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <a class="btn btn-danger" href="index.php?action=del_user&id=<?= $user->getId(); ?>" onclick="return confirm('Confirmer la suppression définitive?')">
                                    <i class="fas fa-trash"></i>
                                </a>
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
