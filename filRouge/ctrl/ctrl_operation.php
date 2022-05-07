<?php
session_start();
var_dump($_SESSION['id']);
// importation bdd
include './utils/connectBdd.php';

// importation model
include './model/model_operation.php';
include './model/model_cat_global.php';
include './model/model_balance.php';


// ------- importation des view -----
include './view/view_operation.php';


$operation = new Operation(null,null,null);
// selectionner si l'operation est positive ou negative

$balance = new Balance(null);

echo '<select name="positive">
<option value="">--type de dépense--</option>';
echo '<option value=true>positive</option>';
echo '<option value=false>negatif</option>';
echo '</select>';




// voir les categorie global sous forme de checkbox
$categorieGlobal = new CategoriGlobal(null);
echo '<select name="catGlobal">
<option value="">--merci de selecitonner une catégorie global--</option>';
$tab = $categorieGlobal->showAllCategorieGlobal($bdd);
foreach($tab as $value){

    echo '<option value='.$value->id_categorie_global.'>'.$value->nom_categorie_global.'</option>';
}
echo '</select>';

echo '<input type="submit" value="Enregistrer">';



if (isset($_POST['nom_operation']) && !empty($_POST['nom_operation']) 
&& isset($_POST['date_operation']) && !empty($_POST['date_operation']) 
&& isset($_POST['montant_operation']) && !empty($_POST['montant_operation'])
&& isset($_POST['catGlobal']) && !empty($_POST['catGlobal']) 
&& isset($_POST['positive']) && !empty($_POST['positive'])) {



// /////////////////////////////////en  cours de travail //////////////////
    var_dump($_POST['positive']);

    if ($_POST['positive'] == 'true') {
        var_dump($operation->setidBalance(2));
    }else {
        var_dump($operation->setidBalance(1));
    }
   // pb de typage voir si on passe en force sans le setteur
/////////////////////////////////////////////////////////////////////////////////
    $operation->setDate($_POST['date_operation']);
    $operation->setMontant($_POST['montant_operation']);
    $operation->setNom($_POST['nom_operation']);
    $operation->setidCatGlobal($_POST['catGlobal']);
    $operation->setidBalance($_POST['positive']);

    var_dump($operation);

    // $operation->addOperation($bdd,$_SESSION['id']);

    echo '<p>l\'opération '.$operation->getNom().' pour un montant de '.$operation->getMontant().' est bien enregistré<p>';

}else {
    echo 'merci de remplir les champs !';
}

echo '</form>';
echo '</div>';

// $operation->showAllOperation($bdd);


?>