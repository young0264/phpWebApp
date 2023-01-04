<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Board</title>
    <link rel="stylesheet" href="/untitled/css/style.css">
</head>
<body>
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

        $sql = "SELECT * FROM post;";
        $result = mysqli_query($connect, $sql);
        $post_cnt = mysqli_num_rows($result);
        $page_cnt = ceil($post_cnt / 10);
        ?>
        <form action="pagingList.php" method="post">
            <?php
            for ($page = 1;$page <= $page_cnt; $page++) {
            echo "<input type='submit' name='pageNum' value='$page'>";
            //                echo "<div> "  .$page. " </div>";

            }
            ?>

        </form>

    </div>
</table>
</body>
</html>