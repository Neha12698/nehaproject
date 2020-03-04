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

$entityBody = file_get_contents('php://input');
$data  = json_decode($entityBody);
$username = $data->username;
$password = $data->password;

/**-----------------Login functionality-----------------------------**/

if(!empty($username) && !empty($password)){

	$select_user_data = "SELECT * FROM tblregister where email = '".$username."' and password = '".md5($password)."'";
     
	$exe = mysqli_query($conn,$select_user_data);
	$num = mysqli_num_rows($exe);

	$fetch_data = mysqli_fetch_array($exe);
	$action = $fetch_data['action'];
	$firstname = $fetch_data['firstname'];
	$lastname = $fetch_data['lastname'];
	$email = $fetch_data['email'];
	$id = $fetch_data['id'];


	$result = array();
		if($num > 0){
			if($action == 'Active'){


					  $secret_key = "welcome";
			        $issuer_claim = "127.0.0.1"; // this can be the servername
			      $audience_claim = "myuser";
			      $issuedat_claim = time(); // issued at
			     $notbefore_claim = $issuedat_claim + 10; //not before in seconds
			        $expire_claim = $issuedat_claim + 3600; // expire time in seconds
			  
			 	$token = array(

			 		"iss" => $issuer_claim,
		            "aud" => $audience_claim,
		            "iat" => $issuedat_claim,
		            "nbf" => $notbefore_claim,
		            "exp" => $expire_claim,
		            "data" => array(
		            	  	 "id" => $id,
		              "firstname" => $firstname,
		               "lastname" => $lastname,
		               	  "email" => $email,
		                

			 	));


		        $jwt = JWT::encode($token, $secret_key); //encode JWT token 
		        http_response_code(200);
			    	$result["success"] = true;
			    	$result["token"] = $jwt;
					$result["msg"] = "Login successfully.";


				}else{

					$result["success"] = false;
					$result["msg"] = "Your account has been deactivate.Please contact to admin.";

				}

		   
		}else{
				$result["success"] = false;
				$result["msg"] = "The username or password that you've entered doesn't match any account.";
		}


}else{

	$result["success"] = false;
	$result["msg"] = "Fields should not be empty.";
}


header('Content-type: application/json');
echo  json_encode($result);

?>