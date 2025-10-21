<?php
session_start();
$_SESSION['form_data'] = array();
$_SESSION['error'] = '';
header('Location: apply.php');
exit;
?>