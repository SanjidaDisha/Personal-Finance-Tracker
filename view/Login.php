<?php
session_start();
$error = ""; // ✅ Initialize the variable

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    // Sample user authentication using session data from registration (adjust to file/DB if needed)
    if (isset($_SESSION["email"]) && $email === $_SESSION["email"] && password_verify($password, $_SESSION["passwordHash"])) {
        $_SESSION['status'] = true;
        // Optional: set cookie
        // setcookie("status", "loggedin", time() + 3600, "/");

        header("Location: Dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password.";
        //echo "<script>alert('Invalid email or password'); window.history.back();</script>";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
   <link rel="stylesheet" href=" ../assets/Login.css">
</head>
<body>
  <div class="container">
   <h2>Login</h2>
    <form method="POST" action="">
      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <input type="submit" value="Login">
    </form>
    


    <?php if ($error): ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="register-link">
      <a href="register.php">Don't have an account? Register</a>
    </div>
  </div>
   <script src="../assets/Login.js"></script>
</body>
</html>
