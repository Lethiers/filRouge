<?php
    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';
    /*--------------------------ROUTER -----------------------------*/
    //test de la valeur $path dans l'URL et import de la ressource
    switch($path){
        //route / acceuil
        case $path === "/filRouge/acceuil" : 
            include './ctrl/ctrl_acceuil.php';
        break ;

        //route / compte
        case $path === "/filRouge/compte":
            include './ctrl/ctrl_compte.php';
		break ;
        //route / connexion
        case $path === "/filRouge/connexion":
            include './ctrl/ctrl_connexion.php';
		break ;
        //route / inscription
        case $path === "/filRouge/inscription":
            include './ctrl/ctrl_inscription.php';
		break ;

        //route / operation
        case $path === "/filRouge/operation":
            include './ctrl/ctrl_operation.php';
		break ;
        //route / operation
        case $path === "/filRouge/supprimerOperation":
            include './ctrl/ctrl_suppressionOperation.php';
		break ;
        //route / operation
        case $path === "/filRouge/modifierOperation":
            include './ctrl/ctrl_modifierOperation.php';
		break ;
        // route / deconnexion
        case $path === "/filRouge/deconnexion":
            include './ctrl/ctrl_deconnexion.php';
		break ;
        // route / contacter
        case $path === "/filRouge/contact":
            include './ctrl/ctrl_contact.php';
		break ;

        // route / diagramme
        case $path === "/filRouge/diagramme":
            include './ctrl/ctrl_new_diagramme.php';
		break ;

        // route / diagramme
        case $path === "/filRouge/modifyDiagramme":
            include './ctrl/ctrl_modify_diagramme.php';


        // route / diagramme
        case $path === "/filRouge/admin":
            include './ctrl/ctrl_admin.php';


        // route / diagramme
        case $path === "/filRouge/deleteDiagrammeGlobal":
            include './ctrl/ctrl_delete_diagramme_global.php';


        // route / diagramme
        case $path === "/filRouge/updateDiagrammeGlobal":
            include './ctrl/ctrl_update_diagramme_global.php';


        // route / diagramme
        case $path === "/filRouge/deleteCategorieUtilisateur":
            include './ctrl/ctrl_delete_cat_util.php';


        // route / diagramme
        case $path === "/filRouge/updateCategorieUtilisateur":
            include './ctrl/ctrl_update_cat_util.php';

        // route / diagramme
        case $path === "/filRouge/categorieUtilisateur":
            include './ctrl/ctrl_cat_util.php';


		break ;
    }
?>
