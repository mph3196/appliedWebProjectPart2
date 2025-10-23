<?php
session_start();
$_SESSION['form_data'] = [];
$_SESSION['error'] = '';
header('Location: apply.php');
exit;
?>