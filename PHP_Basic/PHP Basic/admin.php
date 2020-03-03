<?php
session_start();
include_once "connect.php";
//include_once "header.php";
if(isset($_SESSION["id"]))
{
	  $sql="select * from users";//----------------------------------Pagination code-----------------------------
      $sql_exe=mysqli_query($conn,$sql);
      $total_records=mysqli_num_rows($sql_exe);
      $limit=4;
      $total_pages=ceil($total_records/$limit);
      

    if(isset($_GET['page']))
     {
     	$pn=$_GET['page'];
     }
    else
	    {
	    	$pn=1;
	    }

	    $start_form=($pn-1)*$limit;

	if(isset($_POST['btnsearch']))
	{
		 $first=$_POST['first'];  
		 $last=$_POST['last']; 
		 $email=$_POST['email'];
		 if(isset($_POST['sex']))
		 $gender=$_POST['sex'];
		 $country=$_POST['con'];
		 $state=$_POST['state'];
		 $where=" state_id=s.id AND c.id=s.con_id AND";
		
			//$query="select * from users where type='user' AND first LIKE '$first%' ";
	 if(isset($first) && $first!="")
	  {
	  	$where.=" first_name LIKE '$first%' AND";
	  }
	 if(isset($last) && $last!="")
	  {
	  	$where.=" last_name LIKE  '$last%' AND";
	  }
	 if(isset($email) && $email!="")
	  {
	  	$where.=" email LIKE  '$email%' AND";
	  }
	 if(isset($gender) && $gender!="")
	  {
	  	$where.=" gen LIKE  '$gender%' AND";
	  }
	 if(isset($country) && $country!="")
	  {
	  	$where.=" con_id LIKE  '$country%' AND";
	  }
	 if(isset($state) && $state!="")
	  {
	  	$where.=" state_id LIKE  '$state%' AND";
	  }

	    $where=rtrim($where,"AND");
        $sel_data="select * from users as u , country as c ,state as s where $where";
	    $sel_exe=mysqli_query($conn,$sel_data);
	    $row=mysqli_num_rows($sel_exe);
	
			if($row == 0)
			{
				$msg="Record Not Found";
			}

		}
		


	else 
	{
		$sel_data="select u.id,u.first_name,u.last_name,u.email,u.img,u.hob,u.gen,c.con_name,s.state_name from users as u INNER JOIN country as c INNER JOIN state as s ON u.state_id=s.id AND c.id=s.con_id  LIMIT ".$start_form.','.$limit;
	  $sel_exe=mysqli_query($conn,$sel_data);
	  $pagLink="";
      for($i=1;$i<=$total_pages;$i++)
      {
        

          if ($i==$pn ) { 
              $pagLink.= "<li class='active'><a href='admin.php?page="
                                                .$i."'>".$i."</a></li>"; 
          }             
          else  { 
              $pagLink.= "<li><a href='admin.php?page=".$i."'> 
                                                ".$i."</a></li>";   
          } 

      }

	}

}
else
{
	header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <div class="topnav">
  <button><a href="logout.php">Logout</a></button>
  </div><br>
  
<style type="text/css">   
	.container
		 {
		     width: 1155px;
		 }
	h2 
		{
		    font-weight: 700;
		    text-align: center;
		}
</style>

<script type="text/javascript">
	function confirmdelete()
	  {
	    return confirm("Are you sure want to delete gallery?");
	  }
</script>
  <script type="text/javascript">//---------------------Script for access state of pariticular country---------- 
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
<form method="post" action="admin.php">
<div class="container">
<h1>Welcome Admin</h1>
<div class="form-group">
<div class="row">
<div class="col-sm-4"><input type="text" name="first" placeholder="Enter first name"  class="form-control" value="<?php if(isset($first)) echo $first; ?>"> </div>  
<div class="col-sm-4"><input type="text" name="last" placeholder="Enter last name"  class="form-control" value="<?php if(isset($last)) echo $last; ?>"></div>  
<div class="col-sm-4"><input type="text" name="email" placeholder="Enter email address"  class="form-control" value="<?php if(isset($email)) echo $email; ?>"></div>  
</div><br>
<div class="row">
<div class="col-sm-1"></div>
<div class="col-sm-1"><input type="radio" name="sex" value="Male" <?php if(isset($gender)) if($gender=='Male') echo 'checked="checked";' ?>>Male</div> 
<div class="col-sm-2"><input type="radio" name="sex" value="Female" <?php if(isset($gender)) if($gender=='Female') echo 'checked="checked";' ?>>Female</div>  
<div class="col-sm-2">
	<select name="con" id="country" class="form-control">
				<option value="">--select country--</option>
				 <?php
                   $selc="select * from country";
                   $exe=mysqli_query($conn,$selc);
                   while($fetch=mysqli_fetch_array($exe,MYSQLI_ASSOC))
                    {
                    	?>
                         <option value="<?php echo $fetch['id'];?>"<?php  if(isset($country)) if($country==$fetch['id']) echo "selected='selected'"; ?>><?php echo $fetch['con_name'];?></option>
                      <?php
                    }
				?>
				
		</select>
		</div>
<div class="col-sm-2">
		<select id="state" name="state" class="form-control">
			  <option value="">Select country first</option>
			   <?php
                   $selc="select * from state where con_id='$country'";
                   $exe=mysqli_query($conn,$selc);
                   while($fetch=mysqli_fetch_array($exe,MYSQLI_ASSOC))
                    {
                    	?>
                         <option value="<?php echo $fetch['id'];?>"<?php  if(isset($state)) if($state==$fetch['id']) echo "selected='selected'"; ?>><?php echo $fetch['state_name'];?></option>
                      <?php
                    }
				?>
				
		</select>
</div>  
<div class="col-sm-1"></div>
<div class="col-sm-2"><input type="submit" name="btnsearch" value="search" class="btn btn-primary btn-block"></div> 
<div class="col-sm-1"></div> 
</div>
</div><br>

     <table  class="table table-hover"> 
      <tr style="background-color:#337ab782;">
        <th>Image</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Hobbies</th>
        <th>Country</th>
        <th>State</th>
        <th>Gender</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      <?php
       	       	  while($fetch_data=mysqli_fetch_array($sel_exe,MYSQLI_ASSOC))
				   {
				 
					    echo "<tr>";
					    echo  "<td>"."<a href='images/album/$fetch_data[img]'><img src=	'images/album/$fetch_data[img]' height=100px width=100px class='img-circle'></a>"."</td>";  
					    echo  "<td style='text-transform:capitalize'>"."$fetch_data[first_name]"."</td>";
					    echo  "<td style='text-transform:capitalize'>"."$fetch_data[last_name]"."</td>";
					    echo  "<td>"."$fetch_data[email]"."</td>";
					    echo  "<td>"."$fetch_data[hob]"."</td>";
					    echo  "<td style='text-transform:capitalize'>"."$fetch_data[con_name]"."</td>";
					    echo  "<td style='text-transform:capitalize'>"."$fetch_data[state_name]"."</td>";
					    echo  "<td>"."$fetch_data[gen]"."</td>";
					    echo  "<td>"."<button>"."<a href='edit-admin.php?id=$fetch_data[id]'>"."Edit"."</a>"."</button>"."</td>";
					    echo  "<td>"."<button onclick='return confirmdelete()'><a href='delete-admin.php?id=$fetch_data[id]'>Delete</button>"."</td>";
					    echo "</tr>";

				    }		  
	  
	   
	    	?>
	 
	</table>
	
	<ul class="pagination">
	<?php 
	if(isset($msg))
	echo "<td><h2>".$msg."</h2></td>";
     
      if(isset($pagLink))
      echo $pagLink;


	?>
	

</ul>
	</div>
</div>

</form>
</body>
</html>