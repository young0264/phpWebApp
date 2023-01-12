<?php
$nickname = $_COOKIE['id'];

setcookie('id', '', time() - 3600, '/');
if (isset($_COOKIE['id'])) {
    ?>
    <script>
        alert("로그아웃 되었습니다.");
        location.replace("../main/mainpage.html");
    </script>
    <?php } else { ?>
        <script>
            alert("아이디 혹은 비밀번호가 잘못되었습니다.");
            history.back();
        </script>
        <?php } ?>
    <?php  ?>





