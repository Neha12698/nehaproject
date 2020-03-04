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
$firstname = $data->firstname;
 $lastname = $data->lastname;
    $email = $data->email;
 $password = md5($data->password);
$phone_number = $data->phone_number;

$authHeader = $_SERVER['HTTP_TOKEN'];
$arr = explode(" ", $authHeader);
$phone_pattern = "/^[0-9]{10}+$/";

$jwt = $arr[0];

/**------------------------Update data in database by getting id from token--------**/
if($jwt){

    try {
    	$result = array();
        $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

        $user_id = $decoded->data->id;

        if(empty($firstname) || empty($lastname) || empty($phone_number)){

              $result['success'] = false;
              $result['msg']="Fields should not be empty.";

        }elseif (!preg_match($phone_pattern ,$phone_number)) { //Phone number password

               $result['success'] = false;
               $result['msg'] = "Invalid phone number.";
          
        }else{

           $update_user_data = "UPDATE tblregister SET firstname = '".$firstname."', lastname = '".$lastname."',phone_num = '".$phone_number."' WHERE id = '".$user_id."'";
           $update_data = mysqli_query($conn,$update_user_data);

              if($update_data){

                  $result['success'] = true;
                  $result['msg']="Your data updated successfully.";

              }else{

                  $result['success'] = false;
                  $result['msg'] = "Your data not updated.";

              }


        }
              

        header('Content-type: application/json');
        echo  json_encode($result);

    }catch (Exception $e){

	    http_response_code(401);

	    echo json_encode(array(
	        "message" => "Access denied.",
	        "error" => $e->getMessage()
	    ));
    } 

}

?>