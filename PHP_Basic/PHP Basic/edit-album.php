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
       $alb_sel="select * from album where id='$id'";
       $alb_exe=mysqli_query($conn,$alb_sel);
       $fetch=mysqli_fetch_array($alb_exe,MYSQLI_ASSOC);
      if(isset($_POST['btnsave']))
      {
        $id=$_POST['id'];
       $alb_name=$_POST['name'];
       $alb_desc=$_POST['desc'];
       $alb_img=$_FILES['img'];


        if(!empty($_FILES['img']['name']))
          {
           $img_nam=$_FILES['img']['name'];
        
             }

        else
             {
               $img_nam="admin.jpeg";
            
             }   
    
         
       $img_tmp=$_FILES['img']['tmp_name'];    
       $photo=$img_nam;
       if($img_nam!="admin.jpeg")
        {
           move_uploaded_file($_FILES['img']['tmp_name'],"images/album/".$id."/".$img_nam);
        }
      
       $upd_alb="update album set alb_name='$alb_name',alb_desc='$alb_desc',alb_pic='$photo' where id='$id'";
       $check= mysqli_query($conn,$upd_alb);
       if($check==1)
         {
          
         header("location:album.php?id=".$id);
         }
       else
         {
          echo"<span>"."not updated sucessfully"."</span>";
         }

     }
   }
  } 

 else
   {
   header("location:login.php");
   }
?>
<a href="album.php"  class="btn btn-default">Back</a>
<form  method="post" action="edit-album.php" enctype="multipart/form-data">  
<div class="container">
     <h1>Edit Album</h1>
     <input type="hidden" name="id" value="<?php echo $fetch['id'];?>">
  <div class="form-group">
      <lable  for="n1" class="col-sm-3 control-label">Name</lable>
      <div class="col-sm-9">
      <input type="text" name="name" placeholder="Enter album name"  class="form-control" value =" <?php if(isset($alb_name)) echo"$alb_name"; elseif(isset($fetch)) echo $fetch['alb_name']; ?>" required> </br> 
      <span class="error"><?php if(isset($error['alb_desc'])) echo $error['alb_name'] ?></span>
      </div>  
  </div>
  <div class="form-group">
      <lable for="name" class="col-sm-3 control-label">Description</lable>
      <div class="col-sm-9">
      <input type="text" name="desc" placeholder="Enter album description" class="form-control" value="<?php  if(isset($alb_name)) echo"$alb_desc"; elseif(isset($fetch)) echo $fetch['alb_desc']; ?>" required></br>
      <span class="error"><?php if(isset($error['alb_desc'])) echo $error['alb_desc'] ?></span>
      </div> 
  </div>

  <div class="form-group">
    <lable for="image" class="col-sm-3 control-label">Image</lable>
    <div class="col-sm-9">
      <input type="file" name="img"><br>
      </div>
  </div>
  <div class="form-group">
    <div class="col-sm-3"></div>
    <div class="col-sm-4"><button type="submit" name="btnsave" class="btn btn-primary btn-block">save</button></div>
    <div class="col-sm-5"></div>
  </div>
</div>
</form>

<?php include('footer.php'); ?>


