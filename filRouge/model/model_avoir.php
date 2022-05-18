<?php

class Avoir{
    // attribut
    private $idprevision;
    private $idCat;
    private $budget;

    // constructor
    public function __constructor($idprevision,$idCat,$budget){
        $this->idprevision = $budget;
        $this->idCat = $idCat;
        $this->budget = $budget;
    }

/*------------------------------- 
                    SETTER ET GETTEUR
        -------------------------------*/

    public function getIdprevision():int{
        return $this->idprevision;
    }
    public function setIdprevision($idprevision):void{
        $this->idprevision = $idprevision;
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

    // methode pour ajouter un budget entre prevision et categorie total
    public function addAvoir($bdd):void{
        try {
            $req=$bdd->prepare('INSERT INTO avoir (id_prevision,id_categorie_global,budget)
            VALUES(:id_prevision,:id_categorie_global,:budget)');
            $req->execute(array(
                'id_prevision' => $this->getIdprevision(),
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
    // methode pour afficher tout les budget par id prevision
    public function showAllAvoirByprevision($bdd,$id):array{
        try {
            $req=$bdd->prepare('SELECT * FROM avoir WHERE id_prevision=:id_prevision');
            $req->execute(array(
                'id_prevision'=> $id
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
    public function deleteIdCat($bdd,$id_prevision):void{
        try {
            
            $req = $bdd->prepare('DELETE FROM avoir WHERE id_categorie_global=:id_categorie_global');
            $req->execute(array(
                'id_categorie_global' =>$id
            ));

        } catch (Exception $e) {
            die ('Erreur :' .$e->getMessage());
        }
    }


    // methode de supression par id prevision
    public function deletePrevision($bdd,$id_prevision):void{
        try {
            
            $req = $bdd->prepare('DELETE FROM avoir WHERE id_prevision=:id_prevision');
            $req->execute(array(
                'id_prevision' =>$id
            ));

        } catch (Exception $e) {
            die ('Erreur :' .$e->getMessage());
        }
    }


    // methode pour modifier
    public function modifyAvoir($bdd):void{
        try {
            $req = $bdd->prepare('UPDATE avoir SET budget=:budget WHERE id_categorie_global=:id_categorie_global AND id_prevision=:id_prevision');
            $req->execute(array(
                'id_categorie_global' => $this->getIdCat(),
                'budget' => $this->getBudget(),
                'id_prevision' => $this->getIdprevision(),

            ));
        } catch (Exception $e) {
            die ('Erreur :' .$e->getMessage());
        }
    }

    // methode pour afficher un budget par id cat et id prevision
    public function showAvoirIdCatIdPrevision($bdd,$idCat,$idprevision):array{
        try {
            $req=$bdd->prepare('SELECT * FROM avoir WHERE id_categorie_global=:id_categorie_global AND id_prevision=:id_prevision ');
            $req->execute(array(
                'id_categorie_global'=> $idCat,
                'id_prevision'=> $idprevision
            ));

            $data = $req->fetchAll(PDO::FETCH_OBJ);
            return $data;
        } catch (Exception $e) {
            die('Erreur :' .$e->getMessage());
        }
    }

    // methode pour supprimer par id cat et id prevision
    public function deleteAvoirIdCatIdPrevision($bdd,$idCat,$idprevision):void{
        try {
            $req=$bdd->prepare('DELETE FROM avoir WHERE id_categorie_global=:id_categorie_global AND id_prevision=:id_prevision ');
            $req->execute(array(
                'id_categorie_global'=> $idCat,
                'id_prevision'=> $idprevision
            ));

        } catch (Exception $e) {
            die('Erreur :' .$e->getMessage());
        }
    }

    // test inner join avec la table prevision
    public function innerJoinPrevision($bdd,$idprevision):array{
        try {
            $req=$bdd->prepare('SELECT * FROM prevision INNER JOIN avoir WHERE prevision.id_prevision=:id_prevision');
            $req->execute(array(
                'id_prevision' => $idprevision,
            ));
            $data = $req->fetchAll(PDO::FETCH_OBJ);
            return $data;
        } catch (Exception $e) {
            die('Erreur :' .$e->getMessage());
        }
    }



}


?>