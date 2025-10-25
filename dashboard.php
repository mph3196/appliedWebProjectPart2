<?php

//Checks whether a session has been started
if (session_status() == PHP_SESSION_NONE) {
    //starts a session if none
    session_start();
}
//Authorization Check: Must be logged in
if (!isset($_SESSION['name'])) {
    //if not set, redirects user to the login page
    header('Location: login.php?error=Please log in to view your dashboard.');
    exit;
}
// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    //if it fials, clears the session
    session_unset();
    //destroys the session
    session_destroy();
    //redirected to login page with error message
    header('Location: login.php?error=Please log in to access the dashboard.');
    exit;
}

$currentPage = 'dashboard';
$pageTitle = 'JSM Dashboard Page';
$pageDescription = 'Dashboard page for users in JSM website';
$pageHeading = 'Your Application Dashboard';

include 'header.inc';
include 'nav.inc';


//database settings file
require_once "settings.php";
// Connect to the database with settings content
$conn = mysqli_connect($host, $user, $password, $database);
//checks whether the database connection was successful
if (!$conn) {
    //if the connection failed an error message is displayed
    die("<div style='padding: 20px;'><p style='color: red;'>Database connection error: " . mysqli_connect_error() . "</p></div>");
}

$user_id = $_SESSION['user_id'];

$query = "SELECT RefNo, ApplyDate, FirstName, LastName, Skills, OtherSkills, Status 
          FROM eoi 
          WHERE ID = $user_id
          ORDER BY ApplyDate DESC";

$result = mysqli_query($conn, $query);
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7f6;
        overflow-x: hidden; /* <---  PREVENT FULL-PAGE SCROLL */
        }
    .table-responsive {
        /* THIS PROPERTY enables horizontal sliding/scrolling */
        overflow-x: auto; 
        margin-top: 20px;
    }
    .eoi-table {
        /* width: 100% ensures it fills the container up to max-width */
        width: 100%; 
        /* min-width forces a scrollbar if the screen is smaller than this width */
        max-width: 120px; 
        border-collapse: collapse;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .eoi-table th, .eoi-table td {
        border: 1px solid #ddd;
        padding: 12px 10px;
        text-align: left;
        font-size: 0.9em;
        /* white-space: nowrap keeps all cells on one line, enforcing the scroll */
        white-space: nowrap; 
    }
    .eoi-table th {
        background-color: #233260ff;
        color: #ffffffff;
        font-weight: bold;
        text-transform: uppercase;
    }
    .eoi-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .eoi-table tr:hover {
        background-color: #f0f8ff;
    }
    .status-form {
        align-items: center;
        gap: 5px;
    }
    select {
        padding: 6px;
        border: 1px solid #ccc;
        border-radius: 4px;
        min-width: 100px;
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
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

<header style="display:flex; justify-content:space-between; align-items:center; background:#1976d2; color:white; padding:1em;">
    <h2 style="margin:0;">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
</header>

<div style="padding: 20px;">
    <h3><?php echo $pageHeading; ?></h3>
    <p><strong>This is your personalised dashboard. You can view the status of all your submitted Expressions of Interest (EOIs) below.</strong></p>
</div>
    
<?php
// Checks if the query execution failed
if (!$result) {
    // If query fauled, error is displayed
    echo "<p>Error in query: " . mysqli_error($conn) . "</p>";
}

// Checks if query was successful and atleast returned one row of data 
if ($result && mysqli_num_rows($result) > 0) {
        // Table Responsive class
        echo "<div class='table-responsive'>";
        // EOI table class
        echo "<table class='eoi-table'>";
        // Table header row with its column names
        echo "<tr><th>RefNo</th><th>ApplyDate</th><th>FirstName</th><th>LastName</th><th>Skills</th><th>Other Skills</th><th>Status</th></tr>";
        // Loop each row of the query result
        while ($row = mysqli_fetch_assoc($result)) {
            $status_class = strtolower(str_replace(' ', '-', $row['Status']));
            $status_class = "status-" . ($status_class === 'new' ? 'new' : ($status_class === 'current' ? 'current' : 'final'));
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['RefNo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ApplyDate']) . "</td>";
            echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Skills']) . "</td>";
            echo "<td>" . htmlspecialchars($row['OtherSkills']) . "</td>";
            echo "<td><span class='" . $status_class . "'>" . htmlspecialchars($row['Status']) . "</span></td>";
            echo "</tr>";
        }
   echo "</table></div>";
    } else {
    //if there are no EOIs found by the user
    echo "<p>You currently have no Expressions of Interest (EOIs) to display.</p>";
    echo "<p>Ready to apply for a job? Check out our Job Vacancies page</a>.</p>";
}

// If the query was successful (returned the list of data)
if ($result) {
    // Comoputer memory free up that was used to hold the list of EOIs
    mysqli_free_result($result);
}
// Close the datatbase connection
mysqli_close($conn);
?>
<?php include 'footer.inc'; ?>