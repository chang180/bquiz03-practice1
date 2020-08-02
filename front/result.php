<?php 
$row=$Ord->find(['no'=>$_GET['no']]); 
?>
感謝您的訂購，您的訂單編號是：<?=$_GET['no'];?><br>
電影名稱：<?=$row['movie'];?><br>
日期：<?=$row['date'];?><br>
場次時間：<?=$row['session'];?><br>
座位：<br>
<?php
$seat=unserialize($row['seat']);
// var_dump($seat);
foreach($seat as $s){
echo (ceil($s/5))."排".((($s-1)%5)+1)."號"."<br>";
}
?>
<button onclick="location.href='?do=main'">確認</button>