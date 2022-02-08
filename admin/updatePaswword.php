<?php

include "config.php";
session_start();
include "_db_pdo.php";
$obj =new database();

$old_pass= md5($_POST['old_pass']);
$new_pass=md5($_POST['new_pass']);
// $pasword =md5();
$uid = $_SESSION["user_id"];

$obj->select('user',"*",null,null,"user_id = $uid ",null,null,null);
$result=$obj->getResult();
foreach($result as $row){
   if($old_pass == $row['password']){
    $obj->update('user',["password"=>$new_pass],"user_id = $uid ");
    echo "pasword updated";
   }else{
    echo "Please Enter your valid password";
}
}



?>