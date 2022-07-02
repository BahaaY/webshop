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
                $user_id=$row['unique_id'];
                $query_select_user="select * from users where unique_id=$user_id";
                $res_user=$item->run_query($query_select_user);
                $row_user=mysqli_fetch_array($res_user);
                $ligne.="
                    <html>
                        <body class='body_main' >
                        <!-- Header -->
                        <section class='header'>
                
                            <div class='col'>
                                <a href='Main.php' id='left'>Back</a>
                            </div>
                
                            <div class='col'>
                                <span class='product_title_info_medium'>".$row['make']." &nbsp;".$row['model']."</span>
                            </div>
                
                            <div class='col'>
                                
                            </div>
                            
                        </section>
                        <section class='form' style='width:40%;'>
                        
                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav' style='text-align:center'>";

                                    $query_vehicle_img="select * from image where id_product=".$row['ID']." and product='{$product}'";
                                    if($item->check_query($query_vehicle_img)==0){
                                        $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>"; 
                                    }
                                    foreach($item->run_query($query_vehicle_img) as $row_vehicle_img){
                                        $img = 'images_items/'.$row_vehicle_img['img'];
                                        if(file_exists($img)){
                                            $ligne.= "<img src='images_items/". $row_vehicle_img['img'] ."' id='img_details_fav'>";  
                                        }else{
                                            $ligne.= "<img src='images/error_img.jpg' width='70px' id='img_details_fav'>";  
                                        }
                                    }

                                    $ligne.="
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Price in lb</h2>
                                        <h3 id='h3_view_details_fav'>".number_format($row['price_lb'])."</h3>
                                    </div>
                                </div>
                                    
                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Price in usd</h2>
                                        <h3 id='h3_view_details_fav'>".number_format($row['price_usd'])."</h3>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Title</h2>
                                        <h3 id='h3_view_details_fav'>".$row['title']."</h3>
                                    </div>
                                </div>

                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Description</h2>
                                        <h3 id='h3_view_details_fav'>".$row['description']."</h3>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Condition</h2>
                                        <h3 id='h3_view_details_fav'>".$row['cond']."</h3>
                                    </div>
                                </div>

                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Year</h2>
                                        <h3 id='h3_view_details_fav'>".$row['year']."</h3>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Kilometeres</h2>
                                        <h3 id='h3_view_details_fav'>".$row['kilometere']."</h3>
                                    </div>
                                </div>

                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Type</h2>
                                        <h3 id='h3_view_details_fav'>".$row['trans']."</h3>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Color</h2>
                                        <h3 id='h3_view_details_fav'>".$row['color']."</h3>
                                    </div>
                                </div>

                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Body type</h2>
                                        <h3 id='h3_view_details_fav'>".$row['body']."</h3>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' >

                                <div class='col' style='text-align:center'>
                                    <div id='div_container_details_fav'>
                                        <u><h2 id='h2_view_details_fav' style='font-size:35px'>Contact</h2></u>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Username</h2>
                                        <h3 id='h3_view_details_fav'>".$row_user['username']."</h3>
                                    </div>
                                </div>
                                    
                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Phone</h2>
                                        <h3 id='h3_view_details_fav'>".$row_user['phone']."</h3>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Age</h2>";
                                        $birth = explode('-', $row_user['birthdate']);
                                        $user_year= $birth[0];
                                        $current_year=date("Y");
                                        $age=$current_year-$user_year;
                                        $ligne.="<h3 id='h3_view_details_fav'>$age</h3>
                                    </div>
                                </div>

                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Location</h2>
                                        <h3 id='h3_view_details_fav'>".$row['location']."</h3>
                                    </div>
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
                $user_id=$row['unique_id'];
                $query_select_user="select * from users where unique_id=$user_id";
                $res_user=$item->run_query($query_select_user);
                $row_user=mysqli_fetch_array($res_user);
                $username=$row_user['username'];
                $phone=$row_user['phone'];
                $ligne.="
                    <html>
                        <body class='body_main' >
                        <!-- Header -->
                        <section class='header'>
                
                            <div class='col'>
                                <a href='Main.php' id='left'>Back</a>
                            </div>
                
                            <div class='col'>
                                <span class='product_title_info_large'>".$row['type']."</span>
                            </div>
                
                            <div class='col'>
                                
                            </div>
                            
                        </section>
                        <section class='form' style='width:40%'>

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav' style='text-align:center'>";

                                    $query_vehicle_img="select * from image where id_product=".$row['ID']." and product='{$product}'";
                                    if($item->check_query($query_vehicle_img)==0){
                                        $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>"; 
                                    }
                                    foreach($item->run_query($query_vehicle_img) as $row_vehicle_img){
                                        $img = 'images_items/'.$row_vehicle_img['img'];
                                        if(file_exists($img)){
                                            $ligne.= "<img src='images_items/". $row_vehicle_img['img'] ."' id='img_details_fav' >";  
                                        }else{
                                            $ligne.= "<img src='images/error_img.jpg' width='70px' id='img_details_fav'>";  
                                        }
                                    }

                                    $ligne.="
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Price in lb</h2>
                                        <h3 id='h3_view_details_fav'>".number_format($row['price_lb'])."</h3>
                                    </div>
                                </div>
                                    
                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Price in usd</h2>
                                        <h3 id='h3_view_details_fav'>".number_format($row['price_usd'])."</h3>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Title</h2>
                                        <h3 id='h3_view_details_fav'>".$row['title']."</h3>
                                    </div>
                                </div>

                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Description</h2>
                                        <h3 id='h3_view_details_fav'>".$row['description']."</h3>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Bedroom nb</h2>
                                        <h3 id='h3_view_details_fav'>".$row['bedroom_nb']."</h3>
                                    </div>
                                </div>

                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Bethroom nb</h2>
                                        <h3 id='h3_view_details_fav'>".$row['bethroom_nb']."</h3>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Floor nb</h2>
                                        <h3 id='h3_view_details_fav'>".$row['floor_nb']."</h3>
                                    </div>
                                </div>

                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Condition</h2>
                                        <h3 id='h3_view_details_fav'>".$row['cond']."</h3>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Size</h2>
                                        <h3 id='h3_view_details_fav'>".$row['size']."</h3>
                                    </div>
                                </div>

                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Payment</h2>
                                        <h3 id='h3_view_details_fav'>".$row['payment']."</h3>
                                    </div>
                                </div>

                            </div>

                            <div class='col_div' >

                                <div class='col' style='text-align:center'>
                                    <div id='div_container_details_fav'>
                                        <u><h2 id='h2_view_details_fav' style='font-size:35px'>Contact</h2></u>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Username</h2>
                                        <h3 id='h3_view_details_fav'>$username</h3>
                                    </div>
                                </div>
                                    
                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Phone</h2>
                                        <h3 id='h3_view_details_fav'>$phone</h3>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Age</h2>";
                                        $birth = explode('-', $row_user['birthdate']);
                                        $user_year= $birth[0];
                                        $current_year=date("Y");
                                        $age=$current_year-$user_year;
                                        $ligne.="<h3 id='h3_view_details_fav'>$age</h3>
                                    </div>
                                </div>

                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Location</h2>
                                        <h3 id='h3_view_details_fav'>".$row['location']."</h3>
                                    </div>
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
                    $user_id=$row['unique_id'];
                    $query_select_user="select * from users where unique_id=$user_id";
                    $res_user=$item->run_query($query_select_user);
                    $row_user=mysqli_fetch_array($res_user);
                    $username=$row_user['username'];
                    $phone=$row_user['phone'];
                    $ligne.="
                        <html>
                            <body class='body_main' >
                            <!-- Header -->
                            <section class='header'>
                    
                                <div class='col'>
                                    <a href='Main.php' id='left'>Back</a>
                                </div>
                    
                                <div class='col'>
                                    <span class='product_title_info_large'>".$row['type']."</span>
                                </div>
                    
                                <div class='col'>
                                    
                                </div>
                                
                            </section>
                            <section class='form' style='width:40%'>

                                <div class='col_div' id='col_div_view_details'>

                                    <div class='col'>
                                        <div id='div_container_details_fav' style='text-align:center'>";

                                        $query_vehicle_img="select * from image where id_product=".$row['ID']." and product='{$product}'";
                                        if($item->check_query($query_vehicle_img)==0){
                                            $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>"; 
                                        }
                                        foreach($item->run_query($query_vehicle_img) as $row_vehicle_img){
                                            $img = 'images_items/'.$row_vehicle_img['img'];
                                            if(file_exists($img)){
                                                $ligne.= "<img src='images_items/". $row_vehicle_img['img'] ."' id='img_details_fav' >";  
                                            }else{
                                                $ligne.= "<img src='images/error_img.jpg' width='70px' id='img_details_fav'>";  
                                            }
                                        }

                                        $ligne.="
                                        </div>
                                    </div>

                                </div> 
            
                                <div class='col_div' id='col_div_view_details'>

                                    <div class='col'>
                                        <div id='div_container_details_fav'>
                                            <h2 id='h2_view_details_fav'>Price in lb</h2>
                                            <h3 id='h3_view_details_fav'>".number_format($row['price_lb'])."</h3>
                                        </div>
                                    </div>
                                        
                                    <div class='col'>
                                        
                                    </div>

                                    <div class='col'>
                                        <div id='div_container_details_fav'>
                                            <h2 id='h2_view_details_fav'>Price in usd</h2>
                                            <h3 id='h3_view_details_fav'>".number_format($row['price_usd'])."</h3>
                                        </div>
                                    </div>

                                </div> 
            
                                <div class='col_div' id='col_div_view_details'>
            
                                    <div class='col'>
                                        <div id='div_container_details_fav'>
                                            <h2 id='h2_view_details_fav'>Title</h2>
                                            <h3 id='h3_view_details_fav'>".$row['title']."</h3>
                                        </div>
                                    </div>
            
                                    <div class='col'>
                                        
                                    </div>
            
                                    <div class='col'>
                                        <div id='div_container_details_fav'>
                                            <h2 id='h2_view_details_fav'>Description</h2>
                                            <h3 id='h3_view_details_fav'>".$row['description']."</h3>
                                        </div>
                                    </div>
            
                                </div> 
            
                                <div class='col_div' id='col_div_view_details'>
            
                                    <div class='col'>
                                        <div id='div_container_details_fav'>
                                            <h2 id='h2_view_details_fav'>Condition</h2>
                                            <h3 id='h3_view_details_fav'>".$row['cond']."</h3>
                                        </div>
                                    </div>
            
                                </div> 

                                <div class='col_div'>

                                    <div class='col' style='text-align:center'>
                                        <div id='div_container_details_fav'>
                                            <u><h2 id='h2_view_details_fav' style='font-size:35px'>Contact</h2></u>
                                        </div>
                                    </div>

                                </div> 

                                <div class='col_div' id='col_div_view_details'>

                                    <div class='col'>
                                        <div id='div_container_details_fav'>
                                            <h2 id='h2_view_details_fav'>Username</h2>
                                            <h3 id='h3_view_details_fav'>$username</h3>
                                        </div>
                                    </div>
                                        
                                    <div class='col'>
                                        
                                    </div>

                                    <div class='col'>
                                        <div id='div_container_details_fav'>
                                            <h2 id='h2_view_details_fav'>Phone</h2>
                                            <h3 id='h3_view_details_fav'>$phone</h3>
                                        </div>
                                    </div>

                                </div> 

                                <div class='col_div' id='col_div_view_details'>

                                    <div class='col'>
                                        <div id='div_container_details_fav'>
                                            <h2 id='h2_view_details_fav'>Age</h2>";
                                            $birth = explode('-', $row_user['birthdate']);
                                            $user_year= $birth[0];
                                            $current_year=date("Y");
                                            $age=$current_year-$user_year;
                                            $ligne.="<h3 id='h3_view_details_fav'>$age</h3>
                                        </div>
                                    </div>

                                    <div class='col'>
                                        
                                    </div>

                                    <div class='col'>
                                        <div id='div_container_details_fav'>
                                            <h2 id='h2_view_details_fav'>Location</h2>
                                            <h3 id='h3_view_details_fav'>".$row['location']."</h3>
                                        </div>
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
                $user_id=$row['unique_id'];
                $query_select_user="select * from users where unique_id=$user_id";
                $res_user=$item->run_query($query_select_user);
                $row_user=mysqli_fetch_array($res_user);
                $username=$row_user['username'];
                $phone=$row_user['phone'];
                $ligne.="
                    <html>
                        <body class='body_main' >
                        <!-- Header -->
                        <section class='header'>
                
                            <div class='col'>
                                <a href='Main.php' id='left'>Back</a>
                            </div>
                
                            <div class='col'>
                                <span class='product_title_info_large'>".$row['type']."</span>
                            </div>
                
                            <div class='col'>
                                
                            </div>
                            
                        </section>
                        <section class='form' style='width:40%'>

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav' style='text-align:center'>";

                                    $query_vehicle_img="select * from image where id_product=".$row['ID']." and product='{$product}'";
                                    if($item->check_query($query_vehicle_img)==0){
                                        $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>"; 
                                    }
                                    foreach($item->run_query($query_vehicle_img) as $row_vehicle_img){
                                        $img = 'images_items/'.$row_vehicle_img['img'];
                                        if(file_exists($img)){
                                            $ligne.= "<img src='images_items/". $row_vehicle_img['img'] ."' id='img_details_fav' >";  
                                        }else{
                                            $ligne.= "<img src='images/error_img.jpg' width='70px' id='img_details_fav'>";  
                                        }
                                    }

                                    $ligne.="
                                    </div>
                                </div>

                            </div> 
        
                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Price in lb</h2>
                                        <h3 id='h3_view_details_fav'>".number_format($row['price_lb'])."</h3>
                                    </div>
                                </div>
                                    
                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Price in usd</h2>
                                        <h3 id='h3_view_details_fav'>".number_format($row['price_usd'])."</h3>
                                    </div>
                                </div>

                            </div> 
        
                            <div class='col_div' id='col_div_view_details'>
        
                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Title</h2>
                                        <h3 id='h3_view_details_fav'>".$row['title']."</h3>
                                    </div>
                                </div>
        
                                <div class='col'>
                                    
                                </div>
        
                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Description</h2>
                                        <h3 id='h3_view_details_fav'>".$row['description']."</h3>
                                    </div>
                                </div>
        
                            </div> 
        
                            <div class='col_div' id='col_div_view_details'>
        
                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Size</h2>
                                        <h3 id='h3_view_details_fav'>".$row['size']."</h3>
                                    </div>
                                </div>

                                <div class='col'>
                                    
                                </div>
        
                            </div> 

                            <div class='col_div'>

                                <div class='col' style='text-align:center'>
                                    <div id='div_container_details_fav'>
                                        <u><h2 id='h2_view_details_fav' style='font-size:35px'>Contact</h2></u>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Username</h2>
                                        <h3 id='h3_view_details_fav'>$username</h3>
                                    </div>
                                </div>
                                    
                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Phone</h2>
                                        <h3 id='h3_view_details_fav'>$phone</h3>
                                    </div>
                                </div>

                            </div> 

                            <div class='col_div' id='col_div_view_details'>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Age</h2>";
                                        $birth = explode('-', $row_user['birthdate']);
                                        $user_year= $birth[0];
                                        $current_year=date("Y");
                                        $age=$current_year-$user_year;
                                        $ligne.="<h3 id='h3_view_details_fav'>$age</h3>
                                    </div>
                                </div>

                                <div class='col'>
                                    
                                </div>

                                <div class='col'>
                                    <div id='div_container_details_fav'>
                                        <h2 id='h2_view_details_fav'>Location</h2>
                                        <h3 id='h3_view_details_fav'>".$row['location']."</h3>
                                    </div>
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
                            <a href='Favourite.php' id='left'>Back</a>
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