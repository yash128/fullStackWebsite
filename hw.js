function _(id){
        return document.getElementById(id);
}
function B(id){
        return document.querySelector(id);
}
function loadDoc(clicked_i) {
    ido = clicked_i;
    inpv = _(ido);
    fv = ido.replace("d","c");
    filv = _(fv).href;
    filv = filv.split("=");
    let fd = new FormData();
    fd.append("some",inpv.value);
    fd.append("fil", filv[1]);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            pid = ido.replace("d","e");
            _(pid).innerHTML = this.responseText;
       }
    };
    xhttp.open("POST", "checked.php", true);
    xhttp.send(fd);
}
function chhw(clicked){
    ido = clicked;
    var z = confirm("Are you sure to send"+" "+_(ido).files.length+" "+"files");
    if (z == true) {
    if(_(ido).value==""){
        alert("Please select checked h.w.");
    }else{
    fv = ido.replace("f","c");
    filv = _(fv).href;
    filv = filv.split("=");
    let fd = new FormData();
    for(const checkedhw of _(ido).files){
    fd.append("file[]",checkedhw);
    }
    fd.append("fil", filv[1]);
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 2 && this.status == 200)
        if(this.readyState == 0 && this.status == 200)
        if(this.readyState == 1 && this.status == 200)
        if(this.readyState == 3){console.log(this.readyState);}
        if (this.readyState == 4 && this.status == 200){
            alert(this.responseText);
       }
    };
    xhttp.open("POST", "checkedhw.php", true);
    xhttp.send(fd);
}
}
}
function uploadFile(clicked) {
ido = clicked;
fv = ido.replace("f","c");
filv = _(fv).href;
filv = filv.split("=");
var z = confirm("Are you sure to send"+" "+_(ido).files.length+" "+"files");
    if (z == true) {
    if(_(ido).value==""){
        alert("Please select files for checked h.w.");
    }else{
fd = new FormData();
    for(const checkedhw of _(ido).files){
    fd.append("file[]",checkedhw);
    }
fd.append("fil", filv[1]);
var ajax = new XMLHttpRequest();
ajax.upload.addEventListener("progress", progressHandler, false);
ajax.addEventListener("load", completeHandler, false);
ajax.addEventListener("error", errorHandler, false);
ajax.addEventListener("abort", abortHandler, false);
ajax.open('post', "checkedhw.php", true);
ajax.send(fd);
B('.box').style.display = "block";
B('.box').style.zIndex = "1";
B('.nav').style.display = "none";
B("body").style.cssText = "display:flex;justify-content:center;align-items:center;min-height:100vh;background-color:#03a9f4;";        
}}
}
function progressHandler(event){
B(".text").innerText = "Progress";
var percent = (event.loaded / event.total) * 100;
B(".numper").innerText = Math.round(percent);
circleper = 440 - (440*percent) / 100;
_("mainpercent").style.strokeDashoffset = circleper;
}
function completeHandler(event){
B(".text").innerText = event.target.responseText;
B('.box').style.display = "none";
B('.nav').style.display = "block";
B("body").style.cssText = "";
window.location.reload(true);
}
function errorHandler(event){
B(".text").innerText = "Upload Failed";
}
function abortHandler(event){
B(".text").innerText = "Upload Aborted";
}
function trigger(click){
    ipd = click;
    ipdo = ipd.replace("g","f");
    _(ipdo).click();
}