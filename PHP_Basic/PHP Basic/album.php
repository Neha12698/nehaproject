<?php
session_start();
include('connect.php');
include('header.php');
?>
<body>
  <script type="text/javascript">
  function ConfirmDelete() {
  return confirm("Are you sure you want to delete?");
}
  </script>
<a href="welcome.php"  class="btn btn-default">Back</a>
<h1>User Album</h1>
<?php
   if(isset($_SESSION['id']))
   {
 ?>

<div><button class="btn">
  <?php
  /*echo "<a href='add-album.php?id=$_SESSION[id]'>ADD ALBUM</a>"*/
?>
  </button></div>
 <form method="post" action="album.php">
   <div class="row">
      <div  class="col-sm-4 add"><button class="btn"><a href="add-album.php?id=$_SESSION[id]">ADD ALBUM</a></button></div>
       <div class="col-sm-4"></div>
       <div class="col-sm-4"></div>
     </div>

	<div class="container">
    
 <table  class="table table-hover">  	
    	<tr style="background-color:#337ab782;">
    		<th>Image</th>
    		<th>Name</th>
    		<th>Description</th>
    		<th>Edit</th>
    		<th>Delete</th>
    	</tr>


  <?php  
  $sel="select * from album where user_id=$_SESSION[id]";
  $exe_sel=mysqli_query($conn,$sel);
    if(mysqli_num_rows($exe_sel)>0)
     {
       while($fetch=mysqli_fetch_array($exe_sel,MYSQLI_ASSOC))
        {

           echo"<tr>";
           ?>
            <td><?php if($fetch['alb_pic']=='admin.jpeg') echo "<a href='display-gallery.php?id=$fetch[id]'><img src='images/$fetch[alb_pic]' height='100px' width='100px'></a>"; else echo"<a href='display-gallery.php?id=$fetch[id]'><img src='images/album/$fetch[id]/$fetch[alb_pic]' height='100px' width='100px'></a>";?> </td>
           <?php
           echo"<td>".$fetch['alb_name']."</td>";
           echo"<td>".$fetch['alb_desc']."</td>";
           echo"<td>"."<button><a href='edit-album.php?id=$fetch[id]'>Edit</a></button>"."</td>";
           echo"<td>"."<button ><a href='delete-album.php?id=$fetch[id]' Onclick='return ConfirmDelete()' >Delete</a></button>"."</td>";
           echo"</tr>";

        }

     }
     else

      {  
        echo "<tr>";
        echo "<td colspan='5'>";
        echo "<h2>"."Record not found"."</h2>";
        echo "</td>";
        echo "</tr>";
      }
     


 	}
?>


    </table>
    </div>	
</form>
<?php include('footer.php'); ?>