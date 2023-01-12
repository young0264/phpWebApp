<?php
header('Content-type: text/html');
header('Access-Control-Allow-Origin: *');
include(sprintf("%s/fragments/header.html", $_SERVER['DOCUMENT_ROOT']));
include(sprintf("%s/fragments/nav.php", $_SERVER['DOCUMENT_ROOT']));

$login_user = $_COOKIE['id'];
$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");
$category = !empty($_GET['category']) ? $_GET['category'] : "";
$search = !empty($_GET['search']) ? $_GET['search'] : "";
$where = "";
if ($category !== "" && $search !== "") {
    $where .= " and {$category} like '%{$search}%'";
}
$sql = "select * from post where id is not null and idx = 0 {$where}";
$result = mysqli_query($connect, $sql);
$post_cnt = mysqli_num_rows($result);
$page_cnt = ceil($post_cnt / 10);
$pageNum = !empty($_GET['pageNum']) ? $_GET['pageNum'] : 1;

$cnt = ($pageNum - 1) * 10;
$sql2 = "select * from post
                where id is not null and idx = 0 
                    order by id desc 
                        limit $cnt, 10";
$res2 = mysqli_query($connect, $sql2);
/**
 * 게시글 리스트
 * 남의영 (2022-01-05)
 * 게시글들을 보여주는 페이지 입니다
 */

?>
<script type="text/javascript">
    function delete_id(id) {
        location.replace("../post/delete.php?postId=" + id);
    }

    function post_modify(id) {
        location.replace("../post/update.php?postId=" + id);
    }
</script>
<body class="container" style="background-color: aliceblue">

<div class="container" style="background-color: aliceblue">
    <div class="row about-container">
        <div id="board_write" style=" padding-left: 200px; padding-right:200px; background-color: aliceblue ">
            <div class="top">
                <h2>게시판</h2>
            </div>
            <div id="search_box">
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="get">
                    <select class="btn btn-outline-info" name="category">
                        <option value="nickname">작성자</option>
                        <option value="title">제목</option>
                        <option value="content">내용</option>
                    </select>
                    <input class="btn btn-outline-info" type="text" name="search" size="40" required="required"
                           value="<?= $search ?>"/>
                    <button class="btn btn-outline-info">검색</button>
                    <button class=" btn btn-outline-info" onclick="window.location.href='write.html'"
                            style="float:right;">글쓰기
                    </button>
                </form>
            </div>
            <table class="table table-bordered table-hover vw-50 vh-50" style="padding-left: 100px;">
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
                <tbody>
                <?php
                while ($row = mysqli_fetch_array($res2)) {
                    $postId = $row['id'];
                    $comment_sql = "select * from post where idx=$postId ";
                    $comment_cnt = mysqli_num_rows(mysqli_query($connect, $comment_sql));
                    ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><a href="../post/detail.php?postId=<?= $row['id'] ?>"
                               style="color: darkblue"><?= $row['title'], "(", $comment_cnt, ")" ?></a>
                        </td>
                        <td><?= $row['content'] ?></td>
                        <td><?php echo $row['nickname']; ?></td>
                        <td><?php echo $row['created']; ?></td>
                        <!--                    onclick을 통한 삭제와 form submit을 통한 삭제 -->
                        <td>

                            <?php if ($row['nickname']==$login_user) { ?>
                                <button class="btn btn-outline-dark" type="button" onclick="post_modify('<?=$postId?>')">수정</button>
                            <?php } ?>
                        </td>
                        <td>
                            <button class="btn btn-outline-dark" type="button" onclick="delete_id('<?= $postId ?>')">
                                삭제
                            </button>
                        </td>
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
                </tbody>
            </table>
            <nav class="pageNum">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <?php
                        for ($page = 1; $page <= $page_cnt; $page++) {
                            $url = sprintf("%s?pageNum=%s", $_SERVER['PHP_SELF'], $page);
                            ?>
                            <li class="page-item">
                                <a class="page-link; btn btn-outline-info" <?= $pageNum == $page ? "active" : "" ?>"
                                href='<?= $url ?>'>
                                [<?= $page ?>]
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </nav>
        </div>
    </div>
</div>
</body>
<?php include(sprintf("%s/fragments/bottom.html", $_SERVER['DOCUMENT_ROOT'])); ?>
