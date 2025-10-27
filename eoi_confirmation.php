<?php
session_start();

// Meta settings
$pageTitle = 'JSM University Confirm EOI';
$pageDescription = 'Confirmation of EOI';
$pageHeading = 'Confirmation of EOI';
$currentPage = 'home';

// Include site layout
include 'header.inc';
include 'nav.inc';

// Get the EOI number
$eoiNumber = isset($_SESSION['last_eoi']) ? $_SESSION['last_eoi'] : null;
?>

<div class="container">
    <h1>Application Submitted Successfully</h1>
    <?php if ($eoiNumber): ?>
        <p>Thank you for submitting your Expression of Interest. Your EOI number is: <strong><?php echo htmlspecialchars($eoiNumber); ?></strong>.</p>
    <?php else: ?>
        <p>Unable to display your EOI number. Please return to the dashboard.</p>
    <?php endif; ?>

    <p><a href="dashboard.php">Return to Dashboard</a></p>
</div>

<?php
// Clear session variable if it exists
if (isset($_SESSION['last_eoi'])) {
    unset($_SESSION['last_eoi']);
}
include 'footer.inc';
?>
