<?php
session_start();
var_dump( $_SESSION['id']);
// importation bdd
include './utils/connectBdd.php';
// importation model

//-----------------model diagramme
include './model/model_diagramme.php';

//-----------------model revenu
include './model/model_revenu.php';

//-----------------model depense
include './model/model_depense.php';

//-----------------model cat global
include './model/model_cat_global.php';

//-----------------model cat util
include './model/model_cat_util.php';


//-----------------model ajouter
include './model/model_ajouter.php';


//-----------------model avoir
include './model/model_avoir.php';

// ------- importation des view -----
include './view/view_diagramme.php';


$message ="";
// formulaire pour créer un nouveau diagramme
if (isset($_POST['name_diagramme']) && !empty($_POST['name_diagramme'])) {
    $diag= new Diagramme();
    // ajout id util
    $diag->setIdUtil($_SESSION['id']);
    // ajout id frequence ATTENTION si besoin d'ajout il faut modifier le select
    $diag->setIdFrequence($_POST['frequence']);
    $diag->setNom($_POST['name_diagramme']);
    $diag->addDiagramme($bdd);
    $message = 'le diagramme '.$diag->getNom().' est créé !';
}else {
    $message = "merci de nommer votre diagramme";
}
echo $message;




// afficher la liste des diagramme

$diag= new Diagramme();
$tab = $diag->showAllDiagramme($bdd);

echo '<form action="" method="get">';
echo '<select name="diagramme">';
foreach($tab as $value){
    echo '<option value ='.$value->id_diagramme.' name='.$value->id_diagramme.'>  '.$value->nom_diagramme.'</a> </option>';
}
echo '<input type="submit" value="voir">';
echo '</select>';
echo '</form>';



if (isset($_GET['diagramme'])) {
    $diag= new Diagramme();
    $tab = $diag->showDiagramme($bdd,$_GET['diagramme']);


    // création liste diagramme
    echo '<ul>';
    foreach($tab as $value){
        echo '<li>'.$value->nom_diagramme.'</li>';
        echo '<li><a href="modifyDiagramme?id='.$value->id_diagramme.'">modifier</a></li>';
        echo '<li><a href="modifyDiagramme?supp='.$value->id_diagramme.'">supprmier</a></li>';



        /////////////////////////////////////////// TABLE AVOIR ///////////////////////

        // instancier obget cat global
$categorieGlobal = new CategoriGlobal(null);
        // instancier obget cat util
$categorieUtil = new CategoriUtil(null);

/********************EN COURS *********************************** */
$avoir= new Avoir();


$liste = $avoir->showAllAvoirByDiag($bdd,$_GET['diagramme']);
foreach($liste as $value){

    /****************** TROUVER NON CAT GLOBAL CAT GLOBAL  *****************/
    $listeCatGlobal = $categorieGlobal->showCategorieGlobalTablo($bdd);

    echo '<li>'.$listeCatGlobal[($value->id_categorie_global)-1]["nom_categorie_global"].'</li>';

    /****************** TROUVER NON CAT GLOBAL CAT GLOBAL  ***************/

    echo '<li>'.$value->budget.'</li>';
    // var_dump($liste);
    ///////////////////////////// MODIFIER LES CHEMIN ///////////////////////
    ///////////////////////////// MODIFIER LES CHEMIN ///////////////////////
    echo '<li><a href="modifyDiagramme?id='.$value->id_diagramme.'">modifier</a></li>';
    echo '<li><a href="modifyDiagramme?supp='.$value->id_diagramme.'">supprmier</a></li>';
}


        /////////////////////////////////////////// TABLE AJOUTER ///////////////////////


        /********************************modifier le nom */
$ajouter= new Ajouter();

$liste = $ajouter->showAllAjouterByDiag($bdd,$_GET['diagramme']);
// var_dump($liste);
foreach($liste as $value){

        /****************** TROUVER NON CAT util   *****************/
        $listeCatUtil = $categorieUtil->showCategorieUtilTablo($bdd,$_SESSION['id']);
        echo 'liste de l util <br>';
        // var_dump($listeCatUtil);
        // echo '<br>';
        // var_dump($value->id_categorie_utilisateur);
        echo '<li>'.$listeCatUtil[($value->id_categorie_utilisateur)-1]["nom_categorie_utilisateur"].'</li>';
    
        /****************** TROUVER NON CAT util  ***************/
    echo '<li>'.$value->budget.'</li>';

    ///////////////////////////// MODIFIER LES CHEMIN ///////////////////////
    ///////////////////////////// MODIFIER LES CHEMIN ///////////////////////
    echo '<li><a href="modifyDiagramme?id='.$value->id_diagramme.'">modifier</a></li>';
    echo '<li><a href="modifyDiagramme?supp='.$value->id_diagramme.'">supprmier</a></li>';
}



///////////////////// AJOUTER UNE PREVISION GLOBAL ///////////////////////////////
// voir les categorie global sous forme de menu
// debut form
echo '<form action="" method="post">';
echo '<p>Budget alloué Categorie Global</p>
<input type="text" name="budget">';


///////////////////////////////////////////////////////// LISTE DEROULANTE CAT GLOBAL /////////////////////
// $categorieGlobal = new CategoriGlobal(null);
echo '<select name="catGlobal">
<option value="">--merci de selecitonner une catégorie global--</option>';
$tab = $categorieGlobal->showAllCategorieGlobal($bdd);
foreach($tab as $value){

    echo '<option value='.$value->id_categorie_global.'>'.$value->nom_categorie_global.'</option>';
}
echo '</select>';
// fin duformulaire ////////////////
echo '<input type="submit" value="ajouter une depense">
</form>
</div>';
if (isset($_POST['budget'])&& !empty($_POST['budget'])&& isset($_POST['catGlobal'])&& !empty($_POST['catGlobal'])) {
    $avoir= new avoir();
    $avoir->setIdDiag($_GET['diagramme']);
    $avoir->setIdCat($_POST['catGlobal']);
    $avoir->setBudget($_POST['budget']);
    $avoir->addAvoir($bdd);
}
///////////////////////////////// FIN TABLE AVOIR ////////////////////////////////////////


///////////////////// AJOUTER UNE PREVISION UTILISATEUR ///////////////////////////////
// voir les categorie global sous forme de menu
// debut form
echo '<form action="" method="post">';
echo '<p>Budget alloué Categorie Utilisateur</p>
<input type="text" name="budget">';


///////////////////////////////////////////////////////// LISTE DEROULANTE CAT UTIL /////////////////////

echo '<select name="catUtil">
<option value="">--merci de selecitonner une catégorie utilisateur--</option>';
$tab = $categorieUtil->showAllCategorieUtil($bdd);
foreach($tab as $value){

    echo '<option value='.$value->id_categorie_utilisateur.'>'.$value->nom_categorie_utilisateur.'</option>';
}
echo '</select>';
// fin duformulaire ////////////////
echo '<input type="submit" value="ajouter une depense">
</form>
</div>';
if (isset($_POST['budget'])&& !empty($_POST['budget'])&& isset($_POST['catUtil'])&& !empty($_POST['catUtil'])) {
    $ajouter= new Ajouter();
    $ajouter->setIdDiag($_GET['diagramme']);
    $ajouter->setIdCat($_POST['catUtil']);
    $ajouter->setBudget($_POST['budget']);
    $ajouter->addAjouter($bdd);
}
///////////////////////////////// FIN TABLE AVOIR ////////////////////////////////////////


    }
    echo '</ul>';


    /*VA FALOIR IMPORTER LA PAGE MODIFICATION ICI*/

}





?>