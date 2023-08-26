<?php
include("db.php");
session_start();
$tid = $_SESSION['tid'];
if(isset($_POST['sub'])){
	$pass = $_POST['pass'];
	$pass=md5($pass);
	$query2 = mysqli_query($con,"SELECT cpass from student where cid='$tid' AND cpass='$pass'");
	if(mysqli_num_rows($query2)>0){
		$_SESSION['pass']=$pass;
		header("Location:video.php");
	}else{
		$err = "Invalid code";
	}
}
date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
$query = mysqli_query($con,"SELECT cpass from student where cid='$tid' AND cdate='$date'");
if(mysqli_num_rows($query) == 1){
	$_SESSION['pass']=mysqli_fetch_row($query)[0];
	header("Location:video.php");
}else{
?>
<!DOCTYPE html>
<html>
<head>
	<title>Verification code</title>
</head>
<body>
	<form action="" method="post">
		<p>Enter code of test previously set</p>
		<input type="text" name="pass">
		<input type="submit" name="sub" value="view video">		
	</form>
	<p><?php if(isset($err)){echo $err;}  ?></p>
</body>
</html>
<?php
}
?>