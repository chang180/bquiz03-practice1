<h1 class="ct">預告片清單</h1>
<form action="api/edit_poster.php" method="post">
<table>
    <tr>
        <td>預告片海報</td>
        <td>預告片片名</td>
        <td>預告片排序</td>
        <td>操作</td>
    </tr>
    <?php
$rows=$Poster->all([]," ORDER BY rank DESC");
foreach($rows as $row){
    ?>
    <tr>
        <td><img src="img/<?=$row['path'];?>" style="width:80px;"></td>
        <td><input type="text" name="name[]" value="<?=$row['name'];?>"></td>
        <td><input type="text" name="rank[]" value="<?=$row['rank'];?>"></td>
        <td>
<input type="checkbox" name="sh[]" value="<?=$row['id'];?>" <?=($row['sh']==1)?"checked":"";?>>顯示
<input type="checkbox" name="del[]" value="<?=$row['id'];?>">刪除
        </td>
        <input type="hidden" name="id[]" value="<?=$row['id'];?>">
    </tr>
<?php } ?>
</table>
動畫效果(1:淡入淡出 2:放大縮小 3:滑出)<input type="text" name="ani" value="<?=$_SESSION['ani'];?>"><br>
<button>編輯確定</button><button type="reset">重置</button>
</form>
<hr>
<h1 class="ct">新增預告片海報</h1>
<form action="api/upload_poster.php" method="post" enctype="multipart/form-data">
預告片海報<input type="file" name="img">預告片片名<input type="text" name="name"><br>
<button>新增</button><button type="reset">重置</button>
</form>