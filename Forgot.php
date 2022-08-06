<html>

    <?php
    
        include_once "head.php"; 

        include("php/forgot.php");

        if (isset($_SESSION['shop_unique_id']) || isset($_COOKIE['shop_unique_id'])) {
            header("location: Main.php");
        }
        if (isset($_SESSION['shop_unique_id_admin']) || isset($_COOKIE['shop_unique_id_admin'])) {
            header("location: Admin/Admin.php");
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
                <a href="Login.php" id="a_main">Login</a>
            </div>
            
        </section>
        <!-- Body -->
        <section class="form">
            <form method="POST">

                <div class="col_div" >
                    <div class="col" id="div_error_msg_check">
                        <?php if($msg_check_reset!="") echo $msg_check_reset ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-envelope" ></i>
                        <input type="email" name="input_email" id="input_email" value="<?php if(isset($_POST['input_email'])) echo $_POST['input_email'] ?>" >
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
                        <input type="submit" name="btn_forgot" id="btn_forgot" class="btn_forgot" value="Forgot password">
                    </div>
                </div>  

            </form>
        </section>
    </body>
    
</html>