<?php

// importation bdd
include './utils/connectBdd.php';
// importation model

//-----------------model prevision
include './model/model_prevision.php';
include './model/model_cat_global.php';
include './model/model_avoir.php';

// //-----------------model revenu
// include './model/model_revenu.php';

// //-----------------model depense
// include './model/model_depense.php';

// ------- importation des view -----
include './view/view_modifier_prevision.php';

$message = "";

// instanciaiton obj
$categorieGlobal = new CategorieGlobal(null);
$prevision = new prevision();
$avoir = new Avoir(null,null,null);

// voir un seul prevision avec création du formulaire pour le modifier
if (isset($_GET['id'])) {
    
    $tab = $prevision->showprevision($bdd,$_GET['id']);
    foreach ($tab as $value) {
        echo '<form action="" method="post">';
            echo '<input type="text" name="name_prevision" placeholder='.$value->nom_prevision.'>';
    }
}

//////////////////////////////PARFAIT POUR MODIFIER LA PREVISION ///////////////////////


$avoirTableau = $avoir->innerJoinPrevision($bdd,$_GET['id']);

foreach($avoirTableau as $value){
    $a = $categorieGlobal->returnNameCatGlobal($bdd,$value->id_categorie_global);

    echo '<label for="">'.$a[0]['nom_categorie_global'].'</label>
    <input type="text" name="'.$value->id_categorie_global.'" id="'.$value->id_categorie_global.'" placeholder='.$value->budget.'>';
}
echo '<input type="submit" value="modifier">';
echo '</form>';

/////////////////////////////////////////////////////////////////////

// modification du prevision à l'aide du formulaire au dessus
if (isset($_POST['name_prevision']) && !empty($_POST['name_prevision'])) {
    $prevision->setNom($_POST['name_prevision']);
    $prevision->modifyprevision($bdd,$_GET['id']);
    $message = 'Le prevision viens de changer de nom pour : '.$prevision->getNom().'';
}

// suppression du prevision
if (isset($_GET['supp'])) {
    $prevision->deleteprevision($bdd,$_GET['supp']);
    $message = "le prevision viens d'être supprimer";
}


echo $message;
?>