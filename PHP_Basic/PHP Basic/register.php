<?php 
include'connect.php';
include 'function.php';
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
  <script type="text/javascript">
  	 $(document).ready(function()
	  	 {
	  	 	$('#country').on('change',function(){
	  	 	var countryID=$(this).val();
	  	 	if(countryID)
		  	 	{
		  	 		$.ajax({
                       type:'POST',
                       url:'https://dev.webethics.online/neha/ajax.php',
                       data:'con_id='+countryID,
                       success:function(html)
                        {
                        	$('#state').html(html);
                        }

		  	 		});


		  	 	}
		  	 else	
		  	 	{ 
                   $('#state').html('<option value="">--select data----</option>');
		  	 	}

	  	 	});


	  	 	
	  	 });

  </script>





</head>
<body>
<form class="form-horizontal" method="post" action="register.php" enctype="multipart/form-data">  
  <div class="container">
     <h1>Registration Form</h1>
     <?php if(isset($message) && $message=='success'){ ?> <span class="success">Data inserted sucessfully</span> <?php } ?>
	<div class="form-group">
		<lable  for="name" class="col-sm-3 control-label">First name</lable>
		<div class="col-sm-9">
		<input type="text" name="n1" placeholder="Enter first name"  class="form-control" value ="<?php if(isset($first)) echo $first; ?>"> </br> 
	    <span class = "error"><?php if(isset($error['first'])) echo $error['first']; ?></span> 
	    </div>  
	</div>
	<div class="form-group">
		<lable for="name" class="col-sm-3 control-label">Last name</lable>
		<div class="col-sm-9">
		<input type="text" name="last" placeholder="Enter last name" class="form-control" value="<?php if(isset($last))  echo $last; ?>"></br>
        <span class = "error"><?php if(isset($error['last'])) echo $error['last']; ?></span> 
        </div> 
	</div>
	<div class="form-group">
		<lable for="email" class="col-sm-3 control-label">Email</lable>
		<div class="col-sm-9">
		<input type="text" name="eml" placeholder="Enter email address" class="form-control" value="<?php if(isset($email)) echo $email ;?>"></br>
		<?php if(isset($message) && $message=='error') {?> <span class="error">Email Already Exist. Please enter other email.</span> <?php } ?>
        <span class="error"><?php if(isset($error['email'])) echo $error['email']; ?></span>

        </div>
    
	</div>
	<div class="form-group">
		<lable for="password" class="col-sm-3 control-label">Password</lable>
		<div class="col-sm-9">
		<input type="password" name="pass" placeholder="********" class="form-control"  value=""></br>
        <span class="error"><?php if(isset($error['pass'])) echo $error['pass']; ?></span>
        </div>
	</div>
	<div class="form-group">
		<lable for="cpassword" class="col-sm-3 control-label">Confirm Password</lable>
		<div class="col-sm-9">
		<input type="password" name="cpass" placeholder="********" class="form-control" value=""></br>
         <span class="error"><?php if(isset($error['cpass'])) echo $error['cpass']; ?></span>
         </div>
	</div>
	<div class="form-group">
		<lable for="hobbies" class="col-sm-3 control-label">Hobbies</lable>
		<div class="col-sm-9">
		<?php 
          if(isset($hob)) 
          {
		   $arr=explode(",",$hob);
          }
		?>
		<input type="checkbox" name="chk[]" value="Dancing"   <?php  if(!empty($arr)) if(in_array("Dancing",$arr)){echo "checked";}?>>Dancing
		<input type="checkbox" name="chk[]" value="Traveling"  <?php if(!empty($arr)) if(in_array("Traveling",$arr)){echo "checked";}?>>Traveling
		<input type="checkbox" name="chk[]" value="Painting" <?php  if(!empty($arr)) if(in_array("Painting",$arr)){echo "checked";}?>>Painting
		<input type="checkbox" name="chk[]" value="Reading " <?php  if(!empty($arr)) if(in_array("Reading",$arr)){echo "checked";}?>>Reading 
         <span class = "error"><?php if(isset($error['hob'])) echo $error['hob']; ?></span>
         </div>
	</div><br>
	<div class="form-group">
		<lable for="country" class="col-sm-3 control-label">Country</lable>
		<div class="col-sm-4">
		<select name="con" id="country" class="form-control">
				<option value="">--select country--</option>
				 <?php
                   $sel="select * from country";
                   $sel_exe=mysqli_query($conn,$sel);
                   while($fetch=mysqli_fetch_array($sel_exe,MYSQLI_ASSOC))
	                    {
	                      echo "<option value='$fetch[id]'>$fetch[con_name]</option>";
	                    }
				 ?>
				
		</select>
	    </div>
	    	<lable for="state" class="col-sm-1 control-label">State</lable>
        <div class="col-sm-4">
		<select id="state" name="state" class="form-control">
			  <option value="">-Select country first-</option>
		</select>
          </div>
			<span class = "error"><?php if(isset($error['con'])) echo $error['con']; ?></span>
	</div><br>
	<div class="form-group">
		<lable for="gender" class="col-sm-3 control-label">Gender</lable>
		<div class="col-sm-9">
		<input type="radio" name="gender"  value="Male"  <?php if(isset($sex)) if($sex=="Male"){echo "checked";}?>>Male
        <input type="radio" name="gender" value="Female" <?php if(isset($sex)) if($sex=="Female"){echo "checked";}?>>Female<br>
        <span class = "error"><?php if(isset($error['sex'])) echo $error['sex']; ?></span>
        </div>
	</div><br>

	<div class="form-group">
		<lable for="image" class="col-sm-3 control-label">Image</lable>
		<div class="col-sm-9">
		<input type="file" name="img">
        </div>
	</div><br>
	<input type="hidden" name="mode"  class="form-control" value="add">
	<div class="form-group">
		<div class="col-sm-3"></div>
		<div class="col-sm-4"><button type="submit" name="btnsub" class="btn btn-primary btn-block">Submit</button></div>
		<div class="col-sm-4"><a href="login.php" class="btn btn-primary btn-block">Login</a></div>
		<div class="col-sm-1"></div>
    </div>
</div>
</form>
<br><br>

<center>

<?php
 if(isset($_POST['btnsub']))
  {
	if(empty($first)||empty($last)||empty($email)||empty($pass)||empty($cpass)||empty($hob)||empty($state)||empty($sex))
		{
	     echo "";
	    }

    else
	   {  
			echo"<table border='2'>";
			echo "<tr>";
		    echo  "<td colspan='2'>"."<h4>"."Submitted Data"."</h4>"."</td>";
			echo "</tr>";
			echo "</tr>";
			echo "<tr>";
			echo  "<th>"."First name"."</th>"."<td>".$first."</td>";
			echo "</tr>";
			echo "<tr>";
			echo   "<th>"."Last name"."</th>". "<td>".$last."</td>";
			echo "</tr>";
			echo "<tr>";
			echo    "<th>"."Email"."</th>". "<td>".$email."</td>";
			echo "</tr>";
			echo "<tr>";
			echo   "<th>"."Password"."</th>". "<td>".$pass."</td>";
			echo "</tr>";
			echo "<tr>";
			echo   "<th>"."Confirm password"."</th>"."<td>".$cpass."</td>";
			echo "</tr>";
			echo "<tr>";
			echo   "<th>"."Hobbies"."</th>"."<td>".$hob."</td>";
			echo "</tr>";
			echo "<tr>";
			echo   "<th>"."States"."</th>"."<td>".$state."</td>";
			echo "</tr>";
			echo "<tr>";
			echo  "<th>"."Gender"."</th>"."<td>".$sex."</td>";
			echo "</tr>";
			echo"</table>";
	   }
  }    

?>



<?php 
include('footer.php');
?>
