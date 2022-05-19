<?php
// importation de la bdd
include './utils/connectBdd.php';
// importation des models
include './model/model_ajouter.php';
include './model/model_avoir.php';
include './model/model_prevision.php';
include './model/model_operation.php';
include './model/model_cat_global.php';
include './model/model_cat_util.php';
// importation de la view
include './view/view_comparaison.php';
// -- logical

// choix du prevision
$prevision = new prevision();
$tabloprevision = $prevision->showprevisionById($bdd,$_SESSION['id']);

echo '<select name="prevision" class="bouton">
<option value="">choisir une prévision</option>';
foreach($tabloprevision as $value){
    echo '<option value='.$value->id_prevision.'>'.$value->nom_prevision.'</option>';
}
echo '</select>';
echo '<input type="submit" value="comparer" class="bouton">';
echo '</form>';
echo '</div>';

///////////////////////////////////// EN COURS  //////////////////////////////////
// reussir a afficher les operations selon un selecteur
// choix operation

$tabloOpTotalPos = [];
$tabloOpTotalNeg = [];

$operation = new Operation();
$tabloOperation = $operation->showAllOperationByIdUtil($bdd,$_SESSION['id']);
// var_dump($tabloOperation);
foreach($tabloOperation as $value){
    if ($value->montant_operation > 0) {
        array_push($tabloOpTotalPos,$value->montant_operation);
    }
    if ($value->montant_operation < 0) {
        array_push($tabloOpTotalNeg,$value->montant_operation);
    }
}
$operationPos = array_sum($tabloOpTotalPos);
$operationNeg = array_sum($tabloOpTotalNeg);
// echo 'vous avez gagné '.$operationPos.'€ et dépensé '.$operationNeg.'€';
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

// créer un tableau vide pour stocker reponse prevision
$tabloprevisionGlobal = [];

// model cat global
if (isset($_POST['prevision']) && !empty($_POST['prevision'])) {

        $previsionUtilSelect = $prevision->showprevision($bdd,$_POST['prevision']);
        $avoir = new Avoir();
        $tabloAvoir = $avoir->showAllAvoirByprevision($bdd,$_POST['prevision']);
        foreach($tabloAvoir as $value){
            if ($value->id_categorie_global !== null) {
                if (isset($tabloprevisionGlobal[$value->id_categorie_global])) {
                    $tabloprevisionGlobal[$value->id_categorie_global] += $value->budget;
                }else {
                    $tabloprevisionGlobal[$value->id_categorie_global] = $value->budget;
                }
            }
        }


}

var_dump($tabloprevisionGlobal);
// echo '<script>', 'diagramme(["loisir","plaisir","restaurant","banque"],[140,500,800,300]);', '</script>';
echo '<script>', 'diagramme(["loisir:Dépense","Loisir:Prevision"],[80,500]);', '</script>';



///////////////////////////////////// EN PAUSE //////////////////////////////////






?>