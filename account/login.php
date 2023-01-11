<?php
//session_start();

/**
 * 로그인 페이지
 * 남의영 ( 2022-01-04 )
 * 아이디와 비밀번호를 받을수 있는 페이지
 */
$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");
$id = $_POST['nickname'];
$pw = $_POST['password'];
//$email = $_POST['email'];
$query = "select * from member where nickname='$id'";

$result = $connect->query($query);
if (!mysqli_num_rows($result)) {
    $query = "select * from member where email='$id'";
    $result = $connect->query($query);
}
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if ($row['password'] == $pw) {
//        $_SESSION['userid'] = $id;
//        $_SESSION['userpw'] = $pw;
//        $_SESSION['useremail'] = $email;
//        setcookie('id', $id,['samesite' => 'None', 'secure' => true]);
//        setcookie('pw', $pw,['samesite' => 'None', 'secure' => true]);
        setcookie('id', $id,time() + 3600);
        setcookie('pw', $pw,time() + 3600);

        if (isset($_COOKIE['id'])) {
            ?>
            <script>

                alert("로그인 되었습니다.");
                location.replace("../main/mainpage.html");
            </script>
            <?php
        } else {
            echo "session fail";
        }
    } else {
        ?>
        <script>
            alert("아이디 혹은 비밀번호가 잘못되었습니다.");
            history.back();
        </script>
        <?php
    }
} else {
    ?>
    <script>
        alert("아이디 혹은 비밀번호가 잘못되었습니다.");
        history.back();
    </script>
    <?php
}
?>
