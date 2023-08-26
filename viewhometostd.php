<html>
    <head>
        <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        
    


<?php
include('db.php');
if($_GET['stid']){
    $id = $_GET['stid'];
    echo "<table><tr><th>Class</th><th>Files</th><th>Date</th><th>Message</th></tr>";
    $sd = mysqli_query($con, "SELECT * from ghome where ghid='$id' order by date desc");
    if($sd){
    while($id = mysqli_fetch_array($sd)){   
        if($id[1]!=""){
    echo "<tr><td>$id[2]</td><td><a href='viewtwo.php?som=$id[1]'>Attached file</a></td><td>$id[3]</td><td>$id[4]</td></tr>";}else{
    echo "<tr><td>$id[2]</td><td></td><td>$id[3]</td><td>$id[4]</td></tr>";
    }
    }
}else{echo "An error occurred";}
echo "</table>";
}else{
    header("Location:shome.php");
}
?>

</body>
</html>