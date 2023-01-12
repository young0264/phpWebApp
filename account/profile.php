<?php
$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");
$nickname = $_COOKIE['id'];
$flag = $_POST['flag'];

/**
 * update로 넘어온 데이터
 */
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$occupation = $_POST['occupation'];
$intro = $_POST['intro'];
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_new_password = $_POST['confirm_new_password'];


$update_sql = "update member set 
                        email='" . $email . "', 
                        phone_number='" . $phone_number . "', 
                        occupation='" . $occupation . "', 
                        intro='" . $intro . "' 
                        where nickname='" . $nickname . "'";

$member_sql = "select * from member 
                    where nickname='" . $nickname . "'";

mysqli_query($connect, $update_sql);
$result = mysqli_query($connect, $member_sql);
$row = mysqli_fetch_array($result);
if ($flag == 1) {
    if ($row['password'] == $old_password) {
        if ($new_password == $confirm_new_password) {
            $update_password_sql = "update member set password='" . $new_password . "' where nickname='" . $nickname . "' ";
            mysqli_query($connect, $update_password_sql);
            echo "<script> alert('비밀번호가 변경되었습니다.') </script>";

        } else {
            echo "<script> alert('입력하신 new password가 서로 다릅니다') </script>";
        }
    } else {
        echo "<script> alert('입력하신 old password가 다릅니다') </script>";
    }
}

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
                            <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account_tab" role="tab"
                               aria-controls="account" aria-selected="true">
                                <i class="fa fa-home text-center mr-1"></i>
                                Account
                            </a>
                            <a class="nav-link" id="password-tab" data-toggle="pill" href="#password_tab" role="tab"
                               aria-controls="password" aria-selected="false">
                                <i class="fa fa-key text-center mr-1"></i>
                                Password
                            </a>
                            <a class="nav-link" id="download-tab" data-toggle="pill" href="#download_tab" role="tab"
                               aria-controls="download" aria-selected="false">
                                <i class="fa fa-file-excel-o"></i>
                                download
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
                                                   value="<?= $row['phone_number'] ?>"
                                                   placeholder="전화번호를 업데이트 입력해 주세요">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Occupation</label>
                                            <input style="background-color: cornflowerblue" type="text"
                                                   class="form-control" name="occupation"
                                                   value="<?= $row['occupation'] ?>"
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
                                    <input type="hidden" name="flag" value=0/>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button class="btn btn-light">Cancel</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="password_tab" role="tabpanel" aria-labelledby="password-tab">
                            <form action="./profile.php" method="post">
                                <h3 class="mb-4">Password Settings</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Old password</label>
                                            <input name="old_password" style="background-color: cornflowerblue"
                                                   type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>New password</label>
                                            <input name="new_password" style="background-color: cornflowerblue"
                                                   type="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm new password</label>
                                            <input name="confirm_new_password" style="background-color: cornflowerblue"
                                                   type="password" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <input type="hidden" name="flag" value=1>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <button class="btn btn-light">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="download_tab" role="tabpanel" aria-labelledby="download-tab">
                                <h3 class="mb-4">Excel File Download</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>작성한 게시글</label>
                                            <a class="btn btn-primary" href="../file/my_post_down.php">다운로드</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</body>

<?php include(sprintf("%s/fragments/bottom.html", $_SERVER['DOCUMENT_ROOT'])); ?>
