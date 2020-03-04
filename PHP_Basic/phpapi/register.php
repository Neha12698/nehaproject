<?php

 include 'connection.php';
$entityBody = file_get_contents('php://input');
$data  = json_decode($entityBody);
$email_pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
$phone_pattern = "/^[0-9]{10}+$/";

$result =array();


	$firstname = $data->firstname;
	 $lastname = $data->lastname;
	    $email = $data->email;
	 $password = md5($data->password);
	   $number = $data->phone_number;
   $activation = md5($email.time());



	 $sql = "SELECT * FROM tblregister WHERE email = '". $email ."'";
	 $qur = mysqli_query($conn,$sql);



	 if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($number)){

	 	$result['success'] = false;
        $result['msg']="Fields should not be empty.";

	 }elseif (!preg_match($email_pattern ,$email)){ // Email validation

	 	$result['success'] = false;
        $result['msg'] = "Invalid email address.";

	 }elseif (!preg_match($phone_pattern ,$number)) { //Phone number password

		$result['success'] = false;
         $result['msg'] = "Invalid phone number.";
		
	}
	elseif(mysqli_num_rows($qur) > 0){

	     $result['success'] = false;
         $result['msg'] = "Email address already exist.";

	}else{

		 $sql = "INSERT INTO tblregister (firstname, lastname, email, password,phone_num,activation)VALUES ('$firstname', '$lastname', '$email', '$password','$number','$activation')";

		 $qur = mysqli_query($conn,$sql);
		 $verificationLink ='https://php.webethics.online/phpapi/activation.php?code='.$activation;

	    $htmlStr = "";
        $htmlStr .= "Hi " . $firstname . ",<br /><br />";
        $htmlStr .= "Thank you for registering at our Website.<br /><br />";
        $htmlStr .= "Please click the button below to verify your registration and get started using your Website account.<br /><br /><br />";
        $htmlStr .= "<a href='{$verificationLink}' target='_blank' style='padding:1em; font-weight:bold; background-color:blue; color:#fff;'>VERIFY EMAIL</a><br /><br /><br />";

        $htmlStr .= "Kind regards";
       

		 $to = $email;
		 $subject = "Email verification";
		 $body = $htmlStr;;

		 $send_mail = Send_Mail($to,$subject,$body);

			 if($send_mail){
			 	 $result['success']=true;
	  			 $result['msg']="you have regtistered Succesfully.Please click on link that has been sent to your email to verify your account.";
			 }else{
			 	 $result['success']=false;
	  			 $result['msg']="you are not regtistered Succesfully.";
			 }



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
	$mail->SetFrom($from, 'Acctivate account');
	$mail->AddReplyTo($from,'Acctivate account');
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