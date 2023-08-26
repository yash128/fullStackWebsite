<?php
session_start();
include ('db.php');
include ('prevent.php');
date_default_timezone_set("Asia/Kolkata");
$ntime = date("d-m-Y H:i");
if(isset($_POST['id'])){
	$tid = e(mysqli_real_escape_string($con, $_POST['id']));
	$name = $_POST['name'];
	$sec = $_POST['sec'];$class = $_POST['class'];$class = "$class"."-"."$sec";
	$query = mysqli_query($con, "SELECT * from step where id='$tid'");
	if(mysqli_num_rows($query) > 0){
	    $ident = mysqli_fetch_array($query);
	    if($ident[4]!='s'){
	    $any = "";
	    $a=0;
foreach($_FILES["file"]["tmp_name"] as $key => $image){
    if($_FILES["file"]["tmp_name"]==""){continue;}
    $fn = $_FILES['file']['name'][$key];
    $ft = $_FILES["file"]["tmp_name"][$key];
    $filetype = pathinfo($fn, PATHINFO_EXTENSION);$a=$a+1;
    $fn = "file".$a.rand(10,100).date("mjYHis").".$filetype";
    $cufon = move_uploaded_file($ft, "home/$fn");if($cufon){$any .= "$fn".",";}else{move_uploaded_file($ft, "home/$fn");$any .= "$fn".",";}
}
for($i=0;$i<8;$i++){
    if($_FILES["z$i"]["tmp_name"]!=""){
    $fns = $_FILES["z$i"]["name"];
    $fts = $_FILES["z$i"]["tmp_name"];$a=$a+1;
    $filetype = pathinfo($fns, PATHINFO_EXTENSION);
    $try = "file".$a.rand(1,100).date("mjYHis").".$filetype";
    $fileab = move_uploaded_file($fts, "home/$try");if($fileab){$any .= "$try".",";}else{move_uploaded_file($fts, "home/$try");$any .= "$try".",";}
}}
}else{echo "Id does not exists";exit();}
if($any!=""){$aa = mysqli_query($con, "INSERT into home(sid, tid, file, date, mclass) values('$name', '$tid', '$any', '$ntime', '$class')");}else{exit("Select images");}
	if($aa){
		echo "Homework sent";
	}else{
		echo "Error while sending homework";
	}
}else{echo "Id does not exists";}
}
?>