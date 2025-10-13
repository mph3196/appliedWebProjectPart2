<?php
// process_login.php — secure login processor with roles + timeout
session_start();
require_once 'settings.php'; // defines $conn

// Redirect back if accessed directly
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

// Basic validation
if ($username === 'Admin' && $password === 'Admin') {
    $_SESSION['user'] = $username;
    header('Location: manage.php');
} else {
    echo "Invalid login.<a href='login.html'>Try again</a>";
}
if (empty($username) || empty($password)) {
    $_SESSION['error'] = "Username and password are required.";
    header("Location: login.php");
    exit;
}
// Prepare and execute secure query
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($user = $result->fetch_assoc()) {
    if (password_verify($password, $user['password_hash'])) {
        // Password verified — set secure session variables
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'] ?? 'Manager';
        $_SESSION['last_activity'] = time(); // record login time

        // Optional: regenerate session ID to prevent session fixation
        session_regenerate_id(true);

        header("Location: manage.php");
        exit;
    } else {
        $_SESSION['error'] = "Invalid password.";
        header("Location: login.php");
        exit;
    }
} else {
    $_SESSION['error'] = "User not found.";
    header("Location: login.php");
    exit;
}

$stmt->close();
$conn->close();
?>