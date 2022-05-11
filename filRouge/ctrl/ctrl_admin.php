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
// include './view/view_header.php';

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

echo '<ul>';
foreach($tab as $value){


    echo '<li>
    <label for='.$value->nom_categorie_global.'>'.$value->nom_categorie_global.'</label></br>
    <a href="updateDiagrammeGlobal?id='.$value->id_categorie_global.'">modifier</a>
    <a href="deleteDiagrammeGlobal?id='.$value->id_categorie_global.'">supprimer</a>
    </li>';

    
}
echo '</ul>';
// on utilise le retour du ctrl delete pour afficher un message de suppression
$msg = "";
if (isset($_GET['supp'])) {
    $msg = "la catégorie viens d'être supprimer";
    // ----------------------------------------------------------------------------------- faut rajouter un timer JS
    // header('Location: admin'); 
}

if (isset($_GET['modify'])) {
    $msg = "la catégorie viens d'être modifier";
    // ----------------------------------------------------------------------------------- faut rajouter un timer JS
    // header('Location: admin'); 
}

echo $msg;


?>