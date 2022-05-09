<?php

class CategoriGlobal{

/*------------------------------- 
                    ATTRIBUTS
        -------------------------------*/

private $nom_categorie_global;

/*------------------------------- 
                    CONSTRUCTEUR
        -------------------------------*/
public function __constructor($nom_categorie_global){
    $this->nom = $nom_categorie_global;
}
/*------------------------------- 
                    SETTER ET GETTEUR
        -------------------------------*/

public function getNom():string{
    return $this->nom_categorie_global;
}
public function setNom($nom_categorie_global):void{
    $this->nom_categorie_global = $nom_categorie_global;
}

/*------------------------------- 
                    METHODES
        -------------------------------*/
// fonction pour créer une catégorie utilisateur OK FONCTIONNE
public function addCategorieUtil($bdd):void{
    try {
        
        $req = $bdd->prepare('INSERT INTO categorie_global(nom_categorie_global)
        VALUES (:nom_categorie_global)');
        $req->execute(array(
            ':nom_categorie_global' => $this->getNom(),
        ));

    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour afficher toute les categories global
public function showAllCategorieGlobal($bdd):array{
    try {
        
        $req = $bdd->prepare('SELECT * FROM categorie_global');
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour voir une catégorie global
public function showCategorieGlobal($bdd,$id):array{
    try {
        
        $req = $bdd->prepare('SELECT * FROM categorie_global WHERE id_categorie_global=:id_categorie_global');
        $req->execute(array(
            'id_categorie_global' => $id
        ));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour voir une catégorie global TABLO ASSOC
public function showCategorieGlobalTablo($bdd):array{
    try {
        
        $req = $bdd->prepare('SELECT * FROM categorie_global');
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// supprimer une catégorie global
public function deleteCategorieGlobal($bdd,$id):void{
    try {
        
        $req = $bdd->prepare('DELETE FROM categorie_global WHERE id_categorie_global=:id_categorie_global');
        $req->execute(array(
            'id_categorie_global' =>$id
        ));




    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour modifier une catégorie global
public function modifyCatGlobal($bdd,$id,$nom){
    try {
        $req = $bdd->prepare('UPDATE categorie_global 
        SET nom_categorie_global=:nom_categorie_global 
        WHERE id_categorie_global=:id_categorie_global');
        $req->execute(array(
            'nom_categorie_global' => $nom,
            'id_categorie_global' => $id
        ));



    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

}

?>