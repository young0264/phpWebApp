<?php $connect = include(sprintf("%s/fragments/header.html", $_SERVER['DOCUMENT_ROOT'])); ?>

<?php

$postId=$_POST['postId'];
$username = $_COOKIE['id'];
$password = $_COOKIE['pw'];
$title=$_POST['title'];
$content=$_POST['content'];

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