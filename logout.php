<?php
session_start();

unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);
$_SESSION['status'] = "You're successfully Logged Out!";
header('Location: login.php');
unset($_SESSION['status']);

?>