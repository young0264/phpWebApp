<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Board</title>
    <link rel="stylesheet" href="/css/style.css">
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
    </tr>
    </thead>
    <?php
    $connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");

    $sql = "SELECT * FROM post ORDER BY id DESC";
    $result = mysqli_query($connect, $sql);

    while($row = mysqli_fetch_array($result)){
        $postId = $row['id'];
        ?>
        <tbody>
        <tr>
            <td><?php echo $row['id'];?></td>

            <td><a href="/post/update.php?postId=<?php echo $postId;?>"><?php echo $row['title'];?></td></td>

            <td><?php echo $row['content'];?></td>
            <td><?php echo $row['nickname'];?></td>
            <td><?php echo $row['created'];?></td>
        </tr>
        </tbody>
    <?php } ?>
</table>
</body>
</html>