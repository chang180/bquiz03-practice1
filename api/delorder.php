<?php
include_once "../base.php";
$Ord->del(['no'=>$_GET['no']]);
to("../admin.php?do=order");