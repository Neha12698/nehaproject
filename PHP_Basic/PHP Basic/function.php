<?php
if(isset($_POST['btnsub']))
{
	    $first=$_POST['n1'];
	    $last=$_POST['last'];
	    if(!empty($_POST['chk']))
	    $hob=implode(",",$_POST['chk']);
	    else
	    $hob ='';

		$state=$_POST['state'];
		if(isset($_POST['gender']))
		$sex=$_POST['gender'];   
		else
	    $sex= '';
		$mode=$_POST['mode'];
        $img=$_FILES['img'];
        if($mode =='add'){
		        $email=$_POST['eml'];
		        $pass=$_POST['pass'];
		        $cpass=$_POST['cpass'];
         }
        if($mode=='edit_admin')
         {
         	$user_type=$_POST['type'];
         	$user_id=$_POST['userid'];
         }
         
         if(!empty($_FILES['img']['name']))
	       {

	       	$name=$_FILES['img']['name']; 
	        $temp=$_FILES['img']['tmp_name']; 
	        move_uploaded_file($_FILES['img']['tmp_name'],"images/album/".$name);
	        $path=$name;
	       }
	       else
	       {
              $path="admin.jpeg";

	       }

        // ..................if new registeration...............................
         if($mode =='add')
             {
         	 $error =  validation_regiterform($first,$last,$email,$pass,$cpass,$hob,$state,$sex);
         	 if(empty($error)){
         	 	$pass  = md5($pass);
         	 	$message = insert_data($conn,$first,$last,$email,$pass,$cpass,$hob,$state,$sex,$path);
         	 }
         }
         //............................... update user.......................................
         if($mode =='edit')
             {  
         	 $error =  validation_updateform($first,$last,$hob,$state,$sex);
         	 if(empty($error))
         	 {
         	 	update_data($conn,$first,$last,$hob,$state,$sex,$path);
         	 }
         }

          //---------------------update Admin user------------------------------------
         if($mode =='edit_admin')
             {  
         	 $error =validation_updateadminform($first,$last,$hob,$state,$sex);
         	 if(empty($error))
         	 {
         	 	update_admin($conn,$first,$last,$hob,$state,$sex,$path,$user_type,$user_id);
         	 }
         }

}


//--------------------------------- Registration form---------------------------------
function insert_data($conn, $first,$last,$email,$pass,$cpass,$hob,$state,$sex,$path){
	        $user="user";
	        $query = "SELECT email FROM users WHERE email = '$email'";
	        $result = mysqli_query($conn,$query);
			$rows=mysqli_num_rows($result);

		if($rows==0)
		{

           $ins="insert into users(first_name,last_name,email,pass,hob,state_id,gen,img,user_type) values('$first','$last',
           '$email','$pass','$hob','$state','$sex','$path','$user')";
           $exe_ins=mysqli_query($conn,$ins);
           $status='success';// "<span class='sucess'>"."Data inserted sucessfully"."</span>";

		}
        else
        {
           $status= 'error'; //"!...Sorry Data inserted already";

        }
        return $status;

}

//---------------------------------Edit User Profile--------------------------------------------------------
function update_data($conn, $first,$last,$hob,$state,$sex,$path){

  
     $upd="update users set first_name='$first',last_name='$last', hob='$hob',state_id='$state', gen='$sex',img='$path' where id='$_SESSION[id]'";
     $check= mysqli_query($conn,$upd);
	     if($check==1)
		     {
		       header("location:welcome.php");
		     }
	     else
		     {
		      echo"<span>"."not updated sucessfully"."</span>";
		     }

      }

//-----------------------------------------Edit Admin User Profile---------------------------------------------

   function update_admin($conn,$first,$last,$hob,$state,$sex,$path,$user_type,$user_id){

   $upd="update users set first_name='$first',last_name='$last', hob='$hob',state_id='$state', gen='$sex',img='$path',user_type='$user_type' where id='$user_id'";
     $check= mysqli_query($conn,$upd);
	     if($check==1)
		     {
		      header("location:admin.php");
		     }
	     else
		     {
		      echo"<span>"."not updated sucessfully"."</span>";
		     }

      }   


/*

     function  update_album($conn,$alb_name,$alb_desc,$photo)
     {

       $upd_alb="update album set alb_name='$alb_name',alb_desc='$alb_desc',alb_pic='$photo' where id='$_SESSION[id]'";
        $check= mysqli_query($conn,$upd_alb);
	     if($check==1)
	     {
	       header("location:album.php");
	     }
	     else
	     {
	      echo"<span>"."not updated sucessfully"."</span>";
	     }




     }
     */
 
// validation for registratiion form..........................

function validation_regiterform($first,$last,$email,$pass,$cpass,$hob,$state,$sex){

        $error = array();

     	if(empty($first))
		{
			 $error['first'] =" First name is required";
		}
		elseif(!preg_match("/^[a-z ,.'-]+$/i", $first))
		{
			$error['first']="Enter only character value";
		}
		elseif(empty($last))
		{
			$error['last']=" Last name is required";

		}
		elseif(!preg_match("/^[a-z ,.'-]+$/i", $last))
		{
		      $error['last']="Enter only character value";
		}
		elseif(empty($email))
		{
            $error['email']="Enter email address"; 
		}

		 elseif(!preg_match("/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/", $email))
		{
            $error['email']="Enter valid format of email address"; 
		}

		elseif(empty($pass))
		{
			$error['pass']="Enter password";
		}
		elseif(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,}$/', $pass))
		{
			$error['pass']="Password must contain number,letter,special character and enter atleast six character";
		}
		elseif(empty($cpass))
		{
			$error['cpass']="Enter confirm password";
		}
		elseif(!($pass===$cpass))
		{
			$error['cpass']="Please confirm password";
		}
		elseif(empty($hob))
		{
			$error['hob']=" Please check atleast one hobbies";
		}
		elseif(empty($state))
		{
			$error['state_id']=" Please select country";

		}
		elseif(empty($sex))
		{
			$error['sex']=" Please select any gender";

		}

		return $error;

     }
//--------------------------------validation for update form..................................

  function  validation_updateform($first,$last,$hob,$state,$sex) 
  {

        $error = array();
     	if(empty($first))
		{
			 $error['first']=" First name is required";
		}
		elseif(!preg_match("/^[a-z ,.'-]+$/i", $first))
		{
			$error['first']="Enter only character value";
		}
		elseif(empty($last))
		{
			$error['last']=" Last name is required";

		}
		elseif(!preg_match("/^[a-z ,.'-]+$/i", $last))
		{
		      $error['last']="Enter only character value";
		}
		elseif(empty($hob))
		{
			$error['hob']=" Please check atleast one hobbies";
		}
		elseif(empty($state))
		{
			$error['state_id']=" Please select country";

		}
		elseif(empty($sex))
		{
			$error['sex']=" Please select any gender";

		}

		return $error;

     }

  

/*
function validation_album($alb_name,$alb_desc)
 {
 	$error = array();
		
  if(empty($alb_name)) 
    {
     $error['alb_name']="Enter album name";
    }  
  elseif(!preg_match("/^[a-z ,.'-]+$/i", $$alb_name)) 
    {
     $error['alb_name']="Enter character only";
    }  
 		
  elseif(empty($alb_desc)) 
    {
     $error['alb_desc']="Enter album name";
    }  
  elseif(!preg_match("/^[a-z ,.'-]+$/i", $$alb_name)) 
    {
     $error['desc']="Enter character only";
    }  
  return $error;

 }

*/

//-------------------validation for admin form--------------------------------
  function  validation_updateadminform($first,$last,$hob,$state,$sex) 
  {

        $error = array();
     	if(empty($first))
		{
			 $error['first']=" First name is required";
		}
		elseif(!preg_match("/^[a-z ,.'-]+$/i", $first))
		{
			$error['first']="Enter only character value";
		}
		elseif(empty($last))
		{
			$error['last']=" Last name is required";

		}
		elseif(!preg_match("/^[a-z ,.'-]+$/i", $last))
		{
		      $error['last']="Enter only character value";
		}
		elseif(empty($hob))
		{
			$error['hob']=" Please check atleast one hobbies";
		}
		elseif(empty($state))
		{
			$error['state_id']=" Please select country";

		}
		elseif(empty($sex))
		{
			$error['sex']=" Please select any gender";

		}

		return $error;

     }

  
?>