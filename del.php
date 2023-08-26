<?php
include ('db.php');
session_start();
if($_POST['sub']){
    $id=$_SESSION['tid'];
    $date = $_POST['date'];
    mysqli_query($con,"DELETE FROM student where cid='$id' AND cdate='$date'");
    $query="DELETE FROM teacher where tid='$id' AND chdate='$date'";
    mysqli_query($con, "DELETE from marks where mtid='$id' AND mdate='$date'");
}

if(isset($_POST['del'])){
    $tid = $_SESSION['tid'];
    $query = "DELETE from home where tid='$tid'";
    if(isset($_POST['sec'])){
    if(isset($_POST['dat'])){
        if($_POST['dat'] != "Class" && $_POST['sec'] != "sec"){
        $class = $_POST['dat']."-".$_POST['sec'];
        $query .= " AND mclass='$class'";
        }
    }
    }
}
$done = mysqli_query($con,$query);
if($done){
    echo "Your data has been deleted";
}
?>