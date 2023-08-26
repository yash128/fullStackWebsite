<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="stylest.php">
</head>
<body>

    <div class="nav">
        <div class="acc"><img src="pic1.png" class="pic"></div>
        <div class="bat">
<form method="post" action="new.php">
            <p><?php if(isset($_SESSION['namem'])){echo $_SESSION['namem'];} ?> <u class='n'>rename</u> <span class="spb">x</span></p>
<input type='text' name='name' class="inp" placeholder="name">
<p class="name"><?php if(isset($_SESSION['mail'])){echo $_SESSION['mail'];} ?> <u class='c'>change</u></p>
<input type='email' name='mail' class="in" placeholder="Mail">
<p class="id">ID: <?php if(isset($_SESSION['tid'])){echo $_SESSION['tid'];} ?></p>
<p class="cont">Contact Us</p>
<p><a href="logout.php"><u>log out</u></a></p>
<input type="submit" value="submit" class="su" name="submit">
</form>
    </div>
        <div class="wel">Welcome <?php if(isset($_SESSION['namem'])){echo $_SESSION['namem'];} ?></div><img src="pic.jpg" class="pic1"> 
        <div class="stroke"><div></div><div></div><div></div></div>
    <div class="init">
<span class="spa">x</span>
    <a href="check.php" target="_blank">Home Page</a>
    <a href="home.php" target="_blank">Homework</a>
    <a href="mcq.php" target="_blank">MCQ test</a>
    </div>
    </div>
<script src="easy.js"></script>

</body>
</html>