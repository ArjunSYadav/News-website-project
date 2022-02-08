<?php
include "config.php";

include "_db_pdo.php";
    $obj_1 =new database();
    if(isset($_FILES['fileToUpload']))
    {
        $errors =array();

        $file_name =$_FILES['fileToUpload']['name'];
        $file_tmp =$_FILES['fileToUpload']['tmp_name'];
        $file_size =$_FILES['fileToUpload']['size'];
        $file_type =$_FILES['fileToUpload']['type']; 
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
        // 
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
   

    session_start();

  $title = mysqli_real_escape_string($conn,$_POST['post_title']);
  $desc = mysqli_real_escape_string($conn,$_POST['postdesc']);
  $category = mysqli_real_escape_string($conn,$_POST['category']);
  $date =date("d M, Y");
  $author_name= $_SESSION['user_id'];

    // $sql ="INSERT INTO post( title , description , category	 , post_date , author , post_img  )  VALUES('{$title}','{$desc}',{$category},'{$date}',{$author_name},'{$image_name}');";
    $obj_1->insert("post", ['title' =>$title, 'description' =>$desc, 'category' =>$category, 'post_date' =>$date, 'author' =>$author_name, 'post_img' => $image_name]);
        
      $sql = "UPDATE  category  SET  post  =  post  +1  WHERE  category_id  = {$category}";
    $result1=mysqli_query($conn,$sql) or die("Update diddnot work");
    // $newpost= "post = post+1";
    //  $obj_1->update("category", ['post'=> 'post+1'], 'category_id  = {$category}');
     $result=$obj_1->getResult();
     $post_id = $obj_1->last_insertId();
    
     if(isset($_POST['submit'])){
         foreach($_FILES['file']['name'] as $key => $value){
             $file = $_FILES['file']['name'][$key];
             $file_tmp=$_FILES['file']['tmp_name'][$key];
             $location ="array_img/";
             $obj_1->insert('mul_img',["post_id"=>$post_id ,"post_image"=>$file]);
             move_uploaded_file($file_tmp,$location.$file);
             echo'true';
             $result =$obj_1->getResult();
             if(!empty($result)){
                 header("Location:{$hostname}/admin/post.php");
             }
     
         }
     }else{
         echo "false";
     }

    if(!empty($result))
    {
        header("Location:{$hostname}/admin/post.php");
    }else{
        echo"<div class='alert alert-danger'>Query Failed.</div>";
    }


?>