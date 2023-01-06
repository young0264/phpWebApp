<?php
/**
 * 게시글 리스트
 * 남의영 (2022-01-05)
 * 게시글들을 보여주는 페이지 입니다
 */
?>
<!DOCTYPE html>
<html lang="en">

<?php require_once("../fragments/header.html");?>

<body>
<?php require_once("../fragments/nav.php"); ?>

<script type="text/javascript">
    function delete_id(id) {
        location.replace("../post/delete.php?postId=" + id);
    }
</script>
<script>
    function post_modify(id) {
        location.replace("../post/update.php?postId=" + id);
    }
</script>

<div class=top><h2>게시판</h2></div>
<button class="no" onclick="window.location.href='write.html'">글쓰기</button>
<div id="search_box">
    <form action="../post/search.php" method="get">
        <select name="category">
            <option value="nickname">작성자</option>
            <option value="title">제목</option>
            <option value="content">내용</option>
        </select>
        <input type="text" name="search" size="40" required="required"/>
        <button>검색</button>
    </form>
</div>
<table class="middle">
    <thead>
    <tr>
        <th>Post ID</th>
        <th>제목</th>
        <th>내용</th>
        <th>작성자</th>
        <th>작성일</th>
        <th>수정</th>
        <th>삭제</th>
        <th>첨부파일</th>
    </tr>
    </thead>

    <div class="pagination">
        <?php
        $connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");
        $sql = "select * from post";
        $result = mysqli_query($connect, $sql);
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
                <td><?= $row['id'] ?></td>
                <td><a href="../post/detail.php?postId=<?=$row['id']?>">post detail</a> <?php echo $row['title']; ?></td>
                <td><?= $row['content'] ?></td>
                <td><?php echo $row['nickname']; ?></td>
                <td><?php echo $row['created']; ?></td>
                <!--                    onclick을 통한 삭제와 form submit을 통한 삭제 -->
                <td>
                    <button type="button" onclick="post_modify('<?= $row['id'] ?>')">수정</button>
                </td>
                <td>
                    <button type="button" onclick="delete_id('<?= $row['id'] ?>')">삭제</button>
                </td>
                <td>
                    <a href="../upload/<?= $row['file'] ?>" download><?= $row['file'] ?></a>
                </td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </div>
</table>
<div class="pageNum">

    <?php
    for ($page = 1;
    $page <= $page_cnt;
    $page++) {
    $url = sprintf("%s?pageNum=%s",
        $_SERVER['PHP_SELF'],
        $page);
    ?>
    <a href='<?= $url ?>'>[<?= $page ?>]
        <?php
        }
        ?>
</div>
</body>
</html>