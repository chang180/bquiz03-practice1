<a href="?do=addmovie"><button>新增電影</button></a>
<hr>
<?php
$rows = $Movie->all();
foreach ($rows as $row) {
?>
    <div class="contain" style="display:flex">
        <div><img src="img/<?= $row['poster']; ?>" style="width:80px"></div>
        <div>分類<img src="img/<?= $row['level']; ?>.png"></div>
        <div>
            <div style="display:flex">
                <div>片名：<?= $row['name']; ?></div>
                <div>片長：<?= $row['length']; ?></div>
                <div>上映時間：<?= $row['ondate']; ?></div>
            </div>
            <div style="float:right"><a href="?do=editmovie&id=<?=$row['id'];?>"><button>編輯電影</button></a><a href="api/del_movie.php?id=<?=$row['id'];?>"><button>刪除電影</button></a></div>
            <div>劇情介紹：<?= $row['intro']; ?></div>
        </div>
    </div>
    <hr>
<?php } ?>