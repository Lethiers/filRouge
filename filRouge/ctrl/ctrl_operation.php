<?php
// session_start();
var_dump($_SESSION['id']);
// importation bdd
include './utils/connectBdd.php';

// importation model
include './model/model_operation.php';
include './model/model_cat_global.php';
include './model/model_cat_util.php';
include './model/model_balance.php';


// ------- importation des view -----
include './view/view_operation.php';


$operation = new Operation(null,null,null);

// voir les categorie utilisateur sous forme de checkbox
$categorieUtil = new CategorieUtil(null,null,null);
echo '<select name="catUtil">
<option value="">--merci de selecitonner une catégorie utilisateur--</option>';
$tabUtil = $categorieUtil->showCategorieUtil($bdd,$_SESSION['id']);
foreach($tabUtil as $value){

    echo '<option value='.$value->id_categorie_utilisateur.'>'.$value->nom_categorie_utilisateur.'</option>';
}
echo '</select>';




// voir les categorie global sous forme de checkbox
$categorieGlobal = new CategorieGlobal(null);
echo '<select name="catGlobal">
<option value="">--merci de selecitonner une catégorie global--</option>';
$tab = $categorieGlobal->showAllCategorieGlobal($bdd);
foreach($tab as $value){

    echo '<option value='.$value->id_categorie_global.'>'.$value->nom_categorie_global.'</option>';
}
echo '</select>';

echo '<input type="submit" value="Enregistrer">';

////////////////////////// ENREGISTRER LES OPERATIONS //////////////////////////


if (isset($_POST['nom_operation']) && !empty($_POST['nom_operation']) 
&& isset($_POST['date_operation']) && !empty($_POST['date_operation']) 
&& isset($_POST['montant_operation']) && !empty($_POST['montant_operation'])) {


    if (isset($_POST['catUtil']) && !empty($_POST['catUtil'])) {
        $categorieGlobalByUtil = $categorieUtil->showCategorieUtilById($bdd,$_POST['catUtil']);
        $operation->setidCatGlobal($categorieGlobalByUtil[0]->id_categorie_global);
        $operation->setidCatUtil($_POST['catUtil']);

        $operation->setDate($_POST['date_operation']);
        $operation->setMontant($_POST['montant_operation']);
        $operation->setNom($_POST['nom_operation']);

        $operation->addOperation($bdd,$_SESSION['id']);

    }else {
        $operation->setidCatUtil(null);
        $operation->setidCatGlobal($_POST['catGlobal']);

        $operation->setDate($_POST['date_operation']);
        $operation->setMontant($_POST['montant_operation']);
        $operation->setNom($_POST['nom_operation']);
      
        $operation->addOperation($bdd,$_SESSION['id']);
    }


    echo '<p>l\'opération '.$operation->getNom().' pour un montant de '.$operation->getMontant().' est bien enregistré<p>';

}else {
    echo 'merci de remplir les champs !';
}

echo '</form>';
echo '</div>';

/////////////////// voir les operations /////////////////////////////////////////

$operationTableau = $operation->showAllOperationByIdUtil($bdd,$_SESSION['id']);

// var_dump($operationTableau);
// var_dump($tab);
// $total = array_merge($operationTableau, $tab,$tabUtil);
// var_dump($total);

// foreach($tab as $value){
//     echo '<h2>'.$value->nom_categorie_global.'<h2>';
   
// }


echo '
<div>
<ul>';
foreach($operationTableau as $value){
    echo '<li>'.$value->nom_operation.'<li>';
    echo '<li>'.$value->date_operation.'<li>';
    echo '<li>'.$value->montant_operation.'<li>';
    echo '<li><a href="modifierOperation?id='.$value->id_operation.'">modifier</a><li>';
    echo '<li><a href="supprimerOperation?id='.$value->id_operation.'">supprimer</a><li>';
   
}
echo '
</ul>
</div>';




?>