<?php
include "config.php";

include "_db_pdo.php";
$obj = new database();

    if(empty($_FILES['new-image']['name']))
    {
        $target =$_POST['old-image'];
        $new_name =$target;
    }else{
        
        $errors =array();

        $file_name =$_FILES['new-image']['name'];
        $file_size =$_FILES['new-image']['size'];
        $file_tmp =$_FILES['new-image']['tmp_name'];
        $file_type =$_FILES['new-image']['type'];
        $file_ext =explode('.',$file_name);
        $fileActualExit =strtolower(end($file_ext));

        $extension =array("jpeg","jpg","png");
        if(in_array($fileActualExit,$extension) === false)
        {
            $errors[]="this extension filetype is not allowed, please choose a jpg, png ,or jpeg";

        }
       

        if($file_size >2097152)
        {
            $errors[] ="File size must be 2mb or lower";
        }
        $new_name= time()."-".basename($file_name);
        $target ="upload/".$new_name;
        $image_name =$new_name;
        if(empty($errors)==true)
        {
            move_uploaded_file($file_tmp,$target);

        }
        else{
            print_r($errors);
            die();
        }
    }

    // update multiple images start
    $mulpost_id=$_POST['post_id'];
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
                        
                         
     
                     }else{
                         
                             $file = $_FILES['file']['name'][$key];
                             $file_tmp=$_FILES['file']['tmp_name'][$key];
                             $location ="array_img/";
                             $obj->insert('mul_img',["post_id"=>$mulpost_id,"post_image"=>$file]);
                             move_uploaded_file($file_tmp,$location.$file);
                             
                            
                     
                         
                     }
                 }
        }
         
         die();
        
     }
     else{
         echo 'false';
     }

    //end multiple images 
echo $new_name;
$post_id=$_POST['post_id'];
$post_desc=$_POST['postdesc'];
echo $_POST['category'];
$sql="";
$obj->update('post',["title"=>$_POST['post_title'], "description"=>"$post_desc", "category"=>$_POST['category'], "post_img"=>$new_name], "post_id= $post_id ");
$result =$obj->getResult();

 if($_POST['old_category'] != $_POST['category'])
 {   

     echo $_POST['old_category']."</br>";
    
     echo $sql ="UPDATE category SET post = post-1 WHERE category_id = {$_POST['old_category']};";
      echo $sql.="UPDATE category SET post = post+1 WHERE category_id = {$_POST['category']}";
      mysqli_multi_query($conn,$sql);
 }



if(!empty($result) )
{
    header("Location:{$hostname}/admin/post.php");

}else{
    echo"querry Failed";
}


?>