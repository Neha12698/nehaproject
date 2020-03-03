<?php
session_start();
include('connect.php');
if(isset($_SESSION['id'])){

	if(isset($_REQUEST['id']))
	{

		$id=$_REQUEST['id'];

		$sel="select * from album as a INNER JOIN gallery as g INNER JOIN images as i ON g.alb_id=a.id AND i.gal_id=g.id where a.id='$id'";
		$sel_exe=mysqli_query($conn,$sel);
		while($fetch=mysqli_fetch_array($sel_exe,MYSQLI_ASSOC))

		{
			$img_fetch=$fetch['img'];
			$gal_id=$fetch['gal_id'];
			$alb_pic=$fetch['alb_pic'];
            $curdr=getcwd();     
            $path=$curdr."/images/album/".$id."/".$gal_id."/".$img_fetch;
            unlink($path);

          }
         
           $del_img="delete from images where gal_id='$gal_id'";
            $del_exe=mysqli_query($conn,$del_img);
            if($del_exe==1)
		        {
		            $curdr=getcwd(); 
		            $path=$curdr."/images/album/".$id."/".$gal_id;
		            rmdir($path);
		        }
		            $del_gal="delete from gallery where alb_id='$id'"; 
	                $gal_exe=mysqli_query($conn,$del_gal);
			        if($gal_exe==1)
			           {
                        
	                        $curdr=getcwd(); 
				            $path=$curdr."/images/album/".$id."/".$alb_pic;
				            unlink($path);
					        $albpath=$curdr."/images/album/".$id;
						    rmdir($albpath);  
					          

			             
			           }
			        $del_alb="delete from album where id=$id"; 
	                $alb_exe=mysqli_query($conn,$del_alb);
		                if($alb_exe==1)
			                {
			                	header("location:album.php");
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

}
?>