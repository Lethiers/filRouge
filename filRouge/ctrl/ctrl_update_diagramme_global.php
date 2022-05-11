<?php
// session_start();
// importation bdd
include './utils/connectBdd.php';
// importation model
// model utilisateur
include './model/model_utilisateur.php';
// model categorie global
include './model/model_cat_global.php';

// ------- importation des view -----
include './view/view_update_diagramme_global.php';
// --- LOGICAL


// on verifie qu'on a bien un id
if (isset($_GET['id']) and !empty($_GET['id'])) {
    $cat = new CategoriGlobal();
    $tab = $cat->showCategorieGlobal($bdd,$_GET['id']);
    foreach($tab as $val){
        echo '<form action="" method="post">
        <input type="text" name="nom_categorie_global" id="" placeholder='.$val->nom_categorie_global.'>
        <input type="submit" value="modifier">
        </form>';
    }

    if (isset($_POST['nom_categorie_global'])) {
        $cat->modifyCatGlobal($bdd,$_GET['id'],$_POST['nom_categorie_global']);
        header('Location: admin?modify');
    }
}



?>