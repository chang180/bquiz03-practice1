<?php
include_once "../base.php";
if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/".$_FILES['img']['name']);
    $row['path']=$_FILES['img']['name'];
}
$row['sh']=1;
$row['rank']=$Poster->all([]," ORDER BY rank DESC")[0]['rank']+1;
// var_dump($row['rank']);
$row['name']=$_POST['name'];
$Poster->save($row);
to("../admin.php?do=poster");