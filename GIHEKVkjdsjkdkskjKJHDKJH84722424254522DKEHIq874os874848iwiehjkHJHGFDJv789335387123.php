<?php
include("db.php");
date_default_timezone_set("Asia/Kolkata");
$ntime = date("d-m-Y",strtotime("-2 month"));
if(date("m")=="09"){$ntime = date("d-m-Y",strtotime("-1 month"));}
$ntime = "-09-2020";
$query4 = mysqli_query($con,"Delete from home WHERE date LIKE '%$ntime%'");
$dir = "home/";
$a = array("index.php",".","..");
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
$data = mysqli_query($con,"SELECT ghfile from ghome");
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
	    unlink("home/$value");
	}
}
}
?>