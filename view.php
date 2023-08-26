<?php 
session_start();
if(!isset($_SESSION['tid'])){
	header('location:teacher.php');
}
if($_SESSION['identi'] == 's'){
header('location:check.php');
}
?>
<!DOCTYPE html>
<html>
<head profile="pic.jpg">
	<title>View Homeworks of students in tabular form for free with peakme</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="pic.jpg">
	<link rel="stylesheet" type="text/css" href="view.css">
	<link rel="manifest" href="/manifest.json">
</head>
<body>
        <div class="box">
        <div class="percent">
            <svg>
                <circle cx="70" cy="70" r="70"></circle>
                <circle cx="70" cy="70" r="70" id="mainpercent"></circle>
            </svg>
            <div class="number">
                <h2 class="numper"></h2><span>%</span>
            </div>
        </div>
        <h2 class="text"></h2>
    </div>
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
        <div class="stroke" style="display:none;"><div></div><div></div><div></div></div>
    <div class="init">
<span class="spa">x</span>
    <a href="check.php" target="_blank">Home Page</a>
    <a href="home.php" target="_blank">Homework</a>
    </div>
    <div id="clock"><p id="pme">PEAKME</p><p id="time"></p></div>
    <div class="can">
    <?php
include ('db.php');
$s = "";
$c = 0;
$a = 0;
echo "<table class='firta'><tr><th>S. no.</th><th>Name</th><th>Files</th><th>Marks</th><th>Date</th></tr>";
if(isset($_SESSION['tid'])){
    $tid = $_SESSION['tid'];
$sq = "SELECT * from home where tid = '$tid' order by mclass,date asc";
$sd = mysqli_query($con, $sq);
    if(mysqli_num_rows($sd)>0){
        echo "<p>Click on class to view homework</p>";
        while($imp = mysqli_fetch_array($sd)){
            $r = $imp[4];
            if($r != $s){
                $a=$a+1;
                $ac = "</table><div class='b$a' id='b$a' onClick='reply_click(this.id)'><p>$r&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style='background-color:blue;color:#fff;'>click here</span></div><table id='a$a' class='firta'>";
                echo $ac;$c=0;
            }$c=$c+1;
            $comp = "<input id='d$c' onkeyup='loadDoc(this.id)' type='text' style='width:30px;' value='$imp[5]'><p id='e$c'></p>";
        echo "<tr class='urja'><td id='snoq'>$c</td><td id='name'>$imp[0]</td><td><a id='c$c' href='viewtwo.php?som=$imp[2]'>files</a></td><td>$comp</td><td>$imp[3]</td></tr>";
        $s = $imp[4];
    }
    echo "</table>";
}else{
    echo "<tr><td>No data available</td></tr></table>";
}}
?>
</div>
<script type="text/javascript">
    no = parseInt(<?php echo $a;  ?>);
    function _(id){
        return document.getElementById(id);
    }
for (var i = 1; i <= no; i++) {
    la = "a"+i;
    ta = "b"+i;
    tr = document.getElementById(la);
    tr.style.display = 'none';
    document.getElementById(ta).style.cssText = 'width: 100%; height: 40px; color: #fff;background-color:blue;padding-left:40px;font-size:22px;font-weight:bold';
}
function reply_click(clicked_id)
{
    last = clicked_id;
    last = last.replace("b", "a");
    th = document.getElementById(last).style.display = 'block';
}
</script>
<p id="exportpd" onclick="mainfu(this.id);" style="color:blue;"><u>Maintain record of students</u></p>
<p id="delhw" onclick="mainfu(this.id);" style="color:blue;"><u>Delete</u></p>
<div class="exportpd" style="display:none;">
<p style='margin-top:20px;'>You can export list of homework to pdf below. Class and heading options are optional. If you select class and section the list of the same class will be exported and heading will be written on the top of the pdf.</p>
<form action="export2.php" method="post">
    <label>Class (optional): </label>
        <select name="dat" id="class">
            <?php
                $a = ["Class","Playpen","Pre. nur.","Nur.","L.K.G", "U.K.G",1,2,3,4,5,6,7,8,9,10,11,12];
                foreach ($a as $key => $value) {
                    echo "<option value='$value' onclick='clame(this.value);'>$value</option>";
                }
            ?>            
        </select>
        <select name="sec" id="sec">
            <?php
                echo "<option value='sec' >Section</option>";
                foreach (range('A', 'Z') as $i){
                    echo "<option value='$i' >$i</option>";
                }
            ?>
        </select><br><label>heading (optional): </label><input type="text" name='label' placeholder="For eg: HW of ch 1" class="inpua"><br><input class="inpua" type="submit" value="Export-to-pdf"></form>
</div>    <div class="delhw" style="display:none;">
    <form action="del.php" method="post" onsubmit="return rvff();">
    <p>Delete homework of Class: <select name="dat" id="class">
            <?php
                $a = ["Class","Playpen","Pre. nur.","Nur.","L.K.G", "U.K.G",1,2,3,4,5,6,7,8,9,10,11,12];
                foreach ($a as $key => $value) {
                    echo "<option value='$value' >$value</option>";
                }
            ?>            
        </select><select name="sec" id="sec">
            <?php
                echo "<option value='sec' >Section</option>";
                foreach (range('A', 'Z') as $i){
                    echo "<option value='$i' >$i</option>";
                }
            ?>  </select></p><input type="submit" value="Delete" name="del" style="background-color:red;padding:5px;"></form></div>  
</div>
<script src='hw.js' type="text/javascript"></script>
<script type="text/javascript" src="easy.js"></script>
<script>
    function mainfu(wotb){
        document.querySelector("."+wotb).style.display = "block";
    }
    function rvff(){
    if(document.querySelectorAll('#class')[1].value=="Class" || document.querySelectorAll('#sec')[1].value=="sec"){
        var contuwtdwd = confirm("Are you sure to delete complete data ?");
        if(contuwtdwd==true){return true;}else{return false;}
    }}</script>
</body>
</html>