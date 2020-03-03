<?php
include('connect.php');
session_start();
include('header.php');
?>

<body>

<?php
if(isset($_SESSION["id"])) {

  
 // $sel_data="select * from users where id=$_SESSION[id]";
    $sel_data="select * from users as u INNER JOIN country as c INNER JOIN state as s ON u.state_id=s.id AND c.id=s.con_id where u.id=$_SESSION[id]";
  $sel_exe=mysqli_query($conn,$sel_data);
  $fetch_data=mysqli_fetch_array($sel_exe,MYSQLI_ASSOC);
  ?>

 <form>
  <?php
    echo"<center>";
    echo  "<h1>"."Welcome"."</h1>";
    echo"<table>";
    echo "<tr>";
    echo  "<td>"."<img src=images/album/$fetch_data[img] height=200px width=200px class='img-circle'>"."</td>";
    echo "</tr>";
    echo "<tr>";
    echo  "<td>"."First Name"."</td>";
    echo  "<td>"."$fetch_data[first_name]"."</td>";
    echo "</tr>";
    echo "<tr>";
    echo  "<td>"."Last Name"."</td>";
    echo  "<td>"."$fetch_data[last_name]"."</td>";
    echo "</tr>";
    echo "<tr>";
    echo  "<td>"."Email"."</td>";
    echo  "<td>"."$fetch_data[email]"."</td>";
    echo "</tr>";
    echo "<tr>";
    echo  "<td>"."Hobbies"."</td>";
    echo  "<td>"."$fetch_data[hob]"."</td>";
    echo "</tr>";
    echo "<tr>";
    echo  "<td>"."Country"."</td>";
    echo  "<td>"."$fetch_data[con_name]"."</td>";
    echo "</tr>";
    echo "<tr>";
    echo  "<td>"."state"."</td>";
    echo  "<td>"."$fetch_data[state_name]"."</td>";
    echo "</tr>";
    echo "<tr>";
    echo  "<td>"."Gender"."</td>";
    echo  "<td>"."$fetch_data[gen]"."</td>";
    echo "</tr>";
    echo"</table>";
    echo"</center>";
    }

else 
	{
		header("location:login.php");
	}
?>
</form>
<?php 
include('footer.php');
?>