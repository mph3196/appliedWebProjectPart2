<?php
$currentPage = 'Login';
$pageTitle = 'JSM Login Page';
$pageDescription = 'Login page for JSM University';
$pageHeading = 'Login';
include 'header.inc';
include 'nav.inc';
?>

<?php
// login.php
session_start();
require_once 'settings.php'; // Make sure this connects to your database

$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        // Prepare statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($user = $result->fetch_assoc()) {
            // Verify password
            if (password_verify($password, $user['password_hash'])) {
                // Password correct → store session data
                $_SESSION['username'] = $user['username'];
                header("Location: manage.php");
                exit;
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "User not found.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HR Manager Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f6f6;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 2em;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            width: 320px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        input[type=text],
        input[type=password] {
            width: 100%;
            padding: 0.7em;
            margin: 0.5em 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        input[type=submit] {
            width: 100%;
            padding: 0.7em;
            background: #1976d2;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background: #125a9c;
        }
        .error {
            color: red;
            text-align: center;
            margin-top: 1em;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>HR Manager Login</h2>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username" required>

        <label>Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">
    </form>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
</div>
</body>
</html>