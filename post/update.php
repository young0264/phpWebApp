<?php $connect = include(sprintf("%s/fragments/header.html", $_SERVER['DOCUMENT_ROOT'])); ?>

<body>

<?php
include(sprintf("%s/fragments/nav.php", $_SERVER['DOCUMENT_ROOT']));
$postId = $_GET['postId'];
$sql = "SELECT * FROM post where id = '$postId'";
$result = mysqli_query($connect, $sql);
$post = mysqli_fetch_assoc($result);
?>


<div class="forum-topic-add" style="background-color: aliceblue">
    <div class="my-4"  style="background-color: aliceblue">
        <div style="margin-left: 200px; ">
            <div class="col-md-8 col-md-offset-2">
                <h1>Create post</h1>
                <!--                <form action="" method="POST">-->
                <form enctype="multipart/form-data" id="uploadForm" action="/untitled/post/update_ok.php" method="post">
                    <input type="hidden" name="postId" value="<?= $postId ?>">

                    <div class="form-floating mb-3">
                        <h8>제목</h8>

                        <input type="text" style="background-color:cornflowerblue" class="form-control" name="title" value="<?php echo $post['title']; ?>"required>
                    </div>
                    <div class="form-group">
                        <h8>내용</h8>
                        <textarea rows="5" style="background-color:cornflowerblue" class="form-control" name="content"  required><?php echo $post['content']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <h8>첨부파일</h8>
                        <div class="col-sm-10">
                            <input type="file" name="SelectFiles[]" multiple/>
                        </div>
                        <div><?php
                            $sql3 = "select * from file 
                                    where $postId = idx 
                                        order by id";
                            $res3 = mysqli_query($connect, $sql3);
                            while ($row2 = mysqli_fetch_array($res3)) {
                                $file = $row2['name']; ?>

                                <a href="../upload/<?= $file ?>" download style="color: darkblue"><?= $file ?></a>
                            <?php } ?></div>
                    </div>
                    <div class="d-grid gap-2 d-md-block">
                        <button type="submit" class="btn btn-primary" >
                            작성
                        </button>
                        <a class="btn btn-default" href="./list.php" >
                            취소
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>