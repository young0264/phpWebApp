<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>

</head>
<body>

<?php
    $postId=$_GET['postId'];
//    echo"<h2>$postId</h2>";
//    exit;
    $connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");
    $sql = "SELECT * FROM post where id = '$postId'";
    $result = mysqli_query($connect, $sql);
//    $result = $connect->query($sql);
    $post=mysqli_fetch_assoc($result);

    ?>
<div id="board_write">
    <h4>글을 작성하는 공간입니다.</h4>
    <div id="write_area">
        <form action="/post/update_ok.php" method="post">
            <input type="hidden" name="postId" value="<?=$postId?>">
<!--        <form action="testPost.php?postId=--><?php //echo $postId; ?><!--" method="post">-->
            <div id="in_title">
                <textarea name="title" id="utitle" rows="3" cols="40" placeholder="제목" maxlength="100" required>
                <?php echo $post['title']; ?>
                </textarea>
            </div>

            <div class="wi_line"></div>

            <div id="in_content">
                <textarea name="content" id="ucontent" rows="10" cols="40" placeholder="내용" required>
                <?php echo $post['content']; ?>

                </textarea>
            </div>

            <input type="file" name="SelectFile" />

            <div class="bt_se">
                <button type="submit">글 작성</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>