<?php
session_start();
include ('db.php');
if(isset($_SESSION['tid'])){
    $tid = $_SESSION['tid'];
    $mail = $_SESSION['mail'];
    $id = mysqli_fetch_array(mysqli_query($con, "SELECT * from step where id='$tid'"));
    if($id[4]=='s'){
        header('location:check.php');
    }
}
    else{
    header('location:index.php');
}
$id = $id[0];
$eff = mysqli_query($con, "SELECT * from student/*teacher*/ where cid='$tid'");
if(mysqli_num_rows($eff) > 0){
$pass = mysqli_fetch_row($eff);
$date = $pass[1];
$sq = "SELECT * from teacher/*student*/ where tid = '$tid'  order by chdate desc";
$sd = mysqli_query($con, $sq);
}
?>
<!DOCTYPE html>
<html lang="en">
<head profile="pic.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/jpg" href="pic.jpg">
    <link rel="stylesheet" type="text/css" href="stylest.css">
    <title>Conduct online exams for students and see their videos while giving test</title>
    <script src="jquery-3.2.1.min.js"></script>
</head>
<body>
<div style="width:350px;height: 166px;background-color: blue;position: absolute;left: 50%;top: 50%;transform: translate(-50%,-50%);z-index: 1;" id="dpop">
	<div align="center" style="font-size: 25px;font-weight: bold;margin-top: 10px;color: #fff;">Your id is <?php echo $tid;   ?><br>(Send this id to students)</div>
	<div id="dte" style="position: absolute;left: 0;top:70px;font-size: 20px;font-weight: bold;padding: 13px;border: 2px solid black;background-color: grey;color: #fff;cursor: pointer;width:50%;align-items:center;justify-content:center;display:flex;">Take <br>tests</div>
	<div id="dah" style="position: absolute;right: 0;top:70px;font-size: 20px;font-weight: bold;padding: 13px;border: 2px solid black;background-color: grey;color: #fff;cursor: pointer;width:50%;align-items:center;justify-content:center;display:flex;">Assign <br>homework</div>
</div>
<script>
	document.getElementById("dte").onclick = function (){document.getElementById("dpop").style.display = "none";};
	document.getElementById("dah").onclick = function (){window.location.href = "https://peakme.in/home.php";};
</script>
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
<script src="easy.js"></script>
<div id="clock"><p id="pme">PEAKME</p><p id="time"></p></div>
<div class="can">
<p><a href="code.php">Click</a> to view video of students</p>
<p id="firt">Give details to take test</p>
<form onsubmit='return man()' action="test.php" method="post" id="form" enctype="multipart/form-data">
<p>Date on which you want to take test</p>
<p>Date</p>
<input type="date" name="date" id="date" max="2020-05-11" required>
   <p>Add time to start test in 24 hour format according to current time going on the screen. For example if you want test to start at 13:00 and end at 13:30 then values would be as follows</p>
   <table class="table">
        <tr>
        <td><input maxlength="2" type="tel" name="hour" id="hour" placeholder="HH" value="13" required></td><td><input maxlength="2" type="tel" name="min" id="min" placeholder="Min" value="00" required></td>
    </tr>
        <tr>
            <td>
    <p class="hour">Hour</p></td><td><p class="min">Minutes</p></td>
        </tr>
    </table>
    <p>Time to end test in 24 hour format</p>
    <table class="table">
        <tr>
        <td><input maxlength="2" type="tel" value="13" name="ehour" id="ehour" placeholder="HH" required></td><td><input maxlength="2" type="tel" name="emin" id="emin" placeholder="Min" value="30" required></td>
    </tr>
        <tr>
            <td>
    <p class="hour">Hour</p></td><td><p class="min">Minutes</p></td>
        </tr>
    </table>
    <div><span id="paratosel">Select multiple files below or Select them one by one on </span><span style="color:blue;" onClick="altsef();" class="chtu"><u>click</u></span></div>
    <div id="altsub" style="display:none;">
        <p>You can select images one by one here.</p>
        <?php
            for($z=0;$z<8;$z++){
                echo "<input type='file' id='z$z' name='z$z'><br>";
            }
        ?>
    </div>
    <p id="some"></p>
    <input type="file" name="image[]" id="image" multiple>
    <p id="conten"></p>
    <p class="test" style='display:none'>Content of Question Paper</p>
    <textarea type="text" style='display:none' name="test" id="test" cols="19" rows="10" class="tarea"></textarea>
    <p id="conten" style='display:none'></p>
    <p>Set a code for test. Remember you can not set same code for another test</p>
    <input placeholder="Password" type="password" name="testpass" id="testpass" required>
  <br><br>
    <input placeholder="Confirm Password" type="password" id="cpass" required>
<br><br><input type="submit" value="submit" id="submit" name="submit">
</form><br>
<p id="v">Details of students who will give your test will be shown here.</p>
<table class="dat">
    <tr>
    <th>Name & Answers</th><th>Files</th><th>Date</th><th>Marks</th>
    </tr>
    <?php
        if(mysqli_num_rows($eff)>0){  
            if(mysqli_num_rows($sd)>0){
            while($imp = mysqli_fetch_array($sd)){
            $name = mysqli_fetch_array(mysqli_query($con,"SELECT * from step where id='$imp[0]'"));
                $final = mysqli_query($con, "SELECT * from marks where mtid='$tid' && mid='$imp[0]' && uid='$imp[4]'");
            if(mysqli_num_rows($final) > 0){
                $jewgyf = mysqli_fetch_array($final);
                $finally = "$jewgyf[3]";
            }else{
                $finally = "<form action='marks.php' type='get'><input type='tel' name='marks' required><input type='hidden' name='student' value='$name[0]'><input type='hidden' name='stu' value='$imp[4]'><input type='hidden' name='date' value='$imp[5]'><button type='submit'>Send</button></form>";
            }
            if($imp[3]==""){
                $naans = "$name[1]";
            }
            else{
                $naans = "<a href='answers/$imp[3]'>$name[1]</a>";
            }
            if($imp[2]==''){echo "<tr><td>$naans</td><td></td><td>$imp[5]</td><td>$finally</td></tr>";}else{
            echo "<tr><td>$naans</td><td><a href='viewtwo.php?some=$imp[2]'>Attached files</a></td><td>$imp[5]</td><td>$finally</td></tr>";
            }
            }
           }else{
                echo "No data available";
            }
        }
        ?>
</table>
<form action='export.php' id='exp' method='post'><label>Label:</label><input type="text" name="label"><br><label>Date: </label><input type="date" name="dat"><br><input value="Export-to-pdf" type='submit' name='export' id='submit'></form>

<form action="del.php" method="post" class="del">
    <label>Delete test of date: </label>
    <input type="date" name="date" required><br>
    <input type="submit" name="sub" value="Delete"><p>NOTE: All files will also be deleted</p>
</form>
</div>
</div>
<script>
function _(id){
        return document.getElementById(id);
    }
function altsef(){document.querySelector("#altsub").style.display="block";_("some").innerText="Multiple images below";}
function man(){
if(_('testpass').value!=_('cpass').value){
    alert('Passwords do not match each other');
    return false;
}
if(_('min').value>59 || _('min').value<0 || _('hour').value>23 || _('hour').value<0 || _('emin').value>59 || _('emin').value<0 || _('.hour').value>23 || _('ehour').value<0){alert("Please check your entered time");return false;}
}
var nt = new Date();
year = parseInt(nt.getFullYear());
month = parseInt(nt.getMonth());
month = month+1;
date = parseInt(nt.getDate());
datea = date-1;
yearb= year+3;
if(month/10<1 && datea/10<1){
    x = year+'-0'+month+'-0'+datea;
    y = yearb+'-0'+month+'-0'+datea;
    if(date/10<1){z = year+'-0'+month+'-0'+date;}else{z = year+'-0'+month+'-'+date;}
}
else if(month/10<1){    
    x = year+'-0'+month+'-'+datea;
    y = yearb+'-0'+month+'-'+datea;
    z = year+'-0'+month+'-'+date;
    if(date/10<1){z = year+'-0'+month+'-0'+date;}else{z = year+'-0'+month+'-'+date;}
}
else if(datea/10<1){
    x = year+'-'+month+'-0'+datea;
    y = yearb+'-'+month+'-0'+datea;
    z = year+'-'+month+'-0'+date;
    if(date/10<1){z = year+'-0'+month+'-0'+date;}else{z = year+'-0'+month+'-'+date;}
}else{
    x = year+'-'+month+'-'+datea;
    y = yearb+'-'+month+'-'+datea;
    z = year+'-'+month+'-'+date;
}
_('date').setAttribute("min", x);
_('date').setAttribute("max", y);
_('date').setAttribute("value", z);
setInterval(function (){$('#time').load('time.php')}, 1000);
</script>
</body>
</html>