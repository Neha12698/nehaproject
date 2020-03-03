<?php
include('connect.php');
session_start();
include('header.php');
?>
<style type="text/css">
    
.container {
    width: 1155px;
}

</style>
<body>
<form>
    <div class="container">

<h1>Welcome Admin</h1>
<div class="form-group">
<div class="row">
<div class="col-sm-4"><input type="text" name="first" placeholder="Enter name"  class="form-control"></div>  
<div class="col-sm-4"><input type="text" name="last" placeholder="Enter last"  class="form-control"></div>  
<div class="col-sm-4"><input type="email" name="email" placeholder="Enter email"  class="form-control"></div>  
</div><br>
<div class="row">
<div class="col-sm-4"><input type="text" name="gender" placeholder="Enter gender"  class="form-control"></div>  
<div class="col-sm-4"><input type="text" name="Country"  class="form-control"></div>  
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
        <th>Gender</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>

<?php
if(isset($_SESSION["id"])) {

  
  $sel_data="select * from users";
  $sel_exe=mysqli_query($conn,$sel_data);
   while($fetch_data=mysqli_fetch_array($sel_exe,MYSQLI_ASSOC))
   {
 
    echo "<tr>";
    echo  "<td>"."<img src=$fetch_data[img] height=100px width=100px class='img-circle'>"."</td>";  
    echo  "<td>"."$fetch_data[first_name]"."</td>";
    echo  "<td>"."$fetch_data[last_name]"."</td>";
    echo  "<td>"."$fetch_data[email]"."</td>";
    echo  "<td>"."$fetch_data[hob]"."</td>";
    echo  "<td>"."$fetch_data[con]"."</td>";
    echo  "<td>"."$fetch_data[gen]"."</td>";
    echo  "<td>"."<button>"."Edit"."</button>"."</td>";
    echo  "<td>"."<button>"."Delete"."</button>"."</td>";
    echo "</tr>";
    }
}

else 
	{
		header("location:login.php");
	}
?>
</table>
</div>
</form>

<?php 
include('footer.php');
?>