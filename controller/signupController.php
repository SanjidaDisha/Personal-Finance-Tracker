<?php
session_start();

// Get form inputs
$username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';

// Basic validation
if (!$username || !$email || !$password || !$confirm_password) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: ../view/signup.php");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email format.";
    header("Location: ../view/signup.php");
    exit();
}

if (strlen($password) < 6) {
    $_SESSION['error'] = "Password must be at least 6 characters.";
    header("Location: ../view/signup.php");
    exit();
}

if ($password !== $confirm_password) {
    $_SESSION['error'] = "Passwords do not match.";
    header("Location: ../view/signup.php");
    exit();
}

// Initialize users array in session if it doesn't exist
if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [];
}

// Check if email already registered
if (isset($_SESSION['users'][$email])) {
    $_SESSION['error'] = "User with this email already exists.";
    header("Location: ../view/signup.php");
    exit();
}

// Store new user in session with hashed password
$_SESSION['users'][$email] = [
    'username' => htmlspecialchars($username),
    'email' => htmlspecialchars($email),
    'password' => password_hash($password, PASSWORD_DEFAULT),
];

// Optionally set a cookie for username
setcookie('registered_user', $username, time() + (86400 * 7), "/");

// Success message and redirect to signin
$_SESSION['success'] = "Registration successful! Please log in.";
header("Location: ../view/signin.php");
exit();
