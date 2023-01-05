<?php
date_default_timezone_set('Asia/Seoul');
$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");


$username = $_COOKIE['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d H:i:s');

echo "<h2>$title</h2>";
echo "<h2>$content</h2>";
echo "<h2>$date</h2>";
$tmp_file = $_FILES['SelectFile']['tmp_name']; //파일
$origin_name = $_FILES['SelectFile']['name'];   //파일의 이름

$file_name = iconv("utf-8", "EUC-KR", $_FILES['SelectFile']['name']);
$folder = "../upload/".$file_name;
move_uploaded_file($tmp_file, $folder);
if ($username && $title && $content) {
    $query = "insert into post (title, content, created, nickname, file ) values ('$title', '$content', '$date' ,'$username','$origin_name')";
    echo "<h2>$query</h2>";
    mysqli_query($connect, $query);
    ?>
    "
    <script>
        alert('글쓰기 완료되었습니다.');
        location.replace("/untitled/post/list.php");
    </script>";
    <?php

} else {
    echo "<script>
      alert('글쓰기에 실패했습니다.');
      history.back();</script>";

}
?>

