<?php
session_start();
include('connect.php');
include('header.php');
?>
<body>

  <?php
    if(isset($_SESSION['id']))
      {
        if(isset($_REQUEST['id']))
        {
                $id=$_REQUEST['id'];
	            $sel="select * from  gallery where id='$id'";
	            $exe=mysqli_query($conn,$sel);
	            $fetch_gal=mysqli_fetch_array($exe,MYSQLI_ASSOC);
	            
        }



     }
  ?>

<form  method="post" action="edit-gallary.php" enctype="multipart/form-data">  
<div class="container">
     <h1>Edit Gallery</h1>
  <div class="form-group">
  	<input type="hidden" name="id" value="<?php if(isset($fetch_gal['id'])) echo $fetch_gal['id']; ?>">
      <lable  for="n1" class="col-sm-3 control-label">Name</lable>
      <div class="col-sm-9">
      <input type="text" name="name" placeholder="Enter gallery name"  class="form-control" value ="<?php if(isset($fetch_gal['gal_name'])) echo $fetch_gal['gal_name'];?>" ></br> 
      </div>  
  </div>
   <div class="form-group">
      <lable  for="n1" class="col-sm-3 control-label">Description</lable>
      <div class="col-sm-9">
      <input type="text" name="desc" placeholder="Enter gallery description"  class="form-control" value ="<?php if(isset($fetch_gal['gal_desc'])) echo $fetch_gal['gal_desc'];?>" ></br> 
      </div>  
  </div>
  <div class="form-group">
    <lable for="image" class="col-sm-3 control-label">Image</lable>
    <div class="col-sm-9">
      <input type="file" name="img[]" multiple><br>
      </div>
 </div>
 
   <div class="form-group">
    <div class="col-sm-3"></div>
    <div class="col-sm-4"><button type="submit" name="btnsave" class="btn btn-primary btn-block">save</button></div>
    <div class="col-sm-5"></div>
  </div>
</div>
</form>


<?php

       if(isset($_POST['btnsave']))
           {   
            	$id=$_POST['id'];
              $gal_name=$_POST['name'];
    			    $gal_desc=$_POST['desc'];
    			   // $gal_img=$_POST['img'];
    			    $alb_id=$fetch_gal['alb_id'];

        
                $upd="update gallery set gal_name='$gal_name',gal_desc='$gal_desc' where id='$id'";
                $upd_exe=mysqli_query($conn,$upd);
                if($upd_exe==1)
                  {
	                 foreach($_FILES['img']['name'] as $key => $value)
	                   { 
                        if(empty($value))
                        {
    		                  $img=$_FILES['img']['name'][$key];
    		                  move_uploaded_file($_FILES['img']['tmp_name'][$key], "images/album/".$alb_id."/".$id."/".$img);
  		                    $path=$img; 
  	                      $upd_img="insert into images(img,gal_id)values('$path','$id')";
  	                      $upd_exe=mysqli_query($conn,$upd_img);
                        }
                      else
                        { 
                          $path="admin.jpeg"; 
                          $upd_img="insert into images(img,gal_id)values('$path','$id')";
                          $upd_exe=mysqli_query($conn,$upd_img);


                        }
	                      header("location:display-gallery.php?id=".$fetch_gal['alb_id']);
	                    }

	                    header("location:display-gallery.php?id=".$fetch_gal['alb_id']);

                       
	               }
                else
                     {
                     	echo "not";
                     }
                 
            }   


?>


<?php include('footer.php'); ?>


