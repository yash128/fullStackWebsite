<?php
session_start();
if(!isset($_SESSION['pass'])){
    header("Location:teacher.php");
}
$tid = $_SESSION['tid'];
include("db.php");
?>
<!DOCTYPE html>
<html>
<head profile="pic.jpg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <link rel="icon" type="image/jpg" href="pic.jpg">
    <title>Keep watch on class while giving online exams</title>
</head>
<body>
    <div></div>
  	<script src="simplepeer.min.js"></script>
	<script type="text/javascript">
    client = {};
    num=[];
function _(id){return document.getElementById(id);}
let constraintObj = {audio: true,video:{facingMode: "user",width: { min: 640},height: { min: 480}}};
function get(){
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var x = JSON.parse(this.responseText);
            if(x[0]!='h'){
            const peer = new SimplePeer({initiator: false,trickle:false});
            client[x[0]] = peer;
            num.push(x[0]);
            client[x[0]].signal(x[1]);
            client[x[0]].on("signal", data => {
                var fd = new FormData();
                fd.append("a", JSON.stringify(data));
                fd.append("b", x[0]);
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", "send.php", true);
                xmlhttp.send(fd);
            })
            client[x[0]].on('stream', stream => {
            var video = document.createElement('video');
            video.setAttribute("controls","true");video.setAttribute("autoplay","true");
            video.setAttribute("id","a"+x[0]);
            video.width="400";video.height="300";
            if ('srcObject' in video) {
              video.srcObject = stream
            } else {
              video.src = window.URL.createObjectURL(stream) // for older browsers
            }
            document.querySelector("div").appendChild(video);
            })
        }
        }
    };
    xml.open("POST", "connect.php", true);
    xml.send();
    }setInterval(get,1000);
    </script>
</body>
</html>