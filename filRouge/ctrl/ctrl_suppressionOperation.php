<?php
// importation bdd
include './utils/connectBdd.php';
// importation model
include './model/model_operation.php';
// ------- importation des view -----
include './view/view_suppressionOperation.php';

$operation = new Operation(null,null,null);
// var_dump($operation);
// echo $_GET['id'];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $operation->deleteOperation($bdd,$_GET['id']);
    echo 'l\'operation est bien supprimé';
}

?>