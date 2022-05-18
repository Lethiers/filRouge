<?php

class prevision{

    // attribut 
    protected $nom_prevision;
    protected $budget_prevision;
    protected $id_util;
    protected $id_frequence;
    
    // constructor
    public function __constructor($nom_prevision,$budget_prevision,$id_util,$id_frequence){
        $this->nom_prevision = $nom_prevision;
        $this->nom_prevision = $budget_prevision;
        $this->id_util = $id_util;
        $this->id_frequence = $id_frequence;
    }

    // getteur and setteur

    public function getNom():string{
        return $this->nom_prevision;
    }
    public function setNom($nom_prevision):void{
        $this->nom_prevision = $nom_prevision;
    }


    public function getBudget():string{
        return $this->budget_prevision;
    }
    public function setBudget($budget_prevision):void{
        $this->budget_prevision = $budget_prevision;
    }


    public function getIdFrequence():string{
        return $this->id_frequence;
    }
    public function setIdFrequence($id_frequence):void{
        $this->id_frequence = $id_frequence;
    }

    public function getIdUtil():string{
        return $this->id_util;
    }
    public function setIdUtil($id_util):void{
        $this->id_util = $id_util;
    }


    // methodes

    // fonction pour créer un prevision TEST OK
    public function addprevision($bdd){
        $req = $bdd->prepare('INSERT INTO prevision(nom_prevision,budget_prevision,id_util,id_frequence)
        VALUES (:nom_prevision,:budget_prevision,:id_util,:id_frequence)');
        $req->execute(array(
            ':nom_prevision' => $this->getNom(),
            'budget_prevision' => $this->getBudget(),
            ':id_util' => $this->getIdUtil(),
            ':id_frequence' => $this->getIdFrequence()
            
        ));
    }


    // fonction pour voir les previsions TEST OK
    public function showAllprevision($bdd){
        $req = $bdd->prepare('SELECT * FROM prevision');
        $req->execute();
        $data = $req->fetchAll(PDO:: FETCH_OBJ);
        return $data;
    }

    // fonction pour afficher tout les previsions par id_util
    public function showprevisionById($bdd,$idUtil){
        try {
            $req =  $bdd->prepare('SELECT * FROM prevision WHERE id_util=:id_util');
            $req->execute(array(
                'id_util' => $idUtil,
            ));
            $data = $req->fetchAll(PDO::FETCH_OBJ);
            return $data;
        } catch (Exception $e) {
            die('Erreur :' .$e->getMessage());
        }
    }

    // fonction pour voir un prevision TEST OK
    public function showprevision($bdd,$id){
        $req = $bdd->prepare('SELECT * FROM prevision WHERE id_prevision =:id_prevision');
        $req->execute(array(
            'id_prevision' => $id
        ));
        $data = $req->fetchAll(PDO:: FETCH_OBJ);
        return $data;
    }

    // fonction pour modifier un prevision OK MAIS VA FALLOIR RAJOUTER LES CATEGORES
    public function modifyprevision($bdd,$id){
        $req = $bdd->prepare('UPDATE prevision SET nom_prevision=:nom_prevision
        WHERE id_prevision =:id_prevision');
        $req->execute(array(
            ':nom_prevision' => $this->getNom(),
            ':id_prevision' => $id,
        ));
    }

    // fonction pour supprimer un prevision TEST OK
    public function deleteprevision($bdd,$id){
        $req = $bdd->prepare('DELETE FROM prevision WHERE id_prevision=:id_prevision');
        $req->execute(array(
            ':id_prevision' => $id,
        ));
    }

}


?>