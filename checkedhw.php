<?php
include ('db.php');
require 'fpdf.php';
$f = $_POST['fil'];
$a=0;
$uid = $_SESSION['tid'];
$any = "";
$pd = new FPDF();
foreach($_FILES["file"]["tmp_name"] as $key => $image){
    if($_FILES["file"]["tmp_name"]==""){
        break;
    }
    $fn = $_FILES['file']['name'][$key];
    $ft = $_FILES["file"]["tmp_name"][$key];
    $filetype = explode(".",$fn);
    $filetype=end($filetype);
    $a=$a+1;
    $fn = "chhw".$a.$uid.date("mjYHis").'.'."$filetype";
    $array = ["jpg","jpeg","png","gif"];
    if(in_array("$filetype", $array)){
        move_uploaded_file($ft, "chhw/$fn");
        $pd->AddPage();
        $pd->Image("chhw/$fn",0,0,210,297);
        unlink("chhw/$fn");
        $check="";
    }else{
    if($filetype != ""){
    $fileab = move_uploaded_file($ft, "chhw/$fn");
    $any .= "$fn".",";
    }}
}
if(isset($check)){
    $fn = "chhw"."$uid".date("mjYHis").'.pdf';
    $pd->Output("F", "chhw/$fn");
    $any .= "$fn";
}
$a = mysqli_query($con, "UPDATE home set hwch='$any' where file='$f'");
if($a){
	echo "Sent";
}else{
	echo "error";
}
?>