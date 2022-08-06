<html>

    <?php

        include_once "head.php"; 

        include_once 'php/login.php';

        if (isset($_SESSION['shop_unique_id']) || isset($_COOKIE['shop_unique_id'])) {
            header("location: Main.php");
        }
        if (isset($_SESSION['shop_unique_id_admin']) || isset($_COOKIE['shop_unique_id_admin'])) {
            header("location: Admin/Admin.php");
        }

        $checked="";
        if(isset($_COOKIE['shopping_website_email']) && isset($_COOKIE['shopping_website_email'])){
            $checked="checked";
        }else{
            $checked="";
        }
        
    ?>

    <body>
        <!-- Header -->
        <section class="header">

            <div class="col">
                <a href="index.php" id="a_main">Shopping website</a>
            </div>

            <div class="col">
                <a href="AboutUs.php" id="a_main">About Us</a>
            </div>

            <div class="col">
                <a href="Register.php" id="a_main">Register</a>
            </div>

            <div class="col">
                <a href="Login.php" class="selected" >Login</a>
            </div>

        </section>
        <!-- Body -->
        <section class="form" >
            <form method="POST">

                <div class="col_div" >
                    <div class="col" id="div_error_msg_check" >
                        <?php if($msg_check_validation!="") echo $msg_check_validation ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-envelope" ></i>
                        <input type="email" name="input_email" id="input_email" value="<?php if(isset($_POST['input_email'])) echo $input_email;else if(isset($_COOKIE['shopping_website_email'])) echo $_COOKIE['shopping_website_email'];  ?>" >
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
                        <input type="password" name="input_password" id="input_password" value="<?php if(isset($_POST['input_password'])) echo $input_password;else if(isset($_COOKIE['shopping_website_password'])) echo $_COOKIE['shopping_website_password']; ?>" >
                        <label id="label_password">Password</label>
                    </div>
                </div>  

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_password!="") echo $msg_password ?>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col" style="width:15px">
                        <input type="checkbox" id="remember" class="remember" name="remember" <?php echo $checked; ?>>
                    </div>
                    <label for="remember" style="position: relative;top:6px;font-size:18px">Remember me</label>
                </div>

                <div class="col_div">
                    <div class="col">
                        <a href="Forgot.php" id="forgot" name="forgot" class="forgot" >Forgot password?</a>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col">
                        <input type="submit" name="btn_login" id="btn_login" class="btn_login" value="Login">
                    </div>
                </div>  

            </form>
        </section>
    </body>
    
</html>