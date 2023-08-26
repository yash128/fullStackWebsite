<?php
session_start();
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
    <div id="clock"><p id="pme">PEAKME</p><p id="time">Help</p></div>
    <div class="hom">
    <form action="viewhometostd.php" method="get" onsubmit="chec()">
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
        <?php }else{ ?><input type="hidden" name="stid" value='<?php echo $_GET["id"];  ?>' id="id" maxlength="6" required><?php } ?>
        <div id="selimg">Select Images<div id="hidden">Add</div><span id="ftlits"></span></div><br>
        <div onclick="fdsgq();" id='sosop' style='display:none;'>Select PDF <span id="hidden2"></span></div>
        <input type="file" id="file" style="display:none;" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.PNG" onchange="premimg()" multiple><input type="file" id="file2" accept=".pdf,.PDF" style="display:none;" onchange="pdtd();" multiple>
        <div style="position:relative;"><button id="submit" class="aaaa" type="button">Submit</button><div id='loados'><img src='load.gif'></div><button type="submit" style="margin-left:20px;">View homework</button></div>
        
        <img id="trial">
    </form>
    <div class="progress" id="pro">
    <progress id='progressBar' value='0' max='100' style='width:300px;'></progress>
            <h3 id='status'></h3>
            <p id='loaded_n_total'></p></div><br><div id="imgpre"></div><br><iframe data-aa="1455260" src="//acceptable.a-ads.com/1455260" scrolling="no" style="border:0px; padding:0; width:250px; height:160px; overflow:hidden;margin:20px;" allowtransparency="true"></iframe></div></div><br><br>
            
        <script type="text/javascript">
    function _(el){
return document.getElementById(el);
}
function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
if(getCookie("ssec")!='') document.querySelector('#sec').value = getCookie("ssec");
if(getCookie("sclass")!="") document.querySelector('#class').value = getCookie("sclass");
_('name').value = getCookie("sname");
var kwoi = 0;
var width;
var artosi = new Array();
function premimg(){
    for(let i of _("file").files){
        if(i.name.includes(".jpg") || i.name.includes(".jpeg") || i.name.includes(".png") || i.name.includes(".JPG") || i.name.includes(".JPEG") || i.name.includes(".PNG")){
        kwoi++;const reader = new FileReader();
        reader.readAsDataURL(i);
        reader.onload = function (evn){
            const trial = document.createElement("img");
            trial.src=evn.target.result;
            trial.onload = function (e){
                const nuof = _("imgpre").children.length;
                const img = document.createElement("img");const divtpi = document.createElement("div");img.id=nuof;divtpi.style.cssText="position:relative;width:400px;cursor:move;";divtpi.setAttribute("draggable","true");divtpi.setAttribute("Class","draggable");divtpi.addEventListener("dragstart",() => {divtpi.classList.add("dragging");});divtpi.addEventListener("dragend", () => {divtpi.classList.remove("dragging");});
                const imgtc = document.createElement("img");imgtc.src='cancel.svg';imgtc.id=nuof;imgtc.style.cssText="position:absolute;top:0;width:50px;height:30px;";imgtc.setAttribute("onclick","cancel(this.id)");
                const canvas = document.createElement("canvas");
                const ctx = canvas.getContext("2d");
                if(e.target.width>400){width = 400;}else{width = e.target.width;}
                const scalesize = width/e.target.width;
                const height = e.target.height * scalesize;canvas.width=width;canvas.height=height;
                ctx.drawImage(e.target,0,0,canvas.width,canvas.height);
                const srcEncode = ctx.canvas.toDataURL(e.target);
                img.src=srcEncode;
                divtpi.appendChild(img);divtpi.appendChild(imgtc);
                _("imgpre").appendChild(divtpi);
                artosi.push(srcEncode);wnib();
            }
        }}
    }
}
function wnib(){_("ftlits").innerText=document.querySelectorAll("#imgpre div").length+" images selected";}
function pdtd(){
    const numop = _("file2").files;_("hidden2").style.display="block";var a = 0;
    for(const ate of numop){if(ate.name.includes(".pdf") || ate.name.includes(".PDF")){a++;}}
    _("hidden2").innerText=a+" pdf selected";
}
_("imgpre").addEventListener('dragover', e => {
e.preventDefault()
if(e.clientY<screen.height/4){window.scrollBy(0,-1);}else{window.scrollBy(0,2);}
const afterElement = getDragAfterElement(_("imgpre"), e.clientY)
const draggable = document.querySelector('.dragging')
if (afterElement == null) {
    _("imgpre").appendChild(draggable)
} else {
    _("imgpre").insertBefore(draggable, afterElement)
}
})
function getDragAfterElement(container, y) {
  const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')]

  return draggableElements.reduce((closest, child) => {
    const box = child.getBoundingClientRect()
    const offset = y - box.top - box.height / 2
    if (offset < 0 && offset > closest.offset) {
      return { offset: offset, element: child }
    } else {
      return closest
    }
  }, { offset: Number.NEGATIVE_INFINITY }).element
}
function cancel(idtc){
    _(idtc).parentNode.remove();kwoi--;
    var eloi = document.querySelectorAll("#imgpre div");wnib();
    for(var t=0;t<eloi.length;t++){eloi[t].children[0].id=t;eloi[t].children[1].id=t}
}
_("hidden").style.display="none";function fdsg(){_("file").click();_("hidden").style.display="block";window.scrollBy(0,90);}
function fdsgq(){_("file2").click();window.scrollBy(0,90);}
_("selimg").addEventListener("click",fdsg);
document.getElementById("submit").addEventListener("click", check, false);
function uploadFile() {
var eloi = document.querySelectorAll("#imgpre div");
for(var t=0;t<eloi.length;t++){eloi[t].children[1].removeAttribute("onclick");eloi[t].removeAttribute("draggable");}
var formdata = new FormData();window.scrollBy(0,40);
formdata.append("class", document.querySelector('#class').value);
formdata.append("sec", document.querySelector('#sec').value);
formdata.append("name", _('name').value);
setCookie("sname",_('name').value,20)
setCookie("ssec",document.querySelector('#sec').value,20)
setCookie("sclass",document.querySelector('#class').value,20)
<?php if(isset($_GET['id'])){ ?>
formdata.append("id", window.location.href.split("=")[1]);
<?php }else{ ?>formdata.append("id", _('id').value);
<?php } ?>
for(var t=0;t<eloi.length;t++){formdata.append("file[]", eloi[t].children[0].src);}
for(const t of _("file2").files){if(t.name.includes(".pdf") || t.name.includes(".PDF")){formdata.append("file2[]", t);}}
var ajax = new XMLHttpRequest();
ajax.upload.addEventListener("progress", progressHandler, false);
ajax.addEventListener("load", completeHandler, false);
ajax.addEventListener("error", errorHandler, false);
ajax.addEventListener("abort", abortHandler, false);
ajax.open("POST", "homupload2.php");
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
_("progressBar").value = 0;_("loados").style.display="none";
}
function errorHandler(event){
_("status").innerText = "Upload Failed";_("loados").style.display="none";
}
function abortHandler(event){
_("status").innerText = "Upload Aborted";_("loados").style.display="none";
}
function check(){
    <?php if(!isset($_GET['id'])){ ?>
    if(_('id').value==""){
        alert("Please enter id of teacher");
    }
    else<?php } ?> if(document.querySelector('#class').value=="Class" || document.querySelector('#sec').value=="sec"){
        _("clm").innerText = "Select class and section";_("clm").style.color="red"
    }
    else if(_("imgpre").children.length == 0 && _("file2").value==""){
        alert("Select images");
    }
    else if(_("name").value.trim() == ""){
        _("nlm").innerText = "Enter your name";_("nlm").style.color="red"
    }
    else if(_("imgpre").children.length!=kwoi){
        _("loados").style.display="block";
        var systouf = setInterval(function(){if(_("imgpre").children.length==kwoi){clearInterval(systouf);check();}},2000);
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
B('#time').addEventListener('click', ()=>{alert('Whatsapp: 9478642832\nMail: peakme@peakme.in');});
</script>
</body>
</html>