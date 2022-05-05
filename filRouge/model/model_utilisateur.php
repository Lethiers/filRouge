<?php

class Utilisateur{



/*------------------------------- 
                    ATTRIBUTS
        -------------------------------*/
private $nom;
private $prenom;
private $pseudo;
private $email;
private $mdp;

/*------------------------------- 
                    CONSTRUCTEUR
        -------------------------------*/

public function __constructor($nom,$prenom,$pseudo,$email,$mdp){
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->pseudo = $pseudo;
    $this->email = $email;
    $this->mdp = $mdp;
}

/*------------------------------- 
                    SETTER ET GETTEUR
        -------------------------------*/

public function getNom():string{
    return $this->nom_util;
}
public function setNom($nom):void{
    $this->nom_util = $nom;
}

public function getPrenom():string{
    return $this->prenom_util;
}
public function setPrenom($prenom):void{
    $this->prenom_util = $prenom;
}

public function getPseudo():string{
    return $this->pseudo_util;
}
public function setPseudo($pseudo):void{
    $this->pseudo_util = $pseudo;
}

public function getEmail():string{
    return $this->email_util;
}
public function setEmail($email):void{
    $this->email_util = $email;
}

public function getMdp():string{
    return $this->mdp_util;
}
public function setMdp($mdp):void{
    $this->mdp_util = $mdp;
}

/*------------------------------- 
                    METHODES
        -------------------------------*/

        // fonction pour créer l'utilisateur
public function addUser($bdd){

try {
    $req = $bdd->prepare('INSERT INTO utilisateur(mdp_util,pseudo_util,nom_util,prenom_util,email_util) 
    VALUES(:mdp_util,:pseudo_util,:nom_util,:prenom_util,:email_util)');
    $req->execute(array(
        ':mdp_util' => $this->getMdp(),
        ':pseudo_util' => $this->getPseudo(),
        ':nom_util' => $this->getNom(),
        ':prenom_util' => $this->getPrenom(),
        ':email_util' => $this->getEmail()

    ));
} catch (Exception $e) {
    die ('Erreur :' .$e->getMessage());
}
}


    // fonction pour voir les informations de l'utilisateur

public function showUser($bdd,$id){
    try{
       
        $req = $bdd->prepare('SELECT * FROM utilisateur WHERE id_util= :id_util');
        $req->execute(array(
            'id_util' => $id
        ));
        while ($data = $req->fetchAll(PDO::FETCH_OBJ)){
        return $data;

        }

    

    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}
// fonction pour vérifier le mot de passe
public function verrifyPassword($bdd,$pseudo){
    try {
        $req = $bdd->prepare('SELECT mdp_util FROM utilisateur WHERE pseudo_util=:pseudo_util');
        $req->execute(array(
            'pseudo_util' => $pseudo
        ));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data[0]->mdp_util;

    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour vérifier l'existance de l'utilisateur
public function checkUser($bdd,$pseudo,$password){
    try {
        $req = $bdd->prepare('SELECT pseudo_util, mdp_util, id_util FROM utilisateur WHERE pseudo_util = :pseudo_util AND mdp_util = :mdp_util');
        $req->execute(array(
            'pseudo_util' => $pseudo,
            'mdp_util' => $password
        ));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch (Exception $e) {
        die('Erreur :' .$e->getMessage());
    }
}

// fonction pour modifier un utilisateur
public function modifyUser($bdd,$id){
    try {
        $req = $bdd->prepare('UPDATE utilisateur 
        SET pseudo_util=:pseudo_util,nom_util=:nom_util,prenom_util=:prenom_util,email_util=:email_util 
        WHERE id_util=:id_util');
        $req->execute(array(
            'id_util' => $id,
            ':pseudo_util' => $this->getPseudo(),
            ':nom_util' => $this->getNom(),
            ':prenom_util' => $this->getPrenom(),
            ':email_util' => $this->getEmail()
        ));
        
    } catch (Exception $e) {
        die('Erreur :' .$e->getMessage());
    }
}

}

?>