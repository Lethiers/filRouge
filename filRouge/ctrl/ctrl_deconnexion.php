<?php
session_destroy();
if(isset($_COOKIE['PHPSESSID'])){
    unset($_COOKIE['PHPSESSID']);
}
header('Location:/filRouge/acceuil');
?>