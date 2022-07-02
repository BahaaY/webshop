<?php
    if(isset($_POST['make'])){
        $make=$_POST['make'];

        include("../classes/connexion.php");
        include("../classes/user.php");

        $user=new user($bdd->get_link());

        $obj = new stdClass();
        $query="select * from model where make='{$make}' ORDER BY name ASC ";
        $obj->resultat=$user->check_query($query);
        if($obj->resultat>0){
            $option="echo <option selected disabled >-- Select Model --</option>";
            $res=$user->run_query($query);
            while($row=mysqli_fetch_assoc($res)){
                $option.= "echo <option value='".$row['name']."'>".$row['name']."</option>";
            }
            $option.= "echo <option value='Other model'>Other model</option>";
            $obj->row=$option;
        }
        echo json_encode($obj);
    }
?>