<?php
session_start();

if (!isset($_SESSION['status']) && !isset($_COOKIE['status'])) {
    header("Location: ../view/signin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $goalName = trim($_POST['goalName']);
    $goalTarget = $_POST['goalTarget'];
    $goalSaved = $_POST['goalSaved'];
    $goalDate = $_POST['goalDate'];

    $errors = [];

    if (empty($goalName) || strlen($goalName) < 3) {
        $errors[] = "Goal name must be at least 3 characters.";
    }

    if (!is_numeric($goalTarget) || $goalTarget <= 0) {
        $errors[] = "Target amount must be a positive number.";
    }

    if (!is_numeric($goalSaved) || $goalSaved < 0 || $goalSaved > $goalTarget) {
        $errors[] = "Saved amount must be non-negative and not exceed the target.";
    }

    if (empty($goalDate) || strtotime($goalDate) < time()) {
        $errors[] = "Due date must be a valid future date.";
    }

    if (count($errors) > 0) {
        echo "<h3>Validation Errors:</h3><ul>";
        foreach ($errors as $err) {
            echo "<li>" . htmlspecialchars($err) . "</li>";
        }
        echo "</ul><a href='../view/savings-goals.php'>Back</a>";
    } else {
        // Normally you'd insert into a database here.
        echo "<h3>Goal added successfully!</h3>";
        echo "<a href='../view/savings-goals.php'>Back to Goals</a>";
    }
} else {
    header("Location: ../view/savings-goals.php");
    exit;
}
