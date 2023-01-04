<?php
echo"web연결 성공";

$db_con = mysqli_connect("", "root", "7pifz9!!","test");
if ($db_con){
echo "DB 연결 성공<p>";
    } else {
    echo "DB 연결 실패<p>";
    }

    $db_sec = mysqli_select_db($db_con, "test");
    if ($db_sec) {
    echo "DB select OK <p>";
    } else {
    echo "DB select NO <p>";
    }
    ?>