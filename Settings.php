<html>

    <?php

        include_once "head.php"; 

        require("php/settings.php");

        if(!isset($_SESSION['shop_unique_id'])){
            if(isset($_COOKIE['shop_unique_id'])){
                $_SESSION['shop_unique_id']=$_COOKIE['shop_unique_id'];
                $res_check_uid=$user->run_query("select * from users where unique_id=".$_SESSION['shop_unique_id']."");
                if(mysqli_num_rows($res_check_uid) == 0){
                    setcookie('shop_unique_id', '', time() - 3600, '/');
                    session_destroy();
                    header("location: index.php");
                }
            }else{
                header("location: index.php");
            }
        }else{
            $res_check_uid=$user->run_query("select * from users where unique_id=".$_SESSION['shop_unique_id']."");
            if(mysqli_num_rows($res_check_uid) == 0){
                setcookie('shop_unique_id', '', time() - 3600, '/');
                session_destroy();
                header("location: index.php");
            }else{
                if(!isset($_COOKIE['shop_unique_id'])){
                    setcookie("shop_unique_id", $_SESSION['shop_unique_id'], time() + (86400 * 30), "/"); // 86400 = 1 day
                }
            }
        }
        
    ?>

    <body class="body_main">
        <!-- Header -->
        <section class="header">

            <div class="col">
                <a href="Main.php" id="left">Back</a>
            </div>

            <div class="col">
                <a href="Update_password.php" id="a_main">Change Password</a>
            </div>

            <div class="col">
                <a href="Delete_account.php" id="a_main">Delete Account</a>
            </div>

            <div class="col">
            <a href="Check_logout.php" id="a_main">Logout</a>
            </div>

        </section>
        <!-- Body -->
        <section class="form" id="form_profile">
            <form method="POST">

                <div class="col_div">
                    <div class="col" id="div_error_msg_check">
                        <?php if($msg_check_update!="") echo $msg_check_update ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-user" ></i>
                        <input type="text" name="input_first_name" id="input_first_name" value="<?php if($input_first_name!="") echo $input_first_name ?>" >
                        <label id="label_first_name">First name</label>
                    </div>
                    <div class="col">
                        <i class="fa fa-user" ></i>
                        <input type="text" name="input_last_name" id="input_last_name" value="<?php if($input_last_name!="") echo $input_last_name ?>" >
                        <label id="label_last_name">Last name</label>
                    </div>
                </div>  

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_first_name!="") echo $msg_first_name ?>
                    </div>
                    <div class="col"  id="div_error">
                        <?php if($msg_last_name!="") echo $msg_last_name ?>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-user" ></i>
                        <input type="text" name="input_username" id="input_username" value="<?php if($input_username!="") echo $input_username ?>" >
                        <label id="label_username">Username</label>
                    </div>
                    <div class="col">
                        <i class="fa fa-phone" ></i>
                        <input type="text" name="input_phone_number" id="input_phone_number" value="<?php if($input_phone_number!="") echo  $input_phone_number ?>" >
                        <label id="label_phone_number">Phone number</label>
                    </div>
                </div> 

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_username!="") echo $msg_username ?>
                    </div>
                    <div class="col"  id="div_error">
                        <?php if($msg_phone!="") echo $msg_phone ?>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col" style="font-size: 17px;">
                        Date of birthday
                    </div>
                    <div class="col" style='bottom:15px'>
                        <input type="date" name="date_of_birth" id="date_of_birth" value="<?php if($input_date_of_birth!="") echo $input_date_of_birth ?>">
                    </div>
                </div>

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        
                    </div>
                    <div class="col"  id="div_error" style='top:5px'>
                        <?php if($msg_date!="") echo $msg_date ?>
                    </div>
                </div> 

                <div class="col_div">
                    <table style="margin:0px">
                        <tr>
                            <td>Select gender &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td><input type="radio" name="gender" id="rdb_male" value="rdb_male" <?php if($gender=="Male") echo "checked"; ?> ><label for="rdb_male">Male</label></td>
                            <td><input type="radio" name="gender" id="rdb_female" value="rdb_female" <?php if($gender=="Female") echo "checked"; ?> ><label for="rdb_female">Female</label></td>
                        </tr>
                    </table>
                </div> 

                <div class="col_div">
                    <div class="col" style="font-size: 17px;">
                        Email
                    </div>
                    <div class="col" style="font-size: 17px;">
                        <?php echo $input_email ?>
                    </div>
                </div> 
            
                <div class="col_div">
                    <div class="col">
                        <input type="submit" name="btn_update" id="btn_update" class="btn_update" value="Update profile">
                    </div>
                </div>  

            </form>
        </section>
    </body>
    
</html>