<?php $nickname = $_COOKIE['id']; ?>
<!--container d-flex justify-content-between align-items-center-->
<link href="../static/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="../static/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="../static/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700"
      rel="stylesheet">

<div class="container" style="background-color: #2b2b2b">
    <div style="margin-left: 200px; background-color: #2b2b2b">
        <nav class="navbar navbar-expand-sm">
            <a class="navbar-brand" href="../post/list.php">
                <img src="../static/images/logo.png" width="100" height="60">
            </a>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link scrollto active" href="../main/mainpage.html">Main</a></li>
            </ul>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link scrollto active" href="../account/profile.php">Profile</a></li>
            </ul>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link scrollto active" href="../post/list.php">Post List</a></li>
            </ul>
            <ul class="nav">
                <li class="nav-item">
                    <?php if(isset($_COOKIE['id'])) { ?>
                        <a class="nav-link scrollto active"
                           href="../account/logout.php" <?php unset($_COOKIE[$nickname]); ?>><?php echo $nickname ?>
                            로그아웃</a>
                    <?php } else { ?>
                        <a class="nav-link scrollto active"
                           href="../account/login.html" <?php unset($_COOKIE[$nickname]); ?>><?php echo $nickname ?>
                            로그인
                        </a>
                    <?php } ?>
                </li>
            </ul>
            <div class="collapse navbar-collapse right-box " id="navbarSupportedContent">
                <a class=" bg-white nav-link">
                    <svg src="../account/profile.php" data-jdenticon-value="<?= $nickname ?>" width="80" height="80">
                        Fallback text or image for browsers not supporting inline svg.
                    </svg>
                </a>
            </div>
        </nav>
    </div>
</div>
