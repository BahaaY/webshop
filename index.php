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
                <a href="index.php" class="selected">Shopping website</a>
            </div>

            <div class="col">
                <a href="AboutUs.php" id="a_main">About Us</a>
            </div>

            <div class="col">
                <a href="Register.php" id="a_main">Register</a>
            </div>

            <div class="col">
                <a href="Login.php" id="a_main">Login</a>
            </div>

        </section>
        <!-- Body -->
        <section class="form_index" id="form_index">
            <form method="POST">

                <div class="col_index">
                    <span id="span1">Welcome</span>
                </div>

                <div class="col_index">
                    <span id="span2">To</span>
                </div>

                <div class="col_index">
                    <span id="span3">Shopping website</span>
                </div>

                <br>
                
                <div class="col_index" >
                    <span id="span4">
                        <a href="AboutUs.php" id="a_more_info">More Info</a>
                    </span>
                </div>

            </form>
        </section>
    </body>
    
</html>