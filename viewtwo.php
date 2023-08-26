<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

<?php
if(isset($_GET['some'])){
   $id = $_GET['some'];
   $b = explode(".", $id);
$c=0;
foreach ($b as $key => $value) {
    $c = $c+1;
}
if($c=='2'){
    $d = strrpos("$id", ",");
    if($d){$goodUrl = str_replace(',', '', $id);
    ?>
<script type="text/javascript">
window.location.href = 'https://peakme.in/videos/<?php echo $goodUrl; ?>';
</script>
<?php
    }
    ?>
<script type="text/javascript">
window.location.href = 'https://peakme.in/videos/<?php echo $id; ?>';
</script>
<?php
}else{
    echo "<p>Files like images, videos, pdfs etc. will be shown here and documents will be automatically downloaded</p><p>Blank box represents that the file is downloaded</p>";
   $id = explode(",",$id);
   foreach($id as $a){
       if($a == ""){break;}
   echo "<iframe src='videos/$a' width='100%' height='500'>Your browser does not support iframes. Plz use another browser. For example: Chrome, Firefox etc.</iframe>";
   }
}}
elseif(isset($_GET['som'])){
$is = $_GET['som'];
$b = explode(".", $is);
$c=0;
echo "<input type='checkbox' id='swd' style='display:none;'>";
}
elseif(isset($_GET['checkedhw'])){
$che = $_GET['checkedhw'];
echo "<p>Files like images, videos, pdfs etc. will be shown here and documents will be automatically downloaded</p><p>Blank box represents that the file is downloaded</p>";
   $che = explode(",",$che);
   foreach($che as $a){
       if($a == ""){break;}
   echo "<iframe src='chhw/$a' width='100%' height='500'>Your browser does not support iframes. Plz use another browser. For example: Chrome, Firefox etc.</iframe>";}
}
else{
    header("Location:check.php");
}
?>
<script>
function char_count(str, letter){
var letter_Count = 0;
for (var position = 0; position < str.length; position++) {
if (str.charAt(position) == letter) {
letter_Count += 1;
}
}
return letter_Count;
}
var x = document.getElementById("swd");
if(typeof(x) != 'undefined' && x != null){
if(window.location.href.search("pdf")!=-1){
    x.checked = true;
}
var num = char_count(window.location.href,".");
if(num==3){
var loc = window.location.href.split("=")[1].replace(",", "");
window.location.href = "https://peakme.in/home/"+loc;
}
    var array = window.location.href.split("=")[1];
    array = array.split(",");
    var len = array.length;
    for(const i of array){
        
        if(i != ""){
            var ext = i.split('.').pop();
            var rext = ['jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF'];
            var iinc = rext.lastIndexOf(ext);
            if(iinc != -1){
            var elem = document.createElement("img");
            elem.src="https://peakme.in/home/"+i;
            elem.style.marginBottom = "10px";
            document.querySelector("body").appendChild(elem);
            document.querySelector("body").appendChild(document.createElement("br"));
        }else{
            var elem = document.createElement("iframe");
            elem.src="https://peakme.in/home/"+i;
            document.querySelector("body").appendChild(elem);
            document.querySelector("body").appendChild(document.createElement("br"));
        }
        }
    }
    }
</script>




    </body>
</html>