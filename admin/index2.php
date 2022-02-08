<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include "config.php";
include('smtp/vendor/autoload.php');
$html ='Msg';

function smtp_mailer($to,$subject,$msg){

    $mail =new PHPMailer();
    $mail ->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port =587;
    $mail->isHTML(true);
    $mail->CharSet ='UTF-8';
    $mail->Username = "";//put your emil
    $mail->Password ="";//put your eamil paasword
    $mail->setFrom("");//put your email
    $mail->Subject =$subject;
    $mail->Body =$msg;
    $mail->addAddress($to);
    $mail->SMTPOptions =array('ssl'=>array(
        'verify_peer'=>false,
        'verify_peer_name'=>false,
        'allow_self_signed'=>false,

    ));
    if(!$mail->Send()){
        echo $mail->ErrorInfo;
    }else{
        return 'Sent';
    }
}
?>