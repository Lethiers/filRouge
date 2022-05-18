<?php


// class Balance{
//         /*------------------------------- 
//                         ATTRIBUTS
//                 -------------------------------*/
//         public $isPositive;
//         /*------------------------------- 
//                         CONSTRUCTEUR
//                 -------------------------------*/
//         public function __constructor($isPositive){
//         $this->isPositive = $isPositive;
//         }
//         /*------------------------------- 
//                         SETTER ET GETTEUR
//                 -------------------------------*/
//         public function getIsPositive():bool{
//                 return $this->isPositive;
//         }
//         public function setIsPositive($isPositive):void{
//                 $this->isPositive = $isPositive;
//         }
//         /*------------------------------- 
//                         METHODES
//                 -------------------------------*/

//         // fonction pour determiner si l'operation est posiitive ou négative
//         public function createIsPositive($bdd):void{
//                 try {
//                         $req = $bdd->prepare('INSERT INTO balance(isPositive) VALUES(:isPositive)');
//                         $req->execute(array(
//                                 ':isPositive' =>$this->isPositive()
//                         ));
//                 } catch (Exception $e) {
//                         die('Erreur :' .$e->getMessage());
//                 }
//         }

//         // fonction pour modifier l'opération si elle est positive ou négative
//         public function modifyIsPositive($bdd,$id):void{
//                 try {
//                         $req= $bdd->prepare('UPDATE balance SET isPositive=:isPositive WHERE id_balance=:id_balance');
//                         $req->execute(array(
//                                 'id_balance' => $id,
//                                 'isPositive'=>getIsPositive()
//                         ));
//                 } catch (Exception $e) {
//                         die('Erreur :' .$e->getMessage());
//                 }
//         }

//         // fonction pour voir toutes les balance
//         public function showAllIsPositive($bdd){
//                 try {
//                         $req = $bdd->prepare('SELECT * FROM balance');
//                         $req->execute();
//                         $data = $req->fetchAll(PDO::FETCH_ASSOC);
//                         return $data;
//                 } catch (Exception $e) {
//                         die('Erreur :' .$e->getMessage());
//                 }
//         }


// }

?>