<?php

    session_start();

    $msg_password=$msg_confirm_password=$msg_error="";

    include("classes/connexion.php");
    include("classes/user.php");

    $user=new user($bdd->get_link());

    if(isset($_GET['email']) && isset($_GET['code'])){
        $input_email_hash=$_GET['email'];
        $input_code=$_GET['code'];
        $res=$user->run_query("select * from users");
        if(mysqli_num_rows($res)>0){
            while($row=mysqli_fetch_assoc($res)){
                if($input_email_hash == md5($row['email'])){
                    $res2=$user->run_query("select * from users where email='{$row['email']}'");
                    if(mysqli_num_rows($res2)>0){
                        $row2=mysqli_fetch_assoc($res2);
                        if($input_code==$row2['verify_code']){
                            $input_email=$row['email'];
                            break;
                        }else{
                            $input_email="";
                        }
                    }else{
                        $input_email="";
                    }
                }else{
                    $input_email="";
                }
            }
        }else{
            $input_email="";
        }
    }else{
        $input_email="";
    }

    if($input_email!=""){
        if(isset($_POST['btn_reset'])){
            $input_password=$user->mysqli_real_escape_string($_POST['input_password']);
            $input_confirm_password=$user->mysqli_real_escape_string($_POST['input_confirm_password']);
        
            $password=$user->set_reset_password($input_email,$input_password);
        
            if($password == 0)
                $msg_password="Password must be contain upercase,lowercase,number and special characters and not contain space!";
            if($password == 2)
                $msg_password="Password must be at least 6 characters or more!";
            if($password == 3)
                $msg_password="Required*";
            if($password == 4)
                $msg_password="This is your current password!";
        
            if($input_confirm_password!=$input_password)
                $msg_confirm_password="Password and confirm password does not match!";
            else if($input_confirm_password=="")
                $msg_confirm_password="Required*";
        
            if($password == 1 && $input_confirm_password == $input_password){
                $reset=$user->reset_password($input_email);
                if($reset==1){
                    setcookie('shopping_website_password', '', time() - 3600, '/');
                    echo "<script>alert('Password has been changed successfully.');window.location.href = '../PFE/Login.php';</script>";
                }else{
                    $msg_error="<h2 id='msg_check_incorrect'>Error exist!</h2>";
                }
            } 
        }
    }else{
        $input_password="";
        $input_confirm_password="";
        $msg_error="<h2 id='msg_check_incorrect'>Error exist!</h2>";
    }

    



?>

