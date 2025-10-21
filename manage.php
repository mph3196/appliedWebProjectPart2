<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'Admin') {
    header('Location: login.php?error=Access denied. Administrator privileges required.');
    exit;
}

$currentPage = 'manage';
$pageTitle = 'JSM Manage Page';
$pageDescription = 'Manage page for JSM website';
$pageHeading = 'Manage EOIs - HR Manager';

include 'header.inc';
include 'nav.inc';
?>
<header style="display:flex; justify-content:space-between; align-items:center; background:#1976d2; color:white; padding:1em;">
    <h2 style="margin:0;">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
</header>
<div style="padding: 20px;">
    <h3><?php echo $pageHeading; ?></h3>
    <p>This panel is for administrators to view and manage all Expressions of Interest (EOIs).</p>
    </div>
<?php
require_once "settings.php";
$dbconn = mysqli_connect($host, $user, $password, $database);
if (!$dbconn) {
    echo "<p>Unable to connect to the database.</p>";
    exit;
}
$query = "SELECT RefNo, ID, ApplyDate, FirstName, LastName, DOB, Gender, Address, Suburb, Email, PhoneNo, Skills, OtherSkills, Status FROM eoi";
$result = mysqli_query($dbconn, $query);
if (!$result) {
    echo "<p>Error in query: " . mysqli_error($dbconn) . "</p>";
}
if ($result && mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>RefNo</th><th>ID</th><th>ApplyDate</th><th>FirstName</th><th>LastName</th><th>DOB</th><th>Gender</th><th>Address</th><th>Suburb</th><th>Email</th><th>PhoneNo</th><th>Skills</th><th>OtherSkills</th><th>Status</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['RefNo'] . "</td>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['ApplyDate'] . "</td>";
            echo "<td>" . $row['FirstName'] . "</td>";
            echo "<td>" . $row['LastName'] . "</td>";
            echo "<td>" . $row['DOB'] . "</td>";
            echo "<td>" . $row['Gender'] . "</td>";
            echo "<td>" . $row['Address'] . "</td>";
            echo "<td>" . $row['Suburb'] . "</td>";
            echo "<td>" . $row['Email'] . "</td>";
            echo "<td>" . $row['PhoneNo'] . "</td>";
            echo "<td>" . $row['Skills'] . "</td>";
            echo "<td>" . $row['OtherSkills'] . "</td>";
            echo "<td>" . $row['Status'] . "</td>";
            echo "</tr>";
        }
    echo "</table>";
} else {
    echo "<p>There are no EOIs to display.</p>";
}
if ($result) {
    mysqli_free_result($result);
}
mysqli_close($dbconn);
?>

<?php include 'footer.inc'; ?>