<?php ini_set("display_errors", "1");
error_reporting(E_ALL);  ?>

<html>
<head>
<script>
 function valid1()
    {
       var number=document.frm.n1.value;
      if(isNaN(number))
       {
       	document.getElementById("t1").innerHTML="Enter numeric value only"; 
       }
       else{
       	  	document.getElementById("t1").innerHTML="";
      }
    
}
function valid2()
     {
        var number2=document.frm.n2.value;
          if(isNaN(number2))
       {
       	document.getElementById("t2").innerHTML="Enter numeric value only";    	
       }
       else{
       	  	document.getElementById("t2").innerHTML="";      	  		
       }

     }

</script>

<style>
#t1
{
	color:red;
}

#t2
{
	color:red;
}
</style>

</head>
<body>
	<form name="frm" method="post" action="dynamic-table.php">
		<input type="text" placeholder="Enter number" name="n1"  onkeypress="return valid1()" required><span id="t1"></span><br>
		<input type="text" placeholder="Enter number" name="n2" onkeypress="return valid2()" required> <span id="t2"></span><br>
		<input type="submit" value="submit" name="btnsub">
    </form>
	</body>
</html>

<?php
if(isset($_POST['btnsub']))
{
  $num=$_POST['n1'];
  $num2=$_POST['n2'];

  for($i=1;$i<=$num2;$i++)
  {

  echo $num."*".$i."=".$num*$i."<br>";

  }
}

?>