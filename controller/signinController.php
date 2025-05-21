<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_VALIDATE_EMAIL);
    $password = trim($_POST['password'] ?? '');

    if (!$email) {
        $_SESSION['error'] = "Please enter a valid email.";
        header('Location: ../view/signin.php');
        exit;
    }

    if (empty($password)) {
        $_SESSION['error'] = "Password is required.";
        header('Location: ../view/signin.php');
        exit;
    }

    // Check if users are stored in session
    if (!isset($_SESSION['users']) || !isset($_SESSION['users'][$email])) {
        $_SESSION['error'] = "Invalid email or password.";
        header('Location: ../view/signin.php');
        exit;
    }

    $user = $_SESSION['users'][$email];

    // Verify password hash
    if (!password_verify($password, $user['password'])) {
        $_SESSION['error'] = "Invalid email or password.";
        header('Location: ../view/signin.php');
        exit;
    }

    // Successful login: store user info in session (you can customize this)
    $_SESSION['user'] = [
        'email' => $user['email'],
        'username' => $user['username'],
    ];

    // Handle "remember me"
    if (isset($_POST['remember'])) {
        setcookie('remember_me', $user['email'], time() + (86400 * 30), "/"); // 30 days
    }

    $_SESSION['success'] = "Successfully signed in!";
    header('Location:../view/dashboard.php');
    exit;
} else {
    header('Location: ../view/signin.php');
    exit;
}
