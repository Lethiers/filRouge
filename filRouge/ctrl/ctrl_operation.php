<?php
// importation bdd
include './utils/connectBdd.php';

// importation model
include './model/model_operation.php';

// ------- importation des view -----
include './view/view_operation.php';
$operation = new Operation(null,null,null);

if (isset($_POST['nom_operation']) && !empty($_POST['nom_operation']) 
&& isset($_POST['date_operation']) && !empty($_POST['date_operation']) 
&& isset($_POST['montant_operation']) && !empty($_POST['montant_operation'])) {



    $operation->setDate($_POST['date_operation']);
    $operation->setMontant($_POST['montant_operation']);
    $operation->setNom($_POST['nom_operation']);

    $operation->addOperation($bdd);
    echo '<p>l\'opération '.$operation->getNom().' pour un montant de '.$operation->getMontant().' est bien enregistré<p>';

}else {
    echo 'merci de remplir les champs !';
}
echo '</form>';
echo '</div>';

$operation->showAllOperation($bdd);


?>