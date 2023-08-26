<?php
session_start();
if(isset($_SESSION['st'])){
    $erroe = $_SESSION['st'];
}
if(isset($_COOKIE['pass'])){
header('Location:validation.php');
}
?>
  <!DOCTYPE html>
    <html>
    <head profile="pic.jpg">
    <link rel="icon" type="image/jpg" href="pic.jpg">
    <title>Receive online homeworks in tabular form and take online exams with video conferencing for free</title>
    <link rel="stylesheet" type="text/css" href="glook.css" >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script>console.log("from tag");</script>
    </head>
    <body>
        <div class="bind">
     <div class="crucial">
        <div class="int"><div class="intro">PEAKME</div><div class="hi">is a platform for teachers to take exams as well as to send and receive homeworks</div></div>
        
        <div class="askst"><div id="intro"><p id="asking" style="word-spacing:5px;">I am a</p></div><button class="pd">Student</button><button class="pc">Teacher</button><br><br><br><img src="images.png" id="onlineEd"></div>
        </div>
        <div style="display:none;" class="twtd">
  <div class="container" style="display:none;">
    <form action="validation.php" method="post" onsubmit="store()">
        <br>
        <p align="center"><?php if(isset($_SESSION['st'])){echo $_SESSION['st'];unset($_SESSION['st']);}if(isset($_SESSION['alre'])){echo $_SESSION['alre'];unset($_SESSION['alre']);}  ?></p>
        <label>E-mail</label>
        <input type="email" name="mail" class="user" required><br>
        <label>password</label>
        <input type="password" name="password" class="pass" required>
        <div class="afal"><div class="afala"><input type="checkbox" id="mycheck" checked></div>Remember Me</div>
        <button type="submit" class="butt" name="submit">login</button><br><br>
        <a href="forget.php" style="font-size:15px;">Recover password</a><br><br><br>
    </form>
</div><div><button class="pa" style="font-size:18px;"><b>New User</b></button><button class="pb" style="font-size:18px;"> <b>Existing User</b></button></div>
<div class="cona">
    <form id="vform" class="vform" onsubmit="return validate()" name="myform" action="registeration.php" method="post">      
        <label>Full name</label>
        <input type="text" name="user" required class="usera" />
        <span id="name_error" class="vh"></span>
        <br><br>
        <label>e-mail</label>
        <input type="email" name="mail" placeholder='eg : abcd@gmail.com' class="mail" required />
        <br><br>
        <label class="al">Create Password</label>
        <input type="password" name="password" class="passa" required />
        <span id="password_error"></span><br><br>
        <input type="radio" name="identity" value="t" class="mat" style="display:none;" checked>
        <label id="referl">Referal Code : </label><input id="refer" type="tel" style="margin-bottom:20px" placeholder="Optional" name="refer" maxlength="7" class="mail" /><br>
        <button type="submit" class="butta" id="gh" name="submit">submit</button><br><br>
    </form></div><br><br>
</div>
</div>
<script type="text/javascript">
console.log("from tag 2")
let pb = document.querySelector(".pb");
let cona = document.querySelector(".cona");
let pa = document.querySelector(".pa");
let con = document.querySelector(".container");
pb.addEventListener("click", function() {
    cona.style.display = "none";
    con.style.display =  "block";
});
pa.addEventListener("click", function(){
    con.style.display = "none";
    cona.style.display = "block";
});
namee = document.getElementById('name_error');
userne = document.getElementById('username_error');
passe = document.getElementById('password_error');
maile = document.getElementById('email_error');
rad = document.getElementById('rad');
let name = document.querySelector('.usera');
let usern = document.querySelector('.userb');
let pass = document.querySelector('.passa');
let mail = document.querySelector('.mail');
tea = document.myform.identity;
form = document.querySelector('#vform');
var refer = window.location.href.split("=")[1];
var reelem = document.getElementById("refer");
reelem.style.display="none";
document.getElementById("referl").style.display = "none";
if(refer != "" && window.location.href.indexOf("refer") != -1){
reelem.value = refer;
}
function validate(){
if(name.value.length <= 4 || name.value.length > 20){
    namee.innerText = "length should be more than 5";
    return false;
}
if(tea.value=="s" && document.querySelector('#class').value=="Class"){
    alert("Please select class");
    return false;
}
if(tea.value=="s" && document.querySelector('#sec').value=="sec"){
    alert("Please select section");
    return false;
}
localStorage.setItem("p", "Hey");
localStorage.setItem("mail", mail.value);
localStorage.setItem("pass", pass.value);
}
valu=document.querySelector('.user');
valp=document.querySelector('.pass');
function store(){
   if(document.getElementById("mycheck").checked){
        localStorage.setItem("mail", valu.value);
        localStorage.setItem("pass", valp.value);
    }
}
valu.value=localStorage.getItem("mail");
valp.value=localStorage.getItem("pass");
if(localStorage.getItem("p")){document.querySelector(".pb").click();}
document.querySelector(".butt").addEventListener("click",function (){localStorage.setItem("p", "Hey");});
document.querySelector(".pc").onclick = function (){document.querySelector(".askst").style.display="none";document.querySelector(".twtd").style.display="block"}
document.querySelector(".pd").onclick = function (){window.location.href = "shome.php";}
</script>
    <noscript>It seems that you have disabled javascript. Please enable javascript<style type="text/css">
    .crucial{display:none;}</style></noscript>
</body>
</html>