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
include './view/view_diagramme.php';

$message ="";

// formulaire pour créer un nouveau diagramme
if (isset($_POST['name_diagramme']) && !empty($_POST['name_diagramme'])) {
    $diag= new Diagramme();
    $diag->setNom($_POST['name_diagramme']);
    $diag->addDiagramme($bdd);
}else {
    $message = "merci de nommer votre diagramme";
}

// formulaire pour créer un nouveau revenu
if (isset($_POST['nom_revenu']) && !empty($_POST['nom_revenu']) &&
isset($_POST['montant_revenu']) && !empty($_POST['montant_revenu'])) {
    $revenu= new Revenu();
    $revenu->setNom($_POST['nom_revenu']);
    $revenu->setMontant($_POST['montant_revenu']);
    $revenu->addRevenu($bdd);
}else {
    $message = "merci d'ajouter un revenu";
}

// créer un formulaire pour créer une nouvelle dépense
if (isset($_POST['nom_depense']) && !empty($_POST['nom_depense']) &&
isset($_POST['montant_depense']) && !empty($_POST['montant_depense'])) {
    $revenu= new Depense();
    $revenu->setNom($_POST['nom_depense']);
    $revenu->setMontant($_POST['montant_depense']);
    $revenu->addDepense($bdd);
}else {
    $message = "merci d'ajouter une depense";
}

echo $message;

// afficher la liste des diagramme

$diag= new Diagramme();
$tab = $diag->showAllDiagramme($bdd);

echo '<form action="" method="get">';
echo '<select name="diagramme">';
foreach($tab as $value){
    echo '<option value ='.$value->id_diagramme.' name='.$value->id_diagramme.'>  '.$value->nom_diagramme.'</a> </option>';
}
echo '<input type="submit" value="voir">';
echo '</select>';
echo '</form>';



if (isset($_GET['diagramme'])) {
    $diag= new Diagramme();
    $tab = $diag->showDiagramme($bdd,$_GET['diagramme']);

    // création liste diagramme
    echo '<ul>';
    foreach($tab as $value){
        echo '<li>'.$value->nom_diagramme.'</li>';
        echo '<li><a href="modifyDiagramme?id='.$value->id_diagramme.'">modifier</a></li>';
        echo '<li><a href="modifyDiagramme?supp='.$value->id_diagramme.'">supprmier</a></li>';
    }
    echo '</ul>';
}

?>