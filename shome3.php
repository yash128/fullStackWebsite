<?php
session_start();
include('db.php');
include('prevent.php');
?>
<!DOCTYPE html>
<html>
    <head profile="pic.jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/jpg" href="pic.jpg">
    <title>Send online HomeWorks in tabular form with ease</title>
    <link rel="stylesheet" type="text/css" href="stylest.css">
    <meta charset="utf-8">
</head>
<body>
    <div id="altsub" style="display:none;">
        <p>You can select images one by one here. </p>
        <?php
            for($z=0;$z<8;$z++){
                echo "<input type='file' id='z$z'><br>";
            }
        ?>
        <button onclick="altsub();">Select</button>
    </div>
    <div class="nav">
        <div class="acc"><img src="pic.jpg" class="pic"></div>
        <div class="wel">Welcome</div>
        <div class="stroke"><div></div><div></div><div></div></div>
    <div class="init">
<span class="spa" style="position:fixed;z-index:2;margin-right:6%;margin-top:0%;">✖</span>
    <a href="check.php" target="_blank">Home Page</a>
    <a href="shome.php" target="_blank">Homework</a>
    <span class="cont" style="background-color:#000;color:#fff;font-weight:100;margin-left:20px;">Contact Us</span>
    </div>
    <div id="clock"><p id="pme">PEAKME</p><p id="time"></p></div>
    <div class="hom">
    <form action="viewhometostd.php" method="post" onsubmit="chec()">
        <input type="text" name="name" placeholder="Name" style="margin-bottom:10px;" id="name"><p id="nlm"></p>
        <select style="margin-left:20px;" name="class" id="class">
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
        </select><br><p id="clm"></p>
        <?php if(!isset($_GET['id'])){ ?>
        <p>Enter id of teacher to which you want to send homework or view homework sent by teacher</p>
        <input type="tel" name="stid" id="id" maxlength="6" required><br><br>
        <?php }else{ ?><input type="hidden" name="stid" value='call()' id="id" maxlength="6" required><?php } ?>
        <div><span id="paratosel">Upload multiple images below or Upload them one by one on </span><span style="color:blue;" onClick="altsef();" class="chtu"><u>click</u></span></div>
        <input type="file" id="file" multiple><br><br>
        <button id="submit" class="aaaa" type="button">Submit</button>
        <button type="submit">View homework</button>
    </form>
    <div class="progress" id="pro">
    <progress id='progressBar' value='0' max='100' style='width:300px;'></progress>
            <h3 id='status'></h3>
            <p id='loaded_n_total'></p></div><br><iframe data-aa="1455260" src="//acceptable.a-ads.com/1455260" scrolling="no" style="border:0px; padding:0; width:250px; height:160px; overflow:hidden;margin:20px;" allowtransparency="true"></iframe></div></div><br><br>
        <script type="text/javascript">
    function _(el){
return document.getElementById(el);
}
document.getElementById("submit").addEventListener("click", check, false);
function nofs(){
_("nofs").innerText=" "+_("file").files.length+" selected";
}
_("file").addEventListener("click", () => alert("Hold to select multiple images at once"))
function altsef(){
    B(".nav").style.display="none";
    B("#altsub").style.display="block";
}
function altsub(){
    B(".nav").style.display="block";
    B("#altsub").style.display="none";
    var c=0;for(var cnofian = 0;cnofian<8;cnofian++){
    if(_("z"+cnofian).value != ""){c++;}}
     _("paratosel").innerText=c+" files selected";
     B(".chtu").innerText=" change";
}
function call(){return window.location.href.split("=")[1];}
function uploadFile() {
var formdata = new FormData();window.scrollBy(0,40);
formdata.append("class", document.querySelector('#class').value);
formdata.append("sec", document.querySelector('#sec').value);
formdata.append("name", _('name').value);
<?php if(isset($_GET['id'])){ ?>
formdata.append("id", window.location.href.split("=")[1]);
<?php }else{ ?>formdata.append("id", _('id').value);
<?php } ?>
for(const file of _('file').files){
formdata.append("file[]", file);
}
for(var z=0;z<8;z++){
    if(_("z"+z).value != ""){
        formdata.append("z"+z,_("z"+z).files[0]);
    }
}
var ajax = new XMLHttpRequest();
ajax.upload.addEventListener("progress", progressHandler, false);
ajax.addEventListener("load", completeHandler, false);
ajax.addEventListener("error", errorHandler, false);
ajax.addEventListener("abort", abortHandler, false);
ajax.open("POST", "homupload.php");
ajax.send(formdata);
_('pro').style.display = "block";
}
function progressHandler(event){
_("loaded_n_total").innerText = "Uploaded "+event.loaded*0.000001+" MB of "+event.total*0.000001;
var percent = ((event.loaded*0.000001) / (event.total*0.000001)) * 100;
_("progressBar").value = Math.round(percent);
_("status").innerText = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
_("status").innerText = event.target.responseText;
_("progressBar").value = 0;
}
function errorHandler(event){
_("status").innerText = "Upload Failed";
}
function abortHandler(event){
_("status").innerText = "Upload Aborted";
}
function check(){
    <?php if(!isset($_GET['id'])){ ?>
    if(_('id').value==""){
        alert("Please enter id of teacher");
    }
    else<?php } ?> if(document.querySelector('#class').value=="Class"){
        _("clm").innerText = "Select class and section";_("clm").style.color="red"
    }
    else if(document.querySelector('#sec').value=="sec"){
        _("clm").innerText = "select class and section";_("clm").style.color="red"
    }
    else if(_("z0").value == "" && _("z1").value == "" && _("z2").value == "" && _("z3").value == "" && _("z4").value == "" && _("z5").value == "" && _("z6").value == "" && _("z7").value == "" && _("file").value == ""){
        alert("Select images");
    }
    else if(_("name").value.trim() == ""){
        _("nlm").innerText = "Enter your name";_("nlm").style.color="red"
    }
    else{
        uploadFile();
    }
}
</script>
</div>
</div>
<script>
function B(id){
return document.querySelector(id);
}
B('.stroke').addEventListener('click', ()=>{B('.init').style.display = 'block';B('.init').style.zIndex = '1';});
B('.spa').addEventListener('click', ()=>{B('.init').style.display = 'none';});
B('.cont').addEventListener('click', ()=>{alert('Whatsapp: 9478642832\nMail: peakme@peakme.in');});
</script>
</body>
</html>