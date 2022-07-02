<html>

    <?php

        include_once "head.php";

        include_once 'php/delete_account.php';

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
                <a href="Settings.php"  id="left">Back</a>
            </div>

            <div class="col">
                <span class="product_title_info_large">Delete Account</span>
            </div>

            <div class="col">
                
            </div>

        </section>
        <!-- Body -->
        <section class="form" id="form_profile">
            <form method="POST">

                <div class="col_div" >
                    <div class="col" id="div_error_msg_check" >
                     <?php if($msg_check_validation!="") echo $msg_check_validation ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-envelope" ></i>
                        <input type="email" name="input_email" id="input_email" value="<?php if(isset($_POST['input_email'])) echo $input_email;?>" >
                        <label style="padding-left: 5px;" id="label_email">Email</label>
                    </div>
                </div> 

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_email!="") echo $msg_email ?>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-lock" ></i>
                        <i class="fa fa-eye" id="i_eye1" onclick="ShowHidePass();"></i>
                        <i class="fa fa-eye-slash" id="i_eye2" style="display: none;" onclick="ShowHidePass();"></i>
                        <input type="password" name="input_password" id="input_password" value="<?php if(isset($_POST['input_password'])) echo $input_password;?>" >
                        <label id="label_password">Password</label>
                    </div>
                </div>  

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_password!="") echo $msg_password ?>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col">
                        <input type="submit" name="btn_delete_acc" id="btn_delete_acc" class="btn_delete_acc" value="Delete Account">
                    </div>
                </div>  

            </form>
        </section>
    </body>
    
</html>