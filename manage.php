<?php
// Check if a PHP session has not been started yet
if (session_status() == PHP_SESSION_NONE) {
    // Start a new session if no session exists
    session_start();
}

// Verify if user is logged in and has exactly 'Admin' username
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'Admin') {
    // Redirect unauthorized users to login page with access denied error
    header('Location: login.php?error=Access denied. Administrator privileges required.');
    // Stop script execution after redirect
    exit;
}

// Include database connection settings file
require_once "settings.php";
// Establish connection to MySQL database using settings
$conn = mysqli_connect($host, $user, $password, $database);
// Check if database connection failed
if (!$conn) {
    // Display error message if connection fails
    echo "<p>Unable to connect to the database.</p>";
    // Stop script execution if no database connection
    exit;
}

// Handle First Name Search functionality
if (
    // Check if user is logged in as Admin
    isset($_SESSION['username']) &&
    $_SESSION['username'] === 'Admin' &&
    // Verify request method is GET
    $_SERVER['REQUEST_METHOD'] === 'GET' &&
    // Check if search action is specified for first name
    isset($_GET['action']) && $_GET['action'] === 'search_firstname'
) {
    // Get first name search term from GET parameters with null coalescing as fallback
    $firstname = ($_GET['search_firstname'] ?? '');
    
    // Check if search term is not empty
    if (!empty($firstname)) {
        // Store search term in session for persistence
        $_SESSION['search_firstname'] = $firstname;
    } else {
        // Remove search term from session if empty
        unset($_SESSION['search_firstname']);
    }
    
    // Redirect back to current page to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    // Stop script execution after redirect
    exit;
}

// Handle Last Name Search functionality
if (
    // Check if user is logged in as Admin
    isset($_SESSION['username']) &&
    $_SESSION['username'] === 'Admin' &&
    // Verify request method is GET
    $_SERVER['REQUEST_METHOD'] === 'GET' &&
    // Check if search action is specified for last name
    isset($_GET['action']) && $_GET['action'] === 'search_lastname'
) {
    // Get last name search term from GET parameters with null coalescing as fallback
    $lastname = ($_GET['search_lastname'] ?? '');
    
    // Check if search term is not empty
    if (!empty($lastname)) {
        // Store search term in session for persistence
        $_SESSION['search_lastname'] = $lastname;
    } else {
        // Remove search term from session if empty
        unset($_SESSION['search_lastname']);
    }
    
    // Redirect back to current page to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    // Stop script execution after redirect
    exit;
}

// Handle Reference Number Search functionality
if (
    // Check if user is logged in as Admin
    isset($_SESSION['username']) &&
    $_SESSION['username'] === 'Admin' &&
    // Verify request method is GET
    $_SERVER['REQUEST_METHOD'] === 'GET' &&
    // Check if search action is specified for reference number
    isset($_GET['action']) && $_GET['action'] === 'search_refno'
) {
    // Get reference number search term from GET parameters with null coalescing as fallback
    $refno = ($_GET['search_refno'] ?? '');
    
    // Check if search term is not empty
    if (!empty($refno)) {
        // Store search term in session for persistence
        $_SESSION['search_refno'] = $refno;
    } else {
        // Remove search term from session if empty
        unset($_SESSION['search_refno']);
    }
    
    // Redirect back to current page to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    // Stop script execution after redirect
    exit;
}

// Handle Sort functionality for table columns
if (
    // Check if user is logged in as Admin
    isset($_SESSION['username']) &&
    $_SESSION['username'] === 'Admin' &&
    // Verify request method is GET
    $_SERVER['REQUEST_METHOD'] === 'GET' &&
    // Check if sort action is specified
    isset($_GET['action']) && $_GET['action'] === 'sort'
) {
    // Get sort field from GET parameters, default to 'RefNo' if not specified
    $sort_field = ($_GET['sort_field'] ?? 'RefNo');
    
    // Check if sort field is not empty
    if (!empty($sort_field)) {
        // Store sort preference in session for persistence
        $_SESSION['sort_field'] = $sort_field;
    }
    
    // Redirect back to current page to apply sorting
    header("Location: " . $_SERVER['PHP_SELF']);
    // Stop script execution after redirect
    exit;
}

// Handle Clear Search functionality
if (
    // Check if user is logged in as Admin
    isset($_SESSION['username']) &&
    $_SESSION['username'] === 'Admin' &&
    // Verify request method is GET
    $_SERVER['REQUEST_METHOD'] === 'GET' &&
    // Check if clear search action is specified
    isset($_GET['action']) && $_GET['action'] === 'clear_search'
) {
    // Remove first name search filter from session
    unset($_SESSION['search_firstname']);
    // Remove last name search filter from session
    unset($_SESSION['search_lastname']);
    // Remove reference number search filter from session
    unset($_SESSION['search_refno']);
    
    // Redirect back to current page with cleared searches
    header("Location: " . $_SERVER['PHP_SELF']);
    // Stop script execution after redirect
    exit;
}

// Handle Delete EOI by Reference Number functionality
if (
    // Check if user is logged in as Admin
    isset($_SESSION['username']) &&
    $_SESSION['username'] === 'Admin' &&
    // Verify request method is POST
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    // Check if delete action is specified
    isset($_POST['action']) && $_POST['action'] === 'delete_by_refno'
) {
    // Get reference number to delete from POST data
    $refDelete = ($_POST['ref_delete'] ?? '');
    // Set default message class to error (will change to success if operation succeeds)
    $messageClass = 'error';

    // Check if reference number is provided
    if (!empty($refDelete)) {
        // Prepare parameterized SQL statement to prevent SQL injection
        $stmt = mysqli_prepare($conn, "DELETE FROM eoi WHERE RefNo=?");
        // Bind the reference number parameter to the prepared statement
        mysqli_stmt_bind_param($stmt, "s", $refDelete); 
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
        // Check if any rows were affected (deleted)
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Set success message if deletion was successful
            $_SESSION['message'] = "EOI with Reference Number **$refDelete** deleted successfully.";
            // Change message class to success for green styling
            $messageClass = 'success';
        } else {
            // Set error message if no EOI was found with that reference number
            $_SESSION['message'] = "Error: EOI with Reference Number **$refDelete** not found.";
        }
        // Close the prepared statement to free resources
        mysqli_stmt_close($stmt);
    } else {
        // Set error message if reference number was empty
        $_SESSION['message'] = "Error: Please provide a valid Reference Number for deletion.";
    }
    // Store message class in session for styling after redirect
    $_SESSION['message_class'] = $messageClass;
    // Redirect back to current page to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    // Stop script execution after redirect
    exit;
}

// Handle Status Update by Reference Number functionality
if (
    // Check if user is logged in as Admin
    isset($_SESSION['username']) &&
    $_SESSION['username'] === 'Admin' &&
    // Verify request method is POST
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    // Check if update status action is specified
    isset($_POST['action']) && $_POST['action'] === 'update_status'
) {
    // Get reference number from POST data
    $refNo = $_POST['refno'] ?? '';
    // Get new status value from POST data
    $status = $_POST['status'] ?? '';
    // Set default message class to error
    $messageClass = 'error';

    // Validate that reference number is provided and status is valid
    if (!empty($refNo) && in_array($status, ['New','Current','Final'], true)) {
        // Prepare parameterized SQL statement to update status
        $stmt = mysqli_prepare($conn, "UPDATE eoi SET status=? WHERE RefNo=?");
        // Bind parameters to the prepared statement (both strings)
        mysqli_stmt_bind_param($stmt, "ss", $status, $refNo);
        // Execute the update statement
        mysqli_stmt_execute($stmt);

        // Check if any rows were affected (updated)
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Set success message if update was successful
            $_SESSION['message'] = "Status for EOI **$refNo** updated to **$status** successfully.";
            // Change message class to success for green styling
            $messageClass = 'success';
        } else {
            // Set error message if no EOI was found with that reference number
            $_SESSION['message'] = "Error: Status update failed for EOI **$refNo**.";
        }
        // Close the prepared statement to free resources
        mysqli_stmt_close($stmt);
    } else {
        // Set error message if validation failed
        $_SESSION['message'] = "Error: Invalid Reference Number or status provided.";
    }
    // Redirect back to current page to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    // Stop script execution after redirect
    exit;
}

// Display message box if there is a session message
if (isset($_SESSION['message'])) {
    // Get message class from session or default to 'success'
    $class = $_SESSION['message_class'] ?? 'success';
    // Remove markdown-style bold formatting from message
    $displayMessage = str_replace('**','', $_SESSION['message']); 

    // Output the message box with appropriate CSS class
    echo "<p class='message-box {$class}'>{$displayMessage}</p>";
    // Remove message from session after displaying to prevent re-display
    unset($_SESSION['message']);
    // Remove message class from session after displaying
    unset($_SESSION['message_class']);
}

// Set current page identifier for navigation highlighting
$currentPage = 'manage';
// Set page title for browser tab
$pageTitle = 'JSM Manage Page';
// Set page description for SEO
$pageDescription = 'Manage page for JSM website';
// Set page heading for content area
$pageHeading = 'Manage EOIs - HR Manager';

// Include header file for consistent page header
include 'header.inc';
// Include navigation file for consistent menu
include 'nav.inc';
?>

<!-- CSS Styles for the manage page, Produced by GenAI GPT5 -->
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f7f6;
        overflow-x: hidden;
    }
    .table-responsive {
        overflow-x: auto; 
        margin-top: 10px;
    }
    .eoi-table {
        width: 100%; 
        min-width: 1200px; 
        border-collapse: collapse;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .eoi-table th, .eoi-table td {
        border: 1px solid #ddd;
        padding: 12px 10px;
        text-align: left;
        font-size: 0.9em;
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
        display: flex;
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
    .delete-reference {
        border: 1px solid #f44336;
        padding: 15px;
        margin-bottom: 20px;
        background-color: #ffebee;
        border-radius: 5px;
    }
    .delete-reference label {
        font-weight: bold;
        color: #d32f2f;
    }
    .delete-reference input[type="text"] {
        padding: 8px;
        border: 1px solid #f44336;
        border-radius: 4px;
        min-width: 150px;
        margin: 0 10px;
    }
    .delete-reference input[type="submit"] {
        background-color: #f44336;
        padding: 8px 15px;
    }
    .delete-reference input[type="submit"]:hover {
        background-color: #d32f2f;
    }
    .search-form {
        border: 1px solid #1976d2;
        padding: 15px;
        margin-bottom: 20px;
        background-color: #e3f2fd;
        border-radius: 5px;
    }
    .search-form label {
        font-weight: bold;
        color: #233260ff;
    }
    .search-form input[type="text"] {
        padding: 8px 12px;
        border: 1px solid #1976d2;
        border-radius: 4px;
        min-width: 200px;
        margin: 0 10px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    .search-form input[type="text"]:focus {
        border-color: #4CAF50;
        box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        outline: none;
    }
    .search-form input[type="submit"] {
        background-color: #1976d2;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
        font-weight: bold;
    }
    .search-form input[type="submit"]:hover {
        background-color: #1565c0;
    }
    .message-box {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 4px;
    }
    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    .sort-section {
        margin-bottom: 10px;
        padding: 8px 0;
        background-color: transparent;
        display: inline-block;
    }
    .sort-section label {
        font-weight: bold;
        color: #233260ff;
        font-size: 0.9em;
        margin-right: 8px;
    }
    .sort-section select {
        padding: 6px 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin: 0 8px;
        font-size: 0.85em;
        min-width: 140px;
    }
    .sort-section input[type="submit"] {
        background-color: #233260ff;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.85em;
    }
    .sort-section input[type="submit"]:hover {
        background-color: #1a2747;
    }
    .clear-search {
        margin-bottom: 20px;
    }
    .clear-search input[type="submit"] {
        background-color: #ff9800;
        color: white;
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .clear-search input[type="submit"]:hover {
        background-color: #f57c00;
    }
</style>

<!-- Main content area of the page -->
<div class="content-area">
    <!-- Page header with welcome message -->
    <header style="display:flex; justify-content:space-between; align-items:center; background:#1976d2; color:white; padding:1em;">
        <h2 style="margin:0;">Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
    </header>
    <!-- Page introduction section -->
    <div style="padding-bottom: 20px;">
        <h3><?php echo $pageHeading; ?></h3>
        <p>This panel is for administrators to view and manage all Expressions of Interest (EOIs).</p>
    </div>

    <!-- Delete EOI by Reference Number Section -->
    <div class="delete-reference">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="refno_input">Delete EOI by Reference Number:</label>
            <input type="text" id="refno_input" name="ref_delete" placeholder="e.g., JSM001" required> 
            <input type="hidden" name="action" value="delete_by_refno"> 
            <input type="submit" value="Delete EOI">
        </form>
    </div>

    <!-- Search by Name Section -->
    <div class="search-form">
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="firstname_search">First Name:</label>
            <input type="text" name="search_firstname" id="firstname_search" placeholder="e.g. John"
            value="<?php echo isset($_SESSION['search_firstname']) ? htmlspecialchars($_SESSION['search_firstname']) : ''; ?>">
            <input type="hidden" name="action" value="search_firstname">

            <label for="lastname_search">Last Name:</label>
            <input type="text" name="search_lastname" id="lastname_search" placeholder="e.g. Doe" 
            value="<?php echo isset($_SESSION['search_lastname']) ? htmlspecialchars($_SESSION['search_lastname']) : ''; ?>">
            <input type="hidden" name="action" value="search_lastname">
            <input type="submit" value="Search">
        </form>
    </div>

    <!-- Search by Reference Number Section -->
    <div class="search-form">
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="refno_search">Reference Number:</label>
            <input type="text" name="search_refno" id="refno_search" placeholder="e.g. JSM001"
                   value="<?php echo isset($_SESSION['search_refno']) ? htmlspecialchars($_SESSION['search_refno']) : ''; ?>">
            <input type="hidden" name="action" value="search_refno">
            <input type="submit" value="Search">
        </form>
    </div>

    <!-- Clear All Searches Section -->
    <div class="clear-search">
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="hidden" name="action" value="clear_search">
            <input type="submit" value="Clear All Searches">
        </form>
    </div>

    <!-- Sort Results Section -->
    <div class="sort-section">
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <label for="sort_field">Sort By:</label>
            <select name="sort_field" id="sort_field">
                <option value="RefNo" <?php 
                    // Set 'selected' attribute if RefNo is current sort field
                    echo (isset($_SESSION['sort_field']) && $_SESSION['sort_field'] == 'RefNo') ? 'selected' : ''; ?>>EOI Reference
                </option>
                <option value="LastName" <?php 
                    // Set 'selected' attribute if LastName is current sort field
                    echo (isset($_SESSION['sort_field']) && $_SESSION['sort_field'] == 'LastName') ? 'selected' : ''; ?>>Applicant Last Name
                </option>
                <option value="Status" <?php 
                    // Set 'selected' attribute if Status is current sort field
                    echo (isset($_SESSION['sort_field']) && $_SESSION['sort_field'] == 'Status') ? 'selected' : ''; ?>>Status
                </option>
            </select>
            <input type="hidden" name="action" value="sort">
            <input type="submit" value="Sort">
        </form>
    </div>

<?php
// Build base SQL query to select all EOI records
$query = "SELECT * FROM eoi";
// Initialize array to store WHERE conditions
$where_conditions = [];

// Check if first name search filter is active in session
if (isset($_SESSION['search_firstname']) && !empty($_SESSION['search_firstname'])) {
    // Escape first name search term to prevent SQL injection
    $FirstName = mysqli_real_escape_string($conn, $_SESSION['search_firstname']);
    // Add LIKE condition for first name search
    $where_conditions[] = "FirstName LIKE '%$FirstName%'";
}

// Check if last name search filter is active in session
if (isset($_SESSION['search_lastname']) && !empty($_SESSION['search_lastname'])) {
    // Escape last name search term to prevent SQL injection
    $LastName = mysqli_real_escape_string($conn, $_SESSION['search_lastname']);
    // Add LIKE condition for last name search
    $where_conditions[] = "LastName LIKE '%$LastName%'";
}

// Check if reference number search filter is active in session
if (isset($_SESSION['search_refno']) && !empty($_SESSION['search_refno'])) {
    // Escape reference number search term to prevent SQL injection
    $RefNo = mysqli_real_escape_string($conn, $_SESSION['search_refno']);
    // Add LIKE condition for reference number search
    $where_conditions[] = "RefNo LIKE '%$RefNo%'";
}

// Check if any search conditions were added
if (!empty($where_conditions)) {
    // Append WHERE clause with all conditions joined by AND
    $query .= " WHERE " . implode(" AND ", $where_conditions);
}

// Get sort field from session or default to 'RefNo'
$sortField = isset($_SESSION['sort_field']) ? $_SESSION['sort_field'] : 'RefNo';
// Append ORDER BY clause to SQL query
$query .= " ORDER BY $sortField";

// Execute the SQL query against the database
$result = mysqli_query($conn, $query);

// Check if query execution failed
if (!$result) {
    // Display database error message
    echo "<p>Error in query: " . mysqli_error($conn) . "</p>";
}

// Check if query returned any rows
if ($result && mysqli_num_rows($result) > 0) {
    // Start responsive table container
    echo "<div class='table-responsive'>";
    // Start EOI table with headers
    echo "<table class='eoi-table'>";
    // Output table header row with column names
    echo "<tr><th>RefNo</th><th>ID</th><th>ApplyDate</th><th>FirstName</th><th>LastName</th><th>DOB</th><th>Gender</th><th>Address</th><th>Suburb</th><th>Email</th><th>Phone.No</th><th>Skills</th><th>Other Skills</th><th>Status</th></tr>";
    
    // Loop through each row in the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Start table row for current EOI record
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['RefNo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ID']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ApplyDate']) . "</td>";
        echo "<td>" . htmlspecialchars($row['FirstName']) . "</td>";
        echo "<td>" . htmlspecialchars($row['LastName']) . "</td>";
        echo "<td>" . htmlspecialchars($row['DOB']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Gender']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Suburb']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['PhoneNo']) . "</td>";
        echo "<td>" . htmlspecialchars($row['Skills']) . "</td>";
        echo "<td>" . htmlspecialchars($row['OtherSkills']) . "</td>";
        // Start Status cell which contains the update form
        echo "<td>";
        // Get current status value for this row and escape for output
        $currentStatus = htmlspecialchars($row['Status'] ?? '');
        // Start form for status update with POST method
        echo '<form method="post" action="' . htmlspecialchars($_SERVER['PHP_SELF']). '" class="status-form">';
        // Hidden input to pass reference number for identification
        echo '<input type="hidden" name="refno" value="' . htmlspecialchars($row['RefNo']) . '">';
        // Hidden input to specify the action type
        echo '<input type="hidden" name="action" value="update_status">';
        // Start status selection dropdown
        echo '<select name="status">';
        // Option for New status, selected if current status is New
        echo '<option value="New"' . ($currentStatus == 'New' ? ' selected' : '') . '>New</option>';
        // Option for Current status, selected if current status is Current
        echo '<option value="Current"' . ($currentStatus == 'Current' ? ' selected' : '') . '>Current</option>';
        // Option for Final status, selected if current status is Final
        echo '<option value="Final"' . ($currentStatus == 'Final' ? ' selected' : '') . '>Final</option>';
        // Close status selection dropdown
        echo '</select>';
        // Submit button to save status changes
        echo '<input type="submit" value="Save">';
        // Close the status update form
        echo '</form>';
        // Close the Status cell
        echo "</td>";
        // Close the table row
        echo "</tr>";
    }
    // Close the EOI table
    echo "</table>";
    // Close the responsive table container
    echo "</div>";
} else {
    // Display message when no EOIs are found
    echo "<p>There are no EOIs to display.</p>";
}

// Free the result set memory if result exists
if ($result) {
    mysqli_free_result($result);
}
// Close the database connection
mysqli_close($conn);
?>

</div>
<!-- Include footer file for consistent page footer -->
<?php include 'footer.inc'; ?>