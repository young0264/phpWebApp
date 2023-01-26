<?php
include sprintf("%s/fragments/header.html", $_SERVER['DOCUMENT_ROOT']);
include sprintf("%s/fragments/nav.php", $_SERVER['DOCUMENT_ROOT']);
$login_user = $_COOKIE['id'];
$category = !empty($_GET['category']) ? $_GET['category'] : "";
$search = !empty($_GET['search']) ? $_GET['search'] : "";
$where = "";
if ($category !== "" && $search !== "") {
    $where .= " and {$category} like '%{$search}%'";
}

$sql = "select * from post where idx = 0 {$where}";
$result = mysqli_query($connect, $sql);
$post_cnt = mysqli_num_rows($result);
$page_cnt = ceil($post_cnt / 10);
$pageNum = !empty($_GET['pageNum']) ? $_GET['pageNum'] : 1;

$cnt = ($pageNum - 1) * 10;
$sql = "select 
                (select count(1) from post where idx=t1.id) as parent_cnt,
                t1.* from post t1
                where idx = 0
                    {$where}
                    order by id desc 
                        limit {$cnt}, 10";

$result = mysqli_query($connect, $sql);
/**
 * 게시글 리스트
 * 남의영 (2022-01-05)
 * 게시글들을 보여주는 페이지 입니다
 */


?>
<script type="text/javascript">
    function go(url, id) {
        if (id != null) {
            let parameter = (id !== "" && id !== undefined) ? "?postId=" + id : "";
            location.href = url + parameter;
        } else {
            alert("go posts list");
            var data1 = $("#post_list").val();
            alert(data1);
            console.log(data1);
            // $.ajax({
            //     type: 'POST',
            //     url: 'delete.php',
            //     data: $("#post_list").serialize(),
            //     dataType: "json",
            //     success: function (args) {
            //         alert("ajax post delete success");
            //     }
            //     error: function (e) {
            //         alert(e.responseText);
            //     }
            // })
        }
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
                    <input class="btn btn-outline-info" type="text" name="search" size="40" value="<?= $search ?>"/>
                    <button type="button" class="btn btn-outline-info">검색</button>
                    <button type="button" class="btn btn-outline-info" onclick="go('delete.php', null)" style="float:right;">선택삭제
                    </button>
                    <button type="button" class="btn btn-outline-info" onclick="go('write.html')" style="float:right;">
                        글쓰기
                    </button>
                    <button type="button" class="btn btn-outline-info"
                            onclick="go('../file/my_post_down.php')"
                            style="float:right;">엑셀다운로드
                    </button>
                </form>
            </div>
            <form id="post_list" method="post">
                <table class="table table-bordered table-hover vw-50 vh-50" style="padding-left: 100px;">
                    <tr>
                        <th>선택</th>
                        <th>Post ID</th>
                        <th>제목</th>
                        <th>내용</th>
                        <th>작성자</th>
                        <th>작성일</th>
                        <th>수정/삭제</th>
                        <th>첨부파일</th>
                    </tr>
                    <tbody>
                    <?php while ($row = mysqli_fetch_array($result)) {
                        $sql3 = "select * from file 
                                where idx = " . $row['id'] . "
                                    order by id";

                        $res_file = mysqli_query($connect, $sql3);
                        $file_str = "";
                        while ($row_file = mysqli_fetch_array($res_file)) {
                            $file_str .= $file_str === ""
                                ? "<a href='../upload/{$row_file['name']}' style='color:darkblue'>{$row_file['name']}</a>"
                                : "," . "<a href='../upload/{$row_file['name']}' style='color:darkblue'>{$row_file['name']}</a>";
                        } ?>
                        <tr>
                            <td><input type="checkbox" name="post_id[]" value="<?= $row['id'] ?>"></td>
                            <td><?= $row['id'] ?></td>
                            <!--                        <td><a href="../post/detail.php?postId=-->
                            <?php //= $row['id'] ?><!--" style="color: darkblue">-->
                            <?php //= $row['title'], "(", $row['parent_cnt'], ")" ?><!--</a></td>-->
                            <td id="accordion">
                                <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#<?= $row['id'] ?>" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                    <?= $row['title'], "(", $row['parent_cnt'], ")" ?>
                                </button>
                                <div id="<?= $row['id'] ?>" class="collapse" aria-labelledby="headingTwo"
                                     data-parent="accordion">
                                    <?php
                                    $comment_sql = "select content from post where idx=" . $row['id'] . " order by created";
                                    $comments = mysqli_query($connect, $comment_sql);
                                    ?>
                                    <ul><?php
                                        foreach ($comments as $comment) { ?>
                                            <li> <?= $comment['content'] ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </td>

                            <td><?= $row['content'] ?></td>
                            <td><?= $row['nickname']; ?></td>
                            <td><?= $row['created']; ?></td>
                            <!--   onclick을 통한 삭제와 form submit을 통한 삭제 -->

                            <td>
                                <button class="btn btn-outline-dark" type="button"
                                        onclick="go('detail.php', '<?= $row['id'] ?>')">상세보기
                                </button>
                                <?php if ($row['nickname'] == $login_user) { ?>
                                    <button class="btn btn-outline-dark" type="button"
                                            onclick="go('update.php', '<?= $row['id'] ?>')">수정
                                    </button>
                                    <button class="btn btn-outline-dark" type="button"
                                            onclick="go('delete.php', '<?= $row['id'] ?>')">삭제
                                    </button>
                                <?php } ?>
                            </td>
                            <td><?= $file_str ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </form>
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
