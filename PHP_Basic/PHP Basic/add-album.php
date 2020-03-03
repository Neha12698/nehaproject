<?php
session_start();
include('connect.php');
include('header.php');
?>
<body>
<?php
 if(isset($_SESSION['id']))
	 {
	 	if(isset($_POST['btnsave']))
	 	{
	   $id=$_SESSION['id'];		
       $alb_name=$_POST['name'];
       $alb_desc=$_POST['desc'];
	       if(empty($alb_name))
	       {
	       	 $name="Enter album name";
	       } 
	       elseif(empty($alb_desc))
	       {
	       	 $desc="Enter album description";
	       }
    
		    else{
		        if(!empty($_FILES['img']['name']))
		        	{
		        	 $img_nam=$_FILES['img']['name'];
		        
		             }

		        else
		             {
		               $img_nam="admin.jpeg";
		            
		             }   
		         
		       $img_tmp=$_FILES['img']['tmp_name']; 
		       $photo= $img_nam;
		       
		       $ins="insert into album(alb_name,alb_desc,alb_pic,user_id) values('$alb_name','$alb_desc','$photo','$id')";
		       $exe=mysqli_query($conn,$ins);
		       if($exe==1)
			       {
			       	

					$sel="select id from album where user_id='$_SESSION[id]' ORDER BY id DESC";
					$data_exe=mysqli_query($conn,$sel);
					$fetch=mysqli_fetch_array($data_exe,MYSQLI_ASSOC);

					$curdr=getcwd();
					$dir=$curdr."/images/album/".$fetch['id'];
					//echo $dir;
					//$dis="images/album/".$fetch['id']."/".$img_nam;
					//echo $dis;
					if(!is_dir($dir)){
					  mkdir($dir,0777,true);
					  if($img_nam!="admin.jpeg")
						  {
						  	 move_uploaded_file($_FILES['img']['tmp_name'],"images/album/".$fetch['id']."/".$img_nam);

						  }
					  
					  header("location:album.php?id=".$_SESSION[id]);
		             }
		             else
		             	echo "not";
		           }

		           
			       else
				       	{
				       	  echo" not INSERTED";
				        }
				 	
			 }         

       }

} 

 
?>

<form  method="post" action="add-album.php" enctype="multipart/form-data">  
  <div class="container">
     <h1>Add Album</h1>
	<div class="form-group">
		<lable  for="n1" class="col-sm-3 control-label">Name</lable>
		<div class="col-sm-9">
		<input type="text" name="name" placeholder="Enter album name"  class="form-control" value ="<?php if(isset($alb_name)) echo $alb_name;  ?>"> </br> 
		<span class="error"><?php if(isset($name)) echo $name;?></span>
	    </div>  
	</div>
	<div class="form-group">
		<lable for="name" class="col-sm-3 control-label">Description</lable>
		<div class="col-sm-9">
		<input type="text" name="desc" placeholder="Enter album description" class="form-control" value="<?php if(isset($alb_desc)) echo $alb_desc;  ?>"></br>
		<span class="error"><?php if(isset($desc)) echo $desc;?></span>
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

