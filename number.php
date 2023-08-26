<?php

$f = scandir("home/");
$n=0;
foreach($f as $a){
    $n++;
}
echo $n;
?>