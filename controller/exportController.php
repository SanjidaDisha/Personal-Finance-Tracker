<?php
session_start();

// Auth check
if (!isset($_SESSION['user_email'])) {
    header("Location: ../view/signin.php");
    exit;
}

$errors = [];
$success = "";

// Handle export logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $exportType = $_POST['export-type'] ?? '';
    $schedule = $_POST['backup-schedule'] ?? 'none';
    $encrypt = $_POST['encrypt'] ?? 'no';

    if (!$exportType) {
        $errors[] = "Export type is required.";
    }

    if (empty($errors)) {
        $success = "Export prepared successfully with schedule: $schedule and encryption: $encrypt";
        // Here you can simulate or trigger the export logic
    }
}

include "../view/exportWizard.php";
