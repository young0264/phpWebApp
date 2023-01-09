<?php $nickname = $_COOKIE['id']; ?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <a class="navbar-brand" href="../post/list.php">
        <img src="../images/logo.png"  width="100" height="60">
    </a>
    <div class="collapse navbar-collapse right-box" id="navbarSupportedContent">

        <a class="item-img bg-white" href="../account/profile.php">
            <svg  src="../account/profile.php" data-jdenticon-value="<?= $nickname ?>" width="80" height="80">Fallback text or image for browsers not supporting inline svg.
            </svg>
        </a>
    </div>
</nav>
