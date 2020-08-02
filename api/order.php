<?php
include_once "../base.php";
$_POST['movie']=$_POST['movieName'];
unset($_POST['movieName']);
$_POST['qt']=count($_POST['seat']);
$_POST['seat']=serialize($_POST['seat']);
$sno=$Ord->q("SELECT MAX(`id`) from `ord` ")[0][0];
$_POST['no']=date("Ymd").sprintf("%04d",$sno);
$_POST['session']=$sess[$_POST['session']];
$Ord->save($_POST);

echo $_POST['no'];
