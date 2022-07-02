<?php
    session_start();
?>

<?php

    if(isset($_GET['email']) && isset($_GET['code'])){
        
        include("../classes/connexion.php");
        include("../classes/user.php");
        $user =new user($bdd->get_link());

        $email_hash=$_GET['email'];
        $code=$_GET['code'];
        $res1=$user->run_query("select * from users");
        if(mysqli_num_rows($res1)>0){
            while($row=mysqli_fetch_assoc($res1)){
                
                if($email_hash == md5($row['email'])){
                    $email=$row['email'];
                    $res2=$user->run_query("select * from users where email='{$email}'");
                    if(mysqli_num_rows($res2)>0){
                        $row2=mysqli_fetch_assoc($res2);
                        if($code==$row2['verify_code']){
                            header('location:http://localhost/PFE/Reset_password.php?email='.$email_hash.'&code='.$code);
                        }else{
                            echo "<h2 style='position:absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);'>Link used or expired.</h2>";
                        }
                    }else{
                        echo "<h2 style='position:absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);'>Link used or expired.</h2>";
                    }
                }else{
                    echo "<h2 style='position:absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);'>Link used or expired.</h2>";
                }
            }
        }else{
            echo "<h2 style='position:absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);'>Link used or expired.</h2>";
        }
    }
?>


<?php

    $msg_check_reset=$msg_email="";

    if(isset($_POST['btn_forgot'])){

        include("verification/mail.php");
        include("classes/connexion.php");
        include("classes/user.php");
        
        $user =new user($bdd->get_link());

        $email=$user->mysqli_real_escape_string($_POST['input_email']);

        if($email==""){
            $msg_email="Required*";
        }else{
            $sql="select * from users where email='{$email}'";   
            $res=$user->run_query($sql);
                
            if (mysqli_num_rows($res)>0) {
                $row=mysqli_fetch_assoc($res);
                $username=$row['username'];
                $email_hash=md5($email);
                $code=md5(date("h:i:s"));
                $mail->addAddress($email);
                $mail->Subject = "Link for reset password.";
                
                $mail->Body= "<h2>Hi $username,<br>We received a request link to reset your password.<br>Click on the
                    link bellow to reset it.</h2>
                    <h2><a href='http://localhost/PFE/php/forgot.php?email=".$email_hash."&code=".$code."'> 
                    Reset password.</a></h2>";
                $mail->setFrom("onlineshop100701@gmail.com", "ONLINE SHOP");
                $mail->send();
                $sql2="update users set verify_code='{$code}' where email='{$email}'";   
                $res2=$user->check_query($sql2);
                if($res2==1){
                    $msg_check_reset="<h2 id='msg_check_correct'>Email reset password has been sent to your account.</h2>";
                }else{
                    $msg_check_reset="<h2 id='msg_check_incorrect'>Error exist!</h2>";
                }
            }else{
                $msg_check_reset= "<h2 id='msg_check_incorrect'>Email not exist!</h2>";
            }
        }
    }

?>