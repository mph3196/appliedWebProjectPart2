<?php
if (empty($_POST['name'])) {
    header('Location: register.php?error=Name is required');
    exit;
}

if (empty($_POST['username'])) {
    header('Location: register.php?error=Username is required');
    exit;
}

if (strlen($_POST['password']) < 8) {
    header('Location: register.php?error=Password must be at least 8 characters');
    exit;
}

if (!preg_match("/[0-9]/", $_POST['password'])) {
    header('Location: register.php?error=Password must contain at least one number');
    exit; 
}

$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

require 'settings.php';
// Establish connection to MySQL database
$conn = mysqli_connect($host, $user, $password, $database);
// Error handling
if (!$conn) {
    //terminate the execution of the current PHP script
    die("Connection failed: " . mysqli_connect_error());
}

$sql = 'INSERT INTO Users1 (name, username, password_hash)
        VALUES (?, ?, ?)';

$stmt = $conn->stmt_init();
if (! $stmt->prepare($sql)) {
    die("SQL prepare error: ". $conn->error);
}

$stmt->bind_param("sss",
                  $_POST["name"], 
                  $_POST["username"],
                  $password_hash);

if ($stmt->execute()) {
    header('Location: login.php'); 
    exit;

} else {
    if ($conn->errno === 1062) {
        header('Location: register.php?error=Username already taken');
        exit;

    } else {
        die("Database execute error: " . $conn->error . " (Error Code: " . $conn->errno . ")");
    }
}
?>