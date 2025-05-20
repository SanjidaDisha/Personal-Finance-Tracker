<?php
session_start();

if (!isset($_SESSION['user'])) {
  header("Location:../view/signin.php");
  exit();
}

$_SESSION['income_errors'] = []; // Clear previous errors

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $type = $_POST['type'] ?? '';
  $data = [];

  // Basic validation helper
  function is_positive_number($value) {
    return is_numeric($value) && $value >= 0;
  }

  if ($type === 'paycheck') {
    $payee = trim($_POST['payee'] ?? '');
    $amount = $_POST['amount'] ?? '';
    $date = $_POST['date'] ?? '';

    if ($payee === '') {
      $_SESSION['income_errors'][] = "Payee name cannot be empty.";
    }
    if (!is_positive_number($amount)) {
      $_SESSION['income_errors'][] = "Amount must be a positive number.";
    }
    if (!$date || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
      $_SESSION['income_errors'][] = "Date is invalid or missing.";
    }

    if (count($_SESSION['income_errors']) === 0) {
      $data = [
        'payee' => $payee,
        'amount' => (float)$amount,
        'date' => $date
      ];
    }
  } elseif ($type === 'recurring') {
    $source = trim($_POST['source'] ?? '');
    $amount = $_POST['amount'] ?? '';
    $frequency = $_POST['frequency'] ?? '';

    $validFreq = ['Monthly', 'Bi-Weekly', 'Weekly'];

    if ($source === '') {
      $_SESSION['income_errors'][] = "Source cannot be empty.";
    }
    if (!is_positive_number($amount)) {
      $_SESSION['income_errors'][] = "Amount must be a positive number.";
    }
    if (!in_array($frequency, $validFreq)) {
      $_SESSION['income_errors'][] = "Frequency is invalid.";
    }

    if (count($_SESSION['income_errors']) === 0) {
      $data = [
        'source' => $source,
        'amount' => (float)$amount,
        'frequency' => $frequency
      ];
    }
  } elseif ($type === 'side') {
    $desc = trim($_POST['desc'] ?? '');
    $amount = $_POST['amount'] ?? '';
    $date = $_POST['date'] ?? '';

    if ($desc === '') {
      $_SESSION['income_errors'][] = "Description cannot be empty.";
    }
    if (!is_positive_number($amount)) {
      $_SESSION['income_errors'][] = "Amount must be a positive number.";
    }
    if (!$date || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
      $_SESSION['income_errors'][] = "Date is invalid or missing.";
    }

    if (count($_SESSION['income_errors']) === 0) {
      $data = [
        'desc' => $desc,
        'amount' => (float)$amount,
        'date' => $date
      ];
    }
  } else {
    $_SESSION['income_errors'][] = "Invalid income entry type.";
  }

  if (count($_SESSION['income_errors']) === 0) {
    // Save income entry
    if (!isset($_SESSION['income'])) {
      $_SESSION['income'] = [];
    }
    $_SESSION['income'][] = ['type' => $type, 'data' => $data];

    // Redirect to clear POST and errors
    header("Location:../view/income_recording.php");
    exit();
  } else {
    // Redirect back to form with errors
    header("Location:../view/income_recording.php");
    exit();
  }
}
?>
