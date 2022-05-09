<?php
session_start();
// importation bdd
include './utils/connectBdd.php';

// importation model
//-----------------model diagramme
include './model/model_diagramme.php';

//-----------------model ajouter
include './model/model_ajouter.php';


$ajouter = new Ajouter();


if (isset($_GET['idDiag']) && !empty($_GET['idDiag']) && isset($_GET['idCat']) && !empty($_GET['idCat'])) {

    $tablo = $ajouter->showAjouterIdCatIdDiag($bdd,$_GET['idCat'],$_GET['idDiag']);
    var_dump($tablo);

    foreach($tablo as $value){
        echo '<form action="" method="post">
        <input type="text" name="budget" placeholder='.$value->budget.'>';
        
    }
    echo '<input type="submit" value="modifier">';
    echo '</form>';


    $ajouter->setIdDiag($_GET['idDiag']);
    $ajouter->setIdCat($_GET['idCat']);
    $ajouter->setBudget($_POST['budget']);
    $ajouter->modifyAjouter($bdd);
    header('Location: diagramme');



}else {
    $ajouter->deleteAjouterIdCatIdDiag($bdd,$_GET['idCat'],$_GET['suppDiag']);
    header('Location: diagramme');
}




?>