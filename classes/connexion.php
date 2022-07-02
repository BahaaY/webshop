<?php
    include("mysql.php");
    $bdd = new mysql();
    $bdd->set_serveur("localhost");
    $bdd->set_login("root");
    $bdd->set_mdp("");
    $bdd->set_bdd("SHOP_ONLINE");
    $bdd->connexion();
?>
