<?php ob_start(); ?>
  
  
<?php
    // echo '<pre>';
    // print_r($allCat);
    // echo '</pre>';
    echo $array_carros;
    // echo gettype($allCat);
?>

  <?php 
      $contenu = ob_get_clean();
      require_once('./views/templateData.php');
  ?>
