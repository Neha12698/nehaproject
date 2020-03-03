<?php
include('connect.php');
 if(isset($_POST['con_id']))
	 { 
	 	$id=$_POST['con_id'];
       $sel="select * from state  where con_id=$id";
       $exe=mysqli_query($conn,$sel);

       if(mysqli_num_rows($exe)>0)
        {
          echo "<option value=''>----states----</option>";
        	while($fetch=mysqli_fetch_array($exe,MYSQLI_ASSOC))
        	 {
        	 	echo "<option value='$fetch[id]'>$fetch[state_name]</option>";
        	 }
        }
        else
         {
         	echo"<option>state not available</option>";
         }

	 }
?>