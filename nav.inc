<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar">
    <a <?php if($currentPage == 'index') echo 'class="active"'; ?> href="index.php">
      <i class="fa fa-fw fa-home"></i> Home
    </a>
    <a <?php if($currentPage == 'jobs') echo 'class="active"'; ?> href="jobs.php">
      <i class="fa fa-fw fa-user"></i> Careers
    </a>
    <a <?php if($currentPage == 'apply') echo 'class="active"'; ?> href="apply.php">
      <i class="fa fa-fw fa-search"></i> Apply
    </a>
    <a <?php if($currentPage == 'about') echo 'class="active"'; ?> href="about.php">
      <i class="fa fa-fw fa-star"></i> About Us
    </a>
    <?php
    // Check if the user is logged in
    if (isset($_SESSION['username'])) { 
    ?>
    <!-- SHOW: Manage and Logout -->
        <a <?php if($currentPage == 'manage') echo 'class="active"'; ?> href="manage.php">
            <i class="fa fa-fw fa-tasks"></i> Manage
        </a>
        <a href="logout.php">
            <i class="fa fa-fw fa-sign-out"></i> Logout
        </a>
    <?php
    } else {
    ?>
    <!-- SHOW: Login -->
        <a <?php if($currentPage == 'login') echo 'class="active"'; ?> href="login.php">
            <i class="fa fa-fw fa-sign-in"></i> Login
        </a>
    <?php
    }
    ?>
  </nav>
</header>
