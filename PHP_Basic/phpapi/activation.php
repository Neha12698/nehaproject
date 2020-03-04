<?php

include 'connection.php';

if(!empty($_GET['code']) && isset($_GET['code']))

	{
	 $activation_code = "SELECT id FROM tblregister WHERE activation='".$_GET['code']."'";
	 $exe_query = mysqli_query($conn,$activation_code);

	if(mysqli_num_rows($exe_query) > 0)
	{
		$status_data = "SELECT id FROM tblregister WHERE activation='".$_GET['code']."' and status='0'";
	    $exe_count = mysqli_query($conn,$status_data);

		if(mysqli_num_rows($exe_count) == 1)
			{
				mysqli_query($conn,"UPDATE tblregister SET status='1' WHERE activation='".$_GET['code']."'");
				 $result['success']=true;
				 $result['msg']="Your account is activated.";
			}
		else
			{
				 $result['success']=false;
				 $result['msg']="Your account is already active, no need to activate again.";
			}

	}
	else
	{
		 $result['success']=false;
		 $result['msg']="Wrong activation code.";
	}

}else{
	    $result['success']=false;
		$result['msg']=" We can't find your verification code.";
}

header('Content-type: application/json');
echo json_encode($result);
?>
