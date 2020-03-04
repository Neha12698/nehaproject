<?php
 include 'connection.php';

	$get_userid = $_GET['id'];

	$get_data = "SELECT * FROM  tblregister WHERE id = '".$get_userid."'";

	$exe_qry = mysqli_query($conn, $get_data);
	$fetch_data = mysqli_fetch_array($exe_qry);
	$action = $fetch_data['action'];

	if(mysqli_num_rows($exe_qry) > 0){

		if($action == "Active"){

			$update_deac = "UPDATE tblregister SET action = 'Deactivate' where id = '".$get_userid."'";
			$exe_qry_deac = mysqli_query($conn, $update_deac);

				if($exe_qry_deac){

					$result["success"] = true;
					$result["msg"] = "Account is deactivated successfully.";

				}else{

					$result["success"] = false;						
					$result["msg"] = "Oops! account is already active.";
				}


		}else{
			
			$update_act = "UPDATE tblregister SET action = 'Active' where id = '".$get_userid."'";
			$exe_qry_act = mysqli_query($conn, $update_act);

				if($exe_qry_act){

					$result["success"] = true;
					$result["msg"] = "Account is activated successfully.";

				}else{

					$result["success"] = false;
					$result["msg"] = "Oops! account is already Deactivate.";
				}

		}

	}else{

		$result["success"] = false;
		$result["msg"] = "Sorry, No account is register.";

	}
	
header('Content-type: application/json');
echo  json_encode($result);

?>