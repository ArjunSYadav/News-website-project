<?php
include "config.php";
include "_db_pdo.php";

$obj= new database();
if($_FILES['file']['name'] !=''){

    $files_names = '';

    $total =count($_FILES['file']['name']);

    for($i=0; $i<$total; $i++){

        $filename=$_FILES['file']['name'][$i];
        $extension = pathinfo($filename,PATHINFO_EXTENSION);

        $valid_exentesions = array("png","jpg","jpeg");
        if(in_array($extension, $valid_exentesions)){
            $new_name = rand(). "." .$extension;
            $path = "array_img/". $new_name;
            move_uploaded_file($_FILES['file']['tmp_name'][$i], $path);

             $files_names .= $new_name . ", ";
            
            
        }else{
            echo 'false';
        }
    }
    $obj->insert('mul_img',["post_id"=>38,"post_image"=>$files_names]);
    $result =$obj->getResult();
    if(!empty($result)){
        echo "true";
    }else{
        echo "false";
    }
   
}
else{
    echo 'false';
}



?>

