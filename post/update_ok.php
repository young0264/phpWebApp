<?php
$postId=$_GET['postId'];
exit;

echo "<h2>$postId</h2>";
$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");

//    echo"<h2>$postId</h2>";
//    exit;
echo "<h2>$postId</h2>";
exit;
$username = $_COOKIE['id'];
$password = $_COOKIE['pw'];
$title=$_POST['title'];
$content=$_POST['content'];
//$title = $_GET['title'];
//$content = $_GET['content'];
$sql = "update post set title='".$title."',content='".$content."' where id='".$postId."'" ?>

<!--<script type="text/javascript">alert("수정되었습니다."); </script>-->
<!--<meta http-equiv="refresh" content="0 url=/page/board/read.php?idx=--><?php //echo $postId; ?><!--">-->