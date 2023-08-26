<?php
session_start();
include ('db.php');
include ('prevent.php');
if(isset($_COOKIE['pass'])){
    $_POST['submit']="";$_POST['mail']=$_COOKIE['mail'];$_POST['password']=$_COOKIE['pass'];
}
if(isset($_POST['submit'])){
$name = e(mysqli_real_escape_string($con, $_POST['mail']));
$pass = e(mysqli_real_escape_string($con, $_POST['password']));
$pass2 = md5($pass);
$_SESSION['mail'] = $name;
$s = "select * from step where email='$name' && (pass='$pass' or pass='$pass2')";
$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);
$data=mysqli_fetch_array($result);
if($data[4]=='s'){
$_SESSION['identi'] = 's';
}else{
$_SESSION['identi'] = 't';
}
$_SESSION['namem'] = $data[1];
$_SESSION['no']='t';
if($num > 0)
{
$_SESSION['tid']=$data[0];
if(!isset($_COOKIE['mail'])){
setcookie("mail",$name,time()+(60*60*24*60));
setcookie("pass",$_POST['password'],time()+(60*60*24*60));
}
header("Location:home.php");
}
else{
$_SESSION['st'] = "Invalid mail or password";
setcookie("mail",$name,time()-(60*60*24*60),"/");
setcookie("pass",$pass,time()-(60*60*24*60),"/");
 header('location:index.php');
}}else{header('location:index.php');}
?>