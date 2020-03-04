<?php

 include 'connection.php';
$entityBody = file_get_contents('php://input');
$data  = json_decode($entityBody);
$email_pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

$result =array();

   $email = $data->email;
   $str = $email;
   $forget_password_code = md5($str);

	 $sql = "SELECT * FROM tblregister WHERE email = '". $email ."'";
	 $qur = mysqli_query($conn,$sql);
	 $fetch_data = mysqli_fetch_row($qur);
	 $firstname = $fetch_data[1];


	
	 if(empty($email)){

	 	$result['success'] = false;
        $result['msg']="Email field should not be empty.";

	 }elseif (!preg_match($email_pattern ,$email)){ // Email validation

	 	$result['success'] = false;
        $result['msg'] = "Invalid email address.";

	 }elseif(mysqli_num_rows($qur) > 0){

	    $select_data = "SELECT * FROM forget_password where user_email ='".$email."' ";
	 	$qur = mysqli_query($conn,$select_data);
	 	
	 	if(mysqli_num_rows($qur)){
	 		$update_data = "UPDATE forget_password SET token = '".$forget_password_code."' WHERE user_email = '".$email."' ";
	 		$exe_data = mysqli_query($conn, $update_data);

	 	}else{
	 
			$sql = "INSERT INTO forget_password (user_email,token )VALUES ('$email','$forget_password_code')";
			$qur = mysqli_query($conn,$sql);
	 	 } 

		 $reset_password_Link ='https://php.webethics.online/phpapi/reset-password.php?code='.$forget_password_code;

	    $htmlStr = "";
        $htmlStr .= "Hi " . $firstname . ",<br /><br />";
        $htmlStr .= "Please click on the following link to reset your password.<br /><br />";
        $htmlStr .= "<a href='{$reset_password_Link}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>Reset Password</a><br /><br /><br />";

        $htmlStr .= "Kind regards";
       

		 $to = $email;
		 $subject = "Reset Password";
		 $body = $htmlStr;;

		 $send_mail = Send_Mail($to,$subject,$body);

			 if($send_mail){
			 	 $result['success']=true;
	  			 $result['msg']="Please click on link that has been sent to your email to reset password.";
			 }else{
			 	 $result['success']=false;
	  			 $result['msg']="something went wrong.";
			 }

   

	}else{

		$result['success'] = false;
        $result['msg'] = "No user register with this email address!.";
	}

   


header('Content-type: application/json');
echo  json_encode($result);



/**------------------------function for send email by SMTP-----------------------**/

function Send_Mail($to,$subject,$body)
{

	require 'PHPmailer/class.phpmailer.php';
	
	$from       = "php@webethicssolutions.com";
	$mail       = new PHPMailer();
	$mail->IsSMTP(true);            // use SMTP
	$mail->IsHTML(true);
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Host       = "webethicssolutions.com"; // SMTP host
	$mail->Port       =  587;                    // set the SMTP port
	$mail->Username   = "php@webethicssolutions.com";  // SMTP  username
	$mail->Password   = "el*cBt#TuRH^";  // SMTP password
	$mail->SetFrom($from, 'Reset Password');
	$mail->AddReplyTo($from,'Reset Password');
	$mail->Subject    = $subject;
	$mail->MsgHTML($body);
	$address = $to;
	$mail->AddAddress($to);
	$mail->Send();

	if(!$mail->Send())
	return false;
	else
	return true;
}



?>