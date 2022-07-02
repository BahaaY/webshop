<html>

    <?php

        include_once "head.php"; 

        include_once 'php/register.php';
        
        if (isset($_SESSION['shop_unique_id']) || isset($_COOKIE['shop_unique_id'])) {
            header("location: Main.php");
        }
        
        $m=$f="";
        if(isset($_POST['gender'])){
            $gend=$_POST['gender'];
            if($gend=="rdb_male"){
                $m="checked";
            }else if($gend=="rdb_female"){
                $f="checked";
            }
        }

    ?>

    <body>
        <!-- Header -->
        <section class="header">

            <div class="col">
                <a href="index.php" id="a_main" >Shopping website</a>
            </div>

            <div class="col">
                <a href="AboutUs.php" id="a_main">About Us</a>
            </div>

            <div class="col">
                <a href="Register.php" class="selected" >Register</a>
            </div>

            <div class="col">
                <a href="Login.php" id="a_main">Login</a>
            </div>

        </section>
        <!-- Body -->
        <section class="form">
            <form method="POST">

                <div class="col_div" >
                    <div class="col" id="div_error_msg_check" >
                        <?php if($msg_verify_email!="") echo $msg_verify_email ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-user" ></i>
                        <input type="text" name="input_first_name" id="input_first_name" value="<?php if(isset($_POST['input_first_name'])) echo $input_first_name ?>" >
                        <label id="label_first_name">First name</label>
                    </div>
                    <div class="col">
                        <i class="fa fa-user" ></i>
                        <input type="text" name="input_last_name" id="input_last_name" value="<?php if(isset($_POST['input_last_name'])) echo $input_last_name ?>" >
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
                        <input type="text" name="input_username" id="input_username" value="<?php if(isset($_POST['input_username'])) echo $input_username ?>" >
                        <label id="label_username">Username</label>
                    </div>
                    <div class="col">
                        <i class="fa fa-phone" ></i>
                        <input type="text" name="input_phone_number" id="input_phone_number" value="<?php if(isset($_POST['input_phone_number'])) echo  $input_phone_number ?>" >
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
                    <div class="col">
                        <i class="fa fa-envelope" ></i>
                        <input type="email" name="input_email" id="input_email" value="<?php if(isset($_POST['input_email'])) echo $input_email ?>" >
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
                        <input type="password" name="input_password" id="input_password" value="<?php if(isset($_POST['input_password'])) echo $input_password ?>" >
                        <label id="label_password">Password</label>
                        
                    </div>
                    <div class="col">
                        <i class="fa fa-lock" ></i>
                        <i class="fa fa-eye" id="i_eye3" onclick="ShowHideConfPass();"></i>
                        <i class="fa fa-eye-slash" id="i_eye4" style="display: none;" onclick="ShowHideConfPass();"></i>
                        <input type="password" name="input_confirm_password" id="input_confirm_password" value="<?php if(isset($_POST['input_confirm_password'])) echo $input_confirm_password ?>" >
                        <label id="label_confirm_password">Confirm password</label>
                    </div>
                </div>  

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_password!="") echo $msg_password ?>
                    </div>
                    <div class="col"  id="div_error">
                        <?php if($msg_confirm_password!="") echo $msg_confirm_password ?>
                    </div>
                </div> 

                <div class="col_div">
                    <table style="margin:4px">
                        <tr>
                            <td>Select gender &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td><input type="radio" name="gender" id="rdb_male" value="rdb_male" <?php echo $m; ?> ><label for="rdb_male">Male</label></td>
                            <td><input type="radio" name="gender" id="rdb_female" value="rdb_female"  <?php echo $f;?> ><label for="rdb_female">Female</label></td>
                        </tr>
                    </table>
                </div> 
                
                <div class="col_div" >
                    <div class="col" id="div_error" >
                        
                    </div>
                    <div class="col" id="div_error" >
                        <?php if($msg_gender!="") echo $msg_gender ?>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col">
                        <span id="span_date_of_birth">Select date of birth</span>
                    </div>
                    <div class="col">
                        <input type="date" name="date_of_birth" id="date_of_birth" value="<?php if(isset($_POST['date_of_birth'])) echo $input_date_of_birth ?>">
                    </div>
                </div>  

                <div class="col_div">
                    <div class="col" id="div_error" >
                        
                    </div>
                    <div class="col" id="div_error" style="margin-top:1px">
                        <?php if($msg_date_of_birth!="") echo $msg_date_of_birth ?>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col">
                        <input type="submit" name="btn_register" id="btn_register" class="btn_register" value="Register">
                    </div>
                </div>  
                
            </form>
        </section>
    </body>
    
</html>