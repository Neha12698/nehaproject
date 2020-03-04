<?php
function Send_Mail($to,$subject,$body)
{
require 'class.phpmailer.php';
$from = "from@email.com";
$mail = new PHPMailer();
$mail->IsSMTP(true); // SMTP
$mail->SMTPAuth   = true;  // SMTP authentication
$mail->Mailer = "smtp";
$mail->Host       = "tls://smtp.gmail.com"; // Amazon SES server, note "tls://" protocol
$mail->Port       = 465;                    // set the SMTP port
$mail->Username   = "username@gmail.com";  // SES SMTP  username
$mail->Password   = "password";  // SES SMTP password
$mail->SetFrom($from, 'From Name');
$mail->AddReplyTo($from,'9lessons Labs');
$mail->Subject = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);

if(!$mail->Send())
return false;
else
return true;

}
?>