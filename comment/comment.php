<?php
include_once sprintf("%s/%s", $_SERVER['DOCUMENT_ROOT'], "fragments/dbConnect.php");
$postId = $_POST['postId'];
$nickname = $_POST['nickname'];
$content = $_POST['content'];
$created = $_POST['created'];

if ($postId && $_POST['content']) {

    $query = "insert into post (idx,content, created,nickname) 
                            values('$postId', '$content', '$created', '$nickname') ";
    $result = mysqli_query($connect, $query);
    ?>
    <script>
        alert('댓글이 등록되었습니다.');
        location.replace("../post/detail.php?postId=<?=$postId?>");
    </script>
    <?php
} else {
    echo "<script>
            alert('댓글 작성에 실패했습니다.')
            history.back()</script>";
}
?>
