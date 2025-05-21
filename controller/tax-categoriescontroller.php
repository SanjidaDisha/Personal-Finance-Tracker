<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $description = trim($_POST["deductionName"]);
    $amount = $_POST["deductionAmount"];

    $errors = [];

    if (empty($description)) {
        $errors[] = "Description is required.";
    }

    if (!is_numeric($amount) || $amount <= 0) {
        $errors[] = "Amount must be a positive number.";
    }

    if (empty($errors)) {
        // Simulate saving (you may insert into DB here)
        $_SESSION['deductions'][] = [
            'description' => htmlspecialchars($description),
            'amount' => number_format($amount, 2)
        ];
        header("Location: ../view/tax-categories.php?success=1");
        exit();
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: ../view/tax-categories.php");
        exit();
    }
}
?>