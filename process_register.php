<?php
// Checks if the name field in the submitted form  is empty
if (empty($_POST['name'])) {
    // If empty redirects user back to registration page with error
    header('Location: register.php?error=Name is required');
    exit;
}

// Checks if the username field in the submitted form  is empty
if (empty($_POST['username'])) {
    // If empty redirects user back to registration page with error
    header('Location: register.php?error=Username is required');
    exit;
}

//Checks if the length of the submitted password is less than 8 characters
if (strlen($_POST['password']) < 8) {
    // If too short redirects user to registration page with error message
    header('Location: register.php?error=Password must be at least 8 characters');
    exit;
}

// Check if the password does NOT contain at least one digit (0-9)
if (!preg_match("/[0-9]/", $_POST['password'])) {
    // If there is no number redirects user to the registration page with error message
    header('Location: register.php?error=Password must contain at least one number');
    exit; 
}

// Hash the password entered by user for security in the database
$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Settings file included 
require 'settings.php';
// Establish connection to MySQL database
$conn = mysqli_connect($host, $user, $password, $database);
// Checks to see if the connection failed
if (!$conn) {
    // If connection failed displays error message 
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query for inserting the data into the user table
// Question marks prevents SQL injection and are used as placeholders 
$sql = 'INSERT INTO User (name, username, password_hash)
        VALUES (?, ?, ?)';

// Prepares $stmt to safely handle the database command
$stmt = $conn->stmt_init();
// Send the $sql to the database to get it prepared
if (! $stmt->prepare($sql)) {
    // If databse cant get $sql script stops and shows error
    die("SQL prepare error: ". $conn->error);
}

// Binds the variables (eg.$_POST["name"]) to the placeholders
// "sss" indicates they are all strings
$stmt->bind_param("sss",
                  $_POST["name"], 
                  $_POST["username"],
                  $password_hash);

// Tries to save the data in the SQL table
try {
    $stmt->execute();
    // Success
    header('Location: login.php');
    exit;
} catch (mysqli_sql_exception $e) {
    // Check for duplicate entry
    if ($e->getCode() === 1062) {
        header('Location: register.php?error=Username already taken');
        exit;
    } else {
        die("Database execute error: " . $e->getMessage() . " (Error Code: " . $e->getCode() . ")");
    }
}
?>