
<?php
session_start();
include('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <style type="text/css">
  	
  	p
	  	{
	  		background-color: black;
	  	}
  	h1
	  	{
	  		padding-left: 29px;	
	       font-size: 52px;
	  	}
  </style>
</head>
<body>
    <?php
	if(isset($_POST['btnsub']))
	{
		$username=$_POST['n1'];
		$password=md5($_POST['n2']);
         if(empty($username))
         {
         	$err_user="Enter email address";
         }
        elseif(!preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $username))
         {
         	$err_user="Enter valid email address";
         }
         elseif(empty($password))
         {
         	$err_pass="Enter Password";
         }
       
         else 
      		 {	
      		$sel="select * from users where email='$username' && pass='$password'";
			$exe=mysqli_query($conn,$sel);
			$fetch=mysqli_fetch_array($exe);
			$_SESSION["id"] = $fetch['id'];
			$_SESSION["name"] = $fetch['first_name'];
		        if(isset($_SESSION["id"]) && $fetch['user_type'] == 'admin')
			       {
						echo"hello";
						header("location:admin.php");
						
				   } 
				elseif(isset($_SESSION["id"]) && $fetch['user_type'] == 'user')
				   {
				   	header("location:welcome.php");
					
				   }
				 else
				   {
				   	$message = "!...Invalid Username or Password.";
					
				   }  

             }


		  
   }

?>
  <form class="form-horizontal" method="post" action="login.php">  
    <div class="container">
      <h1>Login Form</h1>
      <div class="form-group">
			<div class="col-sm-4"></div>
			<div class="col-sm-5">
			<img src="images/user.png" class="img-circle" height:"200px" width:"200px"> </br> 
		    </div>  
			<div class="col-sm-3"></div>
		</div>
		<br><br>
		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
			<input type="text" name="n1" placeholder="Enter email"  class="form-control"> </br> 
			<span class = "error"><?php if(isset($err_user)) echo $err_user; ?></span> 
		    </div>  
			<div class="col-sm-2"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
			<input type="Password" name="n2" placeholder=" Enter Password" class="form-control"></br>
			 <span class = "error"><?php if(isset($err_pass)) echo $err_pass; ?></span> 
	        </div> 
	        <div class="col-sm-2"></div>
		</div>
		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-4"><button type="submit" name="btnsub" class="btn btn-primary btn-block">Login</button>
			</div>
			<div class="col-sm-4"><a href="register.php" class="btn btn-primary btn-block">Sign in</a></div>
	        <div class="col-sm-2"></div>   
       </div>
   </div><br><br>
   <center><span class="error"><?php if (isset($message)){echo $message;} ?></span>	</center> 
  </form>
</body>
</html>


