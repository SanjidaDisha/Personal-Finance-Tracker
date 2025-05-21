<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ../view/signin.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle Profile Edit
    if (isset($_POST['action']) && $_POST['action'] === 'editProfile') {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $gender = $_POST['gender'] ?? '';
        $country = trim($_POST['country'] ?? '');
        $dob = $_POST['dob'] ?? '';

        $errors = [];

        if (empty($name)) $errors[] = "Name is required.";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
        if (!in_array($gender, ['Male', 'Female', 'Other'])) $errors[] = "Invalid gender selected.";
        if (empty($country)) $errors[] = "Country is required.";
        if (empty($dob)) $errors[] = "Date of birth is required.";

        if ($errors) {
            $_SESSION['errors'] = $errors;
            header("Location: ../view/ProfileManagement.php");
            exit;
        }

        // Save to database (placeholder)
        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: ../view/ProfileManagement.php");
        exit;
    }

    // Handle Password Update
    if ($_POST['action'] === 'updatePassword') {
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if (strlen($newPassword) < 6) {
            $_SESSION['errors'] = ["Password must be at least 6 characters."];
        } elseif ($newPassword !== $confirmPassword) {
            $_SESSION['errors'] = ["Passwords do not match."];
        } else {
            // Save hashed password (placeholder)
            $_SESSION['success'] = "Password updated successfully!";
        }

        header("Location: ../view/ProfileManagement.php");
        exit;
    }
}
?>
