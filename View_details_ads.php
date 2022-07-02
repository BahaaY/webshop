<?php

    session_start();

    include_once "head.php"; 
    include("classes/user.php");
    include("classes/product.php");
    include("classes/connexion.php");

    $item = new product($bdd->get_link()); 
    $user = new user($bdd->get_link()); 

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

<?php

    $ligne="";

    if(isset($_GET['product']) && isset($_GET['id']) && $_GET['product']!="" && $_GET['id']!=""
        && !preg_match('/[A-Za-z]/', $_GET['id']) && !preg_match('@[\W]@', $_GET['id'])){

        if($_GET['product']=="product_vehicle_motorcycle"){

            $product='product_vehicle_motorcycle';
            $id=$_GET['id'];
            $unique_id=$_SESSION['shop_unique_id'];
            $query_select="select * from $product where ID=$id";
            $res=$item->run_query($query_select);
            if(mysqli_num_rows($res) > 0){
                $row=mysqli_fetch_array($res);
                $ligne.="
                    <html>
                        <body class='body_main'>
                        <!-- Header -->
                        <section class='header'>
                
                            <div class='col'>
                                <a href='Ads.php' id='left'>Back</a>
                            </div>
                
                            <div class='col'>
                                <span class='product_title_info_medium'>".$row['make']." &nbsp;".$row['model']."</span>
                            </div>
                
                            <div class='col'>
                                
                            </div>
                            
                        </section>
                        <section class='form' >
                        
                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav' style='text-align:center'>
                                        <div id='img_".$product."_".$row['ID']."'>";
                                    
                                            $query_vehicle_img="select * from image where id_product=".$row['ID']." and product='{$product}'";
                                            if($item->check_query($query_vehicle_img)==0){
                                                $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>"; 
                                            }
                                            foreach($item->run_query($query_vehicle_img) as $row_vehicle_img){
                                                $img = 'images_items/'.$row_vehicle_img['img'];
                                                if(file_exists($img)){
                                                    $ligne.= "<img src='images_items/". $row_vehicle_img['img'] ."' id='img_details_fav'>";  
                                                }else{
                                                    $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>";  
                                                }
                                            }

                                    $ligne.="
                                                <br>
                                                <button type='button' class='btn_upload' style='margin-top:5px;width:170px'>
                                                    <i class='fa fa-upload' id='i_upload'></i>Update image
                                                    <input type='file' name='input_image_".$product."_".$row['ID']."[]' id='input_image_".$product."_".$row['ID']."' multiple accept='.jpg, .png, .jpeg' onchange=count_img_ads('$product/".$row['ID']."') />
                                                </button>
                                            <p id='num_image_".$product."_".$row['ID']."'>No image chosen.</p>
                                        </div>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' style='margin-top:-15px;'>
                                <div class='col'>
                                    <i class='fa fa-money'></i>
                                    <input type='text' name='input_price_lb' id='input_price_lb_".$product."_".$row['ID']."' value='".$row['price_lb'] ."'>
                                    <label id='label_price_lb'>Price in LB</label>
                                </div>
                                <div class='col'>
                                    <i class='fa fa-dollar'></i>
                                    <input type='text' name='input_price_usd' id='input_price_usd_".$product."_".$row['ID']."' value='".$row['price_lb'] ."' >
                                    <label id='label_price_usd'>Price in USD</label>
                                </div>
                            </div> 

                            <div class='col_div' >
                                <div class='col' id='div_error' >
                                    <div class='div_error_ads' id='div_error_price_lb_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                                <div class=col  id='div_error'>
                                    <div class='div_error_ads' id='div_error_price_usd_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class='col_div'>
                                <div class='col'>
                                    <i class='fa fa-comment'></i>
                                    <input type='text' name='input_title' id='input_title_".$product."_".$row['ID']."' value='".$row['title'] ."'>
                                    <label id='label_title'>Title</label>
                                </div>
                                <div class='col'>
                                    <i class='fa fa-comment'></i>
                                    <input type='text' name='input_description' id='input_description_".$product."_".$row['ID']."' value='".$row['description'] ."' >
                                    <label id='label_description'>Description</label>
                                </div>
                            </div> 

                            <div class='col_div' >
                                <div class='col' id='div_error' >
                                    <div class='div_error_ads' id='div_error_title_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                                <div class=col  id='div_error'>
                                    <div class='div_error_ads' id='div_error_description_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class='col_div'>
                                <div class='col'>
                                    <span id='span_name'>Condition</span>
                                    <select name='condition' id='condition_".$product."_".$row['ID']."' >
                                        <option selected disabled value='null'>-- Select Condition --</option>";
                                            $s='';
                                            foreach($array_condition_vehicle_motorcycle as $val){
                                                if($row['cond']== $val){
                                                    $s="selected";
                                                }else{
                                                    $s='';
                                                }
                                                $ligne.="<option value='".$val."' $s >".$val."</option>";
                                            }
                                        $ligne.="
                                    </select>
                                </div>
                                <div class='col'>
                                    <span id='span_name'>Year</span>
                                    <select name='year' id='year_".$product."_".$row['ID']."' >
                                        <option selected disabled value='null'>-- Select Year --</option>";
                                            $s="";
                                            $current_year=date("Y");
                                            for($i=$current_year;$i>=1970;$i--){
                                                if($row['year']==$i){
                                                    $s="selected";
                                                }else{
                                                    $s="";
                                                }
                                                $ligne.="<option value='".$i."' $s >".$i."</option>";
                                            }
                                        $ligne.="
                                    </select>
                                </div>
                            </div>

                            <div class='col_div'>
                                <div class='col'>
                                    <span id='span_name'>Kilometeres</span>
                                    <select name='kilometeres' id='kilometeres_".$product."_".$row['ID']."'>
                                        <option selected disabled value='null'>-- Select kilometeres --</option>";
                                            $s='';
                                            foreach($array_kilometeres as $val){
                                                if($row['kilometere']== $val){
                                                    $s="selected";
                                                }else{
                                                    $s='';
                                                }
                                                $ligne.="<option value='".$val."' $s >".$val."</option>";
                                            }
                                        $ligne.="
                                    </select>
                                </div>
                                <div class='col'>
                                    <span id='span_name'>Transmission type</span>
                                    <select name='transmission' id='transmission_".$product."_".$row['ID']."'>
                                        <option selected disabled value='null'>-- Select transmission --</option>";
                                            $s='';
                                            foreach($array_transmission as $val){
                                                if($row['trans']== $val){
                                                    $s="selected";
                                                }else{
                                                    $s='';
                                                }
                                                $ligne.="<option value='".$val."' $s >".$val."</option>";
                                            }
                                        $ligne.="
                                    </select>
                                </div>
                            </div>

                            <div class='col_div'>
                                <div class='col'>
                                    <span id='span_name'>Color</span>
                                    <select name='color' id='color_".$product."_".$row['ID']."'>
                                        <option selected disabled value='null'>-- Select color --</option>";
                                            $s='';
                                            foreach($array_color as $val){
                                                if($row['color']== $val){
                                                    $s="selected";
                                                }else{
                                                    $s='';
                                                }
                                                $ligne.="<option value='".$val."' $s >".$val."</option>";
                                            }
                                        $ligne.="
                                    </select>
                                </div>
                                <div class='col'>
                                    <span id='span_name'>Body type</span>
                                    <select name='body' id='body_".$product."_".$row['ID']."'>
                                        <option selected disabled value='null'>-- Select body type --</option>";
                                            $s='';
                                            foreach($array_body as $val){
                                                if($row['body']== $val){
                                                    $s="selected";
                                                }else{
                                                    $s='';
                                                }
                                                $ligne.="<option value='".$val."' $s >".$val."</option>";
                                            }
                                        $ligne.="
                                    </select>
                                </div>
                            </div>

                            <div class='col_div' style='margin-top:10px'>
                                <div class='col'>
                                    <i class='fa fa-map-marker' ></i>
                                    <input type='text' name='input_location' id='input_location_".$product."_".$row['ID']."' value='".$row['location']."' >
                                    <label id='label_location'>Location</label>
                                </div>
                            </div> 

                            <div class='col_div' >
                                <div class='col' id='div_error' >
                                    <div class='div_error_ads' id='div_error_location_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class='col_div' style='margin-top:-10px'>
                                <div class='col'>
                                    <input type='submit' name='btn_sell' value='Update product' id='update_".$product."_".$row['ID']."' onclick=update('$product','".$row['ID']."')>
                                </div>
                            </div> 

                        </section>
                        </body>
                    </html>
                ";

            }else{
                $ligne.=security_func();
            }

        }else if($_GET['product']=="product_apartment"){
            $id=$_GET['id'];
            $product=$_GET['product'];
            $unique_id=$_SESSION['shop_unique_id'];
            $query_select="select * from $product where ID=$id ";
            $res=$item->run_query($query_select);
            if(mysqli_num_rows($res) > 0){
                $row=mysqli_fetch_array($res);
                $ligne.="
                    <html>
                        <body class='body_main' >
                        <!-- Header -->
                        <section class='header'>
                
                            <div class='col'>
                                <a href='Ads.php' id='left'>Back</a>
                            </div>
                
                            <div class='col'>
                                <span class='product_title_info_large'>".$row['type']."</span>
                            </div>
                
                            <div class='col'>
                                
                            </div>
                            
                        </section>
                        <section class='form' >
                        
                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav' style='text-align:center'>
                                        <div id='img_".$product."_".$row['ID']."'>";
                                    
                                            $query_vehicle_img="select * from image where id_product=".$row['ID']." and product='{$product}'";
                                            if($item->check_query($query_vehicle_img)==0){
                                                $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>"; 
                                            }
                                            foreach($item->run_query($query_vehicle_img) as $row_vehicle_img){
                                                $img = 'images_items/'.$row_vehicle_img['img'];
                                                if(file_exists($img)){
                                                    $ligne.= "<img src='images_items/". $row_vehicle_img['img'] ."' id='img_details_fav'>";  
                                                }else{
                                                    $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>";  
                                                }
                                            }

                                    $ligne.="
                                                <br>
                                                <button type='button' class='btn_upload' style='margin-top:5px;width:170px'>
                                                    <i class='fa fa-upload' id='i_upload'></i>Update image
                                                    <input type='file' name='input_image_".$product."_".$row['ID']."[]' id='input_image_".$product."_".$row['ID']."' multiple accept='.jpg, .png, .jpeg' onchange=count_img_ads('$product/".$row['ID']."') />
                                                </button>
                                            <p id='num_image_".$product."_".$row['ID']."'>No image chosen.</p>
                                        </div>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' style='margin-top:-15px;'>
                                <div class='col'>
                                    <i class='fa fa-money'></i>
                                    <input type='text' name='input_price_lb' id='input_price_lb_".$product."_".$row['ID']."' value='".$row['price_lb'] ."'>
                                    <label id='label_price_lb'>Price in LB</label>
                                </div>
                                <div class='col'>
                                    <i class='fa fa-dollar'></i>
                                    <input type='text' name='input_price_usd' id='input_price_usd_".$product."_".$row['ID']."' value='".$row['price_lb'] ."' >
                                    <label id='label_price_usd'>Price in USD</label>
                                </div>
                            </div> 

                            <div class='col_div' >
                                <div class='col' id='div_error' >
                                    <div class='div_error_ads' id='div_error_price_lb_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                                <div class=col  id='div_error'>
                                    <div class='div_error_ads' id='div_error_price_usd_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class='col_div'>
                                <div class='col'>
                                    <i class='fa fa-comment'></i>
                                    <input type='text' name='input_title' id='input_title_".$product."_".$row['ID']."' value='".$row['title'] ."'>
                                    <label id='label_title'>Title</label>
                                </div>
                                <div class='col'>
                                    <i class='fa fa-comment'></i>
                                    <input type='text' name='input_description' id='input_description_".$product."_".$row['ID']."' value='".$row['description'] ."' >
                                    <label id='label_description'>Description</label>
                                </div>
                            </div> 

                            <div class='col_div' >
                                <div class='col' id='div_error' >
                                    <div class='div_error_ads' id='div_error_title_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                                <div class=col  id='div_error'>
                                    <div class='div_error_ads' id='div_error_description_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class='col_div'>
                                <div class='col'>
                                    <span id='span_name'>Payment methode</span>
                                    <select name='payment' id='payment_".$product."_".$row['ID']."'>
                                        <option selected disabled value='null'>-- Select Payment Method --</option>";
                                            $s='';
                                            foreach($array_payment as $val){
                                                if($row['payment']== $val){
                                                    $s="selected";
                                                }else{
                                                    $s='';
                                                }
                                                $ligne.="<option value='".$val."' $s >".$val."</option>";
                                            }
                                        $ligne.="
                                    </select>
                                </div>
                                <div class='col'>
                                    <span id='span_name'>Condition</span>
                                    <select name='condition' id='condition_".$product."_".$row['ID']."'>
                                        <option selected disabled value='null'>-- Select Condition --</option>";
                                            $s='';
                                            foreach($array_condition_apartment as $val){
                                                if($row['cond']== $val){
                                                    $s="selected";
                                                }else{
                                                    $s='';
                                                }
                                                $ligne.="<option value='".$val."' $s >".$val."</option>";
                                            }
                                        $ligne.="
                                    </select>
                                </div>
                            </div>

                            <div class='col_div'>
                                <div class='col'>
                                    <span id='span_name'>Bedroom number</span>
                                    <select name='bedroom' id='bedroom_nb_".$product."_".$row['ID']."'>
                                        <option selected disabled value='null'>-- Select Bedroom Number --</option>";
                                            $s='';
                                            foreach($array_bedroom_nb as $val){
                                                if($row['bedroom_nb']== $val){
                                                    $s="selected";
                                                }else{
                                                    $s='';
                                                }
                                                $ligne.="<option value='".$val."' $s >".$val."</option>";
                                            }
                                        $ligne.="
                                    </select>
                                </div>
                                <div class='col'>
                                    <span id='span_name'>Bethroom number</span>
                                    <select name='bethroom' id='bethroom_nb_".$product."_".$row['ID']."'>
                                        <option selected disabled value='null'>-- Select Bethroom Number --</option>";
                                            $s='';
                                            foreach($array_bethroom_nb as $val){
                                                if($row['bethroom_nb']== $val){
                                                    $s="selected";
                                                }else{
                                                    $s='';
                                                }
                                                $ligne.="<option value='".$val."' $s >".$val."</option>";
                                            }
                                        $ligne.="
                                    </select>
                                </div>
                            </div>

                            <div class='col_div'>
                                <div class='col'>
                                    <span id='span_name'>Floor number</span>
                                    <select name='floor' id='floor_nb_".$product."_".$row['ID']."'>
                                        <option selected disabled value='null'>-- Select Floor Number --</option>";
                                            $s='';
                                            foreach($array_floor_nb as $val){
                                                if($row['floor_nb']== $val){
                                                    $s="selected";
                                                }else{
                                                    $s='';
                                                }
                                                $ligne.="<option value='".$val."' $s >".$val."</option>";
                                            }
                                        $ligne.="
                                    </select>
                                </div>
                                <div class='col' style='top:20px'>
                                    <i class='fa fa-text-width'></i>
                                    <input type='text' name='input_size' id='input_size_".$product."_".$row['ID']."' value='".$row['size'] ."' >
                                    <label id='label_size'>Size</label>
                                </div>
                            </div>

                            <div class='col_div' >
                                <div class='col' id='div_error' style='top:19px' >
                                
                                </div>
                                <div class='col' id='div_error' style='top:19px' >
                                    <div class='div_error_ads' id='div_error_size_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class='col_div' style='margin-top:10px'>
                                
                                <div class='col'>
                                    <i class='fa fa-map-marker' ></i>
                                    <input type='text' name='input_location' id='input_location_".$product."_".$row['ID']."' value='".$row['location']."' >
                                    <label id='label_location'>Location</label>
                                </div>
                            </div>

                            <div class='col_div' >
                                <div class='col' id='div_error' >
                                    <div class='div_error_ads' id='div_error_location_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class='col_div' style='margin-top:-10px'>
                                <div class='col'>
                                    <input type='submit' name='btn_sell' value='Update product' id='update_".$product."_".$row['ID']."' onclick=update('$product','".$row['ID']."')>
                                </div>
                            </div> 

                        </section>

                        </body>
                    </html>
                ";

            }else{
                $ligne.=security_func();
            }

        }else if($_GET['product']=="product_electronic_home" || $_GET['product']=="product_home_furniture"
            || $_GET['product']=="product_laptop_tablet_computer"){
                if($_GET['product']=="product_electronic_home"){
                    $product='product_electronic_home';
                }else if($_GET['product']=="product_home_furniture"){
                    $product='product_home_furniture';
                }else if($_GET['product']=="product_laptop_tablet_computer"){
                    $product='product_laptop_tablet_computer';
                }
                $id=$_GET['id'];
                $unique_id=$_SESSION['shop_unique_id'];
                $query_select="select * from $product where ID=$id ";
                $res=$item->run_query($query_select);
                if(mysqli_num_rows($res) > 0){
                    $row=mysqli_fetch_array($res);
                    $ligne.="
                        <html>
                            <body class='body_main' >
                            <!-- Header -->
                            <section class='header'>
                    
                                <div class='col'>
                                    <a href='Ads.php' id='left'>Back</a>
                                </div>
                    
                                <div class='col'>
                                    <span class='product_title_info_large'>".$row['type']."</span>
                                </div>
                    
                                <div class='col'>
                                    
                                </div>
                                
                            </section>
                            <section class='form' >
                        
                                <div class='col_div' id='col_div_view_details'>

                                    <div class='col'>
                                        <div id='div_container_details_fav' style='text-align:center'>
                                            <div id='img_".$product."_".$row['ID']."'>";
                                        
                                                $query_vehicle_img="select * from image where id_product=".$row['ID']." and product='{$product}'";
                                                if($item->check_query($query_vehicle_img)==0){
                                                    $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>"; 
                                                }
                                                foreach($item->run_query($query_vehicle_img) as $row_vehicle_img){
                                                    $img = 'images_items/'.$row_vehicle_img['img'];
                                                    if(file_exists($img)){
                                                        $ligne.= "<img src='images_items/". $row_vehicle_img['img'] ."' id='img_details_fav'>";  
                                                    }else{
                                                        $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>";  
                                                    }
                                                }

                                        $ligne.="
                                                    <br>
                                                    <button type='button' class='btn_upload' style='margin-top:5px;width:170px'>
                                                        <i class='fa fa-upload' id='i_upload'></i>Update image
                                                        <input type='file' name='input_image_".$product."_".$row['ID']."[]' id='input_image_".$product."_".$row['ID']."' multiple accept='.jpg, .png, .jpeg' onchange=count_img_ads('$product/".$row['ID']."') />
                                                    </button>
                                                <p id='num_image_".$product."_".$row['ID']."'>No image chosen.</p>
                                            </div>
                                        </div>
                                    </div>

                                </div> 

                                <div class='col_div' style='margin-top:-15px;'>
                                    <div class='col'>
                                        <i class='fa fa-money'></i>
                                        <input type='text' name='input_price_lb' id='input_price_lb_".$product."_".$row['ID']."' value='".$row['price_lb'] ."'>
                                        <label id='label_price_lb'>Price in LB</label>
                                    </div>
                                    <div class='col'>
                                        <i class='fa fa-dollar'></i>
                                        <input type='text' name='input_price_usd' id='input_price_usd_".$product."_".$row['ID']."' value='".$row['price_lb'] ."' >
                                        <label id='label_price_usd'>Price in USD</label>
                                    </div>
                                </div> 

                                <div class='col_div' >
                                    <div class='col' id='div_error' >
                                        <div class='div_error_ads' id='div_error_price_lb_".$product."_".$row['ID']."'>
                                            
                                        </div>
                                    </div>
                                    <div class=col  id='div_error'>
                                        <div class='div_error_ads' id='div_error_price_usd_".$product."_".$row['ID']."'>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class='col_div'>
                                    <div class='col'>
                                        <i class='fa fa-comment'></i>
                                        <input type='text' name='input_title' id='input_title_".$product."_".$row['ID']."' value='".$row['title'] ."'>
                                        <label id='label_title'>Title</label>
                                    </div>
                                    <div class='col'>
                                        <i class='fa fa-comment'></i>
                                        <input type='text' name='input_description' id='input_description_".$product."_".$row['ID']."' value='".$row['description'] ."' >
                                        <label id='label_description'>Description</label>
                                    </div>
                                </div> 

                                <div class='col_div' >
                                    <div class='col' id='div_error' >
                                        <div class='div_error_ads' id='div_error_title_".$product."_".$row['ID']."'>
                                            
                                        </div>
                                    </div>
                                    <div class=col  id='div_error'>
                                        <div class='div_error_ads' id='div_error_description_".$product."_".$row['ID']."'>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class='col_div'>
                                    <div class='col'>
                                        <span id='span_name'>Condition</span>
                                        <select name='condition' id='condition_".$product."_".$row['ID']."'>
                                            <option selected disabled value='null'>-- Select Condition --</option>";
                                                $s='';
                                                foreach($array_condition_vehicle_motorcycle  as $val){
                                                    if($row['cond']== $val){
                                                        $s="selected";
                                                    }else{
                                                        $s='';
                                                    }
                                                    $ligne.="<option value='".$val."' $s >".$val."</option>";
                                                }
                                            $ligne.="
                                        </select>
                                    </div>
                                    <div class='col' style='top:20px'>
                                        <i class='fa fa-map-marker' ></i>
                                        <input type='text' name='input_location' id='input_location_".$product."_".$row['ID']."' value='".$row['location']."' >
                                        <label id='label_location'>Location</label>
                                    </div>
                                </div>

                                <div class='col_div' >
                                    <div class='col' id='div_error' style='margin-top:20px'>
                                        
                                    </div>
                                    <div class='col' id='div_error' style='top:19px' >
                                        <div class='div_error_ads' id='div_error_location_".$product."_".$row['ID']."'>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class='col_div' style='margin-top:-25px'>
                                    <div class='col' >
                                        <input type='submit' name='btn_sell' value='Update product' id='update_".$product."_".$row['ID']."' onclick=update('$product','".$row['ID']."')>
                                    </div>
                                </div> 

                            </section>

                            </body>
                        </html>
                    ";

                }else{
                    $ligne.=security_func();
                }
        
                

            
        }else if($_GET['product']=="product_land"){
            $product='product_land';
            $id=$_GET['id'];
            $unique_id=$_SESSION['shop_unique_id'];
            $query_select="select * from $product where ID=$id ";
            $res=$item->run_query($query_select);
            if(mysqli_num_rows($res) > 0){
                $row=mysqli_fetch_array($res);
                $ligne.="
                    <html>
                        <body class='body_main' >
                        <!-- Header -->
                        <section class='header'>
                
                            <div class='col'>
                                <a href='Ads.php' id='left'>Back</a>
                            </div>
                
                            <div class='col'>
                                <span class='product_title_info_large'>".$row['type']."</span>
                            </div>
                
                            <div class='col'>
                                
                            </div>
                            
                        </section>
                        <section class='form'>
                        
                        <div class='col_div' id='col_div_view_details'>

                            <div class='col'>
                                    <div id='div_container_details_fav' style='text-align:center'>
                                        <div id='img_".$product."_".$row['ID']."'>";
                                    
                                            $query_vehicle_img="select * from image where id_product=".$row['ID']." and product='{$product}'";
                                            if($item->check_query($query_vehicle_img)==0){
                                                $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>"; 
                                            }
                                            foreach($item->run_query($query_vehicle_img) as $row_vehicle_img){
                                                $img = 'images_items/'.$row_vehicle_img['img'];
                                                if(file_exists($img)){
                                                    $ligne.= "<img src='images_items/". $row_vehicle_img['img'] ."' id='img_details_fav'>";  
                                                }else{
                                                    $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>";  
                                                }
                                            }

                                    $ligne.="
                                                <br>
                                                <button type='button' class='btn_upload' style='margin-top:5px;width:170px'>
                                                    <i class='fa fa-upload' id='i_upload'></i>Update image
                                                    <input type='file' name='input_image_".$product."_".$row['ID']."[]' id='input_image_".$product."_".$row['ID']."' multiple accept='.jpg, .png, .jpeg' onchange=count_img_ads('$product/".$row['ID']."') />
                                                </button>
                                            <p id='num_image_".$product."_".$row['ID']."'>No image chosen.</p>
                                        </div>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' style='margin-top:-15px;'>
                                <div class='col'>
                                    <i class='fa fa-money'></i>
                                    <input type='text' name='input_price_lb' id='input_price_lb_".$product."_".$row['ID']."' value='".$row['price_lb'] ."'>
                                    <label id='label_price_lb'>Price in LB</label>
                                </div>
                                <div class='col'>
                                    <i class='fa fa-dollar'></i>
                                    <input type='text' name='input_price_usd' id='input_price_usd_".$product."_".$row['ID']."' value='".$row['price_lb'] ."' >
                                    <label id='label_price_usd'>Price in USD</label>
                                </div>
                            </div> 

                            <div class='col_div' >
                                <div class='col' id='div_error' >
                                    <div class='div_error_ads' id='div_error_price_lb_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                                <div class=col  id='div_error'>
                                    <div class='div_error_ads' id='div_error_price_usd_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class='col_div'>
                                <div class='col'>
                                    <i class='fa fa-comment'></i>
                                    <input type='text' name='input_title' id='input_title_".$product."_".$row['ID']."' value='".$row['title'] ."'>
                                    <label id='label_title'>Title</label>
                                </div>
                                <div class='col'>
                                    <i class='fa fa-comment'></i>
                                    <input type='text' name='input_description' id='input_description_".$product."_".$row['ID']."' value='".$row['description'] ."' >
                                    <label id='label_description'>Description</label>
                                </div>
                            </div> 

                            <div class='col_div' >
                                <div class='col' id='div_error' >
                                    <div class='div_error_ads' id='div_error_title_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                                <div class=col  id='div_error'>
                                    <div class='div_error_ads' id='div_error_description_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class='col_div'>
                                <div class='col'>
                                    <i class='fa fa-text-width'></i>
                                    <input type='text' name='input_size' id='input_size_".$product."_".$row['ID']."' value='".$row['size'] ."' >
                                    <label id='label_size'>Size</label>
                                </div>
                                <div class='col'>
                                    <i class='fa fa-map-marker' ></i>
                                    <input type='text' name='input_location' id='input_location_".$product."_".$row['ID']."' value='".$row['location']."' >
                                    <label id='label_location'>Location</label>
                                </div>
                            </div>

                            <div class='col_div' >
                                <div class='col' id='div_error' >
                                    <div class='div_error_ads' id='div_error_size_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                                <div class='col' id='div_error' >
                                    <div class='div_error_ads' id='div_error_location_".$product."_".$row['ID']."'>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class='col_div' style='margin-top:-10px'> 
                                <div class='col'>
                                    <input type='submit' name='btn_sell' value='Update product' id='update_".$product."_".$row['ID']."' onclick=update('$product','".$row['ID']."')>
                                </div>
                            </div> 

                        </section>
        
                        </body>
                    </html>
                ";
            }else{
                $ligne.=security_func();
            }
        }else{
            $ligne.=security_func();
        }
    }else{
        $ligne.=security_func();
    }

    function security_func(){
        $ligne="";
        $ligne.="
            <html>
                <body class='body_main' >
                    <!-- Header -->
                    <section class='header'>
            
                        <div class='col'>
                            <a href='Ads.php' id='left'>Back</a>
                        </div>
            
                        <div class='col'>
                            <span class='product_title_info_large'>Can't view ad details</span>
                        </div>  
            
                        <div class='col'>
                            
                        </div>
                        
                    </section>
                    <section class='form' style='width:40%'>

                        <div class='col_div' id='col_div_view_details'>

                            <div class='col'>
                                <div id='view_details_fav_no_product_found'>
                                    <h2>Can't view ad details</h2>
                                </div>
                            </div>

                        </div> 

                    </section>

                </body>
            </html>
        ";
        return $ligne;
    }

    echo $ligne;
?>