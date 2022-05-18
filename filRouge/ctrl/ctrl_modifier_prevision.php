<?php

// importation bdd
include './utils/connectBdd.php';
// importation model

//-----------------model prevision
include './model/model_prevision.php';

//-----------------model revenu
include './model/model_revenu.php';

//-----------------model depense
include './model/model_depense.php';

// ------- importation des view -----
include './view/view_modifier_prevision.php';

$message = "";

// voir un seul prevision avec création du formulaire pour le modifier
if (isset($_GET['id'])) {
    $prevision = new prevision();
    $tab = $prevision->showprevision($bdd,$_GET['id']);
    foreach ($tab as $value) {
        echo '<form action="" method="post">';
            echo '<input type="text" name="name_prevision" placeholder='.$value->nom_prevision.'>';
            echo '<input type="submit" value="ajouter un prevision">';
        echo '</form>';
    }
}


// modification du prevision à l'aide du formulaire au dessus
if (isset($_POST['name_prevision']) && !empty($_POST['name_prevision'])) {
    $prevision = new prevision();
    $prevision->setNom($_POST['name_prevision']);
    $prevision->modifyprevision($bdd,$_GET['id']);
    $message = 'Le prevision viens de changer de nom pour : '.$prevision->getNom().'';
}

// suppression du prevision
if (isset($_GET['supp'])) {
    $prevision = new prevision();
    $prevision->deleteprevision($bdd,$_GET['supp']);
    $message = "le prevision viens d'être supprimer";
}

echo $message;
?>