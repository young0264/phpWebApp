<?php
$connect = include(sprintf("%s/fragments/header.html", $_SERVER['DOCUMENT_ROOT']));

$fn = $_POST['file_name'];
$postId = $_POST['postId'];

@unlink(sprintf("../upload/%s", $fn));
$sql = "delete from file where name='$fn'";
$res = mysqli_query($connect, $sql);
if (! $res) {
    echo "<script> alert('이미 삭제된 파일입니다.')</script>";
}
else { ?>
<script>
    alert("<?=$fn?>파일 삭제가 완료되었습니다.");
</script>
<?php } ?>
