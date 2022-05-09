<?php
session_start();
// importation bdd
include './utils/connectBdd.php';

// importation model
include './model/model_cat_util.php';
include './model/model_cat_global.php';

// ------- importation des view -----
include './view/view_update_cat_util.php';

// voir les categorie global sous forme de checkbox
$categorieGlobal = new CategoriGlobal();

echo '<select name="catGlobal">
<option value="">--merci de selecitonner une catégorie global--</option>';
$tab = $categorieGlobal->showAllCategorieGlobal($bdd);
foreach($tab as $value){

    echo '<option value='.$value->id_categorie_global.'>'.$value->nom_categorie_global.'</option>';
}
echo '</select>';

// recupêration de la cat util par l'id
$catUtil = new CategoriUtil();

if (isset($_GET['id'])) {
    $tab = $catUtil->showCategorieUtilById($bdd,$_GET['id']);
    // var_dump($tab);

    foreach ($tab as $value) {

            echo '<input type="text" name="nom_categorie_utilisateur" placeholder='.$value->nom_categorie_utilisateur.'>';
            echo '<input type="submit" value="modifier la catégorie">';
        echo '</form>';
    }
}



if (isset($_POST['nom_categorie_utilisateur']) && !empty($_POST['nom_categorie_utilisateur']) && isset($_POST['catGlobal']) && !empty($_POST['catGlobal'])) {
    $catUtil->setNom($_POST['nom_categorie_utilisateur']);
    $catUtil->setIdUtil($_SESSION['id']);
    $catUtil->setCatGlobal($_POST['catGlobal']);
    $catUtil->modifyCatUtil($bdd,$_GET['id']);
    header('Location: categorieUtilisateur?update');

}
?>