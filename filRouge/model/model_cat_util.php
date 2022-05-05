<?php

class CategoriUtil{

/*------------------------------- 
                    ATTRIBUTS
        -------------------------------*/

private $nom_categorie_utilisateur;

/*------------------------------- 
                    CONSTRUCTEUR
        -------------------------------*/
public function __constructor($nom_categorie_utilisateur){
    $this->nom_categorie_utilisateur = $nom_categorie_utilisateur;
}
/*------------------------------- 
                    SETTER ET GETTEUR
        -------------------------------*/


public function getNom():string{
    return $this->nom_categorie_utilisateur;
}
public function setNom($nom_categorie_utilisateur):void{
    $this->nom_categorie_utilisateur = $nom_categorie_utilisateur;
}
/*------------------------------- 
                    METHODES
        -------------------------------*/
// fonction pour créer une catégorie utilisateur
public function addCategorieUtil($bdd):void{
    try {
        
        $req = $bdd->prepare('INSERT INTO categorie_utilisateur(nom_categorie_utilisateur)
        VALUES (:nom_categorie_utilisateur)');
        $req->execute(array(
            ':nom_categorie_utilisateur' => $this->getNom();
        ));



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour afficher toute les categories utilisateur
public function showAllCategorieUtil($bdd):void{
    try {
        
        $req = $bdd->prepare('SELECT * FROM categorie_utilisateur');
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour voir une catégorie utilisateur
public function showCategorieUtil($bdd,$id):void{
    try {
        
        $req = $bdd->prepare('SELECT * FROM categorie_utilisateur WHERE id_categorie_utilisateur=:id_categorie_utilisateur');
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// supprimer une catégorie utilisateur
public function showCategorieUtil($bdd,$id):void{
    try {
        
        $req = $bdd->prepare('DELETE FROM categorie_utilisateur WHERE id_categorie_utilisateur=:id_categorie_utilisateur');
        $req->execute(array(
            'id_operation' =>$id
        ));




    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour modifier une catégorie utilisateur
public function modifyCatUtil($bdd,$id,$nom){
    try {
        $req = $bdd->prepare('UPDATE categorie_utilisateur 
        SET nom_categorie_utilisateur=:nom_categorie_utilisateur 
        WHERE id_categorie_utilisateur=:id_categorie_utilisateur')
        $req->execute(array(
            'nom_categorie_utilisateur' => $nom,
            'id_categorie_utilisateur' => $id
        ));



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

}

?>