<?php
  session_start();
  include('connect.php');
  include('header.php');
?>
<body>
  
<script type="text/javascript">
  
function confirmdelete()
  {
    return confirm("Are you sure want to delete gallery?");
  }

</script>

<a href="album.php"  class="btn btn-default">Back</a><h1>User Gallery</h1>

<form method="post" action="display-gallery.php">
   <div class="row">
      <div  class="col-sm-4 add"><button class="btn"><a href="gallery.php">ADD GALLERY</a></button></div>
       <div class="col-sm-4"></div>
       <div class="col-sm-4"></div>
     </div>

  <div class="container">
    
<?php
   if(isset($_SESSION['id']))
   {
    if(isset($_REQUEST['id']))
    {
      $id=$_REQUEST['id'];
 ?>
    <table  class="table table-hover">    
      <tr style="background-color:#337ab782;">
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>


  <?php

    $img_sel="select i.gal_id,g.gal_name,g.gal_desc,i.img,g.alb_id from images as i INNER JOIN gallery as g ON i.gal_id=g.id where g.alb_id=$id Group By i.gal_id";
    $img_exe=mysqli_query($conn,$img_sel); 
     if(mysqli_num_rows($img_exe)>0)
     {
       while($fetch=mysqli_fetch_array($img_exe,MYSQLI_ASSOC))
          {
             echo"<tr>";
             ?>

              <td><?php if($fetch['img']=='admin.jpeg') 
              { 
                echo "<a href='image-gallery.php?id=$fetch[gal_id]&alb=$fetch[alb_id]'><img src='images/$fetch[img]' height='100px' width='100px'></a>"; 
              }
              else 
                {
                  echo"<a href='image-gallery.php?id=$fetch[gal_id]&alb=$fetch[alb_id]'><img src='images/album/$id/$fetch[gal_id]/$fetch[img]' height='100px' width='100px'></a>";
                }
                ?> </td>
              <?php
             echo"<td>".$fetch['gal_name']."</td>";
             echo"<td>".$fetch['gal_desc']."</td>";
             echo"<td>"."<button><a href='edit-gallary.php?id=$fetch[gal_id]'>Edit</a></button>"."</td>";
             echo"<td>"."<button  onclick='return confirmdelete()'><a href='delete-gallary.php?id=$fetch[gal_id]&&alb=$id'>Delete</a></button>"."</td>";
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

  }
?>


     </table>
    </div>  
</form>
<?php include('footer.php'); ?>