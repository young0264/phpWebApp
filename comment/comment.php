<?php
require_once("../fragments/header.html");
$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");
$postId = $_POST['postId'];
$nickname = $_POST['nickname'];
$content = $_POST['content'];
$created = $_POST['created'];

if ($postId && $_POST['content']) {
    $query = "insert into comment(nickname, content, created, post_id) 
                            values('$nickname','$content', '$created', '$postId')";
    mysqli_query($connect, $query);
    ?>
    <script>
        alert('댓글이 등록되었습니다.');
        location.replace("../post/detail.php?postId=<?=$postId?>");
    </script>
    <?php
} else {
    echo "<script>
            alert('댓글 작성에 실패했습니다.')
            history.back()</script>";}
?>
