<?php
class AutoController{

    private $adCat;
    public function __construct()
    {
        $this->adCat = new AdminCategorieModel();
    }

    public function index(){
        AuthController::isLogged();
        $allCat = $this->adCat->getCategories();

        // Vamos a almacenar los Autos en un array
        $nueva_cat = array();
        foreach ($allCat as $key => $Cat) {

            // Como usamos POO en nuestro modelo de 'AdminCategorieModel', se obtiene con una función propia del modelo.
            // La función del modelo es ->getNom_cat()
            array_push($nueva_cat, $Cat->getNom_cat());
        }

        // Normalmente debemos responder con un status y los datos que se solicitaron.
        // Status exitoso y variable solicitada

        // En la View se imprime echo json_encode($response);
        $response = array(
            'status' => 'Success',
            'autos' => $nueva_cat
        );

         require_once('./views/admin/api/autosViews.php');
         //return $allCat;
    }
}
// $adminCat = new AdminCategorieController();
// var_dump($adminCat->listCategories());