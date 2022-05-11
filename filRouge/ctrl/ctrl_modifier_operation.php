<?php
// importation bdd
include './utils/connectBdd.php';
// importation model
include './model/model_operation.php';
include './model/model_balance.php';
include './model/model_cat_global.php';
// ------- importation des view -----
include './view/view_modifierOperation.php';


// initialisation objet operation
$operation = new Operation(null,null,null);

// selectionner si l'operation est positive ou negative grace à l'id balance
$balance = new Balance(null);
$tabBalnce = $balance->showAllIsPositive($bdd);
echo '<select name="positive">
<option value="">--type de dépense--</option>';
echo '<option value='.$tabBalnce[1]['id_balance'].'>positive</option>';
echo '<option value='.$tabBalnce[0]['id_balance'].'>negatif</option>';
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


if (isset($_GET['id']) && !empty($_GET['id'])) {
    $operation->showOperation($bdd,$_GET['id']);
}
if (isset($_POST['nom_operation'])&& !empty($_POST['nom_operation'])&&
isset($_POST['date_operation'])&& !empty($_POST['date_operation'])&&
isset($_POST['montant_operation'])&& !empty($_POST['montant_operation'])) {
    $operation->setDate($_POST['date_operation']);
    $operation->setMontant($_POST['montant_operation']);
    $operation->setNom($_POST['nom_operation']);
    $operation->modifyOperation($bdd,$_GET['id'],$_POST['nom_operation'],$_POST['date_operation'],$_POST['montant_operation'],$_POST['catGlobal'],$_POST['positive']);

    echo 'l\'article '.$operation->getNom().' à été modifié !';

}



?>