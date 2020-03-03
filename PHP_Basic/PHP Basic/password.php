<?php
session_start();
include('connect.php');
include('header.php');
?>

<body>
<?php
if(isset($_SESSION["id"]))
{
 if(isset($_POST['btnsub']))
  {

  $old_pass=md5($_POST['opass']);
 
  $new_pass=md5($_POST['pass']);
  $cpass=md5($_POST['cpass']);

  $sel_pass="select pass from users where pass='$old_pass' && id='$_SESSION[id]' ";
  $exe_pass=mysqli_query($conn,$sel_pass);
  $row=mysqli_num_rows($exe_pass);
  if($row==0)
  {
  	$err="Please enter correct password.";
  }

  elseif(empty($_POST['pass']))
  {

     $passerr="Enter new password.";
  }
  elseif($cpass==$new_pass)
  {
  
	$upd="update users set pass='$new_pass' where id='$_SESSION[id]'";
	$exe_upd=mysqli_query($conn,$upd);
	if($exe_upd>0)
	  {
	   $suc_upd="Password updated sucessfully.";
	  }
  else
	  {
	  	 $suc_upd=" Password not updated.";
	  }
   
  }

  else
    {
    	$cpasserr="confirm password.";
    }
  }

}
else
{
  header("location:login.php");
}
?>
<a href="welcome.php"  class="btn btn-default">Back</a>
<form method="post" action="password.php">
  <div class="container">
  	<center><span class="sucess"><?php if(isset($suc_upd)) echo $suc_upd; ?></span></center>
  	<h1>Change Password</h1><br>
    <div class="form-group">
		<lable for="password" class="col-sm-3 control-label">Old Password</lable>
		<div class="col-sm-9">
		<input type="password" name="opass" placeholder="********" class="form-control"  value=""></br>
		 <span class="error"><?php if(isset($err)) echo $err; ?></span>
        </div>
	</div>
    <div class="form-group">
		<lable for="password" class="col-sm-3 control-label"> New Password</lable>
		<div class="col-sm-9">
		<input type="password" name="pass" placeholder="********" class="form-control"  value=""></br>
        <span class="error"><?php if(isset($passerr)) echo $passerr; ?></span>
        </div>
	</div>
	<div class="form-group">
		<lable for="cpassword" class="col-sm-3 control-label">Confirm Password</lable>
		<div class="col-sm-9">
		<input type="password" name="cpass" placeholder="********" class="form-control" value=""></br>
         <span class="error"><?php if(isset($cpasserr)) echo $cpasserr; ?></span>
         </div>
	</div>
	<div class="form-group">
		<div class="col-sm-3"></div>
		<div class="col-sm-4"><button type="submit" name="btnsub" class="btn btn-primary btn-block">Submit</button></div>
		<div class="col-sm-5"></div>
    </div>
  </div>
</form>

<?php 
include('footer.php');
?>
