<?php
$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");

$postId = $_POST['postId'];
$query = "delete from post where id='$postId';";

mysqli_query($connect, $query);

$query = "select from post where id='$postId';";

if (mysqli_query($connect, $query)) {
    echo "<h2>값이 삭제되지 않았습니다</h2>";?>
<?php
}else{
    ?>
    <script type="text/javascript">
        alert("게시글이 삭제되었습니다.");
        location.replace("/untitled/post/list.php");
    </script>
<?php
}
mysqli_close($connect);
?>
