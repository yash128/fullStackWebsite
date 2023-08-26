<?php
session_start();
include ("db.php");
if(isset($_SESSION['mail'])){
$mail = $_SESSION['mail'];
$m = mysqli_fetch_row(mysqli_query($con,"SELECT step.lverify from step where email='$mail'"))[0];
        $to = $mail;
        $from = "peakme@peakme.in";
        $head = "Content-type: text/html;\r\n";
        $head .= "From:".$from;
        $subject = "Mail Verification";
        $mes ="<h1>Welcome</h1><p>Your code to verify your mail is <b>$m</b></p>";
        $mail = mail("$to", "$subject", "$mes", "$head");
        if($mail){
            $_SESSION['conver'] = "Link resent";
            header("Location:verify.php");
        }else{
            echo "Mail is not registered. Please get Register";
        }
}else{
    header("Location:index.php");
}


?>