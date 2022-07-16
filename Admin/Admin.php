<?php

    include_once "head.php"; 

    session_start();

    include("../classes/user.php");
    include("../classes/connexion.php");

    $user=new user($bdd->get_link());

    if(!isset($_SESSION['shop_unique_id_admin'])){
        if(isset($_COOKIE['shop_unique_id_admin'])){
            $_SESSION['shop_unique_id_admin']=$_COOKIE['shop_unique_id_admin'];
            $res_check_uid=$user->run_query("select * from users where unique_id=".$_SESSION['shop_unique_id_admin']."");
            if(mysqli_num_rows($res_check_uid) == 0){
                setcookie('shop_unique_id_admin', '', time() - 3600, '/');
                session_destroy();
                header("location: index.php");
            }
        }else{
            header("location: index.php");
        }
    }else{
        $res_check_uid=$user->run_query("select * from users where unique_id=".$_SESSION['shop_unique_id_admin']."");
        if(mysqli_num_rows($res_check_uid) == 0){
            setcookie('shop_unique_id_admin', '', time() - 3600, '/');
            session_destroy();
            header("location: index.php");
        }else{
            if(!isset($_COOKIE['shop_unique_id_admin'])){
                setcookie("shop_unique_id_admin", $_SESSION['shop_unique_id_admin'], time() + (86400 * 30), "/"); // 86400 = 1 day
            }
        }
    }

    $username="";
    $res=$user->run_query("select * from users where unique_id='{$_SESSION['shop_unique_id_admin']}'");
    if(mysqli_num_rows($res)>0){
        $row=mysqli_fetch_assoc($res);
        $username="Welcome ".$row['username'];
    }else{
        $username="Welcome";
    }

?>
<?php
    if(isset($_POST['logout'])){
        setcookie('shop_unique_id_admin', '', time() - 3600, '/');
        session_destroy(); 
        header("location:Login.php");
        exit();
    }
?>
<html>
    <body class="body_main">
        <section class="header">

        <div class="col">
            <span id="left" class="left" style='font-size:28px;font-weight:bold' ><span id="welcome"><?php if($username!="") echo $username; ?></span></span>
        </div>

        <div class="col">
            <a href="Update_password.php"  id="a_main">Change password</a>
        </div>

        <div class="col">
            <a href="Check_logout.php"  id="a_main">Logout</a>
        </div>

        </section>
    </body>

    <section class="form" style='width:auto'>
        <div class="col_div">
            <div class="col" >
                <i class="fa fa-search" ></i>
                <input type="text" name="input_search" id="input_search" >
                <label id="label_search" style="padding-left: 5px;" >Search</label>
            </div>
        </div> 
        <table id="table_admin">
            <tbody id="table_body">
            <tr>
                <td>Username</td>
                <td>Email</td>
            </tr>
                <?php
                    $ligne="";
                    $res=$user->run_query("select * from users");
                    if(mysqli_num_rows($res)>0){
                        while($row=mysqli_fetch_assoc($res)){
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
                                                <td align='center' >
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
                        $ligne.="
                            <tr>
                                <td>No users available</td>
                            </tr>
                        ";
                    }
                    echo $ligne;
                ?>
            </tbody>
        </table>
    
    </section>
</html>

