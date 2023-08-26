<?php
session_start();
include('db.php');
if(isset($_POST['nmail'])){
    $mail = $_POST['nmail'];
    $code = md5(date("YmdHis"));
    $url= "http://peakme.in"."/reset.php?code=".$code;
    if(mysqli_num_rows(mysqli_query($con, "SELECT id from step where email='$mail'"))>0){
    $query = "INSERT into link(code, email) values('$code', '$mail')";
    $result = mysqli_query($con, $query);
    if($result){
        $to = $mail;
        $from = "peakme@peakme.in";
        $head = "Content-type: text/html;\r\n";
        $head .= "From:".$from;
        $subject = "Password Recovery";
        $mes ="<h1>Welcome</h1><p>your request to recover your password is accomplished. click <a href=".$url.">this link</a> to do so.</p>";
        $mail = mail("$to", "$subject", "$mes", "$head");
        if($mail){
             echo "You will receive a link on your mail soon.\nYou can check your spam folder also if you did not receive link.\n Please check mail and click on the link to recover your password";
        }else{
            echo "Mail is not registered. Please get Register";
        }
    }}
    else{
        die("no mail found. please register");
    }
}
    else{
        header('Location:forget.php');
    }
?>