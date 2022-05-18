<?php


class Operation{

/*------------------------------- 
                    ATTRIBUTS
        -------------------------------*/

private $date;
private $montant;
private $nom;
private $idCatGlobal;
private $idCatUtil;

/*------------------------------- 
                    CONSTRUCTEUR
        -------------------------------*/

public function __constructor($date,$montant,$nom,$idCatGlobal,$idCatUtil){
    $this->date = $date;
    $this->montant= $montant;
    $this->nom= $nom;
    $this->idCatGlobal= $idCatGlobal;
    $this->idCatUtil= $idCatUtil;
}

/*------------------------------- 
                    SETTER ET GETTEUR
        -------------------------------*/
public function getDate():string{
    return $this->date_operation;
}
public function setDate($date):void{
    $this->date_operation = $date;
}

public function getMontant():float{
    return $this->montant_operation;
}
public function setMontant($montant):void{
    $this->montant_operation = $montant;
}
public function getNom():string{
    return $this->nom_operation;
}
public function setNom($montant):void{
    $this->nom_operation = $montant;
}

public function getidCatGlobal():string{
    return $this->idCatGlobal;
}
public function setidCatGlobal($idCatGlobal):void{
    $this->idCatGlobal = $idCatGlobal;
}

public function getidCatUtil(){
    return $this->idCatUtil;
}
public function setidCatUtil($idCatUtil):void{
    $this->idCatUtil = $idCatUtil;
}

/*------------------------------- 
                    METHODES
        -------------------------------*/


// fonction pour ajouter une depense        
public function addOperation($bdd,$id):void{

    try {
        $req = $bdd->prepare('INSERT INTO operation(date_operation,montant_operation,nom_operation,id_categorie_global,id_categorie_utilisateur,id_util)
        VALUES(:date_operation,:montant_operation,:nom_operation,:id_categorie_global,:id_categorie_utilisateur,:id_util)');
        $req->execute(array(
            ':date_operation' => $this->getDate(),
            ':montant_operation' => $this->getMontant(),
            ':nom_operation' => $this->getNom(),
            ':id_categorie_global' => $this->getidCatGlobal(),
            ':id_categorie_utilisateur' => $this->getidCatUtil(),
            ':id_util' => $id
        ));
    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}


// fonction pour aficher toute les par date
public function showAllOperationByDate($bdd,$date,$idUtil):array{
    try {
        
        $req = $bdd->prepare('SELECT * FROM operation WHERE date_operation>=:date_operation and id_util=:id_util');
        $req->execute(array(
            'date_operation' => $date,
            'id_util' => $idUtil
        ));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;

    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}


// fonction pour aficher toute les depenses
public function showAllOperation($bdd):array{
    try {
        $req = $bdd->prepare('SELECT * FROM operation');
        $req->execute();
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
        
    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour aficher toute les depenses d'un utilisateur
public function showAllOperationByIdUtil($bdd,$id):array{
    try {
        
        $req = $bdd->prepare('SELECT * FROM operation WHERE id_util=:id_util');
        $req->execute(array(
            'id_util' => $id,
        ));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;

    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

public function showOperation($bdd,$id):array{
    try {
        $req = $bdd->prepare('SELECT * FROM operation WHERE id_operation = :id_operation');
        $req->execute(array(
            'id_operation' =>$id
        ));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
        
    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}
public function deleteOperation($bdd,$id):void{
    try {
        $req = $bdd->prepare('DELETE FROM operation WHERE id_operation = :id_operation');
        $req->execute(array(
            'id_operation' =>$id
        ));

        }
    catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}



public function modifyOperation($bdd,$id):void{
    try {
        $req = $bdd->prepare('UPDATE operation SET nom_operation=:nom_operation,
        date_operation=:date_operation, montant_operation= :montant_operation,id_categorie_utilisateur=:id_categorie_utilisateur,
        id_categorie_global=:id_categorie_global WHERE id_operation = :id_operation');
        $req->execute(array(
            'id_operation' =>$id,
            ':date_operation' => $this->getDate(),
            ':montant_operation' => $this->getMontant(),
            ':nom_operation' => $this->getNom(),
            ':id_categorie_global' => $this->getidCatGlobal(),
            ':id_categorie_utilisateur' => $this->getidCatUtil()
        ));


        }
    catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}


























}


?>