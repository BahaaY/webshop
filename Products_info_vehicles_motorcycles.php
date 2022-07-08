<html>

    <?php

        include_once "head.php"; 

        include("php/products_info_vehicles_motorcycles.php");

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
                <span class="product_title_info_large">Vehicles and Motorcycles</span>
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
                        <input type="text" name="input_price_lb" id="input_price_lb" value="<?php if(isset($_POST['input_price_lb'])) echo $input_price_lb ?>" placeholder="" >
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
                        <select name="make" id="make">
                            <option selected disabled value="null">-- Select Make --</option>
                            <?php 
                                $s="";
                                $res=$item->run_query("select * from make ORDER BY name ASC ");
                                while($row=mysqli_fetch_assoc($res)){
                                    if($_POST['make']==$row['name']){
                                        if($insert!=1){
                                            $s="selected";
                                        }else{
                                            $s="";
                                        } 
                                    }else{
                                        $s="";
                                    }
                                    echo "<option value='".$row['name']."' $s >".$row['name']."</option>";
                                }
                                if($_POST['make']=="Other make"){
                                    if($insert!=1){
                                        $s="selected";
                                    }else{
                                        $s="";
                                    } 
                                }else{
                                    $s="";
                                }
                                echo "<option value='Other make' $s >Other make</option>";
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="model" id="model">
                            <option selected disabled value="null">-- Select Model --</option>
                            <!-- Filled using ajax -->
                        </select>
                    </div>
                </div>

                <div class="col_div" >
                    <div class="col" id="div_error_select">
                        <?php if($msg_make!="") echo $msg_make ?>
                    </div>
                    <div class="col"  id="div_error_select">
                        <?php if($msg_model!="") echo $msg_model ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <select name="condition">
                            <option selected disabled value="null">-- Select Condition --</option>
                            <?php
                                $s="";
                                foreach($array_condition_vehicle_motorcycle as $val){
                                    if($_POST['condition']== $val){
                                        if($insert!=1){
                                            $s="selected";
                                        }else{
                                            $s="";
                                        } 
                                    }else{
                                        $s="";
                                    }
                                    echo "<option value='".$val."' $s >".$val."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="year">
                            <option selected disabled value="null">-- Select Year --</option>
                            <?php
                                $s="";
                                $current_year=date("Y");
                                for($i=$current_year;$i>=1970;$i--){
                                    if($_POST['year']==$i){
                                        if($insert!=1){
                                            $s="selected";
                                        }else{
                                            $s="";
                                        } 
                                    }else{
                                        $s="";
                                    }
                                    echo '<option value="'.$i.'"'. $s .' >'.$i.'</option>';
                                }
                            ?>
                            <option value="Other year">Other year</option>
                        </select>
                    </div>
                </div>  

                <div class="col_div" >
                    <div class="col" id="div_error_select" >
                        <?php if($msg_condition!="") echo $msg_condition ?>
                    </div>
                    <div class="col"  id="div_error_select">
                        <?php if($msg_year!="") echo $msg_year ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <select name="kilometeres">
                            <option selected disabled value="null">-- Select Kilometeres --</option>
                            <?php
                                $s="";
                                foreach($array_kilometeres as $val){
                                    if($_POST['kilometeres']== $val){
                                        if($insert!=1){
                                            $s="selected";
                                        }else{
                                            $s="";
                                        } 
                                    }else{
                                        $s="";
                                    }
                                    echo "<option value='".$val."' $s >".$val."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="transmission">
                            <option selected disabled value="null">-- Select Transmission Type --</option>
                            <?php
                                $s="";
                                foreach($array_transmission as $val){
                                    if($_POST['transmission']== $val){
                                        if($insert!=1){
                                            $s="selected";
                                        }else{
                                            $s="";
                                        } 
                                    }else{
                                        $s="";
                                    }
                                    echo "<option value='".$val."' $s >".$val."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>  

                <div class="col_div" >
                    <div class="col" id="div_error_select" >
                        <?php if($msg_kilometeres!="") echo $msg_kilometeres ?>
                    </div>
                    <div class="col"  id="div_error_select">
                        <?php if($msg_transmission!="") echo $msg_transmission ?>
                    </div>
                </div>

                <div class="col_div">
                    <div class="col">
                        <select name="color">
                            <option selected disabled value="null">-- Select Color --</option>
                            <?php
                                $s="";
                                foreach($array_color as $val){
                                    if($_POST['color']== $val){
                                        if($insert!=1){
                                            $s="selected";
                                        }else{
                                            $s="";
                                        }
                                    }else{
                                        $s="";
                                    }
                                    echo "<option value='".$val."' $s >".$val."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="body">
                            <option selected disabled value="null">-- Select Body Type --</option>
                            <?php
                                $s="";
                                foreach($array_body as $val){
                                    if($_POST['body']== $val){
                                        if($insert!=1){
                                            $s="selected";
                                        }else{
                                            $s="";
                                        }
                                        
                                    }else{
                                        $s="";
                                    }
                                    echo "<option value='".$val."' $s >".$val."</option>";
                                }
                            ?> 
                        </select>
                    </div>
                </div> 

                <div class="col_div" >
                    <div class="col" id="div_error_select" >
                        <?php if($msg_color!="") echo $msg_color ?>
                    </div>
                    <div class="col"  id="div_error_select">
                        <?php if($msg_body!="") echo $msg_body ?>
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