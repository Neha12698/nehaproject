<?php
require 'Send_Mail.php';
$to = "srinivas.tamada@gmail.com";
$subject = "Test Mail Subject";
$body = "Hi<br/>Test Mail<br/>Amazon SES"; // HTML  tags
Send_Mail($to,$subject,$body);
?>