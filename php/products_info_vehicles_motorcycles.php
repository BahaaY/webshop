<?php

    session_start();

    include("classes/product.php");
    include("classes/connexion.php");

    $item = new product($bdd->get_link()); 

    $msg_check_insert=$msg_image = $msg_price_lb = $msg_price_usd = $msg_title = $msg_description = $msg_make = $msg_model
        = $msg_condition = $msg_year = $msg_kilometeres = $msg_transmission = $msg_color = $msg_body = $msg_location = "";

    $make = $model = $condition = $year = $kilometeres = $transmission = $color = $body = "";

    if(isset($_POST['btn_sell'])){

        //get values of variable
        $input_price_lb = $item->mysqli_real_escape_string($_POST['input_price_lb']);
        $input_price_usd = $item->mysqli_real_escape_string($_POST['input_price_usd']);
        $input_title = $item->mysqli_real_escape_string($_POST['input_title']);
        $input_description = $item->mysqli_real_escape_string($_POST['input_description']);
        $input_location=$item->mysqli_real_escape_string($_POST['input_location']);
        if(isset($_POST['make']))
            $make = $item->mysqli_real_escape_string($_POST['make']);
        if(isset($_POST['model']))
            $model = $item->mysqli_real_escape_string($_POST['model']);
        if(isset($_POST['condition']))
            $condition = $item->mysqli_real_escape_string($_POST['condition']);
        if(isset($_POST['year']))
            $year = $item->mysqli_real_escape_string($_POST['year']);
        if(isset($_POST['kilometeres']))
            $kilometeres = $item->mysqli_real_escape_string($_POST['kilometeres']);
        if(isset($_POST['transmission']))
            $transmission = $item->mysqli_real_escape_string($_POST['transmission']);
        if(isset($_POST['color']))
            $color = $item->mysqli_real_escape_string($_POST['color']);
        if(isset($_POST['body']))
            $body = $item->mysqli_real_escape_string($_POST['body']);
        
        //set values of variable
        $unique_id_i = $item->set_uniqueId($_SESSION['shop_unique_id']);
        $price_lb_i = $item->set_price_lb($input_price_lb);
        $price_usd_i = $item->set_price_usd($input_price_usd);
        $title_i = $item->set_title($input_title);
        $description_i = $item->set_description($input_description);
        $make_i = $item->set_make($make);
        if($make=="Other make"){
            $model_i = $item->set_model("Other model");
        }else{
            $model_i = $item->set_model($model);
        }
        $condition_i = $item->set_cond($condition);
        $year_i = $item->set_year($year);
        $kilometeres_i = $item->set_kilometere($kilometeres);
        $transmission_i= $item->set_trans($transmission);
        $color_i=$item->set_color($color);
        $body_i=$item->set_body($body);
        $location_i=$item->set_location($input_location);

        //validation for input
        if($price_lb_i == 0)  
            $msg_price_lb="Enter a valid price!";  
        else if($price_lb_i == 2)  
           $msg_price_lb="Required*"; 

        if($price_usd_i == 0)  
            $msg_price_usd="Enter a valid price!";  
        else if($price_usd_i == 2)  
            $msg_price_usd="Required*";
           
        if($title_i == 0)  
            $msg_title="Required*"; 
        else if($title_i == 2)  
            $msg_title="Enter title between 0 and 500 characters!";  

        if($description_i == 0)  
            $msg_description="Required*";  
        else if($description_i == 2)  
            $msg_description="Enter description between 0 and 1000 characters!";  

        if($make_i == 0)  
            $msg_make="Required*";

        if($model_i == 0)  
            $msg_model="Required*";

        if($condition_i == 0)  
            $msg_condition="Required*";

        if($year_i == 0)  
            $msg_year="Required*";

        if($kilometeres_i == 0)  
            $msg_kilometeres="Required*";

        if($transmission_i == 0)  
            $msg_transmission="Required*";

        if($color_i == 0)  
            $msg_color="Required*";

        if($body_i == 0)  
            $msg_body="Required*";

        if ($location_i == 0) {
            $msg_location="Required*";
        }else if ($location_i == 2) {
            $msg_location="Enter location between 0 and 255 characters!";
        }  

        //insert new item to database  
        if(!empty(array_filter($_FILES['input_image']['name']))) {
            if(count(array_filter($_FILES['input_image']['name'])) < 8){
                if($price_lb_i==1 && $price_usd_i==1  && $title_i==1 && $description_i==1 && $make_i==1 && $model_i==1 && $condition_i==1 && $year_i==1 && $kilometeres_i==1 && $transmission_i==1 && $color_i==1 && $body_i==1 && $location_i==1){
                    $insert=$item->sell_product("product_vehicle_motorcycle");
                    if($insert == 1){
                        $msg_check_insert="<h2 id='msg_check_correct'>Item is now in sell</h2>";
                        $input_price_lb="";
                        $input_price_usd="";
                        $input_title="";
                        $input_description="";
                        $input_location="";
        
                        $item->insert_image_product("product_vehicle_motorcycle");
        
                    }else{
                        $msg_check_insert="<h2 id='msg_check_incorrect'>Error exist! Try again!</h2>";
                    }
                }
            }
        }else{
            $msg_image="Required*";
        }
            
    }

?>