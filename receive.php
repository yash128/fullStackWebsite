<?php
include("db.php");
session_start();
$sid=$_SESSION['tid'];
$tid=$_SESSION['atid'];
$pass=$_SESSION['pass'];
$data = mysqli_query($con,"SELECT tdata from video where sid='$sid' AND tid='$tid' AND cdate='$pass' AND ver='1' order by vid desc");
if(mysqli_num_rows($data)>0){
	$data = mysqli_fetch_row($data);
	$f = str_replace("_\$_", "\\r\\n", "$data[0]");
	echo $f;
	mysqli_query($con, "UPDATE video set ver='2' where tid='$tid' AND cdate='$pass' AND sid='$sid'");
}
?>