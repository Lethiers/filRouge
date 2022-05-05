<?php
class Revenu{

    // attributs
    protected $id_revenu;
    protected $nom_revenu;
    protected $montant_revenu;

    // constructor
    public function __constructor($nom_revenu,$montant_revenu){
        $this->nom_revenu = $nom_revenu;
        $this->montant_revenu = $montant_revenu;
    }

    // getteur and setteur

    public function getNom():string{
        return $this->nom_revenu;
    }
    public function setNom($nom_revenu):void{
        $this->nom_revenu = $nom_revenu;
    }


    public function getMontant():string{
        return $this->montant_revenu;
    }
    public function setMontant($montant_revenu):void{
        $this->montant_revenu = $montant_revenu;
    }


    // methodes ------------------------------------------

    // fonction pour ajouter un revenu
    function addRevenu($bdd){
        $req = $bdd->prepare('INSERT INTO revenu(nom_revenu,montant_revenu)
        VALUES (:nom_revenu,:montant_revenu )');
        $req->execute(array(
            ':nom_revenu' => $this->getNom(),
            ':montant_revenu' => $this->getMontant(),
        ));
    }

    // fonction pour modifier un revenu
    function modifyRevenu($bdd,$id){
        $req = $bdd->prepare('UPDATE revenu SET nom_revenu=:nom_revenu, montant_revenu=:montant_revenu
        WHERE id_revenu =:id_revenu');
        $req->execute(array(
            ':nom_revenu' => $this->getNom(),
            ':montant_revenu' => $this->getMontant(),
            ':id_revenu' => $id,
        ));
    }

    // fonction pour supprimer un revenu
    function deleteRevenu($bdd,$id){
        $req = $bdd->prepare('DELETE FROM revenu WHERE id_revenu=:id_revenu');
        $req->execute(array(
            ':id_revenu' => $id,
        ));
    }

    // fonction pour voir les revenus
    function showAllRevenu($bdd){
        $req = $bdd->prepare('SELECT * FROM revenu');
        $req->execute();
        $data = $req->fetchAll(PDO:: FETCH_OBJ);
        return $data;
    }

    // fonction pour voir un revenu
    function showRevenu($bdd,$id){
        $req = $bdd->prepare('SELECT * FROM revenu WHERE id_revenu=:id_revenu');
        $req->execute(array(
            ':id_revenu' => $id
        ));
        $data = $req->fetchAll(PDO:: FETCH_OBJ);
        return $data;
    }

}



?>