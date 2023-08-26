<?php
include("db.php");
session_start();
$data = $_POST['a'];
$sid=$_SESSION['tid'];
$tid=$_SESSION['atid'];
$pass=$_SESSION['pass'];
$some = str_replace("\\r\\n","_\$_",$data);
$query = mysqli_query($con, "INSERT INTO video (sid,tid,sdata,cdate) VALUES ('$sid','$tid','$some','$pass')");
?>