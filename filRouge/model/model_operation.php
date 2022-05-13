<?php


class Operation{

/*------------------------------- 
                    ATTRIBUTS
        -------------------------------*/

private $date;
private $montant;
private $nom;
private $idCatGlobal;
private $idBalance;

/*------------------------------- 
                    CONSTRUCTEUR
        -------------------------------*/

public function __constructor($date,$montant,$nom,$idCatGlobal,$idBalance){
    $this->date = $date;
    $this->montant= $montant;
    $this->nom= $nom;
    $this->idCatGlobal= $idCatGlobal;
    $this->idBalance= $idBalance;
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

public function getidBalance():int{
    return $this->idBalance;
}
public function setidBalance($idBalance):void{
    $this->idBalance = $idBalance;
}
/*------------------------------- 
                    METHODES
        -------------------------------*/


// fonction pour ajouter une depense        
public function addOperation($bdd,$id):void{

    try {
        $req = $bdd->prepare('INSERT INTO operation(date_operation,montant_operation,nom_operation,id_categorie_global,id_balance,id_util)
        VALUES(:date_operation,:montant_operation,:nom_operation,:id_categorie_global,:id_balance,:id_util)');
        $req->execute(array(
            ':date_operation' => $this->getDate(),
            ':montant_operation' => $this->getMontant(),
            ':nom_operation' => $this->getNom(),
            ':id_categorie_global' => $this->getidCatGlobal(),
            ':id_balance' => $this->getidBalance(),
            ':id_util' => $id
        ));
    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}


// fonction pour aficher toute les par date
public function showAllOperationByDate($bdd,$date,$idUtil):array{
    echo '<div>';
    echo '<ul>';
    try {
        
        $req = $bdd->prepare('SELECT * FROM operation WHERE date_operation>=:date_operation and id_util=:id_util');
        $req->execute(array(
            'date_operation' => $date,
            'id_util' => $idUtil,
        ));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;

    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}


// fonction pour aficher toute les depenses
public function showAllOperation($bdd):void{
    echo '<div>';
    echo '<ul>';
    try {
        
        $req = $bdd->prepare('SELECT * FROM operation');
        $req->execute();
        while ($data =$req->fetch()) {
            $nom = $data['nom_operation'];
            $date = $data['date_operation'];
            $montant = $data['montant_operation'];
            $id = $data['id_operation'];

            echo '<li>L\'operation '.$nom.'<a href="modifierOperation?id='.$id.'">modifier</a> <a href="supprimerOperation?id='.$id.'">supprimer</a><li>';
            echo '<li>effectuer le '.$date.'<li>';
            echo '<li>pour un montant de '.$montant.'<li>';
        }
        echo '</ul>';
        echo '</div>';
        
    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// fonction pour aficher toute les depenses
public function showAllOperationByIdUtil($bdd,$id):void{
    echo '<div>';
    echo '<ul>';
    try {
        
        $req = $bdd->prepare('SELECT * FROM operation WHERE id_util=:id_util');
        $req->execute(array(
            'id_util' => $id,
        ));
        while ($data =$req->fetch()) {
            $nom = $data['nom_operation'];
            $date = $data['date_operation'];
            $montant = $data['montant_operation'];
            $id = $data['id_operation'];

            echo '<li>L\'operation '.$nom.'<a href="modifierOperation?id='.$id.'">modifier</a> <a href="supprimerOperation?id='.$id.'">supprimer</a><li>';
            echo '<li>effectuer le '.$date.'<li>';
            echo '<li>pour un montant de '.$montant.'<li>';
        }
        echo '</ul>';
        echo '</div>';
        
    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

// retourner operatino selon l'utilisateur en FETCH_OBJ
public function showAllOperationByUtilId($bdd,$id){
    try {
        $req = $bdd->prepare('SELECT * FROM operation WHERE id_util =:id_util');
        $req->execute(array(
            'id_util' =>$id,
        ));
        $data = $req->fetchAll(PDO::FETCH_OBJ);
        return $data;
    } catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

public function showOperation($bdd,$id):void{
    try {
        $req = $bdd->prepare('SELECT * FROM operation WHERE id_operation = :id_operation');
        $req->execute(array(
            'id_operation' =>$id
        ));
        while ($data = $req->fetch()) {
            $nom = $data['nom_operation'];
            $date = $data['date_operation'];
            $montant = $data['montant_operation'];

            echo '<p>nom :</p>';
            echo '<input type="text" name="nom_operation" value="'.$nom.'">';
            echo '<p>date :</p>';
            echo '<input type="text" name="date_operation" value="'.$date.'">';
            echo '<p>montant :</p>';
            echo '<input type="text" name="montant_operation" value="'.$montant.'">';
            echo '<input type="submit" value="modifier">';
            echo '</form>';
            echo '</div>';
        }

        
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



public function modifyOperation($bdd,$id,$nom,$date,$montant,$idCatGlobal,$idBalance):void{
    try {
        $req = $bdd->prepare('UPDATE operation SET nom_operation=:nom_operation,
        date_operation=:date_operation, montant_operation= :montant_operation, id_categorie_global=:id_categorie_global,id_balance=:id_balance WHERE id_operation = :id_operation');
        $req->execute(array(
            'nom_operation'=> $nom,
            'date_operation'=> $date,
            'montant_operation'=> $montant,
            'id_operation' =>$id,
            ':id_categorie_global' => $idCatGlobal,
            ':id_balance' => $idBalance
        ));


        }
    catch (Exception $e) {
        die ('Erreur :' .$e->getMessage());
    }
}

}


?>