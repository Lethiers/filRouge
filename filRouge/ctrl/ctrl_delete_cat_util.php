<?php
session_start();
// importation bdd
include './utils/connectBdd.php';

// importation model
include './model/model_cat_util.php';
include './model/model_cat_global.php';

// ------- logical-----


$categoriUtil = new CategoriUtil();

var_dump($_GET['id']);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $categoriUtil->deleteCategorieUtil($bdd,$_GET['id']);
    header('Location: categorieUtilisateur?supp');
}



?>