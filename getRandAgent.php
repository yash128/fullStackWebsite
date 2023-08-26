<?php
include('db.php');
$s = mysqli_query($con,"SELECT b from a ORDER BY b DESC LIMIT 1");
$k = rand(1,mysqli_fetch_array($s)[0]);
$m = mysqli_query($con,"SELECT c from a where b='$k'");
echo mysqli_fetch_array($m)[0];
?>