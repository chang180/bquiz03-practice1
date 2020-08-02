<?php
include_once "../base.php";

$name=$_GET['movieName'];
$date=$_GET['date'];
$session=$sess[$_GET['session']];
$seat=[];

$ords=$Ord->all(['movie'=>$name,'date'=>$date,'session'=>$session]);
foreach($ords as $o){
    $seat=array_merge($seat,unserialize($o['seat']));
    // var_dump($o['seat']);
}

for($i=1;$i<=20;$i++){
    if(in_array($i,$seat)) {
        echo "<img src='img/03D03.png'>";
    }
else{
    echo "<img src='img/03D02.png'>";
    echo "<input type='checkbox' name='seat[]' value='".$i."' class='seat'>";
}
if($i%5==0) echo "<br>";
}
