<?php
session_start();
require 'fpdf.php';
if(isset($_SESSION['mail'])){
    $mail = $_SESSION['mail'];
}
else{header('location:index.php');}
if(isset($_POST['submit'])){
include ('db.php');
include ('prevent.php');
    $date = $_POST['date'];
    $sh = $_POST['hour'];
    $sm = $_POST['min'];
    $eh = $_POST['ehour'];                          
    $em = $_POST['emin'];
    $test = e(mysqli_real_escape_string($con, $_POST['test']));
    $pass = e(md5(mysqli_real_escape_string($con, $_POST['testpass'])));
    $id = $_SESSION['tid'];
    if(mysqli_num_rows(mysqli_query($con, "SELECT * from student where cpass='$pass' && cid='$id'")) > 0){
        echo "Sorry! you can not set same password for each test.";exit();
    }
    else{
    $fsname = "";
    $a=0;
    foreach($_FILES["image"]["tmp_name"] as $key => $imag){
    $image = $_FILES["image"]["name"][$key];
    $tmp = $_FILES["image"]["tmp_name"][$key];
    $filetype = explode(".",$image);
    $filetype = end($filetype);
    $a = $a+1;
    $fname = "ques"."$id".$a.date("YmjHis")."."."$filetype";
        if($filetype!=""){
    $fsname .= "$fname".",";
    move_uploaded_file($tmp, "videos/$fname");}
    }
    for($i=0;$i<8;$i++){
    if(isset($_FILES["z$i"]["name"])){
    if($_FILES["z$i"]["tmp_name"]!=""){
    $fns = $_FILES["z$i"]["name"];
    $fts = $_FILES["z$i"]["tmp_name"];
    $filetype = explode(".","$fns");$filetype=end($filetype);$a=$a+1;
    $try = "ques"."$id".$a.date("YmjHis")."."."$filetype";
    if($filetype!=""){
    $fsname .= "$try".",";
    $fileab = move_uploaded_file($fts, "videos/$try");
    }
}}}
    $reg = "INSERT into student(cid, cdate, cshour, csmin, cehour, cemin, cfile, ctest, cpass) values ('$id', '$date', '$sh', '$sm', '$eh', '$em', '$fsname', '$test', '$pass')";
    }
$query = mysqli_query($con, $reg, MYSQLI_USE_RESULT);
$_SESSION['aspass'] = $pass;
echo "Your test is created.<br>When any student will enter your id that is $id and password set by you for test he/she will be allowed to give your test.<br>Thank You for using <a href='https://www.peakme.in'>PeakMe.in</a>";
}
else{
    header('location:teacher.php');
}
?>