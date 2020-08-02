
    <div class="half" style="vertical-align:top;">
        <h1>預告片介紹</h1>
        <div class="rb tab" style="width:95%;">
            <!-- <div id="abgne-block-20111227"> -->
            <div style="height:300px;position:relative" class="text-center">
                <!-- 海報     -->
                <img src="" style="height:250px" id="showpost" class="show"><br>
                <!-- 片名 -->
                <span id="showtext" class="show"></span>
            </div>
            <!-- 按鈕區 -->
            <div style="display:inline-block;height:100px;width:400px;">
                <div style="display:inline;" onclick="pp(1)">&#9664;</div>
                <?php
                $rows = $Poster->all(['sh' => 1], " ORDER BY rank DESC ");
                foreach ($rows as $key => $row) {
                ?>
                    <div class="im" id="ssaa<?= $key; ?>" style="display:inline-block"><img src="img/<?= $row['path']; ?>" style="height:90px;width:80px" onclick="change(<?= $key ?>)">
                        <div id="<?= $key; ?>"><?= $row['name']; ?></div>
                    </div>
                <?php } ?>
                <div style="display:inline" onclick="pp(2)">&#9654;</div>
            </div>
        </div>
    </div>
    <div class="half">
        <h1>院線片清單</h1>
        <div class="rb tab" style="width:95%;display:flex;flex-wrap:wrap;">
            <?php
            $today = date("Y-m-d");
            $ondate = date("Y-m-d", strtotime("-2 days"));
            $div = 4;
            $now = $_GET['p'] ?? "1";
            $start = ($now - 1) * $div;
            $movies = $Movie->all(['sh' => 1], " && ondate >= '$ondate' && ondate <= '$today' ORDER BY rank LIMIT $start,$div ");
            $total = $Movie->count(['sh' => 1], " && ondate >= '$ondate' && ondate <= '$today'");
            $pages = ceil($total / $div);
            foreach ($movies as $m) {
            ?>
                <div style="min-width:48%;border:1px solid black">
                    <div class="ct">片名：<?= $m['name']; ?></div>
                    <img src="img/<?= $m['poster']; ?>" style="height:90px;width:80px;">
                    分級：<?= @$level[$m['level']]; ?><br>
                    上映日期：<?= $m['ondate']; ?><br>
                    <a href="index.php?do=intro&id=<?= $m['id']; ?>">劇情簡介</a>
                    <a href="?do=order&id=<?= $m['id']; ?>">線上訂票</a>
                </div>
            <?php } ?>
        </div>
        <?php
        // echo $total;
        for ($i = 1; $i <= $pages; $i++) {
            $font = ($now == $i) ? "30px" : "20px";
            echo "<a href='?p=$i' style='font-size:$font'>$i</a>";
        }
        ?>
    </div>
<button type="button" id="onToday">所有電影今天上映！</button>

<script>
    $("#onToday").on("click", function() {
        $.get("api/on_today.php", function() {
            alert("通通上演啦！");
            location.reload();
        })
    })

    var nowpage = 0,
        num = <?= count($rows); ?>,
        po = 0;

    function pp(x) {
        var s, t;
        if (x == 1 && nowpage - 1 >= 0) {
            nowpage--;
        }
        if (x == 2 && (nowpage + 1) <= num * 1 - 3) {
            nowpage++;
        }
        $(".im").hide()
        for (s = 0; s <= 3; s++) {
            t = s * 1 + nowpage * 1;
            $("#ssaa" + t).show()
        }
    }
    pp(1)
    let anim = <?= $_SESSION['ani']; ?>;
    // anim=3;

    setInterval(() => {
        po++;
        if (po >= num) po = 0;
        ani(po);
    }, 2000);

    // setInterval(auto,2000);
    // function auto(){
    //     let p=po++;
    //     if(po>num) po=0;
    //     ani(po);
    // }

    // 重點：動畫，先出場動畫後再換圖換字，再執行進場動畫
    function ani(post) {
        switch (anim) {
            case 1:
                $(".show").fadeToggle(function() {
                    change(post);
                });
                $(".show").fadeToggle();
                break;
            case 2:
                $(".show").slideToggle(function() {
                    change(post);
                });
                $(".show").slideToggle();
                break;
            default: //保證無論如何會有動畫效果
                // $(".show").hide(function() {
                //     change(post);
                // });
                $(".show").parent("div").animate({
                    position: "absolute",
                    left: "-=200px",
                    opacity: "0"
                }, function() {
                    change(post);
                });
                $(".show").parent("div").animate({
                    position: "absolute",
                    left: "+=200px",
                    opacity: "1"
                });
                break;
        }
    }

    function change(post) { // 改圖改字改順序
        // 換圖
        $("#showpost").attr("src", $("#ssaa" + post).find("img").attr("src"));
        // 換字
        $("#showtext").text($("#" + post).text());
        // 重點：點擊的海報換成現在播出的，並從此開始播
        po = post;

    }
</script>