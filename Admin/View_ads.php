<?php

    include_once "head.php"; 

    session_start();

    include("../classes/user.php");
    include("../classes/product.php");
    include("../classes/connexion.php");
    include("../php/arrays.php");

    $user=new user($bdd->get_link());
    $item=new product($bdd->get_link());

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
<?php

    if(isset($_GET['uid']) && $_GET['uid']!="" && !preg_match('/[A-Za-z]/', $_GET['uid'])
        && !preg_match('@[\W]@', $_GET['uid']) ){
        $uid=$_GET['uid'];
        $username="";
        $res=$user->run_query("select * from users where unique_id=$uid");
        if(mysqli_num_rows($res)>0){
            $row=mysqli_fetch_assoc($res);
            $username=$row['username'];
        }else{
            $username="";
        }
    }

?>
<html>
    <body class="body_main">
        <section class="header">

            <div class="col">
                <a href="Admin.php" id="left">Back</a>
            </div>

            <div class="col">
                <span class="product_title_info_large"><?php if($username!="") echo $username; ?></span>
            </div>

            <div class="col">
                
            </div>

        </section>
        <!-- Body -->
        <section class="form" id="form_fav" style="width: 60%;">
            <input type="hidden" value=<?php echo $uid ?> id="uid">
            <div class="col_div"  style="padding-bottom:5px;justify-content:center">
                    <div class="col" style="top:-15px;max-width:350px;top:10px" >
                        <select name="product" id="product_search_ads">
                            <option selected disabled value="null">-- Search by category --</option>
                            <?php
                                foreach($array_product_name as $val){
                                    echo "<option value='".$val."'$s >".$val."</option>";
                                }  
                            ?>
                        </select>
                    </div>

                    <div class="col" id="col_reload">
                        <div class="fa fa-refresh" id="reload"></div>
                    </div>
                </div> 
            <table class="table_main">
                <?php

                    $i=0;

                    $ligne="";
                    
                    $ligne.= "
                            <tr id='table_body_no_item' style='display:none'>
                                <td>
                                    <h2 style='text-align:center;font-size:35px'>This user doesn't have any ads.</h2>
                                </td>
                            </tr>
                    ";

                    $query_vehicle=" select * from product_vehicle_motorcycle where unique_id=$uid ";
                    $query_apartment=" select * from product_apartment where unique_id=$uid";
                    $query_electronic=" select * from product_electronic_home where unique_id=$uid";
                    $query_home=" select * from product_home_furniture where unique_id=$uid";
                    $query_laptop=" select * from product_laptop_tablet_computer where unique_id=$uid";
                    $query_land=" select * from product_land where unique_id=$uid";

                    if($item->check_query($query_vehicle)==0){
                        if($item->check_query($query_apartment)==0){
                            if($item->check_query($query_electronic)==0){
                                if($item->check_query($query_home)==0){
                                    if($item->check_query($query_laptop)==0){
                                        if($item->check_query($query_land)==0){
                                            $ligne.= "
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <h2 style='text-align:center;font-size:35px'>This user doesn't have any ads.</h2>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                             </table>
                                            ";
                                        }
                                    }
                                }
                            }
                        }
                    }    

                    $ligne.="
                        <tbody id='table_body'>
                    ";
                    
                    foreach($array_table_name as $product_name){
                        $query_select_product="select * from $product_name where unique_id=$uid";
                        $res_product=$item->run_query($query_select_product);
                        while($row_product=mysqli_fetch_assoc($res_product)){
                            if($i%2 == 0){
                                $ligne.= "
                                    <tr>
                                        <td id='td_".$product_name."_".$row_product['ID']."' class='td_fav'>
                                            <a href='View_details_ads.php?product=$product_name&id=".$row_product['ID']."' class='a_fav'>
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
                                        <img src='../images_items/$image_name' class='img_fav'>
                                    ";
                                }
                                $ligne.="
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                ";
                            }else{
                                $ligne.= "
                                    <td id='td_".$product_name."_".$row_product['ID']."' class='td_fav'>
                                        <a href='View_details_ads.php?product=$product_name&id=".$row_product['ID']."' class='a_fav'>
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
                                        <img src='../images_items/$image_name' class='img_fav'>
                                    ";
                                }
                                $ligne.="
                                                </div>
                                            </div>
                                        </a>
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
    </body>
</html>