<?php

include('db.php');
include ('prevent.php');
if(!isset($_GET['code'])){
    exit("can't find page");
}

$code = $_GET['code'];
$getmail = mysqli_query($con, "SELECT email from link where code='$code'");
if(mysqli_num_rows($getmail) == 0){
    exit("can't find page");
}

if(isset($_POST['pass'])){
    $pw = e($_POST['pass']);
    $pw = md5(mysqli_real_escape_string($con, $pw));
    $row = mysqli_fetch_array($getmail);
    $mail = $row["email"];
    $query = mysqli_query($con, "UPDATE step SET pass='$pw' where email='$mail'");

    
if($query){
    $query = mysqli_query($con, "DELETE from link where code='$code'");
    exit('password updated');
}else{
    exit('something went wrong');
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>change Password</title>
</head>
<body>
    <form action="" method="post" onSubmit="return validate()">
        <label for="pass">New Password</label><br>
        <input type="password" name="pass" id="pass" required><br>
        <label for="passc">Confirm Password</label><br>
        <input type="password" id="passc" required><br>
        <p id="passe"></p>
        <input type="submit" value="Change Password">
    </form>    
    <script>
        pass = document.GetElementById("pass");
        passc = document.GetElementById("passc");
        passce = document.GetElementById("passce");
        passe = document.GetElementById("passe");
        
    function validate(){    
    if(pass.value.length <= 5 || pass.value.length > 20){
    passe.innerText = "length should be more than 5";
    return false;
}if(pass.value != passc.value){
    passe.innerText = "Passwords do not match each other";
    return false;
}
        
    }
    </script>
</body>
</html>