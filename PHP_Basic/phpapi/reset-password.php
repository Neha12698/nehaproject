<?php

 include 'connection.php';
$entityBody = file_get_contents('php://input');
$data  = json_decode($entityBody);
$new_password = $data->password;
$confirm_password = $data->confirm_password;

	if(!empty($_GET['code']) && isset($_GET['code'])){

	   $sql = "SELECT user_email FROM forget_password WHERE token='".$_GET['code']."' LIMIT 1";
	   $results = mysqli_query($conn, $sql);
	   $row = mysqli_fetch_row($results);
	   $email = $row[0];

	    if($email){
	    	if($new_password == $confirm_password){

    		$select_update_data = "SELECT password FROM tblregister where email = '".$email."'";
    		$exe_data = mysqli_query($conn, $select_update_data);
    		$row = mysqli_fetch_row($exe_data);
    		$pwd = $row[0];
    		if($pwd == md5($new_password)){

    			$result['success']=false;
			  	$result['msg']="The password you want to updated already in use.";

    		}else{
    			$update_pwd = "UPDATE tblregister SET `password` = '".md5($new_password)."' where email = '".$email."' "; 
		    	$exe_data = mysqli_query($conn, $update_pwd);
			    	if($exe_data){

			    		$result['success']=true;
			  			$result['msg']="Password updated successfully.";

			    	}else{

			    		$result['success']=false;
			  			$result['msg']="Password not updated.";

			    	}

    		 }
				      
		   }else{

		    		$result['success']=false;
			  		$result['msg']="Password doesn't match.";

		    	}
	    	
	    }else{
	    	   $result['success']=false;
	  		   $result['msg']="No record found.";
	    }

	}

header('Content-type: application/json');
echo  json_encode($result);	

?>