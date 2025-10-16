<?php
session_start();

require_once "settings.php";
$conn = mysqli_connect($host, $user, $password, $database);

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = ($_POST['username']);
    $password = ($_POST['password']);

    if (empty($username)) {
        header('Location: login.php?error=Username is required');
        exit();
    } else if (empty($password)) {
        header('Location: login.php?error=Password is required');
        exit();

    } else {
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            if ($user['Username'] === $username && $user['Password'] === $password) {
                $_SESSION['username'] = $user['Username'];
                $_SESSION['name'] = $user['FullName'];
                $_SESSION['id'] = $user['id'];
                header('Location: manage.php');
                exit();
            } else {
                header('Location: login.php?error=Incorect Username or password');
                exit();
            }
        } else {
            header('Location: login.php?error=Incorect Username or password');
            exit();
        }
    }

}else {
    header('Location: login.php');
    exit;
}