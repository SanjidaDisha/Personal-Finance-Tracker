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
<link rel="stylesheet" href="../assets/tax-categories.css">
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
      <a href="account-linking.php">Accounts</a>
      <a href="reports.php">Reports</a>
       <a href="../controller/Logout.php">Logout</a> <!-- Corrected Logout link -->
    </nav>
    <div class="hamburger" id="hamburger"><i class="fas fa-bars"></i></div>
  </header> 

  <h1>Tax Categories</h1>

  <div class="nav-buttons">
    <button onclick="showScreen('deduction')">Deduction Manager</button>
    <button onclick="showScreen('summary')">Year-End Summary</button>
    <button onclick="showScreen('export')">CPA Export</button>
  </div>

  <!-- Deduction Manager -->
  <div id="deduction" class="section active">
    <h2>Deduction Manager</h2>
    <label for="deductionName">Expense Description</label>
    <input type="text" id="deductionName" placeholder="e.g. Office supplies">

    <label for="deductionAmount">Amount ($)</label>
    <input type="number" id="deductionAmount" placeholder="e.g. 120.50">

    <button class="submit" onclick="addDeduction()">Add Deductible Expense</button>

    <div class="deduction-list" id="deductionList"></div>
  </div>

  <!-- Year-End Summary -->
  <div id="summary" class="section">
    <h2>Year-End Summary</h2>
    <p>Review all deductions and calculate the total deductible amount.</p>
    <div class="summary-list" id="summaryList"></div>
    <div class="result" id="totalSummary"></div>
  </div>

  <!-- CPA Export -->
  <div id="export" class="section">
    <h2>CPA Export</h2>
    <p>Generate a text version of deductions for your accountant.</p>
    <textarea class="export-box" id="exportBox" readonly></textarea>
    <button class="submit" onclick="exportData()">Generate Export Data</button>
  </div>

  <script src=" ../assets/tax-categories.js"></script>

</body>
</html>
