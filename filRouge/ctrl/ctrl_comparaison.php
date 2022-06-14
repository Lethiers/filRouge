<?php
// importation de la bdd
include './utils/connectBdd.php';
// importation des models
include './model/model_ajouter.php';
include './model/model_avoir.php';
include './model/model_prevision.php';
include './model/model_operation.php';
include './model/model_cat_global.php';
include './model/model_cat_util.php';
// importation de la view
include './view/view_comparaison.php';
// -- logical




// choix du champ a comparer


echo'
<form action="" method="post">';
// choix du prevision
$prevision = new prevision();
$tabloprevision = $prevision->showprevisionById($bdd,$_SESSION['id']);

echo'
<img src="./asset/image/licorneInterogate.png" alt="">
<h2>vous pouvez comparer les dépenses prévu avec les dépenses saisies :</h2>
    <p>Il suffit de choisir un des champs enregistré.</p>';

    echo '<select name="prevision" class="bouton">
    <option value="">choisir une prévision</option>';
    foreach($tabloprevision as $value){
        echo '<option value='.$value->id_prevision.'>'.$value->nom_prevision.'</option>';
    }
    echo '</select>';

    ///////////////////////////////////////////////////AFFICHER LES CAT GLOBAL DE LA PREVISION//////////////////////////////////////////////////////////////////
    // gestion formulaire pour afficher categorie global prevision
if (isset($_POST['prevision'])&&!empty($_POST['prevision'])) {
    // on utilise l'id pour retrouver le nom de la cat global
    $categorieGlobal = new CategorieGlobal();
    $avoir= new Avoir();
        $liste = $avoir->showAllAvoirByprevision($bdd,$_POST['prevision']);
        foreach($liste as $value){
            echo '<div class="operation">';
            /****************** TROUVER NON CAT GLOBAL CAT GLOBAL  *****************/
            $nomCatGlobal = $categorieGlobal->showCategorieGlobalTablo($bdd);
            echo '<li>'.$nomCatGlobal[($value->id_categorie_global)-1]["nom_categorie_global"].'</li>';
            /****************** TROUVER NON CAT GLOBAL CAT GLOBAL  ***************/
            echo '<li>'.$value->budget.'</li>';
            echo '<li><a href="comparaison?budget='.$value->budget.'&nom='.$nomCatGlobal[($value->id_categorie_global)-1]["nom_categorie_global"].'&idPrevision='.$value->id_prevision.'&idCat='.$nomCatGlobal[($value->id_categorie_global)-1]["id_categorie_global"].'">Comparer</a></li>';
            echo '</div>';
        }
}

//////////////////////////////////////// FINNNNNN AFFICHER LES CAT GLOBAL DE LA PREVISION/////////////////////////////////////////////// 
    

echo'    
<input type="submit" value="choisir" class="bouton">
</form>
</div>';


        

// pour afficher l'ensemble des dépenses depuis une date
$operation = new Operation ();
$tabloOperation = $operation->showAllOperationByDate($bdd,$_POST['date_operation'],$_SESSION['id']);


$tabloNom=[];
$tabloMontant=[];


foreach($tabloOperation as $value){
    if ($value->nom_operation != null) {
        array_push($tabloNom, $value->nom_operation);
    }
    if ($value->montant_operation != null) {
        array_push($tabloMontant, $value->montant_operation);
    }
}


// ON RECUPERE LE BUDGET ET MONTANT AVEC GET IL FAUT METTANT RAJOUTER MONTANT DEPENSE
$testNom = [];
$testMontant = [];

if (isset($_GET['nom'])&& !empty($_GET['nom'])&&
isset($_GET['budget'])&& !empty($_GET['budget'])) {
    array_push($testNom, (''.$_GET['nom'].' : prevision'));
    array_push($testMontant, $_GET['budget']);
}

if (isset($_GET['idCat'])&& !empty($_GET['idCat'])) {
   
    foreach($tabloOperation as $value){
        if ($value->id_categorie_global == $_GET['idCat']) {
            array_push($testNom, (''.$value->nom_operation.' : Operation'));
            array_push($testMontant, $value->montant_operation);
        }else {
            echo '';
        }
    }
    
}

$AffichageTabloNom =[];
$AffichageTabloMontant =[];
if ($_GET['idPrevision'] && !empty($_GET['idPrevision'])) {
    $AffichageTabloNom = $testNom;
    $AffichageTabloMontant = $testMontant;
}else{
    $AffichageTabloNom = $tabloNom;
    $AffichageTabloMontant = $tabloMontant;
}


// je convertis les données au format json pour utiliser les datas avec chartJs
$tabloNomJson = json_encode($AffichageTabloNom);
$tabloMontantJson = json_encode($AffichageTabloMontant);

echo '<script>', 'diagramme('.$tabloNomJson.','.$tabloMontantJson.');', '</script>';
?>