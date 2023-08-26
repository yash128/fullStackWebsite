<?php
include ('db.php');
include ('prevent.php');
if(isset($_GET['d'])){
$s = $_GET['d'];
}else{
$s = getallheaders()['User-Agent'];
}
$m = e(mysqli_real_escape_string($con, $s));
$a = "INSERT INTO a(c) VALUES('$m')";
$p = mysqli_query($con,$a);
?>
