<?php
include('connect.php');
if(isset($_REQUEST['id']))
{
  $id=$_REQUEST['id'];

		$sel="select * from album as a INNER JOIN gallery as g INNER JOIN images as i ON g.alb_id=a.id AND i.gal_id=g.id where a.user_id='$id'";
		$sel_exe=mysqli_query($conn,$sel);
		while($fetch=mysqli_fetch_array($sel_exe,MYSQLI_ASSOC))

		{
			$img_fetch=$fetch['img'];
			$gal_id=$fetch['gal_id'];
			$alb_pic=$fetch['alb_pic'];
			$alb_id=$fetch['alb_id'];
            $curdr=getcwd();      
            $path=$curdr."/images/album/".$alb_id."/".$gal_id."/".$img_fetch;
            unlink($path);
             
          }
            
            $del_img="delete from images where gal_id='$gal_id'";
            $del_exe=mysqli_query($conn,$del_img);
            if($del_exe==1)
		        {
		          $sel_gal="select g.id,g.alb_id from gallery as g INNER JOIN album as a ON g.alb_id=a.id where a.user_id=$id";
		          $exe_alb=mysqli_query($conn,$sel_gal);
		          $gal_fetch=mysqli_fetch_array($exe_alb,MYSQLI_ASSOC);
		          $alb_id=$gal_fetch['alb_id'];
		          $gal_id=$gal_fetch['id'];

		            $curdr=getcwd(); 
		            $path=$curdr."/images/album/".$alb_id."/".$gal_id;
		            rmdir($path);
		        }   

		        $sel_alb="select * from album where user_id=$id";
		        $exe_alb=mysqli_query($conn,$sel_alb);
		        $alb_fetch=mysqli_fetch_array($exe_alb,MYSQLI_ASSOC);

		           $fetch=$alb_fetch['id'];
		           $fetch_pic=$alb_fetch['alb_pic'];
		           $del_gal="delete from gallery where alb_id='$fetch'"; 
	               $gal_exe=mysqli_query($conn,$del_gal);
			         if($gal_exe==1)
			           {
                        
	                        $curdr=getcwd(); 
				            $path=$curdr."/images/album/".$fetch."/".$fetch_pic;
				            unlink($path);
					        $albpath=$curdr."/images/album/".$fetch;				        
						            echo $albpath;
						            rmdir($albpath);  
					          

			             
			           }

			           $del_alb="delete from album where user_id=$id"; 
	                   $alb_exe=mysqli_query($conn,$del_alb);
		                if($alb_exe==1)
			                {   
			                	$sel_user="select * from users where id='$id'";
			                	$exe_user=mysqli_query($conn,$sel_user);
			                	$fetch=mysqli_fetch_array($exe_user,MYSQLI_ASSOC);
                                $user_pic=$fetch['img']; 
					            $user=$curdr."/images/album/".$user_pic;
					            unlink($user);

			                }
			                    $del="delete from users where id='$id'";
							    $exe=mysqli_query($conn,$del);
							    if($exe==1)
								  {
								  	
								  	 header("location:admin.php");
								  } 



				      else
				           {
				           	echo "not deleted";
				           }





		/*
		echo $id;
		$del="delete from album where id='$id' && user_id='$_SESSION[id]'";
		$del_exe=mysqli_query($conn,$del);
		if($del_exe==1)
		{
		 header("location:album.php");
		}
		else
		{
         echo "data not deleted";
		}
		
       */
 
}
?>


