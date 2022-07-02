<?php

    session_start();

    include("classes/product.php");
    include("classes/connexion.php");

    $item = new product($bdd->get_link()); 

    $msg_check_insert=$msg_image = $msg_price_lb = $msg_price_usd = $msg_title = $msg_description = $msg_type 
        = $msg_payment = $msg_bedroom = $msg_bethroom = $msg_floor = $msg_condition = $msg_size = $msg_location = "";
    $type =$payment = $bedroom = $bethroom =$floor = $condition = "";
    if (isset($_POST['btn_sell'])) {
        
        //get variable
        $input_price_lb = $item->mysqli_real_escape_string($_POST['input_price_lb']);
        $input_price_usd = $item->mysqli_real_escape_string($_POST['input_price_usd']);
        $input_title = $item->mysqli_real_escape_string($_POST['input_title']);
        $input_size = $item->mysqli_real_escape_string($_POST['input_size']);
        $input_description = $item->mysqli_real_escape_string($_POST['input_description']);
        $input_location=$item->mysqli_real_escape_string($_POST['input_location']);
        if (isset($_POST['type'])) {
            $type = $item->mysqli_real_escape_string($_POST['type']);
        }
        if (isset($_POST['payment'])) {
            $payment = $item->mysqli_real_escape_string($_POST['payment']);
        }
        if (isset($_POST['bedroom'])) {
            $bedroom = $item->mysqli_real_escape_string($_POST['bedroom']);
        }
        if (isset($_POST['bethroom'])) {
            $bethroom = $item->mysqli_real_escape_string($_POST['bethroom']);
        }
        if (isset($_POST['floor'])) {
            $floor = $item->mysqli_real_escape_string($_POST['floor']);
        }
        if (isset($_POST['condition'])) {
            $condition = $item->mysqli_real_escape_string($_POST['condition']);
        }

        //set variables
        $uid=$_SESSION['shop_unique_id'];
        $unique_id_i = $item->set_uniqueId($uid);
        $price_lb_i = $item->set_price_lb($input_price_lb);
        $price_usd_i = $item->set_price_usd($input_price_usd);
        $title_i = $item->set_title($input_title);
        $description_i = $item->set_description($input_description);
        $type_i = $item->set_type($type);
        $payment_i = $item->set_payment($payment);
        $bedroom_i=$item->set_bedroom_nb($bedroom);
        $bethroom_i=$item->set_bethroom_nb($bethroom);
        $floor_i=$item->set_floor_nb($floor);
        $condition_i = $item->set_cond($condition);
        $size_i=$item->set_size($input_size);
        $location_i=$item->set_location($input_location);


        //msg error
        if ($price_lb_i == 0) {
            $msg_price_lb="Enter a valid price!";
        } elseif ($price_lb_i == 2) {
            $msg_price_lb="Required*";
        }

        if ($price_usd_i == 0) {
            $msg_price_usd="Enter a valid price!";
        } elseif ($price_usd_i == 2) {
            $msg_price_usd="Required*";
        }
        
        if($title_i == 0)  
            $msg_title="Required*"; 
        else if($title_i == 2)  
            $msg_title="Enter title between 0 and 500 characters!";  

        if($description_i == 0)  
            $msg_description="Required*";  
        else if($description_i == 2)  
            $msg_description="Enter description between 0 and 1000 characters!";  

        if ($type_i == 0) {
            $msg_type="Required*";
        }

        if ($payment_i == 0) {
            $msg_payment="Required*";
        }

        if ($bedroom_i == 0) {
            $msg_bedroom="Required*";
        }

        if ($bethroom_i == 0) {
            $msg_bethroom="Required*";
        }

        if ($floor_i == 0) {
            $msg_floor="Required*";
        }

        if ($condition_i == 0) {
            $msg_condition="Required*";
        }

        if ($size_i == 0) {
            $msg_size="Enter a valid size!";
        } elseif ($price_lb_i == 2) {
            $msg_size="Required*";
        }

        if ($location_i == 0) {
            $msg_location="Required*";
        }else if ($location_i == 2) {
            $msg_location="Enter location between 0 and 255 characters!";
        }

        //insert new item to database
        if(!empty(array_filter($_FILES['input_image']['name']))) {
            if(count(array_filter($_FILES['input_image']['name'])) < 8){
                if ($price_lb_i==1 && $price_usd_i==1  && $title_i==1 && $description_i==1 && $type_i==1 && $payment_i==1 && $bedroom_i==1 && $bethroom_i==1 && $floor_i==1 && $condition_i==1 && $size_i==1 && $location_i==1) {
                    $insert=$item->sell_product("product_apartment");
                    if($insert == 1){
                        $msg_check_insert="<h2 id='msg_check_correct'>Item is now in sell</h2>";
                        $input_price_lb="";
                        $input_price_usd="";
                        $input_title="";
                        $input_description="";
                        $input_size="";
                        $input_location="";
    
                        $item->insert_image_product("product_apartment");
    
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