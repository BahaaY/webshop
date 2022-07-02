<html>

    <?php

        include_once "head.php"; 

        include("php/products_info_electronics_home_appliance.php");
        
        if(!isset($_SESSION['shop_unique_id'])){
            if(isset($_COOKIE['shop_unique_id'])){
                $_SESSION['shop_unique_id']=$_COOKIE['shop_unique_id'];
                $res_check_uid=$item->run_query("select * from users where unique_id=".$_SESSION['shop_unique_id']."");
                if(mysqli_num_rows($res_check_uid) == 0){
                    setcookie('shop_unique_id', '', time() - 3600, '/');
                    session_destroy();
                    header("location: index.php");
                }
            }else{
                header("location: index.php");
            }
        }else{
            $res_check_uid=$item->run_query("select * from users where unique_id=".$_SESSION['shop_unique_id']."");
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
                <a href="Products.php" id="left">Back</a>
            </div>

            <div class="col">
                <span class="product_title_info_small">Electronics & Home appliance</span>
            </div>

            <div class="col">
                
            </div>
            
        </section>
        <!-- Body -->
        <section class="form">
            <form method="POST" enctype="multipart/form-data">

                <div class="col_div" >
                    <div class="col" id="div_error_msg_check" >
                        <?php if($msg_check_insert!="") echo $msg_check_insert ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <button type="button" class="btn_upload">
                            <i class="fa fa-upload" id="i_upload"></i>Upload image
                            <input type="file" name="input_image[]" id="input_image" multiple  accept='.jpg, .png, .jpeg'/>
                        </button>
                        <p id="num_image">No image chosen.</p>
                    </div>
                </div> 

                <div class="col_div" >
                    <div class="col" id="div_error_select" >
                        <?php if($msg_image!="") echo $msg_image ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-money" ></i>
                        <input type="text" name="input_price_lb" id="input_price_lb" value="<?php if(isset($_POST['input_price_lb'])) echo $input_price_lb ?>" >
                        <label id="label_price_lb">Price in LB</label>
                    </div>
                    <div class="col">
                        <i class="fa fa-dollar" ></i>
                        <input type="text" name="input_price_usd" id="input_price_usd" value="<?php if(isset($_POST['input_price_usd'])) echo $input_price_usd ?>" >
                        <label id="label_price_usd">Price in USD</label>
                    </div>
                </div> 

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_price_lb!="") echo $msg_price_lb ?>
                    </div>
                    <div class="col"  id="div_error">
                        <?php if($msg_price_usd!="") echo $msg_price_usd ?>
                    </div>
                </div>
                
                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-comment" ></i>
                        <input type="text" name="input_title" id="input_title" value="<?php if(isset($_POST['input_title'])) echo $input_title ?>" >
                        <label id="label_title">Title</label>
                    </div>
                    <div class="col">
                        <i class="fa fa-comment" ></i>
                        <input type="text" name="input_description" id="input_description" value="<?php if(isset($_POST['input_description'])) echo $input_description ?>" >
                        <label id="label_description">Description</label>
                    </div>
                </div> 

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_title!="") echo $msg_title ?>
                    </div>
                    <div class="col"  id="div_error">
                        <?php if($msg_description!="") echo $msg_description ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <select name="type">
                            <option selected disabled value="null" >-- Select Type --</option>
                            <?php
                                $s="";
                                foreach($array_type_electronic_home_appliance as $key=>$val){
                                    if($key=="1" || $key=="2"|| $key=="3"|| $key=="4"|| $key=="5"|| $key=="6"|| $key=="7"|| $key=="8"|| $key=="9"|| $key=="10"
                                    || $key=="11"|| $key=="12"|| $key=="13"|| $key=="14"|| $key=="15"|| $key=="16"|| $key=="17"|| $key=="18"|| $key=="19"|| $key=="20"){   
                                        if($_POST['type']== $val){
                                            if($insert!=1){
                                                $s="selected";
                                            }else{
                                                $s="";
                                            } 
                                        }else{
                                            $s="";
                                        }
                                        echo "<option value='".$val."'$s >".$val."</option>";
                                    }else{
                                        echo "<optgroup label='".$key."'>".$key."</optgroup>";
                                    }
                                } 
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="condition">
                            <option selected disabled value="null">-- Select Condition --</option>
                            <?php
                                $s="";
                                foreach($array_condition_electronic_home_appliance as $val){
                                    if($_POST['condition']== $val){
                                        if($insert!=1){
                                            $s="selected";
                                        }else{
                                            $s="";
                                        } 
                                    }else{
                                        $s="";
                                    }
                                    echo "<option value='".$val."'$s >".$val."</option>";
                                } 
                            ?>
                        </select>
                    </div>
                </div>  

                <div class="col_div" >
                    <div class="col" id="div_error_select" >
                        <?php if($msg_type!="") echo $msg_type ?>
                    </div>
                    <div class="col"  id="div_error_select">
                        <?php if($msg_condition!="") echo $msg_condition ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <i class="fa fa-map-marker" ></i>
                        <input type="text" name="input_location" id="input_location" value="<?php if(isset($_POST['input_location'])) echo $input_location ?>" >
                        <label id="label_location">Location</label>
                    </div>
                </div> 

                <div class="col_div" >
                    <div class="col" id="div_error" >
                        <?php if($msg_location!="") echo $msg_location ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <input type="submit" name="btn_sell" id="btn_sell" class="btn_sell" value="Sell">
                    </div>
                </div> 

            </form>
        </section>
    </body>
    
</html>