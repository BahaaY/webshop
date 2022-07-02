<html>
    <?php

        session_start();
    
        include_once "head.php";

        include("classes/product.php");
        include("classes/connexion.php");
    
        $item = new product($bdd->get_link()); 

        if(!isset($_SESSION['shop_unique_id'])){
            if(isset($_COOKIE['shop_unique_id'])){
                $_SESSION['shop_unique_id']=$_COOKIE['shop_unique_id'];
                $res_check_uid=$item->run_query("select * from users where unique_id=".$_SESSION['shop_unique_id']."");
                if(mysqli_num_rows($res_check_uid) == 0){
                    setcookie('shop_unique_id', '', time() - 3600, '/');
                    session_destroy();
                    header("location: index.php");
                }
            }else{
                header("location: index.php");
            }
        }else{
            $res_check_uid=$item->run_query("select * from users where unique_id=".$_SESSION['shop_unique_id']."");
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
        <!-- Header -->
        <section class="header">

            <div class="col">
                <a href="Main.php"  id="left">Back</a>
            </div>

            <div class="col">
                <span class="product_title_info_large">What are your offering?</span>
            </div>

            <div class="col">
                
            </div>

        </section>
        <!-- Body -->
        <section class="form" style="padding:0px">
            <div class="col_div_products">
                <a href="Products_info_vehicles_motorcycles.php" class="col_products">
                    <div>
                        <img class="img_product" src="images/vehicles_motorcycles.jpg"><br>
                        Vehicles & Motorcycles
                    </div>
                </a>
                <a href="Products_info_apartments.php" class="col_products">
                    <div>
                        <img class="img_product" src="images/apartments.jpg"><br>
                        Apartments
                    </div>
                </a>
            </div> 

            <div class="col_div_products">
                <a href="Products_info_electronics_home_appliance.php" class="col_products">
                    <div>
                        <img class="img_product" src="images/electronics_homeAppliances.jpg"><br>
                        Electronics & home appliances
                    </div>
                </a>
                <a href="Products_info_home_furniture.php" class="col_products">
                    <div>
                        <img class="img_product" src="images/home_furniture.jpg"><br>
                        Home Furnitures
                    </div>
                </a>
            </div>  

            <div class="col_div_products">
                <a href="Products_info_laptops_tablets_computers.php" class="col_products">
                    <div>
                        <img class="img_product" src="images/laptops_tablets_computers.jpg"><br>
                        Laptops, Tablets, Computers
                    </div>
                </a>
                <a href="Products_info_lands.php" class="col_products">
                    <div>
                        <img class="img_product" src="images/lands.jpg"><br>
                        Lands
                    </div>
                </a>
            </div> 
            
        </section>

    </body>
</html>