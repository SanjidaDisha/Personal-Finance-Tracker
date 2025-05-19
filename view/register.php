<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Collect & sanitize inputs
  $fname = htmlspecialchars(trim($_POST["firstname"]));
  $lname = htmlspecialchars(trim($_POST["lastname"]));
  $email = htmlspecialchars(trim($_POST["email"]));
  $password = trim($_POST["password"]);
  $confirmPassword = trim($_POST["confirmPassword"]);
  $gender = isset($_POST["gender"]) ? $_POST["gender"] : "";
  $dob = $_POST["dob"];

  // Server-side validation
  if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($confirmPassword) || empty($gender) || empty($dob)) {
    echo "<script>alert('All fields are required!'); window.history.back();</script>";
    exit();
  }

  if ($password !== $confirmPassword) {
    echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
    exit();
  }

  // Hash password securely
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Store in session (simulate user creation)
  $_SESSION["firstName"] = $fname;
  $_SESSION["lastName"] = $lname;
  $_SESSION["email"] = $email;
  $_SESSION["gender"] = $gender;
  $_SESSION["dob"] = $dob;
  $_SESSION["passwordHash"] = $hashedPassword;

  // Redirect to dashboard
 // Set success message in session
$_SESSION["success"] = "Registered successfully!";

// Redirect to dashboard
header("Location: Login.php");
exit();

  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Registration</title>
  <link rel="stylesheet" href="../assets/register.css" />
</head>
<body>
  <div class="container">
    <h2>Registration</h2>
    <form name="regForm" method="POST" action="" onsubmit="return validateForm()">
      
      <label>First Name:</label>
      <input type="text" name="firstname" id="firstname">
      <span class="error" id="fnameErr"></span>

      <label>Last Name:</label>
      <input type="text" name="lastname" id="lastname">
      <span class="error" id="lnameErr"></span>

      <label>Email:</label>
      <input type="email" name="email" id="email">
      <span class="error" id="emailErr"></span>

      <label>Password:</label>
      <input type="password" name="password" id="password">
      <span class="error" id="passErr"></span>

      <label>Confirm Password:</label>
      <input type="password" name="confirmPassword" id="confirmPassword">
      <span class="error" id="confirmPassErr"></span>

      <label>Gender:</label>
      <div class="gender">
        <input type="radio" name="gender" value="Male" id="male"> Male
        <input type="radio" name="gender" value="Female" id="female"> Female
      </div>
      <span class="error" id="genderErr"></span>

      <label>Date of Birth:</label>
      <input type="date" name="dob" id="dob">
      <span class="error" id="dobErr"></span>

      <input type="submit" value="Register">
    </form>

    <div class="login-link">
      <a href="Login.php">Already have an account? Login</a>
    </div>
  </div>

   <script src="../assets/register.js"></script>
</body>
</html>
