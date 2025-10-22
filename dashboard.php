<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//Authorization Check: Must be logged in
if (!isset($_SESSION['name'])) {
    header('Location: login.php?error=Please log in to view your dashboard.');
    exit;
}
// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    session_unset();
    session_destroy();
    header('Location: login.php?error=Please log in to access the dashboard.');
    exit;
}

$currentPage = 'dashboard';
$pageTitle = 'JSM Dashboard Page';
$pageDescription = 'Dashboard page for users in JSM website';
$pageHeading = 'Your Application Dashboard';

include 'header.inc';
include 'nav.inc';

require_once "settings.php";
// Connect to the database
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("<div style='padding: 20px;'><p style='color: red;'>Database connection error: " . mysqli_connect_error() . "</p></div>");
}
?>

<header style="display:flex; justify-content:space-between; align-items:center; background:#1976d2; color:white; padding:1em;">
    <h2 style="margin:0;">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
</header>

<div style="padding: 20px;">
    <h3><?php echo $pageHeading; ?></h3>
    <p><strong>This is your personalised dashboard. You can view the status of all your submitted Expressions of Interest (EOIs) below.</strong></p>
</div>

<?php include 'footer.inc'; ?>