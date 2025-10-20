<?php
require_once "settings.php";

$currentPage = 'Login';
$pageTitle = 'JSM Login Page';
$pageDescription = 'Login page for JSM website';
$pageHeading = 'Login - HR Manager';
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
        <h2><?php echo $currentPage; ?></h2> 
        
        <form action="process_login.php" method="post"> 
            <?php
            if (isset($_GET['error'])) { ?>
                <p class='error'><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username">
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password">
            
            <button type="submit">Login</button>
        </form>
    </div>
    
<?php include 'footer.inc'; ?>