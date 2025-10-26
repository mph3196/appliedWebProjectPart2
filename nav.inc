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
    <?php if (!isset($_SESSION['username'])): ?>
        <a <?php if($currentPage == 'signup') echo 'class="active"'; ?> href="register.php">
          <i class="fa fa-fw fa-user-plus"></i> Sign up
        </a>
    <?php endif; ?>
    <?php
      if (isset($_SESSION['username'])) { 
        // 1. Check if the user is an Admin
        if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
      ?>
        <a <?php if(isset($currentPage) && $currentPage == 'manage') echo 'class="active"'; ?> href="manage.php">
            <i class="fa fa-fw fa-tasks"></i> Manage </a>
      <?php
        // 2. Check if the user is a Regular User
        } else {
      ?>
        <a <?php if(isset($currentPage) && $currentPage == 'dashboard') echo 'class="active"'; ?> href="dashboard.php">
            <i class="fa fa-fw fa-tachometer"></i> Dashboard
        </a>
      <?php
        }
      ?>
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
