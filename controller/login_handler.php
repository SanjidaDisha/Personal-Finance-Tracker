<?php
session_start();

$dummy_email = "user@example.com";
$dummy_password = "123456";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST["email"] ?? '';
  $password = $_POST["password"] ?? '';
  $remember = isset($_POST["remember"]);

  if ($email === $dummy_email && $password === $dummy_password) {
    $_SESSION["email"] = $email;

    if ($remember) {
      setcookie("email", $email, time() + (86400 * 30), "/"); // 30 days
    }

    header("Location: Dashboard.php");
    exit();
  } else {
    $_SESSION["error"] = "Invalid email or password.";
    header("Location: signin.php");
    exit();
  }
}
?>
