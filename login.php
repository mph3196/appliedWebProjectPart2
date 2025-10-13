<?php
$currentPage = 'Login';
$pageTitle = 'JSM Login Page';
$pageDescription = 'Login page for JSM University';
$pageHeading = 'Login';

include 'header.inc';
include 'nav.inc';
?>
<?php include("header.inc"); ?>

<form method="post" action="process.php">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="hidden" name="token" value="s105920789">
    <input type="submit" value="Login">
</form>

<?php include("footer.inc"); ?>