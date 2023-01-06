<!DOCTYPE html>
<html lang="en">

<?php require_once("../fragments/header.html"); ?>

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

<div class=top><h2>검색 결과 게시판</h2></div>
search.php 페이지
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
        //        =====검색 쿼리 ====//
        $category = $_GET['category'];
        $search = $_GET['search'];

        $search_sql = "select * from post where $category like '%$search%' order by id desc";
        $result = mysqli_query($connect, $search_sql);
        $post_cnt = mysqli_num_rows($result);
        $page_cnt = ceil($post_cnt / 10);

        while ($row = mysqli_fetch_array($result)) {
            ?>
            <tbody>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?php echo $row['title']; ?></td>
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

<?php
for ($page = 1; $page <= $page_cnt; $page++) {
//    echo $_SERVER['PHP_SELF']; //untitled/post/list
    $url = sprintf("%s?pageNum=%s",
        $_SERVER['PHP_SELF'],
        $page);
    ?>
    <a href='<?= $url ?>'>[<?= $page ?>]</a>
    <?php
}
?>
</body>
</html>