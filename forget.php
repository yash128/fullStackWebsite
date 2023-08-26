<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head profile='pic.jpg'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/jpg" href="pic.jpg">
    <title>Password recovery</title>
</head>
<body>

<div class="forget">
    <h1>Recover Your Password</h1>
    <p>You will get link on email by which you can change your password. Type your registered Mail.</p>
    <form action="mes.php" method="post">
        <input type="email" name="nmail" id="nmail" required>
        <input type="submit" value="submit" name="submit">
    </form>
<?php 
if(isset($_SESSION['eoo'])){ echo $_SESSION['eoo'];}
?>
</div>
</body>
</html>