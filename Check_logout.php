<html>

    <?php

        include_once "head.php"; 

        include_once 'php/check_logout.php';

        include("classes/user.php");
        include("classes/connexion.php");
    
        $user = new user($bdd->get_link());

        if(!isset($_SESSION['shop_unique_id'])){
            if(isset($_COOKIE['shop_unique_id'])){
                $_SESSION['shop_unique_id']=$_COOKIE['shop_unique_id'];
                $res_check_uid=$user->run_query("select * from users where unique_id=".$_SESSION['shop_unique_id']."");
                if(mysqli_num_rows($res_check_uid) == 0){
                    setcookie('shop_unique_id', '', time() - 3600, '/');
                    session_destroy();
                    header("location: index.php");
                }
            }else{
                header("location: index.php");
            }
        }else{
            $res_check_uid=$user->run_query("select * from users where unique_id=".$_SESSION['shop_unique_id']."");
            if(mysqli_num_rows($res_check_uid) == 0){
                setcookie('shop_unique_id', '', time() - 3600, '/');
                session_destroy();
                header("location: index.php");
            }else{
                if(!isset($_COOKIE['shop_unique_id'])){
                    setcookie("shop_unique_id", $_SESSION['shop_unique_id'], time() + (86400 * 30), "/"); // 86400 = 1 day
                }
            }
        }

    ?>

    <body class="body_main">
        <!-- Body -->
        <section class="form" id="form_profile" >
            <form method="POST">

                <div class="col_div">
                    <div class="col" style="font-size:20px;text-align:center">
                        Are you sure you want logout?
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col">
                        <input type="submit" name="btn_yes" id="btn_yes" value="Yes">
                    </div>
                    <div class="col">
                        <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel">
                    </div>
                </div> 
                
            </form>
        </section>
    </body>
    
</html>