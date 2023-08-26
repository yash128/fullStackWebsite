<?php
session_start();
include ('db.php');
include ('prevent.php');
if(isset($_POST['name'])){
$name = e($_POST['name']);}
$id = $_SESSION['tid'];
if(isset($_POST['mail'])){$mail = e($_POST['mail']);}
if(isset($_POST['submit'])){
	if($name != ""){
   $conb = mysqli_query($con, "UPDATE step SET name='$name' WHERE id='$id'");$_SESSION['namem'] = $name;
   }
   if($mail != ""){
       if(mysqli_num_rows(mysqli_query($con, "SELECT email from step where email=$mail"))==0){
       $cona = mysqli_query($con, "UPDATE step SET email='$mail' WHERE id='$id'");$_SESSION['mail'] = $mail;}else{echo "mail already exists";}
   }
   if($_POST['class']!="Class"){$cla=$_POST['class'];}
   if($_POST['sec']!="sec"){$sec=$_POST['sec'];
   if(isset($cla)){
        $main=$cla."-".$sec;
        $conaa=mysqli_query($con, "UPDATE step SET mclass='$main' WHERE id='$id'");
        if($conaa){
           echo "Class updated successfully<br>";
           $_SESSION['class']=$main;
        }
        else{
           echo "Please select class and section";
        }
   }
   else{
       echo "Please select class";
   }
   }
   if($conb){
    echo "Name Successfully updated";
   }
   elseif($cona){
       echo "Mail updated successfully.";
   }
   elseif($conb && $cona){
       echo "Name and Mail successfully updated";
   }
   else{
    echo "Your current mail is ".$_SESSION['mail'];
   }
}else{
	header('location:check.php');
}

?>