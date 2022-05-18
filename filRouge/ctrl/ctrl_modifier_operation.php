<?php
// importation bdd
include './utils/connectBdd.php';
// importation model
include './model/model_operation.php';
include './model/model_balance.php';
include './model/model_cat_global.php';
include './model/model_cat_util.php';
// ------- importation des view -----
include './view/view_modifier_operation.php';

// initialisation objet operation
$operation = new Operation(null,null,null,null,null);


// // selectionner si l'operation est positive ou negative grace à l'id balance
// $balance = new Balance(null);
// $tabBalnce = $balance->showAllIsPositive($bdd);
// echo '<select name="positive">
// <option value="">--type de dépense--</option>';
// echo '<option value='.$tabBalnce[1]['id_balance'].'>positive</option>';
// echo '<option value='.$tabBalnce[0]['id_balance'].'>negatif</option>';
// echo '</select>';

if (isset($_GET['id'])) {
    $tablo = $operation->showOperation($bdd,$_GET['id']);

    foreach($tablo as $value){
        echo '
        <form action="" method="post">
        <p>Nom de l\'operation :</p>
        <input type="text" name="nom_operation" placeholder="'.$value->nom_operation.'">
        <p>date de l\'operation :</p>
        <input type="date" name="date_operation" placeholder="'.$value->date_operation.'">
        <p>montant de l\'operation :</p>
        <input type="text" name="montant_operation" placeholder="'.$value->montant_operation.'">';

    }
}

// voir les categorie global sous forme de checkbox
$categorieGlobal = new CategorieGlobal(null);
echo '<select name="catGlobal">
<option value="">--merci de selecitonner une catégorie global--</option>';
$tab = $categorieGlobal->showAllCategorieGlobal($bdd);
foreach($tab as $value){

    echo '<option value='.$value->id_categorie_global.'>'.$value->nom_categorie_global.'</option>';
}
echo '</select>';


// voir les categorie utilisateur sous forme de checkbox
$categorieUtil = new CategorieUtil(null,null,null);
echo '<select name="catUtil">
<option value="">--merci de selecitonner une catégorie utilisateur--</option>';
$tabUtil = $categorieUtil->showCategorieUtil($bdd,$_SESSION['id']);
foreach($tabUtil as $value){

    echo '<option value='.$value->id_categorie_utilisateur.'>'.$value->nom_categorie_utilisateur.'</option>';
}
echo '</select>
<input type="submit" value="modifier">
</form>

';


// traitement du formulaire
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $operation->showOperation($bdd,$_GET['id']);
}
if (isset($_POST['nom_operation'])&& !empty($_POST['nom_operation'])&&
isset($_POST['date_operation'])&& !empty($_POST['date_operation'])&&
isset($_POST['montant_operation'])&& !empty($_POST['montant_operation'])) {

    
    if (isset($_POST['catUtil']) && !empty($_POST['catUtil'])) {
        $categorieGlobalByUtil = $categorieUtil->showCategorieUtilById($bdd,$_POST['catUtil']);
        $operation->setidCatGlobal($categorieGlobalByUtil[0]->id_categorie_global);
        $operation->setidCatUtil($_POST['catUtil']);

        $operation->setDate($_POST['date_operation']);
        $operation->setMontant($_POST['montant_operation']);
        $operation->setNom($_POST['nom_operation']);

        $operation->modifyOperation($bdd,$_GET['id']);
        var_dump($operation);

    }else {
        $operation->setidCatUtil(null);
        $operation->setidCatGlobal($_POST['catGlobal']);

        $operation->setDate($_POST['date_operation']);
        $operation->setMontant($_POST['montant_operation']);
        $operation->setNom($_POST['nom_operation']);

        $operation->modifyOperation($bdd,$_GET['id']);

        var_dump($operation);
    }

    echo 'l\'article '.$operation->getNom().' à été modifié !';

}



?>