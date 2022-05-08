<?php

class Avoir{
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


    public function getBudget():float{
        return $this->budget;
    }
    public function setBudget($budget):void{
        $this->budget = $budget;
    }


    // METHODES

    // methode pour ajouter un budget entre diagramme et categorie total
public function addAvoir($bdd):void{
    try {
        $req=$bdd->prepare('INSERT INTO avoir (id_diagramme,id_categorie_global,budget)
        VALUES(:id_diagramme,:id_categorie_global,:budget)');
        $req->execute(array(
            'id_diagramme' => $this->getIdDiag(),
            'id_categorie_global' => $this->getIdCat(),
            'budget' => $this->getBudget()
        ));
    } catch (Exception $e) {
        die('Erreur :' .$e->getMessage());
    }
}

    // methode pour afficher tout les budget
public function showAllAvoir($bdd):array{
    try {
        $req=$bdd->prepare('SELECT * FROM avoir');
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch (Exception $e) {
        die('Erreur :' .$e->getMessage());
    }
}
// methode pour afficher tout les budget par id diag
public function showAllAvoirByDiag($bdd,$id):array{
    try {
        $req=$bdd->prepare('SELECT * FROM avoir WHERE id_diagramme=:id_diagramme');
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
public function showAllAvoirByCatUtil($bdd,$id):array{
    try {
        $req=$bdd->prepare('SELECT * FROM avoir WHERE id_categorie_global=:id_categorie_global');
        $req->execute(array(
            'id_categorie_global'=> $id
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
        
        $req = $bdd->prepare('DELETE FROM avoir WHERE id_categorie_global=:id_categorie_global');
        $req->execute(array(
            'id_categorie_global' =>$id
        ));

    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}


// methode de supression par id diagramme
public function deleteDiagramme($bdd,$id_diagramme):void{
    try {
        
        $req = $bdd->prepare('DELETE FROM avoir WHERE id_diagramme=:id_diagramme');
        $req->execute(array(
            'id_diagramme' =>$id
        ));

    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}


// methode pour modifier
public function modifyAvoir($bdd):void{
    try {
        $req = $bdd->prepare('UPDATE avoir SET id_diagramme=:id_diagramme,id_categorie_global=:id_categorie_global,budget=:budget
        WHERE id_categorie_global=:id_categorie_global');
        $req->execute(array(
            'id_categorie_global' => $this->getIdCat(),
            'budget' => $this->getBudget(),
            'id_diagramme' => $this->getIdDiag(),

        ));
    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}





}


?>