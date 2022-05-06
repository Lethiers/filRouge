<?php
session_start();
var_dump( $_SESSION['id']);
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
    // ajout id util
    $diag->setIdUtil($_SESSION['id']);
    // ajout id frequence ATTENTION si besoin d'ajout il faut modifier le select
    $diag->setIdFrequence($_POST['frequence']);
    $diag->setNom($_POST['name_diagramme']);
    $diag->addDiagramme($bdd);
    $message = 'le diagramme '.$diag->getNom().' est créé !';
}else {
    $message = "merci de nommer votre diagramme";
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


    /*VA FALOIR IMPORTER LA PAGE MODIFICATION ICI*/

}





?>