<?php
include('connect.php');
 if(isset($_REQUEST['id']))
	{
		$id = $_REQUEST['id'];
		$alb = $_REQUEST['alb'];
		

		//select images from images table-----------------------

		$sel_img = "select i.img,g.alb_id from images as i INNER JOIN gallery as g ON i.gal_id = g.id where i.gal_id = '$id'";
		$img_exe = mysqli_query($conn,$sel_img);
        while($fetch_img = mysqli_fetch_array($img_exe))
          {
            $img_fetch = $fetch_img['img'];
            $albid_fetch = $fetch_img['alb_id']; 
            $curdr = getcwd();     
            $path = $curdr."/images/album/".$albid_fetch."/".$id."/".$img_fetch;
            unlink($path);

          }
            $del_img = "delete from images where gal_id = '$id'";
            $del_exe = mysqli_query($conn,$del_img);
             if($del_exe == 1)
		        {
		            $curdr=getcwd(); 
		            if(isset($albid_fetch))   
		            $path=$curdr."/images/album/".$albid_fetch."/".$id;
		            echo $path;
		            rmdir($path);

		        }
		            $del_gal="delete from gallery where id='$id'"; 
	                $gal_exe=mysqli_query($conn,$del_gal);
			           if($gal_exe == 1)
				           {
		               		 header("location:display-gallery.php?id=".$alb);
				           }
			           else
				           {
				           	echo "not deleted";
				           }


      }
		


/*
        
        $del_img="delete from images where gal_id='$id'";
        $del_exe=mysqli_query($conn,$del_img);
        if($del_exe == 1)
	        {

	           $del_gal="delete from gallery where id='$id'"; 
	           $gal_exe=mysqli_query($conn,$del_gal);
		           if($gal_exe == 1)




		           	echo "Gallery is deleted";
		           else 
		           	echo "gallery not deleted";

	        }

	    else
	        {

             echo "images not deleted";

	        }
	       

   }

        





		//$del="delete from gallery INNER JOIN images  ON images.gal_id=gallery.id where gallery.id='$id'";

		/*$exe_del=mysqli_query($conn,$del);
		if($del==1)
			{
				echo "deleteed";
			}
		else
			{
				echo "not deleted";
			}
*/




?>