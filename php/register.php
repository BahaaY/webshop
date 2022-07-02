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

    $msg_first_name = $msg_last_name = $msg_username = $msg_email = $msg_password =$msg_confirm_password = $msg_phone= $msg_date_of_birth =$msg_gender =$msg_verify_email= "";
    $g="";


    if(isset($_POST['btn_register'])){

        include ("verification/mail.php");
        include("classes/user.php");
        include("classes/connexion.php");
        
        $user = new user($bdd->get_link()); 

        $input_first_name = $user->mysqli_real_escape_string($_POST['input_first_name']);
        $input_last_name = $user->mysqli_real_escape_string($_POST['input_last_name']);
        $input_username = $user->mysqli_real_escape_string($_POST['input_username']);
        $input_phone_number = $user->mysqli_real_escape_string($_POST['input_phone_number']);
        $input_email = $user->mysqli_real_escape_string($_POST['input_email']);
        $input_password = $user->mysqli_real_escape_string($_POST['input_password']);
        $input_confirm_password = $user->mysqli_real_escape_string($_POST['input_confirm_password']);
        $input_date_of_birth = $user->mysqli_real_escape_string($_POST['date_of_birth']);
        if(isset($_POST['gender'])){
            $input_gender=$user->mysqli_real_escape_string($_POST['gender']);
            if($input_gender == "rdb_male"){
                $g="Male";
            }else if($input_gender == "rdb_female")
                $g="Female";
        }

        $security_code =md5(date("h:i:s"));
        $rand_unique_id = rand(time(), 100000000);
        $nb_verifyCode= $security_code;

        $unique_id = $user->set_uniqueId($rand_unique_id);
        $first_name = $user->set_fname($input_first_name);
        $last_name = $user->set_lname($input_last_name);
        $username = $user->set_username($input_username);
        $phone_number = $user->set_phone($input_phone_number);
        $email = $user->set_email($input_email);
        $password = $user->set_password($input_password);
        $gender = $user->set_gender($g);
        $date_of_birth = $user->set_birthdate($input_date_of_birth);
        $verifyCode = $user->set_verifyCode($nb_verifyCode);
        
        if($first_name == 0)  
            $msg_first_name="First name must not be contain space, number and special characters!";  
        else if($first_name == 2)  
            $msg_first_name="Required*"; 

        if($last_name == 0)
            $msg_last_name="Last name must not be contain space, number and special characters!";  
        else if($last_name == 2)  
            $msg_last_name="Required*"; 

        if($username == 0)
            $msg_username="Username already exist!";
        else if($username == 2)
            $msg_username="Username must not be contain space!";
        else if($username == 3)
            $msg_username="Username must be contain 1 character or more!";
        else if($username == 4)
            $msg_username="Username must not be more than 15 characters!";
        else if($username == 5)
            $msg_username="Required*";

        if($phone_number == 0)
            $msg_phone="Phone number already exist!";
        else if($phone_number == 2 || $phone_number == 3)
            $msg_phone="Enter a valid phone number!";
        else if($phone_number == 4)
            $msg_phone="Required*";

        if($email == 0)
            $msg_email="Email already exist!";
        else if($email == 2)
            $msg_email="Enter a valid email!";
        else if($email == 3)
            $msg_email="Required*";

        if($password == 0)
            $msg_password="Password must be contain upercase,lowercase,number and special characters and not contain space!";
        if($password == 2)
            $msg_password="Password must be at least 6 characters or more!";
        if($password == 3)
            $msg_password="Required*";

        if($input_confirm_password!=$input_password)
            $msg_confirm_password="Password and confirm password does not match!";
        else if($input_confirm_password=="")
            $msg_confirm_password="Required*";


        if($gender == 0)
            $msg_gender="Required*";

        if($date_of_birth == 0)
            $msg_date_of_birth="Required*";
            
        if($unique_id == 1 && $first_name == 1 && $last_name == 1 && $username == 1 && $phone_number == 1  && $email == 1 && $password == 1 && $input_confirm_password == $input_password && $gender == 1 && $date_of_birth == 1 && $verifyCode == 1){
            $insert=$user->register();
            if($insert == 1){
                $uid=$user->get_uniqueId();
                $mail->addAddress($input_email);
                $mail->Subject = "Link activation for your account.";
                $mail-> Body= '<h2>Hi '.$input_username.',<br>Thanks for your registering on shopping website, please verify your account then login.</h2>'.
                    "<h2><a href='http://localhost/PFE/php/register.php?uid=".$uid."&&security_code=" .$security_code. "'> 
                        Verification link</a></h2>";
                $mail->setFrom("onlineshop100701@gmail.com", "ONLINE SHOP");
                $mail->send();

                $msg_verify_email="<h2 id='msg_check_correct'>Email verification has been sent to your account.</h2>";

                $input_first_name="";
                $input_last_name="";
                $input_username="";
                $input_phone_number="";
                $input_email="";
                $input_password="";
                $input_confirm_password="";
                $input_date_of_birth="";
            }else{
                $msg_verify_email="<h2 id='msg_check_incorrect'> Error exist! </h2>";
            }    
        }
    }



?>