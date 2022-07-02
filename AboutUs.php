<html>

    <?php

        session_start();

        include_once "head.php"; 

        if (isset($_SESSION['shop_unique_id']) || isset($_COOKIE['shop_unique_id'])) {
            header("location: Main.php");
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
                            Welcome to shopping website,<br>Your number one source for all things (shoes, bags and all products).<br>
                            We're dedicated to giving you the very best of product, with a focus on dependability, customer service and uniqueness.<br>
                            Founded in 2022 by Bahaa yassine & Tarek youness, shopping website has come a long way from its beginnings.<br>
                            When Bahaa yassine & Tarek youness first started out his passion for helping people to find<br>
                            their requirements easily drove him to do intense research and gave him the impetus to turn hard work<br>
                            and inspiration into to a booming online store. We now serve customers all over Lebanon.<br>
                            We hope you enjoy our products as much as we enjoy offering them to you. If you have any questions<br>
                            or comments, please don't hesitate to contact us.
                        </span>
                    </div>
                </div>  
                
            </form>
        </section>
    </body>
    
</html>