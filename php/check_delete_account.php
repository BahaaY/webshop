<?php

    session_start();

    include("classes/user.php");
    include("classes/connexion.php");

    $user = new user($bdd->get_link()); 

    if(isset($_POST['btn_yes'])){
        $uid=$_SESSION['shop_unique_id'];
        $delete=$user->delete_account($uid);
        if($delete==1){
            setcookie('shop_unique_id', '', time() - 3600, '/'); 
            setcookie('shopping_website_email', '', time() - 3600, '/');
            setcookie('shopping_website_password', '', time() - 3600, '/');
            session_destroy(); 
            header("location:Login.php");
            exit();
        }
    }else if(isset($_POST['btn_cancel'])){
        header("location:Settings.php");
    }
?>