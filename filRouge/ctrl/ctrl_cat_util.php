<?php
// session_start();
// var_dump($_SESSION['id']);
// importation bdd
include './utils/connectBdd.php';

// importation model
include './model/model_cat_util.php';
include './model/model_cat_global.php';

// ------- importation des view -----
include './view/view_cat_util.php';


$categoriUtil = new CategoriUtil();

$message = "";

// voir les categorie global sous forme de checkbox
$categorieGlobal = new CategoriGlobal();
echo '<select name="catGlobal">
<option value="">--merci de selecitonner une catégorie global--</option>';
$tab = $categorieGlobal->showAllCategorieGlobal($bdd);
foreach($tab as $value){

    echo '<option value='.$value->id_categorie_global.'>'.$value->nom_categorie_global.'</option>';
}
echo '</select>';


echo '<input type="submit" value="modifier">';
echo '</form>';
echo '</div>';


if (isset($_POST['nom_categorie_utilisateur']) && !empty($_POST['nom_categorie_utilisateur']) && isset($_POST['catGlobal']) && !empty($_POST['catGlobal']) ) {
    echo 'ok';
    $categoriUtil->setNom($_POST['nom_categorie_utilisateur']);
    $categoriUtil->setIdUtil($_SESSION['id']);
    $categoriUtil->setCatGlobal($_POST['catGlobal']);
    $categoriUtil->addCategorieUtil($bdd);


    $message = 'la categorie '.$categoriUtil->getNom().' viens d\'etre créer';
}else {
    $message = "merci de remplir les champs";
}

echo $message;



$listCatUtil = $categoriUtil->showCategorieUtil($bdd,$_SESSION['id']);

echo '<ul>';
foreach($listCatUtil as $value){


    echo '<li>
    <label for='.$value->nom_categorie_utilisateur.'>'.$value->nom_categorie_utilisateur.'</label></br>
    <a href="updateCategorieUtilisateur?id='.$value->id_categorie_utilisateur.'">modifier</a>
    <a href="deleteCategorieUtilisateur?id='.$value->id_categorie_utilisateur.'">supprimer</a>
    </li>';


    
}
echo '</ul>';

?>