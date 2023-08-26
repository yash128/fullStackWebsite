<?php
include ('db.php');
$f = $_POST['fil'];
$c = $_POST['some'];
$a = mysqli_query($con, "UPDATE home set hcomp='$c' where file='$f'");
if($a){
	echo "Updated";
}else{
	echo "error";
}
?>