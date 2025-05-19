<?php
session_start();
// Check if session or cookie is set
if (!isset($_SESSION['status']) && !isset($_COOKIE['status'])) {
    header('Location: Login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - Personal Finance Tracker</title>
  <link rel="stylesheet" href="../assets/Dashboard.css">
</head>
<body>

  <nav aria-label="Main navigation">
    <div class="logo">FinanceTracker</div>
    <div class="toggle" onclick="toggleMenu()">☰</div>
    <div class="menu" id="navbarMenu">
      <a href="Dashboard.php">Dashboard</a>
      <a href="landing-page.php">Home</a>
      <a href="Profile management.php">Profile</a>
      <a href="debt-tracking.php">Debt</a>
      <a href="tax-categories.php">Tax</a>
      <a href="account-linking.php">Accounts</a>
      <a href="reports.php">Reports</a>
      <a href="../controller/Logout.php">Logout</a> <!-- Corrected Logout link -->
    </div>
  </nav>

  <div class="main">
    <h2>Welcome to Your Dashboard</h2>
    <div class="cards">
      <div class="card" onclick="location.href='Profile management.html'">
        <h3>Profile Info</h3>
        <p>Manage your personal profile, update details and avatar.</p>
      </div>
      <div class="card" onclick="location.href='debt-tracking.html'">
        <h3>Debt Tracking</h3>
        <p>View and manage your debts, repayments and balances.</p>
      </div>
      <div class="card" onclick="location.href='reports.html'">
        <h3>Reports</h3>
        <p>Generate monthly financial reports and insights.</p>
      </div>
    </div>
  </div>

  

  <script src="../assets/Dashboard.js"></script>
</body>
</html>
