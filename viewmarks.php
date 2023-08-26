<?php
session_start();
include("db.php");
if(isset($_SESSION['tid'])){
$sid = $_SESSION['tid'];
$query = mysqli_query($con,"SELECT step.name,marks.mmarks,marks.mdate FROM marks INNER JOIN step ON marks.mtid = step.id where marks.mid = '$sid' order by step.name asc");
   
}
?>
<!DOCTYPE html>
<html>
<head profile="pic.jpg">
	<title>View marks</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="pic.jpg">
	<link rel="stylesheet" type="text/css" href="view.css">
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
    </div>
    <div id="clock"><p id="pme">PEAKME</p><p id="time"></p></div>
    <div><script src="easy.js"></script>
<table class="vietab">
        <?php
        if(mysqli_num_rows($query)>0){
            $a=0;
            echo "<tr><th>S. no.</th><th>Name</th><th>Marks</th><th>Date of test</th></tr>";
            while($imp=mysqli_fetch_array($query)){
                $a=$a+1;
                echo "<tr><td>$a</td><td>$imp[0]</td><td>$imp[1]</td><td>$imp[2]</td></tr>";
            }}
        ?>
        </table>
    </div>
</div>
</html>