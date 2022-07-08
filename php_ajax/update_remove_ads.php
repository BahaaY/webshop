<?php

    if($_POST['check_button']=="update"){
        include("../classes/connexion.php");
        include("../classes/product.php");
        $item =new product($bdd->get_link());
    
        if($_POST['product']=="product_vehicle_motorcycle"){
            $id=$_POST['id'];
            $product=$_POST['product'];
            $price_lb=$_POST['price_lb'];
            $price_usd=$_POST['price_usd'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $condition=$_POST['condition'];
            $year=$_POST['year'];
            $kilometeres=$_POST['kilometeres'];
            $transmission=$_POST['transmission'];
            $color=$_POST['color'];
            $body=$_POST['body'];
            $location=$_POST['location'];
                
            $query="update $product set
                price_lb='{$price_lb}',
                price_usd='{$price_usd}',
                title='{$title}',
                description='{$description}',
                cond='{$condition}',
                year='{$year}',
                kilometere='{$kilometeres}',
                trans='{$transmission}',
                color='{$color}',
                body='{$body}',
                location='{$location}'
                where ID=$id 
            ";
        }else if($_POST['product']=="product_apartment"){
            $id=$_POST['id'];
            $product=$_POST['product'];
            $price_lb=$_POST['price_lb'];
            $price_usd=$_POST['price_usd'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $payment=$_POST['payment'];
            $bedroom_nb=$_POST['bedroom_nb'];
            $bethroom_nb=$_POST['bethroom_nb'];
            $floor_nb=$_POST['floor_nb'];
            $condition=$_POST['condition'];
            $size=$_POST['size'];
            $location=$_POST['location'];

            $query="update $product set
                price_lb='{$price_lb}',
                price_usd='{$price_usd}',
                title='{$title}',
                description='{$description}',
                payment='{$payment}',
                bedroom_nb='{$bedroom_nb}',
                bethroom_nb='{$bethroom_nb}',
                floor_nb='{$floor_nb}',
                cond='{$condition}',
                size='{$size}',
                location='{$location}'
                where ID=$id 
            ";
        }else if($_POST['product']=="product_electronic_home"){
            $id=$_POST['id'];
            $product=$_POST['product'];
            $price_lb=$_POST['price_lb'];
            $price_usd=$_POST['price_usd'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $condition=$_POST['condition'];
            $location=$_POST['location'];

            $query="update $product set
                price_lb='{$price_lb}',
                price_usd='{$price_usd}',
                title='{$title}',
                description='{$description}',
                cond='{$condition}',
                location='{$location}'
                where ID=$id 
            ";
        }else if($_POST['product']=="product_home_furniture"){
            $id=$_POST['id'];
            $product=$_POST['product'];
            $price_lb=$_POST['price_lb'];
            $price_usd=$_POST['price_usd'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $condition=$_POST['condition'];
            $location=$_POST['location'];

            $query="update $product set
                price_lb='{$price_lb}',
                price_usd='{$price_usd}',
                title='{$title}',
                description='{$description}',
                cond='{$condition}',
                location='{$location}'
                where ID=$id 
            ";
        }else if($_POST['product']=="product_laptop_tablet_computer"){
            $id=$_POST['id'];
            $product=$_POST['product'];
            $price_lb=$_POST['price_lb'];
            $price_usd=$_POST['price_usd'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $condition=$_POST['condition'];
            $location=$_POST['location'];

            $query="update $product set
                price_lb='{$price_lb}',
                price_usd='{$price_usd}',
                title='{$title}',
                description='{$description}',
                cond='{$condition}',
                location='{$location}'
                where ID=$id 
            ";
        }else if($_POST['product']=="product_land"){
            $id=$_POST['id'];
            $product=$_POST['product'];
            $price_lb=$_POST['price_lb'];
            $price_usd=$_POST['price_usd'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            $size=$_POST['size'];
            $location=$_POST['location'];
            $query="update $product set
                price_lb='{$price_lb}',
                price_usd='{$price_usd}',
                title='{$title}',
                description='{$description}',
                size='{$size}',
                location='{$location}'
                where ID= $id
            ";
        }
        $result = new stdClass();

        $price_lb_i = $item->set_price_lb($price_lb);
        $price_usd_i = $item->set_price_usd($price_usd);
        $title_i = $item->set_title($title);
        $description_i = $item->set_description($description);
        $location_i = $item->set_location($location);
        if(isset($_POST['size'])){
            $size_i = $item->set_size($size);
        }
        

        if ($price_lb_i == 0) 
            $result->error_price_lb="Enter a valid price!";
        else if ($price_lb_i == 2) 
            $result->error_price_lb="Required*";
        else
            $result->error_price_lb="";
        
        if ($price_usd_i == 0) 
            $result->error_price_usd="Enter a valid price!";
        else if ($price_usd_i == 2) 
            $result->error_price_usd="Required*";
        
        if($title_i == 0)  
            $result->error_title="Required*"; 
        else if($title_i == 2)  
            $result->error_title="Enter title between 0 and 500 characters!";  

        if($description_i == 0)  
            $result->error_description="Required*";  
        else if($description_i == 2)  
            $result->error_description="Enter description between 0 and 1000 characters!";  

        if ($location_i == 0) 
            $result->error_location="Required*";
        else if ($location_i == 2) 
            $result->error_location="Enter location between 0 and 255 characters!";
        
        if(isset($_POST['size'])){
            if ($size_i == 0) 
                $result->error_size="Enter a valid size!";
            else if ($size_i == 2) 
                $result->error_size="Required*";
        }

        
        if($product=="product_vehicle_motorcycle" || $product=="product_electronic_home" || $product=="product_home_furniture" || $product=="product_laptop_tablet_computer"){
            $check_input=$price_lb_i=='1' && $price_usd_i=='1' && $title_i=='1' && $description_i=='1' && $location_i=='1';
        }else if($product=="product_apartment" || $product=="product_land"){
            $check_input=$price_lb_i=='1' && $price_usd_i=='1' && $title_i=='1' && $description_i=='1' && $location_i=='1' && $size_i=='1';
        }
        
        if($check_input){
            if($item->check_query($query)>0){
                $result->status = 1;
            }else{
                $result->status = 0;
            }
            if(isset($_FILES['img'])){
                if(count($_FILES['img']['name']) < 8){
                    $query_select_img="select * from image where id_product=$id and product='{$product}'";
                    foreach($item->run_query($query_select_img) as $row){
                        $img = '../images_items/'.$row['img'];
                        if(file_exists($img)){
                            unlink($img);
                        }
                    }
                    $query_delete_image="delete from image where id_product=$id and product='{$product}'";
                    if($item->check_query($query_delete_image)>0){
                        $item->update_image_product($id,$product);
                    }
                    $ligne="";
                    $query_vehicle_img="select * from image where id_product=".$id." and product='{$product}'";
                    if($item->check_query($query_vehicle_img)==0){
                        $ligne.= "<img src='images/error_img.jpg' id='img_details_fav'>"; 
                    }
                    foreach($item->run_query($query_vehicle_img) as $row_vehicle_img){
                        $img = '../images_items/'.$row_vehicle_img['img'];
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
                                <input type='file' name='input_image_".$product."_".$id."[]' id='input_image_".$product."_".$id."' multiple accept='.jpg, .png, .jpeg' onchange=count_img_ads('$product/".$id."') />
                            </button>
                        <p id='num_image_".$product."_".$id."'>No image chosen.</p>
                    ";

                    $result->row_img=$ligne;
                    $result->status = 1;
                    $result->check_img=1;
                }else{
                    return;
                }
            }else{
                $result->check_img=0;
            }
        }
        echo json_encode($result);

    }else if($_POST['check_button']=="remove"){
        if($_POST['s']=="null"){
            session_start();
            include("../classes/connexion.php");
            include("../classes/product.php");
            $item =new product($bdd->get_link());
        
            $id=$_POST['id'];
            $product=$_POST['product'];
            $unique_id=$_SESSION['shop_unique_id'];

            $query_delete_product="delete from $product where ID=$id ";
            $query_delete_image="delete from image where id_product=$id and product='{$product}'";
            $query_select_img="select * from image where id_product=$id and product='{$product}'";
            //$query_check_tr=" select * from $product where unique_id=$unique_id";
        
            $query_vehicle=" select * from product_vehicle_motorcycle where unique_id=$unique_id ";
            $query_apartment=" select * from product_apartment where unique_id=$unique_id ";
            $query_electronic=" select * from product_electronic_home where unique_id=$unique_id ";
            $query_home=" select * from product_home_furniture where unique_id=$unique_id ";
            $query_laptop=" select * from product_laptop_tablet_computer where unique_id=$unique_id ";
            $query_land=" select * from product_land where unique_id=$unique_id ";
        
            $result = new stdClass();
            foreach($item->run_query($query_select_img) as $row){
                $img = '../images_items/'.$row['img'];
                if(file_exists($img)){
                    unlink($img);
                }
            }
            if($item->check_query($query_delete_product)>0){
                if($item->check_query($query_delete_image)>0){
                    $result->status=1;
                }else{
                    $result->status=0;
                }
            }
            $result->check_all_tr=1;
            if($item->check_query($query_vehicle)==0){
                if($item->check_query($query_apartment)==0){
                    if($item->check_query($query_electronic)==0){
                        if($item->check_query($query_home)==0){
                            if($item->check_query($query_laptop)==0){
                                if($item->check_query($query_land)==0){
                                    $result->check_all_tr=0;
                                }
                            }
                        }
                    }
                }
            }
            if( $result->check_all_tr==1){
                $ligne="";
                $ligne=reselect($_POST['s'],$unique_id,$item,$product);
                $result->row=$ligne;
            }
        }else{
            $ligne="";
            session_start();
            include("../classes/connexion.php");
            include("../classes/product.php");
            $item =new product($bdd->get_link());
        
            $id=$_POST['id'];
            $product=$_POST['product'];
            $unique_id=$_SESSION['shop_unique_id'];

            $query_delete_product="delete from $product where ID=$id ";
            $query_delete_image="delete from image where id_product=$id and product='{$product}'";
            $query_select_img="select * from image where id_product=$id and product='{$product}'";
            //$query_check_tr=" select * from $product where unique_id=$unique_id";
        
            $query_vehicle=" select * from product_vehicle_motorcycle where unique_id=$unique_id ";
            $query_apartment=" select * from product_apartment where unique_id=$unique_id ";
            $query_electronic=" select * from product_electronic_home where unique_id=$unique_id ";
            $query_home=" select * from product_home_furniture where unique_id=$unique_id ";
            $query_laptop=" select * from product_laptop_tablet_computer where unique_id=$unique_id ";
            $query_land=" select * from product_land where unique_id=$unique_id ";
        
            $result = new stdClass();
            foreach($item->run_query($query_select_img) as $row){
                $img = '../images_items/'.$row['img'];
                if(file_exists($img)){
                    unlink($img);
                }
            }
            if($item->check_query($query_delete_product)>0){
                if($item->check_query($query_delete_image)>0){
                    $result->status=1;
                    $result->check_all=0;
                    $query_check=" select * from $product where unique_id=$unique_id ";
                    $res=$item->run_query($query_check);
                    if(mysqli_num_rows($res) > 0){
                        $result->check_all=1;
                        $ligne.=reselect($_POST['s'],$unique_id,$item,$product);
                        $result->row=$ligne;
                    }else{

                        $result->check_all_tr=1;
                        if($item->check_query($query_vehicle)==0){
                            if($item->check_query($query_apartment)==0){
                                if($item->check_query($query_electronic)==0){
                                    if($item->check_query($query_home)==0){
                                        if($item->check_query($query_laptop)==0){
                                            if($item->check_query($query_land)==0){
                                                $result->check_all_tr=0;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        
                        $ligne.="
                            <tr>
                                <td>
                                    <h2 style='text-align:center;font-size:35px'>You don't have any ads yet in this category</h2>
                                </td>
                            </tr>
                        ";
                        $result->row=$ligne;
                    }
                }else{
                    $result->status=0;
                }
            }
            
        }
        echo json_encode($result);
    }

    function reselect($s,$unique_id,$item,$product){
        $ligne="";
        $i=0;
        if($s=="null"){
            include("../php/arrays.php");
            foreach($array_table_name as $product_name){
                $query_select_product="select * from $product_name where unique_id=$unique_id";
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
            }
    
            $ligne.="
                    </tr>
            ";
        }else{

                $query_select_product="select * from $product where unique_id=$unique_id";
                $res_product=$item->run_query($query_select_product);
                while($row_product=mysqli_fetch_assoc($res_product)){
                    if($i%2 == 0){
                        $ligne.= "
                            <tr>
                                <td id='td_".$product."_".$row_product['ID']."' class='td_fav'>
                                    <a href='View_details_ads.php?product=$product&id=".$row_product['ID']."' class='a_fav'>
                                        <div class='col_div' id='col_div_view_details'>
                                            <div class='col'>
                                                <h2 class='h2_product_name'>
                        ";
                        if($product=='product_vehicle_motorcycle'){
                            $ligne.=$row_product['make'].' '.$row_product['model'];
                        }else{
                            $ligne.=$row_product['type'];
                        }
                        $ligne.="</h2>";
                        $query_select_image="select img from image where id_product=".$row_product['ID']." and product='$product'";
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
                                    <input type='button' value='Delete'  class='btn_c' id='delete_product_vehicle_motorcycle_".$row_product['ID']."' onclick=remove('$product','".$row_product['ID']."')>
                                </div>
                            </td>
                        ";
                    }else{
                        $ligne.= "
                            <td id='td_".$product."_".$row_product['ID']."' class='td_fav'>
                                <a href='View_details_ads.php?product=$product&id=".$row_product['ID']."' class='a_fav'>
                                    <div class='col_div' id='col_div_view_details'>
                                        <div class='col'>
                                            <h2 class='h2_product_name'>
                        ";
                        if($product=='product_vehicle_motorcycle'){
                            $ligne.=$row_product['make'].' '.$row_product['model'];
                        }else{
                            $ligne.=$row_product['type'];
                        }
                        $ligne.="</h2>";
                        $query_select_image="select img from image where id_product=".$row_product['ID']." and product='$product'";
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
                                    <input type='button' value='Delete' class='btn_c' id='delete_product_vehicle_motorcycle_".$row_product['ID']."' onclick=remove('$product','".$row_product['ID']."')>
                                </div>
                            </td>
                        ";
                    }
                    $i++;
                }
                    
            $ligne.="
                    </tr>
            ";
        }

        return $ligne;
    }
    
 
?>