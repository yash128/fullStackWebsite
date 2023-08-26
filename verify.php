<?php
session_start();
include ("db.php");
if(isset($_SESSION['mail'])){
if(isset($_POST['ver'])){
    $mail = $_SESSION['mail'];
    $code = $_POST['ver'];
    $query = mysqli_query($con, "SELECT step.lverify,step.cverify,step.identity from step where email='$mail'");
    if($query){
    $query = mysqli_fetch_array($query);
    if($code == $query[0]){
        $a = mysqli_query($con,"UPDATE step set cverify='1' where email='$mail'");
        if($a){
        $identity = $query[2];
                if($identity == 's'){
                  header('Location:check.php');
                }
                else{
                  header('Location:teacher.php');
                }
        }else{echo "Error occurred";}
    }else{
        $error = "Invalid code";
    }
    }else{
        $error = "An invalid error occurred";
    }
}}else{
    header('location:index.php');
}
?>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/jpg" href="pic.jpg">
    <title>Verification</title>
    </head>
    <body>
        <div style="font-size:20px;top:50%;left:50%;transform:translate(-50%,-50%);position:absolute;width:200px;height:auto;">
            <p align="center" style="font-size:20px;color:#fff;background-color:blue;">
        <?php
            if(isset($_SESSION['conver'])){echo $_SESSION['conver'];}
        ?></p>
            <p>Please enter verification code that has been sent to your mail.</p>
            <form action="" method="post">
                <input type='tel' name='ver' required><br><br>
                <button style="background-color:#63CED6;font-size:18px;padding:5px;" type="submit">Verify</button>
            </form>
            <p><?php if(isset($error)){echo $error;$error = "";} ?></p><p>Did'nt receive code ? <a href="resend.php">Resend</a></p>
        </div>
    </body>
</html>