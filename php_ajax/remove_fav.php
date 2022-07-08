<?php
    if(isset($_POST['product_name']) && isset($_POST['id'])){

        if($_POST['s']=="null"){

            $product_name=$_POST['product_name'];
            $id=$_POST['id'];
    
            session_start();
            $unique_id=$_SESSION['shop_unique_id'];
    
            include("../classes/product.php");
            include("../classes/connexion.php");
        
            $item = new product($bdd->get_link()); 
            $obj = new stdClass();
            $ligne="";
    
            $res=$item->check_query("delete from favourite where product_id=$id and product='{$product_name}' and user_id=$unique_id");
            if($res==1){
                $obj->resultat_update=1;
    
                $query_check=" select * from favourite where user_id=$unique_id ";
                $res=$item->run_query($query_check);
                if(mysqli_num_rows($res) > 0){
                    $obj->check_all_tr=1;

                    $ligne.=reselect($_POST['s'],$unique_id,$item,$product_name);

                }else{
                    $obj->check_all_tr=0;
                    $ligne.="
                        <tr>
                            <td>
                                <h2 style='text-align:center;font-size:35px'>You haven't liked anything yet.</h2>
                            </td>
                        </tr>
                    ";
                }
            }else{
                $obj->resultat_update=0;
            }
    
            $obj->row=$ligne;
    
            echo json_encode($obj);
        }else{
            $product_name=$_POST['product_name'];
            $id=$_POST['id'];
    
            session_start();
            $unique_id=$_SESSION['shop_unique_id'];
    
            include("../classes/product.php");
            include("../classes/connexion.php");
        
            $item = new product($bdd->get_link()); 
            $obj = new stdClass();
            $ligne="";
    
            $res=$item->check_query("delete from favourite where product_id=$id and product='{$product_name}' and user_id=$unique_id");
            if($res==1){
                $obj->resultat_update=1;
    
                $query_check=" select * from favourite where user_id=$unique_id ";
                $res=$item->run_query($query_check);
                if(mysqli_num_rows($res) > 0){
                    $query_select = "select * from favourite where user_id=$unique_id and product='{$product_name}'";
                    $res_product=$item->run_query($query_select);
                    if(mysqli_num_rows($res_product) == 0){
                        $obj->check_all_tr=1;
                        $ligne.="
                            <tr>
                                <td>
                                    <h2 style='text-align:center;font-size:35px'>You haven't liked anything yet in this category.</h2>
                                </td>
                            </tr>
                        "; 
                    }else{
                        $ligne.=reselect($_POST['s'],$unique_id,$item,$product_name);
                    }
                }else{
                    $obj->check_all_tr=0;
                    $ligne.="
                        <tr>
                            <td>
                                <h2 style='text-align:center;font-size:35px'>You haven't liked anything yet.</h2>
                            </td>
                        </tr>
                    ";
                }
            }else{
                $obj->resultat_update=0;
            }
    
            $obj->row=$ligne;
    
            echo json_encode($obj);
        }

    }

    function reselect($s,$unique_id,$item,$product){
        $ligne="";
        $i=0;
        if($s=="null"){
            $query_check=" select * from favourite where user_id=$unique_id";
        }else{
            $query_check=" select * from favourite where user_id=$unique_id and product='{$product}'";
        }
        
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
                        ";
                    }
        return $ligne;
    }

?>