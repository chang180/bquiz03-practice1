<?php
include_once "../base.php";
$Movie->del($_GET['id']);
to("../admin.php?do=movie");