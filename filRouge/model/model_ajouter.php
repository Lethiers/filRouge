<?php

class Ajouter{
    // attribut
    private $idDiag;
    private $idCat;
    private $budget;

    // constructor
    public function __constructor($idDiag,$idCat,$budget){
        $this->idDiag = $budget;
        $this->idCat = $idCat;
        $this->budget = $budget;
    }

/*------------------------------- 
                    SETTER ET GETTEUR
        -------------------------------*/

    public function getIdDiag():int{
        return $this->idDiag;
    }
    public function setIdDiag($idDiag):void{
        $this->idDiag = $idDiag;
    }


    public function getIdCat():int{
        return $this->idCat;
    }
    public function setIdCat($idCat):void{
        $this->idCat = $idCat;
    }


    public function getBudget():string{
        return $this->budget;
    }
    public function setBudget($budget):void{
        $this->budget = $budget;
    }


    // METHODES

    // methode pour ajouter un budget entre diagramme et categorie total
public function addAjouter($bdd):void{
    try {
        $req=$bdd->prepare('INSERT INTO ajouter (id_diagramme,id_categorie_utilisateur,budget)
        VALUES(:id_diagramme,:id_categorie_utilisateur,:budget)');
        $req->execute(array(
            'id_diagramme' => $this->getIdDiag(),
            'id_categorie_utilisateur' => $this->getIdCat(),
            'budget' => $this->getBudget()
        ));
    } catch (Exception $e) {
        die('Erreur :' .$e->getMessage());
    }
}

    // methode pour afficher tout les budget
public function showAllAjouter($bdd):array{
    try {
        $req=$bdd->prepare('SELECT * FROM ajouter');
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch (Exception $e) {
        die('Erreur :' .$e->getMessage());
    }
}
// methode pour afficher tout les budget par id diag
public function showAllAjouterByDiag($bdd,$id):array{
    try {
        $req=$bdd->prepare('SELECT * FROM ajouter WHERE id_diagramme=:id_diagramme');
        $req->execute(array(
            'id_diagramme'=> $id
        ));

        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch (Exception $e) {
        die('Erreur :' .$e->getMessage());
    }
}

// methode pour afficher tout les budget par id cat util
public function showAllAjouterByCatUtil($bdd,$id):array{
    try {
        $req=$bdd->prepare('SELECT * FROM ajouter WHERE id_categorie_utilisateur=:id_categorie_utilisateur');
        $req->execute(array(
            'id_categorie_utilisateur'=> $id
        ));

        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch (Exception $e) {
        die('Erreur :' .$e->getMessage());
    }
}

// methode de supression par id cat util
public function deleteIdCat($bdd,$id_diagramme):void{
    try {
        
        $req = $bdd->prepare('DELETE FROM ajouter WHERE id_categorie_utilisateur=:id_categorie_utilisateur');
        $req->execute(array(
            'id_categorie_utilisateur' =>$id
        ));

    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}


// methode de supression par id diagramme
public function deleteDiagramme($bdd,$id_diagramme):void{
    try {
        
        $req = $bdd->prepare('DELETE FROM ajouter WHERE id_diagramme=:id_diagramme');
        $req->execute(array(
            'id_diagramme' =>$id
        ));

    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}


// methode pour modifier
public function modifyAjouter($bdd):void{
    try {
        $req = $bdd->prepare('UPDATE ajouter SET budget=:budget WHERE id_categorie_utilisateur=:id_categorie_utilisateur AND id_diagramme=:id_diagramme');
        $req->execute(array(
            'id_categorie_utilisateur' => $this->getIdCat(),
            'budget' => $this->getBudget(),
            'id_diagramme' => $this->getIdDiag(),

        ));
    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// methode pour supprimer par id cat et id diagramme
public function deleteAjouterIdCatIdDiag($bdd,$idCat,$idDiag):void{
    try {
        $req=$bdd->prepare('DELETE FROM ajouter WHERE id_categorie_utilisateur=:id_categorie_utilisateur AND id_diagramme=:id_diagramme');
        $req->execute(array(
            'id_categorie_utilisateur'=> $idCat,
            'id_diagramme'=> $idDiag
        ));

    } catch (Exception $e) {
        die('Erreur :' .$e->getMessage());
    }
}

// methode pour afficher un budget par id cat et id diagramme
public function showAjouterIdCatIdDiag($bdd,$idCat,$idDiag):array{
    try {
        $req=$bdd->prepare('SELECT * FROM ajouter WHERE id_categorie_utilisateur=:id_categorie_utilisateur AND id_diagramme=:id_diagramme ');
        $req->execute(array(
            'id_categorie_utilisateur'=> $idCat,
            'id_diagramme'=> $idDiag
        ));

        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch (Exception $e) {
        die('Erreur :' .$e->getMessage());
    }
}


// test inner join avec la table diagramme
public function innerJoinDiagramme($bdd,$idDiag):array{
    try {
        $req=$bdd->prepare();
        $req->execute(array(
            'id_diagramme' => $idDiag,
        ));
    } catch (Exception $e) {
        die('Erreur :' .$e->getMessage());
    }
}



}


?>