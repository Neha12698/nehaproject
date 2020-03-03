<?php
session_start();
include('connect.php');
include('header.php');
?>
<body>

  <?php
    if(isset($_SESSION['id']))
    {
  ?>


<form  method="post" action="gallery.php" enctype="multipart/form-data">  
<div class="container">
     <h1>Add Gallery</h1>
  <div class="form-group">
      <lable  for="n1" class="col-sm-3 control-label">Name</lable>
      <div class="col-sm-9">
      <input type="text" name="name" placeholder="Enter gallery name"  class="form-control" value ="" ></br> 
      <span class="error"><?php if(isset($name)) echo $name;?></span>
      </div>  
  </div>
   <div class="form-group">
      <lable  for="n1" class="col-sm-3 control-label">Description</lable>
      <div class="col-sm-9">
      <input type="text" name="desc" placeholder="Enter gallery description"  class="form-control" value ="" ></br> 
      <span class="error"><?php if(isset($desc)) echo $desc;?></span>
      </div>  
  </div>
  <div class="form-group">
    <lable for="image" class="col-sm-3 control-label">Image</lable>
    <div class="col-sm-9">
      <input type="file" name="img[]" multiple><br>
      </div>
 </div>
 
   <div class="form-group">
    <lable  class="col-sm-3 control-label">Select Album</lable>
    <div class="col-sm-9">
     <select name="alb_id">
    <?php
   $sel="select id,alb_name from album where user_id=$_SESSION[id]";
   $exe_sel=mysqli_query($conn,$sel);
   while($fetch=mysqli_fetch_array($exe_sel,MYSQLI_ASSOC)) 
     {
    
      echo "<option value='$fetch[id]'>".$fetch['alb_name']."</option>";

     }

   
   }
    
  ?>

     
   </select><br><br>
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
   // $gal_img=$_FILES['img'];
   // $gal_name=$_FILES['img']['name'];
    $gal_tmp=$_FILES['img']['tmp_name'];
    $gal_str=implode(" ",$gal_tmp);

    $gal_name=$_POST['name'];
    $gal_name=$_POST['desc'];
    $gal_id=$_POST['alb_id'];
     if(empty($gal_name))
         {
           $name="Enter Gallery name";
         } 
     elseif(empty($gal_name))
         {
           $desc="Enter Gallery description";
         }
    else
    {     
    
    $ins="insert into gallery(gal_name,gal_desc,alb_id) values('$gal_name','$gal_desc','$gal_id')";
    $exe=mysqli_query($conn,$ins);
     if($exe==1)
    {
     $sel="select * from gallery where alb_id=$gal_id ORDER BY id DESC";
     $exe_sel=mysqli_query($conn,$sel);
     $fetch_sel=mysqli_fetch_array($exe_sel,MYSQLI_ASSOC);
     $gal_img_id=$fetch_sel['id'];
 
     $curdr=getcwd();
     $dir=$curdr."/images/album/".$gal_id."/".$fetch_sel['id'];
      if(!is_dir($dir)){
        mkdir($dir,0777,true);
        
         foreach($_FILES['img']['name'] as $key => $value)
                {
                    if(empty($value))
                      {
                        $path="admin.jpeg";
                         $img_ins="insert into images(img,gal_id) values('$path','$gal_img_id')";
                        $img_exe=mysqli_query($conn,$img_ins);
                      }
                     else
                      {
                        $img=$_FILES['img']['name'][$key];
                        move_uploaded_file($_FILES['img']['tmp_name'][$key], "images/album/".$gal_id."/".$fetch_sel['id']."/".$img);
                        $path=$img; 
                        $img_ins="insert into images(img,gal_id) values('$path','$gal_img_id')";
                        $img_exe=mysqli_query($conn,$img_ins);
                      }
                     
                }
      
    

              }
                        
    
                  if($img_exe==1)
                  {
                     header("location:display-gallery.php?id=".$gal_id);
                  }
                  else
                  {
                    echo "images not inserted";

                  }

            

       } 

     }
        

 }



?>




<?php include('footer.php'); ?>


