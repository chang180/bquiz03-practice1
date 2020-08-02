<?php
include_once "../base.php";
$ondate = $Movie->find($_GET['id'])['ondate'];
// var_dump($_GET);
// exit;
$today = date("Y-m-d");
for ($i = 0; $i <= 2; $i++) {
    if ($ondate >= $today) {
        // echo "count!!";
        echo "<option value='$ondate'>" . date("m月d日 l", strtotime("$ondate")) . "</option>";
    }
    $ondate = date("Y-m-d", strtotime(" $ondate + 1 day"));
}
