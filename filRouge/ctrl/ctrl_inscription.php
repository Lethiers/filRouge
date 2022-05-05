<?php
// importation bdd
include './utils/connectBdd.php';

// importation model
include './model/model_utilisateur.php';

// ------- importation des view -----
include './view/view_header.php';
include './view/view_inscription.php';


// ----------- logic ------------

if (isset($_POST['nom_util'])&& !empty($_POST['nom_util'])&&
isset($_POST['prenom_util'])&& !empty($_POST['prenom_util'])&&
isset($_POST['email_util'])&& !empty($_POST['email_util'])&&
isset($_POST['pseudo_util'])&& !empty($_POST['pseudo_util'])&&
isset($_POST['mdp_util'])&& !empty($_POST['mdp_util'])
) {
    $utilisateur = new Utilisateur(null,null,null,null,null);

    

    // option hash mot de passe
    $options = [
        'cost' => 8,
    ];

    // hash
    $mdp = password_hash($_POST['mdp_util'], PASSWORD_BCRYPT, $options);

    
    $utilisateur->setNom($_POST['nom_util']);
    $utilisateur->setPrenom($_POST['prenom_util']);
    $utilisateur->setPseudo($_POST['pseudo_util']);
    $utilisateur->setEmail($_POST['email_util']);
    $utilisateur->setMdp($mdp);

    $utilisateur->addUser($bdd);
    
    echo 'bienvenue à toi '.$utilisateur->getPseudo().'!';
}else {
    echo 'merci de remplir les champs';
}


// ------- importation du footer -----
include './view/view_footer.php';

?>