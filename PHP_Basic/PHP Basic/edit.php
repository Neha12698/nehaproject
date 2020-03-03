<?php
  session_start();
  include('connect.php');
  include ('function.php') ;
  include('header.php');
?>
 <script type="text/javascript">
     $(document).ready(function()
       {
        $('#country').on('change',function(){
        var countryID=$(this).val();
        if(countryID)
          {
            $.ajax({
                       type:'POST',
                       url:'https://dev.webethics.online/neha/ajax.php',
                       data:'con_id='+countryID,
                       success:function(html)
                        {
                          $('#state').html(html);
                        }

            });


          }
         else 
          { 
                   $('#state').html('<option value="">--select data----</option>');
          }

        });


        
       });

  </script>


<body>
  <?php
  if(isset($_SESSION["id"])) {
  //$ed_sel="select * from users where id=$_SESSION[id]";
  $ed_sel="select  u.first_name,u.last_name,u.email,u.img,u.hob,u.gen,u.state_id,c.id,c.con_name,s.state_name,s.con_id from users as u INNER JOIN country as c INNER JOIN state as s ON u.state_id=s.id AND c.id=s.con_id where u.id=$_SESSION[id]";
  $exe_data=mysqli_query($conn,$ed_sel);
  $fetch_data=mysqli_fetch_array($exe_data,MYSQLI_ASSOC);
   $fetch_con_id=$fetch_data['id'];

  }
else
  {
  header("location:login.php");  
  }

?>
<a href="welcome.php"  class="btn btn-default">Back</a>
<form class="form-horizontal" method="post" action="edit.php" enctype="multipart/form-data">  

<div class="container">
  <h1>Update Form</h1>
  <div class="form-group">
    <lable  for="name" class="col-sm-3 control-label">First name</lable>
    <div class="col-sm-9">
    <input type="text" name="n1" placeholder="Enter first name"  class="form-control" value ="<?php if(isset($_POST['n1'])) echo $_POST['n1']; else  echo $fetch_data['first_name']; ?>"> </br> 
    <span class = "error"><?php if(isset($error['first'])) echo $error['first']; ?></span> 
    </div>  
  </div>
  <div class="form-group">
    <lable for="name" class="col-sm-3 control-label">Last name</lable>
    <div class="col-sm-9">
    <input type="text" name="last" placeholder="Enter last name" class="form-control" value="<?php if(isset($_POST['last'])) echo $_POST['last']; else echo $fetch_data['last_name']; ?>"></br>
    <span class = "error"><?php if(isset($error['last'])) echo $error['last']; ?></span> 
    </div> 
  </div>
  <div class="form-group">
    <lable for="email" class="col-sm-3 control-label">Email</lable>
    <div class="col-sm-9">
    <input type="text" name="eml" placeholder="Enter email address" class="form-control" value="<?php if(isset($_POST['eml'])) echo $_POST['eml']; else  echo $fetch_data['email']; ?>" disabled="disabled"></br>
    </div>
     <input type="hidden" name="mode"  class="form-control" value="edit">
  </div>
  <div class="form-group">
    <lable for="hobbies" class="col-sm-3 control-label">Hobbies</lable>
    <div class="col-sm-9">
    <?php 
     $fetch_hob=$fetch_data['hob'];
    // echo $fetch_hob;
     $arr=explode(",",$fetch_hob);
    //print_r($arr);

       if((isset($error['hob']) && $error['hob'] !='')) 
           {
            $checked =  "";
             
           }else{
             $checked = "checked";
           }

    
    ?>
    <input type="checkbox" name="chk[]" value="Dancing"   <?php if(isset($arr)) if(in_array("Dancing",$arr)) echo  $checked ; ?>> Dancing
    <input type="checkbox" name="chk[]" value="Traveling"  <?php  if(isset($arr)) if(in_array("Traveling",$arr)) echo  $checked ; ?>> Traveling
    <input type="checkbox" name="chk[]" value="Painting" <?php if(isset($arr)) if(in_array("Painting",$arr)) echo  $checked ;?>> Painting
    <input type="checkbox" name="chk[]" value="Reading " <?php if(isset($arr)) if(in_array("Reading",$arr)) echo  $checked ; ?>> Reading 
    <span class = "error"><?php if(isset($error['hob'])) echo $error['hob']; ?></span>
    </div>
  </div><br>
  <div class="form-group">
    <lable for="country" class="col-sm-3 control-label">Country</lable>
    <div class="col-sm-4">

     <select name="con" id="country" class="form-control">
        <option value="">--select country--</option>
         <?php   

                   $sel="select * from country";
                   $sel_exe=mysqli_query($conn,$sel);
                   while($fetch=mysqli_fetch_array($sel_exe,MYSQLI_ASSOC))
                      {
                        ?>

                       <option value="<?php echo $fetch['id']; ?>" <?php if($fetch_data['con_id']==$fetch['id']) echo "selected='selected';" ?> ><?php echo $fetch['con_name']; ?></option>;

                        <?php
                      }
        ?>
        
    </select>
  </div>
    <lable for="state" class="col-sm-1 control-label">State</lable>
     <div class="col-sm-4">
    <select id="state" name="state"  class="form-control">
        <option value="">-Select country first-</option>
         <?php   

                   $sel="select * from state where con_id=$fetch_con_id";
                   $sel_exe=mysqli_query($conn,$sel);
                   while($fetch=mysqli_fetch_array($sel_exe,MYSQLI_ASSOC))
                      {
                        ?>

                       <option value="<?php echo $fetch['id']; ?>" <?php if($fetch_data['state_id']==$fetch['id']) echo "selected='selected';" ?> ><?php echo $fetch['state_name']; ?></option>;

                        <?php
                      }
        ?>
    </select>

    <span class = "error"><?php if(isset($error['con'])) echo $error['con']; ?></span>
    </div>
  </div><br>
  <div class="form-group">
    <lable for="gender" class="col-sm-3 control-label">Gender</lable>
    <div class="col-sm-9">
      <?php     
       $fetch_sex=$fetch_data['gen'];      
      ?>
    <input type="radio" name="gender"  value="Male"  <?php if(isset($fetch_sex)) if($fetch_sex=="Male"){echo "checked";}?>>Male
    <input type="radio" name="gender" value="Female" <?php if(isset($fetch_sex)) if($fetch_sex=="Female"){echo "checked";}?>>Female<br>
    <span class = "error"><?php if(isset($error['sex'])) echo $error['sex']; ?></span>
    </div>
  </div><br>

  <div class="form-group">
    <lable for="image" class="col-sm-3 control-label">Image</lable>
    <div class="col-sm-9">
    <input type="file" name="img">
    </div>
  </div><br>
  <div class="form-group">
    <div class="col-sm-4"></div>
    <div class="col-sm-4"><button type="submit" name="btnsub" class="btn btn-primary btn-block">Submit</button></div>
    <div class="col-sm-4"></div>
    </div>
</div>
</form>


<?php 
include('footer.php');
?>