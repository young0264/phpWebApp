<?php

$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");
$nickname = $_COOKIE['id'];
$query = "select * from member where nickname=$nickname";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);


?>
<!DOCTYPE html>
<html lang="en">
<?php require_once("../fragments/header.html"); ?>
<body class="bg-light">
<?php require_once("../fragments/nav.php"); ?>

<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-2" class="collapse navbar-collapse right-box" id="navbarSupportedContent">
            <!-- Avatar -->
            <a class="item-img bg-white" href="../account/profile.php">
                <svg src="../account/profile.php" data-jdenticon-value="<?= $nickname ?>" width="80" height="80">
                    Fallback text or image for browsers not supporting inline svg.
                </svg>
            </a>
        </div>


    </div>
    <div class="row mt-3 justify-content-center">
        id : <?= $nickname ?>
    </div>

    <div class="row mt-3 justify-content-center">
        <div class="col-2">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-intro-tab" data-toggle="pill" href="#v-pills-profile"
                   role="tab" aria-controls="v-pills-profile" aria-selected="true">소개</a>
            </div>
        </div>
        <div class="col-8">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                     aria-labelledby="v-pills-home-tab">
                    <div class="col-8">
                        <?php
                        if (!$row['intro']) {
                            echo "한 줄 소개를 추가하세요.";
                        }
                        ?>
                        <p>
                        <h5>이메일 : <?= $row['email'] ?></h5>
                        <h5>자기소개 : <?= $row['intro'] ?></h5>
                        </p>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-study" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    Study
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
