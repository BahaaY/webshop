<html>

    <?php

        include_once "head.php"; 

        session_start();
        
        include("classes/user.php");
        include("classes/product.php");
        include("classes/connexion.php");

        $user=new user($bdd->get_link());
        $item=new product($bdd->get_link());

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

    <?php

        $username="";
        $res=$user->run_query("select * from users where unique_id='{$_SESSION['shop_unique_id']}'");
        if(mysqli_num_rows($res)>0){
            $row=mysqli_fetch_assoc($res);
            $username="Welcome ".$row['username'];
        }else{
            $username="Welcome";
        }

    ?>

    <body class="body_main">
        <!-- Header -->
        <section class="header">

            <div class="col">
                <span id="left" class="left" style='font-size:28px;font-weight:bold' ><span id="welcome"><?php if($username!="") echo $username; ?></span></span>
            </div>

            <div class="col" >
                <a href="Products.php" id="a_main">Sell</a>
            </div>

            <div class="col">
                <a href="Ads.php"  id="a_main">My Ads</a>
            </div>

            <div class="col">
                <a href="Favourite.php"  id="a_main">My Favourites</a>
            </div>

            <div class="col">
                <a href="Settings.php"  id="a_main">Settings</a>
            </div>

        </section>
            
        <i class="fa fa-bars" id="bars_open"></i>
        <i class="fa fa-minus" id="bars_close"></i>
        <i class="fa fa-refresh" id='fa_fa_refresh' onclick="refresh();"></i>

        

        <!-- Section container item -->
        <section class="div_container_items" id="div_container_items">   
            <table class="table_main" >
            <?php

                $ligne="";
                $i=0;

                $unique_id=$_SESSION['shop_unique_id'];

                foreach($array_table_name as $product_name){
                    $query_select_product="select * from $product_name where unique_id!=$unique_id";
                    $res_product=$item->run_query($query_select_product);
                    if(mysqli_num_rows($res_product)==0){
                        $n=1;
                    }else{
                        $n=0;
                        break;
                    }
                }
                if($n>0){
                    $ligne.= "
                        <tbody id='table_body_no_ads'>
                            <tr>
                                <td>
                                    <h2 style='text-align:center;font-size:50px;color:black'>No ads available.</h2>
                                </td>
                            </tr>
                        </tbody>
                    ";
                }

                $ligne.="
                    <tbody id='table_body'>
                ";

                foreach($array_table_name as $product_name){
                    $query_select_product="select * from $product_name where unique_id!=$unique_id";
                    $res_product=$item->run_query($query_select_product);
                    while($row_product=mysqli_fetch_assoc($res_product)){
                        if($i%2 == 0){
                            $ligne.= "
                                <tr>
                                    <td id='td_".$product_name."_".$row_product['ID']."' class='td_fav'>
                                        <a href='View_details_main.php?product=$product_name&id=".$row_product['ID']."' class='a_fav'>
                                            <div class='col_div' id='col_div_view_details'>
                                                <div class='col'>
                                                    <h2 class='h2_product_name'>
                            ";
                            if($product_name=='product_vehicle_motorcycle'){
                                $ligne.=$row_product['make'].' '.$row_product['model'];
                            }else{
                                $ligne.=$row_product['type'];
                            }
                            $ligne.="</h2>";
                            $query_select_image="select img from image where id_product=".$row_product['ID']." and product='$product_name'";
                            $res_image=$item->run_query($query_select_image);
                                
                            while($row_image=mysqli_fetch_assoc($res_image)){
                                $image_name=$row_image['img'];
                                $ligne.="
                                    <img src='images_items/$image_name' class='img_fav'>
                                ";
                            }
                            $ligne.="
                                            </div>
                                        </div>
                                    </a>
                                    <div class='col_div' id='col_div_view_details' style='justify-content:center'>";

                                    $query_select="select * from favourite where user_id=$unique_id and product_id=".$row_product['ID']." and product='$product_name'";
                                    $res_select=$item->run_query($query_select);
                                    if(mysqli_num_rows($res_select)>0){
                                        $ligne.="
                                            <div class='fa fa-heart' id='fav_".$product_name."_".$row_product['ID']."' style='color:red;transition: all 250ms ease-in-out;cursor:pointer;font-size:65px;' onclick=fav('$product_name','".$row_product['ID']."');></div>
                                        ";
                                    }else{
                                        $ligne.="
                                            <div class='fa fa-heart' id='fav_".$product_name."_".$row_product['ID']."' style='color:white;transition: all 250ms ease-in-out;cursor:pointer;font-size:65px' onclick=fav('$product_name','".$row_product['ID']."');></div>
                                        ";
                                    }

                                    $ligne.="
                                    </div>
                                </td>
                            ";
                        }else{
                            $ligne.= "
                                <td id='td_".$product_name."_".$row_product['ID']."' class='td_fav'>
                                    <a href='View_details_main.php?product=$product_name&id=".$row_product['ID']."' class='a_fav'>
                                        <div class='col_div' id='col_div_view_details'>
                                            <div class='col'>
                                                <h2 class='h2_product_name'>
                            ";
                            if($product_name=='product_vehicle_motorcycle'){
                                $ligne.=$row_product['make'].' '.$row_product['model'];
                            }else{
                                $ligne.=$row_product['type'];
                            }
                            $ligne.="</h2>";
                            $query_select_image="select img from image where id_product=".$row_product['ID']." and product='$product_name'";
                            $res_image=$item->run_query($query_select_image);
                                    
                            while($row_image=mysqli_fetch_assoc($res_image)){
                                $image_name=$row_image['img'];
                                $ligne.="
                                    <img src='images_items/$image_name' class='img_fav'>
                                ";
                            }
                            $ligne.="
                                            </div>
                                        </div>
                                    </a>
                                    <div class='col_div' id='col_div_view_details' style='justify-content:center'>";

                                    $query_select="select * from favourite where user_id=$unique_id and product_id=".$row_product['ID']." and product='$product_name'";
                                    $res_select=$item->run_query($query_select);
                                    if(mysqli_num_rows($res_select)>0){
                                        $ligne.="
                                            <div class='fa fa-heart' id='fav_".$product_name."_".$row_product['ID']."' style='color:red;cursor:pointer;transition: all 250ms ease-in-out;font-size:65px' onclick=fav('$product_name','".$row_product['ID']."');></div>
                                        ";
                                    }else{
                                        $ligne.="
                                            <div class='fa fa-heart' id='fav_".$product_name."_".$row_product['ID']."' style='color:white;cursor:pointer;transition: all 250ms ease-in-out;font-size:65px' onclick=fav('$product_name','".$row_product['ID']."');></div>
                                        ";
                                    }

                                    $ligne.="
                                    </div>
                                </td>
                            ";
                        }
                        $i++;
                    }
                }
                    $ligne.="
                            </tr>
                        </tbody>
                    ";
                    echo $ligne;
                ?>
            </table>
        </section>

        <!-- Section navbar -->
        <section class="navbar_left" id="navbar_left" >
            <div id="div_container" >   

                <div class="col_div">
                    <div class="col" >
                        <i class="fa fa-search" ></i>
                        <input type="text" name="input_search" id="input_search" >
                        <label id="label_search" style="padding-left: 5px;" >Search by ads name</label>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col" style="top:-15px;">
                        <select name="product" id="product">
                            <option selected disabled value="null">-- Select Product --</option>
                            <?php
                                foreach($array_product_name as $val){
                                    echo "<option value='".$val."'$s >".$val."</option>";
                                }  
                            ?>
                        </select>
                    </div>
                </div> 

            </div>
            
            <!-- div_vehicle_motorcycle -->
            <div id="div_vehicle_motorcycle" >

                <div class="col_div">
                    <div class="col">
                        <select name="make" id="make">
                            <option selected disabled value="null">-- Select Make --</option>
                            <?php 
                                $res=$item->run_query("select * from make ORDER BY name ASC ");
                                while($row=mysqli_fetch_assoc($res)){
                                    echo "<option value='".$row['name']."' $s >".$row['name']."</option>";
                                }
                                echo "<option value='Other make' $s >Other make</option>";
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col">
                        <select name="model" id="model">
                            <option selected disabled value="null">-- Select Model --</option>
                            <!-- Filled using ajax -->
                        </select>
                    </div>
                </div>  

                <div class="col_div">
                    <div class="col">
                        <select name="year" id="year">
                            <option selected disabled value="null">-- Select Year --</option>
                            <?php
                                $current_year=date("Y");
                                for($i=$current_year;$i>=1960;$i--){
                                    echo '<option value="'.$i.'"'. $s .' >'.$i.'</option>';
                                }
                            ?>
                            <option value="Other year">Other year</option>
                        </select>
                    </div>
                </div>  

                <div class="col_div">
                    <div class="col" >
                        <input type="submit" name="btn_search" id="btn_search" class="btn_search" value="Search" style="padding-right:20px" onclick="select_search('product_vehicle_motorcycle','1');">
                    </div>
                </div>  

                <div class="col_div">
                    <div class="col" >
                        <input type="button" name="btn_close_vehicle" id="btn_close_vehicle" class="btn_close_vehicle" value="Close" >
                    </div>
                    <div class="col" >
                        <input type="button" name="btn_close_vehicle" id="btn_reset" class="btn_close_vehicle" value="Reset" onclick="reset('product_vehicle_motorcycle','1');">
                    </div>
                </div> 

            </div>

            <!-- div_apartment -->
            <div id="div_apartment">

                <div class="col_div">
                    <div class="col">
                        <select name="type_apartment" id="type2">
                            <option selected disabled value="null">-- Select Type --</option>
                            <?php
                                foreach($array_type_apartment as $val){
                                    echo "<option value='".$val."'$s >".$val."</option>";
                                }  
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col" >
                        <input type="submit" name="btn_search" id="btn_search" class="btn_search" value="Search" style="padding-right:20px" onclick="select_search('product_apartment','2');">
                    </div>
                </div>  

                <div class="col_div">
                    <div class="col" >
                        <input type="button" name="btn_close_apartment" id="btn_close_apartment" class="btn_close_apartment" value="Close" >
                    </div>
                    <div class="col" >
                        <input type="button" name="btn_close_vehicle" id="btn_reset" class="btn_close_vehicle" value="Reset" onclick="reset('product_apartment','2');">
                    </div>
                </div> 

            </div>

            <!-- div_electronic_home_appliance -->
            <div id="div_electronic_home_appliance">

                <div class="col_div">
                    <div class="col">
                        <select name="type" id="type3">
                            <option selected disabled value="null" >-- Select Type --</option>
                            <?php
                                $s="";
                                foreach($array_type_electronic_home_appliance as $key=>$val){
                                    if($key=="1" || $key=="2"|| $key=="3"|| $key=="4"|| $key=="5"|| $key=="6"|| $key=="7"|| $key=="8"|| $key=="9"|| $key=="10"
                                    || $key=="11"|| $key=="12"|| $key=="13"|| $key=="14"|| $key=="15"|| $key=="16"|| $key=="17"|| $key=="18"|| $key=="19"|| $key=="20"){   
                                        echo "<option value='".$val."'$s >".$val."</option>";
                                    }else{
                                        echo "<optgroup label='".$key."'>".$key."</optgroup>";
                                    }
                                } 
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col" >
                        <input type="submit" name="btn_search" id="btn_search" class="btn_search" value="Search" style="padding-right:20px" onclick="select_search('product_electronic_home','3');">
                    </div>
                </div>  

                <div class="col_div">
                    <div class="col" >
                        <input type="button" name="btn_close_electronic" id="btn_close_electronic" class="btn_close_electronic" value="Close" >
                    </div>
                    <div class="col" >
                        <input type="button" name="btn_close_vehicle" id="btn_reset" class="btn_close_vehicle" value="Reset" onclick="reset('product_electronic_home','3');">
                    </div>
                </div> 

            </div>

            <!-- div_Home_furniture -->
            <div id="div_home_furniture">

                <div class="col_div">
                    <div class="col">
                        <select name="type" id="type4">
                            <option selected disabled value="null" >-- Select Type --</option>
                            <?php
                                $s="";
                                foreach($array_type_home_furniture as $key=>$val){
                                    if($key=="1" || $key=="2"|| $key=="3"|| $key=="4"|| $key=="5"|| $key=="6"|| $key=="7"|| $key=="8"|| $key=="9"|| $key=="10"
                                    || $key=="11"|| $key=="12"|| $key=="13"|| $key=="14"|| $key=="15"|| $key=="16"|| $key=="17"|| $key=="18"|| $key=="19"|| $key=="20"){   
                                        echo "<option value='".$val."'$s >".$val."</option>";
                                    }else{
                                        echo "<optgroup label='".$key."'>".$key."</optgroup>";
                                    }
                                } 
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col" >
                        <input type="submit" name="btn_search" id="btn_search" class="btn_search" value="Search" style="padding-right:20px" onclick="select_search('product_home_furniture','4');">
                    </div>
                </div>  

                <div class="col_div">
                    <div class="col" >
                        <input type="button" name="btn_close_home" id="btn_close_home" class="btn_close_home" value="Close" >
                    </div>
                    <div class="col" >
                        <input type="button" name="btn_close_vehicle" id="btn_reset" class="btn_close_vehicle" value="Reset" onclick="reset('product_home_furniture','4');">
                    </div>
                </div> 

            </div>

            <!-- div_laptop_tablet_computer -->
            <div id="div_laptop_tablet_computer">

                <div class="col_div">
                    <div class="col">
                        <select name="type"  id="type5">
                            <option selected disabled value="null" >-- Select Type --</option>
                            <?php
                                foreach($array_type_laptop_tablet_computer as $val){
                                    echo "<option value='".$val."'$s >".$val."</option>";
                                }  
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col" >
                        <input type="submit" name="btn_search" id="btn_search" class="btn_search" value="Search" style="padding-right:20px" onclick="select_search('product_laptop_tablet_computer','5');">
                    </div>
                </div>  

                <div class="col_div">
                    <div class="col" >
                        <input type="button" name="btn_close_laptop" id="btn_close_laptop" class="btn_close_laptop" value="Close" >
                    </div>
                    <div class="col" >
                        <input type="button" name="btn_close_vehicle" id="btn_reset" class="btn_close_vehicle" value="Reset" onclick="reset('product_laptop_tablet_computer','5');">
                    </div>
                </div> 

            </div>

            <!-- div_lands -->
            <div id="div_land">

                <div class="col_div">
                    <div class="col">
                        <select name="type" id="type6">
                            <option selected disabled value="null" >-- Select Type --</option>
                            <?php
                                foreach($array_type_land as $val){
                                    echo "<option value='".$val."'$s >".$val."</option>";
                                }  
                            ?>
                        </select>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col" >
                        <input type="submit" name="btn_search" id="btn_search" class="btn_search" value="Search" style="padding-right:20px" onclick="select_search('product_land','6');">
                    </div>
                </div>  

                <div class="col_div">
                    <div class="col" >
                        <input type="button" name="btn_close_land" id="btn_close_land" class="btn_close_land" value="Close" >
                    </div>
                    <div class="col" >
                        <input type="button" name="btn_close_vehicle" id="btn_reset" class="btn_close_vehicle" value="Reset" onclick="reset('product_land','6');">
                    </div>
                </div> 

            </div>
        </section>
    </body>
</html>