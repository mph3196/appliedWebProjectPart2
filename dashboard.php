<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// 2. Authorization Check: Must be logged in
if (!isset($_SESSION['name'])) {
    header('Location: login.php?error=Please log in to view your dashboard.');
    exit;
}

// 3. Role Check: If the user IS an admin, redirect them to their management page
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
    header('Location: manage.php');
    exit;
}

require_once "settings.php";

$currentPage = 'dashboard';
$pageTitle = 'JSM Dashboard Page';
$pageDescription = 'Dashboard page for users in JSM website';
$pageHeading = 'Dashboard';

include 'header.inc';
include 'nav.inc';
?>

<header style="display:flex; justify-content:space-between; align-items:center; background:#1976d2; color:white; padding:1em;">
    <h2 style="margin:0;">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
</header>

<div style="padding: 20px;">
    <h3><?php echo $pageHeading; ?></h3>
    <p><strong>This is the personalised dashboard for regular users. You can view your job application status</strong></p>
</div>

<?php include 'footer.inc'; ?>