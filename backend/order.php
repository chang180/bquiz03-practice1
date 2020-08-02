<div class="ct">訂單管理</div>
<form action="api/fastdel.php" method="post" onsubmit="return confirm('幹你確定？')">
    快速刪除：<input type="radio" name="mode" value="1">依日期<input type="text" name="date" id="date">
    <input type="radio" name="mode" value="2">依電影：
    <select name="movie">
        <?php
        $rows = $Ord->all([], " GROUP BY movie ");
        foreach ($rows as $row) {
            echo "<option>" . $row['movie'] . "</option>";
        }
        ?>
    </select>
    <button>刪除</button>
</form>
<table rules="rows">
    <tr>
        <td>訂單編號</td>
        <td>電影名稱</td>
        <td>日期</td>
        <td>場次時間</td>
        <td>訂購數量</td>
        <td>訂購位置</td>
        <td>刪除</td>
    </tr>
    <?php
$rows=$Ord->all([]," ORDER BY no DESC");
foreach($rows as $row){
    $seat=unserialize($row['seat']);
    ?>
    <tr>
        <td><?=$row['no'];?></td>
        <td><?=$row['movie'];?></td>
        <td><?=$row['date'];?></td>
        <td><?=$row['session'];?></td>
        <td><?=$row['qt'];?></td>
        <td><?php
           foreach($seat as $s) {
               echo ceil($s%5)."排".((($s-1)%5)+1)."號<br>";
           }
    ?></td>
        <td>
<a href="api/delorder.php?no=<?=$row['no'];?>">刪除</a>
        </td>
    </tr>
<?php } ?>
</table>