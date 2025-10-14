<?php
require "database.php";
require_once "settings.php";
session_start();
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
        $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
        $result = $mysqli->query($sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] === $username && $row['password'] === $password) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
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