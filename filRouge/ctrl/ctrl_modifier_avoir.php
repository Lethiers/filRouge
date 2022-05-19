<?php
// importation bdd
include './utils/connectBdd.php';

// importation model
//-----------------model prevision
include './model/model_prevision.php';


//-----------------model avoir
include './model/model_avoir.php';


$avoir = new Avoir();


if (isset($_GET['idprevision']) && !empty($_GET['idprevision']) && isset($_GET['idCat']) && !empty($_GET['idCat'])) {
    $tablo = $avoir->showAvoirIdCatIdprevision($bdd,$_GET['idCat'],$_GET['idprevision']);

    foreach($tablo as $value){
        echo '<form action="" method="post">
        <input type="text" name="budget" placeholder='.$value->budget.'>';
        
    }
    echo '<input type="submit" value="modifier">';
    echo '</form>';


    $avoir->setIdprevision($_GET['idprevision']);
    $avoir->setIdCat($_GET['idCat']);
    $avoir->setBudget($_POST['budget']);
    $avoir->modifyAvoir($bdd);
    header('Location: prevision');



}else {
    $avoir->deleteAvoirIdCatIdprevision($bdd,$_GET['idCat'],$_GET['suppprevision']);
    header('Location: prevision');
}




?>