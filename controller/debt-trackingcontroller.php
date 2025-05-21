<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location:../view/signin.php');
    exit;
}

function sanitize($data) {
    return htmlspecialchars(trim($data));
}

$loanName = sanitize($_POST['loanName'] ?? '');
$loanAmount = $_POST['loanAmount'] ?? '';
$loanRate = $_POST['loanRate'] ?? '';

$errors = [];

if (empty($loanName)) {
    $errors[] = "Loan name is required.";
}
if (!is_numeric($loanAmount) || $loanAmount <= 0) {
    $errors[] = "Loan amount must be a positive number.";
}
if (!is_numeric($loanRate) || $loanRate <= 0) {
    $errors[] = "Loan APR must be a positive number.";
}

if (!empty($errors)) {
    $_SESSION['debt_errors'] = $errors;
    header('Location: ../view/debt-tracking.php');
    exit;
}

$_SESSION['success'] = "Loan successfully added.";
header('Location: ../view/debt-tracking.php');
exit;
?>
