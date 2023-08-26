<?php
$dir = "home/";
$a = array(".","..","index.php");
include("db.php");
$data = mysqli_query($con,"SELECT file from home");
while($d=mysqli_fetch_array($data)){
	foreach($d as $q){
		$q = explode(",","$q");
		foreach($q as $w => $s){
			if($s!=""){
			    array_push($a,$s);
			}
		}
	}
}
$f = scandir($dir);
foreach ($f as $key => $value) {
	if($value!=""){
	if (!in_array("$value", $a)) { 
	    $pat = "^(give|file)://";
	    if(!preg_match($pat, $value)){
		echo "<span style='color:red;'>not found</span>"."<br>"; 
	}}
}
}
?>