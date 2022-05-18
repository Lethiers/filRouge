<?php
// importation bdd
include './utils/connectBdd.php';
// importation model
include './model/model_operation.php';
// ------- importation des view -----
include './view/view_suppression_operation.php';

$operation = new Operation(null,null,null);
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $operation->deleteOperation($bdd,$_GET['id']);
    echo 'l\'operation est bien supprimé';
}

?>