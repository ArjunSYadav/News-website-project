<?php
include "config.php";
include "_db_pdo.php";
session_start();

$obj= new database();
if(isset($_POST['submit'])){
    foreach($_FILES['file']['name'] as $key => $value){
        $file = $_FILES['file']['name'][$key];
        $file_tmp=$_FILES['file']['tmp_name'][$key];
        $location ="array_img/";
        $obj->insert('mul_img',["post_id"=>38,"post_image"=>$file]);
        move_uploaded_file($file_tmp,$location.$file);
        echo'true';
        $result =$obj->getResult();
        if(!empty($result)){
            header("Location:{$hostname}/admin/post.php");
        }

    }
}else{
    echo "false";
}

?>