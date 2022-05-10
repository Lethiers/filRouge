<?php

class Diagramme{

// attribut 
protected $nom_diag;
protected $id_util;
protected $id_frequence;

// constructor

public function __constructor($nom_diag,$id_util,$id_frequence){
    $this->nom_diag = $nom_diag;
    $this->id_util = $id_util;
    $this->id_frequence = $id_frequence;
}

// getteur and setteur

public function getNom():string{
    return $this->nom_diag;
}
public function setNom($nom_diag):void{
    $this->nom_diag = $nom_diag;
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

// fonction pour créer un diagramme TEST OK
public function addDiagramme($bdd){
    $req = $bdd->prepare('INSERT INTO diagramme(nom_diagramme,id_util,id_frequence)
    VALUES (:nom_diagramme,:id_util,:id_frequence)');
    $req->execute(array(
        ':nom_diagramme' => $this->getNom(),
        ':id_util' => $this->getIdUtil(),
        ':id_frequence' => $this->getIdFrequence(),
    ));
}


// fonction pour voir les diagrammes TEST OK
public function showAllDiagramme($bdd){
    $req = $bdd->prepare('SELECT * FROM diagramme');
    $req->execute();
    $data = $req->fetchAll(PDO:: FETCH_OBJ);
    return $data;
}

// fonction pour afficher tout les diagrammes par id_util
public function showDiagrammeById($bdd,$idUtil){
    try {
        $req =  $bdd->prepare('SELECT * FROM diagramme WHERE id_util=:id_util');
        $req->execute(array(
            'id_util' => $idUtil,
        ));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch (Exception $e) {
        die('Erreur :' .$e->getMessage());
    }
}

// fonction pour voir un diagramme TEST OK
public function showDiagramme($bdd,$id){
    $req = $bdd->prepare('SELECT * FROM diagramme WHERE id_diagramme =:id_diagramme');
    $req->execute(array(
        'id_diagramme' => $id
    ));
    $data = $req->fetchAll(PDO:: FETCH_OBJ);
    return $data;
}

// fonction pour modifier un diagramme OK MAIS VA FALLOIR RAJOUTER LES CATEGORES
public function modifyDiagramme($bdd,$id){
    $req = $bdd->prepare('UPDATE diagramme SET nom_diagramme=:nom_diagramme
    WHERE id_diagramme =:id_diagramme');
    $req->execute(array(
        ':nom_diagramme' => $this->getNom(),
        ':id_diagramme' => $id,
    ));
}

// fonction pour supprimer un diagramme TEST OK
public function deleteDiagramme($bdd,$id){
    $req = $bdd->prepare('DELETE FROM diagramme WHERE id_diagramme=:id_diagramme');
    $req->execute(array(
        ':id_diagramme' => $id,
    ));
}

}


?>