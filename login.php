<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once "settings.php";

$currentPage = 'Login';
$pageTitle = 'JSM Login Page';
$pageDescription = 'Login page for JSM website';
$pageHeading = 'Login';

$is_invalid = false;
$username_value = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $username_value = $_POST['username'] ?? "";
    
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $is_invalid = true;
    } else {
        
        $mysqli = require __DIR__ . '/database.php';
        
        $login_successful = false;
        $user_data = null;
        $is_admin = false;

        $sql_admin = "SELECT id, username, password_hash FROM user WHERE username = ?";
        $stmt = $mysqli->prepare($sql_admin);
        
        if ($stmt) {
            $stmt->bind_param("s", $username_value);
            $stmt->execute();
            $result = $stmt->get_result();
            $potential_admin = $result->fetch_assoc();
            
            if ($potential_admin && password_verify($_POST['password'], $potential_admin['password_hash'])) {
                $login_successful = true;
                $is_admin = true;
                $user_data = $potential_admin;
            }
        }
        
        if (!$login_successful) {
            $sql_regular = "SELECT id, username, password_hash FROM users1 WHERE username = ?";
            $stmt = $mysqli->prepare($sql_regular);
            
            if ($stmt) {
                $stmt->bind_param("s", $username_value);
                $stmt->execute();
                $result = $stmt->get_result();
                $potential_user = $result->fetch_assoc();
                
                if ($potential_user && password_verify($_POST['password'], $potential_user['password_hash'])) {
                    $login_successful = true;
                    $is_admin = false;
                    $user_data = $potential_user;
                }
            }
        }

        if ($login_successful) {
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['username'] = $user_data['username'];
            $_SESSION['is_admin'] = $is_admin;
            
            if ($is_admin) {
                header('Location: manage.php');
            } else {
                header('Location: dashboard.php');
            }
            exit;
        } else {
            $is_invalid = true;
        }
    }
}

include 'header.inc';
include 'nav.inc';
?>

<head>
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
        <h2><?php echo htmlspecialchars($currentPage); ?></h2> 
        
        <form method="post"> 
            <?php
            if (isset($_GET['error'])) { ?>
                <p class='error'><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php 
            } elseif ($is_invalid) { ?>
                <p class='error'>Invalid username or password</p>
            <?php } ?>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required
                   value="<?= htmlspecialchars($username_value) ?>">
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
    
<?php include 'footer.inc'; ?>