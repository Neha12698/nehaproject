
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

      return true;

     }

	</script>

	<style>
	#t1
	{
		color:red;
	}
</style>
</head>
<body>
	<form  name="frm" method="post" >
		<input type="text" placeholder="Enter number" name="n1"  onkeypress="return valid1()" required><span id="t1"></span><br>
		<input type="submit" value="submit" name="btnsub">
    </form>


	<table border="2">
<?php
	if(isset($_POST['btnsub']))
	{
	$num=$_POST['n1'];



  echo "<tr>";
  echo "<td colspan='4'>"."Table of " .$num. " number"."</td>";
  echo"</tr>";


    for($i=1;$i<=10;$i++)

		{
		echo"<tr>";
		echo "<td>".$num."</td>"."<td>"."*"."</td>"."<td>".$i."</td>"."<td>".$num*$i."<br>"."</td>";
		echo"</tr>";
		}

}

?>
</body>
</table>
</html>