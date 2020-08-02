<?php
include_once "../base.php";
$ondate = $Movie->find($_GET['id'])['ondate'];
$moviename=$Movie->find($_GET['id'])['name'];
$today = date("Y-m-d");
$orderday=date("Y-m-d",strtotime($_GET['date']));
// var_dump($_GET);


$nowhour=date('H');
$nowsess=(($nowhour-14)>0)?floor(($nowhour-14)/2):0;


foreach($sess as $key=> $s){
    $qt[]=20-$Ord->q("SELECT SUM(qt) FROM ord WHERE movie='$moviename' && date='$orderday' && session='$sess[$key]' ")[0][0];
}

for ($i = 0; $i <= 4; $i++) {
    if($i>=$nowsess){
        echo "<option value='$qt[$i]'>" . $sess[$i]. "剩餘座位 ".$qt[$i]."</option>";
    }
}
