<?php
session_start();
if(!isset($_SESSION['tid'])){
    header('location:index.php');
}
if($_SESSION['identi'] == 't'){
        header('location:teacher.php');
}else{
    header('Location:shome.php');
}
if($_SESSION['class']==""){
    echo "<script>alert('Please update class by clicking on account\'s icon at top left corner of your window');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head profile="pic.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="stylest.css">
    <link rel="icon" type="image/jpg" href="pic.jpg"><title>Student</title>
</head>
<body>
<div style="width:350px;height: 156px;background-color: blue;position: absolute;left: 50%;top: 50%;transform: translate(-50%,-50%);z-index: 1;" id="dpop">
	<div align="center" style="font-size: 25px;font-weight: bold;margin-top: 20px;color: #fff;">Your id is <?php echo $_SESSION['tid'];   ?></div>
	<div id="dte" style="position: absolute;left: 0;top:60px;font-size: 20px;font-weight: bold;padding: 13px;border: 2px solid black;background-color: grey;color: #fff;cursor: pointer;width:50%;align-items:center;justify-content:center;display:flex;">Give <br>tests</div>
	<div id="dah" style="position: absolute;right: 0;top:60px;font-size: 20px;font-weight: bold;padding: 13px;border: 2px solid black;background-color: grey;color: #fff;cursor: pointer;width:50%;align-items:center;justify-content:center;display:flex;">Submit <br>homework</div>
</div>
    <div class="nav">
        <div class="acc"><img src="pic1.png" class="pic"></div>
        <div class="bat">
<form method="post" action="new.php">
            <p><?php if(isset($_SESSION['namem'])){echo $_SESSION['namem'];} ?> <u class='n'>rename</u> <span class="spb">x</span></p>
<input type='text' name='name' class="inp" placeholder="name">
<p class="name"><?php if(isset($_SESSION['mail'])){echo $_SESSION['mail'];} ?> <u class='c'>change</u></p>
<input type='email' name='mail' class="in" placeholder="Mail">
<p class='cs'>Class: <?php if(isset($_SESSION['class'])){echo $_SESSION['class']."   ";} ?><u id='csu'>change</u></p>
<select name="class" id="class">
            <?php
                $a = ["Class","Playpen","Pre. nur.","Nur.","L.K.G", "U.K.G",1,2,3,4,5,6,7,8,9,10,11,12];
                foreach ($a as $key => $value) {
                    echo "<option value='$value'>$value</option>";
                }
            ?>            
        </select>
        <select name="sec" id="sec">
            <?php
                echo "<option value='sec'>Section</option>";
                foreach (range('A', 'Z') as $i){
                    echo "<option value='$i'>$i</option>";
                }
            ?>
        </select>
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
    <script src="jquery-3.2.1.min.js"></script>
<script src="easy.js"></script>
<script>
		setInterval(function (){
			$('#time').load('time.php')
		}, 1000);
		document.querySelector('#csu').addEventListener("click",function (){document.querySelector("#class").style.cssText="display:inline-block";document.querySelector("#sec").style.cssText="display:inline-block";document.querySelector(".su").style.cssText="display:inline-block";});
	</script>
    <div class="cona" style="display:none;">
        <p>Please enter id and code sent by teacher</p>
        <form action="student.php" method="post">
            <p>Id</p>
            <input type="tel" name="id" id="id">
            <!--<p>code for test</p>
            <input type="password" name="spass" id="spass">-->
            <p><?php if(isset($_SESSION['er'])){echo $_SESSION['er'];unset($_SESSION['er']);} ?></p>
            <input type="submit" value="Submit" name="check">
        </form>
        <p><a href='viewmarks.php'>view</a> marks of test here</p>
    </div></div>
<script>
	document.getElementById("dte").onclick = function (){document.getElementById("dpop").style.display = "none";document.querySelector(".cona").style.display = "block";};
	document.getElementById("dah").onclick = function (){window.location.href = "https://peakme.in/home.php";};
</script>
</body>
</html>