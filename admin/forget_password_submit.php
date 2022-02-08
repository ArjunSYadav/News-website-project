<?php
include "config.php";
include "_db_pdo.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include('smtp/vendor/autoload.php');

$email = $_POST["email"];
 $obj = new database();
$obj->select('user',"*",null,null,"email = '$email' ",null,null,null);
// $result =mysqli_query($conn,"SELECT * FROM user WHERE email = {$email}");
//  $check_user =mysqli_num_rows($result);
$result=$obj->getResult();
foreach($result as $row){
    

if(!empty($result)){
    
// $row =mysqli_fetch_assoc($res);
$pwd= $row['password'];
$html ="Your password is <storng>$pwd<strong>";
// echo smtp_mailer('to','subject',$email);
// function smtp_mailer($to,$subject,$msg){

    $mail =new PHPMailer();
    $mail ->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port =587;
    $mail->isHTML(true);
    $mail->CharSet ='UTF-8';
    $mail->Username = "";//put your email
    $mail->Password ="";//put your email password
    $mail->setFrom("");//put your email
    $mail->Subject ="Your Password";
    $mail->Body =$html;
    $mail->addAddress($email);
    $mail->SMTPOptions =array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false,

    ));
    if($mail->Send()){
        echo "Please check your email id for Pasword" ;
    }else{
        $mail->ErrorInfo;
    }






}else{
    echo " email id not Register with us ";
    die();
}
}

?>