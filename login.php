<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$currentPage = 'Login';
$pageTitle = 'JSM Login Page';
$pageDescription = 'Login page for JSM website';
$pageHeading = 'Login';

// includes settings file
require "settings.php";
// Disable MySQLi exceptions
mysqli_report(MYSQLI_REPORT_OFF);
// Establish connection to MySQL database
$conn = @mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    echo "<div class='container'>";
    echo "<h1>Database Connection Error</h1>";
    echo "<p>Sorry, we are unable to retrieve the login page. Please try again later.</p>";
    echo "<p>Debug info: " . mysqli_connect_error() . "</p>";
    include 'footer.inc';
    exit;
}

// Checks if the connection failed
if (!$conn) {
    // If connection failed displays error messgae
    $conn_error = "Unable to connect to the database.";
}

// Handle login attempt by form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // If there is a database connection error
    if (isset($conn_error)) {
        // Redirects the user to login page with error message
        header('Location: login.php?error=Database connection error. Please try again later.');
        exit;
    }
    
    // Gets the username input
    $username = trim($_POST['username']);
    // Gets the password input
    $password_input = $_POST['password'];
    // Escape special characters in the username to prevent simple SQL Injection
    $safe_username = mysqli_real_escape_string($conn, $username);

    // SQL query to select ID, full name, and the stored password hash for the entered username
    $sql = sprintf("SELECT id, name, password_hash FROM User WHERE username = '%s'", $safe_username);
    // Execute the query
    $result = mysqli_query($conn, $sql);
    // Get the user's data if the query was successfull otherwise set to null.
    $user_data = $result ? $result->fetch_assoc() : null;

    // Check if the user data was found and if the submitted password matches the stored hash.
    if ($user_data && password_verify($password_input, $user_data['password_hash'])) {
        // Successful login
        // Set session variables to mark the user as logged in.
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $user_data['name'];
        $_SESSION['user_id'] = $user_data['id']; 
        
        // Check if admin and set flag
        if ($username === 'Admin') {
            $_SESSION['is_admin'] = true;
            // Send the admin to the manage page
            header('Location: manage.php');
        } else {
            // Send regular users to their dashboard
            header('Location: dashboard.php');
        }
        exit;
    }

    // Login failed redirects user to the login page with error message
    header('Location: login.php?error=Invalid username or password.');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="<?php echo $pageDescription; ?>">
  <meta name="keywords" content="HTML5, CSS layout, web technology project, PHP, MySQL, Database, Apache, XAMPP">
  <meta name="author" content="Morgan Hopkins, Jonathon Taylor, Shaun Vambe">
  <title><?php echo $pageTitle; ?></title>
  
  <link rel="stylesheet" href="styles/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- CSS Styles for the login page, Produced by GenAI GPT5 -->
    <style>
        * {
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }

        body {
            display: grid;
            grid-template-rows: auto 1fr auto;
            grid-template-columns: 100%;
            min-height: 100vh;
            margin: 0;
            background: #f0f0f0;
            padding: 0;
        }
        
        .main-content-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            width: 100%;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            width: 400px;
            max-width: 90%;
            border: 1px solid #ddd;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        input {
            display: block;
            border: 1px solid #ccc;
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            margin-top: 5px;
            border-radius: 5px;
            font-size: 16px;
        }

        label {
            color: #555;
            font-size: 16px;
            font-weight: bold;
            padding: 0;
            margin-top: 10px;
            display: block;
        }

        button {
            align-self: flex-end;
            background: #007bff;
            padding: 10px 15px;
            color: #fff;
            border-radius: 5px;
            margin-top: 15px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s;
        }

        button:hover {
            background: #0056b3;
            opacity: 1;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>

<header>
  <div class="header-left">
    <img src="images/logo1.png" alt="JSM University Logo" class="header-logo">
    <h1><strong><?php echo $pageHeading; ?></strong></h1>
  </div>

<!--Include navigation file for consistent menu -->
  <?php include 'nav.inc'; ?>

    <div class="main-content-area">
        <h2><?php echo $pageHeading; ?></h2>
        <?php 
            // Error message for database connection
            if (isset($conn_error)) { ?>
            <p class="error"><?php echo htmlspecialchars($conn_error); ?></p>
        <?php } ?>
        <form method="post">
            <?php
            // Error message for login failure
            if (isset($_GET['error'])) { ?>
                <p class='error'><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php } ?>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            
            <button type="submit">Login</button>

            <p>New Here? <a href="register.php">Sign Up</a></p>
        </form>
    </div>
<?php
// Closes database connection
mysqli_close($conn);
?>
<?php include 'footer.inc'; ?>