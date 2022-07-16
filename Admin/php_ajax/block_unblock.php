<?php
    if(isset($_POST['uid'])){

        $uid=$_POST['uid'];
    
        include("../../classes/user.php");
        include("../../classes/connexion.php");
        
        $user = new user($bdd->get_link()); 
        $obj = new stdClass();
    
        $res_select=$user->run_query("select * from users where unique_id=$uid");
        if(mysqli_num_rows($res_select)>0){
            $row=mysqli_fetch_assoc($res_select);
            if($row['blocked'] == 0){
                $res_block=$user->check_query("update users set blocked=1 where unique_id=$uid");
                if($res_block>0){
                    $obj->result=1;
                }
            }else if($row['blocked'] == 1){
                $res_block=$user->check_query("update users set blocked=0 where unique_id=$uid");
                if($res_block>0){
                    $obj->result=0;
                }
            }
        }
        
        echo json_encode($obj);
    
    
    }
?>