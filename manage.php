<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Authorization Check: Must be logged in AND an Admin
// If not logged in OR not specifically marked as admin, redirect.
if (!isset($_SESSION['username']) || $_SESSION['is_admin'] !== true) {
    // Redirect non-admins or non-logged-in users
    header('Location: login.php?error=Access denied. Administrator privileges required.');
    exit;
}
require_once "settings.php";

$currentPage = 'manage';
$pageTitle = 'JSM Manage Page';
$pageDescription = 'Manage page for JSM website';
$pageHeading = 'Manage EOIs - HR Manager';

include 'header.inc';
include 'nav.inc';
?>

<header style="display:flex; justify-content:space-between; align-items:center; background:#1976d2; color:white; padding:1em;">
    <h2 style="margin:0;">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
</header>

<div style="padding: 20px;">
    <h3><?php echo $pageHeading; ?></h3>
    <p>This panel is for administrators to view and manage all Expressions of Interest (EOIs).</p>
    </div>

<?php include 'footer.inc'; ?>