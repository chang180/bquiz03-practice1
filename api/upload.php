<?php
include_once "../base.php";
if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
    $row['name']=$_FILES['img']['name'];
}
$row['sh']=1;
$row['rank']=1;
$Poster->save($row);
to("../admin.php?do=poster");