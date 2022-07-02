<html>

    <?php
        session_start();

        include_once "head.php"; 

        include("classes/product.php");
        include("classes/connexion.php");

        $item = new product($bdd->get_link()); 

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
                <a href="Main.php" id="left">Back</a>
            </div>

            <div class="col">
                <span class="product_title_info_large">My Favourites</span>
            </div>

            <div class="col">
                
            </div>
            
        </section>

        <section class="form" id="form_fav">
            <form method="POST" >

                <div class="col_div"  style="padding-bottom:5px;justify-content:center">
                    <div class="col" style="top:-15px;max-width:350px;top:10px">
                        <select name="product" id="product_search_fav" >
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

                <table class='table_fav'>

                    <?php

                        $unique_id=$_SESSION['shop_unique_id'];

                        $i=0;

                        $ligne="";

                        $ligne.="
                            <tbody id='table_body'>
                        ";

                        $query_check=" select * from favourite where user_id=$unique_id";
                        $res=$item->run_query($query_check);
                        if(mysqli_num_rows($res) > 0){
                            while($row=mysqli_fetch_assoc($res)){
                                $product_name=$row['product'];
                                $query_select_product="select * from $product_name where ID=".$row['product_id']."";
                                $res_product=$item->run_query($query_select_product);
                                while($row_product=mysqli_fetch_assoc($res_product)){
                                    if($i%2 == 0){
                                        $ligne.= "
                                                <tr>
                                                    <td id='td_".$product_name."_".$row_product['ID']."' class='td_fav'>
                                                        <a href='View_details.php?product=$product_name&id=".$row_product['ID']."' class='a_fav'>
                                                            <div class='col_div'>
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
                                                        <div class='col_div' style='justify-content:center'>
                                                            <input type='button' value='Remove from\n favourites' class='btn_remove_fav' onclick=unfav('$product_name','".$row_product['ID']."');>
                                                        </div>
                                                    </td>
                                                ";
                                    }else{
                                        $ligne.= "
                                            <td id='td_".$product_name."_".$row_product['ID']."' class='td_fav'>
                                                <a href='View_details.php?product=$product_name&id=".$row_product['ID']."' class='a_fav'>
                                                    <div class='col_div'>
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
                                                <div class='col_div' style='justify-content:center'>
                                                    <input type='button' value='Remove from\n favourites' class='btn_remove_fav' onclick=unfav('$product_name','".$row_product['ID']."');>
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
                        }else{
                            $ligne.="
                                <tbody id='table_body_no_item'>
                                    <tr>
                                        <td>
                                            <h2 style='text-align:center;font-size:35px'>You haven't liked anything yet.</h2>
                                        </td>
                                    </tr>
                                </tbody>
                            ";
                        }
                        echo $ligne;
                    ?>
                </table>

            </form>
        </section>
    </body>
    
</html>