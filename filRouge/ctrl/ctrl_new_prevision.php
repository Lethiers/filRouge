<?php
// session_start();
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

echo '<form action="" method="get">';
echo '<select name="prevision">';
foreach($tab as $value){
    echo '<option value ='.$value->id_prevision.' name='.$value->id_prevision.'>  '.$value->nom_prevision.'</a> </option>';
}
echo '<input type="submit" value="voir">';
echo '</select>';
echo '</form>';



if (isset($_GET['prevision'])) {

    $tab = $prevision->showPrevision($bdd,$_GET['prevision']);


    // création liste prevision
    echo '<ul>';
    foreach($tab as $value){
        echo '<li>'.$value->nom_prevision.'</li>';
        echo '<li><a href="modifyprevision?id='.$value->id_prevision.'">modifier</a></li>';
        echo '<li><a href="modifyprevision?supp='.$value->id_prevision.'">supprmier</a></li>';



            // instancier obget cat global
        $categorieGlobal = new CategorieGlobal(null);
            // instancier obget cat util
        $categorieUtil = new CategorieUtil(null);

        //////////////////////////// CEST OK AU DESSUS ////////////////////////////

 /////////////////////////////////////////// TABLE AVOIR ///////////////////////
        $avoir= new Avoir();
        
        //     /// tentative d'inner join ///////
        // var_dump($avoir->innerJoinprevision($bdd,$_GET['prevision']));
        //     /// tentative d'inner join ///////


        $liste = $avoir->showAllAvoirByprevision($bdd,$_GET['prevision']);


        foreach($liste as $value){

            /****************** TROUVER NON CAT GLOBAL CAT GLOBAL  *****************/
            $nomCatGlobal = $categorieGlobal->showCategorieGlobalTablo($bdd);

            echo '<li>'.$nomCatGlobal[($value->id_categorie_global)-1]["nom_categorie_global"].'</li>';
var_dump($nomCatGlobal[($value->id_categorie_global)-1]["id_categorie_global"]);
            /****************** TROUVER NON CAT GLOBAL CAT GLOBAL  ***************/

            echo '<li>'.$value->budget.'</li>';

            ///////////////////////////// MODIFIER LES CHEMIN ///////////////////////
            ///////////////////////////// MODIFIER LES CHEMIN ///////////////////////
            echo '<li><a href="modifierDepenseGlobal?idprevision='.$value->id_prevision.'&idCat='.$nomCatGlobal[($value->id_categorie_global)-1]["id_categorie_global"].'">modifier</a></li>';
            echo '<li><a href="modifierDepenseGlobal?suppprevision='.$value->id_prevision.'&idCat='.$nomCatGlobal[($value->id_categorie_global)-1]["id_categorie_global"].'">supprmier</a></li>';
        }


        /////////////////////////////////////////// TABLE AJOUTER ///////////////////////


        /********************************modifier le nom */
// $ajouter= new Ajouter();

// $liste = $ajouter->showAllAjouterByprevision($bdd,$_GET['prevision']);
// // var_dump($liste);
// foreach($liste as $value){

//         /****************** TROUVER NON CAT util   *****************/
//         $listeCatUtil = $categorieUtil->showCategorieUtilTablo($bdd,$_SESSION['id']);
//         echo 'liste de l util <br>';

//         echo '<li>'.$listeCatUtil[($value->id_categorie_utilisateur)-1]["nom_categorie_utilisateur"].'</li>';

//         /****************** TROUVER NON CAT util  ***************/
//     echo '<li>'.$value->budget.'</li>';

//     ///////////////////////////// MODIFIER LES CHEMIN ///////////////////////
//     ///////////////////////////// MODIFIER LES CHEMIN ///////////////////////
//     echo '<li><a href="modifierDepenseUtil?idprevision='.$value->id_prevision.'&idCat='.$listeCatUtil[($value->id_categorie_utilisateur)-1]["id_categorie_utilisateur"].'">modifier</a></li>';
//     echo '<li><a href="modifierDepenseUtil?suppprevision='.$value->id_prevision.'&idCat='.$listeCatUtil[($value->id_categorie_utilisateur)-1]["id_categorie_utilisateur"].'">supprimer</a></li>';
// }



///////////////////// AJOUTER UNE PREVISION GLOBAL ///////////////////////////////
// voir les categorie global sous forme de menu
// debut form
echo '<form action="" method="post">';
echo '<p>Budget alloué Categorie Global</p>
<input type="text" name="budget">';


///////////////////////////////////////////////////////// LISTE DEROULANTE CAT GLOBAL /////////////////////
// $categorieGlobal = new CategorieGlobal(null);
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
    $avoir->setIdprevision($_GET['prevision']);
    $avoir->setIdCat($_POST['catGlobal']);
    $avoir->setBudget($_POST['budget']);
    $avoir->addAvoir($bdd);
}

///////////////////////////////// FIN TABLE AVOIR ////////////////////////////////////////


///////////////////// AJOUTER UNE PREVISION UTILISATEUR ///////////////////////////////
// voir les categorie global sous forme de menu
// debut form
// echo '<form action="" method="post">';
// echo '<p>Budget alloué Categorie Utilisateur</p>
// <input type="text" name="budget">';


///////////////////////////////////////////////////////// LISTE DEROULANTE CAT UTIL /////////////////////

// echo '<select name="catUtil">
// <option value="">--merci de selecitonner une catégorie utilisateur--</option>';
// $tab = $categorieUtil->showAllCategorieUtil($bdd);
// foreach($tab as $value){

//     echo '<option value='.$value->id_categorie_utilisateur.'>'.$value->nom_categorie_utilisateur.'</option>';
// }
// echo '</select>';
// fin duformulaire ////////////////
// echo '<input type="submit" value="ajouter une depense">
echo '
</div>';

///////////////////////////////// FIN TABLE AVOIR ////////////////////////////////////////


    }
    echo '</ul>';


    /*VA FALOIR IMPORTER LA PAGE MODIFICATION ICI*/

}





?>