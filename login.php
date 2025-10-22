<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$currentPage = 'Login';
$pageTitle = 'JSM Login Page';
$pageDescription = 'Login page for JSM website';
$pageHeading = 'Login';

include 'header.inc';
include 'nav.inc';

// Database connection
require_once "settings.php";
$conn = mysqli_connect($host, $user, $password, $database); 

if (!$conn) {
    $conn_error = "Unable to connect to the database.";
}

// Handle login attempt
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($conn_error)) {
        header('Location: login.php?error=Database connection error. Please try again later.');
        exit;
    }
    
    $username = trim($_POST['username']);
    $password_input = $_POST['password'];
    $safe_username = mysqli_real_escape_string($conn, $username);

    // Single query - check User table only
    $sql = sprintf("SELECT id, name, password_hash FROM User WHERE username = '%s'", $safe_username);
    $result = mysqli_query($conn, $sql);
    $user_data = $result ? $result->fetch_assoc() : null;

    if ($user_data && password_verify($password_input, $user_data['password_hash'])) {
        // Successful login
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $user_data['name'];
        $_SESSION['user_id'] = $user_data['id']; 
        
        // Check if admin and set flag
        if ($username === 'Admin') {
            $_SESSION['is_admin'] = true;
            header('Location: manage.php');
        } else {
            header('Location: dashboard.php');
        }
        exit;
    }

    // Login failed
    header('Location: login.php?error=Invalid username or password.');
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
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
<body>
    <div class="main-content-area">
        <h2><?php echo $pageHeading; ?></h2>
        <?php if (isset($conn_error)) { ?>
            <!-- Display database connection error if it occurred -->
            <p class="error"><?php echo htmlspecialchars($conn_error); ?></p>
        <?php } ?>
        <form method="post">
            <?php
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
mysqli_close($conn);
include 'footer.inc';
?>
</body>