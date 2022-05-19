<?php
// importation bdd
include './utils/connectBdd.php';
// importation model
include './model/model_utilisateur.php';
// ------- importation des view -----
include './view/view_compte.php';

$utilisateur = new Utilisateur();
$util = $utilisateur->showUser($bdd,$_SESSION['id']);

echo '<input type="text" name="nom_util" value='.$util[0]->nom_util.'><br>';
echo '<input type="text" name="prenom_util" value='.$util[0]->prenom_util.'><br>';
echo '<input type="text" name="pseudo_util" value='.$util[0]->pseudo_util.'><br>';
echo '<input type="text" name="email_util" value='.$util[0]->email_util.'><br>';
echo '<input type="submit" value="modifier" id="bouton">';

// formulaire pour modifier l'utilisateur
if (isset($_POST['nom_util']) && !empty($_POST['nom_util']) &&
isset($_POST['prenom_util']) && !empty($_POST['prenom_util']) &&
isset($_POST['pseudo_util']) && !empty($_POST['pseudo_util']) &&
isset($_POST['email_util']) && !empty($_POST['email_util'])) {
    
    $utilisateur->setPrenom($_POST['prenom_util']);
    $utilisateur->setNom($_POST['nom_util']);
    $utilisateur->setPseudo($_POST['pseudo_util']);
    $utilisateur->setEmail($_POST['email_util']);
    $utilisateur->modifyUser($bdd,$_SESSION['id']);
    
}
echo '</form>';
echo '</div>';
?>