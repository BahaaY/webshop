<html>

    <?php

        include_once "head.php"; 

        include("php/reset_password.php");
        
        if (isset($_SESSION['shop_unique_id']) || isset($_COOKIE['shop_unique_id'])) {
            header("location: Main.php");
        }
        
    ?>

    <body>
        <!-- Body -->
        <section class="form">
            <form method="POST">

                <div class="col_div" >
                    <div class="col" id="div_error_msg_check" >
                        <?php if($msg_error!="") echo $msg_error ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-lock" ></i>
                        <i class="fa fa-eye" id="i_eye1" onclick="ShowHidePass();"></i>
                        <i class="fa fa-eye-slash" id="i_eye2" style="display: none;" onclick="ShowHidePass();"></i>
                        <input type="password" name="input_password" id="input_password" value="<?php if(isset($_POST['input_password'])) echo $input_password ?>" >
                        <label id="label_password">New password</label>   
                    </div>
                </div>  

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_password!="") echo $msg_password ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-lock" ></i>
                        <i class="fa fa-eye" id="i_eye3" onclick="ShowHideConfPass();"></i>
                        <i class="fa fa-eye-slash" id="i_eye4" style="display: none;" onclick="ShowHideConfPass();"></i>
                        <input type="password" name="input_confirm_password" id="input_confirm_password" value="<?php if(isset($_POST['input_confirm_password'])) echo $input_confirm_password ?>" >
                        <label id="label_confirm_password">Confirm new password</label>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col"  id="div_error">
                        <?php if($msg_confirm_password!="") echo $msg_confirm_password ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                    <input type="submit" name='btn_reset' value='Reset password' style='width:100%'/>
                    </div>
                </div>  

            </form>
        </section>
    </body>
    
</html>