<form action="api/addmovie.php" method="post" enctype="multipart/form-data">
    <div style="display:flex">
        <div>影片資料</div>
        <div>
            片名：<input type="text" name="name"><br>
            分級<select name="level">
                <option>請選擇分級</option>
                <option value="1">普遍級</option>
                <option value="2">保護級</option>
                <option value="3">輔導級</option>
                <option value="4">限制級</option>
            </select><br>
            片長：<input type="text" name="length"><br>
            上映日期：<select name="year">
                <option value="2020">2020</option>
            </select>
            <select name="month">
                <?php
                for ($i = 1; $i <= 12; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select>
            <select name="day">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select><br>
            發行商：<input type="text" name="publish"><br>
            導演：<input type="text" name="director"><br>
            預告影片：<input type="file" name="trailer">
            電影海報：<input type="file" name="poster">
        </div>
    </div>
    <div style="display:flex">
        <div>劇情簡介</div>
        <textarea name="intro" style="width:800px;height:100px;"></textarea>
    </div>
    <div class="ct">
        <button>新增</button><button type="reset">重置</button>
    </div>
</form>