<?php

class Diagramme{

// attribut 
protected $nom_diag;

// constructor

public function __constructor($nom_diag){
    $this->nom_diag = $nom_diag;
}

// getteur and setteur

public function getNom():string{
    return $this->nom_diag;
}
public function setNom($nom_diag):void{
    $this->nom_diag = $nom_diag;
}


// methodes

// fonction pour créer un diagramme
public function addDiagramme($bdd){
    $req = $bdd->prepare('INSERT INTO diagramme(nom_diagramme)
    VALUES (:nom_diagramme)');
    $req->execute(array(
        ':nom_diagramme' => $this->getNom(),
    ));
}


// fonction pour voir les diagrammes
public function showAllDiagramme($bdd){
    $req = $bdd->prepare('SELECT * FROM diagramme');
    $req->execute();
    $data = $req->fetchAll(PDO:: FETCH_OBJ);
    return $data;
}

// fonction pour voir un diagramme
public function showDiagramme($bdd,$id){
    $req = $bdd->prepare('SELECT * FROM diagramme WHERE id_diagramme =:id_diagramme');
    $req->execute(array(
        'id_diagramme' => $id
    ));
    $data = $req->fetchAll(PDO:: FETCH_OBJ);
    return $data;
}

// fonction pour modifier un diagramme
public function modifyDiagramme($bdd,$id){
    $req = $bdd->prepare('UPDATE diagramme SET nom_diagramme=:nom_diagramme
    WHERE id_diagramme =:id_diagramme');
    $req->execute(array(
        ':nom_diagramme' => $this->getNom(),
        ':id_diagramme' => $id,
    ));
}

// fonction pour supprimer un diagramme
public function deleteDiagramme($bdd,$id){
    $req = $bdd->prepare('DELETE FROM diagramme WHERE id_diagramme=:id_diagramme');
    $req->execute(array(
        ':id_diagramme' => $id,
    ));
}

}


?>