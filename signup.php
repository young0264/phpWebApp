<?php

$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");


$nickname=$_POST['nickname'];
$password=$_POST['password'];
$email =$_POST ['email'];

//입력받은 데이터를 DB에 저장
$query = "insert into member (nickname, password, email) values ('$nickname', '$password', '$email')";
echo "<h2>$query</h2>";
exit;
$result = mysqli_query($connect, $query);
print_r($result);
echo "<h2>result : $result</h2>";

//저장이 됬다면 (result = true) 가입 완료
if($result) {
    ?>      <script>
        alert('가입 되었습니다.');
        location.replace("./login.html");
    </script>
<?php   }
else{
    ?>              <script>
        alert("fail");
    </script>
<?php   }

mysqli_close($connect);
?>