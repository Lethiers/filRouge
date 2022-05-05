<?php
// importation bdd
include './utils/connectBdd.php';
// importation model
include './model/model_operation.php';
// ------- importation des view -----
include './view/view_modifierOperation.php';

$operation = new Operation(null,null,null);
var_dump($_GET['id']);

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $operation->showOperation($bdd,$_GET['id']);
}
if (isset($_POST['nom_operation'])&& !empty($_POST['nom_operation'])&&
isset($_POST['date_operation'])&& !empty($_POST['date_operation'])&&
isset($_POST['montant_operation'])&& !empty($_POST['montant_operation'])) {
    $operation->setDate($_POST['date_operation']);
    $operation->setMontant($_POST['montant_operation']);
    $operation->setNom($_POST['nom_operation']);
    $operation->modifyOperation($bdd,$_GET['id'],$_POST['nom_operation'],$_POST['date_operation'],$_POST['montant_operation']);

    echo 'l\'article '.$operation->getNom().' à été modifié !';

}



?>