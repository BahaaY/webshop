<?php
    if(isset($_POST['product_name']) && isset($_POST['id'])){

        $product_name=$_POST['product_name'];
        $id=$_POST['id'];

        session_start();
        $unique_id=$_SESSION['shop_unique_id'];

        include("../classes/product.php");
        include("../classes/connexion.php");
    
        $item = new product($bdd->get_link()); 
        $obj = new stdClass();

        $query_select="select * from favourite where user_id=$unique_id and product_id=$id and product='$product_name'";
        $res_select=$item->run_query($query_select);
        if(mysqli_num_rows($res_select)>0){
            $query_delete_fav="delete from favourite where user_id=$unique_id and product_id=$id and product='$product_name'";
            if($item->check_query($query_delete_fav)>0){
                $obj->resultat_query=1;
            }
        }else{
            $query_insert_fav="insert into favourite (user_id,product_id,product) values('{$unique_id}','{$id}','{$product_name}')";
            if($item->check_query($query_insert_fav)>0){
                $obj->resultat_query=0;
            }
        }
    
        echo json_encode($obj);


    }
?>