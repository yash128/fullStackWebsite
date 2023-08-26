<?php
session_start();
$t = $_SESSION['tid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Earn with Peakme</title>
</head>
<body>
    <div>
        <p>
            Now you can earn with peakme.</p>
            <p>Refer your friends about it and earn coins.</p>
            <p>You will get coins once your friend,relative register with us by clicking <span style="color:blue;">https://peakme.in/index.php?refer=<?php echo $t;  ?></span> or enter your referal code <?php echo $t;  ?>.</p>
            You will get your coins in your bank account once you have 50 coins.
            If you did not receive them within two days, you are free to contact us.
<br>
            <p>T&C apply.</p>
    </div>
</body>
</html>