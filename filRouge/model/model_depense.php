<?php
class Depense{

    // attributs
    protected $id_depense;
    protected $nom_depense;
    protected $montant_depense;

    // constructor
    public function __constructor($nom_depense,$montant_depense){
        $this->nom_depense = $nom_depense;
        $this->montant_depense = $montant_depense;
    }

    // getteur and setteur

    public function getNom():string{
        return $this->nom_depense;
    }
    public function setNom($nom_depense):void{
        $this->nom_depense = $nom_depense;
    }


    public function getMontant():string{
        return $this->montant_depense;
    }
    public function setMontant($montant_depense):void{
        $this->montant_depense = $montant_depense;
    }


    // methodes ------------------------------------------

    // fonction pour ajouter un revenu
    function addDepense($bdd){
        $req = $bdd->prepare('INSERT INTO depense(nom_depense,montant_depense)
        VALUES (:nom_depense,:montant_depense )');
        $req->execute(array(
            ':nom_depense' => $this->getNom(),
            ':montant_depense' => $this->getMontant(),
        ));
    }

    // fonction pour modifier un revenu
    function modifyDepense($bdd,$id){
        $req = $bdd->prepare('UPDATE depense SET nom_depense=:nom_depense, montant_depense=:montant_depense
        WHERE id_depense =:id_depense');
        $req->execute(array(
            ':nom_depense' => $this->getNom(),
            ':montant_depense' => $this->getMontant(),
            ':id_depense' => $id,
        ));
    }

    // fonction pour supprimer un revenu
    function deleteDepense($bdd,$id){
        $req = $bdd->prepare('DELETE FROM depense WHERE id_depense=:id_depense');
        $req->execute(array(
            ':id_depense' => $id,
        ));
    }

    // fonction pour voir les revenus
    function showAllDepense($bdd){
        $req = $bdd->prepare('SELECT * FROM depense');
        $req->execute();
        $data = $req->fetchAll(PDO:: FETCH_OBJ);
        return $data;
    }

    // fonction pour voir un revenu
    function showDepsne($bdd,$id){
        $req = $bdd->prepare('SELECT * FROM depense WHERE id_depense=:id_depense');
        $req->execute(array(
            ':id_depense' => $id
        ));
        $data = $req->fetchAll(PDO:: FETCH_OBJ);
        return $data;
    }

}



?>