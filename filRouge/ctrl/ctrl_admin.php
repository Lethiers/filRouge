<?php
session_start();
// importation bdd
include './utils/connectBdd.php';
// importation model
// model utilisateur
include './model/model_utilisateur.php';
// model categorie global
include './model/model_cat_global.php';

// ------- importation des view -----
include './view/view_header.php';

// --------------------- salutaion à l'administrateur
echo '<h1>bonjour '.$_SESSION['pseudo'].'</h1>';

include './view/view_admin.php';

$message = "";
// --- LOGICAL

$cat = new CategoriGlobal();
if (isset($_POST['nom_categorie_global'])&& !empty($_POST['nom_categorie_global'])) {
    $cat->setNom($_POST['nom_categorie_global']);
    $cat->addCategorieUtil($bdd);

    $message = 'la catégorie '.$cat->getNom().' viens d\'etre créé';
}else {
    $message = "merci de remplir les champs";
}

echo $message;

$tab = $cat->showAllCategorieGlobal($bdd);

echo '<form action="" method="post">';
echo '<ul>';
foreach($tab as $value){
    echo '<li><input type="checkbox" name='.$value->nom_categorie_global.'><label for='.$value->nom_categorie_global.'>'.$value->nom_categorie_global.'</label></li>';

    
}
echo '</ul>';

echo '<input type="submit" value="supprimer">';
echo '<input type="submit" value="modifier">';
echo '</form>';






?>