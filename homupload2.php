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
/*foreach($_FILES["file2"]["tmp_name"] as $key => $image){
    if($_FILES["file2"]["tmp_name"]==""){continue;}
    $fn = $_FILES['file2']['name'][$key];
    $ft = $_FILES["file2"]["tmp_name"][$key];
    $filetype = pathinfo($fn, PATHINFO_EXTENSION);
    $fn = "file".$a.rand(10,100).date("mjYHis").".$filetype";
    $cufon = move_uploaded_file($ft, "home/$fn");if($cufon){$any .= "$fn".",";}else{move_uploaded_file($ft, "home/$fn");$any .= "$fn".",";}
}*/
foreach ($_POST['file'] as $key => $value) {
	$img = $value;
	$a=$a+1;
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$im = imageCreateFromString($data);
	if($im){
	   $fnk = "file".$a.rand(10,100).date("mjYHis").".png";
	$img_file = "home/$fnk";
	imagepng($im, $img_file, 0);$any .= "$fnk".",";
	}
}
}else{echo "Id does not exists";exit();}
if($any!=""){$aa = mysqli_query($con, "INSERT into home(sid, tid, file, date, mclass) values('$name', '$tid', '$any', '$ntime', '$class')");}else{exit("Select images");}
	if($aa){
		echo "Homework sent successfully";
	}else{
		echo "Error while sending homework";
	}
}else{echo "Id does not exists";}
}
?>