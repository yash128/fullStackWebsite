<?php 
session_start();
include('db.php');
require 'fpdf.php';
if(isset($_POST["ans"])){
$id = $_SESSION['sid'];
$pass = $_SESSION['pass'];
$tid = $_SESSION['atid'];
$chdate  = mysqli_fetch_row(mysqli_query($con, "SELECT * from student where cid='$tid' && cpass='$pass'"));
$chdate = $chdate[1];
$ansn = $_POST["ans"];
$pdf = new FPDF();
$filename = NULL;
if($ansn != ""){
$pdf->AddPage();
$pdf->SetFont('Arial','B',20);
$pdf->Cell(10,10,"$ansn");
$filename = $_SESSION['filen'].".pdf";
$pdf->Output('F', "answers/$filename");
}
$some = NULL;
$pd = new FPDF();
$a=0;
foreach($_FILES["file"]["tmp_name"] as $key => $image){
    $fn = $_FILES["file"]["name"][$key];
    $ft = $_FILES["file"]["tmp_name"][$key];
    $filetype = explode(".","$fn");
    $filetype = end($filetype);
    $a=$a+1;
    $try = $_SESSION["filen"];
    $try = $try."$a".".$filetype";
    $exar = ["jpg", "jpeg", "png", "gif","JPG", "JPEG", "PNG", "GIF"];
    if(in_array("$filetype", $exar)){
        move_uploaded_file($image, "videos/$try");
        $pd->AddPage();
        $check = "learning";
    $images=getimagesize("videos/$try");
    $width = intval($images[0]*0.264583333)-3;
    $height = intval($images[1]*0.264583333)-3;
    if($width>207){
        if($height>294){
            $pd->Image("videos/$try",0,0,207,294);
        }else{
            $pd->Image("videos/$try",0,0,207,$height);
        }
    }
    elseif($height>294){
        if($width>207){$pd->Image("videos/$try",0,0,207,294);}else{$pd->Image("videos/$try",0,0,$width,294);}
    }elseif($width>207 && $height>294){$pd->Image("videos/$try",0,0,207,294);}else{$pd->Image("videos/$try",0,0,$width,$height);}
        unlink("videos/$try");
    }
    else{
    if($filetype!=""){
    $some .= "$try".",";
    $fileab = move_uploaded_file($image, "videos/$try");
    }
    }
}
for($i=0;$i<8;$i++){
    if(isset($_FILES["z$i"]["name"])){
    if($_FILES["z$i"]["tmp_name"]!=""){
    $fns = $_FILES["z$i"]["name"];
    $fts = $_FILES["z$i"]["tmp_name"];
    $filetype = explode(".","$fns");$filetype=end($filetype);$a=$a+1;$try = $_SESSION["filen"];
    $try = $try."$a".".$filetype";
    $exar = ["jpg", "jpeg", "png", "gif","JPG", "JPEG", "PNG", "GIF"];
    if(in_array("$filetype", $exar)){
        move_uploaded_file($fts, "videos/$try");
        $pd->AddPage();
        $check = "learning";
    $images=getimagesize("videos/$try");
    $width = intval($images[0]*0.264583333)-3;
    $height = intval($images[1]*0.264583333)-3;
    if($width>207){
        if($height>294){
            $pd->Image("videos/$try",0,0,207,294);
        }else{
            $pd->Image("videos/$try",0,0,207,$height);
        }
    }
    elseif($height>294){
        if($width>207){$pd->Image("videos/$try",0,0,207,294);}else{$pd->Image("videos/$try",0,0,$width,294);}
    }elseif($width>207 && $height>294){$pd->Image("videos/$try",0,0,207,294);}else{$pd->Image("videos/$try",0,0,$width,$height);}
        unlink("videos/$try");
    }
    else{
    if($filetype!=""){
    $some .= "$try".",";
    $fileab = move_uploaded_file($fts, "videos/$try");
    }
    }
}}}
if(isset($check)){
$pas = $_SESSION['filen'].".pdf";
$some .= "$pas";
$pd->Output("F", "videos/$pas");
}
$query = "INSERT INTO teacher(sid, tid, sfile, stext, spass, chdate) VALUES ('$id','$tid', '$some', '$filename', '$pass', '$chdate')";
$abcf = mysqli_query($con, $query, MYSQLI_USE_RESULT);
    if($abcf){
        echo "Your files are submitted\nYour answer sheet is submitted";
    }
    else{
        echo "Once you have submitted your test. You can not resubmit it";
    }
}
else{
    echo "Sorry! An error occurred";
}
?>