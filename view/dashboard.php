<?php
session_start();

if (!isset($_SESSION['user'])) {
    // Not logged in, redirect to signin page
    header('Location:../view/signin.php');
    exit;
}
$username = htmlspecialchars($_SESSION['username'] ?? 'User'); // fallback username
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FinanceTracker Dashboard</title>
  <link rel="stylesheet" href="../assets/dashboard.css" />
</head>
<body>

<header class="navbar">
  <div class="logo">FinanceTracker</div>
  <div class="user">
    <span id="welcomeUser">Welcome, <?= $username ?></span>
    <form method="POST" action="../controller/logoutController.php" style="display:inline;">
      <button type="submit" name="logout" class="profile-btn" title="Logout">🚪</button>
    </form>
  </div>
</header>

<nav class="nav-links">
  <a href="#">Expense Categories</a>
  <a href="#">Income Recording</a>
  <a href="#">Budget Goals</a>
  <a href="#">Bill Reminders</a>
  <a href="#">Reports/Graphs</a>
  <a href="#">Account Linking</a>
  <a href="#">Debt Tracking</a>
  <a href="#">Savings Goals</a>
  <a href="#">Tax Categories</a>
  <a href="#">Export Data</a>
</nav>

<main class="dashboard">
  <h2 class="section-title">Financial Overview</h2>
  <div class="widgets">
    <div class="card"><h3>💰 Total Income</h3><p>₹45,000</p></div>
    <div class="card"><h3>📤 Total Expenses</h3><p>₹33,500</p></div>
    <div class="card"><h3>💹 Savings Progress</h3><p>65%</p></div>
    <div class="card"><h3>🧮 Budget Left</h3><p>₹11,500</p></div>
  </div>

  <h2 class="section-title">Upcoming & Alerts</h2>
  <div class="widgets">
    <div class="card"><h3>📅 Upcoming Bills</h3><p>3 Due</p></div>
    <div class="card"><h3>📊 Spending Trend</h3><p>↑ 15%</p></div>
    <div class="card alert"><h3>⚠ Budget Warning</h3><p>You're nearing your budget limit!</p></div>
  </div>

  <h2 class="section-title">Accounts & Goals</h2>
  <div class="widgets">
    <div class="card"><h3>🔗 Linked Accounts</h3><p>2 Linked</p></div>
    <div class="card"><h3>💳 Total Debt</h3><p>₹12,000</p></div>
    <div class="card"><h3>🎯 Savings Goal</h3><p>40% Achieved</p></div>
    <div class="card"><h3>📑 Tax Deductibles</h3><p>₹4,500</p></div>
  </div>
</main>

<script src="../assets/dashboard.js"></script>
<script>
  // Prevent accessing this page after logout by disabling browser cache
  window.onload = function() {
    if (!window.performance || performance.navigation.type === 2) {
      // If back/forward button is used, reload the page
      location.reload(true);
    }
  };
</script>

</body>
</html>
