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
  <title>Savings Goals - Finance Tracker</title>

  <!-- Font Awesome for hamburger icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

   <link rel="stylesheet" href="../assets/account-linking.css" />
</head>
<body>

  <!-- Responsive Navbar -->
  <header class="navbar">
    <div class="logo">FinanceTracker</div>
    <nav class="nav-links" id="navLinks">
      <a href="landing-page.php">Home</a>
      <a href="Dashboard.php">Dashboard</a>
      <a href="Profile management.php">Profile</a>
      <a href="debt-tracking.php">Debt</a>
      <a href="tax-categories.php">Tax</a>
      <a href="reports.php">Reports</a>
      <a href="Logout.php">Logout</a>
    </nav>
    <div class="hamburger" id="hamburger"><i class="fas fa-bars"></i></div>
  </header> 

  <h1>Account Linking</h1>

  <div class="nav-buttons">
    <button onclick="showScreen('wizard')">Bank Connection Wizard</button>
    <button onclick="showScreen('sync')">Sync Status</button>
    <button onclick="showScreen('resolver')">Error Resolver</button>
  </div>

  <!-- Screen 1: Bank Connection Wizard -->
  <div id="wizard" class="section active">
    <h2>Bank Connection Wizard</h2>
    <form id="bankForm">
      <label for="bankName">Bank Name</label>
      <input type="text" id="bankName" placeholder="e.g., Wells Fargo" required>

      <label for="accountType">Account Type</label>
      <select id="accountType">
        <option>Checking</option>
        <option>Savings</option>
        <option>Credit</option>
      </select>

      <label for="login">Online Banking Username</label>
      <input type="text" id="login" placeholder="Your username" required>

      <label for="password">Password</label>
      <input type="password" id="password" placeholder="Your password" required>

      <button type="submit">Connect</button>
    </form>
  </div>

  <!-- Screen 2: Sync Status -->
  <div id="sync" class="section">
    <h2>Sync Status</h2>
    <div class="status-box">Bank of America - Last Sync: 2 hours ago</div>
    <div class="status-box">Wells Fargo - Last Sync: 10 mins ago</div>
    <label for="syncRate">Sync Frequency</label>
    <select id="syncRate">
      <option>Every 15 minutes</option>
      <option>Hourly</option>
      <option>Daily</option>
    </select>
    <button onclick="alert('Sync frequency updated')">Update Frequency</button>
  </div>

  <!-- Screen 3: Error Resolver -->
  <div id="resolver" class="section">
    <h2>Error Resolver</h2>
    <div class="status-box error">⚠️ Chase: Login expired</div>
    <div class="status-box error">⚠️ Citi Bank: Incorrect password</div>

    <label for="bankFix">Select Bank</label>
    <select id="bankFix">
      <option>Chase</option>
      <option>Citi Bank</option>
    </select>

    <label for="newPassword">Enter New Password</label>
    <input type="password" id="newPassword" placeholder="Enter new password">
    
    <button onclick="resolveError()">Fix Connection</button>
  </div>

   <script src="../assets/account-linking.js"></script>

</body>
</html>
