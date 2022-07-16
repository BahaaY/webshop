<?php



    if(isset($_POST['text']) ){

        include("../../classes/user.php");
        include("../../classes/connexion.php");

        $user=new user($bdd->get_link());

        $obj = new stdClass();

        $get_text=$_POST['text'];
        $ligne="";

        $query_select ="
            (select * from users where username like '%$get_text%')
            union
            (select * from users where email like '%$get_text%')
        ";
        $res_select=$user->run_query($query_select);

        if(mysqli_num_rows($res_select) > 0){
            $obj->resultat_select=1;
            $ligne.="
                <tr>
                    <td id='td_thead'>Username</td>
                    <td id='td_thead'>Email</td>
                </tr>
            ";
            while($row=mysqli_fetch_assoc($res_select)){
                if($row['email'] == "admin@gmail.com"){
                    continue;
                }
                $ligne.="
                    <tr id='tr_tbody'>
                        <td>
                            ".$row['username']."
                        </td>
                        <td>
                            ".$row['email']."
                        </td>";
                            $uid=$row['unique_id'];
                            if($row['blocked']==0){
                                $ligne.="
                                    <td align='center'>
                                        <input type='button' class='btn' style='width:auto;' value='View ads' id='view_ads_".$uid."' onclick=view_ads($uid)>
                                        <br>
                                        <input type='button' class='btn_c' style='width:150px;' value='Block user' id='block_unblock_".$uid."' onclick=block_unblock($uid)>
                                    </td>
                                ";
                            }else{
                                $ligne.="
                                    <td align='center'>
                                        <input type='button' class='btn' style='width:auto;' value='View ads' id='view_ads_".$uid."' onclick=view_ads($uid)>
                                        <br>
                                        <input type='button' class='btn_c' style='width:150px;' value='Unblock user' id='block_unblock_".$uid."' onclick=block_unblock($uid)>
                                    </td>
                                ";
                            }  
                        $ligne.="
                    </tr>
                ";
            }
        }else{
            $obj->resultat_select=0;
            $ligne.="
                <tr align=center>
                    <td><span style='font-size:35px;font-weight:bold;'>No user found.</span></td>
                </tr>
            ";
        }

        $obj->row=$ligne;
        echo json_encode($obj);

    }
?>