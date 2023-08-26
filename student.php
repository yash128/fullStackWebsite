<?php
session_start();
include ('db.php');
include ('prevent.php');
if(!isset($_SESSION['mail'])){
    header('location:index.php');
}else{$mail = $_SESSION['mail'];}
if(isset($_POST['check'])){
    $id = e($_POST['id']);// teacher id
    $_SESSION['atid'] = $id;//teacher id
    /*$pass= e(md5(mysqli_real_escape_string($con, $_POST['spass'])));*/
    $n = "SELECT * from student where cid = '$id' order by uid desc";
    $a = mysqli_query($con, $n);
    if(mysqli_num_rows($a) > 0){
       $d = mysqli_fetch_row($a);$adate = explode("-", $d[1]);$year = $adate[0];$month = $adate[1];$date = $adate[2]; $shour = $d[2];$smin = $d[3];$ehour = $d[4];$emin = $d[5];$afile = $d[6];$atest = $d[7];
        $query = "SELECT * from step where email = '$mail'";
        $sid = mysqli_fetch_row(mysqli_query($con, $query));
        $si = $sid[0];
        $_SESSION['pass'] = $d[8];
        if($sid[4]=='t'){header('location:index.php');}
        $filename = "mem"."$si"."$shour"."$smin"."$emin"."$ehour"."$year"."$month"."$date";
        }
        else{
            $_SESSION['er'] = "Wrong code or id";
            header('location:check.php');
        }
        $_SESSION['sid'] = $si;
        $_SESSION['filen'] = $filename;
        $_SESSION['afile'] = $afile;
}else{header('location:check.php');}
?>
<!DOCTYPE html>
<html lang="en">
<head profile="pic.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="stylest.css">
    <link rel="icon" type="image/jpg" href="pic.jpg">
    <title>Response to online exams - Know what you learnt</title>
</head>
<body oncontextmenu="return false">
    <div id="altsub" style="display:none;">
        <p>You can select images one by one here. </p>
        <?php
            for($z=0;$z<8;$z++){
                echo "<input type='file' id='z$z' onclick='nooalfsel(this.id)'><br>";
            }
        ?>
        <button onclick="altsub();">Submit</button>
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
<p class='cs'>Class: <?php if(isset($_SESSION['class'])){echo $_SESSION['class'];} ?></p>
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
<script src="easy.js"></script>
    <p id="relax">Please Wait for the test to start<br><b>Suggestions</b><br>Select files before time to end<br>Your test will start at <?php echo"$shour : $smin"; ?><br></p>
    <div id="videoa"><video id="myvid" width="300" height="200" autoplay></video></div>
    <div class="crucial"><div class='paper'><?php
    if(isset($atest)){echo $atest;}
    if(isset($afile)){
        $afile=explode(",",$afile);
        foreach($afile as $img){
            if($img != ""){
            echo "<iframe width='100%' height='250' src='videos/$img' title='Question paper'>Your browser does not support iframes</iframe>";
            }
        }
    }
    ?>
   </div>
    <p>Your answer sheet will be automatically submitted once the time is over</p>
        <form id='upload_form' enctype='multipart/form-data' method='post' action="upload.php">
            <textarea id='answer' name="ans"></textarea>
            <input type='file' id='file' name="file[]" style="display:none;" onchange="nofs()" multiple><br>
            <div><span id="paratosel">Select multiple files below or Select them one by one on </span><span style="color:blue;" onClick="altsef();" class="chtu"><u>click</u></span></div>
            <div id="selfa" onclick="self()"><span style="background-color:green;width:150px;color:#fff;">Attach files</span><span id="nofs"></span></div><br>
            <button id="tsub" type="button">Submit</button>
        </form>
    </div><div class='alot'><p id='error'></p><div class="progress"><progress id='progressBar' value='0' max='100' style='width:300px;' ></progress><h3 id='status'></h3><p id='loaded_n_total'></p></div></div>
    <div></div>
</div>
	<script type="text/javascript" src="simplepeer.min.js"></script>
	<script type="text/javascript">
let constraintObj = {audio: true,video:{facingMode: "user",width: { min: 640},height: { min: 480}}};
navigator.mediaDevices.getUserMedia(constraintObj).then(stream => {
client = {};
    var p = new SimplePeer({
        initiator: true,
        trickle: false,
        stream:stream
    })
    var vid = document.getElementById("myvid");
    if('srcObject' in vid){vid.srcObject = stream;}else{vid.src = window.URL.createObjectURL(stream);}
    vid.parentNode.style.transform = 'rotateY(180deg)';
    p.on("signal", data => {
        var fd = new FormData();
        fd.append("a", JSON.stringify(data));
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "store.php", true);
        xmlhttp.send(fd);
    })
    client.peer = p;
p.on("error", (err) => {
console.log(err);
}) 
p.on("data", data => {
    document.querySelector("#videoa") += data;
})
    function load(){
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if(this.responseText != ""){
        const p = client.peer;
        clearInterval(x);
        p.signal(this.responseText);
        p.on("connect", () => {
            console.log("connect");
        })
      }}
    };
    xml.open("POST", "receive.php", true);
    xml.send();
    }
    var x = setInterval(load, 1000);
}).catch((err) => {console.log(err)})
</script>
    <?php date_default_timezone_set("Asia/Kolkata"); ?>
    <script>
now= new Date(<?php echo date("Y").",".date("m").",".date("d").",".date("H").",".date("i").",".date("s"); ?>);month=<?php if(isset($year)){echo $month;} ?>;millisTill10= new Date(<?php if(isset($year)){echo $year;}?>, month, <?php if(isset($date)){echo $date;}?>, <?php if(isset($shour)){echo $shour;}?>, <?php if(isset($smin)){echo $smin;}?>, 0, 0) - now;milli= new Date(<?php if(isset($year)){echo $year;}?>,month,<?php if(isset($date)){echo $date;}?>,<?php if(isset($ehour)){echo $ehour;}?>,<?php if(isset($emin)){echo $emin;}?>,0,0) - now;if(millisTill10<0){millisTill10 = millisTill10 * 0;}if (milli < 0) {milli = milli * 0;}function B(el){return document.querySelector(el);}function _(el){return document.getElementById(el);}function self(){_("file").click();}a=0;
function nofs(){
_("nofs").innerText=" "+_("file").files.length+" selected";
}
function altsef(){
    B(".nav").style.display="none";
    B("#altsub").style.display="block";
}
function altsub(){
    B(".nav").style.display="block";
    B("#altsub").style.display="none";
}
c=0;
function nooalfsel(id){
    if(_(id).files[0] != ""){
        c++;
    }else{
        c--;
    }
     _("paratosel").innerText=c+" files selected";
     B(".chtu").innerText=" change";
}
function uploadFile() {
fd = new FormData();
for(const file of _('file').files){
fd.append("file[]", file);
}
for(var z=0;z<8;z++){
    if(_("z"+z).value != ""){
        fd.append("z"+z,_("z"+z).files[0]);
    }
}
altsub();
B(".chtu").removeAttribute("onclick");
_("selfa").removeAttribute("onclick");
fd.append("ans", _('answer').value);
var ajax = new XMLHttpRequest();ajax.upload.addEventListener("progress", progressHandler, false);ajax.addEventListener("load", completeHandler, false);ajax.addEventListener("error", errorHandler, false);ajax.addEventListener("abort", abortHandler, false);ajax.open('post', "upload.php");ajax.send(fd);
B('#error').innerText = "Time's up";
B('.progress').style.display = "block";
}
function progressHandler(event){
_("loaded_n_total").innerText = "Uploaded "+event.loaded+" bytes of "+event.total;
var percent = (event.loaded / event.total) * 100;
_("progressBar").value = Math.round(percent);
_("status").innerText = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
_("status").innerText = event.target.responseText;
_("progressBar").value = 0;
}
function errorHandler(event){
_("status").innerText="Upload Failed. Do not reload page and click try again";
_("tsub").innerText="Try Again";
window.onbeforeunload = function(){var msg="Try again before you leave as afterwards you might not be able to send test";return msg;};
}
function abortHandler(event){
_("status").innerText="Upload Aborted. Make sure that you are connected with internet network and click try again";
_("tsub").innerText="Try Again";
window.onbeforeunload = function(){var msg="Try again before you leave as afterwards you might not be able to send test";return msg;};
}
function win(){
B('.crucial').style.display = "block";
B('#relax').innerText = "Best Of Luck for your test !";
}
setTimeout(win, millisTill10);
startt = setTimeout(uploadFile, milli);
_('tsub').addEventListener('click', function (){
    var cd = confirm("Are you sure to submit test. You won't be able to resubmit your test.");
    if(cd == true){
    clearTimeout(startt);
    uploadFile();
}});
</script><script src="jquery-3.2.1.min.js"></script><script>
setInterval(function (){$('#time').load('time.php')}, 1000); $(document).ready(function () {$('#answer').bind('paste cut copy', function (e) {e.preventDefault();});});</script>
</body>
</html>