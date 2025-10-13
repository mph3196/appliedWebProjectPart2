<?php
    require_once "settings.php";
?>

<?php
$currentPage = 'Manage';
$pageTitle = 'JSM Manage Page';
$pageDescription = 'Manage page for JSM website';
$pageHeading = 'Manage EOIs - HR Manager';
include 'header.inc';
include 'nav.inc';
?>

<!-- Used Gen AI to help with styling and layout of this page -->
<header style="display:flex; justify-content:space-between; align-items:center; background:#1976d2; color:white; padding:1em;">
    <h2 style="margin:0;">Welcome, Admin</h2>
    <a href="logout.php" style="
        background:white;
        color:#1976d2;
        padding:0.5em 1em;
        border-radius:6px;
        text-decoration:none;
        font-weight:bold;
    ">Logout</a>
</header>

<?php

?>
<?php include 'footer.inc'; ?>