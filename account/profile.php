<?php
$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");
$nickname = $_COOKIE['id'];

/**
 * update로 넘어온 데이터
 */
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$occupation = $_POST['occupation'];
$intro = $_POST['intro'];

$update_sql = "update member set 
                        email='".$email."', 
                        phone_number='".$phone_number."', 
                        occupation='".$occupation."', 
                        intro='".$intro."' 
                        where nickname='".$nickname."'";

$member_sql = "select * from member 
                    where nickname='".$nickname."'";

mysqli_query($connect, $update_sql);
$result = mysqli_query($connect, $member_sql);
$row = mysqli_fetch_array($result);

require_once("../fragments/header.html");
require_once("../fragments/nav.php")
?>
<body class="container" style="background-color: aliceblue">
<div class="container" style="background-color: aliceblue">

    <div class="row about-container">
        <section class="py-5 my-5" style="background-color: aliceblue">
            <div class="container">
                <h1 class="mb-5">Account Settings</h1>
                <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                    <div class="profile-tab-nav border-right">
                        <div class="p-4">
                            <a class="item-img bg-white" href="../account/profile.php">
                                <svg src="../account/profile.php" data-jdenticon-value="<?= $nickname ?>" width="80"
                                     height="80">
                                    Fallback text or image for browsers not supporting inline svg.
                                </svg>
                            </a>
                            <h4 class="text-center"><?= $nickname ?></h4>
                        </div>
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                             aria-orientation="vertical">
                            <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account_tab"
                               role="tab"
                               aria-controls="account" aria-selected="true">
                                <i class="fa fa-home text-center mr-1"></i>
                                Account
                            </a>
                            <a class="nav-link" id="password-tab" data-toggle="pill" href="#password_tab" role="tab"
                               aria-controls="password" aria-selected="false">
                                <i class="fa fa-key text-center mr-1"></i>
                                Password
                            </a>
                        </div>
                    </div>
                    <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="account_tab" role="tabpanel"
                             aria-labelledby="account-tab">
                            <h3 class="mb-4">Account Settings</h3>
                            <form method="post" action="./profile.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input style="background-color: cornflowerblue" type="text"
                                                   class="form-control" name="nickname"
                                                   value=<?= $row['nickname'] ?> disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input style="background-color: cornflowerblue" type="text"
                                                   class="form-control" name="email"
                                                   value=<?= $row['email'] ?>>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone number</label>
                                            <input style="background-color: cornflowerblue" type="text"
                                                   class="form-control" name="phone_number"
                                                   value=<?= $row['phone_number'] ?>
                                                   placeholder="전화번호를 업데이트 입력해 주세요">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Occupation</label>
                                            <input style="background-color: cornflowerblue" type="text"
                                                   class="form-control" name="occupation"
                                                   value="value=<?= $row['occupation'] ?>"
                                                   placeholder="직업을 업데이트해주세요.">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Introduce</label>
                                            <textarea style="background-color: cornflowerblue" class="form-control"
                                                      name="intro" rows="4"><?= $row['intro'] ?> </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button class="btn btn-light">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="password_tab" role="tabpanel" aria-labelledby="password-tab">
                            <h3 class="mb-4">Password Settings</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Old password</label>
                                        <input style="background-color: cornflowerblue" type="password"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>New password</label>
                                        <input style="background-color: cornflowerblue" type="password"
                                               class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm new password</label>
                                        <input style="background-color: cornflowerblue" type="password"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary">Update</button>
                                <button class="btn btn-light">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <?php include(sprintf("%s/fragments/bottom.html", $_SERVER['DOCUMENT_ROOT'])); ?>
