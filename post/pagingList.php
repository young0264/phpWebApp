<?php include(sprintf("%s/fragments/header.html", $_SERVER['DOCUMENT_ROOT'])); ?>

<?php
require_once("../fragments/header.html");
echo $_SERVER["DOCUMENT_ROOT"];
echo $_SERVER["REQUEST_URI"];
?>
<body>
<div id="headers"></div>
<div class=top><h2>게시판</h2></div>

<button class="no" onclick="window.location.href='write.html'">글쓰기</button>
<button class="no" onclick="window.location.href='../head.php'">테스트링크</button>
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
    <?php


    $sql = "SELECT * FROM post";
    $result = mysqli_query($connect, $sql);
    $post_cnt = mysqli_num_rows($result);
    $page_cnt = ceil($post_cnt / 10);

    $pageNum = (!empty($_POST['pageNum']) ? $_POST['pageNum'] : 1);
    $cnt = ($pageNum - 1) * 10;
    //    $sql = "SELECT * FROM post ORDER BY id DESC";
    $sql2 = "select * from post order by id desc limit $cnt, 10";
    echo $sql2;
    $result2 = mysqli_query($connect, $sql2);

    while ($row = mysqli_fetch_array($result2)) {
        $postId = $row['id'];
        ?>
        <tbody>
        <tr>
            <td><?php echo $row['id']; ?></td>

            <td><a href="/untitled/post/update.php?postId=<?= $postId; ?>"><?php echo $row['title']; ?></td>

            <td><?php echo $row['content']; ?></td>
            <td><?php echo $row['nickname']; ?></td>
            <td><?php echo $row['created']; ?></td>
            <form method="post" action="/untitled/post/delete.php">
                <td>
                    <input type="hidden" name="postId" value="<?= $postId ?>"/>
                    <button type="submit">삭제</button>
                </td>
            </form>
        </tr>
        </tbody>
        <?php
    }
    ?>
</table>
<form action="pagingList.php" method="post">

    <?php
    for ($page = 1; $page <= $page_cnt; $page++) {
        echo "<input type='submit' name='pageNum' value='$page'>";
    }
    ?>
</body>

</html>