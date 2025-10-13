<?php
$currentPage = 'login';
$pageTitle = 'JSM Manager Login';
$pageDescription = 'Login page for managers to access HR system';
$pageHeading = 'Login - Manager Access';
include 'header.inc';
include 'nav.inc';
?>

<?php
// If user already logged in, redirect to manage.php
if (isset($_SESSION['username'])) {
    header('Location: manage.php');
    exit();
}

// Automatically remove login block after time expires
if (isset($_SESSION['blockedFromLogin']) && time() > $_SESSION['blockedFromLogin']) {
    unset($_SESSION['blockedFromLogin']);
    unset($_SESSION['wrongLoginAttempts']);
}

// For displaying an optional error message
$error = '';
if (isset($_SESSION['loginError'])) {
    $error = $_SESSION['loginError'];
    unset($_SESSION['loginError']);
}
?>

<main style="display: flex; justify-content: center; align-items: center; min-height: 70vh;">
    <div class="login-container" style="
        background: white;
        padding: 2em;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        width: 320px;
        font-family: Arial, sans-serif;
    ">
        <h2 style="text-align:center; color:#333;">Manager Login</h2>

        <?php
        // If blocked after 3 failed attempts
        if (isset($_SESSION['blockedFromLogin'])) {
            echo '<div class="login-error" style="text-align:center; color:#b71c1c;">
                    <h3>Access blocked</h3>
                    <p>You entered the wrong username or password 3 times.</p>
                    <p>Your device is blocked until: <strong>',
                        date("d/m/Y H:i:s", $_SESSION['blockedFromLogin']),
                    '</strong></p>
                    <a href="index.php" style="display:inline-block; margin-top:1em; background:#1976d2; color:white; padding:0.5em 1em; border-radius:5px; text-decoration:none;">Back to Home</a>
                  </div>';
        } else {
        ?>
            <form method="post" action="process_login.php">
                <label>Username:</label>
                <input type="text" name="username" required
                    style="width:100%; padding:0.7em; margin:0.5em 0; border:1px solid #ccc; border-radius:6px;">

                <label>Password:</label>
                <input type="password" name="password" required
                    style="width:100%; padding:0.7em; margin:0.5em 0; border:1px solid #ccc; border-radius:6px;">

                <input type="submit" value="Login"
                    style="width:100%; padding:0.7em; background:#1976d2; color:white; border:none; border-radius:6px; cursor:pointer;">
            </form>

            <?php if (!empty($error)): ?>
                <div style="color:red; text-align:center; margin-top:1em;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
        <?php } ?>
    </div>
</main>

<?php include 'footer.inc'; ?>