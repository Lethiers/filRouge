<?php

class CategoriUtil{

/*------------------------------- 
                    ATTRIBUTS
        -------------------------------*/

private $nom_categorie_utilisateur;
private $id_util;
private $id_categorie_global;

/*------------------------------- 
                    CONSTRUCTEUR
        -------------------------------*/
public function __constructor($nom_categorie_utilisateur,$id_util,$id_categorie_global){
    $this->nom_categorie_utilisateur = $nom_categorie_utilisateur;
    $this->id_util = $id_util;
    $this->id_categorie_global = $id_categorie_global;
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

public function getIdUtil():int{
    return $this->id_util;
}
public function setIdUtil($id_util):void{
    $this->id_util = $id_util;
}

public function getCatGlobal():int{
    return $this->id_categorie_global;
}
public function setCatGlobal($id_categorie_global):void{
    $this->id_categorie_global = $id_categorie_global;
}


/*------------------------------- 
                    METHODES
        -------------------------------*/
// fonction pour créer une catégorie utilisateur
public function addCategorieUtil($bdd):void{
    try {
        
        $req = $bdd->prepare('INSERT INTO categorie_utilisateur(nom_categorie_utilisateur,id_util,id_categorie_global)
        VALUES (:nom_categorie_utilisateur,:id_util,:id_categorie_global)');
        $req->execute(array(
            ':nom_categorie_utilisateur' => $this->getNom(),
            ':id_util' => $this->getIdUtil(),
            ':id_categorie_global' => $this->getCatGlobal()
        ));



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour afficher toute les categories utilisateur
public function showAllCategorieUtil($bdd):array{
    try {
        
        $req = $bdd->prepare('SELECT * FROM categorie_utilisateur');
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour voir une catégorie UTIL TABLO ASSOC
public function showCategorieUtilTablo($bdd,$id):array{
    try {
        
        $req = $bdd->prepare('SELECT * FROM categorie_utilisateur WHERE id_util=:id_util');
        $req->execute(array(
            'id_util' => $id
        ));
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour voir une catégorie utilisateur par utilisateur
public function showCategorieUtil($bdd,$id):array{
    try {
        
        $req = $bdd->prepare('SELECT * FROM categorie_utilisateur WHERE id_util=:id_util');
        $req->execute(array(
            'id_util' =>$id
        ));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour voir une catégorie utilisateur par utilisateur
public function showCategorieUtilById($bdd,$id):array{
    try {
        
        $req = $bdd->prepare('SELECT * FROM categorie_utilisateur WHERE id_categorie_utilisateur=:id_categorie_utilisateur');
        $req->execute(array(
            'id_categorie_utilisateur' =>$id
        ));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// supprimer une catégorie utilisateur
public function deleteCategorieUtil($bdd,$id):void{
    try {
        
        $req = $bdd->prepare('DELETE FROM categorie_utilisateur WHERE id_categorie_utilisateur=:id_categorie_utilisateur');
        $req->execute(array(
            'id_categorie_utilisateur' =>$id
        ));
        




    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour modifier une catégorie utilisateur
public function modifyCatUtil($bdd,$id){
    try {
        $req = $bdd->prepare('UPDATE categorie_utilisateur SET nom_categorie_utilisateur=:nom_categorie_utilisateur, 
        id_categorie_global=:id_categorie_global, id_util=:id_util WHERE id_categorie_utilisateur=:id_categorie_utilisateur');
        $req->execute(array(
            'nom_categorie_utilisateur' => $this->getNom(),
            'id_categorie_utilisateur' => $id,
            'id_categorie_global' => $this->getCatGlobal(),
            'id_util' => $this->getIdUtil()
        ));



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

}

?>