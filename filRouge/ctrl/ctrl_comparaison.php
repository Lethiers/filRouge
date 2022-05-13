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

    $operationByDate  = $operation->showAllOperationByDate($bdd,$_POST['date_operation'],$_SESSION['id']);
    foreach($operationByDate as $value){
        if ($value->id_categorie_global !== null) {
            array_push($tabloCatGlobal, [$value->id_categorie_global=>$value->montant_operation]);
        }elseif ($value->id_categorie_utilisateur !== null) {
            array_push($tabloCatUtil, [$value->id_categorie_utilisateur =>$value->montant_operation]);
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

// model cat global
$catGlobal = new CategoriGlobal();
if (isset($_POST['diagramme']) && !empty($_POST['diagramme'])) {

        $tabloCatGlobal = $catGlobal->showCategorieGlobal($bdd,$_POST['diagramme']);
        var_dump($catGlobal);
        foreach($tabloCatGlobal as $value){
            echo $value->nom_categorie_global;
            echo '<br>';
            echo $value->id_categorie_global;
            echo '<br>';
    }
}



///////////////////////////////////// EN PAUSE //////////////////////////////////



// var_dump($tabloCatGlobal);

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