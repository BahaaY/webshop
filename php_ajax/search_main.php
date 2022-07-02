<?php



    if(isset($_POST['text']) ){

        session_start();

        include("../classes/product.php");
        include("../classes/connexion.php");
        include ("../php/arrays.php");

        $item=new product($bdd->get_link());

        $obj = new stdClass();

        $get_text=$_POST['text'];
        $i=0;
        $ligne="";

        $obj->resultat_select=1;

        $unique_id=$_SESSION['shop_unique_id'];

        foreach($array_table_name as $product_name){

            if($product_name=="product_vehicle_motorcycle"){
                $query_select ="
                    (select * from $product_name where make like '%$get_text%' and unique_id!=$unique_id)
                    union
                    (select * from $product_name where model like '%$get_text%' and unique_id!=$unique_id)
                ";
            }else{
                $query_select ="select * from $product_name where type like '%$get_text%' and unique_id!=$unique_id";
            }
            $res_product=$item->run_query($query_select);
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
                                            <div class='fa fa-heart' id='fav_".$product_name."_".$row_product['ID']."' style='color:red;transition: all 250ms ease-in-out;cursor:pointer;font-size:65px' onclick=fav('$product_name','".$row_product['ID']."');></div>
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
        ";

        foreach($array_table_name as $product_name){
            if($product_name=="product_vehicle_motorcycle"){
                $query_select ="
                    (select * from $product_name where make like '%$get_text%' and unique_id!=$unique_id)
                    union
                    (select * from $product_name where model like '%$get_text%' and unique_id!=$unique_id)
                ";
            }else{
                $query_select ="select * from $product_name where type like '%$get_text%' and unique_id!=$unique_id";
            }
            $res_product=$item->run_query($query_select);
            if(mysqli_num_rows($res_product)==0){
                $n=1;
            }else{
                $n=0;
                break;
            }
        }
        if($n>0){
            $ligne.= "
                <tr>
                    <td>
                        <h2 style='text-align:center;font-size:50px;color:black'>No ads found.</h2>
                    </td>
                </tr>
            ";
        }

        /*$query_vehicle="
            (select * from product_vehicle_motorcycle where make like '%$get_text%' and unique_id!=$unique_id)
            union
            (select * from product_vehicle_motorcycle where model like '%$get_text%' and unique_id!=$unique_id)
        ";
        $query_apartment=" select * from product_apartment where type like '%$get_text%' and unique_id!=$unique_id";
        $query_electronic=" select * from product_electronic_home where type like '%$get_text%' and unique_id!=$unique_id";
        $query_home=" select * from product_home_furniture where type like '%$get_text%' and unique_id!=$unique_id";
        $query_laptop=" select * from product_laptop_tablet_computer where type like '%$get_text%' and unique_id!=$unique_id";
        $query_land=" select * from product_land where type like '%$get_text%' and unique_id!=$unique_id";

        if($item->check_query($query_vehicle)==0){
            if($item->check_query($query_apartment)==0){
                if($item->check_query($query_electronic)==0){
                    if($item->check_query($query_home)==0){
                        if($item->check_query($query_laptop)==0){
                            if($item->check_query($query_land)==0){
                                $ligne.= "
                                    <tr>
                                        <td>
                                            <h2 style='text-align:center;font-size:35px'>No ads found.</h2>
                                        </td>
                                    </tr>
                                ";
                            }
                        }
                    }
                }
            }
        }*/

        $query_vehicle2=" select * from product_vehicle_motorcycle where unique_id!=$unique_id";
        $query_apartment2=" select * from product_apartment where unique_id!=$unique_id";
        $query_electronic2=" select * from product_electronic_home where unique_id!=$unique_id";
        $query_home2=" select * from product_home_furniture where unique_id!=$unique_id";
        $query_laptop2=" select * from product_laptop_tablet_computer where unique_id!=$unique_id";
        $query_land2=" select * from product_land where unique_id!=$unique_id";

        if($item->check_query($query_vehicle2)==0){
            if($item->check_query($query_apartment2)==0){
                if($item->check_query($query_electronic2)==0){
                    if($item->check_query($query_home2)==0){
                        if($item->check_query($query_laptop2)==0){
                            if($item->check_query($query_land2)==0){
                                $obj->resultat_select=0;
                                $ligne.= "
                                    <tr>
                                        <td>
                                            <h2 style='text-align:center;font-size:50px;color:black'>No ads available.</h2>
                                        </td>
                                    </tr>
                                ";
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