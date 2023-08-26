<?php
session_start();
if(isset($_SESSION['afile'])){
$file = $_SESSION['afile'];
$b = explode(".", $file);
$c=0;
foreach ($b as $key => $value) {
    $c = $c+1;
}
if($c == 2){
    $d = strrpos("$file", ",");
    if($d){$goodUrl = str_replace(',', '', $file);
    ?>
<script type="text/javascript">
window.location.href = 'https://peakme.in/videos/<?php echo $goodUrl; ?>';
</script>
<?php
    }
    ?>
<script type="text/javascript">
window.location.href = 'https://peakme.in/videos/<?php echo $file; ?>';
</script>
<?php
}
$file = explode(",",$file);
echo "<p>Files like images, videos, pdfs etc. will be shown here and documents will be automatically downloaded</p><p>Blank box represents that the file is downloaded</p>";
foreach($file as $f){
    if($f != ""){
    echo "<iframe src='videos/$f' width='100%' height='500'>Your browser does not support iframes</iframe>";
}}}else{
    header("Location:student.php");
}
?>