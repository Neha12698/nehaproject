<?php 


/********--------------------------Create array------------------------------*********/

$cars=array("name" => "Neha", "age" => "22", "prof" => "software engineer");

echo "<pre>";
print_r($cars);


/*********-------------------------is_array()---------------------------------********/


echo is_array($cars); //1 or TRUE


/*********------------------------in_array()----------------------------------********/
	

if(in_array("22", $cars)){

	echo "exist in array";
}else{

	echo "Not exist";
}



/*******---------------------------array_merge()-------------------------------********/


$arr1 = array("test1","test2","test3");
$arr2 = array("name" => "Neha", "age" => "22");

$merged_arr = array_merge($arr1,$arr2);

print_r($merged_arr);

/******---------------------------array_key()----------------------------------*******/

print_r(array_keys($merged_arr));

/******----------------------------array_push()-----------------------------------********/

array_push($arr1,"test4","test5");
print_r($arr1);

/*********-----------------------array_pop()------------------------------------*******/

array_pop($arr1);

print_r($arr1);

/*********----------------------array_diff()------------------------------*****/

print_r(array_diff($arr1,$arr2));

?>