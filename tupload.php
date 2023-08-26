<?php

include ('db.php');
include ('prevent.php');
if(isset($_POST['idot'])){
    $teaid = e(mysqli_real_escape_string($con, $_POST['idot']));
    $text = $_POST['giveho'];$msga = e(mysqli_real_escape_string($con,$_POST['msga']));
    $text = e(mysqli_real_escape_string($con, "$text"));
    $str = "";
    $a=0;
    date_default_timezone_set("Asia/Kolkata");
    if($_POST["givefho"][0] != ""){
        foreach($_POST["givefho"] as $key => $img){
        	$img = str_replace('data:image/png;base64,', '', $img);
        	$img = str_replace(' ', '+', $img);
        	$data = base64_decode($img);
        	$im = imageCreateFromString($data);
        	if($im){
            	$name = 'give'.$a.date("mjYHis").".png";
            	$img_file = "home/$name";
            	imagepng($im, $img_file, 0);
            	$str .= "$name".",";
        	}
            $a=$a+1;
        }
    }
    if(isset($_FILES["file"])){
        $c = count($_FILES["file"]["name"]);
        for($b = 0;$b<$c;$b++){
            $fn = $_FILES['file']['name'][$b];
            $ft = $_FILES["file"]["tmp_name"][$b];
            $filetype = pathinfo($fn, PATHINFO_EXTENSION);$a=$a+1;
            $fn="mov".$a.date("mjYHis")."."."$filetype";
            move_uploaded_file($ft, "home/$fn");
            $str .= "$fn".",";
        }
    }
    $date = date("Y-m-j");
    $query = mysqli_query($con, "INSERT into ghome(ghid, ghfile, ghtext, date,msg) VALUES('$teaid', '$str', '$text', '$date','$msga')");
    if($query){
        echo "Homework given";
    }else{
        echo "Error while giving homework";
    }
}




?>