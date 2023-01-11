<?php

$connect = mysqli_connect("localhost", "root", "7pifz9!!", "loginexam") or die("fail");
$nickname = $_COOKIE['id'];
$query = "select * from member where nickname='$nickname'";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);
require_once("../fragments/header.html");
require_once("../fragments/nav.php")
?>
<body>
<section class="py-5 my-5" style="background-color: aliceblue">
    <div class="container" >
        <h1 class="mb-5">Account Settings</h1>
        <div class="bg-white shadow rounded-lg d-block d-sm-flex" >
            <div class="profile-tab-nav border-right">
                <div class="p-4">
                    <a class="item-img bg-white" href="../account/profile.php">
                        <svg src="../account/profile.php" data-jdenticon-value="<?= $nickname ?>" width="80" height="80">
                            Fallback text or image for browsers not supporting inline svg.
                        </svg>
                    </a>
                    <h4 class="text-center"><?= $nickname ?></h4>

                </div>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                        <i class="fa fa-home text-center mr-1"></i>
                        Account
                    </a>
                    <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                        <i class="fa fa-key text-center mr-1"></i>
                        Password
                    </a>
                </div>
            </div>
            <div class="tab-content p-4 p-md-5" id="v-pills-tabContent" >
                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab" >
                    <h3 class="mb-4">Account Settings</h3>
                    <div class="row">
                        <div class="col-md-6" >
                            <div class="form-group" >
                                <label>Name</label>
                                <input style="background-color: dodgerblue" type="text" class="form-control" value=<?=$row['nickname']?>>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input style="background-color: dodgerblue" type="text" class="form-control"  value=<?=$row['email']?>>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone number</label>
                                <input style="background-color: dodgerblue" type="text" class="form-control" value="+91 9876543215">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Occupation</label>
                                <input style="background-color: dodgerblue" type="text" class="form-control" value="UI Developer">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bio</label>
                                <textarea style="background-color: dodgerblue" class="form-control" rows="4" ><?=$row['intro']?> </textarea>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                    <h3 class="mb-4">Password Settings</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Old password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>New password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm new password</label>
                                <input type="password" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                    <h3 class="mb-4">Security Settings</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Login</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Two-factor auth</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="recovery">
                                    <label class="form-check-label" for="recovery">
                                        Recovery
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="application" role="tabpanel" aria-labelledby="application-tab">
                    <h3 class="mb-4">Application Settings</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="app-check">
                                    <label class="form-check-label" for="app-check">
                                        App check
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" >
                                    <label class="form-check-label" for="defaultCheck2">
                                        Lorem ipsum dolor sit.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-light">Cancel</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
                    <h3 class="mb-4">Notification Settings</h3>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="notification1">
                            <label class="form-check-label" for="notification1">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum accusantium accusamus, neque cupiditate quis
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="notification2" >
                            <label class="form-check-label" for="notification2">
                                hic nesciunt repellat perferendis voluptatum totam porro eligendi.
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="notification3" >
                            <label class="form-check-label" for="notification3">
                                commodi fugiat molestiae tempora corporis. Sed dignissimos suscipit
                            </label>
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


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<?php include(sprintf("%s/fragments/bottom.html", $_SERVER['DOCUMENT_ROOT'])); ?>