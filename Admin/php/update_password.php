<?php
    session_start();

    include("../classes/user.php");
    include("../classes/connexion.php");
    $user=new user($bdd->get_link());

    $msg_current_password = $msg_new_password = $msg_retype_new_password = $msg_check_password= "";

    if(isset($_POST['btn_update_password'])){
        $uid=$_SESSION['shop_unique_id_admin'];
        $input_current_password = $user->mysqli_real_escape_string($_POST['input_current_password']);
        $input_new_password = $user->mysqli_real_escape_string($_POST['input_new_password']); 
        $input_retype_new_password = $user->mysqli_real_escape_string($_POST['input_retype_new_password']);

        $current_password = $user->set_current_password($input_current_password,$uid);
        $new_password = $user->set_new_password($input_new_password,$uid);

        // validation
        if($current_password == 0)  
            $msg_current_password="Please enter your current password!";  
        else if($current_password == 2)  
            $msg_current_password="Required*"; 

        if($new_password == 0)
            $msg_new_password="Password must be contain upercase,lowercase,number and special characters and not contain space!";
        if($new_password == 2)
            $msg_new_password="Password must be at least 6 characters or more!";
        if($new_password == 3)
            $msg_new_password="Required*";
        if($new_password == 4)
            $msg_new_password="This is your current password!";

        if($input_retype_new_password=="")
            $msg_retype_new_password="Required*";
        else if($input_new_password!=$input_retype_new_password)
            $msg_retype_new_password="Password and confirm password does not match!";
         

        if($current_password==1 && $new_password ==1 && $input_new_password==$input_retype_new_password){
            $update_password=$user->update_password($uid);
            if($update_password == 1){
                if(isset($_COOKIE['shopping_website_email']) && isset($_COOKIE['shopping_website_password'])){
                    setcookie("shopping_website_password", $input_new_password, time() + (86400 * 30), "/");
                }
                $msg_check_password="<h2 id='msg_check_correct'>Password has been changed successfully.</h2>";
                $input_current_password="";
                $input_new_password="";
                $input_retype_new_password="";
            }else{
                $msg_check_password="<h2 id='msg_check_incorrect'>Error exist!</h2>";
            }
        }
    }
?>