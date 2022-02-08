<?php

if($_SESSION["user_role"] =='0'){
    header("Location: {$hostname}/admin/post.php");

}

include "config.php";

include "_db_pdo.php";
$obj =new database();

$category_id =$_GET['catid'];

// $sql ="DELETE FROM category WHERE `category`.`category_id` ={$category_id}";
$obj->delete("category","`category`.`category_id` ={$category_id}");
$result =$obj->getResult();
if(!empty($result))
{
    header("Location:{$hostname}/admin/category.php");
}else{
    echo"<p style ='color:red;margin:10px 0;'>Can't Delete user rcord</p>";
}

mysqli_close($conn);
?>