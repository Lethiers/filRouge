<?php
// importation bdd
include './utils/connectBdd.php';
// --------- importation model
// model utilisateur
include './model/model_utilisateur.php';
// model categorie global
include './model/model_cat_global.php';

// --- LOGICAL

var_dump($_GET['id']);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $cat = new CategorieGlobal();
    $cat->deleteCategorieGlobal($bdd,$_GET['id']);
    header('Location: admin?supp');
}

?>