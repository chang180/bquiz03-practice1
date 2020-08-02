    <div class="order-form">
        <h3 class="ct">線上訂票</h3>
        <div class="ct">
            <form method="post" action="api/order.php">
                電影：<select name="name" id="name">
                    <?php
                    $ondate = date("Y-m-d", strtotime("-2 days"));
                    $today = date("Y-m-d");
                    $rows = $Movie->all(['sh' => 1], " && ondate <= '$today' && ondate >= '$ondate' ");
                    foreach ($rows as $row) {
                    ?>
                        <option value="<?= $row['id']; ?>" <?= (!empty($_GET['id']) && $row['id'] == $_GET['id']) ? "selected" : ""; ?>><?= $row['name']; ?></option>
                    <?php
                    }
                    ?>
                </select><br>
                日期：<select name="date" id="date">

                </select><br>
                場次：<select name="sess" id="sess">

                </select><br>
                <button type="button" onclick="booking()">確定</button><button type="reset">重置</button>
        </div>
    </div>

    <div class="booking-form" style="display:none">
        <div class="room"></div>
        <div class="info">
            您所選擇的電影是：<span id="mName"></span><br>
            您所選擇的時刻是：<span id="mDate"></span><span id="mSess"></span><br>
            您已經勾選了<span id="ticket">0</span>張票，最多可以購買4張票<br>
        </div>
        <button type="button" onclick="prev()">上一步</button><button id="send" type="button">確認</button>
    </div>
    </form>

    <script>
        function booking() {
            let movieName = $("#name option:selected").text();
            let date = $("#date").val();
            let session = $("#sess").val();
            let sessionName = $("#sess option:selected").text();
            let ticket = 0;
            let seat = new Array();

            $("#mName").text(movieName);
            $("#mDate").text(date);
            $("#mSess").text(sessionName);


            $.get("api/get_seats.php", {
                movieName,
                date,
                session
            }, function(res) {
                $(".room").html(res);
                $(".seat").change(function() {
                    if (this.checked) {
                        if (ticket > 3) this.checked = false;
                        else {
                            ticket++;
                            seat.push(this.value);
                        }
                    } else {
                        ticket--;
                        seat.splice(seat.indexOf(this.value, 1));
                    }
                    console.log(seat);
                    $("#ticket").text(ticket);
                })
                $("#send").on("click", function() {
                    $.post("api/order.php", {
                        seat,
                        movieName,
                        date,
                        session
                    }, function(res) {
                       location.href=`?do=result&no=${res}`;
                    });
                })
            })

            $(".order-form,.booking-form").toggle();
        }


        function prev() {
            $(".order-form,.booking-form").toggle();
            $(".room").html("");
        }

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