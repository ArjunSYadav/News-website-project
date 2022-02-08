<?php
include "config.php";

include "_db_pdo.php";

$obj = new database();

// $imageno=$_POST['id'];
if(isset($_POST['id']) && $_POST['id']>0)
{
    $image_id=$_POST['id'];
    $obj->delete('mul_img',"i_id = $image_id ");
    // echo'true';
}
if(isset($_POST['p_images_id']) && $_POST['p_images_id']>0){
   foreach($_FILES['file']['name']as $key =>$val){
            if($_FILES['file']['name'][$key] !=''){
                if(isset($_POST['p_images_id'][$key])){

                    $image_uid =$_POST['p_images_id'][$key];
                    $file = $_FILES['file']['name'][$key];
                    $file_tmp=$_FILES['file']['tmp_name'][$key];
                    $location ="array_img/";
                    $obj->update('mul_img',["post_image"=>$file],"i_id = $image_uid ");
                    move_uploaded_file($file_tmp,$location.$file);
                    echo'true';
                    header("Location:{$hostname}/admin/post.php");

                }else{
                    
                        $file = $_FILES['file']['name'][$key];
                        $file_tmp=$_FILES['file']['tmp_name'][$key];
                        $location ="array_img/";
                        $obj->insert('mul_img',["post_id"=>38,"post_image"=>$file]);
                        move_uploaded_file($file_tmp,$location.$file);
                        echo'true';
                        header("Location:{$hostname}/admin/post.php");
                
                    
                }
            }
   }
    
    die();
   
}
else{
    echo 'false';
}

?>