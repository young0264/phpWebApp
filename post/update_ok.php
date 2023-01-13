<?php $connect = include(sprintf("%s/fragments/header.html", $_SERVER['DOCUMENT_ROOT'])); ?>

<?php

$postId=$_POST['postId'];
$username = $_COOKIE['id'];
$password = $_COOKIE['pw'];
$title=$_POST['title'];
$content=$_POST['content'];

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


echo "<h2>$postId, $username, $password, $title, $content</h2>";
//$sql = "update post set title='".$title."',content='".$content."' where id='".$postId."'"

$post_query = "update post set title='".$title."', content='".$content."' where id=$postId";

mysqli_query($connect, $post_query);
mysqli_close($connect);
?>

"<script>
    alert('수정이 완료되었습니다.');
    location.replace("/untitled/post/list.php");
</script>";
<!--<meta http-equiv="refresh" content="0 url=/page/board/read.php?idx=--><?php //echo $postId; ?><!--">-->