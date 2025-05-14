<?php
session_start();

// Dummy credentials
$validEmail = "user@example.com";
$validPassword = "123456";

if ($_POST['email'] === $validEmail && $_POST['password'] === $validPassword) {
    $_SESSION['loggedin'] = true;
    header("Location: home.php");
    exit;
} else {
    header("Location: login.html?error=1");
    exit;
}
?>
