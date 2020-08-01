<?php
include_once "../base.php";
$_POST['ondate']=$_POST['year']."_".$_POST['month']."_".$_POST['day'];
unset($_POST['year'],$_POST['month'],$_POST['day']);
$_POST['rank']=1;
$_POST['sh']=1;
$_POST['poster']=$_FILES['poster']['name'];
$_POST['trailer']=$_FILES['trailer']['name'];
// var_dump($_POST);
$Movie->save($_POST);

move_uploaded_file($_FILES['poster']['tmp_name'],"../img/".$_FILES['poster']['name']);
move_uploaded_file($_FILES['trailer']['tmp_name'],"../img/".$_FILES['trailer']['name']);

to("../admin.php?do=movie");