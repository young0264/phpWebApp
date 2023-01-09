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
$query = "insert into post (title, content, created, nickname, idx ) values ('$title', '$content', '$date' ,'$username', 0)";
mysqli_query($connect, $query);
$sql = "SELECT * FROM post ORDER BY id DESC limit 1";
$res = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($res);
$postId = $row['id'];

if (isset($_FILES['SelectFiles']['name'])) {
    $cnt = count( $_FILES['SelectFiles']['name']);
    for ($i = 0; $i < $cnt; $i++) {
        $file_name = $_FILES['SelectFiles']['name'][$i];
        $path = "../upload/".$file_name;
        $file = $_FILES['SelectFiles']['tmp_name'][$i];
        move_uploaded_file($file, $path);
        $query2 = "insert into file (idx, name, path) values ('$postId', '$file_name', '$path')";
        mysqli_query($connect, $query2);
    }
}
?>
<script>
    alert('글쓰기 완료되었습니다.');
    location.replace("/untitled/post/list.php");
</script>
//$tmp_file = $_FILES['SelectFiles']['tmp_name']; //파일
//$origin_name = $_FILES['SelectFiles']['name'];   //파일의 이름
//
//$file_name = iconv("utf-8", "EUC-KR", $_FILES['SelectFile']['name']);
//$path = "../upload/".$file_name;
//move_uploaded_file($tmp_file, $path);


//    $last_id = mysqli_insert_id();
//    echo $last_id;
//    db2_last_insert_id($connect, $query);
//    exit;




