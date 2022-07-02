<?php
    session_start();
?>

<?php

    if(isset($_GET['security_code']) && isset($_GET['uid'])){

        include("../classes/connexion.php");
        include("../classes/user.php");

        $user = new user($bdd->get_link());
        $u=$user->verify($_GET['uid'],$_GET['security_code']);

        if($u==1){
            echo "<h2 style='position:absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);'>Your email has been activated. You can now <a href='../Login.php' >login.</a></h2>";
        }else if($u==0 || $u==2){
            echo "<h2 style='position:absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);'>Link used or expired.</h2>";
        }
    }

?>

<?php

    $msg_check_validation =$msg_email=$msg_password="";

    if(isset($_POST['btn_login'])){

        $security_code =md5(date("h:i:s"));

        include ("verification/mail.php");
        include("classes/connexion.php");
        include("classes/user.php");

        $user =new user($bdd->get_link());

        $input_email = $user->mysqli_real_escape_string($_POST['input_email']);
        $input_password = $user->mysqli_real_escape_string($_POST['input_password']);

        if($input_email==""){
            $msg_email="Required*";
        }else{
            $msg_email="";
        }
        if($input_password==""){
            $msg_password="Required*";
        }else{
            $msg_password="";
        }

        if($input_email!="" && $input_password!=""){

            $user->set_verifyCode($security_code);
        
            $login=$user->validation($input_email,$input_password);
            
            if($login==0){
                $msg_check_validation="<h2 id='msg_check_incorrect'>Email or password incorrect!</h2>";
            }else if($login==1){
    
                if(isset($_POST['remember'])){
                    setcookie("shopping_website_email", $input_email, time() + (86400 * 30), "/"); // 86400 = 1 day
                    setcookie("shopping_website_password", $input_password, time() + (86400 * 30), "/"); // 86400 = 1 day
                }else{
                    setcookie('shopping_website_email', '', time() - 3600, '/');
                    setcookie('shopping_website_password', '', time() - 3600, '/');
                }
    
                header("location:Main.php");
                
            }else if($login==2){ //Email not verified
                $res=$user->run_query("select * from users where email='{$input_email}'");
                $res2=$user->run_query("update users set verify_code='{$security_code}' where email='{$input_email}'");
                while($row=mysqli_fetch_assoc($res)){
                    $uid=$row['unique_id'];
                    $username=$row['username'];
                }
    
                $mail->addAddress($input_email);
                $mail->Subject = "Link acivation for your account";
                $mail-> Body= '<h2>Hi '.$username.',<br>Thanks for your registering on shopping website, please verify your account then login.</h2>'.
                    "<h2><a href='http://localhost/PFE/php/login.php?uid=".$uid."&&security_code=" .$security_code. "'> 
                        Verification link</a></h2>";
                $mail->setFrom("onlineshop100701@gmail.com", "ONLINE SHOP");
                $mail->send();
    
                $msg_check_validation="<h2 id='msg_check_correct'>Email verification has been sent to your account.</h2>";
            } 

        }  
        
    }

?>