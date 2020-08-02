<form action="api/order.php" method="post">
    <h3 class="ct">線上訂票</h3>
    <div class="ct">
        電影：<select name="name" id="name">
            <?php
            $ondate = date("Y-m-d", strtotime("-2 days"));
            $today = date("Y-m-d");
            $rows = $Movie->all(['sh' => 1], " && ondate <= '$today' && ondate >= '$ondate' ");
            foreach ($rows as $row) {
            ?>
                <option value="<?= $row['id']; ?>" <?= (!empty($_GET['id']) && $row['id'] == $_GET['id']) ? "checked" : ""; ?>><?= $row['name']; ?></option>;
            <?php
            }
            ?>
        </select><br>
        日期：<select name="date" id="date">

        </select><br>
        場次：<select name="sess" id="sess">

        </select><br>
        <button>確定</button><button type="reset">重置</button>
    </div>
</form>
<script>
    getdate();
    getsess();


    function getdate() {
        $.get("api/getdate.php", {
            id: $("#name").val()
        }, function(res) {
            $("#date").html(res);
            getsess();
        })
    }

    function getsess() {
        $.get("api/getsess.php", {
            id: $("#name").val(),
            date: $("#date").val()
        }, function(res) {
            $("#sess").html(res);
        })
    }

    $("#name").on("change", function() {
        getdate();
        getsess();
    })

    $("#date").on("change", function() {
        getsess();
    })

</script>