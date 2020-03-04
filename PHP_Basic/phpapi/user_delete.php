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

$authHeader = $_SERVER['HTTP_TOKEN'];
$arr = explode(" ", $authHeader);

$jwt = $arr[0];

if($jwt){
  /**--------------------Fetch user data from database---------------**/
    try {
    	  $result = array();
        $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

        $user_id = $decoded->data->id;
        $fetch_user_data = "DELETE FROM tblregister WHERE id = '".$user_id."'";
       	$fetch_data = mysqli_query($conn,$fetch_user_data);
              $row = mysqli_fetch_array($fetch_data);
       
       	if($fetch_data){
          $result['success'] = true;
          $result['data'] = "User data deleted successfully.";
       		
       	}else{
       		$result['success'] = false;
          $result['msg'] = "Unsuccessfull.";
       	}
        

    }catch (Exception $e){

	    http_response_code(401);

	    echo json_encode(array(
	        "message" => "Access denied.",
	        "error" => $e->getMessage()
	    ));
    } 

}else{   /**----------------------If token is empty and Invalid----------------**/

          $result['success'] = false;
          $result['data'] = "Invalid Token or empty token.";

}

 header('Content-type: application/json');
 echo json_encode($result);
?>