<?php
if (!empty($_SESSION['login'])) {
?>
    <div class="rb tab">
        <h2 class="ct">請選擇所需功能</h2>
    </div>
<?php
} else {
?>
    <form action="api/login.php">
        <label for="acc">請輸入帳號：<input type="text" name="acc" id=""></label><br>
        <label for="pw">請輸入帳號：<input type="password" name="pw" id=""></label><br>
        <button>輸入</button><button type="reset">重置</button>
    </form>
<?php
}
