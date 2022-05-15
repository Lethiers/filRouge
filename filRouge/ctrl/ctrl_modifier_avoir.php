<?php
// importation bdd
include './utils/connectBdd.php';

// importation model
//-----------------model diagramme
include './model/model_diagramme.php';


//-----------------model avoir
include './model/model_avoir.php';


$avoir = new Avoir();


if (isset($_GET['idDiag']) && !empty($_GET['idDiag']) && isset($_GET['idCat']) && !empty($_GET['idCat'])) {
    $tablo = $avoir->showAvoirIdCatIdDiag($bdd,$_GET['idCat'],$_GET['idDiag']);
    var_dump($tablo);

    foreach($tablo as $value){
        echo '<form action="" method="post">
        <input type="text" name="budget" placeholder='.$value->budget.'>';
        
    }
    echo '<input type="submit" value="modifier">';
    echo '</form>';


    $avoir->setIdDiag($_GET['idDiag']);
    $avoir->setIdCat($_GET['idCat']);
    $avoir->setBudget($_POST['budget']);
    $avoir->modifyAvoir($bdd);
    header('Location: diagramme');



}else {
    $avoir->deleteAvoirIdCatIdDiag($bdd,$_GET['idCat'],$_GET['suppDiag']);
    header('Location: diagramme');
}




?>