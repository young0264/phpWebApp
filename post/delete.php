<?php
$connect = include(sprintf("%s/fragments/dbConnect.php", $_SERVER['DOCUMENT_ROOT']));

$postId = $_GET['postId'];
$query = "delete from post where id='$postId';";

mysqli_query($connect, $query);

$query = "select from post where id='$postId';";

if (mysqli_query($connect, $query)) {
    echo "<h2>값이 삭제되지 않았습니다</h2>";?>
<?php
}else{
    ?>
    <script type="text/javascript">
        const postNum = "<?=$postId?>";
        alert(postNum + "번째 게시글이 삭제되었습니다.");
        location.replace("/untitled/post/list.php");
    </script>
<?php
}
mysqli_close($connect);
?>
