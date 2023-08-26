<?php
session_start();
include ('db.php');
include ('prevent.php');
include('userinfo.php');
if(isset($_POST['submit'])){
$name = e(mysqli_real_escape_string($con, $_POST['user']));
$mail = e(mysqli_real_escape_string($con, $_POST['mail']));
$pass = e(mysqli_real_escape_string($con, $_POST['password']));
setcookie("mail",$_POST['mail'],time()+(60*60*24*60));
setcookie("pass",$_POST['password'],time()+(60*60*24*60));
$class = $_POST['class'];
$sec = $_POST['sec'];
$main = $class."-".$sec;
$_SESSION['mail'] = "$mail";
$identity = $_POST['identity'];
$s = "SELECT * from step where email = '$mail' && cverify='1'";
$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);
if($num > 0){$_SESSION['alre']="Mail already exists. Login here";header("Location:index.php");}
if(mysqli_num_rows(mysqli_query($con, "SELECT * from step where email = '$mail' && cverify='0'")) > 0){header('Location:resend.php');}
$lver = rand(1000,999999);
$_SESSION['class']=$main;
$reg = "INSERT into step(name, email, pass, identity, mclass, lverify, cverify) values ('$name', '$mail', '$pass', '$identity', '$main','$lver','1')";
$acheck = mysqli_query($con, $reg);
$look = mysqli_fetch_row(mysqli_query($con, "SELECT * from step where email='$mail' && pass = '$pass'"));
$_SESSION['tid'] = $look[0];
$_SESSION['namem'] = $look[1];
$_SESSION['identi'] = $identity;
if(isset($_POST['refer'])){
    $refer = $_POST['refer'];
    mysqli_query($con,"INSERT INTO refer(client,boss) VALUES ('$look[0]','$refer')");
}
if($acheck){
    header("Location:home.php");
}
else{
	echo "An error occurred";
}}else{header('Location:index.php');}
?>