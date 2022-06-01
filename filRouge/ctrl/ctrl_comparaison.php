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




// choix du champ a comparer


echo'
<form action="" method="post">';
// choix du prevision
$prevision = new prevision();
$tabloprevision = $prevision->showprevisionById($bdd,$_SESSION['id']);

echo'
<img src="./asset/image/licorneInterogate.png" alt="">
<h2>vous pouvez comparer les dépenses prévu avec les dépenses saisies :</h2>
    <p>Il suffit de choisir un des champs enregistré.</p>';

    echo '<select name="prevision" class="bouton">
    <option value="">choisir une prévision</option>';
    foreach($tabloprevision as $value){
        echo '<option value='.$value->id_prevision.'>'.$value->nom_prevision.'</option>';
    }
    echo '</select>';

    ///////////////////////////////////////////////////AFFICHER LES CAT GLOBAL DE LA PREVISION//////////////////////////////////////////////////////////////////
    // gestion formulaire pour afficher categorie global prevision
if (isset($_POST['prevision'])&&!empty($_POST['prevision'])) {
    // on utilise l'id pour retrouver le nom de la cat global
    $categorieGlobal = new CategorieGlobal();
    $avoir= new Avoir();
        $liste = $avoir->showAllAvoirByprevision($bdd,$_POST['prevision']);
        foreach($liste as $value){
            echo '<div class="operation">';
            /****************** TROUVER NON CAT GLOBAL CAT GLOBAL  *****************/
            $nomCatGlobal = $categorieGlobal->showCategorieGlobalTablo($bdd);
            echo '<li>'.$nomCatGlobal[($value->id_categorie_global)-1]["nom_categorie_global"].'</li>';
            /****************** TROUVER NON CAT GLOBAL CAT GLOBAL  ***************/
            echo '<li>'.$value->budget.'</li>';
            echo '<li><a href="comparaison?idprevision='.$value->id_prevision.'&idCat='.$nomCatGlobal[($value->id_categorie_global)-1]["id_categorie_global"].'">Comparer</a></li>';
            echo '</div>';
        }
}
//////////////////////////////////////// FINNNNNN AFFICHER LES CAT GLOBAL DE LA PREVISION/////////////////////////////////////////////// 
    

echo'    
<input type="submit" value="choisir" class="bouton">
</form>
</div>';



        

// pour afficher l'ensemble des dépenses depuis une date
$operation = new Operation ();
$tabloOperation = $operation->showAllOperationByDate($bdd,$_POST['date_operation'],$_SESSION['id']);
// var_dump($tabloOperation);

$tabloNom=[];
$tabloMontant=[];

foreach($tabloOperation as $value){
    if ($value->nom_operation != null) {
        array_push($tabloNom, $value->nom_operation);
    }
    if ($value->montant_operation != null) {
        array_push($tabloMontant, $value->montant_operation);
    }
}

// je convertis les données au format json pour utiliser les datas avec chartJs
$tabloNomJson = json_encode($tabloNom);
$tabloMontantJson = json_encode($tabloMontant);

echo '<script>', 'diagramme('.$tabloNomJson.','.$tabloMontantJson.');', '</script>';


///////////////////////////////////// EN COURS  //////////////////////////////////
// reussir a afficher les operations selon un selecteur
// choix operation

// $tabloOpTotalPos = [];
// $tabloOpTotalNeg = [];

// $operation = new Operation();
// $tabloOperation = $operation->showAllOperationByIdUtil($bdd,$_SESSION['id']);
// // var_dump($tabloOperation);
// foreach($tabloOperation as $value){
//     if ($value->montant_operation > 0) {
//         array_push($tabloOpTotalPos,$value->montant_operation);
//     }
//     if ($value->montant_operation < 0) {
//         array_push($tabloOpTotalNeg,$value->montant_operation);
//     }
// }
// $operationPos = array_sum($tabloOpTotalPos);
// $operationNeg = array_sum($tabloOpTotalNeg);
// // echo 'vous avez gagné '.$operationPos.'€ et dépensé '.$operationNeg.'€';
// // j'arrive à sortir un tablo pos et negatif


// // gérer la date des operations 
// $tabloCatGlobal = [];
// $tabloCatUtil = [];
// if (isset($_POST['date_operation']) && !empty($_POST['date_operation'])) {

//     $operationByDate  = $operation->showAllOperationByDate($bdd,$_POST['date_operation'],$_SESSION['id']);
//     // var_dump($operationByDate);
//     foreach($operationByDate as $value){
//         if ($value->id_categorie_global !== null) {
//             if (isset($tabloCatGlobal[$value->id_categorie_global])) {
//                 $tabloCatGlobal[$value->id_categorie_global] += $value->montant_operation;
//             }else {
//                 $tabloCatGlobal[$value->id_categorie_global] = $value->montant_operation;
//             }
//         // }elseif ($value->id_categorie_utilisateur !== null) {
//         //     ($tabloCatUtil, [$value->id_categorie_utilisateur =>$value->montant_operation]);
//         }
    
//     }   
// }
// echo '<br>';
// var_dump($tabloCatGlobal);
// echo '<br>';

// ///////////////////////////////////// EN PAUSE //////////////////////////////////

// // créer un tableau vide pour stocker reponse prevision
// $tabloprevisionGlobal = [];

// // model cat global
// if (isset($_POST['prevision']) && !empty($_POST['prevision'])) {

//         $previsionUtilSelect = $prevision->showprevision($bdd,$_POST['prevision']);
//         $avoir = new Avoir();
//         $tabloAvoir = $avoir->showAllAvoirByprevision($bdd,$_POST['prevision']);
//         foreach($tabloAvoir as $value){
//             if ($value->id_categorie_global !== null) {
//                 if (isset($tabloprevisionGlobal[$value->id_categorie_global])) {
//                     $tabloprevisionGlobal[$value->id_categorie_global] += $value->budget;
//                 }else {
//                     $tabloprevisionGlobal[$value->id_categorie_global] = $value->budget;
//                 }
//             }
//         }
// }
// var_dump($tabloprevisionGlobal);
// var_dump($tabloCatGlobal);
// var_dump($tabloCatUtil);
// var_dump($tabloOpTotalPos);
// var_dump($operationNeg);

// lancer le script en fonction des tableaux reçu
// echo '<script>', 'diagramme(["loisir","plaisir","restaurant","banque"],[140,500,800,300]);', '</script>';

///////////////////////////////////// EN PAUSE //////////////////////////////////






?>