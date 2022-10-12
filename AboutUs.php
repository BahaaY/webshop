<html>

    <?php

        session_start();

        include_once "head.php"; 

        if (isset($_SESSION['shop_unique_id']) || isset($_COOKIE['shop_unique_id'])) {
            header("location: Main.php");
        }
        if (isset($_SESSION['shop_unique_id_admin']) || isset($_COOKIE['shop_unique_id_admin'])) {
            header("location: Admin/Admin.php");
        }
        
    ?>

    <body>
        <!-- Header -->
        <section class="header">

            <div class="col">
                <a href="index.php" id="a_main">Shopping website</a>
            </div>

            <div class="col">
                <a href="AboutUs.php" class="selected">About Us</a>
            </div>

            <div class="col">
                <a href="Register.php" id="a_main">Register</a>
            </div>

            <div class="col">
                <a href="Login.php" id="a_main">Login</a>
            </div>
            
        </section>
        <!-- Body -->
        <section class="form" id="form_aboutUs">
            <form method="POST">

                <div class="col_div">
                    <div class="col" style="text-align:center">
                        <span id="span_aboutUs1" >Shopping website</span>
                    </div>
                </div> 

                <div class="col_div">
                    <div class="col">
                        <span id="span_aboutUs2" style="font-size: 22px;">
                            Welcome to shopping website,<br>Your number one source for all things (Cars, Home furniture,Home electronic, Apartment, Land ...).<br>
                            We hope you enjoy our website as much as we enjoy offering them to you.
                        </span>
                    </div>
                </div> 
                
            </form>
        </section>
    </body>
    
</html>