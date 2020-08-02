<?php
include_once "../base.php";
switch ($_POST['mode']){
case "1":
    $Ord->del(['date'=>$_POST['date']]);
break;
case "2":
    $Ord->del(['movie'=>$_POST['movie']]);
break;
}

to("../admin.php?do=order");