<?php
// importation de la bdd
include './utils/connectBdd.php';
// importation des models
include './model/model_ajouter.php';
include './model/model_avoir.php';
include './model/model_diagramme.php';
include './model/model_operation.php';
include './model/model_cat_global.php';
include './model/model_cat_util.php';
// importation de la view
include './view/view_comparaison.php';
// -- logical

// choix du diagramme
$diagramme = new Diagramme();

$tabloDiag = $diagramme->showDiagrammeById($bdd,$_SESSION['id']);

echo '<select name="diagramme">
<option value="">--selectionner votre diagramme--</option>';
foreach($tabloDiag as $value){
    echo '<option value='.$value->id_diagramme.'>'.$value->nom_diagramme.'</option>';
}
echo '</select>';



// model cat global
echo '<br>';


// model cat util
echo '<br>';
$catUtil = new CategoriUtil();
$tabloCatUtil = $catUtil->showCategorieUtilTablo($bdd,$_SESSION['id']);
var_dump($tabloCatUtil);


// choix operation
echo '<br>';
$operation = new Operation();
$tabloOperation = $operation->showAllOperationByUtilId($bdd,$_SESSION['id']);
var_dump($tabloOperation);

// table avoir
// echo '<br>';
// $avoir = new Avoir();
// $tabloAvoir = $avoir->innerJoinDiagramme($bdd);
// var_dump($tabloAvoir);


// table ajouter
echo '<br>';
$ajouter = new Ajouter();



?>