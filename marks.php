<?php
session_start();
include('db.php');
if(isset($_GET['student'])){
    if(isset($_GET['marks'])){
        $id = $_SESSION['tid'];
        $marks=$_GET['marks'];
        $to = $_GET['student'];
        $uid = $_GET['stu'];
        $date = $_GET['date'];
        $data = mysqli_fetch_array(mysqli_query($con, "SELECT * from step where id='$to'"));
        $msid = $data[0];
        $msname = $data[1];
        $mquery = mysqli_query($con, "INSERT into marks(mtid,mid,mname,mmarks,mdate,uid) VALUES('$id','$msid', '$msname','$marks','$date','$uid')");
        if($mquery){
            echo 'Sent';
        }else{
            echo "An invalid error occurred";
        }
    }
    else{
        header('Location:Teacher.php');
    }
}
else{
    header('Location:Teacher.php');
}
?>