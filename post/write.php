<?php include sprintf("%s/fragments/header.html", $_SERVER['DOCUMENT_ROOT']); ?>

<?php
date_default_timezone_set('Asia/Seoul');

$username = $_COOKIE['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$created = date('Y-m-d H:i:s');


$stmt = $connect->stmt_init();
$sql = "insert into post (title, content, created, nickname, idx ) values (?, ?, ? ,?,?)";
$zero = 0;
$stmt->prepare($sql);
$stmt->bind_param("sssss", $title, $content, $created, $username, $zero);
$stmt->execute();

$sql2 = "SELECT * FROM post ORDER BY id DESC limit 1";
$res = mysqli_query($mysqli, $sql2);
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
        mysqli_query($mysqli, $query2);
    }
}
?>
<script>
    alert('글쓰기 완료되었습니다.');
    location.replace("/untitled/post/list.php");
</script>

