<html>
    <?php

        include_once "head.php"; 

        require("php/update_password.php");

        if(!isset($_SESSION['shop_unique_id_admin'])){
            if(isset($_COOKIE['shop_unique_id_admin'])){
                $_SESSION['shop_unique_id_admin']=$_COOKIE['shop_unique_id_admin'];
                $res_check_uid=$user->run_query("select * from users where unique_id=".$_SESSION['shop_unique_id_admin']."");
                if(mysqli_num_rows($res_check_uid) == 0){
                    setcookie('shop_unique_id_admin', '', time() - 3600, '/');
                    session_destroy();
                    header("location: index.php");
                }
            }else{
                header("location: index.php");
            }
        }else{
            $res_check_uid=$user->run_query("select * from users where unique_id=".$_SESSION['shop_unique_id_admin']."");
            if(mysqli_num_rows($res_check_uid) == 0){
                setcookie('shop_unique_id_admin', '', time() - 3600, '/');
                session_destroy();
                header("location: index.php");
            }else{
                if(!isset($_COOKIE['shop_unique_id_admin'])){
                    setcookie("shop_unique_id_admin", $_SESSION['shop_unique_id_admin'], time() + (86400 * 30), "/"); // 86400 = 1 day
                }
            }
        }

    ?>

    <body class="body_main">
        <!-- Header -->
        <section class="header">

            <div class="col">
                <a href="Admin.php" id="left">Back</a>
            </div>

            <div class="col">
                <span class="product_title_info_large">Change Password</span>
            </div>

            <div class="col">
                
            </div>

        </section>
        <!-- Body -->
        <section class="form" id="form_profile"  >
            <form method="POST" >

                <div class="col_div" >
                    <div class="col" id="div_error_msg_check">
                        <?php if($msg_check_password!="") echo $msg_check_password ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-lock" ></i>
                        <i class="fa fa-eye" id="i_eye1" onclick="ShowHideCurrentPass();"></i>
                        <i class="fa fa-eye-slash" id="i_eye2" style="display: none;" onclick="ShowHideCurrentPass();"></i>
                        <input type="password" name="input_current_password" id="input_current_password" value="<?php if(isset($_POST['input_current_password'])) echo $input_current_password; ?>">
                        <label id="label_current_password">Current password</label>
                    </div>
                </div>

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_current_password!="") echo $msg_current_password ?>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-lock" ></i>
                        <i class="fa fa-eye" id="i_eye3" onclick="ShowHideNewPass();"></i>
                        <i class="fa fa-eye-slash" id="i_eye4" style="display: none;" onclick="ShowHideNewPass();"></i>
                        <input type="password" name="input_new_password" id="input_new_password"  value="<?php if(isset($_POST['input_new_password'])) echo $input_new_password; ?>" >
                        <label id="label_new_password">New password</label>
                    </div>
                </div>

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_new_password!="") echo $msg_new_password ?>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-lock" ></i>
                        <i class="fa fa-eye" id="i_eye5" onclick="ShowHideRetypeNewPass();"></i>
                        <i class="fa fa-eye-slash" id="i_eye6" style="display: none;" onclick="ShowHideRetypeNewPass();"></i>
                        <input type="password" name="input_retype_new_password" id="input_retype_new_password"  value="<?php if(isset($_POST['input_retype_new_password'])) echo $input_retype_new_password; ?>" >
                        <label id="label_retype_new_password">Retype new password</label>
                    </div>
                </div>  

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_retype_new_password!="") echo $msg_retype_new_password ?>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col">
                        <input type="submit" name="btn_update_password" id="btn_update_password" class="btn_update_password" value="Update Password">
                    </div>
                </div>  

            </form>
        </section>
    </body>
</html>