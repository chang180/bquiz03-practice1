<div id="mm">
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
        <div class="rb tab" style="width:95%;">
            <table>
                <tbody>
                    <tr> </tr>
                </tbody>
            </table>
            <div class="ct"> </div>
        </div>
    </div>
</div>
<script>
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
        for (s = 0; s <= 2; s++) {
            t = s * 1 + nowpage * 1;
            $("#ssaa" + t).show()
        }
    }
    pp(1)

    let anim = <?= $_SESSION['ani']; ?>;
    // anim=3;

    setInterval(() => {
        // let p = po++;
        if (po > num) po = 0;
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
                // $(".show").slideUp(function() {
                //     change(post);
                // });
                // $(".show").slideDown();
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