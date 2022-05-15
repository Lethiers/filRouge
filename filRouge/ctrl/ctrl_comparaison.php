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
    if ($value->id_balance == 2) {
        array_push($tabloOpTotalPos,$value->montant_operation);
    }
    if ($value->id_balance == 1) {
        array_push($tabloOpTotalNeg,$value->montant_operation);
    }
}
$operationPos = array_sum($tabloOpTotalPos);
$operationNeg = array_sum($tabloOpTotalNeg);
echo 'vous avez gagné '.$operationPos.'€ et dépensé '.$operationNeg.'€';
// j'arrive à sortir un tablo pos et negatif


// gérer la date des operations 
$tabloCatGlobal = [];
$tabloCatUtil = [];
if (isset($_POST['date_operation']) && !empty($_POST['date_operation'])) {

    $operationByDate  = $operation->showAllOperationByDate($bdd,$_POST['date_operation'],$_SESSION['id']);
    // var_dump($operationByDate);
    foreach($operationByDate as $value){
        if ($value->id_categorie_global !== null) {
            if (isset($tabloCatGlobal[$value->id_categorie_global])) {
                $tabloCatGlobal[$value->id_categorie_global] += $value->montant_operation;
            }else {
                $tabloCatGlobal[$value->id_categorie_global] = $value->montant_operation;
            }
        // }elseif ($value->id_categorie_utilisateur !== null) {
        //     ($tabloCatUtil, [$value->id_categorie_utilisateur =>$value->montant_operation]);
        }
    
    }   
}
echo '<br>';
var_dump($tabloCatGlobal);
echo '<br>';

///////////////////////////////////// EN PAUSE //////////////////////////////////


// choix du diagramme
$diagramme = new Diagramme();
$tabloDiag = $diagramme->showDiagrammeById($bdd,$_SESSION['id']);
echo '<form action="" method="post">';
echo '<select name="diagramme">
<option value="">--selectionner votre diagramme--</option>';
foreach($tabloDiag as $value){
    echo '<option value='.$value->id_diagramme.'>'.$value->nom_diagramme.'</option>';
}
echo '</select>';
echo '<input type="submit" value="comparer">';
echo '</form>';

// créer un tableau vide pour stocker reponse diagramme
$tabloDiagrammeGlobal = [];

// model cat global
if (isset($_POST['diagramme']) && !empty($_POST['diagramme'])) {

        $diagrammeUtilSelect = $diagramme->showDiagramme($bdd,$_POST['diagramme']);
        $avoir = new Avoir();
        $tabloAvoir = $avoir->showAllAvoirByDiag($bdd,$_POST['diagramme']);
        foreach($tabloAvoir as $value){
            if ($value->id_categorie_global !== null) {
                if (isset($tabloDiagrammeGlobal[$value->id_categorie_global])) {
                    $tabloDiagrammeGlobal[$value->id_categorie_global] += $value->budget;
                }else {
                    $tabloDiagrammeGlobal[$value->id_categorie_global] = $value->budget;
                }
            }
        }


}
var_dump($tabloDiagrammeGlobal);



///////////////////////////////////// EN PAUSE //////////////////////////////////






?>