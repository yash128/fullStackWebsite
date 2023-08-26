<?php
session_start();
include("db.php");
$tid = $_SESSION['tid'];
$pass = $_SESSION['pass'];
$data = mysqli_query($con, "SELECT sdata,sid from video where cdate='$pass' AND tid='$tid' AND ver='0' order by vid desc");
if(mysqli_num_rows($data)>0){
$data = mysqli_fetch_row($data);
$nece=["$data[1]"];
$nece[1]=str_replace("_\$_","\\r\\n", "$data[0]");
echo json_encode($nece);
}else{
	$s=["h"];
	echo json_encode($s);
}
?>