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
                    $query_select = "select * from favourite where user_id=$unique_id and product='{$product_name}'";
                    $res_product=$item->run_query($query_select);
                    if(mysqli_num_rows($res_product) == 0){
                        $query_select2 = "select * from favourite where user_id=$unique_id ";
                        $res_product2=$item->run_query($query_select2);
                        if(mysqli_num_rows($res_product2) == 0){
                            $obj->check_all_tr=1;
                            $ligne.="
                                <tr>
                                    <td>
                                        <h2 style='text-align:center;font-size:35px'>You haven't liked anything yet in this category.</h2>
                                    </td>
                                </tr>
                            ";
                        }
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
?>