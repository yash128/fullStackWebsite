<?php
session_start();
include('db.php');
include('prevent.php');
if(!isset($_SESSION['tid'])){
    header('location:check.php');
}
$teaid = $_SESSION['tid'];
?>
<!DOCTYPE html>
<html>
    <head profile="pic.jpg">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/jpg" href="pic.jpg">
    <title>Send and receive HomeWorks in tabular form with peakme for free</title>
    <link rel="stylesheet" type="text/css" href="stylest.css">
    <meta charset="utf-8">
</head>
<body>
    <div id="altsub" style="display:none;">
        <p>You can select images one by one here. </p>
        <?php
            for($z=0;$z<8;$z++){
                echo "<input type='file' id='z$z' onclick='nooalfsel(this.id)'><br>";
            }
        ?>
        <button onclick="altsub();">Select</button>
    </div>
    <div class="nav">
        <div class="acc"><img src="pic1.png" class="pic"></div>
        <div class="bat">
<form method="post" action="new.php">
            <p><?php if(isset($_SESSION['namem'])){echo $_SESSION['namem'];} ?> <u class='n'>rename</u> <span class="spb">x</span></p>
<input type='text' name='name' class="inp" placeholder="name">
<p class="name"><?php if(isset($_SESSION['mail'])){echo $_SESSION['mail'];} ?> <u class='c'>change</u></p>
<input type='email' name='mail' class="in" placeholder="Mail">
<p class="id">ID: <?php echo $teaid; ?></p>
<!--<p class="refer" style="cursor:pointer;color:#fff;"><a href="refer.php">Refer and earn</a>              <?php /*if($points!=0){echo $points*5;}*/  ?> <img src="dollor.png" style="border-radius:50px;" width="20px" height="20px" /></p>-->
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
    <div id="clock"><p id="pme">PEAKME</p><p id="time">Help</p></div>
    <div class="hom">
<p><a href="view.php">Click</a> to view homework sent by students</p>
    <p>You can upload file of homework and type class for which the homework is. Student has to enter<b> your id</b> <b><?php echo $teaid; ?></b> while sending homework or has to click <span style="color:blue;text-decoration:underline" id='unlwi'>https://peakme.in/shome.php?id=<?php echo $teaid ?></span> link</p>
    <form id="mainForm" enctype="multipart/form-data">
        <label for="giveho">For Class</label>
        <input name='giveho' id="giveho" type='text' placeholder="eg - ninth A" required><br><br>
        <div id="selimg">Select Images<div id="hidden">Add</div><span id="ftlits"></span></div>
        <input type="file" id="file" style="display:none;" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" onchange="premimg()" multiple><br>
        <div id="sosop" class="selvid">Select Videos<span id="hidden2" style="display:none;"></span></div>
        <input type="file" id="file2" style="display:none;" accept="video/*" multiple><br>
        <textarea id="amsgfst" placeholder="Any message for student. eg: Links/text" name='msga' rows='7' columns='7' style='font-size:13px'></textarea><br><br>
        <div><input type="submit" name="giveh" id="giveh" value='Give Homework'><div id='loados'><img src='load.gif'></div></div>
    </form><br>
    <div class="progress" id="pro">
    <progress id='progressBar' value='0' max='100' style='width:300px;'></progress>
            <h3 id='status'></h3>
            <p id='loaded_n_total'></p>
            </div>
    <div id="imgpre">

    </div>
    <div id="vidpre">
        
    </div>
    </div></div><br><br>
    </div>
    </div>
<script src="easy.js"></script><script>document.getElementById("unlwi").addEventListener("click",function(){var consend = confirm("Share link on whatsapp");if(consend){var whatlink="whatsapp://send?text=Click on given link to send your homeworks %0A "+document.getElementById("unlwi").innerText;window.open(whatlink, '_blank');}
});var idenwp = "<?php if(isset($_SESSION['identi'])){echo $_SESSION['identi'];} ?>";if(idenwp=='s'){window.location.href='https://peakme.in/shome.php';}
function bothFilled(e){
    e.preventDefault();
    if(_("imgpre").children.length == 0 && document.getElementById("amsgfst").value == ""){
        alert("Provide any text or image");
        return false;
    }
    else if(_("imgpre").children.length!=kwoi){
        _("loados").style.display="block";
        var systouf = setInterval(function(){if(_("imgpre").children.length==kwoi){clearInterval(systouf);bothFilled();}},2000);
    }else{
        uploadFile();
    }
}
function _(id){
    return document.getElementById(id);
}
var artosi = new Array();
function cancel2(abcd){
    document.querySelector(("#vidpre [id='"+abcd + "']")).parentNode.remove();
    var eloi = document.querySelectorAll("#vidpre div");
    for(var t=0;t<eloi.length;t++){eloi[t].children[1].id=t}
    artosi.splice(parseInt(abcd),1);
    console.log(artosi)
    _("hidden2").innerText = (_("vidpre").children.length) + " video selected";
}
_("file2").onchange = function (){
    _("hidden2").style.display = "block";
    var f = _("file2");
    for(var i =0;i<f.files.length;i++){
        var viddiv = document.createElement("div");
        var cimg = document.createElement("img");cimg.src="cancel.svg";
        cimg.id = _("vidpre").children.length;cimg.setAttribute("onclick","cancel2(this.id)");
        var vid = document.createElement("video");
        vid.src = URL.createObjectURL(f.files[i]);
        viddiv.style.cssText="position:relative;width:800px;";
        vid.controls = true;
        cimg.style.cssText="position:absolute;top:0;width:50px;height:30px;";
        viddiv.append(vid);viddiv.append(cimg);
        artosi.push(f.files[i]);
        console.log(f.files[i])
        _("vidpre").append(viddiv);
        _("hidden2").innerText = (_("vidpre").children.length) + " video selected";
    }
}
document.querySelector(".selvid").addEventListener("click",function (){
    _("file2").click();
    
});
_("hidden").style.display="none";
function uploadFile() {
var eloi = document.querySelectorAll("#imgpre div");
for(var t=0;t<eloi.length;t++){eloi[t].children[1].removeAttribute("onclick");}
var formdata = new FormData();window.scrollBy(0,40);
formdata.append("giveho", document.querySelector('#giveho').value);
formdata.append("msga", document.querySelector('#amsgfst').value);
formdata.append("idot", "<?php        echo "$teaid";      ?>");
for(var t=0;t<eloi.length;t++){formdata.append("givefho[]", eloi[t].children[0].src);}
for(var c = 0;c<artosi.length;c++){formdata.append("file[]",artosi[c]);}
var ajax = new XMLHttpRequest();
ajax.upload.addEventListener("progress", progressHandler, false);
ajax.addEventListener("load", completeHandler, false);
ajax.addEventListener("error", errorHandler, false);
ajax.addEventListener("abort", abortHandler, false);
ajax.open("POST", "tupload.php");
ajax.send(formdata);
_("pro").style.display = "block";
}
function progressHandler(event){
var percent = ((event.loaded*0.000001) / (event.total*0.000001)) * 100;
_("progressBar").value = Math.round(percent);
_("status").innerText = Math.round(percent)+"% uploaded... please wait";
}
function completeHandler(event){
_("status").innerText = event.target.responseText;
_("progressBar").value = 0;_("loados").style.display="none";
}
function errorHandler(event){
_("status").innerText = "Upload Failed";_("loados").style.display="none";
}
function abortHandler(event){
_("status").innerText = "Upload Aborted";_("loados").style.display="none";
}
_("mainForm").addEventListener("submit",bothFilled);

    
    var kwoi = 0;
    function fdsg(){_("file").click();_("hidden").style.display="block";window.scrollBy(0,90);}
function wnib(){_("ftlits").innerText=document.querySelectorAll("#imgpre div").length+" images selected";}   
function cancel(idtc){
    _(idtc).parentNode.remove();kwoi--;
    var eloi = document.querySelectorAll("#imgpre div");wnib();
    for(var t=0;t<eloi.length;t++){eloi[t].children[0].id=t;eloi[t].children[1].id=t}
}
_("selimg").addEventListener("click",fdsg);
function premimg(){
    for(let i of _("file").files){
        if(i.name.includes(".jpg") || i.name.includes(".jpeg") || i.name.includes(".png") || i.name.includes(".JPG") || i.name.includes(".JPEG") || i.name.includes(".PNG")){
        kwoi++;
        const reader = new FileReader();
        reader.readAsDataURL(i);
        reader.onload = function (evn){
            const trial = document.createElement("img");
            trial.src=evn.target.result;
            trial.onload = function (e){
                const nuof = _("imgpre").children.length;
                const img = document.createElement("img");const divtpi = document.createElement("div");img.id=nuof;divtpi.style.cssText="position:relative;width:800px;";
                const imgtc = document.createElement("img");imgtc.src='cancel.svg';imgtc.id=nuof;imgtc.style.cssText="position:absolute;top:0;width:50px;height:30px;";imgtc.setAttribute("onclick","cancel(this.id)");
                const canvas = document.createElement("canvas");
                const ctx = canvas.getContext("2d");
                if(e.target.width>800){width = 800;}else{width = e.target.width;}
                const scalesize = width/e.target.width;
                const height = e.target.height * scalesize;canvas.width=width;canvas.height=height;
                ctx.drawImage(e.target,0,0,canvas.width,canvas.height);
                const srcEncode = ctx.canvas.toDataURL(e.target);
                img.src=srcEncode;
                divtpi.appendChild(img);divtpi.appendChild(imgtc);
                _("imgpre").appendChild(divtpi);
                wnib();
            }
        }}
    }
}
document.getElementById('time').addEventListener('click', ()=>{alert('Contact us: 9478642832\nWhatsapp: 9478642832\nMail: peakme@peakme.in');});
</script>
</body>
</html>