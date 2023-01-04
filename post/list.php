<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Board</title>
    <link rel="stylesheet" href="/untitled/css/style.css">
</head>
<body>
<script type="text/javascript">
    function delete_id(id) {
        alert(id);
    }
</script>
<div class=top><h2>게시판</h2></div>
<button class="no" onclick="window.location.href='write.html'">글쓰기</button>
<table class="middle">
    <thead>
    <tr>
        <th>Post ID</th>
        <th>제목</th>
        <th>내용</th>
        <th>작성자</th>
        <th>작성일</th>
        <th>삭제</th>
    </tr>
    </thead>
    <div class="pagination">
<?php
        $connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");
        $sql = "select * from post";
        $result = mysqli_query($connect, $sql);
        $row_cnt = mysqli_fetch_array($result);
        $post_cnt = mysqli_num_rows($result);
        $page_cnt = ceil($post_cnt / 10);
        $pageNum = !empty($_GET['pageNum']) ? $_GET['pageNum'] : 1;

        $cnt = ($pageNum - 1) * 10;

        $sql2 = "select * from post 
                    order by id desc 
                        limit $cnt, 10";

        $res2 = mysqli_query($connect, $sql2);
        while ($row = mysqli_fetch_array($res2)) {
?>
                <tbody>
                <tr>
                    <td><?=$row['id']?></td>
                    <td>
                        <a href="/untitled/post/update.php?postId=<?=$row['id']?>"><?php echo $row['title']; ?>
                    </td>
                    <td><?=$row['content']?></td>
                    <td><?php echo $row['nickname']; ?></td>
                    <td><?php echo $row['created']; ?></td>
                    <td>
                        <button type="button" onclick="delete_id('<?=$row['id']?>')">삭제</button>
                    </td>
                </tr>
                </tbody>
<?php
            }
?>
    </div>
</table>
<?php
for ($page = 1;$page <= $page_cnt; $page++) {
    $url = sprintf("%s?pageNum=%s",
        $_SERVER['PHP_SELF'],
        $page
    );
    ?>
    <a href='<?=$url?>'>[<?=$page?>]</a>
<?php
}
?>
</body>
</html>