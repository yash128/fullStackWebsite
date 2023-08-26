<?php
session_start();
session_destroy();
setcookie('mail',"",time()-(60*60*24*60));
setcookie('pass',"",time()-(60*60*24*60));
header('location:index.php')
?>
