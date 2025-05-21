<?php
session_start();

if (!isset($_SESSION['user'])) {
    // Not logged in, redirect to signin page
    header('Location:../view/signin.php');
    exit;
}
$username = htmlspecialchars($_SESSION['username'] ?? 'User'); // fallback username
// Initialize deductions in session if not set
if (!isset($_SESSION['deductions'])) {
    $_SESSION['deductions'] = [];
}
$deductions = $_SESSION['deductions'];

// Calculate total for summary
$totalDeduction = 0;
foreach ($deductions as $ded) {
    $totalDeduction += floatval($ded['amount']);
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
      <a href="saving-goals.php"> Saving Goals</a>
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
     <form id="deductionForm" method="POST" action="../controller/tax-categoriescontroller.php" onsubmit="return validateForm()">
    <label for="deductionName">Expense Description</label>
     <input type="text" id="deductionName" name="deductionName" placeholder="e.g. Office supplies" required><br><br>

    <label for="deductionAmount">Amount ($)</label>
    <input type="number" step="0.01" id="deductionAmount" name="deductionAmount" placeholder="e.g. 120.50" required><br><br>

    <button class="submit" onclick="addDeduction()">Add Deductible Expense</button>
</form>

    <h3>Current Deductions:</h3>
    <ul class="deduction-list" id="deductionList">
      <?php foreach ($deductions as $ded): ?>
        <li><?php echo htmlspecialchars($ded['description']); ?> - $<?php echo number_format(floatval($ded['amount']), 2); ?></li>
      <?php endforeach; ?>
    </ul>

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
