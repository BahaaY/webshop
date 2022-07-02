<?php
    if(isset($_POST['product_name'])){

        include("../classes/product.php");
        include("../classes/connexion.php");

        session_start();
        $unique_id=$_SESSION['shop_unique_id'];
    
        $item = new product($bdd->get_link()); 
        $obj = new stdClass();
        $i=0;
        $ligne="";

        $product_name=$_POST['product_name'];

        $query_select_product=" select * from $product_name where unique_id=$unique_id";
        $res_product=$item->run_query($query_select_product);
        if(mysqli_num_rows($res_product) > 0){
            $obj->resultat_select=1;
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
                            <img src='images_items/$image_name' class='img_fav'>
                        ";
                    }
                    $ligne.="
                                    </div>
                                </div>
                            </a>
                            <div class='col_div' id='col_div_view_details' style='justify-content:center'>
                                <input type='button' value='Delete'  class='btn_c' id='delete_product_vehicle_motorcycle_".$row_product['ID']."' onclick=remove('$product_name','".$row_product['ID']."')>
                            </div>
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
                            <img src='images_items/$image_name' class='img_fav'>
                        ";
                    }
                    $ligne.="
                                    </div>
                                </div>
                            </a>
                            <div class='col_div' id='col_div_view_details' style='justify-content:center'>
                                <input type='button' value='Delete' class='btn_c' id='delete_product_vehicle_motorcycle_".$row_product['ID']."' onclick=remove('$product_name','".$row_product['ID']."')>
                            </div>
                        </td>
                    ";
                }
                $i++;
            }
            $ligne.="
                </tr>
            ";
        }else{
            $obj->resultat_select=0;
            $obj->check_all_tr=1;
            $ligne.="
                <tr>
                    <td>
                        <h2 style='text-align:center;font-size:35px'>You don't have any ads yet in this category.</h2>
                    </td>
                </tr>
            ";

            $query_vehicle=" select * from product_vehicle_motorcycle where unique_id=$unique_id ";
            $query_apartment=" select * from product_apartment where unique_id=$unique_id ";
            $query_electronic=" select * from product_electronic_home where unique_id=$unique_id ";
            $query_home=" select * from product_home_furniture where unique_id=$unique_id ";
            $query_laptop=" select * from product_laptop_tablet_computer where unique_id=$unique_id ";
            $query_land=" select * from product_land where unique_id=$unique_id ";

            if($item->check_query($query_vehicle)==0){
                if($item->check_query($query_apartment)==0){
                    if($item->check_query($query_electronic)==0){
                        if($item->check_query($query_home)==0){
                            if($item->check_query($query_laptop)==0){
                                if($item->check_query($query_land)==0){
                                    $obj->check_all_tr=0;
                                    $ligne.="
                                        <tr>
                                            <td>
                                                <h2 style='text-align:center;font-size:35px'>You don't have any ads yet.</h2>
                                            </td>
                                        </tr>
                                    ";
                                }
                            }
                        }
                    }
                }
            }


        }

        $obj->row=$ligne;
        
        echo json_encode($obj);

    }
?>