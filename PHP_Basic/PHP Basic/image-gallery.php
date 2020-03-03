<?php
session_start();
include('connect.php');
include('header.php');
?>

<style type="text/css">
  
      .container  
      {
        width: 1118px;
        margin-top: 68px;
      }


.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
  margin-bottom: -4px;
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}


</style>

<script type="text/javascript">
  
$(document).ready(function() {
    $("#checkall").change(function() {
        if (this.checked) {
            $(".checkSingle").each(function() {
                this.checked=true;
            });
        } else {
            $(".checkSingle").each(function() {
                this.checked=false;
            });
        }
    });

    $(".checkSingle").click(function () {
        if ($(this).is(":checked")) {
            var isAllChecked = 0;

            $(".checkSingle").each(function() {
                if (!this.checked)
                    isAllChecked = 1;
            });

            if (isAllChecked == 0) {
                $("#checkall").prop("checked", true);
            }     
        }
        else {
            $("#checkall").prop("checked", false);
        }
    });
});


  function comfirmdelete()
    {
       return confirm("Are you sure you want to delete images");

    }


</script>
<body>
<form method="post" action="">
   <div class="row">
      <div  class="col-sm-4 add"><button class="btn"><a href="gallery.php">ADD GALLERY</a></button></div>
       <div  class="col-sm-4 add"><input type="checkbox" id="checkall" value="Checkall">Checkall  <button type="submit" name="btndelete" value="delete" onclick="return comfirmdelete()">Delete</button></div>
       <div class="col-sm-4"></div>
     </div>

	<div class="container">
    
<?php
	 if(isset($_SESSION['id']))
	 {
    if(isset($_REQUEST['id']) && (isset($_REQUEST['alb'])))
    {
     $gal_id=$_REQUEST['id'];
     $alb_id=$_REQUEST['alb'];

   
  $sel="select img,id from images where gal_id=$gal_id";
  $exe_sel=mysqli_query($conn,$sel);

  $i=0;
  while($fetch=mysqli_fetch_array($exe_sel,MYSQLI_ASSOC))
        {
          if($i%3==0)
          {
                echo "<tr>";
          }
     ?>
        
           <td><?php if($fetch['img']=='admin.jpeg') 
              { 
                echo "<img src='images/$fetch[img]' height='150px' width='150px' onclick='openModal();currentSlide()' class='hover-shadow cursor'>"."<input type='checkbox' name='chk[]' class='checkSingle' value='$fetch[id]'>"; 
              }
            else 
                {
                  echo"<img src='images/album/$alb_id/$gal_id/$fetch[img]' height='150px' width='150px' onclick='openModal();currentSlide()' class='hover-shadow cursor'>"."<input type='checkbox' name='chk[]' class='checkSingle' value='$fetch[id]'>";
                }
          ?></td>

                <?php
           if($i%3==2)
            {
                  echo "</tr>";
            }

            $i++;

           }
        if(isset($_POST['btndelete']))
          {
         /* $sel="select i.img,i.gal_id,g.alb_id from images as i INNER JOIN gallery as g ON g.id=i.gal_id where g.id=$id";
          $exe_sel=mysqli_query($conn,$sel);
          $fetch_img=mysqli_fetch_array($exe_sel,MYSQLI_ASSOC);
          
           $img=$fetch_img['img'];
           $gal_id=$fetch_img['gal_id'];
           $albid=$fetch_img['alb_id'];
           $path="images/album/".$albid."/".$gal_id."/".$img;
           unlink($path);*/
            $id=$_POST['chk'];
            foreach($id as $value) {
            $sel_img="select img,gal_id from images where id=$value";
            $sel_exe=mysqli_query($conn,$sel_img);
            $fetch=mysqli_fetch_array($sel_exe,MYSQLI_ASSOC);
            $img=$fetch['img'];
            $path="images/album/".$alb_id."/".$gal_id."/".$img;
            unlink($path);     
            $del="delete from images where id='$value'";
            $del_exe=mysqli_query($conn,$del);
            if($del_exe==1)
              {   
                
              }
            else 
              {

                 echo "Images not deleted";
              }

           

        }
           


    }

  }
 
}
?>


    </table>
    </div>	


<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

    
     
      <?php
       $sel="select img,id from images where gal_id=$gal_id";
       $exe_sel=mysqli_query($conn,$sel);
         while($fetch=mysqli_fetch_array($exe_sel,MYSQLI_ASSOC))
         {
            echo "<div class='mySlides'>";
           echo"<img src='images/album/$alb_id/$gal_id/$fetch[img]'style='width:100%'>";
           echo "</div>";
         }
     ?>
    
    
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

  </div>
</div>


</form>


<script>
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "block";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "none";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

<?php include('footer.php'); ?>