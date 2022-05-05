<?php

// importation bdd
include './utils/connectBdd.php';
// importation model

//-----------------model diagramme
include './model/model_diagramme.php';

//-----------------model revenu
include './model/model_revenu.php';

//-----------------model depense
include './model/model_depense.php';

// ------- importation des view -----
include './view/view_modify_diagramme.php';

$message = "";

// voir un seul diagramme avec création du formulaire pour le modifier
if (isset($_GET['id'])) {
    $diag = new Diagramme();
    $tab = $diag->showDiagramme($bdd,$_GET['id']);
    foreach ($tab as $value) {
        echo '<form action="" method="post">';
            echo '<input type="text" name="name_diagramme" placeholder='.$value->nom_diagramme.'>';
            echo '<input type="submit" value="ajouter un diagramme">';
        echo '</form>';
    }
}


// modification du diagramme à l'aide du formulaire au dessus
if (isset($_POST['name_diagramme']) && !empty($_POST['name_diagramme'])) {
    $diag = new Diagramme();
    $diag->setNom($_POST['name_diagramme']);
    $diag->modifyDiagramme($bdd,$_GET['id']);
    $message = 'Le diagramme viens de changer de nom pour : '.$diag->getNom().'';
}

// suppression du diagramme
if (isset($_GET['supp'])) {
    $diag = new Diagramme();
    $diag->deleteDiagramme($bdd,$_GET['supp']);
    $message = "le diagramme viens d'être supprimer";
}

echo $message;
?>