<?php
// importation bdd
include './utils/connectBdd.php';
// importation model
include './model/model_cat_util.php';
include './model/model_cat_global.php';
// ------- logical-----


$categorieUtil = new CategorieUtil();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $categorieUtil->deleteCategorieUtil($bdd,$_GET['id']);
    header('Location: categorieUtilisateur?supp');
}



?>