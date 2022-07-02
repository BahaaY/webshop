<?php
    class product{

//Vehicle and mototrcyle
        private $id; 
        private $unique_id;
        private $image;
        private $price_lb; 
        private $price_usd; 
        private $title; 
        private $description;
        private $make; 
        private $model; 
        private $cond; 
        private $year; 
        private $kilometere;
        private $trans;
        private $color; 
        private $body; 
        private $location; 

//Apartment
        private $type;
        private $payment;
        private $bedroom_nb;
        private $bethroom_nb;
        private $floor_nb;
        private $size;

//Setter for vehicle and motorcycle
        public function set_id($id){
            $nb = strlen(trim($id));
            if($nb > 0){
                $this->id=$id;
                return 1; //Done
            }
            return 0; //Error exist! Try again!
        }
        public function set_uniqueId($unique_id){
            $nb = strlen(trim($unique_id));
            if($nb > 0){
                $this->unique_id=$unique_id;
                return 1; //Done
            }
            return 0; //Error exist! Try again!
        }

        public function set_image($image){
            $nb = strlen(trim($image));
            if($nb > 0 && $nb<=255){
                $this->image = $image;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_price_lb($price_lb){
            $nb = strlen(trim($price_lb));
            if($nb > 0 ){
                $space=preg_match('/^[^ ].* .*[^ ]$/', $price_lb);
                $uppercase = preg_match('@[A-Z]@', $price_lb);
                $lowercase = preg_match('@[a-z]@', $price_lb);
                $number = preg_match('@[0-9]@', $price_lb);
                $special_char = preg_match('@[\W]@', $price_lb);
                if(!$space && !$uppercase && !$lowercase && $number && !$special_char){
                    $this->price_lb=$price_lb;
                    return 1; //Done
                }
                return 0; //Enter a valid price!
            }
            return 2; //Required!
        }

        public function set_price_usd($price_usd){
            $nb = strlen(trim($price_usd));
            if($nb > 0 ){
                $space=preg_match('/^[^ ].* .*[^ ]$/', $price_usd);
                $uppercase = preg_match('@[A-Z]@', $price_usd);
                $lowercase = preg_match('@[a-z]@', $price_usd);
                $number = preg_match('@[0-9]@', $price_usd);
                $special_char = preg_match('@[\W]@', $price_usd);
                if(!$space && !$uppercase && !$lowercase && $number && !$special_char){
                    $this->price_usd=$price_usd;
                    return 1; //Done
                }
                return 0; //Enter a valid price!
            }
            return 2; //Required!
        }

        public function set_title($title){
            $nb = strlen(trim($title));
            if($nb > 0 ){
                if($nb <=500){
                    $this->title = $title;
                    return 1; //Done
                }
                return 2; //Enter title between 0 and 500 characters
            }
            return 0; //Required!
        }

        public function set_description($description){
            $nb = strlen(trim($description));
            if($nb > 0 ){
                if($nb<=1000){
                    $this->description = $description;
                    return 1; //Done
                }
                return 2; // Enter description between 0 and 1000 characters
            }
            return 0; //Required!
        }

        public function set_make($make){
            $nb = strlen(trim($make));
            if($nb > 0){
                $this->make = $make;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_model($model){
            $nb = strlen(trim($model));
            if($nb > 0){
                $this->model = $model;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_cond($cond){
            $nb = strlen(trim($cond));
            if($nb > 0){
                $this->cond = $cond;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_year($year){
            $nb = strlen(trim($year));
            if($nb > 0){
                $this->year = $year;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_kilometere($kilometere){
            $nb = strlen(trim($kilometere));
            if($nb > 0){
                $this->kilometere = $kilometere;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_trans($trans){
            $nb = strlen(trim($trans));
            if($nb > 0){
                $this->trans = $trans;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_color($color){
            $nb = strlen(trim($color));
            if($nb > 0){
                $this->color = $color;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_body($body){
            $nb = strlen(trim($body));
            if($nb > 0){
                $this->body = $body;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_location($location){
            $nb = strlen(trim($location));
            if($nb > 0 ){
                if($nb<=255){
                    $this->location=$location;
                    return 1; //Done
                }
                return 2; //Enter location between 0 and 1000 characters
            }
            return 0; //Required!
        }

//Setter for apartment 
        public function set_type($type){
            $nb = strlen(trim($type));
            if($nb > 0){
                $this->type = $type;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_payment($payment){
            $nb = strlen(trim($payment));
            if($nb > 0 ){
                $this->payment = $payment;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_bedroom_nb($bedroom_nb){
            $nb = strlen(trim($bedroom_nb));
            if($nb > 0){
                $this->bedroom_nb = $bedroom_nb;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_bethroom_nb($bethroom_nb){
            $nb = strlen(trim($bethroom_nb));
            if($nb > 0 ){
                $this->bethroom_nb = $bethroom_nb;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_floor_nb($floor_nb){
            $nb = strlen(trim($floor_nb));
            if($nb > 0){
                $this->floor_nb = $floor_nb;
                return 1; //Done
            }
            return 0; //Required!
        }

        public function set_size($size){
            $nb = strlen(trim($size));
            if($nb > 0 ){
                $space=preg_match('/^[^ ].* .*[^ ]$/', $size);
                $uppercase = preg_match('@[A-Z]@', $size);
                $lowercase = preg_match('@[a-z]@', $size);
                $number = preg_match('@[0-9]@', $size);
                $special_char = preg_match('@[\W]@', $size);
                if(!$space && !$uppercase && !$lowercase && $number && !$special_char){
                    $this->size=$size;
                    return 1; //Done
                }
                return 0; //Enter a valid size!
            }
            return 2; //Required!
        }

        public function __construct($link){
            $this->link = $link;
        }

//Getter for vehicle and motorcycles
        public function get_id(){
            return $this->id;
        }
        public function get_unique_id(){
            return $this->unique_id;
        }
        public function get_image(){
            return $this->image;
        }
        public function get_price_lb(){
            return $this->price_lb;
        }
        public function get_price_usd(){
            return $this->price_usd;
        }
        public function get_title(){
            return $this->title;
        }
        public function get_description(){
            return $this->description;
        }
        public function get_make(){
            return $this->make;
        }
        public function get_model(){
            return $this->model;
        }
        public function get_cond(){
            return $this->cond;
        }
        public function get_year(){
            return $this->year;
        }
        public function get_kilometere(){
            return $this->kilometere;
        }
        public function get_trans(){
            return $this->trans;
        }
        public function get_color(){
            return $this->color;
        }
        public function get_body(){
            return $this->body;
        }
        public function get_location(){
            return $this->location;
        }

//Getter for apartment
        public function get_type(){
            return $this->type;
        }

        public function get_payment(){
            return $this->payment;
        }

        public function get_bedroom_nb(){
            return $this->bedroom_nb;
        }

        public function get_bethroom_nb(){
            return $this->bethroom_nb;
        }

        public function get_floor_nb(){
            return $this->floor_nb;
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


//Sell product
        public function sell_product($table_name){
            if($table_name=="product_vehicle_motorcycle"){
                $sql = "insert into $table_name (unique_id,price_lb,price_usd,title,description,make,model,cond,year,kilometere,trans,color,body,location)
                    values('{$this->unique_id}','{$this->price_lb}', '{$this->price_usd}', '{$this->title}', '{$this->description}', '{$this->make}','{$this->model}'
                    ,'{$this->cond}','{$this->year}','{$this->kilometere}','{$this->trans}','{$this->color}','{$this->body}','{$this->location}')";    
                mysqli_query($this->link, $sql);
                if(mysqli_affected_rows($this->link) > 0){
                    $this->id=mysqli_insert_id($this->link);
                    return 1; //Done
                }
                return 0; //Error exist!
            }else if($table_name=="product_apartment"){
                $sql = "insert into $table_name (unique_id,price_lb,price_usd,title,description,type,payment,bedroom_nb,bethroom_nb,floor_nb,cond,size,location)
                    values('{$this->unique_id}','{$this->price_lb}', '{$this->price_usd}', '{$this->title}', '{$this->description}', '{$this->type}','{$this->payment}'
                    ,'{$this->bedroom_nb}','{$this->bethroom_nb}','{$this->floor_nb}','{$this->cond}','{$this->size}','{$this->location}')";    
                mysqli_query($this->link, $sql);
                if(mysqli_affected_rows($this->link) > 0){
                    $this->id=mysqli_insert_id($this->link);
                    return 1; //Done
                }
                return 0; //Error exist!
            }else if($table_name=="product_electronic_home" || $table_name=="product_home_furniture" || $table_name=="product_laptop_tablet_computer"){
                $sql = "insert into $table_name (unique_id,price_lb,price_usd,title,description,type,cond,location)
                    values('{$this->unique_id}','{$this->price_lb}', '{$this->price_usd}', '{$this->title}'
                    , '{$this->description}', '{$this->type}','{$this->cond}','{$this->location}')";    
                mysqli_query($this->link, $sql);
                if(mysqli_affected_rows($this->link) > 0){
                    $this->id=mysqli_insert_id($this->link);
                    return 1; //Done
                }
                return 0; //Error exist!
            }else if($table_name=="product_land"){
                $sql = "insert into $table_name (unique_id,price_lb,price_usd,title,description,type,size,location)
                    values('{$this->unique_id}','{$this->price_lb}', '{$this->price_usd}', '{$this->title}'
                    ,'{$this->description}', '{$this->type}','{$this->size}','{$this->location}')";    
                mysqli_query($this->link, $sql);
                if(mysqli_affected_rows($this->link) > 0){
                    $this->id=mysqli_insert_id($this->link);
                    return 1; //Done
                }
                return 0; //Error exist!
            }
        }

//Insert image product
        public function insert_image_product($product_name){
            $id=$this->get_id();
            $extension=array('jpeg','jpg','png');
            foreach ($_FILES['input_image']['tmp_name'] as $key => $val) {
                $filename=$_FILES['input_image']['name'][$key];
                $filename_tmp=$_FILES['input_image']['tmp_name'][$key];
                $ext=pathinfo($filename,PATHINFO_EXTENSION);
            
                $finalimg='';
                if(in_array($ext,$extension)){
                    if(!file_exists('images_items/'.$filename)){
                        $filename=str_replace('.','-',basename($filename,$ext));
                        $newfilename=$filename.time()."_".$id.".".$ext;
                        move_uploaded_file($filename_tmp, 'images_items/'.$newfilename);
                        $finalimg=$newfilename;
                    }else{
                        $filename=str_replace('.','-',basename($filename,$ext));
                        $newfilename=$filename.time()."_".$id.".".$ext;
                        move_uploaded_file($filename_tmp, 'images_items/'.$newfilename);
                        $finalimg=$newfilename;
                    }
                    //insert image
                    $image=$this->set_image($finalimg);
                    if($image==1){
                        $sql = "insert into image (id_product,img,product) values('{$this->id}','{$this->image}','{$product_name}')";    
                        mysqli_query($this->link, $sql);
                    }
                }
            }
        }

        public function update_image_product($id,$product){
            $extension=array('jpeg','jpg','png');
            foreach ($_FILES['img']['tmp_name'] as $key => $val) {
                    $filename=$_FILES['img']['name'][$key];
                    $filename_tmp=$_FILES['img']['tmp_name'][$key];
                    $ext=pathinfo($filename,PATHINFO_EXTENSION);
                    $finalimg='';
                    if(in_array($ext,$extension)){
                        if(!file_exists('../images_items/'.$filename)){
                            $filename=str_replace('.','-',basename($filename,$ext));
                            $newfilename=$filename.time()."_".$id.".".$ext;
                            move_uploaded_file($filename_tmp, '../images_items/'.$newfilename);
                            $finalimg=$newfilename;
                        }else{
                            $filename=str_replace('.','-',basename($filename,$ext));
                            $newfilename=$filename.time()."_".$id.".".$ext;
                            if(move_uploaded_file($filename_tmp, '../images_items/'.$newfilename));
                            $finalimg=$newfilename;
                        }
                        $image=$this->set_image($finalimg);
                        if($image==1){
                            $sql = "insert into image (id_product,img,product) values('{$id}','{$newfilename}','{$product}')";    
                            $this->run_query($sql);
                        }
                    }
                } 
        }
        
    }
?>