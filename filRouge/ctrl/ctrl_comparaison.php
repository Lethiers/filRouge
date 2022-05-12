<?php
// importation de la bdd
include './utils/connectBdd.php';
// importation des models
include './model/model_ajouter.php';
include './model/model_avoir.php';
include './model/model_diagramme.php';
include './model/model_operation.php';
// peut être utile
include './model/model_cat_global.php';
include './model/model_cat_util.php';
// importation de la view
include './view/view_comparaison.php';

// -- logical

$diagramme = new Diagramme();

$tabloDiag = $diagramme->showDiagrammeById($bdd,$_SESSION['connect']);
var_dump($tabloDiag);
foreach($tabloDiag as $value){
    echo $value;
}




?>