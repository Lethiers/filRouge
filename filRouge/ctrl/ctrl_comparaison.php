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

///////////////////////////////////// EN COURS  //////////////////////////////////
// reussir a afficher les operations selon un selecteur
// choix operation




$tabloOpTotalPos = [];
$tabloOpTotalNeg = [];

$operation = new Operation();
$tabloOperation = $operation->showAllOperationByUtilId($bdd,$_SESSION['id']);
// var_dump($tabloOperation);
foreach($tabloOperation as $value){
    if ($value->id_balance == 1) {
        array_push($tabloOpTotalPos,$value->montant_operation);
    }
    if ($value->id_balance == 2) {
        array_push($tabloOpTotalNeg,$value->montant_operation);
    }
}
$operationPos = array_sum($tabloOpTotalPos);
$operationNeg = array_sum($tabloOpTotalNeg);
echo 'vous avez gagné '.$operationPos.'€ et dépensé '.$operationNeg.'€';
// j'arrive à sortir un tablo pos et negatif


// gérer la date des operations PB selectionne tout les utilisateurs
$tabloCatGlobal = [];
$tabloCatUtil = [];
if (isset($_POST['date_operation']) && !empty($_POST['date_operation'])) {

    
    $operationByDate  =$operation->showAllOperationByDate($bdd,$_POST['date_operation']);
    // var_dump($operationByDate);
    foreach($operationByDate as $value){
        if ($value->id_categorie_global !== null) {
            array_push($tabloCatGlobal, [$value->montant_operation => $value->id_categorie_global]);
        }elseif ($value->id_categorie_utilisateur !== null) {
            array_push($tabloCatUtil, [$value->montant_operation => $value->id_categorie_utilisateur]);
        }
    }     
}
echo '<br>';
var_dump($tabloCatGlobal);







///////////////////////////////////// EN PAUSE //////////////////////////////////


// choix du diagramme
$diagramme = new Diagramme();

$tabloDiag = $diagramme->showDiagrammeById($bdd,$_SESSION['id']);
// var_dump($tabloDiag);
echo '<form action="" method="post">';
echo '<select name="diagramme">
<option value="">--selectionner votre diagramme--</option>';
foreach($tabloDiag as $value){
    echo '<option value='.$value->id_diagramme.'>'.$value->nom_diagramme.'</option>';
}
echo '</select>';
echo '<input type="submit" value="comparer">';
echo '</form>';


if (isset($_POST['diagramme']) && !empty($_POST['diagramme'])) {
    var_dump($_POST['diagramme']);
}


// model cat global
echo '<br>';
$catGlobal = new CategoriGlobal();
$tabloCatGlobal = $catGlobal->showAllCategorieGlobal($bdd);
// echo $tabloCatGlobal[0]->nom_categorie_global;
// echo $tabloCatGlobal[0]->id_categorie_global;
// var_dump($tabloCatGlobal);

///////////////////////////////////// EN PAUSE //////////////////////////////////

// model cat util
// echo '<br>';
// $catUtil = new CategoriUtil();
// $tabloCatUtil = $catUtil->showCategorieUtilTablo($bdd,$_SESSION['id']);
// var_dump($tabloCatUtil);


// table avoir
// echo '<br>';
// $avoir = new Avoir();
// $tabloAvoir = $avoir->innerJoinDiagramme($bdd,$idDiag);
// var_dump($tabloAvoir);


// table ajouter
// echo '<br>';
// $ajouter = new Ajouter();
// $tabloAjouter = $avoir->innerJoinDiagramme($bdd,$idDiag);
// var_dump($tabloAjouter);



?>