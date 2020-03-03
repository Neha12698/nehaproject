<?php
 
 $n=5;

 for($i=1;$i<=10;$i++)
 {

echo $n."*".$i."=".$n*$i."<br>";

 }

?>



<html>
<head>
</head>
<body>
	<form  method="post">
		<input type="text" placeholder="Enter number" name="n1">
		<input type="submit" value="submit" name="btnsub">
    </form>
	</body>
</html>

<?php
if(isset($_POST['btnsub']))
{

$num=$_POST['n1'];

 for($i=1;$i<=10;$i++)
{

echo $num."*".$i."=".$num*$i."<br>";

 }


}

?>