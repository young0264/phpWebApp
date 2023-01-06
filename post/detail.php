<?php
/**
 * 게시글 리스트
 * 남의영 (2022-01-05)
 * 게시글들을 보여주는 페이지 입니다
 */
?>
<!DOCTYPE html>
<html lang="en">

<?php require_once("../fragments/header.html"); ?>

<body>
<?php require_once("../fragments/nav.php"); ?>
<?php
$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");
$postId = $_GET['postId'];
$query = "select * from post where id=$postId";
$res = mysqli_query($connect, $query);
$post = mysqli_fetch_array($res);

$comment_sql = "select * from comment where post_id=$postId order by id desc";
$res2 = mysqli_query($connect, $comment_sql);
?>
<form method="post" action="../post/list.php">
    <input type="hidden" name="pageNum" value="0">
    <div class="card">
        <button type="submit" class="btn btn-block btn-primary" style="float: right">게시글 리스트로 이동</button>
    </div>
</form>
<div id="main-content" class="blog-page">
    <div class="container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 left-box">
                <h3 class="card single_post">
                    <div class="body">
                        <h3>제목 : <?= $post['title'] ?></h3>
                        <h3>내용 : <?= $post['content'] ?></h3>
                        <svg data-jdenticon-value="<?=$post['nickname']?>" width="80" height="80">
                            Fallback text or image for browsers not supporting inline svg.
                        </svg>
                        <h3>작성자 : <?= $post['nickname'] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 right-box">
                <div class="card">
                    <div class="header">
                        <h3>첨부파일</h3>
                        <a href="../upload/<?= $post['file'] ?>" download><?= $post['file'] ?></a>

                    </div>
                </div>
            </div>
        <div class="card">
            <div class="header">
                <h2>댓글</h2>
                <a>댓글수 : </a>
            </div>
            <div class="body">
        <?php
        while ($comment = mysqli_fetch_array($res2)) {
        $comment_nickname = $comment['nickname'];
        $comment_content = $comment['content'];
        $comment_created = $comment['created'];
        echo "댓글 정보 : $comment_nickname, $comment_content, $comment_created ";
        ?>
                    <ul class="comment-reply list-unstyled">

                            <li class="row clearfix">
                                <div class="icon-box col-md-1 col-4">
                                    <svg data-jdenticon-value="<?=$comment_nickname?>" width="80" height="80">
                                        Fallback text or image for browsers not supporting inline svg.
                                    </svg>
                                </div>
                                <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                                    <h5><?= $comment_nickname ?></h5>
                                    <p><?= $comment_content ?></p>
                                    <ul class="list-inline">
                                        <li><a href="javascript:void(0);"><?= $comment_created ?></a></li>
                                    </ul>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                        <li class="row clearfix">
                            <div class="icon-box col-md-1 col-4"><img class="img-fluid img-thumbnail"
                                                                      src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                                                      alt="Awesome Image"></div>
                            <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                                <h5 class="m-b-0">Christian Louboutin</h5>
                                <p>Great tutorial but few issues with it? If i try open post i get following errors.
                                    Please can you help me?</p>
                                <ul class="list-inline">
                                    <li><a href="javascript:void(0);">Mar 12 2018</a></li>
                                    <li><a href="javascript:void(0);">Reply</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="body">
                    <div class="comment-form">
                        <form class="row clearfix" action="../comment/comment.php" method="post">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <textarea rows="4" name="content" class="form-control no-resize"
                                              placeholder="댓글을 입력해 주세요."></textarea>
                                </div>
                                <?php date_default_timezone_set('Asia/Seoul');
                                $created = date('Y-m-d H:i:s'); ?>
                                <input type="hidden" name="postId" value="<?= $post['id'] ?>"/>
                                <input type="hidden" name="nickname" value="<?= $_COOKIE['id'] ?>"/>
                                <input type="hidden" name="created" value="<?= $created ?>"/>
                                <button type="submit" class="btn btn-block btn-primary">등록</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>