<?php  
    
    session_start();

    if(isset($_POST['btn_yes'])){
        setcookie('shop_unique_id', '', time() - 3600, '/');
        session_destroy(); 
        header("location:Login.php");
        exit();
    }else if(isset($_POST['btn_cancel'])){
        header("location:Settings.php");
    }
    
?>