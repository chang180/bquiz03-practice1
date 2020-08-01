<?php include_once "../base.php";
if ($_GET['acc'] != 'admin' || $_GET['pw'] != '1234') {
    echo "<script>alert('帳號或密碼錯誤');location.href='../admin.php';</script>";
} else {
    $_SESSION['login'] = 1;
    to("../admin.php");
}
