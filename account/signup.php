<?php
$nickname = $_POST['nickname'];
$password = $_POST['password'];
$email = $_POST ['email'];
$intro = $_POST ['intro'];

$mysqli = new mysqli("localhost", "root", "7pifz9!!", "loginexam");

$is_member = "select * from member where $nickname=nickname";
$res = mysqli_query($mysqli, $is_member);
$row = mysqli_fetch_array($res);

$stmt = $mysqli->stmt_init();
$sql = "insert into member (nickname, password, email, intro) values (?, ?, ?, ?)";
$stmt->prepare($sql);
$stmt->bind_param( "ssss",$nickname,$password, $email, $intro);
$stmt->execute();

//print_r($stmt);

if (!$row) {
    ?>
    <script>
        alert('가입 되었습니다.');
        location.replace("./login.html");
    </script>
<?php } else {
    ?>
    <script>
        alert("이미 가입되어 있는 회원입니다.");
    </script>
<?php }

?>