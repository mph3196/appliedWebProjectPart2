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
  </nav>
</header>