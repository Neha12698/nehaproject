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

$data = json_decode(file_get_contents("php://input"));

$authHeader = $_SERVER['HTTP_TOKEN'];
$arr = explode(" ", $authHeader);

$jwt = $arr[0];

if($jwt){
  /**--------------------Fetch user data from database---------------**/
    try {
    	  $result = array();
        $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

        $user_id = $decoded->data->id;
        $fetch_user_data = "SELECT * FROM tblregister WHERE id = '".$user_id."'";
       	$fetch_data = mysqli_query($conn,$fetch_user_data);
              $row = mysqli_fetch_array($fetch_data);

        $someArray = array('firstname' => $row['firstname'],
                            'lastname' => $row['lastname'],
                               'email' => $row['email'],
                            'password' => $row['password'],
                        'phone_number' => $row['phone_num']
                    );

       	if($fetch_data){
          $result['success'] = true;
          $result['data'] = [$someArray];
       		
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
          $result['data'] = "Invalid Token";

}

 header('Content-type: application/json');
        echo json_encode($result);
?>