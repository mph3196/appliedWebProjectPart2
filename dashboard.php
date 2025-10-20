<?php
// Used GPT 5 to develop the dashboard page

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['name'])) {
    header('Location: login.php?error=Please log in to view your dashboard.');
    exit;
}
// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    session_unset();
    session_destroy();
    header('Location: login.php?error=' . urlencode('Please log in to access the dashboard.'));
    exit;
}

// Set identifier from session (assuming 'name' is unique enough to filter)
$user_identifier = $_SESSION['name']; 
$filter_column = 'FirstName';

require_once "settings.php";

$currentPage = 'dashboard';
$pageTitle = 'JSM Dashboard Page';
$pageDescription = 'Dashboard page for users in JSM website';
$pageHeading = 'Your Application Dashboard';

include 'header.inc';
include 'nav.inc';

// Connect to the database
$dbconn = mysqli_connect($host, $user, $password, $database);
if (!$dbconn) {
    die("<div style='padding: 20px;'><p style='color: red;'>Database connection error: " . mysqli_connect_error() . "</p></div>");
}

// Query to fetch current user's EOIs
$safe_identifier = mysqli_real_escape_string($dbconn, $user_identifier);

$query = "SELECT RefNo, ApplyDate, FirstName, LastName, Skills, OtherSkills, Status 
          FROM eoi 
          WHERE $filter_column = '$safe_identifier'  
          ORDER BY ApplyDate DESC";
          
$result = mysqli_query($dbconn, $query);

if (!$result) {
    $error = "Error fetching applications: " . mysqli_error($dbconn);
}
?>

<style>
    .user-header {
        background: #1976d2;
        color: white;
        padding: 1em 20px; 
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .content-area {
        padding: 20px;
        max-width: 1000px;
        margin: 0 auto;
    }
    .table-responsive {
        overflow-x: auto;
        margin-top: 20px;
    }
    .eoi-table {
        width: 100%;
        min-width: 700px; 
        border-collapse: collapse;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .eoi-table th, .eoi-table td {
        border: 1px solid #ddd;
        padding: 12px 15px;
        text-align: left;
    }
    .eoi-table th {
        background-color: #f2f2f2;
        color: #333;
        font-weight: bold;
    }
    .eoi-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .eoi-table tr:hover {
        background-color: #f0f8ff;
    }
    .status-new {
        background-color: #ffe0b2; 
        color: #e65100;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: bold;
    }
    .status-current {
        background-color: #bbdefb; 
        color: #1565c0;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: bold;
    }
    .status-final {
        background-color: #c8e6c9; 
        color: #2e7d32;
        padding: 4px 8px;
        border-radius: 4px;
        font-weight: bold;
    }
</style>

<header class="user-header">
    <h2 style="margin:0;">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
</header>

<div class="content-area">
    <h3><?php echo $pageHeading; ?></h3>
    <p><strong>This is your personalised dashboard. You can view the status of all your submitted Expressions of Interest (EOIs) below.</strong></p>

    <?php if (isset($error)): ?>
        <p style='color: red;'>Error: <?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <h4>Your Submitted Applications</h4>
        
        <div class="table-responsive">
            <table class="eoi-table">
                <thead>
                    <tr>
                        <th>Job RefNo</th>
                        <th>Applied Date</th>
                        <th>Applicant Name</th>
                        <th>Skills</th>
                        <th>Other Skills</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): 
                        $status_class = strtolower($row['Status']);
                        $status_class = "status-" . ($status_class === 'new' ? 'new' : ($status_class === 'current' ? 'current' : 'final'));
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['RefNo']); ?></td>
                            <td><?php echo htmlspecialchars($row['ApplyDate']); ?></td>
                            <td><?php echo htmlspecialchars($row['FirstName']) . ' ' . htmlspecialchars($row['LastName']); ?></td>
                            <td><?php echo htmlspecialchars($row['Skills']); ?></td>
                            <td><?php echo htmlspecialchars($row['OtherSkills']); ?></td>
                            <td><span class="<?php echo $status_class; ?>"><?php echo htmlspecialchars($row['Status']); ?></span></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p>You currently have no Expressions of Interest (EOIs) to display.</p>
        <p>Ready to apply for a job? Check out our <a href="jobs.php">Job Vacancies page</a>.</p>
    <?php endif; ?>

    <?php 
    if ($result) {
        mysqli_free_result($result);
    }
    mysqli_close($dbconn);
    ?>
</div>

<?php include 'footer.inc'; ?>