<?php
// importation bdd
include './utils/connectBdd.php';

// importation model
//-----------------model prevision
include './model/model_prevision.php';

/*********************LES CATEGORIES******* */
//-----------------model cat global
include './model/model_cat_global.php';
//-----------------model cat util
include './model/model_cat_util.php';

/*********************LES TABLES ASSOCIATIONS ******* */
//-----------------model ajouter
include './model/model_ajouter.php';
//-----------------model avoir
include './model/model_avoir.php';
/*********************LES TABLES ASSOCIATIONS ******* */

// ------- importation des view -----
include './view/view_prevision.php';


$message ="";

// initialise objet prevision
$prevision= new prevision();
// instancier obget cat global
$categorieGlobal = new CategorieGlobal(null);

// formulaire pour créer un nouveau prevision
if (isset($_POST['name_prevision']) && !empty($_POST['name_prevision']) &&
isset($_POST['budget_prevision']) && !empty($_POST['budget_prevision'])) {

    // ajout id util
    $prevision->setIdUtil($_SESSION['id']);

    // ajout id frequence ATTENTION si besoin d'ajout il faut modifier le select
    $prevision->setIdFrequence($_POST['frequence']);
    $prevision->setNom($_POST['name_prevision']);
    $prevision->setBudget($_POST['budget_prevision']);
    $prevision->addprevision($bdd);
    $message = 'le prevision '.$prevision->getNom().' est créé !';
}else {
    $message = "merci de nommer votre prevision";
}
echo $message;

 
// afficher la liste des prevision
$tab = $prevision->showPrevisionById($bdd,$_SESSION['id']);
echo '<div class="containeurMid">';
echo '<form action="" method="get">';
echo '<h2>Voir votre prevision :</h2>';
echo '<img src="./asset/image/licornePoison.png" alt="">';
echo '<select name="prevision" class="bouton">';
foreach($tab as $value){
    echo '<option value ='.$value->id_prevision.' name='.$value->id_prevision.'>  '.$value->nom_prevision.'</a> </option>';
}
echo '</select>';
echo '<input type="submit" value="voir" class="bouton">';
echo '</form>';
echo '</div>';
///////////////////////////// OK AU DESSUS créer une prevision puis la voir //////////////
if (isset($_GET['prevision'])) {

    ///////////////////// AJOUTER UNE PREVISION GLOBAL ///////////////////////////////
// voir les categorie global sous forme de menu
// debut form
echo '<div class="containeurBottom">';
echo '<form action="" method="post">';
echo '<img src="./asset/image/licorneVomi.png" alt="">';
echo '<p>Budget alloué Categorie Global</p>

<input type="text" name="budget">';

///////////////////////////////////////////////////////// LISTE DEROULANTE CAT GLOBAL /////////////////////
// $categorieGlobal = new CategorieGlobal(null);
echo '<select name="catGlobal" class="bouton">
<option value="">catégorie global</option>';
$tab = $categorieGlobal->showAllCategorieGlobal($bdd);
foreach($tab as $value){

    echo '<option value='.$value->id_categorie_global.'>'.$value->nom_categorie_global.'</option>';
}
echo '</select>';
// fin duformulaire ////////////////
echo '<input type="submit" value="ajouter une depense" class="bouton">
</form>';
echo '</div>';
///////////////////////////////--------FIN FORMULAIRE AJOUT PREVISION ---------------------////////////////////////////////////////////////////////




    $tab = $prevision->showPrevision($bdd,$_GET['prevision']);
    // création liste prevision
    
    
        
    foreach($tab as $value){
        echo '<div class="operation">';
        echo '<img src="./asset/image/licorneCoucou.png" alt="">';
        echo '<p>Vous regardez actuellement le diagramme: <br><span>'.$value->nom_prevision.'<span></p>';
        echo '<p><a href="modifyprevision?id='.$value->id_prevision.'">modifier</a></p>';
        echo '<p><a href="modifyprevision?supp='.$value->id_prevision.'">supprmier</a></p>';
        echo '</div>';

        //////////////////////////// CEST OK AU DESSUS ////////////////////////////

 /////////////////////////////////////////// TABLE AVOIR ///////////////////////

        echo '<ul class="budget">';
        $avoir= new Avoir();

        $liste = $avoir->showAllAvoirByprevision($bdd,$_GET['prevision']);


        foreach($liste as $value){
            echo '<div class="operation">';
            /****************** TROUVER NON CAT GLOBAL CAT GLOBAL  *****************/
            $nomCatGlobal = $categorieGlobal->showCategorieGlobalTablo($bdd);
            echo '<li>'.$nomCatGlobal[($value->id_categorie_global)-1]["nom_categorie_global"].'</li>';
            /****************** TROUVER NON CAT GLOBAL CAT GLOBAL  ***************/
            echo '<li>'.$value->budget.'</li>';
            echo '<li><a href="modifierDepenseGlobal?idprevision='.$value->id_prevision.'&idCat='.$nomCatGlobal[($value->id_categorie_global)-1]["id_categorie_global"].'">modifier</a></li>';
            echo '<li><a href="modifierDepenseGlobal?suppprevision='.$value->id_prevision.'&idCat='.$nomCatGlobal[($value->id_categorie_global)-1]["id_categorie_global"].'">supprmier</a></li>';
            echo '</div>';
        }

// test logique pour ajouter une catégorie
if (isset($_POST['budget'])&& !empty($_POST['budget'])&& isset($_POST['catGlobal'])&& !empty($_POST['catGlobal'])) {
    $avoir= new avoir();
    $avoir->setIdprevision($_GET['prevision']);
    $avoir->setIdCat($_POST['catGlobal']);
    $avoir->setBudget($_POST['budget']);
    $avoir->addAvoir($bdd);
}

echo '
</div>';

    }
    echo '</ul>';

}






?>