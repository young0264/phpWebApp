<?php
echo $_COOKIE['id'].": 쿠키가 들어오는지<br />";

if(isset($_COOKIE['id'])){
    echo $_COOKIE['id']."이 로그인 했습니다<br />";
//    echo "<meta http-equiv='refresh' content='0;url=login_check.php'/>";
} else{
    echo "<h2>쿠키값이 없습니다.</h2>"
    ?>
    <script>
        alert("로그인을 해주세요.");
        location.replace("./login.html");
    </script>
    <?php
}
//$user_id = $_COOKIE['id'];
//echo "안녕하세요 ".$user_id."님! <br/>";
//echo "<a href='logout.php'>로그아웃</a>";
?>