<?php
// importation bdd
include './utils/connectBdd.php';
// importation model
include './model/model_utilisateur.php';
include './model/model_operation.php';
// ------- importation des view -----
include './view/view_compte.php';

$utilisateur = new Utilisateur();
$util = $utilisateur->showUser($bdd,$_SESSION['id']);

echo '<input type="text" name="nom_util" value='.$util[0]->nom_util.'><br>';
echo '<input type="text" name="prenom_util" value='.$util[0]->prenom_util.'><br>';
echo '<input type="text" name="pseudo_util" value='.$util[0]->pseudo_util.'><br>';
echo '<input type="text" name="email_util" value='.$util[0]->email_util.'><br>';
echo '<input type="submit" value="modifier" id="bouton">';

// formulaire pour modifier l'utilisateur
if (isset($_POST['nom_util']) && !empty($_POST['nom_util']) &&
isset($_POST['prenom_util']) && !empty($_POST['prenom_util']) &&
isset($_POST['pseudo_util']) && !empty($_POST['pseudo_util']) &&
isset($_POST['email_util']) && !empty($_POST['email_util'])) {
    
    $utilisateur->setPrenom($_POST['prenom_util']);
    $utilisateur->setNom($_POST['nom_util']);
    $utilisateur->setPseudo($_POST['pseudo_util']);
    $utilisateur->setEmail($_POST['email_util']);
    $utilisateur->modifyUser($bdd,$_SESSION['id']);
    
}
echo '</form>';
echo '</div>';



// div pour afficher les dépense en cours
$tabloOpTotalPos = [];
$tabloOpTotalNeg = [];

$operation = new Operation();
$tabloOperation = $operation->showAllOperationByIdUtil($bdd,$_SESSION['id']);
// var_dump($tabloOperation);
foreach($tabloOperation as $value){
    if ($value->montant_operation > 0) {
        array_push($tabloOpTotalPos,$value->montant_operation);
    }
    if ($value->montant_operation < 0) {
        array_push($tabloOpTotalNeg,$value->montant_operation);
    }
}
$operationPos = array_sum($tabloOpTotalPos);
$operationNeg = array_sum($tabloOpTotalNeg);
$total = $operationNeg + $operationPos;

echo '<div class="compte">';
if ($total<0) {
    echo '<img src="./asset/image/licorneStop.png" alt="">';
    echo '<p>Attention à votre compte !<p>';    
}else {
    echo '<img src="./asset/image/licorneContent.png" alt="">';
    echo '<p>Super vous êtes actuellement en positif !<p>';    
}
echo '<p>vous avez actuellement gagné '.$operationPos.'€ et dépensé '.$operationNeg.'€<p>';
// j'arrive à sortir un tablo pos et negatif
echo '</div>';


echo '</div>';
?>