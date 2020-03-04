<?php

//include vender
require "vendor/autoload.php";
use \Firebase\JWT\JWT;

//include header
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Database connection
include 'connection.php';

$secret_key = "welcome";
$jwt = null;
$email_pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";
/*-------------Decode posted data-------------*/
$data = json_decode(file_get_contents("php://input"));
$old_password = $data->old_password;
$new_password = $data->new_password;
$action = $data->action;
$email = $data->email;
$authHeader = $_SERVER['HTTP_TOKEN'];
$arr = explode(" ", $authHeader);

$jwt = $arr[0];


/*--------------Change password functionality------------*/
if($action == 'change_password'){
	  if($jwt){

		try {
		    	$result = array();

		    	/*----------Decode data from JWT token-------------*/
		        $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

		        $user_id = $decoded->data->id;
		        $fetch_user_data = "SELECT password FROM tblregister WHERE id = '".$user_id."'";
		       	$fetch_data = mysqli_query($conn,$fetch_user_data);
		        $row = mysqli_fetch_array($fetch_data);
		        $user_password = $row['password'];

		        if($user_password == md5($old_password) && !empty($old_password)){

		        	if($old_password != $new_password && !empty($new_password)){
		        		
		        		$update_password = "UPDATE tblregister SET password = '".md5($new_password)."' WHERE id = '".$user_id."'"; 
			        	$exe = mysqli_query($conn,$update_password);
			        	if($exe){
			        		$result['success'] = true;
			                $result['msg'] = "Password updated.";
			        	}else{	        		
			        		$result['success'] = false;
			                $result['msg'] = "Password not updated.";
			        	}
			        }else{

			        		$result['success'] = false;
		            		$result['msg'] = "Both Password should not be same.";
			        }

		        			      
		       	}else{
		       		$result['success'] = false;
		            $result['msg'] = "Password should not be empty as well old password same as current password.";
		       	}
		        

		    }catch (Exception $e){

			    http_response_code(401);

			    echo json_encode(array(
			        "message" => "Access denied.",
			        "error" => $e->getMessage()
			    ));
	       } 

	     }else{

          $result['success'] = false;
          $result['data'] = "Invalid Token or empty token.";
       }   
  
}elseif($action == 'email_exist'){ /*--------Check email already exist----------*/

	try {

		if(empty($email)){
			$result['success'] = false;
	        $result['msg'] = "Email should not be empty.";

	    }elseif (!preg_match($email_pattern, $email)) {
	    	$result['success'] = false;
	        $result['msg'] = "Invalid email address.";

	    }else{
	    	$fetch_user_data = "SELECT email FROM tblregister WHERE email = '".$email."'";
	       	$fetch_data = mysqli_query($conn,$fetch_user_data);
	        $row = mysqli_num_rows($fetch_data);

	        if($row == 0){

	        	$result['success'] = true;
	            $result['msg'] = "Email not exist.";     	

	        }else{
	        	$result['success'] = false;
	            $result['msg'] = "Email already exist.";
	        }

	    }
	        
	}catch (Exception $e){

		    http_response_code(401);

		    echo json_encode(array(
		        "message" => "Access denied.",
		        "error" => $e->getMessage()
		    ));
       } 



}else{ /*-----------------If action parameter has invalid and empty value--------*/

	    $result['success'] = false;
	    $result['msg'] = "Invalid action value or empty.";
}	


 header('Content-type: application/json');
 echo json_encode($result);
?>

