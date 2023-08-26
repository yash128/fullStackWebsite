<?php
include ("db.php");
session_start();
$tid = $_SESSION['tid'];
$pass = $_SESSION['pass'];
$sid = $_POST['b'];
$data = $_POST['a'];
$data = str_replace("\\r\\n", "_\$_", "$data");
mysqli_query($con,"UPDATE video set tdata='$data',ver='1' where tid='$tid' AND cdate='$pass' AND sid='$sid'");
?>