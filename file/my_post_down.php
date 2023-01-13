<?php $connect = include(sprintf("%s/fragments/header.html", $_SERVER['DOCUMENT_ROOT'])); ?>

<?php
$login_user = $_COOKIE['id'];
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = excel_test.xls" );     //filename = 저장되는 파일명을 설정합니다.
header( "Content-Description: PHP7 Generated Data" );

$sql = "select * from post where nickname='$login_user'";
$res = mysqli_query($connect,$sql)
?>
<table border="1">
    <tr>
        <th style="background-color: #d1d2d4">Post ID</th>
        <th style="background-color: #d1d2d4">제목</th>
        <th style="background-color: #d1d2d4">내용</th>
        <th style="background-color: #d1d2d4">작성자</th>
        <th style="background-color: #d1d2d4">작성일</th>
        <th style="background-color: #d1d2d4">첨부파일</th>
    </tr>
      <?php
    while ($row = mysqli_fetch_array($res)) {
        $postId = $row['id'];
        $comment_sql = "select * from post where idx=$postId";
        $comment_cnt = mysqli_num_rows(mysqli_query($connect, $comment_sql)); ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><a href="../post/detail.php?postId=<?= $row['id'] ?>"
                   style="color: darkblue"><?= $row['title'], "(", $comment_cnt, ")" ?></a>
            </td>
            <td><?= $row['content'] ?></td>
            <td><?php echo $row['nickname']; ?></td>
            <td><?php echo $row['created']; ?></td>
            <td>
                <?php
                $sql3 = "select * from file 
                            where $postId = idx 
                                order by id";
                $res3 = mysqli_query($connect, $sql3);
                while ($row2 = mysqli_fetch_array($res3)) {
                    $file = $row2['name']; ?>
                    <a href="../upload/<?= $file ?>" download style="color: darkblue"><?= $file ?></a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>
<?php include(sprintf("%s/fragments/bottom.html", $_SERVER['DOCUMENT_ROOT'])); ?>
