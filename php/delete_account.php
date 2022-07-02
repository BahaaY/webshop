<?php

    session_start();

    $msg_check_validation=$msg_email=$msg_password="";
    include("classes/user.php");
    include("classes/connexion.php");
    
    $user = new user($bdd->get_link()); 

    if (isset($_POST['btn_delete_acc'])) {
        $input_email = $user->mysqli_real_escape_string($_POST['input_email']);
        $input_password = $user->mysqli_real_escape_string($_POST['input_password']);

        $email=$user->set_email_delete_account($input_email);

        if($email == 2)
            $msg_email="Enter a valid email!";
        else if($email == 3)
            $msg_email="Required*";

        if($input_password==""){
            $msg_password="Required*";
        }

        if($email==1 && $input_password!=""){
            $user_id=$_SESSION['shop_unique_id'];
            $validation=$user->validation_delete_account($input_email,$input_password,$user_id);
            if($validation==1){
                header("location:Check_delete_account.php");
            }else{
                $msg_check_validation="<h2 id='msg_check_incorrect'>Email or password incorrect!</h2>";
            }
        }
    }
    
?>