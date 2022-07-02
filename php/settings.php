<?php

    session_start();

    include("classes/user.php");
    include("classes/connexion.php");
    $user=new user($bdd->get_link());

    $msg_first_name = $msg_last_name = $msg_username = $msg_phone =$msg_date =$msg_check_update= "";

    $uid=$_SESSION['shop_unique_id'];
    
    $res=$user->run_query("select * from users where unique_id='{$uid}'");
    $row=mysqli_fetch_assoc($res);
    $input_first_name=$row['first_name'];
    $input_last_name=$row['last_name'];
    $input_username=$row['username'];
    $input_phone_number=$row['phone'];
    $input_email=$row['email'];
    $gender=$row['gender'];
    $input_date_of_birth=$row['birthdate'];

    if(isset($_POST['btn_update'])){
        //get data 
        $input_first_name = $user->mysqli_real_escape_string($_POST['input_first_name']);
        $input_last_name = $user->mysqli_real_escape_string($_POST['input_last_name']); 
        $input_username = $user->mysqli_real_escape_string($_POST['input_username']);
        $input_phone_number = $user->mysqli_real_escape_string($_POST['input_phone_number']);
        $input_date_of_birth=$user->mysqli_real_escape_string($_POST['date_of_birth']);

        if(isset($_POST['gender'])){
            $input_gender=$user->mysqli_real_escape_string($_POST['gender']);
            if($input_gender == "rdb_male"){
                $gender="Male";
            }else if($input_gender == "rdb_female")
                $gender="Female";
        }

        $fname_u = $user->set_fname($input_first_name);
        $lname_u = $user->set_lname($input_last_name);
        $username_u = $user->set_update_username($input_username,$uid);
        $phone_u = $user->set_update_phone($input_phone_number,$uid);
        $date_u = $user->set_birthdate($input_date_of_birth);
        $gender_user = $user->set_gender($gender);

        // validation
        if($fname_u == 0)  
            $msg_first_name="First name must not be contain space, number and special characters!";  
        else if($fname_u == 2)  
            $msg_first_name="Required*"; 

        if($lname_u == 0)
            $msg_last_name="Last name must not be contain space, number and special characters!";  
        else if($lname_u == 2)  
            $msg_last_name="Required*"; 

        if($username_u == 0 )
            $msg_username="Username already exist!";
        else if($username_u == 2)
            $msg_username="Username must not be contain space!";
        else if($username_u == 3)
            $msg_username="Username must be contain 1 character or more!";
        else if($username_u == 4)
            $msg_username="Username must not be more than 15 characters!";
        else if($username_u == 5)
            $msg_username="Required*";

        if($phone_u == 0 )
            $msg_phone="Phone number already exist!";
        else if($phone_u == 2 || $phone_u == 3)
            $msg_phone="Enter a valid phone number!";
        else if($phone_u == 4)
            $msg_phone="Required*";
        
        if($date_u == 0)
            $msg_date="Required*";
        
        if($fname_u==1 && $lname_u==1 && $username_u==1 && $phone_u==1 && $date_u == 1 && $gender_user == 1){
            $update=$user->check_query("update users set first_name='{$input_first_name}',last_name='{$input_last_name}',username='{$input_username}',phone='{$input_phone_number}',birthdate='{$input_date_of_birth}',gender='{$gender}' where unique_id='{$uid}'");
            if($update==1){
                $msg_check_update="<h2 id='msg_check_correct'>Profile has been updated.</h2>";
            }
        }
    }
?>