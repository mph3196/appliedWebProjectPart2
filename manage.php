<?php

$currentPage = 'manage';
$pageTitle = 'JSM Management Page';
$pageDescription = 'Careers page for JSM website';
$pageHeading = 'Careers - Positions Available';

include 'header.inc';
include 'nav.inc';
?>

<?php
    // Include database settings
    require_once 'settings.php';
    // Create connection
    $conn = new mysqli($host, $user, $pwd, $sql_db);
    // Check connection
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['model'])) {
    $model = mysqli_real_escape_string($conn, $_GET['model']);
    $sql = "SELECT * FROM cars WHERE model LIKE '%$model%'";
    $result = mysqli_query($conn, $sql);
}

?>