<?php 

    class user{
        private $id; 
        private $unique_id;
        private $last_name; 
        private $first_name; 
        private $username; 
        private $update_username;
        private $birthdate;
        private $email; 
        private $password; 
        private $gender; 
        private $phone; 
        private $update_phone;
        private $verify_code;
        private $link; 

//Setter for user
        public function set_uniqueId($unique_id){
            $nb = strlen(trim($unique_id));
            if($nb > 0){
                $this->unique_id=$unique_id;
                return 1; //Done
            }
            return 0; //Error exist! Try again!
        }

        public function set_fname($first_name){
            $nb = strlen(trim($first_name));
            if($nb > 0){
                $space=preg_match('/^[^ ].* .*[^ ]$/', $first_name);
                $number = preg_match('@[0-9]@', $first_name);
                $special_char = preg_match('@[\W]@', $first_name);
                if(!$space && !$number && !$special_char){
                    $this->first_name = $first_name;
                    return 1; //Done
                }
                return 0; //First name must not be contain space, number and special characters!
            }
            return 2; //Required!
        }
    
        public function set_lname($last_name){
            $nb = strlen(trim($last_name));
            if($nb > 0 ){
                $space=preg_match('/^[^ ].* .*[^ ]$/', $last_name);
                $number = preg_match('@[0-9]@', $last_name);
                $special_char = preg_match('@[\W]@', $last_name);
                if(!$space && !$number && !$special_char){
                    $this->last_name = $last_name;
                    return 1; //Done
                }
                return 0; //Last name must not be contain space, number and special characters!
            }
            return 2; //Required!
        }

        public function set_username($username){
            $nb = strlen(trim($username));
            if($nb > 0 ){
                if($nb <=15){
                    $character = preg_match('@[A-Za-z]@', $username);
                    $space=preg_match('/^[^ ].* .*[^ ]$/', $username);
                    if($character){
                        if(!$space){
                            $sql = "select * from users where username='{$username}'";
                            $res = mysqli_query($this->link, $sql);
                            if(mysqli_num_rows($res) == 0){
                                $this->username = $username;
                                return 1; //Done
                            }
                            else 
                                return 0; //Username already exist!
                        }
                        return 2; //Username must not be contain space!
                    }
                    return 3; //Username must be contain 1 character or more!
                }
                return 4; //Username must not be more than 15 characters!
            }
            return 5; //Required!
        }

        public function set_update_username($update_username,$uid){
            $nb = strlen(trim($update_username));
            if($nb > 0 ){
                if($nb <= 15){
                    $character = preg_match('@[A-Za-z]@', $update_username);
                    $space=preg_match('/^[^ ].* .*[^ ]$/', $update_username);
                    if($character){
                        if(!$space){
                            $sql = "select * from users where username='{$update_username}' and unique_id != '{$uid}'";
                            $res = mysqli_query($this->link, $sql);
                            if(mysqli_num_rows($res) == 0){
                                $this->username = $update_username;
                                return 1; //Done
                            }
                            else 
                                return 0; //Username already exist!
                        }
                        return 2; //Username must not be contain space!
                    }
                    return 3;//Username must be contain 1 character or more!
                }
                return 4; //Username must not be more than 15 characters!
            }
            return 5; //Required!
        }

        public function set_phone($phone){
            $nb = strlen(trim($phone));
            if($nb > 0 ){
                if($nb == 8){
                    $number = preg_match('@[0-9]@', $phone);
                    if($number){
                        //verifier si phone est unique.
                        $sql = "select * from users where phone='{$phone}'";
                        $res = mysqli_query($this->link, $sql);
                        if(mysqli_num_rows($res) == 0){
                            $this->phone = $phone;
                            return 1; //Done
                        }
                        return 0; //Phone number already exist!
                    }
                    return 2; //Enter a valid phone number!
                }
                return 3; //Enter a valid phone number!
            }
            return 4; //Required!
        }

        public function set_update_phone($update_phone,$uid){
            $nb = strlen(trim($update_phone));
            if($nb > 0 ){
                if($nb == 8){
                    $number = preg_match('@[0-9]@', $update_phone);
                    if($number){
                        //verifier si phone est unique.
                        $sql = "select * from users where phone='{$update_phone}' and unique_id != '{$uid}'";
                        $res = mysqli_query($this->link, $sql);
                        if(mysqli_num_rows($res) == 0){
                            $this->phone = $update_phone;
                            return 1; //Done
                        }
                        return 0; //Phone number already exist!
                    }
                    return 2; //Enter a valid phone number!
                }
                return 3; //Enter a valid phone number!
            }
            return 4; //Required!
        }
        
        public function set_email($email){
            $nb = strlen(trim($email));
            if($nb > 0 && $nb <= 50){
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    //verifier si l'email est unique.
                    $sql = "select * from users where email='{$email}'";
                    $res = mysqli_query($this->link, $sql);
                    if(mysqli_num_rows($res) == 0){
                        $this->email = $email;
                        return 1; //Done
                    }
                    return 0; //Email already exist!
                }
                return 2; //Enter a valid email!
            }
            return 3; //Required!
        }

        public function set_email_delete_account($email){
            $nb = strlen(trim($email));
            if($nb > 0 && $nb <= 50){
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $this->email=$email;
                    return 1; //Done
                }
                return 2; //Enter a valid email!
            }
            return 3; //Required!
        }

        public function set_password($password){
            $nb = strlen(trim($password));
            if($nb > 0){
                if($nb >= 6){
                    $space=preg_match('/^[^ ].* .*[^ ]$/', $password);
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number = preg_match('@[0-9]@', $password);
                    $special_char = preg_match('@[\W]@', $password);
                    if(!$space && $uppercase && $lowercase && $number && $special_char){
                        $this->password=$password;
                        return 1; //Done
                    }
                    return 0; //Password must be contain upercase,lowercase,number and special characters and not contain space!
                }
                return 2; //Password must be at least 6 characters or more!
            } 
            return 3; //Required!
        }

        public function set_current_password($password,$uid){
            $nb = strlen(trim($password));
            if($nb > 0){
                //verifier si current password est correct.
                $sql = "select * from users where unique_id='{$uid}'";
                $res = mysqli_query($this->link, $sql);
                if(mysqli_num_rows($res) > 0){
                    $row=mysqli_fetch_assoc($res);
                    if(password_verify($password,$row['password'])){
                        return 1;
                    }
                    return 0; //Please enter your current password!
                }
            } 
            return 2; //Required!
        }

        public function set_new_password($password,$uid){
            $nb = strlen(trim($password));
            if($nb > 0){
                if($nb >= 6){
                    $space=preg_match('/^[^ ].* .*[^ ]$/', $password);
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number = preg_match('@[0-9]@', $password);
                    $special_char = preg_match('@[\W]@', $password);
                    if(!$space && $uppercase && $lowercase && $number && $special_char){
                        $sql = "select * from users where unique_id='{$uid}'";
                        $res = mysqli_query($this->link, $sql);
                        if(mysqli_num_rows($res) > 0){
                            $row=mysqli_fetch_assoc($res);
                            if(!password_verify($password,$row['password'])){
                                $this->password=$password;
                                return 1; //Done
                            }
                            return 4; //This is your current password!
                        }
                    }
                    return 0; //Password must be contain upercase,lowercase,number and special characters and not contain space!
                }
                return 2; //Password must be at least 6 characters or more!
            } 
            return 3; //Required!
        }

        public function set_reset_password($email,$password){
            $nb = strlen(trim($password));
            if($nb > 0){
                if($nb >= 6){
                    $space=preg_match('/^[^ ].* .*[^ ]$/', $password);
                    $uppercase = preg_match('@[A-Z]@', $password);
                    $lowercase = preg_match('@[a-z]@', $password);
                    $number = preg_match('@[0-9]@', $password);
                    $special_char = preg_match('@[\W]@', $password);
                    if(!$space && $uppercase && $lowercase && $number && $special_char){
                        $sql = "select * from users where email='{$email}'";
                        $res = mysqli_query($this->link, $sql);
                        if(mysqli_num_rows($res) > 0){
                            $row=mysqli_fetch_assoc($res);
                            if(!password_verify($password,$row['password'])){
                                $this->password=$password;
                                return 1; //Done
                            }
                            return 4; //This is your current password!
                        }
                    }
                    return 0; //Password must be contain upercase,lowercase,number and special characters and not contain space!
                }
                return 2; //Password must be at least 6 characters or more!
            } 
            return 3; //Required!
        }

        public function set_gender($gender){
            $nb = strlen(trim($gender));
            if($nb > 0 && $nb <= 6){
                $this->gender = $gender;
                return 1; //Done
            }
            return 0; //Required!
        }

        
        public function set_birthdate($birthdate){
            $nb = strlen(trim($birthdate));
            if($nb > 0){
                $this->birthdate = $birthdate;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_verifyCode($verify_code){
            $nb = strlen(trim($verify_code));
            if($nb > 0){
                $this->verify_code = $verify_code;
                return 1; //Done
            }
            return 0; //Error exist!
        }

//Getter for user
        public function get_id(){
            return $this->id;
        }

        public function get_uniqueId(){
            return $this->unique_id;
        }

        public function get_fname(){
            return $this->first_name;
        }

        public function get_lname(){
            return $this->last_name;
        }

        public function get_username(){
            return $this->username;
        }

        public function get_update_username(){
            return $this->update_username;
        }

        public function get_phone(){
            return $this->phone;
        }

        public function get_update_phone(){
            return $this->update_phone;
        }

        public function get_email(){
            return $this->email;
        }

        public function get_password(){
            return $this->password;
        }

        public function get_gender(){
            return $this->gender;
        }

        public function get_birthdate(){
            return $this->birthdate;
        }

        public function get_verifyCode(){
            return $this->verify_code;
        }

        public function __construct($link){
            $this->link = $link;
        }

//Function register
        public function register(){
            $pass=password_hash($this->password,PASSWORD_DEFAULT);
            $sql = "insert into users (unique_id,first_name,last_name,username,email,password,phone,birthdate,gender,verify_code)
                        values('{$this->unique_id}','{$this->first_name}', '{$this->last_name}', '{$this->username}', '{$this->email}', '{$pass}','{$this->phone}','{$this->birthdate}','{$this->gender}','{$this->verify_code}')";    
            mysqli_query($this->link, $sql);
            if(mysqli_affected_rows($this->link) == 1){
                $this->id = mysqli_insert_id($this->link);
                return 1; //Done
            }
            return 0; //Error exist!
        }

//Function verification for user
        public function verify($uid,$security_code){
            $sql1="select * from users where verify_code='{$security_code}' and unique_id='{$uid}'";
            $q1=mysqli_query($this->link,$sql1);
            if(mysqli_num_rows($q1)>0){
                $newsecurity_code =md5(date("h:i:s"));
                $sql2="update users set verify_code='$newsecurity_code',verify='1' where unique_id='{$uid}'";
                mysqli_query($this->link,$sql2);
                if(mysqli_affected_rows($this->link) > 0){
                    return 1; //Your email has been activated. You can now Login.
                }
                return 0; //Link expired or used.
            }
            return 2; //Link expired or used.
        }

//Function login
        public function validation($email,$password){
            $q="select * from users where email='{$email}'";
            $res=mysqli_query($this->link,$q);
            if(mysqli_num_rows($res)>0){
                while($row=mysqli_fetch_assoc($res)){
                    if(password_verify($password,$row['password'])){
                        if ($row['blocked']==0){
                            if ($row['verify']==1){
                                if($email=="admin@gmail.com"){
                                    session_start();
                                    $_SESSION['shop_unique_id_admin']=$row['unique_id'];
                                    setcookie("shop_unique_id_admin", $row['unique_id'], time() + (86400 * 30), "/"); // 86400 = 1 day
                                    return 4; //Go Admin
                                }else{
                                    session_start();
                                    $_SESSION['shop_unique_id']=$row['unique_id'];
                                    setcookie("shop_unique_id", $row['unique_id'], time() + (86400 * 30), "/"); // 86400 = 1 day
                                    return 1; //Go to Main
                                }
                            }
                            return 2; //Email verification has been sent to your account!
                        }
                        return 3; //You are blocked. Please contact admin. 
                    }
                    return 0; //Email or password incorrect!
                }
            }
        }

        public function validation_delete_account($email,$password,$uid){
            $q="select * from users where unique_id='{$uid}'";
            $res=mysqli_query($this->link,$q);
            if(mysqli_num_rows($res)>0){
                $row=mysqli_fetch_assoc($res);
                if(password_verify($password,$row['password']) && $email==$row['email']){
                    return 1; //Done
                }
                return 0; //Email or password incorrect!            
            }
        }

        public function delete_account($uid){
            
            $query_select_appartment="select * from product_apartment where unique_id='{$uid}'";
            $query_select_electronic="select * from product_electronic_home where unique_id='{$uid}'";
            $query_select_home="select * from product_home_furniture where unique_id='{$uid}'";
            $query_select_land="select * from product_land where unique_id='{$uid}'";
            $query_select_laptop="select * from product_laptop_tablet_computer where unique_id='{$uid}'";
            $query_select_vehicle="select * from product_vehicle_motorcycle where unique_id='{$uid}'";
            $res_apartment=mysqli_query($this->link,$query_select_appartment);
            $res_electronic=mysqli_query($this->link,$query_select_electronic);
            $res_home=mysqli_query($this->link,$query_select_home);
            $res_land=mysqli_query($this->link,$query_select_land);
            $res_laptop=mysqli_query($this->link,$query_select_laptop);
            $res_vehicle=mysqli_query($this->link,$query_select_vehicle);

            if(mysqli_num_rows($res_apartment)>0){
                while($row_apartment=mysqli_fetch_assoc($res_apartment)){
                    $id_product=$row_apartment['ID'];
                    $product="product_apartment";
                    $query_select_img="select * from image where id_product=$id_product and product='{$product}'";
                    foreach(mysqli_query($this->link,$query_select_img) as $row){
                        $img = 'images_items/'.$row['img'];
                        if(file_exists($img)){
                            unlink($img);
                        }
                    }
                    $query_delete_img="delete from image where id_product='{$id_product}' and product='{$product}'";
                    mysqli_query($this->link,$query_delete_img);
                    $query_delete_product_apartment="delete from product_apartment where ID='{$id_product}'"; 
                    mysqli_query($this->link,$query_delete_product_apartment);
                }
            }
            
            if(mysqli_num_rows($res_electronic)>0){
                while($row_electronic=mysqli_fetch_assoc($res_electronic)){
                    $id_product=$row_electronic['ID'];
                    $product="product_electronic_home";
                    $query_select_img="select * from image where id_product=$id_product and product='{$product}'";
                    foreach(mysqli_query($this->link,$query_select_img) as $row){
                        $img = 'images_items/'.$row['img'];
                        if(file_exists($img)){
                            unlink($img);
                        }
                    }
                    $query_delete_img="delete from image where id_product='{$id_product}' and product='{$product}'";
                    mysqli_query($this->link,$query_delete_img);
                    $query_delete_product_electronic="delete from product_electronic_home where ID='{$id_product}'"; 
                    mysqli_query($this->link,$query_delete_product_electronic);
                }
            }
            
            if(mysqli_num_rows($res_home)>0){
                while( $row_home=mysqli_fetch_assoc($res_home)){
                    $id_product=$row_home['ID'];
                    $product="product_home_furniture";
                    $query_select_img="select * from image where id_product=$id_product and product='{$product}'";
                    foreach(mysqli_query($this->link,$query_select_img) as $row){
                        $img = 'images_items/'.$row['img'];
                        if(file_exists($img)){
                            unlink($img);
                        }
                    }
                    $query_delete_img="delete from image where id_product='{$id_product}' and product='{$product}'";
                    mysqli_query($this->link,$query_delete_img);
                    $query_delete_product_home="delete from product_home_furniture where ID='{$id_product}'"; 
                    mysqli_query($this->link,$query_delete_product_home);
                }
            }
            
            if(mysqli_num_rows($res_land)>0){
                while($row_land=mysqli_fetch_assoc($res_land)){
                    $id_product=$row_land['ID'];
                    $product="product_land";
                    $query_select_img="select * from image where id_product=$id_product and product='{$product}'";
                    foreach(mysqli_query($this->link,$query_select_img) as $row){
                        $img = 'images_items/'.$row['img'];
                        if(file_exists($img)){
                            unlink($img);
                        }
                    }
                    $query_delete_img="delete from image where id_product='{$id_product}' and product='{$product}'";
                    mysqli_query($this->link,$query_delete_img);
                    $query_delete_product_land="delete from product_land where ID='{$id_product}'"; 
                    mysqli_query($this->link,$query_delete_product_land);
                }
            }
            
            if(mysqli_num_rows($res_laptop)>0){
                while($row_laptop=mysqli_fetch_assoc($res_laptop)){
                    $id_product=$row_laptop['ID'];
                    $product="product_laptop_tablet_computer";
                    $query_select_img="select * from image where id_product=$id_product and product='{$product}'";
                    foreach(mysqli_query($this->link,$query_select_img) as $row){
                        $img = 'images_items/'.$row['img'];
                        if(file_exists($img)){
                            unlink($img);
                        }
                    }
                    $query_delete_img="delete from image where id_product='{$id_product}' and product='{$product}'";
                    mysqli_query($this->link,$query_delete_img);
                    $query_delete_product_laptop="delete from product_laptop_tablet_computer where ID='{$id_product}'"; 
                    mysqli_query($this->link,$query_delete_product_laptop);
                }
                
            }
            
            if(mysqli_num_rows($res_vehicle)>0){
                while($row_vehicle=mysqli_fetch_assoc($res_vehicle)){
                    $id_product=$row_vehicle['ID'];
                    $product="product_vehicle_motorcycle";
                    $query_select_img="select * from image where id_product=$id_product and product='{$product}'";
                    foreach(mysqli_query($this->link,$query_select_img) as $row){
                        $img = 'images_items/'.$row['img'];
                        if(file_exists($img)){
                            unlink($img);
                        }
                    }
                    $query_delete_img="delete from image where id_product='{$id_product}' and product='{$product}'";
                    mysqli_query($this->link,$query_delete_img);
                    $query_delete_product_vehicle="delete from product_vehicle_motorcycle where ID='{$id_product}'"; 
                    mysqli_query($this->link,$query_delete_product_vehicle);
                }
            }
            $query_delete_user="delete from users where unique_id='{$uid}'"; 
            mysqli_query($this->link,$query_delete_user);

            if(mysqli_affected_rows($this->link) > 0){
                return 1;
            }else{
                return 0;
            }
        }

//Function update password
        public function update_password($uid){
            $pass=password_hash($this->password,PASSWORD_DEFAULT);
            $sql="update users set password='{$pass}' where unique_id='{$uid}'";
            mysqli_query($this->link,$sql);
            if(mysqli_affected_rows($this->link)>0){
                return 1; //Password has been changed successfully.
            }
            return 0; //Error exist!
        }

//For query
        public function run_query($query){
            return mysqli_query($this->link, $query);
        }

        public function check_query($query){
            mysqli_query($this->link, $query);
            return mysqli_affected_rows($this->link);
        }

        public function mysqli_real_escape_string($post){
            return mysqli_real_escape_string($this->link,$post);
        }

//Function for reset password
        public function reset_password($email){
            $newsecurity_code =md5(date("h:i:s"));
            $pass=password_hash($this->password,PASSWORD_DEFAULT);
            $sql="update users set password='{$pass}',verify_code='{$newsecurity_code}' where email='{$email}'";
            mysqli_query($this->link,$sql);
            if(mysqli_affected_rows($this->link)>0){
                return 1; //Done, back to login
            }
            return 0; //Error exist!
        }

    }

?>