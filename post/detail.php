<?php
/**
 * 게시글 리스트
 * 남의영 (2022-01-05)
 * 게시글들을 보여주는 페이지 입니다
 */
require_once("../fragments/header.html");
require_once("../fragments/nav.php");
$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");
$postId = $_GET['postId'];
$query = "select * from post where id=$postId";
$res = mysqli_query($connect, $query);
$post = mysqli_fetch_array($res);
$comment_sql = "select * from post where idx=$postId order by id desc";
$res2 = mysqli_query($connect, $comment_sql);
$comment_cnt = mysqli_num_rows($res2);

$file_sql = "select * from file where idx=$postId order by id";
$file_result = mysqli_query($connect, $file_sql);
?>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div id="main-content" class="blog-page">
    <div class="container">
        <div class="row clearfix">
            <div class=" ">
                <div class="card single_post">
                    <div class="body">
                        <div class="img-post">
                            <h3>작성자 : <?= $post['nickname'] ?></h3>
                            <img class="d-block img-fluid" src="../images/bg-image.jpeg" alt="First slide">
                        </div>
                        <h1><?= $post['title'] ?></h1>
                        <p><?= $post['content'] ?></p>
                    </div>
                </div>
                <div class="card">
                    <div class="header">
                        <h2>댓글 <?=$comment_cnt?></h2>
                    </div>
                    <div class="body">
                        <?php
                        while ($comment = mysqli_fetch_array($res2)) {
                        $comment_nickname = $comment['nickname'];
                        $comment_content = $comment['content'];
                        $comment_created = $comment['created_comment'];
                        ?>
                        <ul class="comment-reply list-unstyled">
                            <li class="row clearfix">
                                <div class="icon-box col-md-1 col-4">
                                    <svg data-jdenticon-value="<?= $comment_nickname ?>" width="40" height="40">
                                        Fallback text or image for browsers not supporting inline svg.
                                    </svg>
                                </div>
                                <div class="text-box col-md-10 col-8 p-l-0 p-r0">
                                    <h5>작성자 : <?= $comment_nickname ?></h5>
                                    <p>내용 : <?= $comment_content ?></p>
                                    <ul class="list-inline">
                                        <li><a href="javascript:void(0);"><?= $comment_created ?></a></li>
                                    </ul>
                                </div>
                            </li>
                            <?php } ?>
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
</div>


<?php include(sprintf("%s/fragments/bottom.html", $_SERVER['DOCUMENT_ROOT'])); ?>
