<?php
// session_start();
// importation bdd
include './utils/connectBdd.php';

// importation model
include './model/model_utilisateur.php';

// ------- importation des view -----
// include './view/view_header.php';
include './view/view_connexion.php';

$utilisateur = new Utilisateur();

if (isset($_POST['pseudo_util'])&& !empty($_POST['pseudo_util'])&&isset($_POST['mdp_util'])&& !empty($_POST['mdp_util'])) {

    $mdp = $_POST['mdp_util'];
    $hash = $utilisateur->verrifyPassword($bdd,$_POST['pseudo_util']);


    if (password_verify($mdp,$hash)){
        

        $connexion = $utilisateur->checkUser($bdd,$_POST['pseudo_util'],$hash);
        if (!empty($connexion)) {
            var_dump($connexion);
            var_dump($_SESSION['connect']);
            $_SESSION['connect'] = "ok";
            $_SESSION['id'] = $connexion[0]->id_util;
            $_SESSION['pseudo'] = $connexion[0]->pseudo_util;
            echo 'bienvenue '.$_POST['pseudo_util'].'!';
            header('Location:compte');
    
        }else {
            echo 'votre identifiant ou mot de passe est éroné';
    
        }
    }

}else {
    echo 'merci de remplir les champs';
    
}




?>